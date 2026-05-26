<aside x-cloak :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
    class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-gray-200 transform transition-transform duration-300 lg:sticky lg:top-0 lg:h-screen lg:overflow-hidden">

    <!-- Logo -->
    <div class="flex items-center justify-between h-16 px-6 border-b border-gray-200 flex-shrink-0">
        <a href="{{ route('manage.manage', $center->slug) }}" class="flex items-center space-x-2">
            <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center">
                <span class="text-white font-bold text-sm">FD</span>
            </div>
            <span class="text-lg font-semibold text-gray-900">Admin</span>
        </a>
        <button @click="sidebarOpen = false" class="lg:hidden text-gray-500 hover:text-gray-700">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <!-- Navigation -->
    <nav class="p-4 space-y-6 overflow-y-auto h-[calc(100vh-64px)] custom-scrollbar">

        <!-- 1. ASOSIY BO'LIM -->
        <div class="space-y-1">
            <span class="px-4 text-[11px] font-bold uppercase tracking-wider text-gray-400 block mb-2">Asosiy</span>

            <!-- Dashboard -->
            <a href="{{ route('manage.manage', $center->slug) }}"
                class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('manage.manage') ? 'bg-indigo-50 text-indigo-700 font-semibold' : 'text-gray-700 hover:bg-gray-100 transition-colors' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                    </path>
                </svg>
                Boshqaruv paneli
            </a>

            <!-- Lidlar / Arizalar -->
            <a href="{{ route('manage.lids', $center->slug) }}"
                class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('manage.lids') ? 'bg-indigo-50 text-indigo-700 font-semibold' : 'text-gray-700 hover:bg-gray-100 transition-colors' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                    </path>
                </svg>
                Lidlar (Arizalar)
            </a>
        </div>

        <!-- 2. O'QUV JARAYONI -->
        <div class="space-y-1">
            <span class="px-4 text-[11px] font-bold uppercase tracking-wider text-gray-400 block mb-2">Oʻquv
                jarayoni</span>

            <!-- O'quvchilar -->
            <a href="{{ route('manage.students', $center->slug) }}"
                class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('manage.students') ? 'bg-indigo-50 text-indigo-700 font-semibold' : 'text-gray-700 hover:bg-gray-100 transition-colors' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                    </path>
                </svg>
                Oʻquvchilar
            </a>

            <!-- Guruhlar -->
            <a href="{{ route('manage.groups', $center->slug) }}"
                class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('manage.groups') ? 'bg-indigo-50 text-indigo-700 font-semibold' : 'text-gray-700 hover:bg-gray-100 transition-colors' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                    </path>
                </svg>
                Guruhlar
            </a>

            <!-- Kurslar -->
            <a href="{{ route('manage.courses', $center->slug) }}"
                class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('manage.courses') ? 'bg-indigo-50 text-indigo-700 font-semibold' : 'text-gray-700 hover:bg-gray-100 transition-colors' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                    </path>
                </svg>
                Kurslar / Fanlar
            </a>

            <!-- Dars jadvali -->
            <a href="{{ route('manage.schedules', $center->slug) }}"
                class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('manage.schedules') ? 'bg-indigo-50 text-indigo-700 font-semibold' : 'text-gray-700 hover:bg-gray-100 transition-colors' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
                Dars jadvali
            </a>

            <!-- Davomat -->
            <a href="{{ route('manage.attendances', $center->slug) }}"
                class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('manage.attendances') ? 'bg-indigo-50 text-indigo-700 font-semibold' : 'text-gray-700 hover:bg-gray-100 transition-colors' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Davomat jurnali
            </a>

            {{-- Xonalar --}}
            <a href="{{ route('manage.rooms', $center->slug) }}"
                class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('manage.rooms') ? 'bg-indigo-50 text-indigo-700 font-semibold' : 'text-gray-700 hover:bg-gray-100 transition-colors' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 12h14M5 12H2m14 0h3m-9 3h10M5 9h10M5 15h10M2 12h20M2 9h20M2 15h20" />
                </svg>
                Xonalar
            </a>
        </div>

        <!-- 3. MOLIYA & JAMOA -->
        <div class="space-y-1">
            <span class="px-4 text-[11px] font-bold uppercase tracking-wider text-gray-400 block mb-2">Moliya &
                Xodimlar</span>

            <!-- To'lovlar -->
            <a href="{{ route('manage.finances', $center->slug) }}"
                class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('manage.finances') ? 'bg-indigo-50 text-indigo-700 font-semibold' : 'text-gray-700 hover:bg-gray-100 transition-colors' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                    </path>
                </svg>
                Toʻlovlar & Xarajatlar
            </a>

            <!-- Xodimlar -->
            <a href="{{ route('manage.staff', $center->slug) }}"
                class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('manage.staff') ? 'bg-indigo-50 text-indigo-700 font-semibold' : 'text-gray-700 hover:bg-gray-100 transition-colors' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                Xodimlar / Oʻqituvchilar
            </a>
        </div>

        <!-- 4. SOZLAMALAR & MARKETING -->
        <div class="space-y-1">
            <span class="px-4 text-[11px] font-bold uppercase tracking-wider text-gray-400 block mb-2">Tizim</span>

            <!-- SMS Bildirishnomalar -->
            <a href="{{ route('manage.notifications', $center->slug) }}"
                class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('manage.notifications') ? 'bg-indigo-50 text-indigo-700 font-semibold' : 'text-gray-700 hover:bg-gray-100 transition-colors' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                    </path>
                </svg>
                SMS tarqatma
            </a>

            <!-- Sozlamalar -->
            <a href="{{ route('manage.settings', $center->slug) }}"
                class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('manage.settings') ? 'bg-indigo-50 text-indigo-700 font-semibold' : 'text-gray-700 hover:bg-gray-100 transition-colors' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                    </path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                Sozlamalar
            </a>
        </div>

        <hr class="my-4 border-gray-200">

        <!-- Orqaga qaytish -->
        <div class="space-y-1">
            <a href="{{ route('manage.manage', $center->slug) }}"
                class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Saytga qaytish
            </a>
        </div>
    </nav>
</aside>

<!-- Overlay for mobile -->
<div x-show="sidebarOpen" @click="sidebarOpen = false"
    x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-40 bg-gray-600 bg-opacity-75 lg:hidden">
</div>
