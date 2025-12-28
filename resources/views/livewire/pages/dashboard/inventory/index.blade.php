<div x-data="{ open: $wire.entangle('formOpen'), openImport: $wire.entangle('importOpen') }" class="p-6">
    <div>
        <div class="flex justify-between items-center">
            <h1 class="font-bold text-xl md:text-2xl text-gray-600 uppercase">Manajemen Inventory</h1>
            <div class="flex items-center gap-3">
            <button wire:click="openAdd" class="bg-violet-600 text-white hover:bg-violet-700 rounded-md py-2 px-4 text-sm">Tambah Inventory</button>
            <button wire:click="openImport" class="bg-emerald-600 text-white hover:bg-emerald-700 rounded-md py-2 px-4 text-sm">Import Inventory</button>
            </div>
        </div>
        <div class="mt-3 relative">
            <input type="text" wire:model.live.debounce.500ms="search" placeholder="Cari inventory..." class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-violet-500" />
            <x-icon name="magnifying-glass" class="absolute right-3 top-2.5"/>
        </div>
        <div class="mt-3">
            <input type="radio" name="disposable" id="disposable-all" wire:model.live="disposableFilter" value="all" class="mr-1"/>
            <label class="text-xs text-gray-600 mr-4" for="disposable-all">Semua</label>
            <input type="radio" name="disposable" id="disposable-yes" wire:model.live="disposableFilter" value="1" class="mr-1"/>
            <label class="text-xs text-gray-600 mr-4" for="disposable-yes">Disposable</label>
            <input type="radio" name="disposable" id="disposable-no" wire:model.live="disposableFilter" value="0" class="mr-1"/>
            <label class="text-xs text-gray-600 mr-4" for="disposable-no">Non-Disposable</label>
        </div>
        <div class="mt-3 overflow-x-auto">
            <table class="w-full border border-gray-300 rounded-lg overflow-hidden">
                <thead>
                    <tr class="bg-violet-600 text-white">
                        <th class="px-4 py-2">No.</th>
                        <th class="px-4 py-2">Kode</th>
                        <th class="px-4 py-2">Nama</th>
                        <th class="px-4 py-2">Qty</th>
                        <th class="px-4 py-2">Disposable</th>
                        <th class="px-4 py-2">Image</th>
                        <th class="px-4 py-2">action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($inventories as $index => $inventory)

                    <tr class="border-b border-gray-300  text-sm {{ $index % 2 !== 0 ? 'bg-white' : 'bg-gray-100' }}">
                        <td class="px-4 py-2 text-center">{{ $index + 1 + ($inventories->currentPage() - 1) * $inventories->perPage() }}</td>
                        <td class="px-4 py-2">{{ $inventory->item_code }}</td>
                        <td class="px-4 py-2">{{ $inventory->item_name }}</td>
                        <td class="px-4 py-2 text-center">{{ $inventory->quantity }}</td>
                        <td class="px-4 py-2 text-center">
                            <span class="px-2 py-1 rounded-full text-xs font-medium
                                {{ $inventory->disposable ? 'bg-green-700' : 'bg-red-700' }} text-white">
                                {{ $inventory->disposable ? 'Ya' : 'Tidak' }}
                            </span>
                        </td>
                        <td class="px-4 py-2 text-center">
                            @if($inventory->image)
                                <img src="{{ asset('storage/' . $inventory->image) }}" alt="Inventory Image" class="w-12 h-12 object-cover mx-auto rounded-md" />
                            @else
                                <span class="text-sm text-gray-500">No Image</span>
                            @endif  
                        </td>
                        <td class="px-4 py-2 flex justify-center gap-2 items-center">
                            <button wire:click="confirmDelete({{ $inventory->id }})"class="bg-red-600 text-white hover:bg-red-700 rounded-md py-1 px-3 text-sm">Hapus</button>
                            <button wire:click="editInventory({{ $inventory->id }})" class="bg-emerald-600 text-white hover:bg-emerald-700 rounded-md py-1 px-3 text-sm">Edit</button>
                        </td>
                    </tr>
                    @endforeach
                    @if($inventories->isEmpty())
                    <tr>
                        <td colspan="6" class="px-4 py-2 text-center">Belum ada data inventory.</td>
                    </tr>
                    @endif  
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $inventories->links() }}
        </div>
    </div>
    <livewire:pages.dashboard.inventory.form />
    <livewire:pages.dashboard.inventory.import />
</div>
