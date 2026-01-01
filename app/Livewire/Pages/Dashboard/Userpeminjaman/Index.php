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
    public $cart = [];
    public $openModal = false;
    public $search = '';

    public function mount()
    {
        $this->cart = session()->get("cart_". auth()->id());
        $inventory = \App\Models\Inventory::all();
        foreach($inventory as $item) {
            $this->quantity[$item->id] = $this->cart[$item->id] ?? 0; 
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        // dd(session()->get('cart_' . auth()->id()));
        return view('livewire.pages.dashboard.userpeminjaman.index',
        [
            'inventory' => \App\Models\Inventory::where('item_code', 'like', '%'.$this->search.'%')
                          ->orWhere('item_name', 'like', '%'.$this->search.'%')
                            ->orderBy('item_name', 'ASC')->paginate(8),
        ]);
    }

    public function addToCart($id)
    {
        $key = 'cart_' . auth()->id();

       $cart = session()->get($key) ?? [];
       $cart[$id] = $this->quantity[$id];
       $this->cart = $cart;
       session()->put($key, $this->cart);
       $this->dispatch("notify", ['title' => 'success', 'text' => 'Item Telah Dimasukkan ke List Peminjaman', 'icon' => 'success']);
    }

    public function removeCart($id)
    {
        $key = 'cart_' . auth()->id();

        $cart = $this->cart;
        unset($cart[$id]);

        // 🔥 force reactivity
        $this->cart = $cart;

        session()->put($key, $this->cart);

        $this->dispatch("notify", [
            'title' => 'success',
            'text' => 'Item Telah Dihapus dari List Peminjaman',
            'icon' => 'success'
        ]);
    }

    public function ajukanPeminjaman() 
    {
        return redirect('/dashboard/ajukan-peminjaman');
    }

    public function kosongkanList()
    {
        $key = 'cart_' . auth()->id();
        session()->forget($key);
        $this->cart = [];
        $this->dispatch("notify", ['title' => 'success', 'text' => 'List Peminjaman Telah Dikosongkan', 'icon' => 'success']); 
    }

}
