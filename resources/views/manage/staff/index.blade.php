<x-layout.manage.app :center="$center">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Xodimlar va O'qituvchilar</h2>
            <p class="text-sm text-gray-500 mt-1">Markaz jamoasi a'zolari ro'yxati, lavozimlari va ularning tizimdagi
                huquqlari</p>
        </div>
        <div>
            <button
                class="inline-flex items-center px-4 py-2.5 text-sm font-medium text-white bg-indigo-600 rounded-xl shadow-sm hover:bg-indigo-700 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
                Yangi xodim qo'shish
            </button>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div
            class="p-5 border-b border-gray-100 bg-gray-50/50 flex flex-col sm:flex-row justify-between items-center gap-4">
            <div class="flex bg-gray-100 p-1 rounded-xl w-full sm:w-auto">
                <button class="px-4 py-1.5 text-xs font-medium rounded-lg bg-white text-gray-900 shadow-sm">Barchasi
                    (8)</button>
                <button
                    class="px-4 py-1.5 text-xs font-medium rounded-lg text-gray-500 hover:text-gray-900 transition-colors">O'qituvchilar
                    (5)</button>
                <button
                    class="px-4 py-1.5 text-xs font-medium rounded-lg text-gray-500 hover:text-gray-900 transition-colors">Administratsiya
                    (3)</button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-left">
                <thead class="bg-gray-50 text-xs font-bold text-gray-500 uppercase">
                    <tr>
                        <th class="px-6 py-4">Xodim</th>
                        <th class="px-6 py-4">Lavozimi / Sohasi</th>
                        <th class="px-6 py-4">Yuklama (Guruhlar)</th>
                        <th class="px-6 py-4">Tizimga kirish roli</th>
                        <th class="px-6 py-4 text-right">Amallar</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm text-gray-700">

                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <div
                                    class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-sm shrink-0">
                                    SA
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Shaxzod Anvarov</h4>
                                    <p class="text-xs text-gray-500">+998 90 123 45 67</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-900">Senior Mentor</div>
                            <div class="text-xs text-gray-500">IT & Dasturlash (Frontend)</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-2">
                                <span class="font-semibold text-gray-900">3 ta guruh</span>
                                <span class="text-xs text-gray-400">(32 ta o'quvchi)</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium bg-blue-50 text-blue-700">Teacher</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end space-x-2">
                                <button
                                    class="p-1.5 text-gray-400 hover:text-indigo-600 hover:bg-gray-50 rounded-lg transition-colors"
                                    title="Profilini ko'rish">👁️</button>
                                <button
                                    class="p-1.5 text-gray-400 hover:text-amber-600 hover:bg-gray-50 rounded-lg transition-colors"
                                    title="Tahrirlash">✏️</button>
                            </div>
                        </td>
                    </tr>

                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <div
                                    class="w-10 h-10 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center font-bold text-sm shrink-0">
                                    NA
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Nodira Aliyeva</h4>
                                    <p class="text-xs text-gray-500">+998 99 888 77 66</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-900">Bosh Administrator</div>
                            <div class="text-xs text-gray-500">Mijozlar bilan ishlash & Sotuv</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-xs text-gray-400">—</span>
                        </td>
                        <td class="px-6 py-4">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium bg-purple-50 text-purple-700">Admin</span>
                        </td>
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
                                    class="w-10 h-10 rounded-full bg-amber-100 text-amber-700 flex items-center justify-center font-bold text-sm shrink-0">
                                    JD
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900">John Doe</h4>
                                    <p class="text-xs text-gray-500">johndoe@example.com</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-900">IELTS Instructor</div>
                            <div class="text-xs text-gray-500">Ingliz tili (Native Speaker)</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-2">
                                <span class="font-semibold text-gray-900">2 ta guruh</span>
                                <span class="text-xs text-gray-400">(20 ta o'quvchi)</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium bg-blue-50 text-blue-700">Teacher</span>
                        </td>
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
    </div>
</x-layout.manage.app>
