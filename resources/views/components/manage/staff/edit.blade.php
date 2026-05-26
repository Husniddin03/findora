<div x-show="editStaffModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;" x-cloak>
    <div class="fixed inset-0 bg-gray-500/75 backdrop-blur-sm" @click="editStaffModal = false"></div>
    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h3 class="text-base font-semibold text-gray-900">Xodim ma'lumotlarini tahrirlash</h3>
                <button @click="editStaffModal = false" class="text-gray-400 hover:text-gray-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form :action="'/manage/staff/' + '{{ $center->slug }}' + '/' + editData.id" method="POST">
                @csrf
                @method('PUT')
                <div class="bg-white px-6 py-4 space-y-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Xodim F.I.Sh *</label>
                        <input type="text" name="name" x-model="editData.name" required class="w-full px-3 py-2 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Telefon raqami</label>
                            <input type="text" name="phone_number" x-model="editData.phone_number" class="w-full px-3 py-2 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Email manzili</label>
                            <input type="email" name="email" x-model="editData.email" class="w-full px-3 py-2 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Lavozimi *</label>
                            <input type="text" name="title" x-model="editData.title" required class="w-full px-3 py-2 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Mutaxassisligi</label>
                            <input type="text" name="specialty" x-model="editData.specialty" class="w-full px-3 py-2 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Roli *</label>
                            <select name="role" x-model="editData.role" required class="w-full px-3 py-2 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
                                <option value="teacher">Teacher</option>
                                <option value="admin">Admin</option>
                                <option value="reception">Reception</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Holati *</label>
                            <select name="status" x-model="editData.status" required class="w-full px-3 py-2 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
                                <option value="active">Faol</option>
                                <option value="inactive">Bloklangan / Ketgan</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-6 py-3.5 border-t border-gray-100 flex justify-end space-x-2 rounded-b-2xl">
                    <button type="button" @click="editStaffModal = false" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-xl hover:bg-gray-50">Bekor qilish</button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-amber-600 rounded-xl hover:bg-amber-700 shadow-sm">Yangilash</button>
                </div>
            </form>
        </div>
    </div>
</div>