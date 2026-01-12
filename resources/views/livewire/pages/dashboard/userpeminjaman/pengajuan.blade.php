<div> 
    <div class="w-full" @click.outside="open = false">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold text-gray-700">Form Pengajuan Alat</h2>
            <a href="{{ route('user.peminjaman')}}" class="text-gray-500 hover:text-gray-700"><x-icon name="x-mark"></x-icon></a>
        </div>
        <table class="w-full border border-gray-300 rounded-lg overflow-hidden">
            <thead>
                <tr class="bg-violet-600 text-white">
                    <th class="px-4 py-2">No.</th>
                    <th class="px-4 py-2">Kode</th>
                    <th class="px-4 py-2">Nama</th>
                    <th class="px-4 py-2">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $index => $item)
                    <tr class="border-b border-gray-300  text-sm {{ $index % 2 !== 0 ? 'bg-white' : 'bg-gray-100' }}">
                        <td class="px-4 py-2 text-center">{{ $index + 1 }}</td>
                        <td class="px-4 py-2">{{ $item->item_code }}</td>
                        <td class="px-4 py-2">{{ $item->item_name }}</td>
                        <td class="px-4 py-2">{{ $item->qty }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="w-full md:w-[50%] m-auto mt-6">
            <form wire:submit.prevent="ajukanPeminjaman">
                <div class="mb-4">
                    <x-input-label for="tgl_peminjaman" :value="__('Tanggal Peminjaman')" />
                    <x-text-input @keydown.prevent wire:model="tgl_peminjaman" id="tgl_peminjaman" class="block mt-1 w-full" type="date" min="{{ now()->addDay()    ->format('Y-m-d') }}" name="tgl_peminjaman" />
                    <x-input-error :messages="$errors->get('tgl_peminjaman')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <x-input-label for="" :value="__('Waktu Peminjaman')" />
                    <div class="flex justify-start items-center gap-4">
                        <div>
                            <x-text-input wire:model="jam_mulai" id="jam_mulai" class="block mt-1 w-full" type="time" name="jam_mulai" />
                            <x-input-error :messages="$errors->get('jam_mulai')" class="mt-2" />
                        </div>
                        <span class="text-sm text-gray-600">S/D</span>
                        <div>
                            <x-text-input wire:model="jam_selesai" id="jam_selesai" class="block mt-1 w-full" type="time" name="jam_selesai" />
                            <x-input-error :messages="$errors->get('jam_selesai')" class="mt-2" />
                        </div>
                    </div>
                    <div class="mb-4 mt-4">
                        <x-input-label for="ruanganId" :value="__('Ruangan')" />
                        <select name="ruanganId" id="ruanganId" class="tom-select border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" wire:model="ruanganId">
                            <option value="">--Pilih Ruangan--</option>
                            @foreach($ruangan as $ruang)
                            <option value="{{ $ruang->id }}">{{$ruang->nama_ruangan}}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('ruanganId')" class="mt-2" />
                    </div>
                </div>
                <div class="mb-4">
                    <x-input-label for="nim" :value="__('NIM Peminjaman')" />
                    <x-text-input wire:model="nim" id="nim" class="block mt-1 w-full" type="text" name="nim" />
                    <x-input-error :messages="$errors->get('nim')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <x-input-label for="nama" :value="__('Nama Peminjaman')" />
                    <x-text-input wire:model="nama" id="nama" class="block mt-1 w-full" type="text" name="nama" />
                    <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                </div>

                <div class="flex justify-between">
                    <a href="{{ route('user.peminjaman')}}" class="bg-gray-600 text-white py-2 px-4 rounded">Kembali</a>
                    <x-primary-button type="submit" wire:loading.attr="disabled" wire:loading.class="opacity-25">
                        {{ __('Simpan') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

</div>
