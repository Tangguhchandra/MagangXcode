<?php

namespace App\Http\Controllers;

use App\Http\Requests\PendaftarRequest;
use App\Models\Pendaftaran;
use App\Models\User;
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
            if (!Auth::check()) {
                return redirect()->back()->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
            }

            if(!User::where('email', $request->email)->exists()) {
                return redirect()->back()->withErrors(['error' => 'Email tidak terdaftar.']);
            }

            $validatedData = $request->safe()->all();

            $foto = $request->file('foto')->store('pendaftaran/foto', 'public');
            $cv = $request->file('cv')->store('pendaftaran/cv', 'public');
            $portofolio = $request->hasFile('portofolio')
                ? $request->file('portofolio')->store('pendaftaran/portofolio', 'public')
                : null;

            $pendaftaran = Pendaftaran::create(array_merge(
                $validatedData,
                [
                    'user_id' => Auth::id(),
                    'foto' => $foto,
                    'cv' => $cv,
                    'portofolio' => $portofolio,
                ]
            ));
            return view('pendaftaran.success')->with('pendaftaran', $pendaftaran);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()
            ]);
        }
    }
}