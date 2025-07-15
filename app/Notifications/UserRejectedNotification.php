<?php

namespace App\Notifications;

use App\Models\Pendaftaran;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserRejectedNotification extends Notification
{
    use Queueable;

    protected $pendaftaran;

    /**
     * Create a new notification instance.
     */
    public function __construct(Pendaftaran $pendaftaran)
    {
        $this->pendaftaran = $pendaftaran;
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
                    ->subject('Informasi Pendaftaran Magang')
                    ->greeting("Halo {$notifiable->name},")
                    ->line('Terima kasih atas minat Anda untuk bergabung dengan perusahaan kami.')
                    ->line('Setelah melalui proses seleksi, kami mohon maaf untuk memberitahukan bahwa pendaftaran magang Anda belum dapat kami terima pada periode ini.')
                    ->line("Divisi: {$this->pendaftaran->divisi}")
                    ->line('Jangan berkecil hati, kami mendorong Anda untuk terus mengembangkan kemampuan dan mencoba mendaftar kembali di kesempatan yang akan datang.')
                    ->line('Terima kasih atas pengertian Anda.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'pendaftaran_id' => $this->pendaftaran->id,
            'status' => 'ditolak',
            'divisi' => $this->pendaftaran->divisi,
            'message' => 'Pendaftaran magang Anda belum dapat diterima'
        ];
    }
}