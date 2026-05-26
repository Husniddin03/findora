<x-layout.manage.app :center="$center">
    <div x-data="{ 
        staffModal: false, 
        editStaffModal: false, 
        showStaffModal: false,
        editData: { role: 'teacher', status: 'active' } 
    }" @keydown.escape.window="staffModal = false; editStaffModal = false; showStaffModal = false">
        
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Xodimlar va O'qituvchilar</h2>
                <p class="text-sm text-gray-500 mt-1">Markaz jamoasi a'zolari ro'yxati, lavozimlari va ularning tizimdagi huquqlari</p>
            </div>
            <div>
                <button @click="staffModal = true"
                    class="inline-flex items-center px-4 py-2.5 text-sm font-medium text-white bg-indigo-600 rounded-xl shadow-sm hover:bg-indigo-700 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                    Yangi xodim qo'shish
                </button>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mb-6">
            <div class="p-5 border-b border-gray-100 bg-gray-50/50 flex flex-col sm:flex-row justify-between items-center gap-4">
                <div class="flex bg-gray-100 p-1 rounded-xl w-full sm:w-auto">
                    <a href="{{ route('manage.staff', [$center->slug, 'role' => 'all']) }}" 
                       class="px-4 py-1.5 text-xs font-medium rounded-lg transition-all {{ request('role', 'all') === 'all' ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-500 hover:text-gray-900' }}">
                        Barchasi ({{ $counts['all'] }})
                    </a>
                    <a href="{{ route('manage.staff', [$center->slug, 'role' => 'teacher']) }}" 
                       class="px-4 py-1.5 text-xs font-medium rounded-lg transition-all {{ request('role') === 'teacher' ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-500 hover:text-gray-900' }}">
                        O'qituvchilar ({{ $counts['teacher'] }})
                    </a>
                    <a href="{{ route('manage.staff', [$center->slug, 'role' => 'admin']) }}" 
                       class="px-4 py-1.5 text-xs font-medium rounded-lg transition-all {{ request('role') === 'admin' ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-500 hover:text-gray-900' }}">
                        Administratsiya ({{ $counts['admin'] }})
                    </a>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-left">
                    <thead class="bg-gray-50 text-xs font-bold text-gray-500 uppercase">
                        <tr>
                            <th class="px-6 py-4">Xodim</th>
                            <th class="px-6 py-4">Lavozimi / Sohasi</th>
                            <th class="px-6 py-4">Yuklama (Guruhlar)</th>
                            <th class="px-6 py-4">Tizimga kirish roli</th>
                            <th class="px-6 py-4 text-right">Amallar</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-sm text-gray-700">
                        @forelse($staffMembers as $member)
                        <tr class="hover:bg-gray-50/50 transition-colors {{ $member->status === 'inactive' ? 'opacity-60 bg-gray-50/50' : '' }}">
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-3">
                                    @if($member->role === 'admin')
                                        <div class="w-10 h-10 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center font-bold text-sm shrink-0">A</div>
                                    @elseif($member->role === 'teacher')
                                        <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-sm shrink-0">T</div>
                                    @else
                                        <div class="w-10 h-10 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center font-bold text-sm shrink-0">R</div>
                                    @endif
                                    <div>
                                        <h4 class="font-semibold text-gray-900">{{ $member->name }}</h4>
                                        <p class="text-xs text-gray-500">{{ $member->phone_number ?? $member->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-900">{{ $member->title }}</div>
                                <div class="text-xs text-gray-500">{{ $member->specialty ?? '—' }}</div>
                            </td>
                            <td class="px-6 py-4">
                                @if($member->role === 'teacher')
                                    <div class="flex items-center space-x-2">
                                        <span class="font-semibold text-gray-900">{{ $member->groups_count ?? 0 }} ta guruh</span>
                                        <span class="text-xs text-gray-400">({{ $member->students_count ?? 0 }} ta o'quvchi)</span>
                                    </div>
                                @else
                                    <span class="text-xs text-gray-400">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium 
                                    {{ $member->role === 'admin' ? 'bg-purple-50 text-purple-700' : ($member->role === 'teacher' ? 'bg-blue-50 text-blue-700' : 'bg-amber-50 text-amber-700') }} uppercase tracking-wider">
                                    {{ $member->role }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end space-x-3">
                                    <button @click="showStaffModal = true; editData = {{ json_encode($member) }}" 
                                            class="text-xs font-medium text-indigo-600 hover:text-indigo-900">👁️ Ko'rish</button>
                                    
                                    <button @click="editStaffModal = true; editData = {{ json_encode($member) }}"
                                        class="text-xs font-medium text-amber-600 hover:text-amber-900">✏️ Tahrirlash</button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-sm text-gray-400">Hech qanday xodim topilmadi.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <x-manage.staff.create :center="$center" />
        <x-manage.staff.edit :center="$center" />
        <x-manage.staff.show />

    </div>
</x-layout.manage.app>