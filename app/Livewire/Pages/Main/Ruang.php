<?php

namespace App\Livewire\Pages\Main;

use Livewire\Component;

class Ruang extends Component
{
    public function render()
    {
        return view('livewire.pages.main.ruang', [
            "ruangan" => \App\Models\Ruangan::orderBy("nama_ruangan", "ASC")->get()
        ]);
    }
}
