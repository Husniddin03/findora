<div>
    <div class="mb-4">
        <h3 class="text-lg font-bold text-gray-900">Guruh ma'lumotlarini tahrirlash</h3>
        <p class="text-xs text-gray-500">Mavjud guruh dars konfiguratsiyasini va statusini yangilang.</p>
    </div>

    <form :action="'/manage/groups/{{ $center->slug }}/' + selectedGroup.id + '/update'"
        method="POST"
        class="space-y-4"
    >
        @csrf
        @method('PUT')
        <div>
            <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Kursni o'zgartirish</label>
            <select name="course_id" x-model="selectedGroup.course_id" required class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3 py-2.5 text-sm">
                @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Guruh nomi</label>
                <input type="text" name="name" x-model="selectedGroup.name" required class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3 py-2.5 text-sm">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Ustoz ismi</label>
                <input type="text" name="teacher_name" x-model="selectedGroup.teacher_name" required class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3 py-2.5 text-sm">
            </div>
        </div>

        <div class="grid grid-cols-3 gap-3">
            <div>
                <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Kunlar</label>
                <select name="days_type" x-model="selectedGroup.days_type" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3 py-2.5 text-sm">
                    <option value="odd">Toq kunlari</option>
                    <option value="even">Juft kunlari</option>
                    <option value="custom">Boshqa</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Boshlanish vaqti</label>
                <input type="text" name="start_time" x-model="selectedGroup.start_time" required class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3 py-2.5 text-sm">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Xona</label>
                <input type="text" name="room" x-model="selectedGroup.room" required class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3 py-2.5 text-sm">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Max o'quvchi</label>
                <input type="number" name="max_students" x-model="selectedGroup.max_students" required class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3 py-2.5 text-sm">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Status</label>
                <select name="status" x-model="selectedGroup.status" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3 py-2.5 text-sm">
                    <option value="collecting">Yig'ilmoqda</option>
                    <option value="active">Faol</option>
                    <option value="finished">Tugatgan</option>
                </select>
            </div>
        </div>

        <div class="flex justify-end gap-2 pt-3 border-t">
            <button type="button" @click="openEditModal = false" class="px-4 py-2.5 text-sm font-medium text-gray-600 bg-white border rounded-xl hover:bg-gray-50">Bekor qilish</button>
            <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-amber-600 rounded-xl hover:bg-amber-700">O'zgarishlarni saqlash</button>
        </div>
    </form>
</div>