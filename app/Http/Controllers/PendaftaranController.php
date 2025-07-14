<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendaftaranController extends Controller
{
    public function create()
    {
        return view('pendaftaran.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email|regex:/@gmail\.com$/i',
            'jenis_kelamin' => 'required',
            'instansi' => 'required',
            'divisi' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'cv' => 'required|mimes:pdf|max:2048',
            'portofolio' => 'nullable|mimes:pdf,docx,pptx|max:4096',
        ]);

        $foto = $request->file('foto')->store('pendaftaran/foto', 'public');
        $cv = $request->file('cv')->store('pendaftaran/cv', 'public');
        $portofolio = $request->hasFile('portofolio')
            ? $request->file('portofolio')->store('pendaftaran/portofolio', 'public')
            : null;

        Pendaftaran::create([
            'user_id' => Auth::id(),
            'nama' => $request->nama,
            'email' => $request->email, // ✅ Simpan email
            'jenis_kelamin' => $request->jenis_kelamin,
            'instansi' => $request->instansi,
            'divisi' => $request->divisi,
            'foto' => $foto,
            'cv' => $cv,
            'portofolio' => $portofolio,
        ]);
        return view('pendaftaran.success');

    }

  
}