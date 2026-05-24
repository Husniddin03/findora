<x-layout.manage.app :center="$center">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Tizim Sozlamalari</h2>
        <p class="text-sm text-gray-500 mt-1">O'quv markazi ma'lumotlari, dars xonalari va tashqi tizim
            integratsiyalarini boshqarish</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 items-start">

        <div class="lg:col-span-1 bg-white rounded-2xl border border-gray-100 shadow-sm p-3 space-y-1">
            <button
                class="w-full flex items-center space-x-3 px-4 py-2.5 text-sm font-medium rounded-xl bg-indigo-50 text-indigo-700 transition-colors">
                <span class="text-base">🏢</span>
                <span>Markaz profili</span>
            </button>
            <button
                class="w-full flex items-center space-x-3 px-4 py-2.5 text-sm font-medium rounded-xl text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-colors">
                <span class="text-base">🚪</span>
                <span>Dars xonalari</span>
            </button>
            <button
                class="w-full flex items-center space-x-3 px-4 py-2.5 text-sm font-medium rounded-xl text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-colors">
                <span class="text-base">🔗</span>
                <span>SMS & API Integratsiya</span>
            </button>
            <button
                class="w-full flex items-center space-x-3 px-4 py-2.5 text-sm font-medium rounded-xl text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-colors">
                <span class="text-base">🛡️</span>
                <span>Xavfsizlik & Huquqlar</span>
            </button>
        </div>

        <div class="lg:col-span-3 space-y-6">

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h3 class="text-base font-bold text-gray-900 mb-4 pb-2 border-b border-gray-50">Markaz umumiy
                    ma'lumotlari</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 uppercase mb-2">O'quv markazi
                            nomi</label>
                        <input type="text" value="FindCourse Academy"
                            class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 uppercase mb-2">Telefon raqami</label>
                        <input type="text" value="+998 66 233 44 55"
                            class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-xs font-semibold text-gray-600 uppercase mb-2">Manzil</label>
                        <input type="text" value="Samarqand shahri, Dagbitskaya ko'chasi, 45-uy"
                            class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <div class="flex items-center justify-between mb-4 pb-2 border-b border-gray-50">
                    <h3 class="text-base font-bold text-gray-900">SMS Provayder (Eskiz.uz) integratsiyasi</h3>
                    <span
                        class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-50 text-green-700">Ulangan</span>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 uppercase mb-2">Eskiz Email
                            (Login)</label>
                        <input type="email" value="info@findcourse.uz"
                            class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 uppercase mb-2">Eskiz API Token (Secret
                            Key)</label>
                        <div class="relative">
                            <input type="password"
                                value="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIi..."
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl pl-3.5 pr-10 py-2.5 text-sm text-gray-800 font-mono focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
                            <button type="button"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                                👁️
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end space-x-3 bg-gray-50 p-4 rounded-2xl border border-gray-100">
                <button type="button"
                    class="px-4 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors shadow-sm">
                    Bekor qilish
                </button>
                <button type="submit"
                    class="px-5 py-2 text-sm font-medium text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 transition-colors shadow-sm">
                    O'zgarishlarni saqlash
                </button>
            </div>

        </div>
    </div>
</x-layout.manage.app>
