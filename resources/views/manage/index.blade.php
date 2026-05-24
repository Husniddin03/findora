<x-layout.manage.app :center="$center">
    <!-- Dashboard Top Stats Cards -->
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">

        <!-- Card 1: Faol o'quvchilar -->
        <div
            class="bg-white overflow-hidden rounded-xl border border-gray-100 p-5 shadow-sm transition-all hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 truncate">Faol oʻquvchilar</p>
                    <p class="mt-2 text-3xl font-semibold text-gray-900 tracking-tight">1,248</p>
                </div>
                <div class="rounded-lg p-3 bg-blue-50 text-blue-600">
                    <!-- Users Icon -->
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                        </path>
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span
                    class="inline-flex items-center gap-1 font-medium text-green-600 bg-green-50 px-2 py-0.5 rounded-full text-xs">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z"
                            clip-rule="evenodd"></path>
                    </svg>
                    12.2%
                </span>
                <span class="ml-2 text-gray-500 text-xs">oʻtgan oyga nisbatan</span>
            </div>
        </div>

        <!-- Card 2: Yangi Lidlar -->
        <div
            class="bg-white overflow-hidden rounded-xl border border-gray-100 p-5 shadow-sm transition-all hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 truncate">Yangi lidlar (Ariza)</p>
                    <p class="mt-2 text-3xl font-semibold text-gray-900 tracking-tight">184</p>
                </div>
                <div class="rounded-lg p-3 bg-amber-50 text-amber-600">
                    <!-- User Plus / Lead Icon -->
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z">
                        </path>
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span
                    class="inline-flex items-center gap-1 font-medium text-green-600 bg-green-50 px-2 py-0.5 rounded-full text-xs">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z"
                            clip-rule="evenodd"></path>
                    </svg>
                    5.4%
                </span>
                <span class="ml-2 text-gray-500 text-xs">shu haftada</span>
            </div>
        </div>

        <!-- Card 3: Oylik Tushum -->
        <div
            class="bg-white overflow-hidden rounded-xl border border-gray-100 p-5 shadow-sm transition-all hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 truncate">Oylik tushum (Kirim)</p>
                    <p class="mt-2 text-2xl font-bold text-gray-900 tracking-tight">85.4M <span
                            class="text-xs font-medium text-gray-400">UZS</span></p>
                </div>
                <div class="rounded-lg p-3 bg-emerald-50 text-emerald-600">
                    <!-- Cash Icon -->
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span
                    class="inline-flex items-center gap-1 font-medium text-green-600 bg-green-50 px-2 py-0.5 rounded-full text-xs">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z"
                            clip-rule="evenodd"></path>
                    </svg>
                    18.1%
                </span>
                <span class="ml-2 text-gray-500 text-xs">reja bajarilishi</span>
            </div>
        </div>

        <!-- Card 4: Umumi Qarzdorlik -->
        <div
            class="bg-white overflow-hidden rounded-xl border border-gray-100 p-5 shadow-sm transition-all hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 truncate">Umumiy qarzdorlik</p>
                    <p class="mt-2 text-2xl font-bold text-red-600 tracking-tight">14.2M <span
                            class="text-xs font-medium text-red-400">UZS</span></p>
                </div>
                <div class="rounded-lg p-3 bg-red-50 text-red-600">
                    <!-- Exclamation/Debt Icon -->
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                        </path>
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span
                    class="inline-flex items-center gap-1 font-medium text-red-600 bg-red-50 px-2 py-0.5 rounded-full text-xs">
                    <!-- Arrow Down (Yomon ko'rsatkich, qarz ko'paygan) -->
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M14.707 12.293a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0l-5-5a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l3.293-3.293a1 1 0 011.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                    8.3%
                </span>
                <span class="ml-2 text-gray-500 text-xs">oʻtgan haftadan beri koʻpaygan</span>
            </div>
        </div>

    </div>
    
    <div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-3">

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden lg:col-span-2">
            <div class="p-5 border-b border-gray-100 flex items-center justify-between">
                <div>
                    <h3 class="text-base font-semibold text-gray-900">Bugungi dars jadvali</h3>
                    <p class="text-xs text-gray-500 mt-0.5">Xonalar va soatlar bo'yicha darslar ro'yxati</p>
                </div>
                <span
                    class="inline-flex items-center text-xs font-medium text-indigo-600 bg-indigo-50 px-2.5 py-1 rounded-lg">
                    Bugun: {{ now()->format('d.m.Y') }}
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-left">
                    <thead class="bg-gray-50 text-xs text-gray-500 uppercase font-medium">
                        <tr>
                            <th class="px-6 py-3">Vaqt / Xona</th>
                            <th class="px-6 py-3">Guruh / Kurs</th>
                            <th class="px-6 py-3">O'qituvchi</th>
                            <th class="px-6 py-3">Holat</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-sm text-gray-700">
                        <tr class="hover:bg-gray-50/70 transition-colors">
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-900">14:00 - 15:30</div>
                                <div class="text-xs text-gray-500">1-Xona (Green room)</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-900">F1-10 (Frontend)</div>
                                <div class="text-xs text-gray-500">12 ta o'quvchi</div>
                            </td>
                            <td class="px-6 py-4 text-gray-600">Anvarov Shaxzod</td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-amber-50 text-amber-700">Kutilmoqda</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50/70 transition-colors">
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-900">16:00 - 17:30</div>
                                <div class="text-xs text-gray-500">3-Xona (Lab)</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-900">ENG-202 (IELTS 7+)</div>
                                <div class="text-xs text-gray-500">8 ta o'quvchi</div>
                            </td>
                            <td class="px-6 py-4 text-gray-600">John Doe (Native)</td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-50 text-green-700">Tugadi</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50/70 transition-colors">
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-900">18:30 - 20:00</div>
                                <div class="text-xs text-gray-500">2-Xona (Blue room)</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-900">UX-04 (UI/UX Design)</div>
                                <div class="text-xs text-gray-500">15 ta o'quvchi</div>
                            </td>
                            <td class="px-6 py-4 text-gray-600">Nodira Abdullayeva</td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-indigo-50 text-indigo-700-700 text-indigo-700">Darsda</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-base font-semibold text-gray-900">Yangi arizalar</h3>
                    <p class="text-xs text-gray-500 mt-0.5">Tezkor aloqaga chiqish kerak bo'lgan lidlar</p>
                </div>
                <a href="#"
                    class="text-xs font-medium text-indigo-600 hover:text-indigo-700 hover:underline">Barchasi</a>
            </div>

            <div class="space-y-4">
                <div
                    class="flex items-center justify-between p-3 rounded-lg bg-gray-50/60 hover:bg-gray-50 transition-colors border border-gray-100/50">
                    <div class="flex items-center space-x-3">
                        <div
                            class="w-9 h-9 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-semibold text-sm">
                            AH
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-900">Asror Hikmatov</h4>
                            <p class="text-xs text-gray-500">+998 90 123 45 67</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span
                            class="inline-flex items-center text-[11px] font-medium px-2 py-0.5 rounded bg-blue-50 text-blue-700 mb-1">Python</span>
                        <p class="text-[10px] text-gray-400">10 daqiqa avval</p>
                    </div>
                </div>

                <div
                    class="flex items-center justify-between p-3 rounded-lg bg-gray-50/60 hover:bg-gray-50 transition-colors border border-gray-100/50">
                    <div class="flex items-center space-x-3">
                        <div
                            class="w-9 h-9 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-semibold text-sm">
                            SM
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-900">Sardor Malikova</h4>
                            <p class="text-xs text-gray-500">+998 93 987 65 43</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span
                            class="inline-flex items-center text-[11px] font-medium px-2 py-0.5 rounded bg-amber-50 text-amber-700 mb-1">IELTS</span>
                        <p class="text-[10px] text-gray-400">1 soat avval</p>
                    </div>
                </div>

                <div
                    class="flex items-center justify-between p-3 rounded-lg bg-gray-50/60 hover:bg-gray-50 transition-colors border border-gray-100/50">
                    <div class="flex items-center space-x-3">
                        <div
                            class="w-9 h-9 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center font-semibold text-sm">
                            KS
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-900">Kamola Solihova</h4>
                            <p class="text-xs text-gray-500">+998 99 456 11 22</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span
                            class="inline-flex items-center text-[11px] font-medium px-2 py-0.5 rounded bg-purple-50 text-purple-700 mb-1">Grafik
                            Dizayn</span>
                        <p class="text-[10px] text-gray-400">Bugun, 09:12</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 mt-6">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h3 class="text-base font-semibold text-gray-900">Diqqat markazidagilar</h3>
                <p class="text-xs text-gray-500 mt-0.5">Tezkor chora ko'rish zarur bo'lgan holatlar</p>
            </div>
            <span class="px-2 py-0.5 text-[10px] font-medium bg-red-50 text-red-600 rounded">Alerts</span>
        </div>

        <div class="space-y-3.5">

            <div
                class="flex items-start justify-between p-3 rounded-lg border border-red-100/50 bg-red-50/10 hover:bg-red-50/30 transition-colors">
                <div class="flex space-x-3">
                    <div
                        class="mt-0.5 w-8 h-8 rounded-full bg-red-100 text-red-600 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-900">Jasur Axmedov</h4>
                        <p class="text-xs text-gray-500">F1-10 • Ketma-ket 3 ta dars qoldirdi</p>
                    </div>
                </div>
                <button
                    class="text-xs text-red-600 hover:text-red-700 font-medium bg-white border border-red-200 px-2.5 py-1 rounded-md shadow-sm">
                    SMS
                </button>
            </div>

            <div
                class="flex items-start justify-between p-3 rounded-lg border border-amber-100/50 bg-amber-50/10 hover:bg-amber-50/30 transition-colors">
                <div class="flex space-x-3">
                    <div
                        class="mt-0.5 w-8 h-8 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-900">Malika Rustamova</h4>
                        <p class="text-xs text-gray-500">ENG-202 • Balansi: 1 ta dars qoldi</p>
                    </div>
                </div>
                <button
                    class="text-xs text-amber-700 hover:text-amber-800 font-medium bg-white border border-amber-200 px-2.5 py-1 rounded-md shadow-sm">
                    Eslatish
                </button>
            </div>

        </div>
    </div>

</x-layout.manage.app>
