<x-layout>
    <x-slot:title>{{ __('chat.title') }}</x-slot:title>

    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 transition-colors duration-300">
        <!-- Mobile sidebar overlay -->
        <div x-data="{ sidebarOpen: false }" 
             x-show="sidebarOpen" 
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-gray-600 bg-opacity-75 z-40 lg:hidden"
             @click="sidebarOpen = false">
        </div>

        <div class="flex h-screen">
            <!-- Sidebar -->
            <aside x-data="{ sidebarOpen: false }" 
                   :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
                   class="fixed inset-y-0 left-0 z-50 w-80 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0">
                
                <!-- Sidebar Header -->
                <div class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('chat.sidebar.title') }}</h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400">AI Assistant</p>
                        </div>
                    </div>
                    <button @click="sidebarOpen = false" class="lg:hidden p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- New Chat Button -->
                <div class="p-4">
                    <button onclick="newChat()" class="w-full flex items-center justify-center space-x-2 px-4 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-lg hover:from-indigo-600 hover:to-purple-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span class="font-medium">{{ __('chat.sidebar.new_chat') }}</span>
                    </button>
                </div>

                <!-- Sessions List -->
                <div class="flex-1 overflow-y-auto px-4 pb-4">
                    <h3 class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3">{{ __('chat.sidebar.history') }}</h3>
                    <div class="space-y-2" id="sess-list">
                        @forelse($sessions as $s)
                            <div class="group cursor-pointer rounded-lg p-3 transition-all duration-200 hover:bg-gray-50 dark:hover:bg-gray-700 {{ $currentSession?->id == $s->id ? 'bg-indigo-50 dark:bg-indigo-900/20 border border-indigo-200 dark:border-indigo-700' : 'border border-transparent' }}"
                                 id="si-{{ $s->id }}" onclick="loadSess({{ $s->id }})">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ $s->title }}</p>
                                        <div class="flex items-center mt-1 space-x-2">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $s->status === 'active' ? 'bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }}">
                                                {{ $s->status === 'active' ? 'Faol' : 'Yopiq' }}
                                            </span>
                                            <span class="text-xs text-gray-500 dark:text-gray-400">{{ $s->created_at->format('d.m') }}</span>
                                        </div>
                                        @if ($s->lastMessage)
                                            <p class="text-xs text-gray-500 dark:text-gray-400 truncate mt-1">{{ Str::limit($s->lastMessage->content, 48) }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div id="sess-empty" class="text-center py-8">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">{{ __('chat.sidebar.no_sessions') }}</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </aside>

            <!-- Main Content -->
            <div class="flex-1 flex flex-col">
                <!-- Header -->
                <header class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <!-- Mobile menu button -->
                            <button @click="sidebarOpen = true" class="lg:hidden p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button>
                            
                            <div>
                                <h1 class="text-xl font-bold text-gray-900 dark:text-white" id="tb-title">
                                    {{ $currentSession?->title ?? __('chat.topbar.title_default') }}
                                </h1>
                                <p class="text-sm text-gray-500 dark:text-gray-400" id="tb-sub">
                                    {{ $currentSession ? __('chat.topbar.subtitle') : '' }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4">
                            <!-- Theme toggle -->
                            <button onclick="toggleTheme()" class="p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <svg class="w-5 h-5 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                <svg class="w-5 h-5 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </header>

                <!-- Messages area -->
                <div class="flex-1 overflow-y-auto px-6 py-6" id="msgs">
                    <!-- Search indicator -->
                    <div id="search-indicator" class="hidden mb-4 p-3 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg">
                        <div class="flex items-center space-x-2">
                            <div class="flex space-x-1">
                                <div class="w-2 h-2 bg-blue-600 rounded-full animate-bounce"></div>
                                <div class="w-2 h-2 bg-blue-600 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                                <div class="w-2 h-2 bg-blue-600 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                            </div>
                            <span class="text-sm text-blue-800 dark:text-blue-200" id="search-text">{{ __('chat.search.indicator') }}</span>
                        </div>
                    </div>

                    @if ($messages->isEmpty())
                        <!-- Empty state -->
                        <div class="flex-1 flex flex-col items-center justify-center text-center py-12" id="empty-state">
                            <div class="w-16 h-16 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center mb-6">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ __('chat.empty.greeting') }}</h3>
                            <p class="text-gray-600 dark:text-gray-400 max-w-md mb-8">{{ __('chat.empty.description') }}</p>
                            
                            <!-- Suggestion buttons -->
                            <div class="flex flex-wrap gap-2 justify-center max-w-2xl">
                                <button onclick="fillIn(this.textContent)" class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full text-sm hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                                    {{ __('chat.empty.suggestions.math_courses') }}
                                </button>
                                <button onclick="fillIn(this.textContent)" class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full text-sm hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                                    {{ __('chat.empty.suggestions.english_learning') }}
                                </button>
                                <button onclick="fillIn(this.textContent)" class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full text-sm hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                                    {{ __('chat.empty.suggestions.programming_courses') }}
                                </button>
                                <button onclick="fillIn(this.textContent)" class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full text-sm hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                                    Arzon o'quv markazlar
                                </button>
                                <button onclick="fillIn(this.textContent)" class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full text-sm hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                                    Samarqandda IT kurslari
                                </button>
                                <button onclick="fillIn(this.textContent)" class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full text-sm hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                                    {{ __('chat.empty.suggestions.best_region') }}
                                </button>
                            </div>
                        </div>
                    @else
                        <!-- Messages -->
                        @foreach ($messages as $m)
                            <div class="flex {{ $m->role === 'user' ? 'justify-end' : 'justify-start' }} mb-4 animate-fade-in">
                                <div class="flex items-start space-x-3 max-w-3xl {{ $m->role === 'user' ? 'flex-row-reverse space-x-reverse' : '' }}">
                                    <!-- Avatar -->
                                    <div class="flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center {{ $m->role === 'user' ? 'bg-gradient-to-r from-indigo-500 to-purple-600' : 'bg-gray-200 dark:bg-gray-700' }}">
                                        <span class="text-sm font-medium {{ $m->role === 'user' ? 'text-white' : 'text-gray-600 dark:text-gray-300' }}">
                                            {{ $m->role === 'user' ? 'S' : 'AI' }}
                                        </span>
                                    </div>
                                    
                                    <!-- Message bubble -->
                                    <div class="flex-1">
                                        <div class="inline-block max-w-full px-4 py-3 rounded-2xl {{ $m->role === 'user' ? 'bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-br-none' : 'bg-white dark:bg-gray-800 text-gray-900 dark:text-white border border-gray-200 dark:border-gray-700 rounded-bl-none' }}">
                                            @if ($m->role === 'assistant')
                                                <div class="prose prose-sm dark:prose-invert max-w-none">
                                                    {!! \Illuminate\Support\Str::markdown($m->content) !!}
                                                </div>
                                            @else
                                                <p class="text-sm whitespace-pre-wrap">{{ $m->content }}</p>
                                            @endif
                                        </div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 {{ $m->role === 'user' ? 'text-right' : '' }}">
                                            {{ $m->created_at->format('H:i') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <!-- Input area -->
                <div class="border-t border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 px-6 py-4">
                    <div class="flex items-end space-x-4">
                        <div class="flex-1">
                            <textarea id="inp"
                                class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-indigo-500 focus:border-transparent resize-none"
                                placeholder="{{ __('chat.search.placeholder') }}"
                                rows="1"></textarea>
                            <div class="flex justify-between items-center mt-2">
                                <span class="text-xs text-gray-500 dark:text-gray-400">
                                    <kbd class="px-2 py-1 bg-gray-100 dark:bg-gray-700 rounded text-xs">Enter</kbd> {{ __('chat.input.send_btn') }} · 
                                    <kbd class="px-2 py-1 bg-gray-100 dark:bg-gray-700 rounded text-xs">Shift+Enter</kbd> {{ __('chat.input.keyboard_shortcut') }}
                                </span>
                                <span class="text-xs text-gray-500 dark:text-gray-400 font-mono" id="char-count">0/2000</span>
                            </div>
                        </div>
                        <button id="send-btn" 
                            onclick="send()"
                            class="flex-shrink-0 w-12 h-12 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-lg hover:from-indigo-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200 transform hover:scale-105">
                            <svg class="w-5 h-5 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>

    <script>
        /* ═══════════════════════════════════════════
        SOZLAMALAR
        ═══════════════════════════════════════════ */
        const CSRF = '{{ csrf_token() }}';
        const URL_SAVE = '{{ route('chat.save') }}';
        const URL_NEW = '{{ route('chat.new-session') }}';
        const URL_SESSION = '{{ url('chat/session') }}';
        const URL_SEARCH = '{{ route('chat.search-centers') }}';

        // Groq AI sozlamalari
        const AI_ENABLED = {{ config('services.groq.enabled') ? 'true' : 'false' }};
        const URL_AI = '{{ route('chat.ai-proxy') }}';

        let currentSID = {{ $currentSession?->id ?? 'null' }};

        // AI uchun mahalliy tarix (oxirgi 6 xabar, har biri max 400 belgi)
        let localHistory = [];
        @foreach ($messages->take(6) as $m)
            localHistory.push({
                role: '{{ $m->role }}',
                content: @json(mb_substr($m->content, 0, 400))
            });
        @endforeach

        /* ═══════════════════════════════════════════
           YANGI SUHBAT
        ═══════════════════════════════════════════ */
        async function newChat() {
            const r = await api(URL_NEW, 'POST', {});
            if (r.ok) location.href = '{{ route('chat.chat') }}?session=' + r.session_id;
        }

        /* ═══════════════════════════════════════════
           SESSIYA YUKLASH
        ═══════════════════════════════════════════ */
        async function loadSess(id) {
            if (id === currentSID) return;

            // Active state
            document.querySelectorAll('#sess-list > div').forEach(e => {
                e.classList.remove('bg-indigo-50', 'dark:bg-indigo-900/20', 'border-indigo-200', 'dark:border-indigo-700');
                e.classList.add('border-transparent');
            });
            const activeEl = document.getElementById('si-' + id);
            if (activeEl) {
                activeEl.classList.remove('border-transparent');
                activeEl.classList.add('bg-indigo-50', 'dark:bg-indigo-900/20', 'border-indigo-200', 'dark:border-indigo-700');
            }

            const d = await api(URL_SESSION + '/' + id);
            if (!d.ok) return;

            currentSID = id;

            // Tarixni yangilash
            localHistory = d.messages.slice(-6).map(m => ({
                role: m.role,
                content: m.content.substring(0, 400)
            }));

            // Xabarlarni render qilish
            const box = document.getElementById('msgs');
            box.innerHTML = '';

            // Qidiruv indikatorini qayta qo'shish
            const ind = document.createElement('div');
            ind.className = 'hidden mb-4 p-3 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg';
            ind.id = 'search-indicator';
            ind.innerHTML = `
                <div class="flex items-center space-x-2">
                    <div class="flex space-x-1">
                        <div class="w-2 h-2 bg-blue-600 rounded-full animate-bounce"></div>
                        <div class="w-2 h-2 bg-blue-600 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                        <div class="w-2 h-2 bg-blue-600 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                    </div>
                    <span class="text-sm text-blue-800 dark:text-blue-200" id="search-text">Markazlar qidirilmoqda...</span>
                </div>`;
            box.appendChild(ind);

            if (d.messages.length === 0) {
                box.innerHTML += `
                    <div class="flex-1 flex flex-col items-center justify-center text-center py-12" id="empty-state">
                        <div class="w-16 h-16 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Bo'sh suhbat</h3>
                        <p class="text-gray-600 dark:text-gray-400 max-w-md mb-8">Savol yozing...</p>
                    </div>`;
            } else {
                d.messages.forEach(m => appendMsg(m.role, m.content, m.created_at, false));
            }

            document.getElementById('tb-title').textContent = d.session.title;
            scrollBot();
        }

        /* ═══════════════════════════════════════════
           INPUT BOSHQARUV
        ═══════════════════════════════════════════ */
        const inp = document.getElementById('inp');

        inp.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = Math.min(this.scrollHeight, 130) + 'px';
            document.getElementById('char-count').textContent = this.value.length + '/2000';
        });

        inp.addEventListener('keydown', e => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                send();
            }
        });

        function fillIn(text) {
            inp.value = text;
            inp.focus();
            inp.dispatchEvent(new Event('input'));
        }

        /* ═══════════════════════════════════════════
           KEYWORD EXTRACTION
           Faqat markaz qidirish kerakligini aniqlash
           va qidiruv parametrlarini chiqarish
        ═══════════════════════════════════════════ */
        async function extractKeywords(userMsg) {
            if (!AI_ENABLED) {
                return {
                    needs_search: false,
                    province: null,
                    subjects: [],
                    query: ''
                };
            }

            const prompt = `Sen o'quv markaz qidiruv tizimining filter modulisan.
            Quyidagi foydalanuvchi so'rovini tahlil qil va FAQAT JSON qaytargin. Hech qanday izoh, matn yoki kod bloki yozma.

            Qaytariladigan JSON formati:
            {
            "needs_search": true,
            "province": "Toshkent",
            "subjects": ["matematika", "fizika"],
            "query": "matematika kursi"
            }

            Qoidalar:
            - needs_search: agar so'rov o'quv markaz, kurs, dars, ta'lim, o'qish, o'qituvchi bilan bog'liq bo'lsa TRUE, aks holda FALSE
            - province: faqat quyidagilardan biri yoki null:
            Toshkent, Samarqand, Buxoro, Andijon, Namangan, Farg'ona,
            Qashqadaryo, Surxandaryo, Xorazm, Navoiy, Jizzax, Sirdaryo, Qoraqalpog'iston
            - subjects: o'qitiladigan fanlar ro'yxati (matematika, ingliz tili, dasturlash, fizika va h.k.) — topilmasa bo'sh massiv
            - query: qidiruv uchun 2-4 ta eng muhim kalit so'z (o'zbek tilida)

            Foydalanuvchi so'rovi: "${userMsg}"`;

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
                                role: 'user',
                                content: prompt
                            }
                        ],
                        max_tokens: 200,
                        temperature: 0.1
                    })
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const data = await response.json();
                const text = data?.choices?.[0]?.message?.content || '';
                const clean = text.replace(/^```json\s*/i, '').replace(/^```\s*/i, '').replace(/\s*```$/i, '').trim();
                
                return JSON.parse(clean);
            } catch (error) {
                console.error('Keyword extraction error:', error);
                return {
                    needs_search: false,
                    province: null,
                    subjects: [],
                    query: ''
                };
            }
        } /* ═══════════════════════════════════════════
       MARKAZLARNI QIDIRISH (MySQL LIKE)
        ═══════════════════════════════════════════ */
        async function searchCenters(kw) {
            showSearchIndicator('Markazlar qidirilmoqda...');
            try {
                const r = await api(URL_SEARCH, 'POST', {
                    keywords: kw
                });
                hideSearchIndicator();
                return (r.ok && r.count > 0) ? r : null;
            } catch {
                hideSearchIndicator();
                return null;
            }
        }

        function showSearchIndicator(text) {
            const el = document.getElementById('search-indicator');
            const tx = document.getElementById('search-text');
            if (el) {
                el.classList.remove('hidden');
                el.classList.add('flex');
                if (tx) tx.textContent = text;
            }
        }

        function hideSearchIndicator() {
            const el = document.getElementById('search-indicator');
            if (el) {
                el.classList.add('hidden');
                el.classList.remove('flex');
            }
        }

        /* ═══════════════════════════════════════════
        ASOSIY YUBORISH FUNKSIYASI
        ═══════════════════════════════════════════ */
        async function send() {
            const msg = inp.value.trim();
            if (!msg) return;

            // Empty state ni olib tashlash
            document.getElementById('empty-state')?.remove();

            // User xabari
            appendMsg('user', msg);

            // Input tozalash
            inp.value = '';
            inp.style.height = 'auto';
            document.getElementById('char-count').textContent = '0/2000';
            document.getElementById('send-btn').disabled = true;
            inp.disabled = true;

            const typingEl = appendTyping();

            try {
                /* ── 1. Keyword extraction ── */
                const kw = await extractKeywords(msg);

                /* ── 2. Markaz qidirish (kerak bo'lsa) ── */
                let centerContext = '';
                let foundCount = 0;

                if (kw.needs_search) {
                    const result = await searchCenters({
                        province: kw.province,
                        subjects: kw.subjects,
                        query: kw.query || msg,
                    });

                    if (result) {
                        foundCount = result.count;
                        centerContext = result.context;
                    }
                }

                /* ── 3. System prompt ── */
                const systemPrompt = buildSystemPrompt(centerContext, foundCount);

                /* ── 4. AI ga yuborish ── */
                const messages = [{
                        role: 'system',
                        content: systemPrompt
                    },
                    ...localHistory,
                    {
                        role: 'user',
                        content: msg
                    }
                ];

                // AI ga so'rov (Laravel proxy orqali — CORS muammosini oldini oladi)
                const response = await fetch(URL_AI, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': CSRF
                    },
                    body: JSON.stringify({
                        messages: messages,
                        max_tokens: 2000,
                        temperature: 0.7
                    })
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const data = await response.json();
                const fullResp = data?.choices?.[0]?.message?.content || '';

                typingEl.remove();

                const aiEl = appendMsg('ai', fullResp, false);
                const aiMd = aiEl.querySelector('.ai-md');
                aiMd.innerHTML = marked.parse(fullResp);
                scrollBot();

                /* ── 5. Mahalliy tarixni yangilash ── */
                localHistory.push({
                    role: 'user',
                    content: msg.substring(0, 400)
                });
                localHistory.push({
                    role: 'assistant',
                    content: fullResp.substring(0, 400)
                });
                if (localHistory.length > 12) localHistory = localHistory.slice(-12);

                /* ── 6. DB ga saqlash ── */
                const saved = await api(URL_SAVE, 'POST', {
                    session_id: currentSID,
                    user_message: msg,
                    ai_response: fullResp,
                    model: '{{ config('services.groq.model') }}',
                });

                if (saved.ok) {
                    currentSID = saved.session_id;
                    updSidebarItem(currentSID, msg);
                }

            } catch (err) {
                typingEl?.remove();
                hideSearchIndicator();
                appendMsg('ai', '{{ __('chat.messages.error') }}');
                console.error(err);
            } finally {
                document.getElementById('send-btn').disabled = false;
                inp.disabled = false;
                inp.focus();
            }
        }

        /* ═══════════════════════════════════════════
        SYSTEM PROMPT YARATISH
        Markaz ma'lumotlari bo'lsa — tafsiya rejimi
        Bo'lmasa — umumiy maslahat rejimi
        ═══════════════════════════════════════════ */
        function buildSystemPrompt(centerContext, foundCount) {
            const today = new Date().toLocaleDateString('uz-UZ', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });

            const base = `Siz O'zbekistondagi ta'lim sohasida ixtisoslashgan AI maslahatchi bo'lgan "EduBot"siz.
            Bugun: ${today}
            Til: faqat O'zbek tilida javob bering.
            Uslub: samimiy, aniq, foydali. Keraksiz uzun so'zlardan saqlaning.`;

            if (centerContext && foundCount > 0) {
                return `${base}

            VAZIFA: Foydalanuvchi o'quv markaz haqida so'radi. Quyida ma'lumotlar bazasidan topilgan ${foundCount} ta eng mos markaz berilgan.

            === MARKAZLAR MA'LUMOTI ===
            ${centerContext}
            === MA'LUMOT TUGADI ===

            MUHIM: Yuqoridagi ma'lumotlarda markaz nomlari markdown link formatida berilgan: **[Markaz nomi](url)**.
            Bu linklarni o'zgartirmasdan, aynan shu formatda qoldiring. Foydalanuvchi shu link orqali markaz sahifasiga o'tadi.

            Javob berish qoidalari:
            1. FAQAT yuqoridagi ro'yxatdagi markazlarni tavsiya qiling — o'zingizdan markaz to'qimang
            2. Har bir tavsiya uchun quyidagi formatda yozing:
            **[Markaz nomi](url)** — [Viloyat, Tuman]
            • Turi: [markaz turi]
            • Reyting: [reyting]
            • O'quvchilar: [soni]
            • Manzil: [manzil]
            • [Qo'shimcha muhim ma'lumot]
            3. Linklarni o'zgartirmang — ular foydalanuvchiga markaz sahifasiga o'tish imkonini beradi
            4. Agar foydalanuvchining talabiga mos markaz topilmasa — "Afsuski, [shart] bo'yicha mos markaz topilmadi" deb ayting
            5. Tavsiyadan keyin qisqa maslahat bering (qaysi mezonlar bo'yicha tanlash kerak)
            6. Markazlarni student_count (o'quvchilar soni) ko'p bo'lgani yaxshiroq deb hisoblang`;
                }

                return `${base}

            VAZIFA: Foydalanuvchiga ta'lim va o'quv markazlar haqida umumiy maslahat bering.

            Qila oladigan narsalaringiz:
            - O'quv markaz tanlash bo'yicha maslahat
            - Fan va kurslar haqida ma'lumot
            - O'qish metodlari va maslahatlar
            - O'zbekistondagi ta'lim tizimi haqida

            Agar foydalanuvchi muayyan viloyat yoki fan bo'yicha markaz so'rasa:
            "[Viloyat]da [fan] bo'yicha markazlarni qidirish uchun aniqroq yozing" deb yo'naltiring.`;
        }

        /* ═══════════════════════════════════════════
        DOM YORDAMCHI FUNKSIYALAR
        ═══════════════════════════════════════════ */
        function appendMsg(role, content, time, isStreaming = false) {
            const box = document.getElementById('msgs');
            const t = time || new Date().toLocaleTimeString('uz', {
                hour: '2-digit',
                minute: '2-digit'
            });
            
            const div = document.createElement('div');
            div.className = `flex ${role === 'user' ? 'justify-end' : 'justify-start'} mb-4 animate-fade-in`;

            const innerDiv = document.createElement('div');
            innerDiv.className = `flex items-start space-x-3 max-w-3xl ${role === 'user' ? 'flex-row-reverse space-x-reverse' : ''}`;

            // Avatar
            const avatar = document.createElement('div');
            avatar.className = `flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center ${role === 'user' ? 'bg-gradient-to-r from-indigo-500 to-purple-600' : 'bg-gray-200 dark:bg-gray-700'}`;
            avatar.innerHTML = `<span class="text-sm font-medium ${role === 'user' ? 'text-white' : 'text-gray-600 dark:text-gray-300'}">${role === 'user' ? 'S' : 'AI'}</span>`;

            // Message content
            const contentDiv = document.createElement('div');
            contentDiv.className = 'flex-1';
            
            const bubble = document.createElement('div');
            bubble.className = `inline-block max-w-full px-4 py-3 rounded-2xl ${role === 'user' ? 'bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-br-none' : 'bg-white dark:bg-gray-800 text-gray-900 dark:text-white border border-gray-200 dark:border-gray-700 rounded-bl-none'}`;
            
            if (role === 'assistant') {
                bubble.innerHTML = `<div class="prose prose-sm dark:prose-invert max-w-none">${isStreaming ? '' : marked.parse(content)}</div>`;
            } else {
                bubble.innerHTML = `<p class="text-sm whitespace-pre-wrap">${content}</p>`;
            }

            const timeDiv = document.createElement('p');
            timeDiv.className = `text-xs text-gray-500 dark:text-gray-400 mt-1 ${role === 'user' ? 'text-right' : ''}`;
            timeDiv.textContent = time ? (new Date(time)).toLocaleTimeString('uz-UZ', {
                hour: '2-digit',
                minute: '2-digit'
            }) : (new Date()).toLocaleTimeString('uz-UZ', {
                hour: '2-digit',
                minute: '2-digit'
            });

            contentDiv.appendChild(bubble);
            contentDiv.appendChild(timeDiv);
            innerDiv.appendChild(avatar);
            innerDiv.appendChild(contentDiv);
            div.appendChild(innerDiv);
            box.appendChild(div);

            scrollBot();
            return div;
        }

        function appendTyping() {
            const box = document.getElementById('msgs');
            
            const div = document.createElement('div');
            div.className = 'flex justify-start mb-4 animate-fade-in';

            const innerDiv = document.createElement('div');
            innerDiv.className = 'flex items-start space-x-3 max-w-3xl';

            // Avatar
            const avatar = document.createElement('div');
            avatar.className = 'flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center bg-gray-200 dark:bg-gray-700';
            avatar.innerHTML = '<span class="text-sm font-medium text-gray-600 dark:text-gray-300">AI</span>';

            // Typing indicator
            const contentDiv = document.createElement('div');
            contentDiv.className = 'flex-1';
            
            const bubble = document.createElement('div');
            bubble.className = 'inline-block max-w-full px-4 py-3 rounded-2xl bg-white dark:bg-gray-800 text-gray-900 dark:text-white border border-gray-200 dark:border-gray-700 rounded-bl-none';
            bubble.innerHTML = `
                <div class="flex space-x-1">
                    <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce"></div>
                    <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                    <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                </div>
            `;

            contentDiv.appendChild(bubble);
            innerDiv.appendChild(avatar);
            innerDiv.appendChild(contentDiv);
            div.appendChild(innerDiv);
            box.appendChild(div);

            scrollBot();
            return div;
        }

        function scrollBot() {
            const b = document.getElementById('msgs');
            b.scrollTop = b.scrollHeight;
        }

        function esc(t) {
            const d = document.createElement('div');
            d.textContent = t;
            return d.innerHTML;
        }

        /* ═══════════════════════════════════════════
        UI YANGILASH
        ═══════════════════════════════════════════ */
        function updSidebarItem(id, lastMsg) {
            document.getElementById('sess-empty')?.remove();

            let el = document.getElementById('si-' + id);

            if (!el) {
                el = document.createElement('div');
                el.className = 'group cursor-pointer rounded-lg p-3 transition-all duration-200 hover:bg-gray-50 dark:hover:bg-gray-700 border border-indigo-200 dark:border-indigo-700 bg-indigo-50 dark:bg-indigo-900/20';
                el.id = 'si-' + id;
                el.onclick = () => loadSess(id);
                el.innerHTML = `
                    <div class="flex items-start justify-between">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 dark:text-white truncate">${esc(lastMsg.substring(0, 42))}</p>
                            <div class="flex items-center mt-1 space-x-2">
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400">Faol</span>
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 truncate mt-1">${esc(lastMsg.substring(0, 48))}</p>
                        </div>
                    </div>`;
                document.getElementById('sess-list').prepend(el);
            } else {
                el.classList.add('bg-indigo-50', 'dark:bg-indigo-900/20', 'border-indigo-200', 'dark:border-indigo-700');
                el.classList.remove('border-transparent');
                const prev = el.querySelector('.text-xs.text-gray-500');
                if (prev) prev.textContent = esc(lastMsg.substring(0, 48));
            }
        }

        /* ═══════════════════════════════════════════
           API FETCH YORDAMCHISI
        ═══════════════════════════════════════════ */
        async function api(url, method = 'GET', body = null) {
            const opts = {
                method,
                headers: {
                    'X-CSRF-TOKEN': CSRF,
                    'Content-Type': 'application/json',
                },
            };
            if (body && method !== 'GET') opts.body = JSON.stringify(body);
            const r = await fetch(url, opts);
            return r.json();
        }

        /* ═══════════════════════════════════════════
           INIT
        ═══════════════════════════════════════════ */
        window.addEventListener('load', () => {
            scrollBot();
            inp.focus();
        });
    </script>

</x-layout>
