<?php

namespace App\Livewire\Pages\Dashboard\Userpeminjaman;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class History extends Component
{
    #[Layout('layouts.dashboard')]
    public $status = [];

    public function render()
    {
            $query = \App\Models\PeminjamanAlatHeader::with(["user", "status"])
        ->when($this->status, fn($q) => $q->whereIn("status_id", $this->status))
        ->where("user_id", auth()->id())
        ->withCount("details")
        ->orderBy("tanggal_pinjam", "DESC")->paginate(10);
        return view('livewire.pages.dashboard.userpeminjaman.history', 
    [
        "peminjaman" => $query
    ]);
    }
}
