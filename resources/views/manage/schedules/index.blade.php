<x-layout.manage.app :center="$center">
    <div x-data="{ 
        scheduleModal: false, 
        deleteModal: false,
        openShowModal: false,
        selectedGroup: {},
        activeSessionId: null,
        // Yaratish formasi parametrlari
        rangeType: 'single_date',
        dayType: 'odd',
        quickDate: '',
        quickStartTime: '',
        quickEndTime: ''
    }" @keydown.escape.window="scheduleModal = false; deleteModal = false; openShowModal = false" x-cloak>
        
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm font-medium flex items-center justify-between shadow-sm">
                <span>✨ {{ session('success') }}</span>
                <button @click="$el.parentElement.remove()" class="text-green-500 hover:text-green-700">✕</button>
            </div>
        @endif

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-6 gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Dars jadvali boshqaruvi</h2>
                <p class="text-sm text-gray-500 mt-1">Darslarni kunlik, oylik va yillik dinamik rejalashtirish tizimi</p>
            </div>
            
            <div class="flex flex-wrap items-center gap-3 bg-white p-2 rounded-xl border border-gray-200 shadow-sm">
                <form action="{{ route('manage.schedules', $center->slug) }}" method="GET" class="flex flex-wrap items-center gap-3" id="scheduleFilterForm">
                    <div class="flex items-center space-x-2">
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider pl-1">Hafta:</label>
                        <input type="week" name="week" value="{{ request('week', $selectedDate->format('Y-\WW')) }}" onchange="document.getElementById('scheduleFilterForm').submit()"
                            class="bg-gray-50 border border-gray-200 rounded-xl px-3 py-1.5 text-sm text-gray-700 font-medium focus:outline-none focus:ring-2 focus:ring-indigo-500/20">
                    </div>

                    <div class="flex items-center space-x-2">
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Xona:</label>
                        <select name="room_id" onchange="document.getElementById('scheduleFilterForm').submit()"
                            class="bg-gray-50 border border-gray-200 rounded-xl px-3 py-1.5 text-sm text-gray-700 font-medium focus:outline-none focus:ring-2 focus:ring-indigo-500/20">
                            <option value="">Barcha xonalar</option>
                            @foreach($rooms as $room)
                                <option value="{{ $room->id }}" {{ request('room_id') == $room->id ? 'selected' : '' }}>{{ $room->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>

                <div class="h-6 w-px bg-gray-200 mx-1 hidden sm:block"></div>

                <button @click="scheduleModal = true; rangeType = 'current_week'; quickDate = '';"
                    class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-xl shadow-md hover:bg-indigo-700 transition-all duration-200">
                    🚀 Ommaviy Rejalashtirish
                </button>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full border-collapse table-fixed text-left">
                    <thead class="bg-gray-50 text-xs text-gray-500 uppercase font-bold border-b border-gray-200">
                        <tr>
                            <th class="w-36 px-4 py-4 border-r border-gray-200 text-center bg-gray-100/40">Vaqt diapazoni</th>
                            @php
                                $weekDays = ['Dushanba', 'Seshanba', 'Chorshanba', 'Payshanba', 'Juma', 'Shanba'];
                                $startOfWeek = $selectedDate->clone()->startOfWeek();
                            @endphp
                            @foreach($weekDays as $index => $day)
                                @php $currentLoopDate = $startOfWeek->clone()->addDays($index); @endphp
                                <th class="px-4 py-3 border-r border-gray-200 min-w-[200px]">
                                    <div class="text-gray-900 font-bold">{{ $day }}</div>
                                    <div class="text-[11px] text-indigo-600 font-semibold mt-0.5">{{ $currentLoopDate->format('d.m.Y') }}</div>
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-sm">
                        @foreach($timeSlots as $slotTime)
                        <tr class="h-28 hover:bg-gray-50/10 transition-colors">
                            <td class="p-3 border-r border-gray-200 text-center bg-gray-50/50 font-semibold text-gray-700 text-xs shadow-inner">
                                @php $times = explode(' - ', $slotTime); @endphp
                                <div class="text-indigo-600 font-bold text-xs bg-indigo-50 py-1 rounded-lg border border-indigo-100/70">{{ $times[0] }}</div>
                                <div class="text-[9px] text-gray-400 font-normal my-1">gacha</div>
                                <div class="text-gray-600 font-bold text-xs bg-gray-100 py-1 rounded-lg border border-gray-200">{{ $times[1] }}</div>
                            </td>

                            @for($dayIndex = 1; $dayIndex <= 6; $dayIndex++)
                                @php
                                    $thisCellDate = $startOfWeek->clone()->addDays($dayIndex - 1)->format('Y-m-d');
                                    $currentSession = $sessions->first(function($item) use ($slotTime, $thisCellDate) {
                                        $itemSlot = substr($item->start_time, 0, 5) . ' - ' . substr($item->end_time, 0, 5);
                                        return $itemSlot === $slotTime && $item->date->format('Y-m-d') === $thisCellDate;
                                    });
                                @endphp

                                <td class="p-2 border-r border-gray-200 vertical-align-top">
                                    @if($currentSession)
                                        <div class="bg-indigo-50/70 border border-indigo-100 p-2.5 rounded-xl h-full flex flex-col justify-between relative group shadow-sm hover:shadow-md hover:border-indigo-300 transition-all">
                                            <div>
                                                <button @click="openShowModal = true; selectedGroup = {{ json_encode($currentSession->group) }}" 
                                                    class="text-left block text-xs font-bold text-indigo-900 hover:underline truncate w-full">
                                                    📚 {{ $currentSession->group->name }}
                                                </button>
                                                <div class="text-[10px] font-bold text-emerald-700 mt-1 flex items-center bg-emerald-50 px-1.5 py-0.5 rounded w-max">
                                                    🏢 {{ $currentSession->room->name }}
                                                </div>
                                            </div>
                                            
                                            <div class="flex items-center justify-between mt-2 border-t border-indigo-100/60 pt-1.5">
                                                <span class="text-[10px] text-gray-500 font-medium truncate max-w-[110px]">
                                                    🎓 {{ $currentSession->group->teacher->name ?? 'Ustoz' }}
                                                </span>
                                                
                                                <button @click="deleteModal = true; activeSessionId = {{ $currentSession->id }}" 
                                                        class="text-red-500 hover:bg-red-50 text-xs p-1 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity" title="Darsni o'chirish qoidalari">
                                                    🗑️
                                                </button>
                                            </div>
                                        </div>
                                    @else
                                        <button @click="scheduleModal = true; rangeType = 'single_date'; quickDate = '{{ $thisCellDate }}'; quickStartTime = '{{ $times[0] }}'; quickEndTime = '{{ $times[1] }}';"
                                            class="w-full h-full flex flex-col items-center justify-center text-[11px] text-gray-400 border border-dashed border-gray-200 rounded-xl hover:bg-indigo-50/40 hover:border-indigo-300 hover:text-indigo-600 transition-all select-none group py-4">
                                            <span class="text-sm font-bold opacity-40 group-hover:opacity-100">+</span>
                                            <span class="text-[9px] font-medium opacity-0 group-hover:opacity-100 transition-opacity">Dars biriktirish</span>
                                        </button>
                                    @endif
                                </td>
                            @endfor
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div x-show="scheduleModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
            <div class="fixed inset-0 bg-gray-500/75 backdrop-blur-sm" @click="scheduleModal = false"></div>
            <div class="flex min-h-full items-center justify-center p-4">
                <div class="relative transform overflow-hidden rounded-2xl bg-white shadow-xl transition-all w-full max-w-lg">
                    
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                        <h3 class="text-base font-bold text-gray-900">Jadvalga dars o'rnatish tizimi</h3>
                        <button @click="scheduleModal = false" class="text-gray-400 hover:text-gray-600">✕</button>
                    </div>

                    <form action="{{ route('manage.schedules.store', $center->slug) }}" method="POST">
                        @csrf
                        <div class="bg-white px-6 py-4 space-y-4">
                            
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Rejalashtirish turi *</label>
                                <select name="range_type" x-model="rangeType" required class="w-full px-3 py-2 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20">
                                    <option value="single_date">Faqat tanlangan bitta kun uchun</option>
                                    <option value="current_week">Faqat shu hafta kunlari uchun</option>
                                    <option value="current_month">Faqat shu joriy oy kunlari uchun</option>
                                    <option value="custom_months">Maxsus tanlangan oylar uchun</option>
                                    <option value="current_year">Butun yil oxirigacha</option>
                                </select>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 mb-1">Guruh *</label>
                                    <select name="group_id" required class="w-full px-3 py-2 text-sm border border-gray-200 rounded-xl">
                                        <option value="">Guruhni tanlang</option>
                                        @foreach($groups as $group)
                                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 mb-1">Xona *</label>
                                    <select name="room_id" required class="w-full px-3 py-2 text-sm border border-gray-200 rounded-xl">
                                        <option value="">Xonani tanlang</option>
                                        @foreach($rooms as $room)
                                            <option value="{{ $room->id }}">{{ $room->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div x-show="rangeType === 'single_date'">
                                <label class="block text-xs font-semibold text-gray-700 mb-1">Sana *</label>
                                <input type="date" name="single_date" :value="quickDate" :required="rangeType === 'single_date'" class="w-full px-3 py-2 text-sm border border-gray-200 rounded-xl">
                            </div>

                            <div x-show="rangeType !== 'single_date'" class="space-y-3">
                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 mb-1">Dars kunlari tartibi *</label>
                                    <select name="day_type" x-model="dayType" class="w-full px-3 py-2 text-sm border border-gray-200 rounded-xl">
                                        <option value="odd">Toq kunlar (Dush / Chor / Jum)</option>
                                        <option value="even">Juft kunlar (Sesh / Pay / Sha)</option>
                                        <option value="workdays_5">Ish kunlari (5 kun)</option>
                                        <option value="workdays_6">Ish kunlari (6 kun)</option>
                                        <option value="everyday">Har kuni (Dush - Sha)</option>
                                        <option value="custom">Maxsus kunlarni belgilash</option>
                                    </select>
                                </div>

                                <div x-show="dayType === 'custom'" class="p-3 bg-gray-50 rounded-xl grid grid-cols-2 gap-2">
                                    <label class="inline-flex items-center text-xs text-gray-700 font-medium cursor-pointer"><input type="checkbox" name="custom_days[]" value="1" class="rounded mr-2"> Dushanba</label>
                                    <label class="inline-flex items-center text-xs text-gray-700 font-medium cursor-pointer"><input type="checkbox" name="custom_days[]" value="2" class="rounded mr-2"> Seshanba</label>
                                    <label class="inline-flex items-center text-xs text-gray-700 font-medium cursor-pointer"><input type="checkbox" name="custom_days[]" value="3" class="rounded mr-2"> Chorshanba</label>
                                    <label class="inline-flex items-center text-xs text-gray-700 font-medium cursor-pointer"><input type="checkbox" name="custom_days[]" value="4" class="rounded mr-2"> Payshanba</label>
                                    <label class="inline-flex items-center text-xs text-gray-700 font-medium cursor-pointer"><input type="checkbox" name="custom_days[]" value="5" class="rounded mr-2"> Juma</label>
                                    <label class="inline-flex items-center text-xs text-gray-700 font-medium cursor-pointer"><input type="checkbox" name="custom_days[]" value="6" class="rounded mr-2"> Shanba</label>
                                </div>
                            </div>

                            <div x-show="rangeType === 'custom_months'" class="p-3 bg-indigo-50/50 border border-indigo-100 rounded-xl">
                                <label class="block text-xs font-semibold text-indigo-900 mb-2">Qaysi oylar uchun amal qilsin?</label>
                                <div class="grid grid-cols-3 gap-2 text-xs">
                                    @php $months = ['Yanvar', 'Fevral', 'Mart', 'Aprel', 'May', 'Iyun', 'Iyul', 'Avgust', 'Sentabr', 'Oktabr', 'Noyabr', 'Dekabr']; @endphp
                                    @foreach($months as $mIdx => $mName)
                                        <label class="inline-flex items-center"><input type="checkbox" name="custom_months[]" value="{{ $mIdx+1 }}" class="rounded text-indigo-600 mr-1.5"> {{ $mName }}</label>
                                    @endforeach
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 mb-1">Boshlanish vaqti *</label>
                                    <input type="time" name="start_time" :value="quickStartTime" required class="w-full px-3 py-2 text-sm border border-gray-200 rounded-xl">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 mb-1">Tugash vaqti *</label>
                                    <input type="time" name="end_time" :value="quickEndTime" required class="w-full px-3 py-2 text-sm border border-gray-200 rounded-xl">
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 px-6 py-3.5 border-t border-gray-100 flex justify-end space-x-2">
                            <button type="button" @click="scheduleModal = false" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-xl">Yopish</button>
                            <button type="submit" class="px-4 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-xl hover:bg-indigo-700">Tasdiqlash</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div x-show="deleteModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
            <div class="fixed inset-0 bg-gray-500/75 backdrop-blur-sm" @click="deleteModal = false"></div>
            <div class="flex min-h-full items-center justify-center p-4">
                <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-md p-6">
                    <h3 class="text-base font-bold text-gray-900 mb-2">⚠️ Darsni olib tashlash qoidasi</h3>
                    <p class="text-xs text-gray-500 mb-4">Ushbu dars seriyali zanjirning bir qismi hisoblanadi. O'chirish turini tanlang:</p>
                    
                    <form :action="'/manage/schedules/{{ $center->slug }}/' + activeSessionId" method="POST" class="space-y-3">
                        @csrf @method('DELETE')
                        
                        <label class="flex items-start p-3 border border-gray-200 rounded-xl cursor-pointer hover:bg-gray-50">
                            <input type="radio" name="delete_type" value="only_session" checked class="mt-1 text-indigo-600 focus:ring-indigo-500">
                            <div class="ml-3">
                                <span class="block text-sm font-bold text-gray-900">Faqat shu kunni o'zi</span>
                                <span class="block text-xs text-gray-500">Taqvimdan faqatgina shu tanlangan sanadagi seans o'chadi.</span>
                            </div>
                        </label>

                        <label class="flex items-start p-3 border border-gray-200 rounded-xl cursor-pointer hover:bg-gray-50">
                            <input type="radio" name="delete_type" value="this_month" class="mt-1 text-indigo-600 focus:ring-indigo-500">
                            <div class="ml-3">
                                <span class="block text-sm font-bold text-gray-900">Shu joriy oydagi barcha kunlarini</span>
                                <span class="block text-xs text-gray-500">Ushbu guruhning shu oydagi barcha darslari bekor qilinadi.</span>
                            </div>
                        </label>

                        <label class="flex items-start p-3 border border-gray-200 rounded-xl cursor-pointer hover:bg-gray-50">
                            <input type="radio" name="delete_type" value="future_sessions" class="mt-1 text-indigo-600 focus:ring-indigo-500">
                            <div class="ml-3">
                                <span class="block text-sm font-bold text-gray-900">Shu kundan boshlab kelajakdagilarni</span>
                                <span class="block text-xs text-gray-500">Shu sana va undan keyingi barcha darslar to'liq o'chiriladi.</span>
                            </div>
                        </label>

                        <label class="flex items-start p-3 border border-red-200 bg-red-50/20 rounded-xl cursor-pointer hover:bg-red-50/50">
                            <input type="radio" name="delete_type" value="all_series" class="mt-1 text-red-600 focus:ring-red-500">
                            <div class="ml-3">
                                <span class="block text-sm font-bold text-red-900">Butun boshli seriyani (Hamma darslarni)</span>
                                <span class="block text-xs text-red-600">Yaratilgan barcha o'tgan va kelgusi seanslar butunlay yo'q qilinadi.</span>
                            </div>
                        </label>

                        <div class="flex justify-end space-x-2 pt-4 border-t border-gray-100 mt-4">
                            <button type="button" @click="deleteModal = false" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-xl">Bekor qilish</button>
                            <button type="submit" class="px-4 py-2 text-sm font-bold text-white bg-red-600 rounded-xl hover:bg-red-700">Ijro etish</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-layout.manage.app>