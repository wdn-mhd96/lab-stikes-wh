<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotifPengajuan extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */

    public $pengajuanData = [];
    public $message;
    public $route;
    public function __construct($data, $message = "Pengajuan Peminjaman Baru", $route = "admin.detail")
    {
        $this->pengajuanData = $data;
        $this->message = $message;
        $this->route = $route;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'message' => $this->message,
            'data' => $this->pengajuanData,
            'route' => $this->route
        ];
    }
}
