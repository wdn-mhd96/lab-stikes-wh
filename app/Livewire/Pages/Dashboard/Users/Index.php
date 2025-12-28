<?php

namespace App\Livewire\Pages\Dashboard\Users;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Livewire\Attributes\On;
class Index extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $formOpen = false;
    #[Layout('layouts.dashboard')]

    #[On('notify')]
    public function refreshList($notify)
    {
        
    }

    public function render()
    {
        return view('livewire.pages.dashboard.users.index', 
        [
            'users' => \App\Models\User::where('role', 'user')->paginate(10),
        ]);
    }

    public function openAdd()
    {
        $this->dispatch('open-user-form', []);
        $this->formOpen = true;
    }
    public function confirmDelete($userId)
    {
        $this->dispatch('confirm-delete', [
            'title' => 'Are you sure?',
            'text' => 'Data Yang Dihapus Tidak Bisa Dikembalikan!',
            'icon' => 'warning',
            'id' => $userId,
            'event' => 'delete-user',
        ]);
    }


    #[On('delete-user')]
    public function deleteUser($id)
    {

        \App\Models\User::destroy($id);
        $this->dispatch('notify', ['title' => 'success', 'text' => 'User berhasil dihapus.', 'icon' => 'success']);
    }

    public function editUser($userId)
    {
        $user = \App\Models\User::find($userId);
        $this->dispatch('open-user-form', [
            'userid' => $user->id,
            'name' => $user->name,
            'username' => $user->username,
        ]);
        $this->formOpen = true;
    }
}
