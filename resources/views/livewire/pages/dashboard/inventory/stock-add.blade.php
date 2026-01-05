<div class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center z-50 backdrop-blur-md"
    x-show="stockOpen"
    x-cloak
    x-transition
    x-trap.noscroll="stockOpen"
    @keydown.escape.window="stockOpen = false">    
    <x-card>
        <div class="w-full" @click.outside="stockOpen = false">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold text-gray-700">Tambah Stock Inventory</h2>
                <button @click="stockOpen = false" class="text-gray-500 hover:text-gray-700"><x-icon name="x-mark"></x-icon></button>
            </div>
            <form wire:submit.prevent="addInventoryStock">
                 
                <div class="mb-4">
                    <x-input-label for="qty" :value="__('Quantity (Masukkan Jumlah yang akan ditambahkan)')" />
                    <x-text-input wire:model="qty" min="0" id="qty" class="block mt-1 w-full" type="number" name="qty"/>
                    <x-input-error :messages="$errors->get('qty')" class="mt-2" />
                </div>
                <div class="flex justify-end">
                    <x-primary-button type="submit" wire:loading.attr="disabled" wire:loading.class="opacity-25">
                        {{ __('Simpan') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </x-card>
</div>
