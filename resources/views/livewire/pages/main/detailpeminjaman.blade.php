<div x-data="{open:$wire.entangle('openForm')}"class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center z-50 backdrop-blur-md"
    x-show="open"
    x-cloak
    x-transition
    x-trap.noscroll="open"
    @keydown.escape.window="open = false">    
    <x-card class="w-full">
        <div class="w-full overflow-auto" @click.outside="open = false">
            <table class="w-full border border-gray-300 rounded-lg">
                <thead>
                    <tr class="bg-violet-600 text-white">
                        <th class="px-4 py-2">No.</th>
                        <th class="px-4 py-2">Nama Peminjam</th>
                        <th class="px-4 py-2">Ruangan</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Tanggal Peminjaman</th>
                        <th class="px-4 py-2">Waktu Peminjaman</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($peminjamans as $index => $pinjam)

                    <tr class="border-b border-gray-300  text-sm {{ $index % 2 !== 0 ? 'bg-white' : 'bg-gray-100' }}">
                        <td class="px-4 py-2 text-center">{{ $index + 1}}</td>
                        <td class="px-4 py-2">{{ $pinjam->user->name }}</td>
                        <td class="px-4 py-2">{{ $pinjam->ruangan->nama_ruangan }}</td>
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
                        <td class="px-4 py-2 text-center">{{ \Carbon\Carbon::parse($pinjam->tanggal_pinjam)->format('l, d M Y')}}</td>
                        <td class="px-4 py-2 text-center">
                            {{ \Carbon\Carbon::parse($pinjam->jam_mulai)->format('H:i')}}
                            - 
                            {{ \Carbon\Carbon::parse($pinjam->jam_selesai)->format('H:i')}}
                        </td>
                    </tr>
                    @endforeach
                    @if($peminjamans->isEmpty())
                    <tr>
                        <td colspan="6" class="px-4 py-2 text-center">Belum ada data Data Peminjaman.</td>
                    </tr>
                    @endif  
                </tbody>
            </table>
        </div>
    </x-card>
</div class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center z-50 backdrop-blur-md">
