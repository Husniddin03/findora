<x-layout.manage.app :center="$center">
    <div x-data="{
        attendanceModal: false,
        modalData: { student_id: '', student_name: '', date: '', status: 'present', notes: '' }
    }" @keydown.escape.window="attendanceModal = false" x-cloak>

        @if (session('success'))
            <div
                class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm font-medium flex items-center justify-between shadow-sm">
                <span>✨ {{ session('success') }}</span>
                <button @click="$el.parentElement.remove()" class="text-green-500 hover:text-green-700">✕</button>
            </div>
        @endif

        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Davomat Jurnali</h2>
                <p class="text-sm text-gray-500 mt-1">Guruhlar kesimida o'quvchilarning kunlik darsga qatnashish nazorati
                </p>
            </div>

            <div
                class="flex flex-wrap items-center gap-3 w-full md:w-auto bg-white p-2 border border-gray-200 rounded-xl shadow-sm">
                <form action="{{ route('manage.attendances', $center->slug) }}" method="GET"
                    class="flex flex-wrap items-center gap-3" id="attendanceFilterForm">
                    <select name="group_id" onchange="document.getElementById('attendanceFilterForm').submit()"
                        class="bg-gray-50 border border-gray-200 rounded-xl px-3 py-2 text-sm text-gray-700 font-semibold focus:outline-none focus:ring-2 focus:ring-indigo-500/20">
                        @foreach ($groups as $g)
                            <option value="{{ $g->id }}" {{ request('group_id') == $g->id ? 'selected' : '' }}>
                                {{ $g->name }}</option>
                        @endforeach
                    </select>

                    <input type="month" name="month" value="{{ $monthParam }}"
                        onchange="document.getElementById('attendanceFilterForm').submit()"
                        class="bg-gray-50 border border-gray-200 rounded-xl px-3 py-1.5 text-sm text-gray-700 font-semibold focus:outline-none focus:ring-2 focus:ring-indigo-500/20">
                </form>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
            <div class="bg-white border border-gray-100 rounded-xl p-4 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-xs font-medium text-gray-400 uppercase tracking-wider">O'rtacha qatnashish</span>
                    <h4 class="text-xl font-bold text-gray-900 mt-1">{{ $averageAttendance }}%</h4>
                </div>
                <span class="text-2xl p-2 bg-green-50 rounded-lg">📈</span>
            </div>
            <div class="bg-white border border-gray-100 rounded-xl p-4 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-xs font-medium text-gray-400 uppercase tracking-wider">Bugun kelmaganlar</span>
                    <h4 class="text-xl font-bold text-red-600 mt-1">{{ $todayAbsentsCount }} ta o'quvchi</h4>
                </div>
                <span class="text-2xl p-2 bg-red-50 rounded-lg">⚠️</span>
            </div>
            <div class="bg-white border border-gray-100 rounded-xl p-4 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-xs font-medium text-gray-400 uppercase tracking-wider">Joriy oydagi darslar</span>
                    <h4 class="text-xl font-bold text-indigo-600 mt-1">{{ $totalLessonsCount }}-dars o'tildi</h4>
                </div>
                <span class="text-2xl p-2 bg-indigo-50 rounded-lg">📅</span>
            </div>
        </div>

        @if ($currentGroup)
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse text-left">
                        <thead class="bg-gray-50 text-xs font-bold text-gray-500 uppercase border-b border-gray-200">
                            <tr>
                                <th
                                    class="px-6 py-4 min-w-[260px] sticky left-0 bg-gray-50 z-10 border-r border-gray-200/60 shadow-[2px_0_5px_-2px_rgba(0,0,0,0.05)]">
                                    O'quvchi ismi</th>
                                @foreach ($lessonDates as $dateStr)
                                    @php
                                        $isToday = $dateStr === \Carbon\Carbon::now()->format('Y-m-d');
                                        $formattedDate = \Carbon\Carbon::parse($dateStr)->format('d.m');
                                    @endphp
                                    <th
                                        class="px-2 py-4 text-center border-r border-gray-200 w-16 {{ $isToday ? 'bg-indigo-50 text-indigo-600 font-black' : 'bg-gray-100/40' }}">
                                        {{ $isToday ? 'Bugun' : $formattedDate }}
                                    </th>
                                @endforeach
                                <th class="px-4 py-4 text-center text-xs font-semibold text-gray-400 w-20">Jami %</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200 text-sm text-gray-700">
                            @forelse($currentGroup->students as $student)
                                @php
                                    $studentRecords = $attendances->get($student->id, collect());
                                    $totalAttended = $studentRecords->where('status', 'present')->count();
                                    $totalCount = $studentRecords->count();
                                    $studentPercentage =
                                        $totalCount > 0 ? round(($totalAttended / $totalCount) * 100) : 100;
                                @endphp
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td
                                        class="px-6 py-4 sticky left-0 bg-white z-10 font-medium text-gray-900 border-r border-gray-200/60 shadow-[2px_0_5px_-2px_rgba(0,0,0,0.05)] flex items-center space-x-3">
                                        <span
                                            class="w-2 h-2 rounded-full {{ $studentPercentage >= 80 ? 'bg-green-500' : 'bg-red-500' }}"></span>
                                        <div>
                                            <span class="font-semibold block">{{ $student->name }}</span>
                                            <span class="block text-[10px] text-gray-400 font-normal">ID:
                                                #{{ $student->id }}</span>
                                        </div>
                                    </td>

                                    @foreach ($lessonDates as $dateStr)
                                        @php
                                            $record = $studentRecords->get($dateStr);
                                            $isToday = $dateStr === \Carbon\Carbon::now()->format('Y-m-d');
                                        @endphp
                                        <td
                                            class="p-1 border-r border-gray-200 text-center {{ $isToday ? 'bg-indigo-50/20' : '' }}">
                                            @if ($record)
                                                <button type="button"
                                                    @click='attendanceModal = true; modalData = @js([
                                                        'student_id' => $student->id,
                                                        'student_name' => $student->name,
                                                        'date' => $dateStr,
                                                        'status' => $record->status,
                                                        'notes' => $record->notes,
                                                    ])'
                                                    class="inline-flex items-center justify-center w-7 h-7 rounded-full text-xs font-bold transition-transform hover:scale-110
                                                    {{ $record->status === 'present' ? 'bg-green-100 text-green-700' : ($record->status === 'absent' ? 'bg-red-100 text-red-700' : 'bg-amber-100 text-amber-700') }}"
                                                    title="{{ e($record->notes ?? 'Izoh yo‘q') }}">
                                                    {{ $record->status === 'present' ? '✓' : ($record->status === 'absent' ? '✕' : 'S') }}
                                                </button>
                                            @else
                                                <button type="button"
                                                    @click='attendanceModal = true; modalData = @js([
                                                        'student_id' => $student->id,
                                                        'student_name' => $student->name,
                                                        'date' => $dateStr,
                                                        'status' => 'present',
                                                        'notes' => '',
                                                    ])'
                                                    class="w-7 h-7 rounded-lg text-gray-300 hover:bg-indigo-50 hover:text-indigo-600 text-xs transition-all font-bold">
                                                    ?
                                                </button>
                                            @endif
                                        </td>
                                    @endforeach

                                    <td
                                        class="p-2 text-center font-bold text-xs {{ $studentPercentage >= 80 ? 'text-gray-600' : 'text-red-500' }}">
                                        {{ $studentPercentage }}%
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ count($lessonDates) + 2 }}"
                                        class="px-6 py-12 text-center text-gray-400">
                                        📭 Ushbu guruhga o'quvchilar biriktirilmagan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="bg-gray-50 px-6 py-3.5 border-t border-gray-200 flex flex-wrap gap-5 text-xs text-gray-500">
                    <div class="flex items-center space-x-1.5"><span
                            class="w-5 h-5 rounded-full bg-green-100 text-green-700 font-bold flex items-center justify-center text-[10px]">✓</span><span>Darsda
                            (Kelgan)</span></div>
                    <div class="flex items-center space-x-1.5"><span
                            class="w-5 h-5 rounded-full bg-red-100 text-red-700 font-bold flex items-center justify-center text-[10px]">✕</span><span>Kelmagan
                            (Sababsiz)</span></div>
                    <div class="flex items-center space-x-1.5"><span
                            class="w-5 h-5 rounded-full bg-amber-100 text-amber-700 font-bold flex items-center justify-center text-[10px]">S</span><span>Sababli
                            (Ruxsat so'ragan)</span></div>
                </div>
            </div>
        @endif

        <div x-show="attendanceModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
            <div class="fixed inset-0 bg-gray-500/75 backdrop-blur-sm" @click="attendanceModal = false"></div>
            <div class="flex min-h-full items-center justify-center p-4">
                <div
                    class="relative bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden transform transition-all">

                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                        <h3 class="text-base font-bold text-gray-900">Davomatni qayd etish</h3>
                        <button @click="attendanceModal = false" class="text-gray-400 hover:text-gray-600">✕</button>
                    </div>

                    <form action="{{ route('manage.attendances.storeOrUpdate', $center->slug) }}" method="POST">
                        @csrf
                        <input type="hidden" name="group_id" value="{{ $currentGroup?->id }}">
                        <input type="hidden" name="student_id" :value="modalData.student_id">
                        <input type="hidden" name="date" :value="modalData.date">

                        <div class="p-6 space-y-4">
                            <div>
                                <span
                                    class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">O'quvchi:</span>
                                <span class="text-sm font-bold text-gray-900 block mt-0.5"
                                    x-text="modalData.student_name"></span>
                            </div>
                            <div>
                                <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Dars
                                    sanasi:</span>
                                <span class="text-sm font-mono text-indigo-600 font-semibold block mt-0.5"
                                    x-text="modalData.date"></span>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-2">Qatnashish holati
                                    *</label>
                                <div class="grid grid-cols-3 gap-2">
                                    <label
                                        class="border border-gray-200 rounded-xl p-2.5 flex flex-col items-center justify-center cursor-pointer hover:bg-gray-50 transition-colors"
                                        :class="modalData.status === 'present' ?
                                            'border-green-500 bg-green-50/40 ring-2 ring-green-500/20' : ''">
                                        <input type="radio" name="status" value="present" x-model="modalData.status"
                                            class="sr-only">
                                        <span class="text-green-700 font-bold text-lg">✓</span>
                                        <span class="text-[11px] text-gray-600 font-medium mt-1">Keldi</span>
                                    </label>

                                    <label
                                        class="border border-gray-200 rounded-xl p-2.5 flex flex-col items-center justify-center cursor-pointer hover:bg-gray-50 transition-colors"
                                        :class="modalData.status === 'absent' ?
                                            'border-red-500 bg-red-50/40 ring-2 ring-red-500/20' : ''">
                                        <input type="radio" name="status" value="absent"
                                            x-model="modalData.status" class="sr-only">
                                        <span class="text-red-700 font-bold text-lg">✕</span>
                                        <span class="text-[11px] text-gray-600 font-medium mt-1">Kelmadı</span>
                                    </label>

                                    <label
                                        class="border border-gray-200 rounded-xl p-2.5 flex flex-col items-center justify-center cursor-pointer hover:bg-gray-50 transition-colors"
                                        :class="modalData.status === 'excused' ?
                                            'border-amber-500 bg-amber-50/40 ring-2 ring-amber-500/20' : ''">
                                        <input type="radio" name="status" value="excused"
                                            x-model="modalData.status" class="sr-only">
                                        <span class="text-amber-700 font-bold text-lg">S</span>
                                        <span class="text-[11px] text-gray-600 font-medium mt-1">Sababli</span>
                                    </label>
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-1">Izoh / Sabab
                                    (ixtiyoriy)</label>
                                <input type="text" name="notes" x-model="modalData.notes"
                                    placeholder="Masalan: Kasalligi sababli kelmadi"
                                    class="w-full px-3 py-2 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20">
                            </div>
                        </div>

                        <div class="bg-gray-50 px-6 py-3.5 border-t border-gray-100 flex justify-end space-x-2">
                            <button type="button" @click="attendanceModal = false"
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-xl">Bekor
                                qilish</button>
                            <button type="submit"
                                class="px-4 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-xl hover:bg-indigo-700">Saqlash</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-layout.manage.app>
