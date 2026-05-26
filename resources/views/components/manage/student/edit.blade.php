<div x-show="editModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;" x-cloak>
    <div class="fixed inset-0 bg-gray-500/75 backdrop-blur-sm" @click="editModal = false"></div>
    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h3 class="text-base font-semibold text-gray-900">O'quvchi ma'lumotlarini tahrirlash</h3>
                <button @click="editModal = false" class="text-gray-400 hover:text-gray-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <form :action="'/manage/students/' + '{{ $center->slug }}' + '/' + editData.id" method="POST">
                @csrf
                @method('PUT')
                <div class="bg-white px-6 py-4 space-y-4 max-h-[70vh] overflow-y-auto">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">F.I.Sh *</label>
                        <input type="text" name="name" x-model="editData.name" required
                               class="w-full px-3 py-2 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Telefon raqami *</label>
                            <input type="text" name="phone_number" x-model="editData.phone_number" required
                                   class="w-full px-3 py-2 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Ota-onasi raqami</label>
                            <input type="text" name="parent_phone_number" x-model="editData.parent_phone_number"
                                   class="w-full px-3 py-2 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Tug'ilgan sanasi</label>
                            <input type="date" name="birth_date" x-model="editData.birth_date"
                                   class="w-full px-3 py-2 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Jinsi</label>
                            <select name="gender" x-model="editData.gender" class="w-full px-3 py-2 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
                                <option value="male">Erkak</option>
                                <option value="female">Ayol</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Balans (UZS) *</label>
                            <input type="number" name="balance" x-model="editData.balance" required
                                   class="w-full px-3 py-2 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Holati *</label>
                            <select name="status" x-model="editData.status" class="w-full px-3 py-2 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
                                <option value="active">Faol</option>
                                <option value="frozen">Muzlatilgan</option>
                                <option value="left">Ketgan / Bitirgan</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1.5">Faol guruhlari</label>
                        <div class="border border-gray-200 rounded-xl p-3 bg-gray-50/50 space-y-2 max-h-40 overflow-y-auto">
                            @foreach($groups as $group)
                                <label class="flex items-center space-x-2.5 text-sm font-medium text-gray-700 cursor-pointer">
                                    <input type="checkbox" name="group_ids[]" value="{{ $group->id }}"
                                           :checked="editData.groups && editData.groups.some(g => g.id === {{ $group->id }})"
                                           class="w-4 h-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    <span>{{ $group->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 px-6 py-3.5 border-t border-gray-100 flex justify-end space-x-2 rounded-b-2xl">
                    <button type="button" @click="editModal = false" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-xl hover:bg-gray-50">Bekor qilish</button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-amber-600 rounded-xl hover:bg-amber-700 shadow-sm">Yangilash</button>
                </div>
            </form>
        </div>
    </div>
</div>