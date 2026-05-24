<x-layout.manage.app :center="$center">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 tracking-tight">SMS Tarqatma xizmati</h2>
            <p class="text-sm text-gray-500 mt-1">O'quvchilar, ota-onalar va arizachilarga tizimli hamda ommaviy SMS
                xabarlar yuborish</p>
        </div>

        <div
            class="bg-white border border-gray-200/80 rounded-xl px-4 py-2 flex items-center space-x-3 shadow-sm shrink-0">
            <div
                class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center text-sm font-bold">
                💬
            </div>
            <div>
                <span class="text-[10px] text-gray-400 block uppercase font-semibold">SMS Provayder balansi</span>
                <span class="text-sm font-bold text-gray-900">14,250 <span
                        class="text-[11px] font-normal text-gray-500">ta SMS</span></span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">

        <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <h3 class="text-base font-bold text-gray-900 mb-4">Yangi xabar yaratish</h3>

            <form class="space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase mb-2">Kimga yuboriladi
                        (Auditoriya)</label>
                    <select
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
                        <option value="all_students">Barcha faol o'quvchilarga</option>
                        <option value="debtors">Faqat qarzdor o'quvchilarga</option>
                        <option value="leads">Faqat yangi kelgan lidlarga (Arizachilarga)</option>
                        <option value="group_f110">Muayyan guruhga (F1-10)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase mb-2">Tayyor shablonlar (Tezkor
                        tanlash)</label>
                    <div class="flex flex-wrap gap-2">
                        <button type="button"
                            class="px-3 py-1.5 text-xs border border-gray-200 bg-gray-50 hover:bg-gray-100 text-gray-700 rounded-lg transition-colors">
                            💰 Qarzdorlikni eslatish
                        </button>
                        <button type="button"
                            class="px-3 py-1.5 text-xs border border-gray-200 bg-gray-50 hover:bg-gray-100 text-gray-700 rounded-lg transition-colors">
                            🎉 Yangi guruh ochilishi
                        </button>
                        <button type="button"
                            class="px-3 py-1.5 text-xs border border-gray-200 bg-gray-50 hover:bg-gray-100 text-gray-700 rounded-lg transition-colors">
                            🛑 Dars qoldirish ogohlantirishi
                        </button>
                    </div>
                </div>

                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-xs font-semibold text-gray-600 uppercase">Xabar matni</label>
                        <span class="text-[11px] text-gray-400">Belgilar: <span class="text-gray-700 font-medium">42 /
                                160</span> (1 ta SMS)</span>
                    </div>
                    <textarea rows="4" placeholder="SMS matnini shu yerga yozing..."
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl p-3 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all"></textarea>
                    <p class="text-[11px] text-gray-400 mt-1">O'quvchi ismini avtomatik qo'yish uchun <code
                            class="bg-gray-100 px-1 py-0.5 rounded text-indigo-600 font-mono">%name%</code> kalit
                        so'zidan foydalaning.</p>
                </div>

                <div class="pt-2">
                    <button type="submit"
                        class="w-full inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-white bg-indigo-600 rounded-xl shadow-sm hover:bg-indigo-700 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                        Tarqatmani boshlash (Yuborish)
                    </button>
                </div>
            </form>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
            <h3 class="text-base font-bold text-gray-900 mb-4">Oxirgi jarayonlar</h3>

            <div class="space-y-4">

                <div class="p-3 bg-gray-50/70 border border-gray-100 rounded-xl">
                    <div class="flex justify-between items-start mb-1.5">
                        <span class="text-xs font-bold text-gray-800">Qarzdorlik ogohlantirishi</span>
                        <span
                            class="px-2 py-0.5 text-[10px] font-medium bg-green-50 text-green-700 rounded">Yuborildi</span>
                    </div>
                    <p class="text-xs text-gray-500 line-clamp-2">"Hurmatli o'quvchi, sizning kurs uchun to'lovingiz..."
                    </p>
                    <div class="mt-2 flex justify-between text-[10px] text-gray-400">
                        <span>Jami: 45 ta o'quvchiga</span>
                        <span>Bugun, 11:00</span>
                    </div>
                </div>

                <div class="p-3 bg-gray-50/70 border border-gray-100 rounded-xl">
                    <div class="flex justify-between items-start mb-1.5">
                        <span class="text-xs font-bold text-gray-800">Yangi Python kursi e'loni</span>
                        <span
                            class="px-2 py-0.5 text-[10px] font-medium bg-green-50 text-green-700 rounded">Yuborildi</span>
                    </div>
                    <p class="text-xs text-gray-500 line-clamp-2">"Markazimizda yangi Python Boot camp kursi
                        ochilmoqda..."</p>
                    <div class="mt-2 flex justify-between text-[10px] text-gray-400">
                        <span>Jami: 280 ta arizachiga</span>
                        <span>Kecha, 16:45</span>
                    </div>
                </div>

                <div class="p-3 bg-gray-50/70 border border-gray-100 rounded-xl">
                    <div class="flex justify-between items-start mb-1.5">
                        <span class="text-xs font-bold text-gray-800">Dars qoldirish (Jasur A.)</span>
                        <span
                            class="px-2 py-0.5 text-[10px] font-medium bg-green-50 text-green-700 rounded">Yuborildi</span>
                    </div>
                    <p class="text-xs text-gray-500 line-clamp-2">"Jasur Axmedov ketma-ket 3 ta darsda qatnashmadi..."
                    </p>
                    <div class="mt-2 flex justify-between text-[10px] text-gray-400">
                        <span>Ota-onasiga (Yakka)</span>
                        <span>22.05.2026</span>
                    </div>
                </div>

            </div>
        </div>

    </div>
</x-layout.manage.app>
