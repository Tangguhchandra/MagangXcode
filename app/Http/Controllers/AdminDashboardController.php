<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Mail\PendaftaranDiterima;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

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
            'pendaftar',
            'recent',
            'total',
            'diterima',
            'pending',
            'ditolak',
            'persentase'
        ));
    }

    /**
     * Ubah status pendaftaran
     */
    public function updateStatus(Request $request, $id)
    {
        // ✅ Validasi status yang dikirim
        $request->validate([
            'status' => 'required|in:pending,diterima,ditolak',
        ]);

        try {
            // ✅ Temukan data pendaftar berdasarkan ID
            $pendaftar = Pendaftaran::findOrFail($id);

            // ✅ Update status
            $pendaftar->status = $request->status;
            $pendaftar->save();

            // ✅ Kirim email jika status diterima
            if ($request->status === 'diterima') {
                try {
                    Mail::to($pendaftar->email)->send(new PendaftaranDiterima($pendaftar));
                    Log::info('Email berhasil dikirim ke: ' . $pendaftar->email);
                } catch (\Exception $e) {
                    Log::error('Gagal mengirim email: ' . $e->getMessage());
                }
            }

            // ✅ Kalau request-nya dari JavaScript (AJAX), balas JSON
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Status berhasil diperbarui.'
                ]);
            }

            // ✅ Kalau bukan AJAX, redirect biasa
            return back()->with('success', 'Status berhasil diperbarui.');

        } catch (\Exception $e) {
            Log::error('Gagal update status: ' . $e->getMessage());

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat mengubah status.'
                ], 500);
            }

            return back()->with('error', 'Terjadi kesalahan saat mengubah status.');
        }
    }



    /**
     * Tampilkan daftar pendaftar
     */
    public function listPendaftar()
    {
        $pendaftar = \App\Models\Pendaftaran::latest()->get();

        return view('admin.list-pendaftar', compact('pendaftar'));

    }
}
