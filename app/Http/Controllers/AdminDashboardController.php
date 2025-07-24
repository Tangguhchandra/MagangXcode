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
     * Tampilkan dashboard admin dengan fitur search
     */
    public function index(Request $request)
    {
        $query = Pendaftaran::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        $pendaftar = $query->get();
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
        $request->validate([
            'status' => 'required|in:pending,diterima,ditolak',
        ]);

        try {
            $pendaftar = Pendaftaran::findOrFail($id);
            $pendaftar->status = $request->status;
            $pendaftar->save();

            if ($request->status === 'diterima') {
                try {
                    Mail::to($pendaftar->email)->send(new PendaftaranDiterima($pendaftar));
                    Log::info('Email berhasil dikirim ke: ' . $pendaftar->email);
                } catch (\Exception $e) {
                    Log::error('Gagal mengirim email: ' . $e->getMessage());
                }
            }

        return response()->json([
            'success' => true,
            'message' => 'Status berhasil diperbarui.'
        ]);

        } catch (\Exception $e) {
            Log::error('Gagal update status: ' . $e->getMessage());

        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan saat mengubah status.'
        ], 500);
        }
    }

    /**
     * Tampilkan daftar pendaftar dengan fitur search
     */
    public function listPendaftar(Request $request)
    {
        $search = $request->input('search');

        $pendaftar = Pendaftaran::query()
            ->when($search, function ($query, $search) {
                $query->where('nama', 'like', "%{$search}%");
            })
            ->latest()
            ->get();

        return view('admin.list-pendaftar', compact('pendaftar'));
    }

    /**
     * Ambil detail pendaftar untuk modal detail
     */
    public function showDetail($id)
    {
        $pendaftar = Pendaftaran::findOrFail($id);
        return response()->json($pendaftar);
    }
}
