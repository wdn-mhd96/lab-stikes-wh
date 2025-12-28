<?php

namespace App\Livewire\Pages\Dashboard\Inventory;

use Livewire\Component;
use App\Imports\InventoryImport;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\WithFileUploads;

class Import extends Component
{
    use WithFileUploads;
    public $file_import;
    public function render()
    {
        return view('livewire.pages.dashboard.inventory.import');
    }
    
    public function import()
    {
        $this->validate([
            'file_import' => 'required|mimes:xlsx',
        ]);
        $import = new InventoryImport;
        try {
            Excel::import($import, $this->file_import->getRealPath());
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            $errorMessages = [];
            foreach ($failures as $failure) {
                $errorMessages[] = 'Row ' . $failure->row() . ': ' . implode(', ', $failure->errors());
            }
            $this->dispatch('notify',['title' => 'Import Failed', 'text' => implode(' | ', $errorMessages), 'icon' => 'error']);
            return;
        }
        if ($import->duplicates > 0) {
            $message = $import->imported . ' records imported successfully. ' . $import->duplicates . ' duplicate records were skipped.';
        } else {
            $message = $import->imported . ' records imported successfully.';
        }
        $this->dispatch('notify',['title' => 'Import Successful', 'text' => $message, 'icon' => 'success']);
        $this->dispatch('close-import', []);
        
    }   
}
