<?php

namespace App\Livewire\Pages\Main;

use Livewire\Component;
use Livewire\Attributes\On;

class Detailpeminjaman extends Component
{
    public $date;
    public $openForm = false;
    #[On('open-peminjaman')]
    public function populateDate($data)
    {
        $this->date = $data;
        $this->openForm = true;
    }
    public function render()
    {
        return view('livewire.pages.main.detailpeminjaman',[
            "peminjamans" => \App\Models\PeminjamanAlatHeader::with(["user", "status", "ruangan"])->where("tanggal_pinjam", $this->date)->get()
        ]);
    }
}
