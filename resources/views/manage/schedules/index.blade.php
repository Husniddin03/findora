<x-layout.manage.app :center="$center">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Dars jadvali (Haftalik)</h2>
            <p class="text-sm text-gray-500 mt-1">Xonalar, kunlar va soatlar bo'yicha markazning umumiy darslar setkasi
            </p>
        </div>
        <div class="flex flex-wrap items-center gap-3">
            <select
                class="bg-white border border-gray-200 rounded-xl px-3 py-2 text-sm text-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500/20">
                <option value="">Barcha xonalar</option>
                <option value="1">1-Xona (Green room)</option>
                <option value="2">2-Xona (Blue room)</option>
                <option value="3">3-Xona (Lab)</option>
            </select>

            <button
                class="inline-flex items-center px-4 py-2.5 text-sm font-medium text-white bg-indigo-600 rounded-xl shadow-sm hover:bg-indigo-700 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Jadvalga dars qo'shing
            </button>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse table-fixed text-left">

                <thead class="bg-gray-50 text-xs text-gray-500 uppercase font-bold border-b border-gray-200">
                    <tr>
                        <th class="w-32 px-4 py-4 border-r border-gray-200 text-center bg-gray-100/50">Vaqt / Kun</th>
                        <th class="px-4 py-4 border-r border-gray-200 min-w-[180px]">Dushanba (Toq)</th>
                        <th class="px-4 py-4 border-r border-gray-200 min-w-[180px]">Seshanba (Juft)</th>
                        <th class="px-4 py-4 border-r border-gray-200 min-w-[180px]">Chorshanba (Toq)</th>
                        <th class="px-4 py-4 border-r border-gray-200 min-w-[180px]">Payshanba (Juft)</th>
                        <th class="px-4 py-4 border-r border-gray-200 min-w-[180px]">Juma (Toq)</th>
                        <th class="px-4 py-4 min-w-[180px]">Shanba (Juft)</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 text-sm">

                    <tr class="h-28">
                        <td
                            class="p-3 border-r border-gray-200 text-center bg-gray-50 font-medium text-gray-600 text-xs">
                            <div class="font-bold text-gray-900">09:00</div>
                            <div class="text-[10px] text-gray-400 my-0.5">Yoki</div>
                            <div class="font-bold text-gray-900">10:30</div>
                        </td>
                        <td class="p-2 border-r border-gray-200 vertical-align-top">
                            <div
                                class="bg-blue-50/70 border border-blue-200 p-2 rounded-xl h-full flex flex-col justify-between">
                                <div>
                                    <span class="text-[10px] font-bold text-blue-700 uppercase">F1-10 (Frontend)</span>
                                    <h4 class="font-semibold text-gray-900 text-xs mt-0.5">1-Xona</h4>
                                </div>
                                <span class="text-[10px] text-gray-500">Shaxzod A.</span>
                            </div>
                        </td>
                        <td class="p-2 border-r border-gray-200 bg-gray-50/30">
                            <div
                                class="h-full flex items-center justify-center text-xs text-gray-300 border border-dashed border-gray-200 rounded-xl">
                                Bo'sh xona
                            </div>
                        </td>
                        <td class="p-2 border-r border-gray-200">
                            <div
                                class="bg-blue-50/70 border border-blue-200 p-2 rounded-xl h-full flex flex-col justify-between">
                                <div>
                                    <span class="text-[10px] font-bold text-blue-700 uppercase">F1-10 (Frontend)</span>
                                    <h4 class="font-semibold text-gray-900 text-xs mt-0.5">1-Xona</h4>
                                </div>
                                <span class="text-[10px] text-gray-500">Shaxzod A.</span>
                            </div>
                        </td>
                        <td class="p-2 border-r border-gray-200 bg-gray-50/30"></td>
                        <td class="p-2 border-r border-gray-200">
                            <div
                                class="bg-blue-50/70 border border-blue-200 p-2 rounded-xl h-full flex flex-col justify-between">
                                <div>
                                    <span class="text-[10px] font-bold text-blue-700 uppercase">F1-10 (Frontend)</span>
                                    <h4 class="font-semibold text-gray-900 text-xs mt-0.5">1-Xona</h4>
                                </div>
                                <span class="text-[10px] text-gray-500">Shaxzod A.</span>
                            </div>
                        </td>
                        <td class="p-2 bg-gray-50/30"></td>
                    </tr>

                    <tr class="h-28">
                        <td
                            class="p-3 border-r border-gray-200 text-center bg-gray-50 font-medium text-gray-600 text-xs">
                            <div class="font-bold text-gray-900">14:00</div>
                            <div class="text-[10px] text-gray-400 my-0.5">Yoki</div>
                            <div class="font-bold text-gray-900">15:30</div>
                        </td>
                        <td class="p-2 border-r border-gray-200 bg-gray-50/30"></td>
                        <td class="p-2 border-r border-gray-200">
                            <div
                                class="bg-amber-50/70 border border-amber-200 p-2 rounded-xl h-full flex flex-col justify-between">
                                <div>
                                    <span class="text-[10px] font-bold text-amber-700 uppercase">ENG-202 (IELTS)</span>
                                    <h4 class="font-semibold text-gray-900 text-xs mt-0.5">3-Xona</h4>
                                </div>
                                <span class="text-[10px] text-gray-500">John Doe</span>
                            </div>
                        </td>
                        <td class="p-2 border-r border-gray-200 bg-gray-50/30"></td>
                        <td class="p-2 border-r border-gray-200">
                            <div
                                class="bg-amber-50/70 border border-amber-200 p-2 rounded-xl h-full flex flex-col justify-between">
                                <div>
                                    <span class="text-[10px] font-bold text-amber-700 uppercase">ENG-202 (IELTS)</span>
                                    <h4 class="font-semibold text-gray-900 text-xs mt-0.5">3-Xona</h4>
                                </div>
                                <span class="text-[10px] text-gray-500">John Doe</span>
                            </div>
                        </td>
                        <td class="p-2 border-r border-gray-200 bg-gray-50/30"></td>
                        <td class="p-2">
                            <div
                                class="bg-amber-50/70 border border-amber-200 p-2 rounded-xl h-full flex flex-col justify-between">
                                <div>
                                    <span class="text-[10px] font-bold text-amber-700 uppercase">ENG-202 (IELTS)</span>
                                    <h4 class="font-semibold text-gray-900 text-xs mt-0.5">3-Xona</h4>
                                </div>
                                <span class="text-[10px] text-gray-500">John Doe</span>
                            </div>
                        </td>
                    </tr>

                    <tr class="h-28">
                        <td
                            class="p-3 border-r border-gray-200 text-center bg-gray-50 font-medium text-gray-600 text-xs">
                            <div class="font-bold text-gray-900">18:30</div>
                            <div class="text-[10px] text-gray-400 my-0.5">Yoki</div>
                            <div class="font-bold text-gray-900">20:00</div>
                        </td>
                        <td class="p-2 border-r border-gray-200">
                            <div
                                class="bg-purple-50/70 border border-purple-200 p-2 rounded-xl h-full flex flex-col justify-between">
                                <div>
                                    <span class="text-[10px] font-bold text-purple-700 uppercase">UX-04 (UI/UX)</span>
                                    <h4 class="font-semibold text-gray-900 text-xs mt-0.5">2-Xona</h4>
                                </div>
                                <span class="text-[10px] text-gray-500">Nodira A.</span>
                            </div>
                        </td>
                        <td class="p-2 border-r border-gray-200 bg-gray-50/30"></td>
                        <td class="p-2 border-r border-gray-200">
                            <div
                                class="bg-purple-50/70 border border-purple-200 p-2 rounded-xl h-full flex flex-col justify-between">
                                <div>
                                    <span class="text-[10px] font-bold text-purple-700 uppercase">UX-04 (UI/UX)</span>
                                    <h4 class="font-semibold text-gray-900 text-xs mt-0.5">2-Xona</h4>
                                </div>
                                <span class="text-[10px] text-gray-500">Nodira A.</span>
                            </div>
                        </td>
                        <td class="p-2 border-r border-gray-200 bg-gray-50/30"></td>
                        <td class="p-2 border-r border-gray-200">
                            <div
                                class="bg-purple-50/70 border border-purple-200 p-2 rounded-xl h-full flex flex-col justify-between">
                                <div>
                                    <span class="text-[10px] font-bold text-purple-700 uppercase">UX-04 (UI/UX)</span>
                                    <h4 class="font-semibold text-gray-900 text-xs mt-0.5">2-Xona</h4>
                                </div>
                                <span class="text-[10px] text-gray-500">Nodira A.</span>
                            </div>
                        </td>
                        <td class="p-2 bg-gray-50/30"></td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</x-layout.manage.app>
