<div>
    <div class="border-b pb-3 mb-4">
        <span class="px-2 py-0.5 text-[10px] font-bold bg-indigo-50 text-indigo-700 rounded-md uppercase tracking-wider" x-text="selectedGroup.course.title"></span>
        <h3 class="text-xl font-bold text-gray-900 mt-1" x-text="selectedGroup.name"></h3>
    </div>

    <div class="space-y-3 text-sm text-gray-700 mb-6">
        <div class="flex justify-between py-1 border-b border-gray-50"><span class="text-gray-400">Asosiy Ustoz:</span> <span class="font-semibold text-gray-800" x-text="selectedGroup.teacher_name"></span></div>
        <div class="flex justify-between py-1 border-b border-gray-50"><span class="text-gray-400">Dars kunlari:</span> <span class="font-medium" x-text="selectedGroup.days_type == 'odd' ? 'Toq kunlari (Dsh-Chsh-Jm)' : (selectedGroup.days_type == 'even' ? 'Juft kunlari (Ssh-Ph-Sh)' : 'Boshqa kunlar')"></span></div>
        <div class="flex justify-between py-1 border-b border-gray-50"><span class="text-gray-400">Dars vaqti va Xona:</span> <span class="font-medium" x-text="selectedGroup.start_time + ' • ' + selectedGroup.room"></span></div>
        <div class="flex justify-between py-1 border-b border-gray-50"><span class="text-gray-400">Loyiha sig'imi:</span> <span class="font-medium" x-text="(selectedGroup.students_count || 0) + ' / ' + selectedGroup.max_students + ' ta o\'quvchi'"></span></div>
        <div class="flex justify-between py-1"><span class="text-gray-400">Guruh holati:</span> <span class="px-2 py-0.5 rounded-md text-xs font-medium" :class="selectedGroup.status == 'active' ? 'bg-green-50 text-green-700' : 'bg-amber-50 text-amber-700'" x-text="selectedGroup.status == 'active' ? 'Faol dars jarayonida' : 'O\'quvchilar yig\'ilmoqda'"></span></div>
    </div>

    <div class="flex items-center justify-between pt-3 border-t">
        <button type="button" @click="openShowModal = false; openDeleteModal = true" class="text-xs font-semibold text-red-600 hover:bg-red-50 px-3 py-2 rounded-xl transition-colors">
            🗑️ Guruhni o'chirish
        </button>
        
        <div class="flex gap-2">
            <button type="button" @click="openShowModal = false; openEditModal = true" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-50 border border-gray-200 rounded-xl hover:bg-gray-100 shadow-sm">
                ✏️ Tahrirlash
            </button>
            <button type="button" @click="openShowModal = false" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-xl hover:bg-indigo-700">
                Yopish
            </button>
        </div>
    </div>
</div>