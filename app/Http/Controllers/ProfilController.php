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


    public function update(Request  $request)
    {
        $user = Auth::user();


        return redirect()->route('profil.index')->with('success', 'Profil berhasil diperbarui.');
    }
}
