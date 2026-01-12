<nav x-data="{toggled:false}" class="-mx-3 flex flex-1 justify-between gap-10 fixed top-0 left-0 right-0  backdrop-blur-md border-b border-gray-200 px-6 py-4 z-40">
    <button @click="toggled = !toggled" class="md:hidden flex flex-col gap-1.5 justify-center items-center">
        <span :class="toggled ? 'rotate-45 translate-y-2 w-6' : 'w-4'" class="h-0.5 bg-gray-600 transition-all duration-300 ease-in-out"></span>
        <span :class="toggled ? 'opacity-0' : 'w-4'" class="h-0.5 bg-gray-600 transition-all duration-300 ease-in-out"></span>
        <span :class="toggled ? '-rotate-45 -translate-y-2 w-6' : 'w-4'" class="h-0.5 bg-gray-600 transition-all duration-300 ease-in-out"></span>
    </button>
    <h3 class="font-bold text-violet-600 text-[1rem] md:text-[1.5rem]">{{ config('app.name', 'Lab Terpadu WH') }}</h3>
<div class="flex items-center gap-6">
    <ul x-data="{ active: 'home' }" class="flex flex-col md:flex-row items-center gap-6 text-gray-500
        fixed md:static bg-white md:bg-transparent top-16 left-0 h-screen md:h-auto w-full md:w-auto px-6 py-4 md:p-0"
        :class="toggled ? 'flex' : 'hidden md:flex'">
        <li>
            <a href="#home"
            @click="active = 'home'; toggled = false"
            :class="active === 'home'
                ? 'text-gray-900 font-semibold'
                : 'hover:text-gray-700'">
            Beranda
            </a>
        </li>

        <li>
            <a href="#jadwal"
            @click="active = 'jadwal'; toggled = false"
            :class="active === 'jadwal'
                ? 'text-gray-900 font-semibold'
                : 'hover:text-gray-700'">
            Jadwal
            </a>
        </li>

        <li>
            <a href="#alat"
            @click="active = 'alat'; toggled = false"
            :class="active === 'alat'
                ? 'text-gray-900 font-semibold'
                : 'hover:text-gray-700'">
            Inventory
            </a>
        </li>

        <li>
            <a href="#ruang"
            @click="active = 'ruang'; toggled = false"
            :class="active === 'ruang'
                ? 'text-gray-900 font-semibold'
                : 'hover:text-gray-700'">
            Ruangan
            </a>
        </li>
        <li>
            <a href="#alur"
            @click="active = 'alur'; toggled = false"
            :class="active === 'alur'
                ? 'text-gray-900 font-semibold'
                : 'hover:text-gray-700'">
            Alur Proses
            </a>
        </li>
    </ul>
        <div class="hidden md:block">
            @auth
                <a
                    href="{{ url('/dashboard') }}"
                    class="bg-violet-600 text-white rounded-md px-6 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                >
                    Dashboard
                </a>
            @else
                <a
                    href="{{ route('login') }}"
                    class="bg-violet-600 text-white rounded-md px-6 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                >
                    Log in
                </a>

                @if (Route::has('register'))
                    <a
                        href="{{ route('register') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                    >
                        Register
                    </a>
                @endif
            @endauth
        </div>
    </div>
</nav>
