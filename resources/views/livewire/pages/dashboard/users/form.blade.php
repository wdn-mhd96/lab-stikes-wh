<div class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center z-50 backdrop-blur-md"
    x-show="open"
    x-cloak
    x-transition
    x-trap.noscroll="open"
    @keydown.escape.window="open = false">    
    <x-card>
        <div class="w-full" @click.outside="open = false">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold text-gray-700">Tambah User</h2>
                <button @click="open = false" class="text-gray-500 hover:text-gray-700"><x-icon name="x-mark"></x-icon></button>
            </div>
            <form wire:submit.prevent="save">
                <div class="mb-4">
                    <x-input-label for="name" :value="__('Nama')" />
                    <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <x-input-label for="username" :value="__('Username')" />
                    <x-text-input wire:model="username" id="username" class="block mt-1 w-full" type="text" name="username" />
                    <x-input-error :messages="$errors->get('username')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <span class="text-sm text-gray-500">{{ $userid ?" ( Kosongkan jika tidak ingin mengubah password ) " : "" }}</span>
                    <x-text-input wire:model="password" id="password" class="block mt-1 w-full" type="password" name="password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div class="flex justify-end">
                    <x-primary-button type="submit" wire:loading.attr="disabled" wire:loading.class="opacity-25">
                        {{ __('Simpan') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </x-card>
</div class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center z-50 backdrop-blur-md">
