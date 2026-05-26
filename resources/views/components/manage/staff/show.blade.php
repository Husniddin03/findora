<div x-show="showStaffModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;" x-cloak>
    <div class="fixed inset-0 bg-gray-500/75 backdrop-blur-sm" @click="showStaffModal = false"></div>
    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-md p-6">
            <div class="flex justify-between items-start mb-4">
                <h3 class="text-lg font-bold text-gray-900">Xodim ma'lumotlari</h3>
                <button @click="showStaffModal = false" class="text-gray-400 hover:text-gray-500">🗙</button>
            </div>
            
            <div class="flex items-center space-x-4 mb-6 p-4 bg-gray-50 rounded-xl">
                <div class="w-12 h-12 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold text-lg" x-text="editData.name ? editData.name.charAt(0) : 'X'"></div>
                <div>
                    <h4 class="font-bold text-gray-900 text-base" x-text="editData.name"></h4>
                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-semibold bg-indigo-50 text-indigo-700 uppercase mt-1" x-text="editData.role"></span>
                </div>
            </div>

            <div class="space-y-3 text-sm">
                <div class="flex justify-between border-b border-gray-100 pb-2">
                    <span class="text-gray-400">Lavozimi:</span>
                    <span class="font-medium text-gray-900" x-text="editData.title || '—'"></span>
                </div>
                <div class="flex justify-between border-b border-gray-100 pb-2">
                    <span class="text-gray-400">Mutaxassisligi:</span>
                    <span class="font-medium text-gray-900" x-text="editData.specialty || '—'"></span>
                </div>
                <div class="flex justify-between border-b border-gray-100 pb-2">
                    <span class="text-gray-400">Telefon raqam:</span>
                    <span class="font-medium text-gray-900" x-text="editData.phone_number || '—'"></span>
                </div>
                <div class="flex justify-between border-b border-gray-100 pb-2">
                    <span class="text-gray-400">Email:</span>
                    <span class="font-medium text-gray-900" x-text="editData.email || '—'"></span>
                </div>
                <div class="flex justify-between pb-1">
                    <span class="text-gray-400">Tizimdagi holati:</span>
                    <span class="font-semibold" :class="editData.status === 'active' ? 'text-green-600' : 'text-red-500'" x-text="editData.status === 'active' ? 'Faol' : 'Noaktiv'"></span>
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <button type="button" @click="showStaffModal = false" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-xl hover:bg-gray-200">Yopish</button>
            </div>
        </div>
    </div>
</div>