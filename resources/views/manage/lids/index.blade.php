<x-layout.manage.app :center="$center">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Lidlar (Arizalar) boshqaruvi</h2>
            <p class="text-sm text-gray-500 mt-1">Potensial mijozlar oqimi va sotuv voronkasi (Kanban)</p>
        </div>
        <div class="flex items-center gap-3">
            <button
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-xl shadow-sm hover:bg-gray-50">
                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z">
                    </path>
                </svg>
                Kurslar bo'yicha filtr
            </button>
            <button
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-xl shadow-sm hover:bg-indigo-700 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Yangi ariza qo'shish
            </button>
        </div>
    </div>

    <div
        class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 items-start h-[calc(100vh-200px)] overflow-y-auto pb-6">

        <div class="bg-gray-50 rounded-2xl p-4 border border-gray-200/60 flex flex-col max-h-full">
            <div class="flex items-center justify-between mb-3 px-1">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-blue-500"></span>
                    <h3 class="font-semibold text-gray-800 text-sm">Yangi kelganlar</h3>
                </div>
                <span class="text-xs font-bold text-gray-400 bg-gray-200/60 px-2 py-0.5 rounded-full">2</span>
            </div>

            <div class="space-y-3 overflow-y-auto custom-scrollbar pr-1">

                <div
                    class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-all cursor-grab active:cursor-grabbing">
                    <div class="flex items-center justify-between gap-2 mb-2">
                        <span class="px-2 py-0.5 text-[10px] font-medium bg-blue-50 text-blue-600 rounded">Python Boot
                            camp</span>
                        <span class="text-[10px] text-gray-400">Bugun, 14:20</span>
                    </div>
                    <h4 class="font-medium text-gray-900 text-sm">Asror Hikmatov</h4>
                    <p class="text-xs text-gray-500 mt-1">+998 90 123 45 67</p>
                    <div
                        class="mt-3 pt-3 border-t border-gray-50 flex items-center justify-between text-[11px] text-gray-400">
                        <span>Manba: Telegram Bot</span>
                        <span class="p-1 rounded hover:bg-gray-100 text-gray-500">💬</span>
                    </div>
                </div>

                <div
                    class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-all cursor-grab">
                    <div class="flex items-center justify-between gap-2 mb-2">
                        <span class="px-2 py-0.5 text-[10px] font-medium bg-purple-50 text-purple-600 rounded">Grafik
                            Dizayn</span>
                        <span class="text-[10px] text-gray-400">Kecha</span>
                    </div>
                    <h4 class="font-medium text-gray-900 text-sm">Kamola Solihova</h4>
                    <p class="text-xs text-gray-500 mt-1">+998 99 456 11 22</p>
                    <div
                        class="mt-3 pt-3 border-t border-gray-50 flex items-center justify-between text-[11px] text-gray-400">
                        <span>Manba: Veb-sayt</span>
                        <span class="p-1 rounded hover:bg-gray-100 text-gray-500">📞</span>
                    </div>
                </div>

            </div>
        </div>

        <div class="bg-gray-50 rounded-2xl p-4 border border-gray-200/60 flex flex-col max-h-full">
            <div class="flex items-center justify-between mb-3 px-1">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                    <h3 class="font-semibold text-gray-800 text-sm">Aloqaga chiqilgan</h3>
                </div>
                <span class="text-xs font-bold text-gray-400 bg-gray-200/60 px-2 py-0.5 rounded-full">1</span>
            </div>

            <div class="space-y-3 overflow-y-auto">
                <div
                    class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-all cursor-grab">
                    <div class="flex items-center justify-between gap-2 mb-2">
                        <span class="px-2 py-0.5 text-[10px] font-medium bg-amber-50 text-amber-700 rounded">English
                            IELTS</span>
                        <span
                            class="text-[10px] text-amber-600 bg-amber-50/50 px-1 rounded font-medium">O'ylayapti</span>
                    </div>
                    <h4 class="font-medium text-gray-900 text-sm">Sardor Malikova</h4>
                    <p class="text-xs text-gray-500 mt-1">+998 93 987 65 43</p>
                    <p class="text-[11px] text-red-500 mt-2 bg-red-50/50 p-1.5 rounded">⚠️ Narxi qimmatlik qildi,
                        chegirma so'radi.</p>
                    <div
                        class="mt-3 pt-3 border-t border-gray-50 flex items-center justify-between text-[11px] text-gray-400">
                        <span>Qayta qo'ng'iroq: Ertagiga</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 rounded-2xl p-4 border border-gray-200/60 flex flex-col max-h-full">
            <div class="flex items-center justify-between mb-3 px-1">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-indigo-500"></span>
                    <h3 class="font-semibold text-gray-800 text-sm">Sinov darsiga yozilgan</h3>
                </div>
                <span class="text-xs font-bold text-gray-400 bg-gray-200/60 px-2 py-0.5 rounded-full">1</span>
            </div>

            <div class="space-y-3 overflow-y-auto">
                <div
                    class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-all cursor-grab">
                    <div class="flex items-center justify-between gap-2 mb-2">
                        <span
                            class="px-2 py-0.5 text-[10px] font-medium bg-emerald-50 text-emerald-600 rounded">Frontend
                            Node.js</span>
                        <span class="text-[10px] text-gray-400">Dars: 26.05</span>
                    </div>
                    <h4 class="font-medium text-gray-900 text-sm">Diyorbek Umarov</h4>
                    <p class="text-xs text-gray-500 mt-1">+998 94 333 22 11</p>
                    <div
                        class="mt-3 pt-3 border-t border-gray-50 flex items-center justify-between text-[11px] text-gray-400">
                        <span>Xona: 2-Xona, 18:30</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 rounded-2xl p-4 border border-gray-200/60 flex flex-col max-h-full">
            <div class="flex items-center justify-between mb-3 px-1">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-green-500"></span>
                    <h3 class="font-semibold text-gray-800 text-sm">Guruhga qo'shildi 🎉</h3>
                </div>
                <span class="text-xs font-bold text-gray-400 bg-gray-200/60 px-2 py-0.5 rounded-full">0</span>
            </div>

            <div class="border-2 border-dashed border-gray-200 rounded-xl p-8 text-center text-gray-400 text-xs">
                Hozircha faol guruhga qo'shilganlar yo'q. Liddni shu yerga sudrab o'tkazing.
            </div>
        </div>

    </div>
</x-layout.manage.app>
