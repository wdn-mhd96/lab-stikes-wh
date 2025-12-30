<div>
    <div class="grid grid-cols-[repeat(auto-fit,minmax(300px,1fr))] gap-4">
        @foreach ($inventory as $item)
        <div class="{{ $item->quantity > 0 ? 'bg-white' : 'bg-red-100'  }} shadow rounded-lg p-6">
            @if($item->quantity == 0)
                <span>Stock Kosong</span>
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
                    <p class="text-md mb-2">Jumlah Tersedia: {{ $item->quantity }}</p>
                    <p class="text-md mb-4">Kondisi: {{ $item->condition }}</p>
                </div>
            </div>
            <div class="flex justify-between items-center">
                <div x-data="{ quantity: {{ $quantity[$item->id] ?? 1 }} }" class="flex items-center gap-2">
                    <button @click="quantity.{{ $item->id }} = Math.max(1, quantity.{{ $item->id }} - 1)">-</button>
                    <input type="number" id="quantity-{{ $item->id }}" min="1" max="{{ $item->quantity }}" wire:model="quantity.{{ $item->id }}" class="border border-gray-300 rounded-md p-2 w-24">
                    <button @click="quantity.{{ $item->id }} = Math.min({{ $item->quantity }}, quantity.{{ $item->id }} + 1)">+</button>
                </div>
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded {{ $item->quantity == 0 ? 'opacity-50 cursor-not-allowed' : '' }}" {{ $item->quantity == 0 ? 'disabled' : '' }}><x-icon name="arrow-right"></x-icon></button>
            </div>
        </div>
        @endforeach
    </div>
</div>
