<section class="space-y-4 min-h-screen  pt-24 p-0 md:p-8" id="alat">
    <h1 class="my-3 font-bold text-violet-700 text-xl md:text-4xl uppercase  bg-violet-400/40 p-3 rounded">List Inventory</h1>
    <div class="grid grid-cols-[repeat(auto-fit,minmax(300px,1fr))] gap-4">
        @foreach ($inventory as $item)
        <div class="relative shadow rounded-lg p-6">
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
                    {{-- <p class="text-center text-md mb-2 font-bold text-white py-1 px-3 rounded {{ $item->quantity > 0 ? "bg-green-600" : "bg-red-600"}}">{{ $item->quantity > 0 ? "Tersedia" : "Kosong"}}</p> --}}
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
