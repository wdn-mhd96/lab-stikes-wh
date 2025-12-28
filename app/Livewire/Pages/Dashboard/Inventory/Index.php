<?php

namespace App\Livewire\Pages\Dashboard\Inventory;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Livewire\Attributes\On;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $formOpen = false;
    public $importOpen = false;
    public $search = '';
    public $disposableFilter = 'all';
    #[Layout('layouts.dashboard')]


    
    #[On('notify')]
    public function refreshList($notify)
    {
        
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function render()
    {
        return view('livewire.pages.dashboard.inventory.index', [
            'inventories' => \App\Models\Inventory::where(function($query){
                if($this->disposableFilter !== 'all'){
                    $query->where('disposable', $this->disposableFilter);
                }
                if($this->search){
                    $query->where(function($q){
                        $q->where('item_code', 'like', '%'.$this->search.'%')
                          ->orWhere('item_name', 'like', '%'.$this->search.'%');
                    });
                }
            })->orderBy('created_at', 'desc')->paginate(10),
        ]);
    }
    public function openAdd()
    {
        $this->dispatch('open-form', []);
        $this->formOpen = true;
    }

    public function openImport()
    {
        $this->dispatch('open-import', []);
        $this->importOpen = true;
    }
    public function confirmDelete($inventoryId)
    {
        $this->dispatch('confirm-delete', [
            'title' => 'Are you sure?',
            'text' => 'Hapus data inventory ini?',
            'icon' => 'warning',
            'id' => $inventoryId,
            'event' => 'delete-inventory',
        ]);
    }
    #[On('delete-inventory')]
    public function deleteInventory($id){
        \App\Models\Inventory::destroy($id);
        $this->dispatch('notify', ['title' => 'success', 'text' => 'Inventory berhasil dihapus.', 'icon' => 'success']);
    }

    public function editInventory($inventoryId)
    {
        $inventory = \App\Models\Inventory::find($inventoryId);
        $this->dispatch('open-form', [
            'inventoryid' => $inventory->id,
            'code' => $inventory->item_code,
            'name' => $inventory->item_name,
            'qty' => $inventory->quantity,
            'disposable' => $inventory->disposable,
        ]);
        $this->formOpen = true;
    }
}
