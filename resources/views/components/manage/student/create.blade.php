<div x-show="createModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;" x-cloak>
    <div class="fixed inset-0 bg-gray-500/75 backdrop-blur-sm" @click="createModal = false"></div>
    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h3 class="text-base font-semibold text-gray-900">Yangi o'quvchi qo'shish</h3>
                <button @click="createModal = false" class="text-gray-400 hover:text-gray-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <form action="{{ route('manage.students.store', $center->slug) }}" method="POST">
                @csrf
                <div class="bg-white px-6 py-4 space-y-4 max-h-[70vh] overflow-y-auto">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">F.I.Sh (To'liq ismi) *</label>
                        <input type="text" name="name" required placeholder="Masalan: Diyorbek Umarov"
                               class="w-full px-3 py-2 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Telefon raqami *</label>
                            <input type="text" name="phone_number" required placeholder="+998 90 123 45 67"
                                   class="w-full px-3 py-2 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Ota-onasi raqami</label>
                            <input type="text" name="parent_phone_number" placeholder="+998 99 765 43 21"
                                   class="w-full px-3 py-2 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Tug'ilgan sanasi</label>
                            <input type="date" name="birth_date"
                                   class="w-full px-3 py-2 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Jinsi</label>
                            <select name="gender" class="w-full px-3 py-2 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
                                <option value="">Tanlang</option>
                                <option value="male">Erkak</option>
                                <option value="female">Ayol</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Boshlang'ich Balans (UZS)</label>
                        <input type="number" name="balance" value="0"
                               class="w-full px-3 py-2 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1.5">Guruhlarga biriktirish (Bir nechta tanlash mumkin)</label>
                        <div class="border border-gray-200 rounded-xl p-3 bg-gray-50/50 space-y-2 max-h-40 overflow-y-auto">
                            @foreach($groups as $group)
                                <label class="flex items-center space-x-2.5 text-sm font-medium text-gray-700 cursor-pointer hover:text-indigo-600">
                                    <input type="checkbox" name="group_ids[]" value="{{ $group->id }}" 
                                           class="w-4 h-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    <span>{{ $group->name }}</span>
                                </label>
                            @endforeach
                            @if($groups->isEmpty())
                                <p class="text-xs text-gray-400 text-center py-2">Faol guruhlar mavjud emas.</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 px-6 py-3.5 border-t border-gray-100 flex justify-end space-x-2 rounded-b-2xl">
                    <button type="button" @click="createModal = false" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-xl hover:bg-gray-50">Bekor qilish</button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 shadow-sm">Saqlash</button>
                </div>
            </form>
        </div>
    </div>
</div>