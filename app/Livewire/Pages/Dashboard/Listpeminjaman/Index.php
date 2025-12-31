<?php

namespace App\Livewire\Pages\Dashboard\Listpeminjaman;

use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;
    #[Layout("layouts.dashboard")]
    public $status = [];
    public function render()
    {
        $query = \App\Models\PeminjamanAlatHeader::with(["user", "status"])
        ->when($this->status, fn($q) => $q->whereIn("status_id", $this->status))
        ->withCount("details")
        ->orderBy("tanggal_pinjam", "DESC")->paginate(10);
        return view('livewire.pages.dashboard.listpeminjaman.index',
        [
            "peminjaman" => $query
        ]);
    }
}
