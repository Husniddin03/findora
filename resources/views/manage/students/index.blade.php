<x-layout.manage.app :center="$center">
    <div x-data="{ 
        createModal: false, 
        editModal: false, 
        showModal: false,
        editData: {},
        showData: {}
    }" @keydown.escape.window="createModal = false; editModal = false; showModal = false">
        
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Oʻquvchilar bazasi</h2>
                <p class="text-sm text-gray-500 mt-1">Markazda tahsil olayotgan barcha o'quvchilar ro'yxati va ularning hisob balansi</p>
            </div>
            <div>
                <button @click="createModal = true"
                    class="inline-flex items-center px-4 py-2.5 text-sm font-medium text-white bg-indigo-600 rounded-xl shadow-sm hover:bg-indigo-700 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                    Yangi o'quvchi qo'shish
                </button>
            </div>
        </div>

        <form action="{{ route('manage.students', $center->slug) }}" method="GET"
            class="bg-white rounded-xl border border-gray-200/80 p-4 mb-6 shadow-sm flex flex-col md:flex-row gap-4 justify-between items-center">
            
            <div class="relative w-full md:w-80">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </span>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="O'quvchi ismi yoki tel..."
                    class="w-full pl-9 pr-4 py-2 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all"
                    onchange="this.form.submit()">
            </div>

            <div class="flex flex-wrap items-center gap-3 w-full md:w-auto justify-end">
                <select name="status" onchange="this.form.submit()"
                    class="bg-gray-50 border border-gray-200 rounded-xl px-3 py-2 text-sm text-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500/20">
                    <option value="">Barcha statuslar</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Faol</option>
                    <option value="frozen" {{ request('status') == 'frozen' ? 'selected' : '' }}>Muzlatilgan</option>
                    <option value="debter" {{ request('status') == 'debter' ? 'selected' : '' }}>Qarzdorlar</option>
                    <option value="left" {{ request('status') == 'left' ? 'selected' : '' }}>Bitirgan / Ketgan</option>
                </select>

                <select name="group_id" onchange="this.form.submit()"
                    class="bg-gray-50 border border-gray-200 rounded-xl px-3 py-2 text-sm text-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500/20">
                    <option value="">Barcha guruhlar</option>
                    @foreach($groups as $group)
                        <option value="{{ $group->id }}" {{ request('group_id') == $group->id ? 'selected' : '' }}>{{ $group->name }}</option>
                    @endforeach
                </select>
            </div>
        </form>

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-left">
                    <thead class="bg-gray-50 text-xs text-gray-500 uppercase font-medium">
                        <tr>
                            <th class="px-6 py-3.5">O'quvchi</th>
                            <th class="px-6 py-3.5">Guruhlari</th>
                            <th class="px-6 py-3.5">Balans</th>
                            <th class="px-6 py-3.5">Holat</th>
                            <th class="px-6 py-3.5">Qo'shilgan sana</th>
                            <th class="px-6 py-3.5 text-right">Amallar</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-sm text-gray-700">
                        @forelse($students as $student)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-9 h-9 rounded-full bg-indigo-50 text-indigo-600 flex items-center justify-center font-semibold text-xs shrink-0">
                                        {{ implode('', array_map(fn($n) => mb_substr($n, 0, 1), explode(' ', $student->name))) }}
                                    </div>
                                    <div>
                                        <button @click="showModal = true; showData = {{ json_encode($student->load('groups')) }}" class="font-medium text-gray-900 hover:text-indigo-600 transition-colors text-left">
                                            {{ $student->name }}
                                        </button>
                                        <div class="text-xs text-gray-500">{{ $student->phone_number }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-1 max-w-[200px]">
                                    @forelse($student->groups as $group)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded bg-gray-100 text-gray-800 text-xs font-medium">
                                            {{ $group->name }}
                                        </span>
                                    @empty
                                        <span class="text-xs text-gray-400 italic">Guruhsiz</span>
                                    @endforelse
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-semibold {{ $student->balance >= 0 ? 'text-emerald-600' : 'text-red-600' }}">
                                    {{ number_format($student->balance) }} <span class="text-[10px] font-normal text-gray-400">UZS</span>
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if($student->balance < 0)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-50 text-red-700">Qarzdor</span>
                                @elseif($student->status === 'active')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-50 text-green-700">Faol</span>
                                @elseif($student->status === 'frozen')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-50 text-amber-700">Muzlatilgan</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-50 text-gray-700">Ketgan</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-gray-500 text-xs">{{ $student->created_at->format('d.m.Y') }}</td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end space-x-2">
                                    <button @click="showModal = true; showData = {{ json_encode($student->load('groups')) }}"
                                        class="p-1.5 text-gray-400 hover:text-indigo-600 hover:bg-gray-50 rounded-lg transition-colors" title="Profil">
                                        👁️
                                    </button>
                                    <button @click="editModal = true; editData = {{ json_encode($student->load('groups')) }}"
                                        class="p-1.5 text-gray-400 hover:text-amber-600 hover:bg-gray-50 rounded-lg transition-colors" title="Tahrirlash">
                                        ✏️
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-sm text-gray-400">O'quvchilar topilmadi.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($students->hasPages())
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                    {{ $students->links() }}
                </div>
            @endif
        </div>

        <x-manage.student.create :center="$center" :groups="$groups" />
        <x-manage.student.edit :center="$center" :groups="$groups" />
        <x-manage.student.show />

    </div>
</x-layout.manage.app>