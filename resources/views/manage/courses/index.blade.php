<x-layout.manage.app :center="$center">
    <div x-data="{
        openCreateModal: false,
        openEditModal: false,
        editingCourse: {}
    }" @keydown.escape.window="openCreateModal = false; openEditModal = false">

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Kurslar va Fanlar Sozlamalari</h2>
                <p class="text-sm text-gray-500 mt-1">Markazda o'tiladigan o'quv dasturlari, narxlar va davomiylik nazorati</p>
            </div>
            <div>
                <button @click="openCreateModal = true"
                    class="inline-flex items-center px-4 py-2.5 text-sm font-medium text-white bg-indigo-600 rounded-xl shadow-sm hover:bg-indigo-700 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Yangi kurs qo'shish
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @forelse($courses as $course)
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all flex flex-col justify-between overflow-hidden">
                    <div class="p-5">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-lg">
                                {{ $course->icon ?? '📚' }}
                            </div>
                            <span class="px-2.5 py-1 text-xs font-medium bg-gray-100 text-gray-600 rounded-lg">
                                0 ta faol guruh 
                            </span>
                        </div>

                        <h3 class="text-lg font-bold text-gray-900">{{ $course->title }}</h3>
                        <p class="text-xs text-gray-400 mt-1 line-clamp-2">{{ $course->description }}</p>

                        <div class="mt-4 space-y-2 border-t border-gray-50 pt-3 text-xs text-gray-600">
                            <div class="flex justify-between">
                                <span class="text-gray-400">Davomiyligi:</span>
                                <span class="font-medium text-gray-800">{{ $course->duration_months }} oy</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Haftalik darslar:</span>
                                <span class="font-medium text-gray-800">{{ $course->lessons_per_week }} marta, {{ $course->lesson_duration_minutes / 60 }} soatdan</span>
                            </div>
                        </div>
                    </div>

                    <div class="px-5 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
                        <div>
                            <span class="text-[10px] text-gray-400 block uppercase font-medium tracking-wider">Oylik to'lov</span>
                            <span class="text-base font-bold text-gray-900">
                                {{ number_format($course->price) }} <span class="text-xs font-normal text-gray-500">UZS</span>
                            </span>
                        </div>
                        <div class="flex gap-1">
                            <button @click="editingCourse = {{ json_encode($course) }}; openEditModal = true"
                                class="p-2 text-gray-400 hover:text-amber-600 hover:bg-white rounded-xl border border-transparent hover:border-gray-100 transition-all shadow-sm"
                                title="Tahrirlash">
                                ✏️
                            </button>
                            <button class="p-2 text-gray-400 hover:text-indigo-600 hover:bg-white rounded-xl border border-transparent hover:border-gray-100 transition-all shadow-sm" title="O'quv rejasi">📚</button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-1 md:col-span-2 xl:col-span-3 text-center py-12 bg-white rounded-2xl border border-gray-100">
                    <span class="text-4xl block mb-2">📭</span>
                    <h4 class="text-sm font-semibold text-gray-900">Kurslar mavjud emas</h4>
                    <p class="text-xs text-gray-400 mt-1">Ushbu o'quv markazida hali hech qanday kurs yaratilmagan.</p>
                </div>
            @endforelse
        </div>

        <div x-show="openCreateModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
            <div @click="openCreateModal = false" class="fixed inset-0 bg-gray-900/40 backdrop-blur-sm transition-opacity"></div>
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all w-full max-w-xl my-8">
                    <div class="absolute right-4 top-4">
                        <button @click="openCreateModal = false" class="text-gray-400 hover:text-gray-600 p-1.5 rounded-lg hover:bg-gray-50 transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="p-6">
                        <x-manage.courses.create :center="$center" />
                    </div>
                </div>
            </div>
        </div>

        <div x-show="openEditModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
            <div @click="openEditModal = false" class="fixed inset-0 bg-gray-900/40 backdrop-blur-sm transition-opacity"></div>
            <div class="flex min-h-full items-center justify-center p-4 text-center">
                <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all w-full max-w-xl p-6 my-8">
                    <div class="absolute right-4 top-4">
                        <button @click="openEditModal = false" class="text-gray-400 hover:text-gray-600 p-1.5 rounded-lg hover:bg-gray-50 transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <x-manage.courses.edit :center="$center" />
                </div>
            </div>
        </div>

    </div>
</x-layout.manage.app>