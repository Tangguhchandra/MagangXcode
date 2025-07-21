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

            $user = Auth::user();
            if (!$user->email_verified_at) {
                return redirect()->back()->withErrors(['email' => 'Email Anda belum diverifikasi. Silakan periksa email Anda untuk verifikasi.']);
            }

            $validatedData = $request->validated();
            // handle file uploads
            $foto = $request->file('foto')->store('pendaftaran/foto', 'public');
            $cv = $request->file('cv')->store('pendaftaran/cv', 'public');
            $portofolio = $request->hasFile('portofolio')
                ? $request->file('portofolio')->store('pendaftaran/portofolio', 'public')
                : null;

            $pendaftaran = Pendaftaran::create(attributes: array_merge(array: $validatedData, arrays: [
                'user_id' => Auth::id(),
                'foto' => $foto,
                'cv' => $cv,
                'portofolio' => $portofolio,
            ]));
            return view('pendaftaran.success')->with('pendaftaran', value: $pendaftaran);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()]);
        }
    }
}