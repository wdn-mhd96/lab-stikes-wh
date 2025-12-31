<div x-data="{open : $wire.entangle('openModal')}">
    <div class="flex justify-end">
        @if(count(session()->get("cart_".auth()->id()) ?? []))
        <button wire:click="ajukanPeminjaman" x-data="{cart:$wire.entangle('cart')}" class="relative 
            inline-flex items-center px-2 py-1  rounded text-gray-400 hover:text-gray-600 mb-6 ">
            <div>
                <x-icon name="clipboard-document-list" class="w-16 h-16 "></x-icon>
                <span class="text-wrap">Pengajuan</span>
            </div>
            <div class="absolute top-0 right-0 py-1 px-[9px] bg-violet-600 text-[0.7rem] rounded-full text-white">{{ count(session()->get("cart_". auth()->id()) ?? [])}}</div>
        </button>  
        @endif 
    </div>
    <div class="mt-3 relative mb-3">
        <input type="text" wire:model.live.debounce.500ms="search" placeholder="Cari Alat . . ." class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-violet-500" />
        <x-icon name="magnifying-glass" class="absolute right-3 top-2.5"/>
    </div>
    <div class="grid grid-cols-[repeat(auto-fit,minmax(300px,1fr))] gap-4">
        @foreach ($inventory as $item)
        <div class="relative {{ $item->quantity > 0 ? 'bg-white' : 'bg-red-100'  }} shadow rounded-lg p-6">
            @if(!empty($cart[$item->id]))
                <button wire:click="removeCart({{$item->id}})"><x-icon name="x-mark" class="w-8 h-8 absolute top-3 right-3 p-2 rounded text-white bg-red-600 hover:bg-red-700"/></button>
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
                    <p class="text-md mb-2">Status: {{ $item->quantity > 0 ? "Tersedia" : "Kosong"}}</p>
                </div>
            </div>
            <div class="flex justify-between items-center" x-data="{ item: $wire.entangle('quantity.{{$item->id}}').live}">
                <div>
                    <button @click="item > 1 ? item-- : 1" class="bg-emerald-600 hover:bg-emerald-700 py-1 px-3 text-white rounded">-</button>
                    <input type="number" x-model="item" class="w-[50px] focus:outline-none focus:border-none text-center text-gray-400 outline-none border-none
                    [appearance:textfield]
                    [&::-webkit-outer-spin-button]:appearance-none
                    [&::-webkit-inner-spin-button]:appearance-none" read-only>
                    <button @click="item++" class="bg-emerald-600 hover:bg-emerald-700 py-1 px-3 text-white rounded">+</button>
                </div>
                <button class="bg-violet-600 hover:bg-violet-700 text-white py-2 px-4 rounded" wire:click="addToCart({{$item->id}})"><x-icon name="arrow-right" /></button>
            </div>
            
        </div>
        @endforeach
    </div>
    <div class="mt-3">
        {{ $inventory->links()}}
    </div>
</div>
