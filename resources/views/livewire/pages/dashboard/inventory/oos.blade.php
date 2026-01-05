<div x-data="{ open: $wire.entangle('formOpen'), openImport: $wire.entangle('importOpen') }" class="p-6">
    <div>
        <div class="flex justify-between items-center">
            <h1 class="font-bold text-xl md:text-2xl text-gray-600 uppercase">Inventory Kosong</h1>
            <div class="flex items-center gap-3">
           </div>
        </div>
        
        <div class="mt-3 overflow-x-auto">
            <form action="{{route('admin.pengajuan.oos')}}" method="post" target="_blank">
                {{ @csrf_field() }}
            <table class="w-full border border-gray-300 rounded-lg overflow-hidden">
                <thead>
                    <tr class="bg-violet-600 text-white">
                        <th class="px-4 py-2">No.</th>
                        <th class="px-4 py-2">Kode</th>
                        <th class="px-4 py-2">Nama</th>
                        <th class="px-4 py-2">Qty</th>
                        <th class="px-4 py-2">Qty Diajukan</th>
                        <th class="px-4 py-2">Disposable</th>
                        <th class="px-4 py-2">Image</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($inventories as $index => $inventory)

                    <tr class="border-b border-gray-300  text-sm {{ $index % 2 !== 0 ? 'bg-white' : 'bg-gray-100' }}">
                        <td class="px-4 py-2 text-center">{{ $index + 1 + ($inventories->currentPage() - 1) * $inventories->perPage() }}</td>
                        <td class="px-4 py-2 text-center">{{ $inventory->item_code }}</td>
                        <td class="px-4 py-2">{{ $inventory->item_name }}</td>
                        <td class="px-4 py-2 text-center">{{ $inventory->quantity }}</td>
                        <td class="px-4 py-2 text-center">
                                <input
                                    type="number"
                                    min="0"
                                    name="approvedQty.{{ $inventory->id }}"
                                    class="input w-[100px]"
                                >
                            </td>
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
                        
                    </tr>
                    @endforeach
                    @if($inventories->isEmpty())
                    <tr>
                        <td colspan="7" class="px-4 py-2 text-center">Belum ada data inventory.</td>
                    </tr>
                    @endif  

                    @if(!$inventories->isEmpty())
                    <tr>
                        <td colspan="7" class="p-4">
                            <button type="submit"class="float-right bg-red-600 text-white hover:bg-red-700 rounded-md py-2 px-4 text-sm">Ajukan Pengadaan Inventory</button>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
            </form>
        </div>
        <div class="mt-4">
            {{ $inventories->links() }}
        </div>
    </div>
</div>
