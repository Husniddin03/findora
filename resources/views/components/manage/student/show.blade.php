<div x-show="showModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;" x-cloak>
    <div class="fixed inset-0 bg-gray-500/75 backdrop-blur-sm" @click="showModal = false"></div>
    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-md">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h3 class="text-base font-semibold text-gray-900">O'quvchi kartochkasi</h3>
                <button @click="showModal = false" class="text-gray-400 hover:text-gray-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div class="bg-white px-6 py-5 space-y-4">
                <div class="flex items-center space-x-4 pb-4 border-b border-gray-100">
                    <div class="w-12 h-12 rounded-full bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold text-lg" 
                         x-text="showData.name ? showData.name.split(' ').map(n => n[0]).join('').substring(0,2).toUpperCase() : ''">
                    </div>
                    <div>
                        <h4 class="text-lg font-bold text-gray-900" x-text="showData.name"></h4>
                        <span :class="{
                            'bg-green-50 text-green-700': showData.status === 'active',
                            'bg-amber-50 text-amber-700': showData.status === 'frozen',
                            'bg-gray-50 text-gray-700': showData.status === 'left'
                        }" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium uppercase tracking-wider" x-text="showData.status"></span>
                    </div>
                </div>

                <div class="space-y-3 text-sm">
                    <div class="flex justify-between py-1 border-b border-gray-50">
                        <span class="text-gray-400">Telefon:</span>
                        <span class="font-medium text-gray-900" x-text="showData.phone_number"></span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-gray-50">
                        <span class="text-gray-400">Ota-onasi raqami:</span>
                        <span class="font-medium text-gray-900" x-text="showData.parent_phone_number || 'Kiritilmagan'"></span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-gray-50">
                        <span class="text-gray-400">Tug'ilgan sanasi:</span>
                        <span class="font-medium text-gray-900" x-text="showData.birth_date || 'Kiritilmagan'"></span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-gray-50">
                        <span class="text-gray-400">Jinsi:</span>
                        <span class="font-medium text-gray-900" x-text="showData.gender === 'male' ? 'Erkak' : (showData.gender === 'female' ? 'Ayol' : 'Kiritilmagan')"></span>
                    </div>
                    
                    <div class="py-1 border-b border-gray-50">
                        <span class="text-gray-400 block mb-1">A'zo guruhlari:</span>
                        <div class="flex flex-wrap gap-1">
                            <template x-if="showData.groups && showData.groups.length > 0">
                                <template x-for="group in showData.groups" :key="group.id">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded bg-gray-100 text-gray-800 text-xs font-medium" x-text="group.name"></span>
                                </template>
                            </template>
                            <template x-if="!showData.groups || showData.groups.length === 0">
                                <span class="text-gray-400 italic text-xs">Guruhga biriktirilmagan</span>
                            </template>
                        </div>
                    </div>

                    <div class="flex justify-between py-1">
                        <span class="text-gray-400">Joriy Balans:</span>
                        <span :class="showData.balance >= 0 ? 'text-emerald-600' : 'text-red-600'" class="font-bold text-base" x-text="new Intl.NumberFormat('uz-UZ').format(showData.balance) + ' UZS'"></span>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 px-6 py-3 flex justify-end rounded-b-2xl">
                <button type="button" @click="showModal = false" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-xl hover:bg-gray-50">Yopish</button>
            </div>
        </div>
    </div>
</div>