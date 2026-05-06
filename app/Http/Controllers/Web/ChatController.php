<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\AiChat;
use App\Models\ChatSession;
use App\Models\LearningCenter;
use App\Models\LearningCentersSubject;
use App\Models\RiasecResult;
use App\Models\SubjectsOfLearningCenter;
use App\Models\Teacher;
use App\Models\TeacherSubject;
use App\Services\ChatService;
use App\Services\QuizService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class ChatController extends Controller
{
    /* ── CHAT PAGE ── */

    public function chat(Request $request)
    {
        $user = Auth::user();

        $sessions = ChatSession::where('user_id', $user->id)
            ->with('lastMessage')
            ->latest()
            ->get();

        $sessionId = $request->query('session');
        $currentSession = null;
        $messages = collect();

        if ($sessionId) {
            $currentSession = ChatSession::where('user_id', $user->id)
                ->where('id', $sessionId)->first();
        }

        if (!$currentSession) {
            $currentSession = ChatSession::where('user_id', $user->id)
                ->where('status', 'active')->latest()->first();
        }

        if ($currentSession) {
            $messages = $currentSession->messages;
        }

        return view('chat.chat', compact('sessions', 'currentSession', 'messages'));
    }

    /* ── YANGI SESSIYA ── */

    public function newSession()
    {
        $session = ChatSession::create([
            'user_id' => Auth::id(),
            'title' => 'Yangi suhbat',
            'status' => 'active',
        ]);

        return response()->json(['ok' => true, 'session_id' => $session->id]);
    }

    /* ── XABAR SAQLASH ── */

    public function saveChat(Request $request)
    {
        $request->validate([
            'session_id' => 'nullable|integer',
            'user_message' => 'required|string|max:5000',
            'ai_response' => 'required|string',
            'model' => 'nullable|string|max:100',
        ]);

        if (!Auth::check())
            return response()->json(['ok' => false], 401);

        $userId = Auth::id();
        $model = $request->input('model', 'deepseek/deepseek-r1');

        $session = null;
        if ($request->session_id) {
            $session = ChatSession::where('user_id', $userId)
                ->where('id', $request->session_id)->first();
        }

        if (!$session || $session->isFull()) {
            $session = ChatSession::create([
                'user_id' => $userId,
                'title' => mb_substr($request->user_message, 0, 45),
                'status' => 'active',
            ]);
        }

        AiChat::insert([
            ['user_id' => $userId, 'session_id' => $session->id, 'role' => 'user', 'content' => $request->user_message, 'model' => $model, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => $userId, 'session_id' => $session->id, 'role' => 'assistant', 'content' => $request->ai_response, 'model' => $model, 'created_at' => now(), 'updated_at' => now()],
        ]);

        $newCount = $session->message_count + 2;
        $session->update([
            'message_count' => $newCount,
            'status' => $newCount >= ChatSession::MAX_MESSAGES ? 'closed' : 'active',
        ]);

        return response()->json([
            'ok' => true,
            'session_id' => $session->id,
            'is_full' => $session->fresh()->isFull(),
        ]);
    }

    /* ── MARKAZ QIDIRISH — sof MySQL LIKE, hech qanday paket yo'q ── */

    public function searchCenters(Request $request)
    {
        $request->validate(['keywords' => 'required|array']);
        $kw = $request->keywords;

        $province = $kw['province'] ?? null;   // viloyat nomi
        $subjects = $kw['subjects'] ?? [];     // fanlar ro'yxati
        $query = $kw['query'] ?? null;   // umumiy qidiruv matni

        $q = LearningCenter::query()
            ->with(['subjects.subject', 'teachers'])
            ->select('id', 'name', 'type', 'about', 'province', 'region', 'address', 'student_count');

        // 1. Viloyat bo'yicha filter
        if ($province) {
            $q->where('province', 'LIKE', "%{$province}%");
        }

        // 2. Fan nomi bo'yicha JOIN filter
        if (!empty($subjects)) {
            $q->where(function ($outer) use ($subjects) {
                // subjects_of_learning_centers → subjects jadvalidan qidirish
                $outer->whereHas('subjects.subject', function ($inner) use ($subjects) {
                    $inner->where(function ($sub) use ($subjects) {
                        foreach ($subjects as $s) {
                            $sub->orWhere('name', 'LIKE', "%{$s}%");
                        }
                    });
                });
            });
        }

        // 3. Umumiy matn qidiruvi (nom, haqida, manzil)
        if ($query) {
            $q->where(function ($w) use ($query) {
                $w->where('name', 'LIKE', "%{$query}%")
                    ->orWhere('about', 'LIKE', "%{$query}%")
                    ->orWhere('address', 'LIKE', "%{$query}%");
            });
        }

        // 4. Eng ko'p o'quvchisi bo'lgan markazlarni ustiga qo'yish
        $centers = $q->orderByDesc('student_count')->limit(8)->get();

        // 5. Viloyat bo'yicha hech narsa topilmasa — kengaytirilgan qidiruv
        if ($centers->isEmpty() && $province) {
            $centers = LearningCenter::with(['subjects.subject', 'teachers'])
                ->select('id', 'name', 'type', 'about', 'province', 'region', 'address', 'student_count')
                ->where('province', 'LIKE', "%{$province}%")
                ->orderByDesc('student_count')
                ->limit(8)
                ->get();
        }

        // 6. AI uchun kontekst matni (qisqa va aniq)
        $context = $centers->map(function ($c) {
            $subs = $c->subjects->map(function ($s) {
                $price = $s->price
                    ? number_format((int) $s->price, 0, '.', ' ') . " so'm"
                    : '';
                return ($s->subject?->name ?? '') . ($price ? " ({$price})" : '');
            })->filter()->join(', ');

            $teachers = $c->teachers->pluck('name')->join(', ');

            return implode(' | ', array_filter([
                "#{$c->id} {$c->name} ({$c->type})",
                "{$c->province}, {$c->region}",
                $c->address,
                $c->about ? mb_substr($c->about, 0, 80) : null,
                $subs ? "Fanlar: {$subs}" : null,
                $c->student_count ? "O'quvchilar: {$c->student_count}" : null,
                $teachers ? "O'qituvchilar: {$teachers}" : null,
            ]));
        })->join("\n");

        return response()->json([
            'ok' => true,
            'context' => $context,
            'count' => $centers->count(),
        ]);
    }

    /* ── SESSIYA TARIXI ── */

    public function getSession($id)
    {
        $session = ChatSession::where('user_id', Auth::id())
            ->with('messages')
            ->findOrFail($id);

        return response()->json([
            'ok' => true,
            'session' => [
                'id' => $session->id,
                'title' => $session->title,
                'status' => $session->status,
                'message_count' => $session->message_count,
            ],
            'messages' => $session->messages->map(fn($m) => [
                'role' => $m->role,
                'content' => $m->content,
                'created_at' => $m->created_at->format('H:i'),
            ]),
            'is_full' => $session->isFull(),
        ]);
    }

    /* ── SIDEBAR SESSIYALAR ── */

    public function getSessions()
    {
        $sessions = ChatSession::where('user_id', Auth::id())
            ->with('lastMessage')->latest()->get()
            ->map(fn($s) => [
                'id' => $s->id,
                'title' => $s->title,
                'status' => $s->status,
                'message_count' => $s->message_count,
                'is_full' => $s->isFull(),
                'last_message' => $s->lastMessage
                    ? mb_substr($s->lastMessage->content, 0, 55) : null,
                'created_at' => $s->created_at->format('d.m H:i'),
            ]);

        return response()->json(['ok' => true, 'sessions' => $sessions]);
    }

    /* ── AI API PROXY — CORS muammosini oldini oladi ── */

    public function proxyAi(Request $request)
    {
        $request->validate([
            'messages' => 'required|array',
            'temperature' => 'nullable|numeric',
            'max_tokens' => 'nullable|integer',
        ]);

        if (!env('AI_SEARCH_ENABLED')) {
            return response()->json([
                'choices' => [
                    ['message' => ['content' => 'AI xizmati vaqtinchalik o‘chirilgan.']]
                ]
            ], 503);
        }

        try {
            $apiKey = env('AI_SEARCH_KEY');
            $model = env('AI_SEARCH_MODEL', 'mistralai/Mistral-7B-Instruct-v0.2');
            $timeout = (int) env('AI_SEARCH_TIMEOUT', 30);

            // Hugging Face Inference API (standard format)
            $url = 'https://api-inference.huggingface.co/models/' . $model;

            // Messages ni prompt ga aylantirish
            $prompt = $this->messagesToPrompt($request->messages);

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout($timeout)
              ->post($url, [
                  'inputs' => $prompt,
                  'parameters' => [
                      'temperature' => $request->input('temperature', 0.7),
                      'max_new_tokens' => $request->input('max_tokens', 2000),
                      'return_full_text' => false,
                  ],
              ]);

            if ($response->failed()) {
                Log::error('AI proxy error', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                    'url' => $url,
                ]);
                return response()->json([
                    'choices' => [
                        ['message' => ['content' => 'AI xizmatida vaqtinchalik nosozlik. Iltimos, keyinroq urinib ko‘ring.']]
                    ]
                ], 500);
            }

            $result = $response->json();

            // Hugging Face inference API response: [[{"generated_text":"..."}]]
            $text = '';
            if (is_array($result) && isset($result[0])) {
                $first = $result[0];
                if (is_array($first) && isset($first[0]['generated_text'])) {
                    $text = $first[0]['generated_text'];
                } elseif (isset($first['generated_text'])) {
                    $text = $first['generated_text'];
                }
            }

            // OpenAI-compatible formatga o‘girish
            return response()->json([
                'choices' => [
                    [
                        'message' => [
                            'role' => 'assistant',
                            'content' => trim($text) ?: 'Javob yaratib bo‘lmadi.',
                        ],
                        'finish_reason' => 'stop',
                        'index' => 0,
                    ]
                ],
            ]);
        } catch (\Exception $e) {
            Log::error('AI proxy exception', ['message' => $e->getMessage()]);
            return response()->json([
                'choices' => [
                    ['message' => ['content' => 'AI xizmatida xatolik yuz berdi. Iltimos, keyinroq urinib ko‘ring.']]
                ]
            ], 500);
        }
    }

    /**
     * OpenAI messages formatini Hugging Face promptiga aylantirish
     */
    private function messagesToPrompt(array $messages): string
    {
        $parts = [];
        foreach ($messages as $msg) {
            $role = $msg['role'] ?? 'user';
            $content = $msg['content'] ?? '';

            switch ($role) {
                case 'system':
                    $parts[] = "[INST] <<SYS>>\n{$content}\n<</SYS>>\n\n";
                    break;
                case 'user':
                    $parts[] = "{$content} [/INST]";
                    break;
                case 'assistant':
                    $parts[] = "{$content} </s><s>[INST] ";
                    break;
                default:
                    $parts[] = $content;
            }
        }

        // Agar system bo‘lmasa, umumiy shaklda qo‘shish
        $prompt = implode("\n", $parts);

        // Llama/Instruct formatini to‘g‘rilash
        if (!str_contains($prompt, '[INST]')) {
            $prompt = "[INST] {$prompt} [/INST]";
        }

        return $prompt;
    }

    /* ── RIASEC ── */

    public function quiz()
    {
        $history = Auth::check()
            ? RiasecResult::where('user_id', Auth::id())->latest()->take(10)->get()
            : collect();
        return view('chat.quiz', compact('history'));
    }
    public function answer()
    {
        return view('chat.answer');
    }
    public function think()
    {
        return redirect()->route('chat.answer');
    }

    public function riasec()
    {
        return view('chat.riasec');
    }

    public function saveRiasec(Request $request)
    {
        $request->validate([
            'r_score' => 'required|integer|min:0|max:100',
            'i_score' => 'required|integer|min:0|max:100',
            'a_score' => 'required|integer|min:0|max:100',
            's_score' => 'required|integer|min:0|max:100',
            'e_score' => 'required|integer|min:0|max:100',
            'c_score' => 'required|integer|min:0|max:100',
            'ai_recommendation' => 'nullable|string',
        ]);

        if (!Auth::check())
            return response()->json(['ok' => false], 401);

        $result = RiasecResult::create(array_merge(
            $request->only(['r_score', 'i_score', 'a_score', 's_score', 'e_score', 'c_score', 'ai_recommendation']),
            ['user_id' => Auth::id()]
        ));

        return response()->json(['ok' => true, 'id' => $result->id]);
    }
}