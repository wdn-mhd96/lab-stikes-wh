<section class="space-y-4 min-h-screen   pt-24" id="home">
    <div class="relative min-h-[50vh] md:min-h-screen flex items-center justify-center
    before:content-[''] before:absolute before:top-0 before:left-0 before:right-0 before:bottom-0 before:bg-[linear-gradient(225deg,rgba(255,255,255,0)_0%,rgba(255,255,255,1)_100%)] before:-z-10">
        {{-- Image --}}
        <div class="absolute top-0 left-0 right-0 bottom-0 hidden md:block bg-cover bg-center -z-50" style="background-image: url('{{ asset('assets/images/static/hero-banner.jpg')}}')"></div>
        <div class="hidden md:block md:w-1/2"></div>
        <div class="flex justify-center items-center md:items-end flex-col gap-3  px-6">
            <h1 class="text-xl md:text-4xl text-violet-600 text-nowrap text-center">
                Selamat Datang di
            </h1>
            <h1 class="text-2xl md:text-6xl font-bold text-violet-600 text-nowrap text-center">
                {{ config('app.name', 'Lab Terpadu WH') }}
            </h1>
            <div class="block md:hidden">
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
    </div>
</section>
