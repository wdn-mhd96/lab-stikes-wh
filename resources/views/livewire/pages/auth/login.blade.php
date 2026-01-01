<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <!-- Session Status -->
    <div class="flex justify-between items-center flex-col md:flex-row gap-6">
        <div class="w-full md:w-[60%]">
            <img src="{{asset('assets/images/static/hero-banner.jpg')}}" alt="" class="hidden md:block">
        </div>
        <div class="w-full md:w-[40%] p-4">
            <div class="mb-8 text-gray-500">
                <span class="block text-center font-bold text-lg mb-3">E-LAB TERPADU</span>
                <span class="block text-center font-bold text-md mb-3">STIKES WIJAYA HUSADA</span>
            </div>
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <a href="/" wire:navigate class="flex justify-center mb-6">
                <img src="{{ asset('assets/images/static/logo-stikes.svg')}}" alt="" class="w-32 h-32"/>
            </a>
            <form wire:submit="login">
                <!-- Email Address -->
                <div>
                    <x-input-label for="username" :value="__('Username')" />
                    <x-text-input wire:model="form.username" id="username" class="block mt-1 w-full" type="text" name="username" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('form.username')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />

                    <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember" class="inline-flex items-center">
                        <input wire:model="form.remember" id="remember" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-between mt-4">
                    {{-- @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}" wire:navigate>
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif --}}
                    <a href="/" class="text-gray-400 hover:text-gray-700 flex justify-center gap-1"><x-icon name="arrow-left" /> <span>Kembali</span></a>
                    <x-primary-button class="ms-3" wire:loading.attr="disabled" wire:loading.class="opacity-25">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</div>
