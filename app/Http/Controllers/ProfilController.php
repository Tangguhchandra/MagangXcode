<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pendaftaran = Pendaftaran::where('user_id', $user->id)->get();

        // Calculate statistics
        $totalApplications = $pendaftaran->count();
        $acceptedApplications = $pendaftaran->where('status', 'diterima')->count();
        $pendingApplications = $pendaftaran->where('status', 'pending')->count();
        $rejectedApplications = $pendaftaran->where('status', 'ditolak')->count();

        // Determine registration status
        $registrationStatus = 'No Applications';
        if ($acceptedApplications > 0) {
            $registrationStatus = 'Accepted';
        } elseif ($pendingApplications > 0) {
            $registrationStatus = 'Under Review';
        } elseif ($rejectedApplications > 0 && $pendingApplications == 0 && $acceptedApplications == 0) {
            $registrationStatus = 'Needs Reapplication';
        }

        return view('profil.index', compact(
            'user',
            'pendaftaran',
            'totalApplications',
            'acceptedApplications',
            'pendingApplications',
            'rejectedApplications',
            'registrationStatus'
        ));
    }

    public function edit($id)
    {
        $user = Auth::user();
        if ($user->id != $id) {
            return redirect()->route('profil')->with('error', 'Unauthorized access.');
        }

        return view('profil.UpdateProfile', compact('user'));
    }


    public function update(Request  $request)
    {
        $user = Pendaftaran::where('user_id', Auth::id())->first();
        $authUser = Auth::user();

        // Validasi: semua optional agar bisa ubah satu field
        $request->validate([
            'nama' => 'nullable|string|max:255',
            'mulai_magang' => 'nullable|date',
            'selesai_magang' => 'nullable|date|after_or_equal:mulai_magang',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'portofolio' => 'nullable|mimes:pdf,docx,pptx|max:4096',
        ]);

        $data = [];

        // Cek jika ada perubahan per field
        if ($request->filled('nama')) {
            $data['nama'] = $request->nama;
        }

        if ($request->filled('mulai_magang')) {
            $data['mulai_magang'] = $request->mulai_magang;
        }

        if ($request->filled('selesai_magang')) {
            $data['selesai_magang'] = $request->selesai_magang;
        }

        // Handle upload foto
        if ($request->hasFile('foto')) {
            if ($user->foto) Storage::delete($user->foto);
            $data['foto'] = $request->file('foto')->store('foto');
        }

        // Handle upload portofolio jika ada
        if ($request->hasFile('portofolio')) {
            if ($user->portofolio) Storage::delete($user->portofolio);
            $data['portofolio'] = $request->file('portofolio')->store('portofolio');
        }


        // Jika ada data diubah
        if (!empty($data)) {
            $user->update($data);

            // Sinkronkan nama dengan tabel user jika nama diubah
            if (isset($data['nama'])) {
                $authUser->name = $data['nama'];
                $authUser->save();
            }



            return redirect()->route('profil')->with('success', 'Profil berhasil diperbarui.');
        }

        return redirect()->back()->with('info', 'Tidak ada perubahan yang dilakukan.');
    }
}