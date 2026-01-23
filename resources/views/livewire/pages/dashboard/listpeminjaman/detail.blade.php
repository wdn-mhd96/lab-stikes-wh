<div>
    @if(empty($peminjaman))
        <div class="p-4 bg-red-400/50 text-red-700 rounded flex justify-start gap-2">
            <x-icon name="x-circle" />
            <span>Data Peminjaman Tidak Ditemukan</span>
        </div>
    @else
        <div class="flex justify-between items-center">
            <h1 class="font-bold text-xl md:text-2xl text-gray-600 uppercase">Detail Peminjaman Alat</h1>
            @if($peminjaman->status_id == 2)
            <div class="flex justify-center items-center gap-2">
                <a href="{{ route('formCetak', ['id' => $id]) }}" target="_blank" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">Cetak Form</a>
            </div>
            @endif
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
            @if($peminjaman->status_id == 4)
            <tr class="hover:bg-gray-100 border-y border-gray-300">
                <td class="p-3 font-semibold w-[20%]">Bukti Pengembalian</td>
                <td class="p-3 font-semibold w-[10px] text-right">:</td>
                <td class="p-3 ">
                    <a href="{{ asset('storage/'. $peminjaman->bukti_pengembalian)}}" target="_blank"
                        class="py-2 px-4 rounded bg-violet-700 text-white font-semibold"
                        >image</a>
                </td>
            </tr>
            @endif
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
        <form wire:submit.prevent="prosesPengajuan" enctype="multipart/form-data">
        <table class="w-full border border-gray-300 rounded-lg overflow-hidden">
                <thead>
                    <tr class="bg-violet-600 text-white">
                        <th class="px-4 py-2">No.</th>
                        <th class="px-4 py-2">Nama Alat</th>
                        <th class="px-4 py-2">Kode Alat</th>
                        <th class="px-4 py-2">Disposable</th>
                        <th class="px-4 py-2">Qty Diajukan</th>
                        @if($approve)
                            <th class="px-4 py-2">Qty Disetujui</th>
                        @endif
                        @if($peminjaman->status_id == 2 || $peminjaman->status_id == 4)
                            <th class="px-4 py-2">Qty Disetujui</th>
                            <th class="px-4 py-2">Qty Dikembalikan</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($peminjaman->details as $index => $detail)
                    <tr class="{{ $index % 2 == 0 ? 'bg-gray-100' : ''}} ">
                        <td class="px-4 py-2 text-center"> {{ $index + 1}}</td>
                        <td class="px-4 py-2 "> {{ $detail->alat->item_name}}</td>
                        <td class="px-4 py-2 text-center"> {{ $detail->alat->item_code}}</td>
                        <td class="px-4 py-2 text-center">
                            <span class="px-2 py-1 rounded-full text-xs font-medium
                                {{ $detail->alat->disposable ? 'bg-green-700' : 'bg-red-700' }} text-white">
                                {{ $detail->alat->disposable ? 'Ya' : 'Tidak' }}
                            </span>
                        </td>
                        <td class="px-4 py-2 text-center"> {{ $detail->quantity_diajukan}}</td>
                        @if($approve)
                            <td class="px-4 py-2">
                                <input
                                    type="number"
                                    min="0"
                                    max="{{ $detail->quantity_diajukan }}"
                                    wire:model.defer="approvedQty.{{ $detail->id }}"
                                    class="input"
                                >
                            </td>
                        @endif
                        @if($peminjaman->status_id ==  2)
                            <td class="px-4 py-2 text-center"> {{ $detail->quantity_disetujui}}</td>
                            <td class="px-4 py-2">
                                <input
                                    type="number"
                                    min="0"
                                    max="{{ $detail->quantity_disetujui }}"
                                    wire:model.defer="returnedQty.{{ $detail->id }}"
                                    class="input"
                                    value="@if($detail->alat->disposable) 0 @else returnedQty.{{ $detail->id }} @endif"
                                >
                            </td>
                        @endif
                        @if($peminjaman->status_id ==  4)
                            <td class="px-4 py-2 text-center"> {{ $detail->quantity_disetujui}}</td>
                            <td class="px-4 py-2 text-center"> {{ $detail->quantity_dikembalikan}}</td>
                        @endif
                    </tr>
                    @endforeach
                    @if($approve || $reject || $peminjaman->status_id == 2)
                        <tr class="mt-3"> 
                            <td colspan ="@if($approve) 6 @elseif($peminjaman->status_id == 2) 7 @else 5 @endif">
                                <textarea wire:model="comment" name="" id="" class="rounded w-full p-3" placeholder="Komentar"></textarea>
                            </td>
                        </tr>
                        @if($peminjaman->status_id == 2)
                        <tr class="mt-3"> 
                            <td colspan ="@if($approve) 6 @elseif($peminjaman->status_id == 2) 7 @else 5 @endif">
                                Bukti Pengembalian
                            </td>
                        </tr>
                        <tr class="mt-3"> 
                            <td colspan ="@if($approve) 6 @elseif($peminjaman->status_id == 2) 7 @else 5 @endif">
                                <input type="file" name="file" wire:model="buktipengembalian" id="" class="input" accept=".jpg, .jpeg, .png, .webp, .gif, .svg,">
                            </td>
                        </tr>
                        @endif
                        <tr class="mt-3">
                            <td colspan ="@if($approve) 6 @elseif($peminjaman->status_id == 2) 7 @else 5 @endif" class="text-right">
                                <button type="submit" class="bg-violet-600 text-white py-2 px-4 rounded hover:bg-violet-700">@if($approve) Setujui @elseif($peminjaman->status_id == 2) Selesaikan @else Tolak @endif</button>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </form>

        <div class="flex justify-between items-center my-6">
            <h1 class="font-bold text-xl md:text-2xl text-gray-600 uppercase">History Peminjaman</h1>
        </div>
            <div>
                @foreach($history as $hist)
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
