<?php

namespace App\Livewire\Pages\Dashboard\Home;

use Livewire\Component;
use Livewire\Attributes\Layout;

class Index extends Component
{
    public $totalPeminjaman;
    public $peminjamanDiajukan;
    public $peminjamanHariIni;
    public $peminjamanSelesai;
    public $peminjamanDitolak;
    public $Inventory;
    public $oos;

    public $totalPeminjamanUser;
    public $peminjamanAktifUser;
    public $peminjamanSelesaiUser;
    public $peminjamanDitolakUser;

    #[Layout('layouts.dashboard')]

    public function mount()
    {
        $this->totalPeminjaman = \App\Models\PeminjamanAlatHeader::count();
        $this->peminjamanHariIni = \App\Models\PeminjamanAlatHeader::where("tanggal_pinjam", now()->format("Y-m-d"))->count();
        $this->peminjamanSelesai = \App\Models\PeminjamanAlatHeader::where("status_id", 4)->count();
        $this->peminjamanDitolak = \App\Models\PeminjamanAlatHeader::where("status_id", 3)->count();
        $this->peminjamanDiajukan = \App\Models\PeminjamanAlatHeader::where("status_id", 1)->count();
        $this->peminjamanHariIni = \App\Models\PeminjamanAlatHeader::where("tanggal_pinjam", now()->format("Y-m-d"))->count();

        $this->totalPeminjamanUser= \App\Models\PeminjamanAlatHeader::where('user_id', auth()->id())->count();
        $this->peminjamanAktifUser= \App\Models\PeminjamanAlatHeader::whereIn('status_id',[1,2])->where('user_id', auth()->id())->count();
        $this->peminjamanSelesaiUser= \App\Models\PeminjamanAlatHeader::where('status_id',4)->where('user_id', auth()->id())->count();
        $this->peminjamanDitolakUser= \App\Models\PeminjamanAlatHeader::where('status_id',3)->where('user_id', auth()->id())->count();

        $this->Inventory = \App\Models\Inventory::count();
        $this->oos = \App\Models\Inventory::where("quantity", "<", 1)->count();
    }
    public function render()
    {
        return view('livewire.pages.dashboard.home.index');
    }

    public function checkPermission($permission)
    {
        if(auth()->user()->can($permission)){
            $this->check = true;
        }
        else{
            $this->check = false;
        }
    }
}
