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
            
        </div>
        @endforeach
    </div>
</div>
