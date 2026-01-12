<?php

namespace App\Livewire\Pages\Dashboard\Listpeminjaman;

use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Carbon\Carbon;


class Index extends Component
{
    use WithPagination, WithoutUrlPagination;
    #[Layout("layouts.dashboard")]
    public $status = [];
    public $search = '';
    public $date;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {

        $query = \App\Models\PeminjamanAlatHeader::with(['user', 'status'])
            ->withCount('details')

            ->when($this->status, fn ($q) =>
                $q->whereIn('status_id', $this->status)
            )

            ->when($this->search, function ($q) {
                $q->where(function ($qq) {
                    $qq->where('code', 'like', '%' . $this->search . '%')
                    ->orWhereHas('user', function ($u) {
                        $u->where('name', 'like', '%' . $this->search . '%');
                    });
                });
            })

            ->when($this->date, function ($q) {
                $q->whereBetween('tanggal_pinjam', [
                    Carbon::parse($this->date)->startOfDay(),
                    Carbon::parse($this->date)->endOfDay(),
                ]);
            })

            ->orderByDesc('tanggal_pinjam')
            ->paginate(10);

        return view('livewire.pages.dashboard.listpeminjaman.index',
        [
            "peminjaman" => $query
        ]);
    }
}
