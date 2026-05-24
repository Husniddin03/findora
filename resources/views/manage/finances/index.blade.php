<x-layout.manage.app :center="$center">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Moliya (Toʻlovlar & Xarajatlar)</h2>
            <p class="text-sm text-gray-500 mt-1">Markazning real vaqtdagi kassa balansi, kirim va chiqim operatsiyalari
                jurnali</p>
        </div>

        <div class="flex items-center gap-3">
            <button
                class="inline-flex items-center px-4 py-2.5 text-sm font-medium text-red-700 bg-red-50 border border-red-200 rounded-xl shadow-sm hover:bg-red-100/70 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                </svg>
                Xarajat (Chiqim) qo'shish
            </button>
            <button
                class="inline-flex items-center px-4 py-2.5 text-sm font-medium text-white bg-emerald-600 rounded-xl shadow-sm hover:bg-emerald-700 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                To'lov (Kirim) qabul qilish
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-6">
        <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm">
            <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Sof Foyda (Shu oy)</span>
            <h3 class="text-2xl font-extrabold text-indigo-600 mt-1">71.2M <span
                    class="text-xs font-medium text-gray-400">UZS</span></h3>
            <div class="text-[11px] text-gray-500 mt-2">Kirim minus Chiqim</div>
        </div>
        <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Naqd pul kassasi</span>
                <h3 class="text-xl font-bold text-gray-900 mt-1">24.5M <span
                        class="text-xs font-medium text-gray-400">UZS</span></h3>
            </div>
            <span class="p-2 bg-gray-50 rounded-xl text-xl">💵</span>
        </div>
        <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Plastik
                    (Terminal/Click)</span>
                <h3 class="text-xl font-bold text-gray-900 mt-1">45.8M <span
                        class="text-xs font-medium text-gray-400">UZS</span></h3>
            </div>
            <span class="p-2 bg-gray-50 rounded-xl text-xl">💳</span>
        </div>
        <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Bank hisob raqami</span>
                <h3 class="text-xl font-bold text-gray-900 mt-1">15.0M <span
                        class="text-xs font-medium text-gray-400">UZS</span></h3>
            </div>
            <span class="p-2 bg-gray-50 rounded-xl text-xl">🏦</span>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm overflow-hidden">
        <div
            class="p-5 border-b border-gray-100 bg-gray-50/50 flex flex-col sm:flex-row justify-between items-center gap-4">
            <h3 class="text-base font-bold text-gray-900 align-middle">Oxirgi moliyaviy amallar</h3>
            <div class="flex gap-3 w-full sm:w-auto">
                <select
                    class="bg-white border border-gray-200 rounded-xl px-3 py-2 text-xs text-gray-600 focus:outline-none">
                    <option value="">Barcha amallar</option>
                    <option value="income">Faqat Kirim (To'lovlar)</option>
                    <option value="expense">Faqat Chiqim (Xarajatlar)</option>
                </select>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-left">
                <thead class="bg-gray-50 text-xs font-bold text-gray-500 uppercase">
                    <tr>
                        <th class="px-6 py-3.5">ID / Sana</th>
                        <th class="px-6 py-3.5">Tur (Kategoriya)</th>
                        <th class="px-6 py-3.5">Tavsif (Kim tomonidan)</th>
                        <th class="px-6 py-3.5">To'lov turi</th>
                        <th class="px-6 py-3.5 text-right">Summa</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm text-gray-700">

                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <span class="font-medium text-gray-900 text-xs">#TR-8942</span>
                            <span class="block text-[11px] text-gray-400 mt-0.5">Bugun, 15:40</span>
                        </td>
                        <td class="px-6 py-4">
                            <span
                                class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium bg-emerald-50 text-emerald-700">Kirim</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-900">Diyorbek Umarov</div>
                            <div class="text-xs text-gray-500">F1-10 kursi uchun oylik to'lov</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-xs text-gray-600 font-medium">💳 Plastik (Click)</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <span class="font-bold text-emerald-600">+1,200,000 <span
                                    class="text-[10px] font-normal text-gray-400">UZS</span></span>
                        </td>
                    </tr>

                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <span class="font-medium text-gray-900 text-xs">#TR-8941</span>
                            <span class="block text-[11px] text-gray-400 mt-0.5">Bugun, 11:15</span>
                        </td>
                        <td class="px-6 py-4">
                            <span
                                class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium bg-red-50 text-red-700">Chiqim</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-900">O'quv markazi ijarasi</div>
                            <div class="text-xs text-gray-500">Bino egasiga 1 oylik ijara to'lovi</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-xs text-gray-600 font-medium">🏦 Bank o'tkazmasi</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <span class="font-bold text-red-600">-8,500,000 <span
                                    class="text-[10px] font-normal text-red-400">UZS</span></span>
                        </td>
                    </tr>

                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <span class="font-medium text-gray-900 text-xs">#TR-8940</span>
                            <span class="block text-[11px] text-gray-400 mt-0.5">Kecha, 18:20</span>
                        </td>
                        <td class="px-6 py-4">
                            <span
                                class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium bg-emerald-50 text-emerald-700">Kirim</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-900">Kamola Solihova</div>
                            <div class="text-xs text-gray-500">UX-04 kursi uchun sinov darsi to'lovi</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-xs text-gray-600 font-medium">💵 Naqd pul</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <span class="font-bold text-emerald-600">+150,000 <span
                                    class="text-[10px] font-normal text-gray-400">UZS</span></span>
                        </td>
                    </tr>

                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <span class="font-medium text-gray-900 text-xs">#TR-8939</span>
                            <span class="block text-[11px] text-gray-400 mt-0.5">22.05.2026</span>
                        </td>
                        <td class="px-6 py-4">
                            <span
                                class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium bg-red-50 text-red-700">Chiqim</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-900">Shaxzod Anvarov (O'qituvchi)</div>
                            <div class="text-xs text-gray-500">Aprel oyi uchun dars o'tganlik oylik maoshi</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-xs text-gray-600 font-medium">💳 Plastik (Karta)</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <span class="font-bold text-red-600">-4,200,000 <span
                                    class="text-[10px] font-normal text-red-400">UZS</span></span>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</x-layout.manage.app>
