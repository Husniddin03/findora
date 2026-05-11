<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h2 class="text-2xl font-bold text-gray-900">Tokenlar</h2>
        <button wire:click="create" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Yangi token
        </button>
    </div>

    <!-- Filters -->
    <div class="bg-white p-4 rounded-xl border border-gray-200">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <input wire:model.live="search" type="text" placeholder="Qidirish..." 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <select wire:model.live="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">Barcha statuslar</option>
                    <option value="active">Faol</option>
                    <option value="inactive">Nofaol</option>
                </select>
            </div>
            <div>
                <select wire:model.live="perPage" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="10">10 / sahifa</option>
                    <option value="20">20 / sahifa</option>
                    <option value="50">50 / sahifa</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Flash Messages -->
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            {{ session('message') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            {{ session('error') }}
        </div>
    @endif

    <!-- Table -->
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th wire:click="sortBy('name')" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100">
                        Nomi
                        @if($sortField === 'name') 
                            <span class="ml-1">{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                        @endif
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Token</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th wire:click="sortBy('expires_at')" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100">
                        Muddati
                        @if($sortField === 'expires_at') 
                            <span class="ml-1">{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                        @endif
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Yaratuvchi</th>
                    <th wire:click="sortBy('created_at')" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100">
                        Sana
                        @if($sortField === 'created_at') 
                            <span class="ml-1">{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                        @endif
                    </th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Amallar</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($tokens as $token)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div>
                            <span class="text-sm font-medium text-gray-900">{{ $token->name }}</span>
                            @if($token->description)
                                <p class="text-xs text-gray-500">{{ Str::limit($token->description, 50) }}</p>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center gap-2">
                            <code class="text-xs bg-gray-100 px-2 py-1 rounded">{{ Str::limit($token->token, 20) }}...</code>
                            <button onclick="copyToClipboard('{{ $token->token }}')" class="text-gray-500 hover:text-indigo-600" title="Nusxa olish">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                </svg>
                            </button>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <button wire:click="toggleStatus({{ $token->id }})" 
                                class="px-2 py-1 text-xs rounded-full cursor-pointer
                                {{ $token->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $token->is_active ? 'Faol' : 'Nofaol' }}
                        </button>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        @if($token->expires_at)
                            @if($token->expires_at < now())
                                <span class="text-red-600">{{ $token->expires_at->format('d.m.Y H:i') }} (muddati o'tgan)</span>
                            @else
                                <span>{{ $token->expires_at->format('d.m.Y H:i') }}</span>
                            @endif
                        @else
                            <span class="text-gray-400">Cheksiz</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        @if($token->creator)
                            {{ $token->creator->name }}
                        @else
                            <span class="text-gray-400">Noma'lum</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $token->created_at->format('d.m.Y') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button wire:click="regenerate({{ $token->id }})" 
                                wire:confirm="Tokenni qayta yaratishni tasdiqlaysizmi?"
                                class="text-indigo-600 hover:text-indigo-900 mr-3">Qayta yaratish</button>
                        <button wire:click="edit({{ $token->id }})" class="text-indigo-600 hover:text-indigo-900 mr-3">Tahrirlash</button>
                        <button wire:click="delete({{ $token->id }})" 
                                wire:confirm="Tokenni o'chirishni tasdiqlaysizmi?"
                                class="text-red-600 hover:text-red-900">O'chirish</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                        Tokenlar topilmadi
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $tokens->links() }}
    </div>

    <!-- Create Modal -->
    @if($showCreateModal)
    <div class="fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75" wire:click="$set('showCreateModal', false)"></div>
            <div class="bg-white rounded-lg shadow-xl max-w-lg w-full relative z-10">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Yangi token</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nomi</label>
                            <input wire:model="form.name" type="text" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2">
                            @error('form.name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tavsif</label>
                            <textarea wire:model="form.description" rows="3" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2"></textarea>
                            @error('form.description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Status</label>
                            <div class="mt-2">
                                <label class="inline-flex items-center">
                                    <input wire:model="form.is_active" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <span class="ml-2 text-sm text-gray-700">Faol</span>
                                </label>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Muddati (ixtiyoriy)</label>
                            <input wire:model="form.expires_at" type="datetime-local" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2">
                            @error('form.expires_at') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            <p class="mt-1 text-xs text-gray-500">Bo'sh qoldirilsa, muddati cheksiz bo'ladi</p>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-6 py-3 flex justify-end gap-2 rounded-b-lg">
                    <button wire:click="$set('showCreateModal', false)" class="px-4 py-2 border rounded-lg">Bekor qilish</button>
                    <button wire:click="store" class="px-4 py-2 bg-indigo-600 text-white rounded-lg">Yaratish</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Edit Modal -->
    @if($showEditModal)
    <div class="fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75" wire:click="$set('showEditModal', false)"></div>
            <div class="bg-white rounded-lg shadow-xl max-w-lg w-full relative z-10">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Tokenni tahrirlash</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nomi</label>
                            <input wire:model="form.name" type="text" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2">
                            @error('form.name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tavsif</label>
                            <textarea wire:model="form.description" rows="3" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2"></textarea>
                            @error('form.description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Status</label>
                            <div class="mt-2">
                                <label class="inline-flex items-center">
                                    <input wire:model="form.is_active" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <span class="ml-2 text-sm text-gray-700">Faol</span>
                                </label>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Muddati (ixtiyoriy)</label>
                            <input wire:model="form.expires_at" type="datetime-local" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2">
                            @error('form.expires_at') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            <p class="mt-1 text-xs text-gray-500">Bo'sh qoldirilsa, muddati cheksiz bo'ladi</p>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-6 py-3 flex justify-end gap-2 rounded-b-lg">
                    <button wire:click="$set('showEditModal', false)" class="px-4 py-2 border rounded-lg">Bekor qilish</button>
                    <button wire:click="update" class="px-4 py-2 bg-indigo-600 text-white rounded-lg">Yangilash</button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<script>
    window.copyToClipboard = function(text) {
        navigator.clipboard.writeText(text).then(() => {
            alert('Token nusxalandi!');
        }).catch(err => {
            console.error('Nusxa olishda xatolik:', err);
            alert('Nusxa olishda xatolik yuz berdi');
        });
    };
</script>
