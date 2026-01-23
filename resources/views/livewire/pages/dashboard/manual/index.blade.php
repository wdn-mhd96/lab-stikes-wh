<div class="p-6 space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="font-bold text-xl md:text-2xl text-gray-600 uppercase">Peminjaman Manual</h1>
    </div>
    <div class="flex justify-start items-center gap-2">
        <div class="flex items-center gap-1">
            <span class="{{ $phase == 1 ? 'bg-violet-600' : 'bg-gray-500'}} text-white py-3 px-5 rounded-full">1</span>
            <span class="{{ $phase == 1 ? 'text-violet-600' : 'text-gray-500'}}">Detail Peminjam</span>
        </div>
            <span class="text-gray-500"> > </span>
        <div class="flex items-center gap-1">
            <span class="{{ $phase == 2 ? 'bg-violet-600' : 'bg-gray-500'}} text-white py-3 px-5 rounded-full">2</span>
            <span class="{{ $phase == 2 ? 'text-violet-600' : 'text-gray-500'}}">Detail Alat</span>
        </div>
    </div>
    <form wire:submit.prevent="save">
        @if($phase == 1)
            <div class="mb-4">
                <x-input-label for="user_id" :value="__('User (Kelas)')" />
                <select name="" wire:model="user_id" id="" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                    <option value="">--Pilih User--</option>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name}}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
            </div>
            <div class="mb-4">
                <x-input-label for="nim" :value="__('NIM Peminjam')" />
                <x-text-input wire:model="nim" id="nim" class="block mt-1 w-full" type="number" name="nim" autofocus />
                <x-input-error :messages="$errors->get('nim')" class="mt-2" />
            </div>
            <div class="mb-4">
                <x-input-label for="nama" :value="__('Nama Peminjam')" />
                <x-text-input wire:model="nama" id="nama" class="block mt-1 w-full" type="text" name="nama" autofocus />
                <x-input-error :messages="$errors->get('nama')" class="mt-2" />
            </div>
            <div class="mb-4">
                <x-input-label for="tanggal_pinjam" :value="__('Tanggal Peminjaman')" />
                <x-text-input wire:model="tanggal_pinjam" id="tanggal_pinjam" class="block mt-1 w-full" type="date" min="{{ now()->format('Y-m-d') }}" name="tanggal_pinjam" autofocus />
                <x-input-error :messages="$errors->get('tanggal_pinjam')" class="mt-2" />
            </div>
            <div class="mb-4">
                <x-input-label for="tanggal_pinjam" :value="__('Waktu Peminjaman')" />
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
            </div>
            <div class="mb-4 mt-4">
                <x-input-label for="ruanganId" :value="__('Ruangan')" />
                <select name="" wire:model="ruanganId" id="" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                    <option value="">--Pilih Ruangan--</option>
                    @foreach($ruangan as $ruang)
                    <option value="{{ $ruang->id }}">{{ $ruang->nama_ruangan}}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('ruanganId')" class="mt-2" />
            </div>
            
            <div class="flex justify-between mt-6">
                <a href="{{ route('admin.manual')}}" class="bg-gray-600 text-white py-2 px-4 rounded">Kembali</a>
                <span class="py-2 px-4 rounded bg-violet-600 hover:bg-violet-700 text-white cursor-pointer" wire:click="phaseTwo" wire:loading.attr="disabled" wire:loading.class="opacity-25">
                    {{ __('Next') }}
                </span>
            </div>
        @elseif($phase == 2)
            <div class="flex justify-center md:justify-end gap-6">
                @if(count(session()->get("cart_".auth()->id()) ?? []))
                <span x-data="{cart:$wire.entangle('cart')}" class="relative cursor-pointer
                    inline-flex items-center px-2 py-1  rounded text-gray-400 hover:text-gray-600 mb-6">
                    <div class="flex flex-col justify-center items-center">
                        <x-icon name="clipboard-document-list" class="text-center w-12 h-12 "></x-icon>
                        <span class="text-wrap">Pengajuan</span>
                    </div>
                    <div class="absolute top-0 right-2 py-1 px-[9px] bg-violet-600 text-[0.7rem] rounded-full text-white">{{ count(session()->get("cart_". auth()->id()) ?? [])}}</div>
                </span>
                <span wire:click="kosongkanList" class="relative cursor-pointer
                    inline-flex items-center justify-center px-2 py-1  rounded text-red-400 hover:text-red-600 mb-6 ">
                    <div class="flex flex-col justify-center items-center">
                        <x-icon name="trash" class="w-12 h-12 "></x-icon>
                        <span class="text-wrap">Kosongkan</span>
                    </div>
                </span>
                @endif 
            </div>
            <div class="mt-3 relative mb-3">
                <input type="text" wire:model.live.debounce.500ms="search" placeholder="Cari Alat . . ." class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-violet-500" />
                <x-icon name="magnifying-glass" class="absolute right-3 top-2.5"/>
            </div>
            <div class="grid grid-cols-[repeat(auto-fit,minmax(300px,1fr))] gap-4">
                @foreach ($inventoryList as $item)
                <div class="relative {{ $item->quantity > 0 ? 'bg-white' : 'bg-red-100'  }} shadow rounded-lg p-6">
                    @if(!empty($cart[$item->id]))
                        <span wire:click="removeCart({{$item->id}})"><x-icon name="x-mark" class="w-8 h-8 absolute top-3 right-3 p-2 rounded text-white bg-red-600 hover:bg-red-700 cursor-pointer"/></span>
                    @endif

                    <div class="flex justify-start items-center gap-6">
                        @if($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->item_name }}" class="w-16 h-16 object-cover rounded-md">
                        @else
                            <div class="w-24 h-24 bg-gray-200 flex justify-center items-center rounded-md">
                                <x-icon name="photo" class="text-gray-400 w-12 h-12"></x-icon>
                            </div>
                        @endif
                        <div>
                            <h2 class="text-lg font-semibold mb-4">{{ $item->item_name }}</h2>
                            <p class="text-md mb-2">Kode: {{ $item->item_code }}</p>
                            <p class="text-md mb-2">qty: {{ $item->quantity_available }}</p>
                            <p class="text-center text-md mb-2 font-bold text-white py-1 px-3 rounded {{ $item->quantity_available > 0 ? "bg-green-600" : "bg-red-600"}}">{{ $item->quantity > 0 ? "Tersedia" : "Kosong"}}</p>
                        </div>
                    </div>
                    @if ( $item->quantity > 0)
                        <div class="flex justify-between items-center" x-data="{ item: $wire.entangle('quantity.{{$item->id}}').live}">
                            <div>
                                <span @click="item > 1 ? item-- : 1" class="bg-emerald-600 hover:bg-emerald-700 py-1 px-3 text-white rounded">-</span>
                                <input type="number" x-model="item" class="w-[50px] focus:outline-none focus:border-none text-center text-gray-400 outline-none border-none
                                [appearance:textfield]
                                [&::-webkit-outer-spin-button]:appearance-none
                                [&::-webkit-inner-spin-button]:appearance-none" read-only>
                                <span @click="item++" class="bg-emerald-600 hover:bg-emerald-700 py-1 px-3 text-white rounded">+</span>
                            </div>
                            <span class="bg-violet-600 hover:bg-violet-700 text-white py-2 px-4 rounded cursor-pointer" wire:click="addToCart({{$item->id}})"><x-icon name="arrow-right" /></span>
                        </div>
                    @endif
                    
                </div>
                @endforeach
            </div>
            <div class="flex justify-between mt-6">
                <a href="{{ route('admin.manual')}}" class="bg-gray-600 text-white py-2 px-4 rounded">Kembali</a>
                <x-primary-button wire:loading.attr="disabled" wire:loading.class="opacity-25">
                    {{ __('Simpan') }}
                </x-primary-button>
            </div>
        @endif
        
    </form>
</div>
