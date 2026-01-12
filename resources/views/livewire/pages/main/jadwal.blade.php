<section class="space-y-4 min-h-screen pt-24  p-0 md:p-8" id="jadwal">
    <h1 class="my-3 font-bold text-violet-700 text-xl md:text-4xl uppercase bg-violet-400/40 p-3 rounded">Jadwal Peminjaman Alat</h1>
    <div class="w-full mx-auto bg-white shadow rounded-lg p-4">
    {{-- Header --}}
    <div class="flex items-center justify-between mb-4">
        <button wire:click="previousMonth" class="hover:bg-violet-400 p-4 text-xl font-bold text-violet-700 bg-gray-200 rounded">
            <x-icon name="arrow-left" />
        </button>

        <h2 class="font-semibold text-lg">
            {{ $monthName }} {{ $currentYear }}
        </h2>

        <button wire:click="nextMonth" class="hover:bg-violet-400 p-4 text-xl font-bold text-violet-700 bg-gray-200 rounded">
            <x-icon name="arrow-right" />
        </button>
    </div>

    {{-- Weekdays --}}
    <div class="grid grid-cols-7 text-center font-medium text-sm text-gray-600 bg-violet-700/30 p-3">
        <div>Mon</div><div>Tue</div><div>Wed</div>
        <div>Thu</div><div>Fri</div><div>Sat</div><div>Sun</div>
    </div>

    {{-- Days --}}
    <div class="grid grid-cols-7 mt-2 text-center text-sm">
        {{-- Empty --}}
        @for ($i = 1; $i < $startDay; $i++)
            <div></div>
        @endfor

        {{-- Dates --}}
        @for ($day = 1; $day <= $daysInMonth; $day++)
            @php
                $dateKey = sprintf('%04d-%02d-%02d', $currentYear, $currentMonth, $day);
                $hasPeminjaman = isset($peminjamans[$dateKey]);
            @endphp

            <div class="border p-2 min-h-[70px] relative hover:bg-violet-700/40">
                <div class="font-semibold">
                    {{ $day }}
                </div>
                {{-- Button if peminjaman exists --}}
                @if($hasPeminjaman)
                    <button
                        wire:click="$dispatch('open-peminjaman', '{{ $peminjamans[$dateKey]->first()->tanggal_pinjam}}')"
                        class="mt-1 w-full text-xs bg-violet-600 text-white rounded px-2 py-1 hover:bg-violet-700"
                    >
                        {{ count($peminjamans[$dateKey]) }}
                    </button>
                @endif
            </div>
        @endfor
    </div>
</div>

</section>
