<x-layout.manage.app :center="$center">
    <div x-data="{ roomModal: false, editModal: false, editData: {} }">
        
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm flex items-center justify-between">
                <span>✨ {{ session('success') }}</span>
            </div>
        @endif
        @if(session('error'))
            <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm flex items-center justify-between">
                <span>⚠️ {{ session('error') }}</span>
            </div>
        @endif

        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 tracking-tight">O'quv xonalari</h2>
                <p class="text-sm text-gray-500 mt-1">Markaz xonalarini dinamik boshqarish va sig'imini belgilash</p>
            </div>
            <button @click="roomModal = true" class="px-4 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-xl shadow-md hover:bg-indigo-700 transition-all">
                + Yangi xona
            </button>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200 text-left text-sm">
                <thead class="bg-gray-50 text-xs text-gray-500 uppercase font-bold">
                    <tr>
                        <th class="px-6 py-4">Xona nomi</th>
                        <th class="px-6 py-4">Sig'imi (O'quvchi)</th>
                        <th class="px-6 py-4">Band dars soatlari</th>
                        <th class="px-6 py-4 text-right">Amallar</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($rooms as $room)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4 font-semibold text-gray-900">{{ $room->name }}</td>
                        <td class="px-6 py-4 text-gray-600">
                            {{ $room->capacity ? $room->capacity . ' ta joy' : 'Belgilanmagan' }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $room->schedules_count > 0 ? 'bg-indigo-50 text-indigo-700' : 'bg-gray-100 text-gray-600' }}">
                                {{ $room->schedules_count }} ta dars bor
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <button @click="editModal = true; editData = {{ json_encode($room) }}" class="text-amber-500 hover:text-amber-700 font-medium">Tahrirlash</button>
                            <form action="{{ route('manage.rooms.destroy', [$center->slug, $room->id]) }}" method="POST" class="inline-block" onsubmit="return confirm('Ushbu xonani o‘chirishni xohlaysizmi?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 font-medium">O'chirish</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-gray-400 font-medium">Xonalar kiritilmagan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div x-show="roomModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;" x-cloak>
            <div class="fixed inset-0 bg-gray-500/75 backdrop-blur-sm" @click="roomModal = false"></div>
            <div class="flex min-h-full items-center justify-center p-4">
                <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-md p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Yangi o'quv xonasi qo'shish</h3>
                    <form action="{{ route('manage.rooms.store', $center->slug) }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Xona nomi *</label>
                            <input type="text" name="name" required placeholder="Masalan: 1-Xona (Green room)" class="w-full px-3 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:outline-none text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Sig'imi (Maksimal o'quvchi)</label>
                            <input type="number" name="capacity" placeholder="Masalan: 15" class="w-full px-3 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:outline-none text-sm">
                        </div>
                        <div class="flex justify-end space-x-2 pt-2">
                            <button type="button" @click="roomModal = false" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-xl hover:bg-gray-200">Bekor qilish</button>
                            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 shadow-sm">Saqlash</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div x-show="editModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;" x-cloak>
            <div class="fixed inset-0 bg-gray-500/75 backdrop-blur-sm" @click="editModal = false"></div>
            <div class="flex min-h-full items-center justify-center p-4">
                <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-md p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Xonani tahrirlash</h3>
                    <form :action="'/manage/rooms/{{ $center->slug }}/' + editData.id" method="POST" class="space-y-4">
                        @csrf @method('PUT')
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Xona nomi *</label>
                            <input type="text" name="name" x-model="editData.name" required class="w-full px-3 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:outline-none text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Sig'imi (Maksimal o'quvchi)</label>
                            <input type="number" name="capacity" x-model="editData.capacity" class="w-full px-3 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:outline-none text-sm">
                        </div>
                        <div class="flex justify-end space-x-2 pt-2">
                            <button type="button" @click="editModal = false" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-xl hover:bg-gray-200">Bekor qilish</button>
                            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-amber-600 rounded-xl hover:bg-amber-700 shadow-sm">Yangilash</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-layout.manage.app>