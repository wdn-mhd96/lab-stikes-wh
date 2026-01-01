<?php

namespace App\Livewire\Layout;

use Livewire\Component;

class Navbar extends Component
{
    public function render()
    {
        return view('livewire.layout.navbar');
    }

    public function viewNotification($notificationId)
    {
        $notification = auth()->user()->notifications()->where('id', $notificationId)->first();

        if ($notification) {
            $notification->markAsRead();
            $peminjamanId = $notification->data['data']['id'] ?? null;

            if ($peminjamanId) {
                return redirect()->route('admin.detail', ['id' => $peminjamanId]);
            }
        }

        return redirect()->back();
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }
}
