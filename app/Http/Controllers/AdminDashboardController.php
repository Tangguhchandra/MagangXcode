<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    /**
     * Tampilkan dashboard admin
     */
    public function index()
    {
        $pendaftar = Pendaftaran::all();
        $recent = Pendaftaran::latest()->take(5)->get();
        $total = $pendaftar->count();
        $diterima = $pendaftar->where('status', 'diterima')->count();
        $pending = $pendaftar->where('status', 'pending')->count();
        $ditolak = $pendaftar->where('status', 'ditolak')->count();
        $persentase = $total > 0 ? round(($diterima / $total) * 100, 2) : 0;

        return view('admin.index', compact(
            'pendaftar', 'recent', 'total', 'diterima', 'pending', 'ditolak', 'persentase'
        ));
    }

    /**
     * Ubah status pendaftaran
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,diterima,ditolak',
        ]);

        $pendaftar = Pendaftaran::findOrFail($id);
        $pendaftar->status = $request->status;
        $pendaftar->save();

        return back()->with('success', 'Status berhasil diperbarui.');
    }
}
