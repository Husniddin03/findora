<div x-show="scheduleModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;" x-cloak>
    <div class="fixed inset-0 bg-gray-500/75 backdrop-blur-sm" @click="scheduleModal = false"></div>
    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <div
            class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">

            <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h3 class="text-base font-semibold text-gray-900">Jadvalga yangi dars qo'shish</h3>
                <button @click="scheduleModal = false" class="text-gray-400 hover:text-gray-500">✕</button>
            </div>

            <form action="{{ route('manage.schedules.store', $center->slug) }}" method="POST">
                @csrf
                <div class="bg-white px-6 py-4 space-y-4" x-data="{ dayType: 'odd' }">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Guruhni tanlang *</label>
                        <select name="group_id" required
                            class="w-full px-3 py-2 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
                            <option value="">Guruhni tanlang</option>
                            @foreach ($groups as $group)
                                <option value="{{ $group->id }}">{{ $group->name }}
                                    ({{ $group->course->title ?? 'Kurs' }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Xonani tanlang *</label>
                        <select name="room_id" required
                            class="w-full px-3 py-2 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
                            <option value="">Xonani tanlang</option>
                            @foreach ($rooms as $room)
                                <option value="{{ $room->id }}">{{ $room->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Dars kunlari turi *</label>
                        <select name="day_type" x-model="dayType" required
                            class="w-full px-3 py-2 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
                            <option value="odd">Toq kunlar (Dush / Chor / Jum)</option>
                            <option value="even">Juft kunlar (Sesh / Pay / Sha)</option>
                            <option value="workdays_5">Ish kunlari (Dush - Jum, 5 kun)</option>
                            <option value="workdays_6">Ish kunlari (Dush - Sha, 6 kun)</option>
                            <option value="everyday">Har kuni (Dush - Sha)</option>
                            <option value="custom">Maxsus kunlarni tanlash</option>
                        </select>
                    </div>

                    <div x-show="dayType === 'custom'" class="p-3 bg-gray-50 rounded-xl grid grid-cols-2 gap-2"
                        style="display: none;">
                        <label class="inline-flex items-center text-xs text-gray-700 font-medium cursor-pointer"><input
                                type="checkbox" name="custom_days[]" value="1"
                                class="rounded border-gray-300 text-indigo-600 mr-2"> Dushanba</label>
                        <label class="inline-flex items-center text-xs text-gray-700 font-medium cursor-pointer"><input
                                type="checkbox" name="custom_days[]" value="2"
                                class="rounded border-gray-300 text-indigo-600 mr-2"> Seshanba</label>
                        <label class="inline-flex items-center text-xs text-gray-700 font-medium cursor-pointer"><input
                                type="checkbox" name="custom_days[]" value="3"
                                class="rounded border-gray-300 text-indigo-600 mr-2"> Chorshanba</label>
                        <label class="inline-flex items-center text-xs text-gray-700 font-medium cursor-pointer"><input
                                type="checkbox" name="custom_days[]" value="4"
                                class="rounded border-gray-300 text-indigo-600 mr-2"> Payshanba</label>
                        <label class="inline-flex items-center text-xs text-gray-700 font-medium cursor-pointer"><input
                                type="checkbox" name="custom_days[]" value="5"
                                class="rounded border-gray-300 text-indigo-600 mr-2"> Juma</label>
                        <label class="inline-flex items-center text-xs text-gray-700 font-medium cursor-pointer"><input
                                type="checkbox" name="custom_days[]" value="6"
                                class="rounded border-gray-300 text-indigo-600 mr-2"> Shanba</label>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Boshlanish vaqti *</label>
                            <input type="time" name="start_time" required
                                class="w-full px-3 py-2 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Tugash vaqti *</label>
                            <input type="time" name="end_time" required
                                class="w-full px-3 py-2 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 px-6 py-3.5 border-t border-gray-100 flex justify-end space-x-2 rounded-b-2xl">
                    <button type="button" @click="scheduleModal = false"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-xl hover:bg-gray-50">Bekor
                        qilish</button>
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 shadow-sm">Jadvalga
                        qo'shish</button>
                </div>
            </form>
        </div>
    </div>
</div>
