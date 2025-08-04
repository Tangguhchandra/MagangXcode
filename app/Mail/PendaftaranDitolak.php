<?php

namespace App\Mail;

use App\Models\Pendaftaran;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PendaftaranDitolak extends Mailable
{
    use Queueable, SerializesModels;

    public $pendaftar;

    /**
     * Create a new message instance.
     */
    public function __construct(Pendaftaran $pendaftar)
    {
        $this->pendaftar = $pendaftar;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Pemberitahuan Pendaftaran Magang')
            ->view('emails.pendaftaran_ditolak');
    }
}
