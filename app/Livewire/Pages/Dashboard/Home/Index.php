<?php

namespace App\Livewire\Pages\Dashboard\Home;

use Livewire\Component;
use Livewire\Attributes\Layout;

class Index extends Component
{
    public $check;
    #[Layout('layouts.dashboard')]

    public function mount()
    {
        
    }
    public function render()
    {
        return view('livewire.pages.dashboard.home.index');
    }

    public function checkPermission($permission)
    {
        if(auth()->user()->can($permission)){
            $this->check = true;
        }
        else{
            $this->check = false;
        }
    }
}
