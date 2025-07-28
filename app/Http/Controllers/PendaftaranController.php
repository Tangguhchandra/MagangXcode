<?php

namespace App\Http\Controllers;

use App\Http\Requests\PendaftarRequest;
use App\Models\Pendaftaran;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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

            if (!User::where('email', $request->email)->exists()) {
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
                    'nama' => Auth::user()->name,
                    'email' => Auth::user()->email,
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

    // hapus data pendaftaran
    public function destroy($id)
    {
        try {
            $pendaftaran = Pendaftaran::findOrFail($id);

            // Ambil user yang terkait
            $user = $pendaftaran->user;

            // Hapus pendaftaran dulu
            $pendaftaran->delete();

            // Hapus user jika ada
            if ($user) {
                $user->delete(); // atau $user->forceDelete() jika pakai softDeletes
            }
            return redirect()->back()->with('success', 'Data pendaftar berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'Gagal menghapus data: ' . $e->getMessage()
            ]);
        }
    }
}