<section class="space-y-4 min-h-screen  pt-24 p-0 md:p-8" id="ruang">
        <h1 class="my-3 font-bold text-violet-700 text-xl md:text-4xl uppercase bg-violet-400/40 p-3 rounded">Ruangan Lab</h1>
        <div 
        x-data="horizontalScroll()"
        class="relative no-scrollbar mt-3"
    >
        {{-- Left Arrow --}}
        <button
            x-show="canScrollLeft"
            @click="scrollLeft"
            class="absolute left-0 top-1/2 -translate-y-1/2 z-10
                bg-white shadow rounded-full p-2"
        >
            <x-icon name="arrow-left" />
        </button>

        {{-- Scroll Container --}}
        <div
            x-ref="container"
            @scroll="checkScroll"
            class="flex gap-2 overflow-x-auto scroll-smooth no-scrollbar px-10"
        >
            <div class="flex flex-nowrap gap-2">
                @foreach($ruangan as $ruang)
                <div class="p-2 rounded w-[250px] h-[300px] rounded shadow flex flex-col gap-2 items-center">
                    <div class="w-[70%] h-[70%] mx-auto bg-gray-200 flex justify-center items-center rounded-md">
                        <x-icon name="photo" class="text-gray-400 w-12 h-12"></x-icon>
                    </div>
                    <span class="text-violet-700 text-center font-semibold">{{ $ruang->nama_ruangan}}</span>
                    <span class="text-violet-700 text-center font-semibold text-xl">{{ $ruang->kode_ruangan}}</span>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Right Arrow --}}
        <button
            x-show="canScrollRight"
            @click="scrollRight"
            class="absolute right-0 top-1/2 -translate-y-1/2 z-10
                bg-white shadow rounded-full p-2"
        >
            <x-icon name="arrow-right" />
        </button>
    </div>

    <script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('horizontalScroll', () => ({
            canScrollLeft: false,
            canScrollRight: false,

            init() {
                this.checkScroll()
            },

            checkScroll() {
                const el = this.$refs.container
                this.canScrollLeft = el.scrollLeft > 0
                this.canScrollRight =
                    el.scrollLeft + el.clientWidth < el.scrollWidth - 1
            },

            scrollLeft() {
                this.$refs.container.scrollBy({ left: -200, behavior: 'smooth' })
            },

            scrollRight() {
                this.$refs.container.scrollBy({ left: 200, behavior: 'smooth' })
            },
        }))
    })
    </script>


</section>

