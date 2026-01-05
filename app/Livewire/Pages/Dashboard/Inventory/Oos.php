<?php

namespace App\Livewire\Pages\Dashboard\Inventory;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class Oos extends Component
{
    use WithPagination, WithoutUrlPagination;
    #[Layout('layouts.dashboard')]

    public $approvedQty = [];

    public function mount()
    {
        $inventory = \App\Models\Inventory::where("quantity", "<=", 0)
        ->get();

        foreach ($inventory as $detail) {
            $this->approvedQty[$detail->id] = 0;
        }
    }
    public function render()
    {
        return view('livewire.pages.dashboard.inventory.oos',[
            'inventories' => \App\Models\Inventory::where("quantity","<=", 0)->orderBy('created_at', 'desc')->paginate(10),
        ]);
    }
}
