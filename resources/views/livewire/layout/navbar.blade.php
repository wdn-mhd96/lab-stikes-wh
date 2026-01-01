

<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 flex justify-between items-center">
    <!-- Primary Navigation Menu -->
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <button @click="sidebarOpen = !sidebarOpen">
                        <x-icon name="ellipsis-vertical" />
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="flex items-center">
        <x-dropdown width="w-64" align="right">
            <x-slot name="trigger">
                <button class="relative inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                    <x-icon name="bell"></x-icon>
                    @if(auth()->user()->unreadNotifications->count() > 0)
                        <div class="absolute top-0 right-0 py-1 px-[10px] bg-red-600 text-[0.7rem] rounded-full text-white">{{ auth()->user()->unreadNotifications->count()}}</div>
                    @endif
                </button>
            </x-slot>

            <x-slot name="content">
                   <x-dropdown-link>
                        <span class="font-semibold">Notifikasi</span>
                    </x-dropdown-link>
                    <hr class="my-2">
                    @forelse (auth()->user()->unreadNotifications as $notification)
                        <x-dropdown-link>
                            <a wire:click.prevent="viewNotification({{ $notification->id }})" class="p-3 text-[0.7rem] text-gray-600">
                                    <span class="font-semibold">{{ $notification->data['message'] }}</span> - {{$notification->data['data']['code'] ?? ''}}
                            </a>
                        </x-dropdown-link>
                    @empty
                        <x-dropdown-link>
                            <div class="text-sm text-gray-600">
                                Tidak ada notifikasi baru.
                            </div>
                        </x-dropdown-link>
                    @endforelse
                    <hr class="my-2">
                    <div class="flex justify-center">
                        <a href="" class="text-sm text-violet-600 hover:underline p-2 text-center">Lihat Semua Notifikasi</a>
                   </div>
            </x-slot>
        </x-dropdown>
        <x-dropdown>
            <x-slot name="trigger">
                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                    {{ auth()->user()->name }}

                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                    </svg>
                </button>
            </x-slot>

            <x-slot name="content">
                <!-- Authentication -->


                    <x-dropdown-link>
                        <button wire:click="logout" class="w-full text-left">
                            {{ __('Log Out') }}
                        </button>
                    </x-dropdown-link>
            </x-slot>
        </x-dropdown>
    </div>
</nav>
