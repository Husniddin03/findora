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
use App\Services\SearchService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        if (!$session) {
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

        return response()->json([
            'ok' => true,
            'session_id' => $session->id,
        ]);
    }

    /* ── MARKAZ QIDIRISH — SearchService orqali to'g'ridan-to'g'ri DB ── */

    public function searchCenters(Request $request, SearchService $searchService)
    {
        $request->validate(['keywords' => 'required|array']);
        $kw = $request->keywords;

        // SearchService uchun parametrlarni tayyorlash
        $filters = [
            'searchText' => $kw['query'] ?? '',
            'per_page' => 5,
        ];

        if (!empty($kw['province'])) {
            $filters['searchText'] .= ' ' . $kw['province'];
        }

        if (!empty($kw['subjects'])) {
            $filters['searchText'] .= ' ' . implode(' ', $kw['subjects']);
        }

        try {
            // To'g'ridan-to'g'ri DB qidiruvi (HTTP API o'rniga)
            $paginator = $searchService->search($filters);
            $centers = collect($paginator->items());

            // AI uchun kontekst matni (qisqa va aniq, slug bilan)
            $context = $centers->map(function ($c) {
                $details = array_filter([
                    $c->type ? "Turi: {$c->type}" : null,
                    $c->province && $c->region ? "{$c->province}, {$c->region}" : null,
                    $c->address ? "Manzil: {$c->address}" : null,
                    $c->rating ? "Reyting: {$c->rating}" : null,
                    $c->student_count ? "O'quvchilar: {$c->student_count}" : null,
                    $c->premium ? "Premium" : null,
                ]);

                $slug = $c->slug ?? '';
                $url = $slug ? url('/center/' . $slug) : '#';

                return implode(' | ', array_filter([
                    "**[{$c->name}]({$url})**",
                    ...$details,
                ]));
            })->join("\n");

            return response()->json([
                'ok' => true,
                'context' => $context,
                'count' => $centers->count(),
                'raw_data' => $centers,
            ]);

        } catch (\Exception $e) {
            Log::error('Search centers error: ' . $e->getMessage());
            return response()->json([
                'ok' => false,
                'error' => 'Server error'
            ], 500);
        }
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
            ],
            'messages' => $session->messages->map(fn($m) => [
                'role' => $m->role,
                'content' => $m->content,
                'created_at' => $m->created_at->format('H:i'),
            ]),
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
                'last_message' => $s->lastMessage
                    ? mb_substr($s->lastMessage->content, 0, 55) : null,
                'created_at' => $s->created_at->format('d.m H:i'),
            ]);

        return response()->json(['ok' => true, 'sessions' => $sessions]);
    }

    /* ── GROQ AI PROXY — CORS muammosini oldini oladi ── */

    public function proxyAi(Request $request, SearchService $searchService)
    {
        $request->validate([
            'messages' => 'required|array',
            'temperature' => 'nullable|numeric',
            'max_tokens' => 'nullable|integer',
        ]);

        if (!config('services.groq.enabled')) {
            return response()->json([
                'choices' => [
                    ['message' => ['content' => 'AI xizmati vaqtinchalik o‘chirilgan.']]
                ]
            ], 503);
        }

        try {
            $client = \OpenAI::factory()
                ->withApiKey(config('services.groq.key'))
                ->withBaseUri('https://api.groq.com/openai/v1')
                ->make();

            // Tools definition for Function Calling
            $tools = [
                [
                    'type' => 'function',
                    'function' => [
                        'name' => 'get_learning_centers',
                        'description' => "O'quv markazlarini qidirish va ma'lumot olish. Viloyat, fan yoki markaz nomi bo'yicha qidirish mumkin.",
                        'parameters' => [
                            'type' => 'object',
                            'properties' => [
                                'searchText' => [
                                    'type' => 'string',
                                    'description' => 'Fan yoki markaz nomi (masalan: matematika, ingliz tili, dasturlash)',
                                ],
                                'province' => [
                                    'type' => 'string',
                                    'description' => 'Viloyat nomi (Toshkent, Samarqand, Buxoro, Andijon, Namangan, Farg\'ona, Qashqadaryo, Surxandaryo, Xorazm, Navoiy, Jizzax, Sirdaryo, Qoraqalpog\'iston)',
                                ],
                                'type' => [
                                    'type' => 'string',
                                    'description' => 'Markaz turi (masalan: IT kurslari, til kurslari, tayyorlov kurslari)',
                                ],
                            ],
                            'required' => [],
                        ],
                    ],
                ],
            ];

            $result = $client->chat()->create([
                'model' => config('services.groq.model'),
                'messages' => $request->messages,
                'temperature' => $request->input('temperature', 0.7),
                'max_tokens' => $request->input('max_tokens', 2000),
                'tools' => $tools,
                'tool_choice' => 'auto',
            ]);

            // Check if AI wants to call a tool
            $toolCalls = $result->choices[0]->message->toolCalls ?? [];

            if (!empty($toolCalls)) {
                foreach ($toolCalls as $toolCall) {
                    if ($toolCall->function->name === 'get_learning_centers') {
                        // Parse tool arguments
                        $args = json_decode($toolCall->function->arguments, true);

                        // To'g'ridan-to'g'ri DB qidiruvi (HTTP API o'rniga)
                        try {
                            $filters = array_merge($args, ['per_page' => 10]);
                            $paginator = $searchService->search($filters);
                            $foundCenters = collect($paginator->items());

                            if ($foundCenters->isNotEmpty()) {
                                // Format centers for AI
                                $centersText = $foundCenters->map(function ($c) {
                                    $url = $c->slug ? route('center', $c->slug) : '#';
                                    return "- {$c->name} ({$c->province}, {$c->region}) - Turi: {$c->type}, Reyting: {$c->rating}, URL: {$url}";
                                })->join("\n");

                                // Send tool response back to AI
                                $messages = $request->messages;
                                $messages[] = [
                                    'role' => 'assistant',
                                    'content' => null,
                                    'tool_calls' => [
                                        [
                                            'id' => $toolCall->id,
                                            'type' => $toolCall->type,
                                            'function' => [
                                                'name' => $toolCall->function->name,
                                                'arguments' => $toolCall->function->arguments,
                                            ],
                                        ]
                                    ],
                                ];
                                $messages[] = [
                                    'role' => 'tool',
                                    'tool_call_id' => $toolCall->id,
                                    'content' => "Topilgan o'quv markazlar:\n" . $centersText,
                                ];

                                // Get final response from AI with tool context
                                $finalResult = $client->chat()->create([
                                    'model' => config('services.groq.model'),
                                    'messages' => $messages,
                                    'temperature' => $request->input('temperature', 0.7),
                                    'max_tokens' => $request->input('max_tokens', 2000),
                                ]);

                                return response()->json([
                                    'choices' => [
                                        [
                                            'message' => [
                                                'role' => 'assistant',
                                                'content' => trim($finalResult->choices[0]->message->content) ?: 'Javob yaratib bo\'lmadi.',
                                            ],
                                            'finish_reason' => 'stop',
                                            'index' => 0,
                                        ]
                                    ],
                                ]);
                            }
                        } catch (\Exception $e) {
                            Log::error('SearchService error in proxyAi: ' . $e->getMessage());
                        }
                    }
                }
            }

            // No tool call or tool failed, return normal response
            return response()->json([
                'choices' => [
                    [
                        'message' => [
                            'role' => 'assistant',
                            'content' => trim($result->choices[0]->message->content) ?: "Javob yaratib bo'lmadi.",
                        ],
                        'finish_reason' => 'stop',
                        'index' => 0,
                    ]
                ],
            ]);
        } catch (\Exception $e) {
            Log::error('Groq AI proxy xatolik', ['message' => $e->getMessage()]);
            return response()->json([
                'choices' => [
                    ['message' => ['content' => 'AI xizmatida xatolik yuz berdi. Iltimos, keyinroq urinib ko\'ring.']]
                ]
            ], 500);
        }
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