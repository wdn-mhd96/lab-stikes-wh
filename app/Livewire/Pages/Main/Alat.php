<?php

namespace App\Livewire\Pages\Main;

use Livewire\Component;

class Alat extends Component
{
    public function render()
    {
        $inventory = \App\Models\Inventory::orderBy("item_name", "ASC")->limit(20)->get();
        return view('livewire.pages.main.alat', [
            "inventory" => $inventory
        ]);
    }
}
