<x-layout.manage.app :center="$center">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Oʻquvchilar bazasi</h2>
            <p class="text-sm text-gray-500 mt-1">Markazda tahsil olayotgan barcha o'quvchilar ro'yxati va ularning hisob
                balansi</p>
        </div>
        <div>
            <button
                class="inline-flex items-center px-4 py-2.5 text-sm font-medium text-white bg-indigo-600 rounded-xl shadow-sm hover:bg-indigo-700 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
                Yangi o'quvchi qo'shish
            </button>
        </div>
    </div>

    <div
        class="bg-white rounded-xl border border-gray-200/80 p-4 mb-6 shadow-sm flex flex-col md:flex-row gap-4 justify-between items-center">
        <div class="relative w-full md:w-80">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </span>
            <input type="text" placeholder="O'quvchi ismi yoki tel..."
                class="w-full pl-9 pr-4 py-2 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
        </div>

        <div class="flex flex-wrap items-center gap-3 w-full md:w-auto justify-end">
            <select
                class="bg-gray-50 border border-gray-200 rounded-xl px-3 py-2 text-sm text-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500/20">
                <option value="">Barcha statuslar</option>
                <option value="active">Faol</option>
                <option value="frozen">Muzlatilgan</option>
                <option value="debter">Qarzdorlar</option>
                <option value="left">Bitirgan / Ketgan</option>
            </select>

            <select
                class="bg-gray-50 border border-gray-200 rounded-xl px-3 py-2 text-sm text-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500/20">
                <option value="">Barcha guruhlar</option>
                <option value="f1-10">F1-10 (Frontend)</option>
                <option value="eng-202">ENG-202 (IELTS)</option>
            </select>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-left">
                <thead class="bg-gray-50 text-xs text-gray-500 uppercase font-medium">
                    <tr>
                        <th class="px-6 py-3.5">O'quvchi</th>
                        <th class="px-6 py-3.5">Guruhlari</th>
                        <th class="px-6 py-3.5">Balans</th>
                        <th class="px-6 py-3.5">Holat</th>
                        <th class="px-6 py-3.5">Qo'shilgan sana</th>
                        <th class="px-6 py-3.5 text-right">Amallar</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm text-gray-700">

                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <div
                                    class="w-9 h-9 rounded-full bg-indigo-50 text-indigo-600 flex items-center justify-center font-semibold text-xs shrink-0">
                                    DB
                                </div>
                                <div>
                                    <a href="#"
                                        class="font-medium text-gray-900 hover:text-indigo-600 transition-colors">Diyorbek
                                        Umarov</a>
                                    <div class="text-xs text-gray-500">+998 94 333 22 11</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col gap-1">
                                <span class="inline-flex items-center text-xs font-medium text-gray-800">F1-10 <span
                                        class="text-gray-400 mx-1">•</span> Frontend</span>
                                <span class="text-[11px] text-gray-400">O'qituvchi: Shaxzod A.</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="font-semibold text-emerald-600">+450,000 <span
                                    class="text-[10px] font-normal text-gray-400">UZS</span></span>
                        </td>
                        <td class="px-6 py-4">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-50 text-green-700">Faol</span>
                        </td>
                        <td class="px-6 py-4 text-gray-500 text-xs">12.01.2026</td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end space-x-2">
                                <button
                                    class="p-1.5 text-gray-400 hover:text-indigo-600 hover:bg-gray-50 rounded-lg transition-colors"
                                    title="Profil">
                                    👁️
                                </button>
                                <button
                                    class="p-1.5 text-gray-400 hover:text-amber-600 hover:bg-gray-50 rounded-lg transition-colors"
                                    title="Tahrirlash">
                                    ✏️
                                </button>
                            </div>
                        </td>
                    </tr>

                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <div
                                    class="w-9 h-9 rounded-full bg-red-50 text-red-600 flex items-center justify-center font-semibold text-xs shrink-0">
                                    JA
                                </div>
                                <div>
                                    <a href="#"
                                        class="font-medium text-gray-900 hover:text-indigo-600 transition-colors">Jasur
                                        Axmedov</a>
                                    <div class="text-xs text-gray-500">+998 90 555 44 33</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col gap-1">
                                <span class="inline-flex items-center text-xs font-medium text-gray-800">ENG-202 <span
                                        class="text-gray-400 mx-1">•</span> IELTS</span>
                                <span class="text-[11px] text-gray-400">O'qituvchi: John Doe</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="font-semibold text-red-600">-280,000 <span
                                    class="text-[10px] font-normal text-red-400">UZS</span></span>
                        </td>
                        <td class="px-6 py-4">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-50 text-red-700">Qarzdor</span>
                        </td>
                        <td class="px-6 py-4 text-gray-500 text-xs">05.02.2026</td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end space-x-2">
                                <button
                                    class="p-1.5 text-gray-400 hover:text-indigo-600 hover:bg-gray-50 rounded-lg transition-colors">👁️</button>
                                <button
                                    class="p-1.5 text-gray-400 hover:text-amber-600 hover:bg-gray-50 rounded-lg transition-colors">✏️</button>
                            </div>
                        </td>
                    </tr>

                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <div
                                    class="w-9 h-9 rounded-full bg-amber-50 text-amber-600 flex items-center justify-center font-semibold text-xs shrink-0">
                                    MR
                                </div>
                                <div>
                                    <a href="#"
                                        class="font-medium text-gray-900 hover:text-indigo-600 transition-colors">Malika
                                        Rustamova</a>
                                    <div class="text-xs text-gray-500">+998 93 111 22 33</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col gap-1">
                                <span
                                    class="inline-flex items-center text-xs font-medium text-gray-400 line-through">F1-10
                                    • Frontend</span>
                                <span
                                    class="text-[11px] text-amber-600 bg-amber-50 px-1.5 py-0.5 rounded w-max">Muzlatilgan
                                    (Freeze)</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="font-semibold text-gray-600">0 <span
                                    class="text-[10px] font-normal text-gray-400">UZS</span></span>
                        </td>
                        <td class="px-6 py-4">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-50 text-amber-700">Muzlatilgan</span>
                        </td>
                        <td class="px-6 py-4 text-gray-500 text-xs">20.12.2025</td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end space-x-2">
                                <button
                                    class="p-1.5 text-gray-400 hover:text-indigo-600 hover:bg-gray-50 rounded-lg transition-colors">👁️</button>
                                <button
                                    class="p-1.5 text-gray-400 hover:text-amber-600 hover:bg-gray-50 rounded-lg transition-colors">✏️</button>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex items-center justify-between">
            <div class="text-xs text-gray-500">
                Jami <span class="font-medium text-gray-700">1,248</span> ta o'quvchidan <span
                    class="font-medium text-gray-700">1-3</span> gacha ko'rsatilmoqda
            </div>
            <div class="flex items-center space-x-2">
                <button
                    class="px-3 py-1 text-xs border border-gray-200 rounded-lg bg-white text-gray-400 cursor-not-allowed">Oldingi</button>
                <button
                    class="px-3 py-1 text-xs border border-gray-200 rounded-lg bg-white text-gray-700 hover:bg-gray-50 transition-colors">Keyingi</button>
            </div>
        </div>
    </div>
</x-layout.manage.app>
