<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MailMassage extends Notification
{
    use Queueable;

    protected $pendaftar;

    /**
     * Create a new notification instance.
     */
    public function __construct($pendaftar)
    {
        $this->pendaftar = $pendaftar;
    }


    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Selamat! Pendaftaran Anda Diterima')
                    ->greeting('Halo ' . $this->pendaftar->nama)
                    ->line('Selamat! Pendaftaran magang Anda telah diterima.')
                    ->line('Silakan hubungi kami untuk informasi lebih lanjut.')
                    ->action('Login ke Dashboard', url('/dashboard'))
                    ->line('Link daftar logbook: https://magang.xcode.co.id/')
                    ->line('Terima kasih telah mendaftar!');
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
}