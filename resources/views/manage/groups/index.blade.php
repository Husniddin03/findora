<x-layout.manage.app :center="$center">
    <div x-data="{
        openCreateModal: false,
        openShowModal: false,
        openEditModal: false,
        openDeleteModal: false,
        selectedGroup: { course: {}, teacher: {} }
    }" @keydown.escape.window="openCreateModal = false; openShowModal = false; openEditModal = false; openDeleteModal = false">

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Guruhlar boshqaruvi</h2>
                <p class="text-sm text-gray-500 mt-1">Faol, yangi ochilayotgan va yakunlangan o'quv guruhlari nazorati</p>
            </div>
            <div>
                <button @click="openCreateModal = true"
                    class="inline-flex items-center px-4 py-2.5 text-sm font-medium text-white bg-indigo-600 rounded-xl shadow-sm hover:bg-indigo-700 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Yangi guruh ochish
                </button>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-200/80 p-4 mb-6 shadow-sm flex flex-col sm:flex-row gap-4 justify-between items-center">
            <div class="flex bg-gray-100 p-1 rounded-xl w-full sm:w-auto">
                <a href="{{ route('manage.groups', ['center' => $center->slug, 'status' => 'active', 'course_id' => request('course_id')]) }}" 
                   class="px-4 py-1.5 text-xs font-medium rounded-lg text-center flex-1 sm:flex-none {{ $currentStatus == 'active' ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-500 hover:text-gray-900' }}">
                   Faol guruhlar ({{ $counts['active'] }})
                </a>
                <a href="{{ route('manage.groups', ['center' => $center->slug, 'status' => 'collecting', 'course_id' => request('course_id')]) }}" 
                   class="px-4 py-1.5 text-xs font-medium rounded-lg text-center flex-1 sm:flex-none {{ $currentStatus == 'collecting' ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-500 hover:text-gray-900' }}">
                   Yig'ilmoqda ({{ $counts['collecting'] }})
                </a>
                <a href="{{ route('manage.groups', ['center' => $center->slug, 'status' => 'finished', 'course_id' => request('course_id')]) }}" 
                   class="px-4 py-1.5 text-xs font-medium rounded-lg text-center flex-1 sm:flex-none {{ $currentStatus == 'finished' ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-500 hover:text-gray-900' }}">
                   Tugatgan ({{ $counts['finished'] }})
                </a>
            </div>

            <form action="{{ route('manage.groups', $center->slug) }}" method="GET" id="filterForm" class="w-full sm:w-auto">
                <input type="hidden" name="status" value="{{ $currentStatus }}">
                <select name="course_id" onchange="document.getElementById('filterForm').submit()"
                    class="w-full sm:w-56 bg-gray-50 border border-gray-200 rounded-xl px-3 py-2 text-sm text-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500/20">
                    <option value="">Barcha yo'nalishlar</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>{{ $course->title }}</option>
                    @endforeach
                </select>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @forelse($groups as $group)
                @php 
                    $percent = $group->max_students > 0 ? ($group->students_count / $group->max_students) * 100 : 0;
                @endphp
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all flex flex-col justify-between overflow-hidden">
                    <div class="p-5">
                        <div class="flex items-center justify-between mb-3">
                            <span class="px-2.5 py-1 text-xs font-medium bg-indigo-50 text-indigo-700 rounded-lg">
                                {{ $group->course->title }}
                            </span>
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium 
                                {{ $group->status == 'active' ? 'bg-green-50 text-green-700' : ($group->status == 'collecting' ? 'bg-amber-50 text-amber-700' : 'bg-gray-100 text-gray-700') }}">
                                {{ $group->status == 'active' ? 'Faol' : ($group->status == 'collecting' ? 'Yig\'ilmoqda' : 'Tugatgan') }}
                            </span>
                        </div>

                        <h3 class="text-lg font-bold text-gray-900">{{ $group->name }}</h3>
                        <p class="text-xs text-gray-500 mt-1 flex items-center">
                            <span class="mr-1">👨‍🏫</span> Ustoz: {{ $group->teacher->name ?? 'Tayyinlanmagan' }}
                        </p>

                        <div class="mt-4 grid grid-cols-2 gap-3 bg-gray-50 p-3 rounded-xl text-xs">
                            <div>
                                <span class="text-gray-400 block">Kunlari:</span>
                                <span class="font-medium text-gray-800">
                                    {{ $group->days_type == 'odd' ? 'Toq kunlari (Dsh-Chsh-Jm)' : ($group->days_type == 'even' ? 'Juft kunlari (Ssh-Ph-Sh)' : 'Boshqa kunlar') }}
                                </span>
                            </div>
                            <div>
                                <span class="text-gray-400 block">Dars vaqti:</span>
                                <span class="font-medium text-gray-800">{{ $group->start_time }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="px-5 py-4 bg-gray-50/50 border-t border-gray-50 flex items-center justify-between">
                        <div class="w-2/3">
                            <div class="flex justify-between text-xs font-medium text-gray-500 mb-1">
                                <span>O'quvchilar:</span>
                                <span class="text-gray-900 font-semibold">{{ $group->students_count }} / {{ $group->max_students }}</span>
                            </div>
                            <div class="w-full bg-gray-200 h-1.5 rounded-full overflow-hidden">
                                <div class="h-1.5 rounded-full {{ $group->status == 'collecting' ? 'bg-amber-500' : 'bg-indigo-600' }}" style="width: {{ $percent }}%"></div>
                            </div>
                        </div>
                        
                        <button @click="selectedGroup = {{ json_encode($group->load(['course', 'teacher'])) }}; openShowModal = true"
                            class="text-xs font-medium text-indigo-600 bg-white border border-gray-200 px-3 py-1.5 rounded-xl shadow-sm hover:bg-gray-50 transition-colors">
                            Guruhni ko'rish
                        </button>
                    </div>
                </div>
            @empty
                <div class="col-span-1 md:col-span-2 xl:col-span-3 text-center py-12 bg-white rounded-2xl border border-gray-100">
                    <span class="text-4xl block mb-2">📭</span>
                    <h4 class="text-sm font-semibold text-gray-900">Guruhlar topilmadi</h4>
                    <p class="text-xs text-gray-400 mt-1">Tanlangan filtrlar bo'yicha hech qanday guruh mavjud emas.</p>
                </div>
            @endforelse
        </div>

        <div x-show="openCreateModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
            <div @click="openCreateModal = false" class="fixed inset-0 bg-gray-900/40 backdrop-blur-sm"></div>
            <div class="flex min-h-full items-center justify-center p-4 text-center">
                <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all w-full max-w-xl p-6">
                    <x-manage.group.create :center="$center" :courses="$courses" :teachers="$teachers" />
                </div>
            </div>
        </div>

        <div x-show="openShowModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
            <div @click="openShowModal = false" class="fixed inset-0 bg-gray-900/40 backdrop-blur-sm"></div>
            <div class="flex min-h-full items-center justify-center p-4 text-center">
                <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all w-full max-w-xl p-6">
                    <x-manage.group.show />
                </div>
            </div>
        </div>

        <div x-show="openEditModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
            <div @click="openEditModal = false" class="fixed inset-0 bg-gray-900/40 backdrop-blur-sm"></div>
            <div class="flex min-h-full items-center justify-center p-4 text-center">
                <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all w-full max-w-xl p-6">
                    <x-manage.group.edit :courses="$courses" :center="$center" :teachers="$teachers" />
                </div>
            </div>
        </div>

        <div x-show="openDeleteModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
            <div @click="openDeleteModal = false" class="fixed inset-0 bg-gray-900/40 backdrop-blur-sm"></div>
            <div class="flex min-h-full items-center justify-center p-4 text-center">
                <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all w-full max-w-md p-6">
                    <div class="text-center">
                        <span class="text-4xl block mb-3">⚠️</span>
                        <h3 class="text-lg font-bold text-gray-900">Guruhni o'chirishni tasdiqlaysizmi?</h3>
                        <p class="text-xs text-gray-500 mt-1">Siz rostdan ham <span class="font-semibold text-gray-800" x-text="selectedGroup.name"></span> guruhini o'chirmoqchimisiz? Bu amalni ortga qaytarib bo'lmaydi.</p>
                    </div>
                    <form :action="'/manage/groups/{{ $center->slug }}/' + selectedGroup.id" method="POST" class="mt-5 flex gap-3 justify-center">
                        @csrf
                        @method('DELETE')
                        <button type="button" @click="openDeleteModal = false" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-xl hover:bg-gray-200">Bekor qilish</button>
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-xl hover:bg-red-700">Ha, o'chirilsin</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-layout.manage.app>