<?php

namespace App\Livewire\Pages\Dashboard\Inventory;

use Illuminate\Database\QueryException;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;


class Form extends Component
{
    use WithFileUploads;

    public $inventoryid;
    public $code;
    public $name;
    public $disposable = false;
    public $image;


    #[On('open-form')]
    public function openForm($data)
    {
        $this->inventoryid = $data['inventoryid'] ?? null;
        $this->code = $data['code'] ?? '';
        $this->name = $data['name'] ?? '';
        $this->disposable = $data['disposable'] ?? false;
        $this->image = null;
    }
    public function render()
    {
        return view('livewire.pages.dashboard.inventory.form');
    }

    public function save()
    {
        $validationRules = [
            'code' => ['required',
                        'string',
                        'max:255',\Illuminate\Validation\Rule::unique('inventories', 'item_code')->ignore($this->inventoryid)
                    ],
            'name' => 'required|string|max:255',
            'disposable' => 'boolean',
            'image' => 'nullable|image|max:2048',
        ];


        $this->validate($validationRules);

        $data = [
            'item_code' => $this->code,
            'item_name' => $this->name,
            'disposable' => $this->disposable,
        ];

        if ($this->image) {
            $imagePath = $this->image->store('inventory_images', 'public');
            $data['image'] = $imagePath;
        }

        if ($this->inventoryid) {
            $inventory = \App\Models\Inventory::findOrFail($this->inventoryid);

            $oldImage = $inventory->image;
            $inventory->update($data);
            if ($this->image && $oldImage) {
                \Storage::disk('public')->delete($oldImage);
            }

            try {
            } catch (\Exception $e) {
                $this->dispatch('notify', ['title' => 'error', 'text' => 'Gagal Mengupdate Inventory', 'icon' => 'error']);
                return;
            }
            catch(QueryException $e){
                if($e->getCode() === '23000'){
                    $this->dispatch('notify', ['title' => 'error', 'text' => 'Kode Item sudah ada.', 'icon' => 'error']);
                    return;
                }
            }
        } else {
            try {
                \App\Models\Inventory::create($data);
            } catch (\Exception $e) {
                $this->dispatch('notify', ['title' => 'error', 'text' => 'Gagal Menyimpan Inventory', 'icon' => 'error']);
                return; 
            }
            catch(QueryException $e){
                if($e->getCode() === '23000'){
                    $this->dispatch('notify', ['title' => 'error', 'text' => 'Kode Item sudah ada.', 'icon' => 'error']);
                    return;
                }
            }
        }
        $this->dispatch('notify', ['title' => 'success', 'text' => 'Inventory berhasil disimpan.', 'icon' => 'success']);
        $this->reset(["inventoryid", "code", "name", "disposable", "image"]);
    }    
}
