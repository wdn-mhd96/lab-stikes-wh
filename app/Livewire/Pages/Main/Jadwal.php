<?php

namespace App\Livewire\Pages\Main;

use Livewire\Component;
use Carbon\Carbon;

class Jadwal extends Component
{
    public $currentMonth;
    public $currentYear;

    public function mount()
    {
        $now = Carbon::now();
        $this->currentMonth = $now->month;
        $this->currentYear = $now->year;
    }

    public function previousMonth()
    {
        $date = Carbon::create($this->currentYear, $this->currentMonth, 1)->subMonth();
        $this->currentMonth = $date->month;
        $this->currentYear = $date->year;
    }

    public function nextMonth()
    {
        $date = Carbon::create($this->currentYear, $this->currentMonth, 1)->addMonth();
        $this->currentMonth = $date->month;
        $this->currentYear = $date->year;
    }

    /**
     * Get peminjaman grouped by date
     */
    public function getPeminjamanByDate()
    {
        return \App\Models\PeminjamanAlatHeader::whereMonth('tanggal_pinjam', $this->currentMonth)
            ->whereYear('tanggal_pinjam', $this->currentYear)
            ->get()
            ->groupBy(fn ($item) => Carbon::parse($item->tanggal_pinjam)->format('Y-m-d'));
    }

    public function render()
    {
        $date = Carbon::create($this->currentYear, $this->currentMonth, 1);

        return view('livewire.pages.main.jadwal', [
            'monthName'   => $date->translatedFormat('F'),
            'daysInMonth' => $date->daysInMonth,
            'startDay'    => $date->dayOfWeekIso,
            'peminjamans' => $this->getPeminjamanByDate(),
        ]);
    }
    
}
