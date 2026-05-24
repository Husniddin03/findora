<x-layout>
    <x-slot:title>{{ __('404.title') }}</x-slot:title>

    <div class="relative min-h-screen">
    
        {{-- Content (z-10 bilan gradientlardan yuqoriga chiqarildi) --}}
        <div class="relative z-10 flex items-center justify-center min-h-screen px-6 py-16">
            <div class="max-w-3xl mx-auto text-center">

                {{-- 404 Katta matni --}}
                <div class="text-[110px] sm:text-[150px] md:text-[200px] font-black leading-none tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 select-none drop-shadow-sm">
                    404
                </div>

                {{-- Icon --}}
                <div class="flex justify-center -mt-2 mb-8">
                    <div class="w-24 h-24 rounded-2xl border border-gray-200 dark:border-white/10 bg-white/80 dark:bg-white/5 backdrop-blur-xl shadow-lg flex items-center justify-center transition-colors duration-300">
                        <svg class="w-12 h-12 text-indigo-600 dark:text-indigo-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>

                {{-- Title (Kunduzgi rejimda ko'rinishi majburiy qilindi) --}}
                <h1 class="force-light-text-gray-900 text-3xl sm:text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-5 tracking-tight transition-colors duration-300">
                    {{ __('404.error_message') }}
                </h1>

                {{-- Description --}}
                <p class="force-light-text-gray-600 max-w-2xl mx-auto text-base sm:text-lg leading-8 text-gray-600 dark:text-gray-300 mb-10 transition-colors duration-300">
                    {{ __('404.error_description') }}
                    {{ __('404.error_action') }}
                </p>

                {{-- Actions --}}
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    {{-- Home --}}
                    <a href="{{ route('index') }}"
                        class="group inline-flex items-center justify-center gap-2 w-full sm:w-auto px-7 py-4 rounded-2xl bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold shadow-md shadow-indigo-500/25 hover:shadow-indigo-500/30 hover:scale-[1.02] active:scale-[0.98] transition-all duration-300">
                        <svg class="w-5 h-5 transition-transform duration-300 group-hover:-translate-x-0.5"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span>{{ __('404.home_button') }}</span>
                    </a>

                    {{-- Back --}}
                    <button onclick="history.back()"
                        class="group inline-flex items-center justify-center gap-2 w-full sm:w-auto px-7 py-4 rounded-2xl border border-gray-300 dark:border-gray-700 bg-white/90 dark:bg-gray-900/70 backdrop-blur-xl text-gray-100 dark:text-gray-200 font-semibold hover:bg-gray-100 dark:hover:bg-gray-800 hover:scale-[1.02] active:scale-[0.98] transition-all duration-300 shadow-sm">
                        <svg class="w-5 h-5 transition-transform duration-300 group-hover:-translate-x-0.5"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 19l-7-7 7-7" />
                        </svg>
                        <span>{{ __('404.back_button') }}</span>
                    </button>
                </div>

                {{-- Divider --}}
                <div class="flex items-center justify-center gap-4 my-12">
                    <div class="w-20 h-px bg-gray-300 dark:bg-gray-700 transition-colors duration-300"></div>
                    <div class="w-2 h-2 rounded-full bg-indigo-500 shadow-lg shadow-indigo-500/50"></div>
                    <div class="w-20 h-px bg-gray-300 dark:bg-gray-700 transition-colors duration-300"></div>
                </div>

                {{-- Help --}}
                <div class="inline-flex flex-col sm:flex-row items-center gap-2 px-5 py-4 rounded-2xl bg-white/90 dark:bg-white/5 backdrop-blur-xl border border-gray-200 dark:border-white/10 shadow-sm transition-colors duration-300">
                    <div class="flex items-center gap-2 text-gray-700 dark:text-gray-300 transition-colors duration-300">
                        <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18.364 5.636l-1.414 1.414M15 11a3 3 0 11-6 0 3 3 0 016 0zm6 1a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-sm sm:text-base">
                            {{ __('404.help.problem_continues') }}
                        </span>
                    </div>

                    <a href="tel:+998770250267"
                        class="font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 transition-colors duration-300">
                        (+998) 77 025 02 67
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-layout>