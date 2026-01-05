<?php

namespace App\Livewire\Pages\Dashboard\Userpeminjaman;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
class Detail extends Component
{
    #[Url]
    public $id;

    #[Layout('layouts.dashboard')]
    public function render()
    {
         $peminjaman = \App\Models\PeminjamanAlatHeader::with(['status','details.alat','user','ruangan','history.oldStatus', 'history.newStatus', 'history.user'])
                ->where("user_id", auth()->id())
                ->where('id', $this->id)->first();
        return view('livewire.pages.dashboard.userpeminjaman.detail', [
            "peminjaman" => $peminjaman
        ]);
    }
}
