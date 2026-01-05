<div>
    @if(empty($peminjaman))
        <div class="p-4 bg-red-400/50 text-red-700 rounded flex justify-start gap-2">
            <x-icon name="x-circle" />
            <span>Data Peminjaman Tidak Ditemukan</span>
        </div>
    @else
        <div class="flex justify-between items-center">
            <h1 class="font-bold text-xl md:text-2xl text-gray-600 uppercase">Detail Peminjaman Alat</h1>
        </div>

        <table class="text-gray-500 w-full mt-3">
            <tr class="hover:bg-gray-100 border-y border-gray-300">
                <td class="p-3 font-semibold w-[20%]">Kode Peminjaman</td>
                <td class="p-3 font-semibold w-[10px] text-right">:</td>
                <td class="p-3 ">{{ $peminjaman->code}}</td>
            </tr>
            <tr class="hover:bg-gray-100 border-y border-gray-300">
                <td class="p-3 font-semibold w-[20%]">Nama Peminjam</td>
                <td class="p-3 font-semibold w-[10px] text-right">:</td>
                <td class="p-3 ">{{ $peminjaman->nama_peminjam}}</td>
            </tr>
            <tr class="hover:bg-gray-100 border-y border-gray-300">
                <td class="p-3 font-semibold w-[20%]">NIM Peminjam</td>
                <td class="p-3 font-semibold w-[10px] text-right">:</td>
                <td class="p-3 ">{{ $peminjaman->nim}}</td>
            </tr>
            <tr class="hover:bg-gray-100 border-y border-gray-300">
                <td class="p-3 font-semibold w-[20%]">Jurusan / TK</td>
                <td class="p-3 font-semibold w-[10px] text-right">:</td>
                <td class="p-3 ">{{ $peminjaman->user->name}}</td>
            </tr>
            <tr class="hover:bg-gray-100 border-y border-gray-300">
                <td class="p-3 font-semibold w-[20%]">Status Peminjaman</td>
                <td class="p-3 font-semibold w-[10px] text-right">:</td>
                <td class="p-3 ">
                    <span class=" py-2 px-3 rounded-full text-white
                        @if($peminjaman->status->id == 1)
                        bg-amber-600
                        @elseif($peminjaman->status->id == 2)
                        bg-emerald-600
                        @elseif($peminjaman->status->id == 3)
                        bg-red-600
                        @elseif($peminjaman->status->id == 4)
                        bg-sky-600
                        @endif
                    ">
                        {{ $peminjaman->status->status_name}}
                    </span>
                </td>
            </tr>
            <tr class="hover:bg-gray-100 border-y border-gray-300">
                <td class="p-3 font-semibold w-[20%]">Tanggal Peminjaman</td>
                <td class="p-3 font-semibold w-[10px] text-right">:</td>
                <td class="p-3 ">{{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('l, d M Y')}}</td>
            </tr>
            <tr class="hover:bg-gray-100 border-y border-gray-300">
                <td class="p-3 font-semibold w-[20%]">Waktu Peminjaman</td>
                <td class="p-3 font-semibold w-[10px] text-right">:</td>
                <td class="p-3 ">
                    {{ \Carbon\Carbon::parse($peminjaman->jam_mulai)->format('H:i')}}
                     - 
                    {{ \Carbon\Carbon::parse($peminjaman->jam_selesai   )->format('H:i')}}
                </td>
            </tr>
        </table>

        <div class="flex justify-between items-center mt-6 mb-2">
            <h1 class="font-bold text-xl md:text-2xl text-gray-600 uppercase">Detail Alat</h1>
            @if($peminjaman->status_id == 1)
            <div class="flex justify-center items-center gap-2">
                <button wire:click="approvePengajuan" class="bg-emerald-600 py-2 px-4 rounded text-white hover:bg-emerald-700 text-sm">Setuju</button>
                <button wire:click="rejectPengajuan" class="bg-red-600 py-2 px-4 rounded text-white hover:bg-red-700 text-sm">Tolak</button>
            </div>
            @endif
        </div>
        <table class="w-full border border-gray-300 rounded-lg overflow-hidden">
                <thead>
                    <tr class="bg-violet-600 text-white">
                        <th class="px-4 py-2">No.</th>
                        <th class="px-4 py-2">Nama Alat</th>
                        <th class="px-4 py-2">Kode Alat</th>
                        <th class="px-4 py-2">Qty Diajukan</th>
                        <th class="px-4 py-2">Qty Disetujui</th>
                        <th class="px-4 py-2">Qty Dikembalikan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($peminjaman->details as $index => $detail)
                    <tr class="{{ $index % 2 == 0 ? 'bg-gray-100' : ''}} ">
                        <td class="px-4 py-2 text-center"> {{ $index + 1}}</td>
                        <td class="px-4 py-2 "> {{ $detail->alat->item_name}}</td>
                        <td class="px-4 py-2 text-center"> {{ $detail->alat->item_code}}</td>
                        <td class="px-4 py-2 text-center"> {{ $detail->quantity_diajukan}}</td>
                        <td class="px-4 py-2 text-center"> {{ $detail->quantity_disetujui ?? "-"}}</td>
                        <td class="px-4 py-2 text-center"> {{ $detail->quantity_dikembalikan ?? "-"}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        <div class="flex justify-between items-center my-6">
            <h1 class="font-bold text-xl md:text-2xl text-gray-600 uppercase">History Peminjaman</h1>
        </div>
            <div>
                @foreach($peminjaman->history as $hist)
                    <div class="absolute left-3 top-0 h-full w-px bg-gray-300"></div>

                    <!-- Item -->
                    <div class="relative flex gap-4 pb-8">
                        <!-- Dot -->
                        <div class="absolute left-0 top-1">
                            <span class="flex h-3 w-3 items-center justify-center rounded-full 
                            @if($hist->new_status_id == 1)
                            bg-amber-600 
                            @elseif($hist->new_status_id == 2)
                            bg-emerald-600
                            @elseif($hist->new_status_id == 3)
                            bg-red-600
                            @elseif($hist->new_status_id == 4)
                            bg-sky-600
                            @endif
                            ring-4 ring-white"></span>
                        </div>

                        <!-- Content -->
                        <div class="ml-5">
                            <p class="text-sm font-semibold text-gray-900">{{ $hist->newStatus->status_name}}</p>
                            <p class="text-xs text-gray-500">Oleh :  {{ $hist->user->name}} • {{ \Carbon\Carbon::parse($hist->created_at)->format('l, d M Y H:i')}}</p>
                            @if(!empty($hist->old_status_id))
                            <p class="text-xs text-gray-500">Status Sebelumnya : {{ $hist->oldStatus->status_name}}</p>
                            @endif
                            <p class="mt-1 text-sm text-gray-600">
                                {{ $hist->comment }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
    @endif

</div>
