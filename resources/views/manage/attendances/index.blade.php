<x-layout.manage.app :center="$center">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Davomat Jurnali</h2>
            <p class="text-sm text-gray-500 mt-1">Guruhlar kesimida o'quvchilarning kunlik darsga qatnashish nazorati</p>
        </div>

        <div class="flex flex-wrap items-center gap-3 w-full md:w-auto">
            <select
                class="bg-white border border-gray-200 rounded-xl px-3 py-2 text-sm text-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500/20">
                <option value="f1-10">F1-10 (Frontend Boot camp)</option>
                <option value="eng-202">ENG-202 (English IELTS)</option>
            </select>

            <select
                class="bg-white border border-gray-200 rounded-xl px-3 py-2 text-sm text-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500/20">
                <option value="05-2026">May, 2026</option>
                <option value="04-2026">Aprel, 2026</option>
            </select>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        <div class="bg-white border border-gray-100 rounded-xl p-4 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs font-medium text-gray-400 uppercase">O'rtacha qatnashish</span>
                <h4 class="text-xl font-bold text-gray-900 mt-1">88.5%</h4>
            </div>
            <span class="text-2xl">📈</span>
        </div>
        <div class="bg-white border border-gray-100 rounded-xl p-4 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs font-medium text-gray-400 uppercase">Bugun kelmaganlar</span>
                <h4 class="text-xl font-bold text-red-600 mt-1">2 ta o'quvchi</h4>
            </div>
            <span class="text-2xl">⚠️</span>
        </div>
        <div class="bg-white border border-gray-100 rounded-xl p-4 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs font-medium text-gray-400 uppercase">Joriy darslar</span>
                <h4 class="text-xl font-bold text-indigo-600 mt-1">12-dars / 24</h4>
            </div>
            <span class="text-2xl">📅</span>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse text-left">

                <thead class="bg-gray-50 text-xs font-bold text-gray-500 uppercase border-b border-gray-200">
                    <tr>
                        <th
                            class="px-6 py-4 min-w-[240px] sticky left-0 bg-gray-50 z-10 shadow-[2px_0_5px_-2px_rgba(0,0,0,0.1)]">
                            O'quvchi ismi</th>
                        <th class="px-3 py-4 text-center border-r border-gray-200 w-14 bg-gray-100/50">04.05</th>
                        <th class="px-3 py-4 text-center border-r border-gray-200 w-14 bg-gray-100/50">06.05</th>
                        <th class="px-3 py-4 text-center border-r border-gray-200 w-14 bg-gray-100/50">08.05</th>
                        <th class="px-3 py-4 text-center border-r border-gray-200 w-14 bg-gray-100/50">11.05</th>
                        <th class="px-3 py-4 text-center border-r border-gray-200 w-14 bg-gray-100/50">13.05</th>
                        <th class="px-3 py-4 text-center border-r border-gray-200 w-14 bg-gray-100/50">15.05</th>
                        <th class="px-3 py-4 text-center border-r border-gray-200 w-14 bg-indigo-50 text-indigo-600">
                            Bugun</th>
                        <th class="px-4 py-4 text-center text-xs font-semibold text-gray-400">Jami %</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 text-sm text-gray-700">

                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td
                            class="px-6 py-4 sticky left-0 bg-white z-10 font-medium text-gray-900 shadow-[2px_0_5px_-2px_rgba(0,0,0,0.1)] flex items-center space-x-2">
                            <span class="w-2 h-2 rounded-full bg-green-500"></span>
                            <div>
                                <span>Diyorbek Umarov</span>
                                <span class="block text-[10px] text-gray-400 font-normal">Balans: +450,000 UZS</span>
                            </div>
                        </td>
                        <td class="p-2 border-r border-gray-200 text-center"><span
                                class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-green-100 text-green-700 font-bold text-xs">✓</span>
                        </td>
                        <td class="p-2 border-r border-gray-200 text-center"><span
                                class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-green-100 text-green-700 font-bold text-xs">✓</span>
                        </td>
                        <td class="p-2 border-r border-gray-200 text-center"><span
                                class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-green-100 text-green-700 font-bold text-xs">✓</span>
                        </td>
                        <td class="p-2 border-r border-gray-200 text-center"><span
                                class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-green-100 text-green-700 font-bold text-xs">✓</span>
                        </td>
                        <td class="p-2 border-r border-gray-200 text-center"><span
                                class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-green-100 text-green-700 font-bold text-xs">✓</span>
                        </td>
                        <td class="p-2 border-r border-gray-200 text-center"><span
                                class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-green-100 text-green-700 font-bold text-xs">✓</span>
                        </td>
                        <td class="p-2 border-r border-gray-200 text-center bg-indigo-50/30">
                            <button
                                class="w-8 h-8 rounded-xl bg-green-600 text-white font-bold text-xs shadow-sm hover:scale-105 transition-transform">✓</button>
                        </td>
                        <td class="p-2 text-center font-semibold text-gray-600 text-xs">100%</td>
                    </tr>

                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td
                            class="px-6 py-4 sticky left-0 bg-white z-10 font-medium text-gray-900 shadow-[2px_0_5px_-2px_rgba(0,0,0,0.1)] flex items-center space-x-2">
                            <span class="w-2 h-2 rounded-full bg-red-500"></span>
                            <div>
                                <span>Jasur Axmedov</span>
                                <span class="block text-[10px] text-gray-400 font-normal">Balans: -280,000 UZS</span>
                            </div>
                        </td>
                        <td class="p-2 border-r border-gray-200 text-center"><span
                                class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-green-100 text-green-700 font-bold text-xs">✓</span>
                        </td>
                        <td class="p-2 border-r border-gray-200 text-center"><span
                                class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-red-100 text-red-700 font-bold text-xs">✕</span>
                        </td>
                        <td class="p-2 border-r border-gray-200 text-center"><span
                                class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-green-100 text-green-700 font-bold text-xs">✓</span>
                        </td>
                        <td class="p-2 border-r border-gray-200 text-center"><span
                                class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-amber-100 text-amber-700 font-bold text-xs">S</span>
                        </td>
                        <td class="p-2 border-r border-gray-200 text-center"><span
                                class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-green-100 text-green-700 font-bold text-xs">✓</span>
                        </td>
                        <td class="p-2 border-r border-gray-200 text-center"><span
                                class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-red-100 text-red-700 font-bold text-xs">✕</span>
                        </td>
                        <td class="p-2 border-r border-gray-200 text-center bg-indigo-50/30">
                            <button
                                class="w-8 h-8 rounded-xl bg-red-500 text-white font-bold text-xs shadow-sm hover:scale-105 transition-transform">✕</button>
                        </td>
                        <td class="p-2 text-center font-semibold text-red-500 text-xs">57%</td>
                    </tr>

                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td
                            class="px-6 py-4 sticky left-0 bg-white z-10 font-medium text-gray-900 shadow-[2px_0_5px_-2px_rgba(0,0,0,0.1)] flex items-center space-x-2">
                            <span class="w-2 h-2 rounded-full bg-green-500"></span>
                            <div>
                                <span>Kamola Solihova</span>
                                <span class="block text-[10px] text-gray-400 font-normal">Balans: 0 UZS</span>
                            </div>
                        </td>
                        <td class="p-2 border-r border-gray-200 text-center"><span
                                class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-green-100 text-green-700 font-bold text-xs">✓</span>
                        </td>
                        <td class="p-2 border-r border-gray-200 text-center"><span
                                class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-green-100 text-green-700 font-bold text-xs">✓</span>
                        </td>
                        <td class="p-2 border-r border-gray-200 text-center"><span
                                class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-green-100 text-green-700 font-bold text-xs">✓</span>
                        </td>
                        <td class="p-2 border-r border-gray-200 text-center"><span
                                class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-green-100 text-green-700 font-bold text-xs">✓</span>
                        </td>
                        <td class="p-2 border-r border-gray-200 text-center"><span
                                class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-amber-100 text-amber-700 font-bold text-xs">S</span>
                        </td>
                        <td class="p-2 border-r border-gray-200 text-center"><span
                                class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-green-100 text-green-700 font-bold text-xs">✓</span>
                        </td>
                        <td class="p-2 border-r border-gray-200 text-center bg-indigo-50/30">
                            <button
                                class="w-8 h-8 rounded-xl bg-gray-200 text-gray-400 font-bold text-xs hover:bg-gray-300 transition-colors">?</button>
                        </td>
                        <td class="p-2 text-center font-semibold text-gray-600 text-xs">85%</td>
                    </tr>

                </tbody>
            </table>
        </div>

        <div class="bg-gray-50 px-6 py-3 border-t border-gray-200 flex flex-wrap gap-4 text-xs text-gray-500">
            <div class="flex items-center space-x-1.5">
                <span
                    class="w-5 h-5 rounded-full bg-green-100 text-green-700 font-bold flex items-center justify-center text-[10px]">✓</span>
                <span>Darsda (Kelgan)</span>
            </div>
            <div class="flex items-center space-x-1.5">
                <span
                    class="w-5 h-5 rounded-full bg-red-100 text-red-700 font-bold flex items-center justify-center text-[10px]">✕</span>
                <span>Kelmagan (Sababsiz)</span>
            </div>
            <div class="flex items-center space-x-1.5">
                <span
                    class="w-5 h-5 rounded-full bg-amber-100 text-amber-700 font-bold flex items-center justify-center text-[10px]">S</span>
                <span>Sababli (Kasallik va hk)</span>
            </div>
        </div>
    </div>
</x-layout.manage.app>
