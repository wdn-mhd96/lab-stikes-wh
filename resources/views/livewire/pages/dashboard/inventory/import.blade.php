<div class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center z-50 backdrop-blur-md"
    x-show="openImport"
    x-cloak
    x-transition
    x-trap.noscroll="openImport"
    @keydown.escape.window="openImport = false">    
    <x-card>
        <div class="w-full" @click.outside="openImport = false">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold text-gray-700">Tambah Inventory</h2>
                <button @click="openImport = false" class="text-gray-500 hover:text-gray-700"><x-icon name="x-mark"></x-icon></button>
            </div>
            <form wire:submit.prevent="import" enctype="multipart/form-data">
                 
                <div class="mb-4">
                    <x-input-label for="file_import" :value="__('Import File')" />
                    <x-text-input wire:model="file_import" id="file_import" class="block mt-1 w-full" type="file" name="file_import" accept=".xlsx"/>
                    <x-input-error :messages="$errors->get('file_import')" class="mt-2" />
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
