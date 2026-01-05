<?php

namespace App\Livewire\Pages\Dashboard\Inventory;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;

class StockAdd extends Component
{
    public $id;

    public int $qty;

    #[On('open-stock')]
    public function openStock($data)
    {
        $this->id = $data["id"];
    }
    public function render()
    {
        return view('livewire.pages.dashboard.inventory.stock-add');
    }

    public function addInventoryStock()
    {
        $rules = [
            "qty" => "min:0|required|numeric"
        ];
        $this->validate($rules);

        try {
            DB::transaction(function() {
            $check = \App\Models\Inventory::lockForUpdate()->findOrFail($this->id);
            if(!$check) {
                throw new \Exception("Data Tidak Ditemukan");
            }
            $before = $check->quantity;
            $check->increment("quantity", $this->qty);
            $check->increment("quantity_available", $this->qty);
            $this->reset();
             $this->dispatch('notify', [
            'title' => 'Berhasil',
            'text'  => 'Berhasil Menambah Stock',
            'icon'  => 'success'
        ]);
        });
        }
        catch (\Exception $e) {
             $this->dispatch('notify', [
                'title' => 'Gagal',
                'text'  => 'Gagal Memproses Data: '.$e->getMessage(),
                'icon'  => 'error'
            ]);
        }
    }
}
