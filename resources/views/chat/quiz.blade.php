@php
    $apiKey = env('DEFAULT_TOKEN');
@endphp

<x-layout>
<x-slot:title>{{ __('quiz.title') }}</x-slot:title>

<style>
    /* Enhanced AI response box styles */
    .ai-response-box {
        background: linear-gradient(135deg, rgba(30, 41, 59, 0.8), rgba(51, 65, 85, 0.8));
        border: 1px solid rgba(71, 85, 105, 0.5);
        border-radius: 12px;
        padding: 1.5rem;
        color: #e2e8f0;
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 0 0 1px rgba(71, 85, 105, 0.1);
        backdrop-filter: blur(8px);
        min-height: 120px;
    }
    .ai-response-box h2 {
        font-size: 1.25rem;
        color: #60a5fa;
        margin-bottom: 0.75rem;
        font-weight: 600;
    }
    .ai-response-box h3 {
        font-size: 1.1rem;
        color: #a78bfa;
        margin: 1rem 0 0.5rem 0;
        font-weight: 600;
    }
    .ai-response-box p {
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 0.75rem;
        color: #cbd5e1;
    }
    .ai-response-box ul {
        margin: 0.5rem 0 0.75rem 1.5rem;
    }
    .ai-response-box li {
        font-size: 0.9rem;
        line-height: 1.5;
        margin-bottom: 0.4rem;
        color: #cbd5e1;
    }
    .ai-response-box strong {
        color: #e2e8f0;
        font-weight: 600;
    }
    .ai-response-box code {
        background: rgba(0, 0, 0, 0.3);
        padding: 0.2rem 0.4rem;
        border-radius: 4px;
        font-size: 0.85rem;
        color: #a78bfa;
    }

    /* Enhanced chart styles */
    canvas#resultChart {
        background: linear-gradient(135deg, rgba(30, 41, 59, 0.6), rgba(51, 65, 85, 0.6));
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 0 0 1px rgba(71, 85, 105, 0.1);
        backdrop-filter: blur(8px);
    }

    /* Score bars animation */
    .score-row {
        animation: slideIn 0.5s ease-out forwards;
        opacity: 0;
    }
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateX(-20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
</style>

<div class="font-sans bg-slate-950 min-h-screen p-4 md:p-8 relative overflow-x-hidden dark-mode" id="quiz-container">
    <!-- Orbs -->
    <div class="fixed w-[500px] h-[500px] rounded-full pointer-events-none z-0 blur-[80px] opacity-35 bg-gradient-to-r from-blue-600 to-transparent -top-48 -left-24"></div>
    <div class="fixed w-[400px] h-[400px] rounded-full pointer-events-none z-0 blur-[80px] opacity-35 bg-gradient-to-r from-purple-600 to-transparent -bottom-24 -right-20"></div>

    <div class="max-w-4xl mx-auto relative z-10 flex flex-col gap-8">

        <!-- Hero -->
        <div class="text-center animate-fade-in">
            <a href="{{ route('chat.riasec') }}" class="inline-block">
                <div class="inline-block text-xs font-bold tracking-widest uppercase text-blue-500 bg-blue-500/10 border border-blue-500/25 rounded-full px-3 py-1 mb-4 hover:bg-blue-500/20 transition-colors">
                    {{ __('quiz.hero.badge') }}
                </div>
            </a>
            <h1 class="text-3xl md:text-5xl font-black text-slate-100 leading-tight mb-3">
                {{ __('quiz.hero.title') }}
            </h1>
            <p class="text-sm text-slate-400 max-w-lg mx-auto leading-relaxed">
                {{ __('quiz.hero.description') }}
            </p>
        </div>

        <!-- Legend -->
        <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
            <div class="bg-slate-800 border border-slate-700 rounded-lg p-3 flex items-center gap-2 text-xs animate-fade-in" style="animation-delay:.05s">
                <div class="w-2.5 h-2.5 bg-red-400 rounded-full flex-shrink-0"></div>
                <div>
                    <strong class="block text-slate-100 text-[11px]">{{ __('quiz.legend.realistic') }}</strong>
                    <span class="text-slate-400">{{ __('quiz.legend.realistic_desc') }}</span>
                </div>
            </div>
            <div class="bg-slate-800 border border-slate-700 rounded-lg p-3 flex items-center gap-2 text-xs animate-fade-in" style="animation-delay:.1s">
                <div class="w-2.5 h-2.5 bg-blue-500 rounded-full flex-shrink-0"></div>
                <div>
                    <strong class="block text-slate-100 text-[11px]">{{ __('quiz.legend.investigative') }}</strong>
                    <span class="text-slate-400">{{ __('quiz.legend.investigative_desc') }}</span>
                </div>
            </div>
            <div class="bg-slate-800 border border-slate-700 rounded-lg p-3 flex items-center gap-2 text-xs animate-fade-in" style="animation-delay:.15s">
                <div class="w-2.5 h-2.5 bg-purple-400 rounded-full flex-shrink-0"></div>
                <div>
                    <strong class="block text-slate-100 text-[11px]">{{ __('quiz.legend.artistic') }}</strong>
                    <span class="text-slate-400">{{ __('quiz.legend.artistic_desc') }}</span>
                </div>
            </div>
            <div class="bg-slate-800 border border-slate-700 rounded-lg p-3 flex items-center gap-2 text-xs animate-fade-in" style="animation-delay:.2s">
                <div class="w-2.5 h-2.5 bg-emerald-400 rounded-full flex-shrink-0"></div>
                <div>
                    <strong class="block text-slate-100 text-[11px]">{{ __('quiz.legend.social') }}</strong>
                    <span class="text-slate-400">{{ __('quiz.legend.social_desc') }}</span>
                </div>
            </div>
            <div class="bg-slate-800 border border-slate-700 rounded-lg p-3 flex items-center gap-2 text-xs animate-fade-in" style="animation-delay:.25s">
                <div class="w-2.5 h-2.5 bg-amber-400 rounded-full flex-shrink-0"></div>
                <div>
                    <strong class="block text-slate-100 text-[11px]">{{ __('quiz.legend.enterprising') }}</strong>
                    <span class="text-slate-400">{{ __('quiz.legend.enterprising_desc') }}</span>
                </div>
            </div>
            <div class="bg-slate-800 border border-slate-700 rounded-lg p-3 flex items-center gap-2 text-xs animate-fade-in" style="animation-delay:.3s">
                <div class="w-2.5 h-2.5 bg-slate-400 rounded-full flex-shrink-0"></div>
                <div>
                    <strong class="block text-slate-100 text-[11px]">{{ __('quiz.legend.conventional') }}</strong>
                    <span class="text-slate-400">{{ __('quiz.legend.conventional_desc') }}</span>
                </div>
            </div>
        </div>

        <!-- Questions -->
        <div class="bg-slate-800 border border-slate-700 rounded-2xl overflow-hidden animate-fade-in">
            <div class="p-5 flex items-center justify-between border-b border-slate-700 bg-slate-800/50">
                <h2 class="text-sm font-bold text-slate-100">{{ __('quiz.questions.title') }}</h2>
                <span class="text-xs text-slate-500 font-mono" id="progress-label">{{ __('quiz.questions.progress') }}</span>
            </div>
            <div class="h-1 bg-slate-700">
                <div class="h-full bg-gradient-to-r from-blue-500 to-purple-500 transition-all duration-400" id="progress-fill" style="width: 0%"></div>
            </div>

            <div class="p-5 flex flex-col gap-2" id="questions-list"></div>

            <div class="p-5 border-t border-slate-700">
                <button class="w-full py-4 bg-gradient-to-r from-blue-500 to-purple-500 rounded-xl text-white font-bold text-base cursor-pointer transition-all duration-250 shadow-lg shadow-blue-500/30 flex items-center justify-center gap-2 hover:shadow-xl hover:shadow-blue-500/40 hover:-translate-y-0.5 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none" onclick="submitTest()" id="submit-btn">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    {{ __('quiz.submit') }}
                </button>
            </div>
        </div>

        <!-- Result -->
        <div class="bg-slate-800 border border-slate-700 rounded-2xl overflow-hidden hidden animate-fade-in" id="result-card">
            <div class="p-6 bg-gradient-to-r from-blue-500/10 to-purple-500/10 border-b border-slate-700 text-center">
                <h2 class="text-xl font-black text-slate-100 mb-1">{{ __('quiz.result.title') }}</h2>
                <p class="text-sm text-slate-400">{{ __('quiz.result.subtitle') }}</p>
            </div>

            <!-- Score bars -->
            <div class="flex flex-col gap-3 p-0" id="score-bars"></div>

            <!-- Chart -->
            <div class="p-6 pt-5">
                <canvas id="resultChart" style="max-height:280px;"></canvas>
            </div>

            <!-- AI Tavsiya -->
            <div class="p-6 border-t border-slate-700">
                <div class="flex items-center gap-2 text-xs font-bold tracking-wide uppercase text-slate-500 mb-4">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M12 16v-4M12 8h.01"/>
                    </svg>
                    {{ __('quiz.ai.title') }}
                </div>
                <div class="ai-response-box" id="ai-response">
                    <div class="flex gap-1 items-center p-1">
                        <span class="w-1.5 h-1.5 bg-blue-500 rounded-full animate-bounce"></span>
                        <span class="w-1.5 h-1.5 bg-blue-500 rounded-full animate-bounce" style="animation-delay:.2s"></span>
                        <span class="w-1.5 h-1.5 bg-blue-500 rounded-full animate-bounce" style="animation-delay:.4s"></span>
                    </div>
                </div>
            </div>

            <button class="mx-6 mb-6 w-[calc(100%-3rem)] py-3 border border-slate-700 rounded-lg bg-transparent text-slate-400 font-sans text-sm cursor-pointer transition-all duration-200 hover:border-blue-500 hover:text-blue-500" onclick="resetTest()">↺ {{ __('quiz.reset') }}</button>
        </div>

        <!-- History table -->
        @if($history->count())
        <div class="bg-slate-800 border border-slate-700 rounded-2xl overflow-hidden animate-fade-in overflow-x-auto">
            <div class="p-4 border-b border-slate-700 flex items-center gap-2 text-xs font-bold tracking-wide uppercase text-slate-500">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/>
                    <path d="M12 6v6l4 2"/>
                </svg>
                <!-- Oldingi natijalar ({{ $history->count() }} ta) -->
                 {{__('quiz.history.title', ['count' => $history->count()])}}
            </div>
            <table class="w-full border-collapse text-sm">
                <thead>
                    <tr>
                        <th class="p-3 text-left font-semibold text-slate-500 text-[10px] tracking-wide uppercase bg-slate-800/50 border-b border-slate-700">#</th>
                        <th class="p-3 text-left font-semibold text-slate-500 text-[10px] tracking-wide uppercase bg-slate-800/50 border-b border-slate-700">{{ __('quiz.history.headers.results') }}</th>
                        <th class="p-3 text-left font-semibold text-slate-500 text-[10px] tracking-wide uppercase bg-slate-800/50 border-b border-slate-700">{{ __('quiz.history.headers.best_type') }}</th>
                        <th class="p-3 text-left font-semibold text-slate-500 text-[10px] tracking-wide uppercase bg-slate-800/50 border-b border-slate-700">{{ __('quiz.history.headers.date') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($history as $i => $r)
                    @php
                        $scores = ['R'=>$r->r_score,'I'=>$r->i_score,'A'=>$r->a_score,'S'=>$r->s_score,'E'=>$r->e_score,'C'=>$r->c_score];
                        arsort($scores);
                        $top = array_key_first($scores);
                        $colors = ['R'=>'#f87171','I'=>'#5b8fff','A'=>'#c084fc','S'=>'#34d399','E'=>'#fbbf24','C'=>'#94a3b8'];
                    @endphp
                    <tr>
                        <td class="p-3 text-slate-500 text-[10px] font-mono">{{ $i+1 }}</td>
                        <td class="p-3">
                            <div class="flex gap-1">
                                @foreach(['R','I','A','S','E','C'] as $k)
                                <span class="text-[10px] font-bold px-1.5 py-0.5 rounded font-mono" style="background:{{ $colors[$k] }}22;color:{{ $colors[$k] }}">
                                    {{ $k }}{{ $r->{strtolower($k).'_score'} }}%
                                </span>
                                @endforeach
                            </div>
                        </td>
                        <td class="p-3">
                            <span class="text-[11px] font-bold px-1.5 py-0.5 rounded font-mono" style="background:{{ $colors[$top] }}22;color:{{ $colors[$top] }}">
                                {{ $top }} — {{ $scores[$top] }}%
                            </span>
                        </td>
                        <td class="p-3 text-[11px] text-slate-500 whitespace-nowrap">
                            {{ $r->created_at->format('d.m.Y H:i') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
<script src="https://js.puter.com/v2/"></script>

<script>
const SAVE_URL = '{{ route('riasec.save') }}';
const CSRF     = '{{ csrf_token() }}';
const URL_AI   = '{{ route('chat.ai-proxy') }}';
const API_KEY  = '{{ $apiKey }}';

const questions = [
    "{{ __('quiz.question_list.0') }}",
    "{{ __('quiz.question_list.1') }}",
    "{{ __('quiz.question_list.2') }}",
    "{{ __('quiz.question_list.3') }}",
    "{{ __('quiz.question_list.4') }}",
    "{{ __('quiz.question_list.5') }}",
    "{{ __('quiz.question_list.6') }}",
    "{{ __('quiz.question_list.7') }}",
    "{{ __('quiz.question_list.8') }}",
    "{{ __('quiz.question_list.9') }}",
    "{{ __('quiz.question_list.10') }}",
    "{{ __('quiz.question_list.11') }}",
    "{{ __('quiz.question_list.12') }}",
    "{{ __('quiz.question_list.13') }}",
    "{{ __('quiz.question_list.14') }}",
    "{{ __('quiz.question_list.15') }}",
    "{{ __('quiz.question_list.16') }}",
    "{{ __('quiz.question_list.17') }}",
    "{{ __('quiz.question_list.18') }}",
    "{{ __('quiz.question_list.19') }}",
    "{{ __('quiz.question_list.20') }}",
    "{{ __('quiz.question_list.21') }}",
    "{{ __('quiz.question_list.22') }}",
    "{{ __('quiz.question_list.23') }}",
];

const groups  = { R:[0,1,2,3], I:[4,5,6,7], A:[8,9,10,11], S:[12,13,14,15], E:[16,17,18,19], C:[20,21,22,23] };
const typeColors = { R:'#f87171', I:'#5b8fff', A:'#c084fc', S:'#34d399', E:'#fbbf24', C:'#94a3b8' };
const typeNames  = { R:'Realistic',I:'Investigative',A:'Artistic',S:'Social',E:'Enterprising',C:'Conventional' };
const typeDesc   = { R:'Amaliy, texnika', I:'Tadqiqot, fan', A:'San\'at, ijod', S:'Ijtimoiy yordam', E:'Biznes, liderlik', C:'Tartib, tizim' };

let answeredCount = 0;
let chart = null;

// Initialize theme on load
window.addEventListener('load', () => {
    initTheme();
    addThemeToggle();
});

// Build questions
const list = document.getElementById('questions-list');
questions.forEach((q, i) => {
    const div = document.createElement('div');
    div.className = 'question-item flex items-center justify-between gap-4 p-4 rounded-lg bg-slate-900 border border-slate-700 transition-all duration-200';
    div.id = `q-item-${i}`;

    // Detect type
    const type = Object.keys(groups).find(k => groups[k].includes(i));
    const dot = `<span class="w-1.5 h-1.5 rounded-full bg-red-400 inline-block mr-1 flex-shrink-0" style="background:${typeColors[type]}"></span>`;

    div.innerHTML = `
        <span class="question-num text-[10px] font-bold text-slate-500 mr-0.5 font-mono flex-shrink-0">${String(i+1).padStart(2,'0')}</span>
        ${dot}
        <span class="question-text text-sm text-slate-400 leading-relaxed flex-1">${q}</span>
        <div class="radio-group flex gap-1 flex-shrink-0 md:flex-row flex-col">
            <label class="radio-pill flex items-center gap-1 px-3 py-1 rounded-full border border-slate-600 bg-slate-800 cursor-pointer text-xs text-slate-500 transition-all duration-180 hover:border-blue-500 hover:text-blue-500" id="pill-yes-${i}" onclick="pickAnswer(${i},1)">
                <input type="radio" name="q${i}" value="1" class="hidden">✓ {{ __('quiz.buttons.yes') }}
            </label>
            <label class="radio-pill flex items-center gap-1 px-3 py-1 rounded-full border border-slate-600 bg-slate-800 cursor-pointer text-xs text-slate-500 transition-all duration-180 hover:border-blue-500 hover:text-blue-500" id="pill-no-${i}" onclick="pickAnswer(${i},0)">
                <input type="radio" name="q${i}" value="0" class="hidden">✗ {{ __('quiz.buttons.no') }}
            </label>
        </div>`;
    list.appendChild(div);
});

function pickAnswer(i, val) {
    const prevEl = document.querySelector(`input[name="q${i}"]:checked`);
    const wasAnswered = !!prevEl;

    document.querySelectorAll(`input[name="q${i}"]`).forEach(r => r.checked = false);
    document.querySelector(`input[name="q${i}"][value="${val}"]`).checked = true;

    const yesP = document.getElementById(`pill-yes-${i}`);
    const noP  = document.getElementById(`pill-no-${i}`);
    yesP.className = val === 1 
        ? 'radio-pill flex items-center gap-1 px-3 py-1 rounded-full border border-emerald-500 bg-emerald-500/10 cursor-pointer text-xs text-emerald-500 transition-all duration-180' 
        : 'radio-pill flex items-center gap-1 px-3 py-1 rounded-full border border-slate-600 bg-slate-800 cursor-pointer text-xs text-slate-500 transition-all duration-180 hover:border-blue-500 hover:text-blue-500';
    noP.className  = val === 0 
        ? 'radio-pill flex items-center gap-1 px-3 py-1 rounded-full border border-slate-500 bg-slate-700/30 cursor-pointer text-xs text-slate-500 transition-all duration-180' 
        : 'radio-pill flex items-center gap-1 px-3 py-1 rounded-full border border-slate-600 bg-slate-800 cursor-pointer text-xs text-slate-500 transition-all duration-180 hover:border-blue-500 hover:text-blue-500';

    document.getElementById(`q-item-${i}`).classList.add('border-blue-500/30', 'bg-blue-500/4');
    document.getElementById(`q-item-${i}`).classList.remove('border-slate-700', 'bg-slate-900');

    if (!wasAnswered) {
        answeredCount++;
        updateProgress();
    }
}

function updateProgress() {
    document.getElementById('progress-label').textContent = `${answeredCount} / 24`;
    document.getElementById('progress-fill').style.width = (answeredCount / 24 * 100) + '%';
}

function submitTest() {
    if (answeredCount < 24) {
        // Javob berilmagan birinchi savolga scroll qilish
        for (let i = 0; i < 24; i++) {
            if (!document.querySelector(`input[name="q${i}"]:checked`)) {
                document.getElementById(`q-item-${i}`).scrollIntoView({ behavior:'smooth', block:'center' });
                const item = document.getElementById(`q-item-${i}`);
                item.classList.remove('border-slate-700', 'bg-slate-900');
                item.classList.add('border-red-400', 'bg-red-400/10');
                setTimeout(() => {
                    item.classList.remove('border-red-400', 'bg-red-400/10');
                    item.classList.add('border-slate-700', 'bg-slate-900');
                }, 1500);
                break;
            }
        }
        return;
    }

    // Hisoblash
    const scores = {};
    for (const t in groups) {
        scores[t] = groups[t].reduce((sum, i) => {
            const el = document.querySelector(`input[name="q${i}"]:checked`);
            return sum + (el ? parseInt(el.value) : 0);
        }, 0) / 4 * 100;
    }

    // Natijani saqlash
    saveResult(scores);

    showResult(scores);
}

async function saveResult(scores) {
    try {
        const response = await fetch(SAVE_URL, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': CSRF
            },
            body: JSON.stringify({
                r_score: Math.round(scores.R),
                i_score: Math.round(scores.I),
                a_score: Math.round(scores.A),
                s_score: Math.round(scores.S),
                e_score: Math.round(scores.E),
                c_score: Math.round(scores.C)
            })
        });
        const data = await response.json();
        if (!data.ok) {
            console.error('Save failed:', data.error);
        }
    } catch (err) {
        console.error('Save error:', err);
    }
}

function showResult(scores) {
    const card = document.getElementById('result-card');
    card.classList.remove('hidden');
    card.classList.add('block');
    card.scrollIntoView({ behavior:'smooth', block:'start' });

    // Score bars
    const barsEl = document.getElementById('score-bars');
    barsEl.innerHTML = '';
    let delay = 0;
    for (const t in scores) {
        const pct = Math.round(scores[t]);
        const row = document.createElement('div');
        row.className = 'score-row flex items-center gap-3';
        row.style.animationDelay = `${delay}ms`;
        row.innerHTML = `
            <div class="score-label w-32 flex-shrink-0 text-xs text-slate-400">
                <strong class="text-slate-100">${t}</strong> ${typeDesc[t]}
            </div>
            <div class="score-track flex-1 h-2.5 bg-slate-900 rounded-full overflow-hidden">
                <div class="score-fill h-full rounded-full transition-all duration-1000 ease-out" id="fill-${t}" style="background:${typeColors[t]};width:0%"></div>
            </div>
            <div class="score-pct w-9 text-right text-xs font-bold font-mono" style="color:${typeColors[t]}">${pct}%</div>`;
        barsEl.appendChild(row);
        setTimeout(() => { document.getElementById(`fill-${t}`).style.width = pct + '%'; }, 100 + delay);
        delay += 100;
    }

    // Chart
    if (chart) chart.destroy();
    chart = new Chart(document.getElementById('resultChart'), {
        type: 'bar',
        data: {
            labels: Object.keys(scores).map(k => `${k}\n${typeNames[k]}`),
            datasets: [{
                data: Object.values(scores).map(v => Math.round(v)),
                backgroundColor: Object.keys(scores).map(k => typeColors[k] + 'cc'),
                borderColor:     Object.keys(scores).map(k => typeColors[k]),
                borderWidth: 2,
                borderRadius: 8,
                borderSkipped: false,
                hoverBackgroundColor: Object.keys(scores).map(k => typeColors[k])
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            animation: {
                duration: 1000,
                easing: 'easeOutQuart'
            },
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: 'rgba(15, 23, 42, 0.9)',
                    titleColor: '#e2e8f0',
                    bodyColor: '#cbd5e1',
                    borderColor: 'rgba(71, 85, 105, 0.5)',
                    borderWidth: 1,
                    padding: 12,
                    displayColors: true,
                    callbacks: {
                        label: ctx => ctx.parsed.y + '%'
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100,
                    ticks: {
                        callback: v => v+'%',
                        color: '#94a3b8',
                        font: { size: 11, family: 'Inter, system-ui' }
                    },
                    grid: {
                        color: 'rgba(71, 85, 105, 0.2)',
                        drawBorder: false
                    }
                },
                x: {
                    ticks: {
                        color: '#cbd5e1',
                        font: { size: 11, family: 'Inter, system-ui' }
                    },
                    grid: { display: false }
                }
            }
        }
    });

    // AI recommendation
    askAI(scores);
}

async function askAI(scores) {
    const aiBox = document.getElementById('ai-response');
    aiBox.innerHTML = '<div class="flex gap-1 items-center p-1"><span class="w-1.5 h-1.5 bg-blue-500 rounded-full animate-bounce"></span><span class="w-1.5 h-1.5 bg-blue-500 rounded-full animate-bounce" style="animation-delay:.2s"></span><span class="w-1.5 h-1.5 bg-blue-500 rounded-full animate-bounce" style="animation-delay:.4s"></span></div>';

    const sorted = Object.entries(scores).sort((a, b) => b[1] - a[1]);

    const prompt = `Siz RIASEC karyera testi natijalarini tahlil qiluvchi AI maslahatchisiz.

Foydalanuvchi natijalari:
- Realistic (R): ${Math.round(scores.R)}%
- Investigative (I): ${Math.round(scores.I)}%
- Artistic (A): ${Math.round(scores.A)}%
- Social (S): ${Math.round(scores.S)}%
- Enterprising (E): ${Math.round(scores.E)}%
- Conventional (C): ${Math.round(scores.C)}%

Eng yuqori natijalar: ${sorted[0][0]} (${Math.round(sorted[0][1])}%), ${sorted[1][0]} (${Math.round(sorted[1][1])}%), ${sorted[2][0]} (${Math.round(sorted[2][1])}%)

Javob formati (faqat O'zbek tilida):
## 📊 Tahlil
[3-6 ta gap]
## 💼 Karyera yo'nalishlari
[5-6 ta karyera]
## 🎓 Rivojlanish yo'nalishlari
[3-4 ta yo'nalish]
## ⭐ Kuchli tomonlar
[3 ta kuchli tomon]
## 📈 Takliflar
[2 ta taklif]`;

    try {
        const response = await fetch(URL_AI, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': CSRF
            },
            body: JSON.stringify({
                messages: [
                    {
                        role: 'system',
                        content: 'Siz RIASEC karyera testi natijalarini tahlil qiluvchi professional AI maslahatchisiz. Javoblarni faqat O\'zbek tilida bering.'
                    },
                    {
                        role: 'user',
                        content: prompt
                    }
                ],
                max_tokens: 1500,
                temperature: 0.7
            })
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const data = await response.json();
        const aiText = data?.choices?.[0]?.message?.content || '';

        if (aiText) {
            aiBox.innerHTML = marked.parse(aiText);
        } else {
            aiBox.innerHTML = '<span class="text-red-400">❌ AI javobi olinmadi.</span>';
        }
    } catch (err) {
        aiBox.innerHTML = '<span class="text-red-400">❌ Xatolik yuz berdi. Iltimos, keyinroq urinib ko\'ring.</span>';
        console.error(err);
    }
}

function resetTest() {
    document.querySelectorAll('input[type="radio"]').forEach(r => r.checked = false);
    document.querySelectorAll('.radio-pill').forEach(p => {
        p.className = 'radio-pill flex items-center gap-1 px-3 py-1 rounded-full border border-slate-600 bg-slate-800 cursor-pointer text-xs text-slate-500 transition-all duration-180 hover:border-blue-500 hover:text-blue-500';
    });
    document.querySelectorAll('.question-item').forEach(i => {
        i.classList.remove('border-blue-500/30', 'bg-blue-500/4');
        i.classList.add('border-slate-700', 'bg-slate-900');
    });
    answeredCount = 0;
    updateProgress();
    document.getElementById('result-card').classList.add('hidden');
    document.getElementById('result-card').classList.remove('block');
    window.scrollTo({ top: 0, behavior: 'smooth' });
}
</script>

</x-layout>