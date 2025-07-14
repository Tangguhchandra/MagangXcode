<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Pendaftaran extends Model
{
    use HasFactory;

    // Kolom-kolom yang boleh diisi (mass assignable)
    protected $fillable = [
        'user_id',
        'nama',
        'email',
        'jenis_kelamin',
        'instansi',
        'divisi',
        'durasi_magang', // Tambahkan kolom durasi magang
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
