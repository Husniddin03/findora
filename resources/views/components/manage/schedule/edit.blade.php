<div x-show="editModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;" x-cloak>
    <div class="fixed inset-0 bg-gray-500/75 backdrop-blur-sm" @click="editModal = false"></div>
    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <div
            class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">

            <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h3 class="text-base font-semibold text-gray-900">Dars jadvalini tahrirlash</h3>
                <button @click="editModal = false" class="text-gray-400 hover:text-gray-500">✕</button>
            </div>

            <form :action="'/manage/schedules/' + '{{ $center->slug }}' + '/' + editData.id" method="POST">
                @csrf
                @method('PUT')
                <div class="bg-white px-6 py-4 space-y-4">

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Guruhni tanlang *</label>
                        <select name="group_id" x-model="editData.group_id" required
                            class="w-full px-3 py-2 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
                            @foreach ($groups as $group)
                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Xonani tanlang *</label>
                        <select name="room_id" x-model="editData.room_id" required
                            class="w-full px-3 py-2 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
                            <option value="">Xonani tanlang</option>
                            @foreach ($rooms as $room)
                                <option value="{{ $room->id }}">{{ $room->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Dars kunlari turi *</label>
                        <select name="day_type" x-model="editData.day_type" required
                            class="w-full px-3 py-2 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
                            <option value="odd">Toq kunlar (Dush / Chor / Jum)</option>
                            <option value="even">Juft kunlar (Sesh / Pay / Sha)</option>
                            <option value="workdays_5">Ish kunlari (Dush - Jum, 5 kun)</option>
                            <option value="workdays_6">Ish kunlari (Dush - Sha, 6 kun)</option>
                            <option value="everyday">Har kuni (Dush - Sha)</option>
                            <option value="custom">Maxsus kunlarni tanlash</option>
                        </select>
                    </div>

                    <div x-show="editData.day_type === 'custom'"
                        class="p-3 bg-gray-50 rounded-xl grid grid-cols-2 gap-2">
                        <label class="inline-flex items-center text-xs text-gray-700 font-medium"><input type="checkbox"
                                name="custom_days[]" value="1"
                                :checked="editData.custom_days && editData.custom_days.map(String).includes('1')"
                                class="rounded mr-2 text-indigo-600"> Dushanba</label>
                        <label class="inline-flex items-center text-xs text-gray-700 font-medium"><input type="checkbox"
                                name="custom_days[]" value="2"
                                :checked="editData.custom_days && editData.custom_days.map(String).includes('2')"
                                class="rounded mr-2 text-indigo-600"> Seshanba</label>
                        <label class="inline-flex items-center text-xs text-gray-700 font-medium"><input type="checkbox"
                                name="custom_days[]" value="3"
                                :checked="editData.custom_days && editData.custom_days.map(String).includes('3')"
                                class="rounded mr-2 text-indigo-600"> Chorshanba</label>
                        <label class="inline-flex items-center text-xs text-gray-700 font-medium"><input type="checkbox"
                                name="custom_days[]" value="4"
                                :checked="editData.custom_days && editData.custom_days.map(String).includes('4')"
                                class="rounded mr-2 text-indigo-600"> Payshanba</label>
                        <label class="inline-flex items-center text-xs text-gray-700 font-medium"><input type="checkbox"
                                name="custom_days[]" value="5"
                                :checked="editData.custom_days && editData.custom_days.map(String).includes('5')"
                                class="rounded mr-2 text-indigo-600"> Juma</label>
                        <label class="inline-flex items-center text-xs text-gray-700 font-medium"><input type="checkbox"
                                name="custom_days[]" value="6"
                                :checked="editData.custom_days && editData.custom_days.map(String).includes('6')"
                                class="rounded mr-2 text-indigo-600"> Shanba</label>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Boshlanish vaqti *</label>
                            <input type="time" name="start_time" x-model="editData.start_time" required
                                class="w-full px-3 py-2 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Tugash vaqti *</label>
                            <input type="time" name="end_time" x-model="editData.end_time" required
                                class="w-full px-3 py-2 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 px-6 py-3.5 border-t border-gray-100 flex justify-end space-x-2 rounded-b-2xl">
                    <button type="button" @click="editModal = false"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-xl hover:bg-gray-50">Bekor
                        qilish</button>
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-amber-600 rounded-xl hover:bg-amber-700 shadow-sm">Yangilash</button>
                </div>
            </form>
        </div>
    </div>
</div>
