<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

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
        <x-dropdown>
            <x-slot name="trigger">
                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                    <x-icon name="bell"></x-icon>
                </button>
            </x-slot>

            <x-slot name="content">
                <div  class="w-60 p-4">
                    <p>No New Notification</p>
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
