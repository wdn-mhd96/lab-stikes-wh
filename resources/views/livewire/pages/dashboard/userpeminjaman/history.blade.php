<div x-data="{ open: $wire.entangle('formOpen'), openImport: $wire.entangle('importOpen') }" class="p-6">
    <div>
        <div class="flex justify-between items-center">
            <h1 class="font-bold text-xl md:text-2xl text-gray-600 uppercase">Manajemen Peminjaman Alat</h1>
            <div class="flex items-center gap-3">
            {{-- <button wire:click="openAdd" class="bg-violet-600 text-white hover:bg-violet-700 rounded-md py-2 px-4 text-sm">Tambah Inventory</button> --}}
            {{-- <button wire:click="openImport" class="bg-emerald-600 text-white hover:bg-emerald-700 rounded-md py-2 px-4 text-sm">Import Inventory</button> --}}
            </div>
        </div>
        {{-- <div class="mt-3 relative">
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
        </div> --}}
        <div class="mt-3 overflow-x-auto">
            <table class="w-full border border-gray-300 rounded-lg overflow-hidden">
                <thead>
                    <tr class="bg-violet-600 text-white">
                        <th class="px-4 py-2">No.</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Jumlah Alat</th>
                        <th class="px-4 py-2">Tanggal Peminjaman</th>
                        <th class="px-4 py-2">Waktu Peminjaman</th>
                        <th class="px-4 py-2">action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($peminjaman as $index => $pinjam)

                    <tr class="border-b border-gray-300  text-sm {{ $index % 2 !== 0 ? 'bg-white' : 'bg-gray-100' }}">
                        <td class="px-4 py-2 text-center">{{ $index + 1}}</td>
                        <td class="px-4 py-2">
                            <span class=" py-2 px-3 rounded-full text-white
                                @if($pinjam->status->id == 1)
                                bg-amber-600
                                @elseif($pinjam->status->id == 2)
                                bg-emerald-600
                                @elseif($pinjam->status->id == 3)
                                bg-red-600
                                @elseif($pinjam->status->id == 4)
                                bg-sky-600
                                @endif
                            ">
                                {{ $pinjam->status->status_name}}
                            </span>
                        </td>
                        <td class="px-4 py-2 text-center">{{ $pinjam->details_count }}</td>
                        <td class="px-4 py-2 text-center">{{ \Carbon\Carbon::parse($pinjam->tanggal_pinjam)->format('l, d M Y')}}</td>
                        <td class="px-4 py-2 text-center">
                            {{ \Carbon\Carbon::parse($pinjam->jam_mulai)->format('H:i')}}
                            - 
                            {{ \Carbon\Carbon::parse($pinjam->jam_selesai)->format('H:i')}}
                        </td>
                        
                        <td class="px-4 py-2 flex justify-center gap-2 items-center">
                            <a wire:navigate href="{{ route('user.detail', ['id' => $pinjam->id])}}" class="bg-emerald-600 text-white hover:bg-emerald-700 rounded-md py-1 px-3 text-sm">Confirm</a>
                        </td>
                    </tr>
                    @endforeach
                    @if($peminjaman->isEmpty())
                    <tr>
                        <td colspan="6" class="px-4 py-2 text-center">Belum ada data Data Peminjaman.</td>
                    </tr>
                    @endif  
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $peminjaman->links() }}
        </div>
    </div>
</div>
