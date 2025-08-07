<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Pendaftaran extends Model
{
    use HasFactory, SoftDeletes, Notifiable;

    // Kolom-kolom yang boleh diisi (mass assignable)
    protected $fillable = [
        'user_id',
        'nama',
        'email',
        'jenis_kelamin',
        'instansi',
        'divisi',
        'durasi_magang',
        'mulai_magang',
        'selesai_magang',
        'foto',
        'cv',
        'portofolio',
        'status',
    ];

    // (Opsional) Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
