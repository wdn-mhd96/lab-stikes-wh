<?php

namespace App\Livewire\Pages\Dashboard\Users;

use Livewire\Component;
use Livewire\Attributes\On;


class Form extends Component
{
    public $userid;
    public $name;
    public $username;
    public $password;

    public $admin = false;
    #[On('open-user-form')]
    public function openForm($data)
    {
        $this->userid = $data['userid'] ?? null;
        $this->name = $data['name'] ?? '';
        $this->username = $data['username'] ?? '';
        $this->password = '';
        $this->admin = $data['admin'] ?? false; 
    }
    public function render()
    {
        return view('livewire.pages.dashboard.users.form');
    }

    public function save()
    {   $validationRules = [
        'name' => 'required|string|max:255',
        'username' => 'required|string|max:255',
    ];
    if(!$this->userid){
        $validationRules['password'] = 'required|string|min:6';
        $validationRules['username'] .= '|unique:users,username';
    }
    $this->validate($validationRules);

    if($this->userid){
        $user = \App\Models\User::find($this->userid);
        if(!$user){
            $this->dispatch('notify', ['title' => 'error', 'text' => 'User tidak ditemukan.', 'icon' => 'error']);
            return;
        }
        $data = [
            'name' => $this->name,
            'username' => $this->username,
        ];
        if($this->password){
            $data['password'] = bcrypt($this->password);
        }
        try {
            $user->update($data);
        } catch (\Exception $e) {
            $this->dispatch('notify', ['title' => 'error', 'text' => 'Gagal Mengupdate User', 'icon' => 'error']);
            return;
        }
    }
    else {
        
        try {
            $user = \App\Models\User::create([
                'name' => $this->name,
                'username' => $this->username,
                'password' => bcrypt($this->password),
                'role' => $this->admin ? 'admin' : 'user',
            ]);

            $this->admin ? $user->assignRole('admin') : $user->assignRole('user');
            
        } catch (\Exception $e) {
            $this->dispatch('notify', ['title' => 'error', 'text' => 'Username sudah digunakan.', 'icon' => 'error']);
            return;
        }
    }

        $this->reset();
        $this->dispatch('notify', ['title' => 'success', 'text' => 'User berhasil disimpan.', 'icon' => 'success']);
    }
}
