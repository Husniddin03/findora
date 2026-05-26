<div>
    <div class="mb-4">
        <h3 class="text-lg font-bold text-gray-900">Yangi guruh yaratish</h3>
        <p class="text-xs text-gray-500">O'quv markazida yangi guruhni dars jadvali bilan shakllantiring.</p>
    </div>

    <form action="{{ route('manage.groups.store', $center->slug) }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Kursni tanlang</label>
            <select name="course_id" required class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:ring-2 focus:ring-indigo-500/20">
                @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Guruh nomi</label>
                <input type="text" name="name" placeholder="Masalan: F1-10" required class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3 py-2.5 text-sm">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">O'qituvchi (Ustoz)</label>
                <select name="staff_id" required class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3 py-2.5 text-sm">
                    <option value="">O'qituvchini tanlang</option>
                    @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}">{{ $teacher->name }} ({{ $teacher->specialty }})</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Kunlar</label>
                <select name="days_type" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3 py-2.5 text-sm">
                    <option value="odd">Toq kunlari (Dsh-Chsh-Jm)</option>
                    <option value="even">Juft kunlari (Ssh-Ph-Sh)</option>
                    <option value="custom">Boshqa</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Boshlanish vaqti</label>
                <input type="time" name="start_time" required class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3 py-2.5 text-sm">
            </div>
            </div>

        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Max o'quvchi soni</label>
                <input type="number" name="max_students" value="15" required class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3 py-2.5 text-sm">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Status</label>
                <select name="status" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3 py-2.5 text-sm">
                    <option value="collecting">Yig'ilmoqda</option>
                    <option value="active">Faol</option>
                    <option value="finished">Tugatgan</option>
                </select>
            </div>
        </div>

        <div class="flex justify-end gap-2 pt-3 border-t">
            <button type="button" @click="openCreateModal = false" class="px-4 py-2.5 text-sm font-medium text-gray-600 bg-white border rounded-xl hover:bg-gray-50">Bekor qilish</button>
            <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-indigo-600 rounded-xl hover:bg-indigo-700">Saqlash</button>
        </div>
    </form>
</div>