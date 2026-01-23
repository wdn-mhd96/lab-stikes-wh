<?php

namespace App\Livewire\Layout;

use Livewire\Component;

class Tomselect extends Component
{
    public string $model;
    public array $options = [];
    public string $valueField = 'id';
    public string $labelField = 'name';
    public string $classes = 'w-full';

    public function mount(
        string $model,
        array $options,
        string $valueField = 'id',
        string $labelField = 'name'
    ) {
        $this->model = $model;
        $this->options = $options;
        $this->valueField = $valueField;
        $this->labelField = $labelField;
    }

    public function render()
    {
        return view('livewire.layout.tomselect');
    }
}
