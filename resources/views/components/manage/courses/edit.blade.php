<div>
    <div class="mb-5">
        <h3 class="text-lg font-bold text-gray-900">Kurs ma'lumotlarini tahrirlash</h3>
        <p class="text-xs text-gray-500 mt-1">Tanlangan kurs parametrlarini o'zgartiring.</p>
    </div>
    
    <form :action="'/manage/courses/{{ $center->slug }}/' + editingCourse.id + '/update'" method="POST" class="space-y-4">
        @csrf
        @method('PUT') <div class="grid grid-cols-4 gap-3">
            <div class="col-span-1">
                <label class="block text-xs font-semibold text-gray-600 uppercase mb-1.5">Belgi</label>
                <select x-model="editingCourse.icon" name="icon"
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
                <input type="text" x-model="editingCourse.title" name="title" required
                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
            </div>
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-600 uppercase mb-1.5">Oylik to'lov summasi (UZS)</label>
            <div class="relative">
                <input type="number" x-model="editingCourse.price" name="price" required
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
                <select x-model="editingCourse.duration_months" name="duration_months"
                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
                    <option value="1">1 oy</option>
                    <option value="3">3 oy</option>
                    <option value="4">4 oy</option>
                    <option value="6">6 oy</option>
                    <option value="9">9 oy</option>
                    <option value="12">1 yil</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 uppercase mb-1.5">Haftada necha kun</label>
                <select x-model="editingCourse.lessons_per_week" name="lessons_per_week"
                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
                    <option value="2">2 kun</option>
                    <option value="3">3 kun</option>
                    <option value="4">4 kun</option>
                    <option value="5">5 kun</option>
                    <option value="6">6 kun</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 uppercase mb-1.5">Dars vaqti</label>
                <select x-model="editingCourse.lesson_duration_minutes" name="lesson_duration_minutes"
                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
                    <option value="60">1 soat (60 m)</option>
                    <option value="90">1.5 soat (90 m)</option>
                    <option value="120">2 soat (120 m)</option>
                    <option value="180">3 soat (180 m)</option>
                </select>
            </div>
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-600 uppercase mb-1.5">Kurs haqida tavsif
                (Ixtiyoriy)</label>
            <textarea x-model="editingCourse.description" name="description" rows="3"
                class="w-full bg-gray-50 border border-gray-200 rounded-xl p-3 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all"></textarea>
        </div>

        <div class="flex items-center justify-end space-x-3 pt-3 border-t border-gray-100">
            <button type="button" @click="openEditModal = false"
                class="px-4 py-2.5 text-sm font-medium text-gray-600 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors shadow-sm">
                Bekor qilish
            </button>
            <button type="submit"
                class="px-5 py-2.5 text-sm font-medium text-white bg-amber-600 hover:bg-amber-700 rounded-xl transition-colors shadow-sm">
                O'zgarishlarni saqlash
            </button>
        </div>
    </form>
</div>
