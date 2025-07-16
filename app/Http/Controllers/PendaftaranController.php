<?php

namespace App\Http\Controllers;

use App\Http\Requests\PendaftarRequest;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Auth;

class PendaftaranController extends Controller
{
    public function create()
    {
        return view('pendaftaran.form');
    }
    public function store(PendaftarRequest $request)
    {

        try {
            $validatedData = $request->validated();

            // handle file uploads
            $foto = $request->file('foto')->store('pendaftaran/foto', 'public');
            $cv = $request->file('cv')->store('pendaftaran/cv', 'public');
            $portofolio = $request->hasFile('portofolio')
                ? $request->file('portofolio')->store('pendaftaran/portofolio', 'public')
                : null;

            //   create a new Pendaftaran record
            $pendaftaran =  Pendaftaran::create([
                'user_id' => Auth::id(),
                'nama' => $request->nama,
                'email' => $request->email, // ✅ Simpan email
                'jenis_kelamin' => $request->jenis_kelamin,
                'instansi' => $request->instansi,
                'durasi_magang' => $request->durasi_magang,
                'divisi' => $request->divisi,
                'foto' => $foto,
                'cv' => $cv,
                'portofolio' => $portofolio,
            ]);
            return view('pendaftaran.success')->with('pendaftaran', $pendaftaran);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()]);
        }
    }
}