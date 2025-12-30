<?php

namespace App\Livewire\Pages\Dashboard\Userpeminjaman;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class Index extends Component
{
    use WithPagination;
    use WithoutUrlPagination;
    #[Layout('layouts.dashboard')]

    public $quantity = [];

    public function mount()
    {
        
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        return view('livewire.pages.dashboard.userpeminjaman.index',
        [
            'inventory' => \App\Models\Inventory::orderBy('item_name', 'ASC')->paginate(10),
        ]);
    }
}
