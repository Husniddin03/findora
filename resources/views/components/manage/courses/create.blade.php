<div>
    <div class="mb-5">
        <h3 class="text-lg font-bold text-gray-900">Yangi kurs qo'shish</h3>
        <p class="text-xs text-gray-500 mt-1">O'quv markazi uchun yangi ta'lim yo'nalishi va uning standart
            parametrlarini belgilang.</p>
    </div>

    <form action="{{ route('manage.courses.store', $center) }}" method="POST" class="space-y-4">
        @csrf
        <input type="hidden" name="learning_center_id" value="{{ $center->id }}">

        <div class="grid grid-cols-4 gap-3">
            <div class="col-span-1">
                <label class="block text-xs font-semibold text-gray-600 uppercase mb-1.5">Belgi</label>
                <select name="icon"
                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3 py-2.5 text-sm text-center focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
                    <option value="🌐">🌐</option>
                    <option value="🇬🇧">🇬🇧</option>
                    <option value="🎨">🎨</option>
                    <option value="💻">💻</option>
                    <option value="🔢">🔢</option>
                    <option value="🚀">🚀</option>
                    <option value="📚">📚</option>
                </select>
            </div>
            <div class="col-span-3">
                <label class="block text-xs font-semibold text-gray-600 uppercase mb-1.5">Kurs nomi</label>
                <input type="text" name="title" required placeholder="Masalan: Frontend Boot camp"
                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
            </div>
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-600 uppercase mb-1.5">Oylik to'lov summasi (UZS)</label>
            <div class="relative">
                <input type="number" name="price" required placeholder="1200000"
                    class="w-full bg-gray-50 border border-gray-200 rounded-xl pl-3.5 pr-12 py-2.5 text-sm text-gray-800 font-medium focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
                <div
                    class="absolute inset-y-0 right-0 pr-3.5 flex items-center pointer-events-none text-xs font-semibold text-gray-400">
                    UZS
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
            <div>
                <label class="block text-xs font-semibold text-gray-600 uppercase mb-1.5">Davomiyligi</label>
                <select name="duration_months"
                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
                    <option value="1">1 oy</option>
                    <option value="3">3 oy</option>
                    <option value="4">4 oy</option>
                    <option value="6" selected>6 oy</option>
                    <option value="9">9 oy</option>
                    <option value="12">1 yil</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 uppercase mb-1.5">Haftada necha kun</label>
                <select name="lessons_per_week"
                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
                    <option value="2">2 kun</option>
                    <option value="3" selected>3 kun</option>
                    <option value="4">4 kun</option>
                    <option value="5">5 kun</option>
                    <option value="6">6 kun</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 uppercase mb-1.5">Dars vaqti</label>
                <select name="lesson_duration_minutes"
                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
                    <option value="60">1 soat (60 m)</option>
                    <option value="90" selected>1.5 soat (90 m)</option>
                    <option value="120">2 soat (120 m)</option>
                    <option value="180">3 soat (180 m)</option>
                </select>
            </div>
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-600 uppercase mb-1.5">Kurs haqida tavsif
                (Ixtiyoriy)</label>
            <textarea name="description" rows="3"
                placeholder="Kursda o'rgatiladigan texnologiyalar yoki darsliklar haqida qisqacha..."
                class="w-full bg-gray-50 border border-gray-200 rounded-xl p-3 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all"></textarea>
        </div>

        <div class="flex items-center justify-end space-x-3 pt-3 border-t border-gray-100">
            <button type="button" @click="openCreateModal = false"
                class="px-4 py-2.5 text-sm font-medium text-gray-600 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors shadow-sm">
                Bekor qilish
            </button>
            <button type="submit"
                class="px-5 py-2.5 text-sm font-medium text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 transition-colors shadow-sm">
                Kursni saqlash
            </button>
        </div>
    </form>
</div>
