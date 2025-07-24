<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

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
        $authName = Auth::user();
        $request->validate([
            'nama' => 'required|string|max:255',
            'mulai_magang' => 'required|date',
            'selesai_magang' => 'required|date|after_or_equal:mulai_magang',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'portofolio' => 'nullable|mimes:pdf,docx,pptx|max:4096',
        ]);


        $data = $request->all();
    

        // Handle file uploads
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('uploads/foto', 'public');
            $data['foto'] = $fotoPath;
        }
        if ($request->hasFile('portofolio')) {
            $portofolioPath = $request->file('portofolio')->store('uploads/portofolio', 'public');
            $data['portofolio'] = $portofolioPath;
        }
        
        $user->update($data);
        // dd($data);
        // Update the user profile
        $authName->name = $request->nama;
        $authName->save(); 
        
        return redirect()->route('profil')->with('success', 'Profil berhasil diperbarui.');
    }
}