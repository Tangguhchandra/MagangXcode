<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Mail\PendaftaranDiterima;
use App\Mail\PendaftaranDitolak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Storage;

class AdminDashboardController extends Controller
{
    /**
     * Tampilkan dashboard admin dengan fitur search
     */
    public function index(Request $request)
    {
        $query = Pendaftaran::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('nama', 'ilike', '%' . $request->search . '%');
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

            $key = 'send-email:' . $pendaftar->email; // key unik per user
            $limit = 2;  // max email
            $decay = 600; // 10 menit

            if ($request->status === 'diterima') {
                try {
                    if (! RateLimiter::tooManyAttempts($key, $limit)) {
                        Mail::to($pendaftar->email)
                            ->send(new PendaftaranDiterima($pendaftar));
                        Log::info('Email penerimaan berhasil dikirim ke: ' . $pendaftar->email);
                        RateLimiter::hit($key, $decay);
                    }

                    else{
                        Log::warning('Terlalu banyak upaya pengiriman email ke: ' . $pendaftar->email);
                        return back()->withErrors([
                            'email' => 'Terlalu banyak upaya pengiriman email. Silakan coba lagi nanti.'
                        ]);
                    }


                } catch (\Exception $e) {
                    Log::error('Gagal mengirim email penerimaan: ' . $e->getMessage());
                }
            } elseif ($request->status === 'ditolak') {
                try {
                    Mail::to($pendaftar->email)->send(new PendaftaranDitolak($pendaftar));
                    Log::info('Email penolakan berhasil dikirim ke: ' . $pendaftar->email);
                } catch (\Exception $e) {
                    Log::error('Gagal mengirim email penolakan: ' . $e->getMessage());
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
                $query->where('nama', 'ilike', "%{$search}%");
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

        // Debug untuk memeriksa path file
        Log::info('CV Path: ' . $pendaftar->cv);
        Log::info('Full CV URL: ' . asset('storage/' . $pendaftar->cv));

        return response()->json($pendaftar);
    }


    public function trash(Request $request)
    {
        try {
            $search = $request->input('search');

            $pendaftarans = Pendaftaran::onlyTrashed()
                ->when($search, function ($query, $search) {
                    // Gunakan 'ilike' agar case-insensitive di PostgreSQL
                    $query->where('nama', 'ilike', "%{$search}%");
                })
                ->get();

            return view('admin.trash', compact('pendaftarans'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'Gagal mengambil data: ' . $e->getMessage()
            ]);
        }
    }



    public function restore($id)
    {
        try {
            $pendaftaran = Pendaftaran::withTrashed()->findOrFail($id);
            $pendaftaran->restore();

            return redirect()->back()->with('success', 'Data pendaftar berhasil dipulihkan.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'Gagal memulihkan data: ' . $e->getMessage()
            ]);
        }
    }


    public function deletePermanent($id)
    {
        try {
            $pendaftaran = Pendaftaran::withTrashed()->findOrFail($id);

            $user = $pendaftaran->user;
            // Hapus file fisik jika ada
            if ($pendaftaran->foto && Storage::disk('public')->exists($pendaftaran->foto)) {
                Storage::disk('public')->delete($pendaftaran->foto);
            }
            if ($pendaftaran->cv && Storage::disk('public')->exists($pendaftaran->cv)) {
                Storage::disk('public')->delete($pendaftaran->cv);
            }
            if ($pendaftaran->portofolio && Storage::disk('public')->exists($pendaftaran->portofolio)) {
                Storage::disk('public')->delete($pendaftaran->portofolio);
            }


            $pendaftaran->forceDelete();

            if ($user) {
                // Hapus user jika tidak ada pendaftaran lain yang terkait
                if ($user->pendaftaran()->count() === 0) {
                    $user->forceDelete();
                }
            }

            return redirect()->back()->with('success', 'Data pendaftar berhasil dihapus secara permanen.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'Gagal menghapus data secara permanen: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Menampilkan daftar user untuk management
     */
    public function userManagement(Request $request)
    {
        $search = $request->input('search');

        $users = \App\Models\User::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'ilike', "%{$search}%")
                    ->orWhere('email', 'ilike', "%{$search}%");
            })
            ->latest()
            ->get();

        return view('admin.user-management', compact('users'));
    }

    /**
     * Soft delete user
     */
    public function deleteUser($id)
    {
        try {
            $user = \App\Models\User::findOrFail($id);

            // Soft delete semua pendaftaran yang terkait dengan user
            $user->pendaftaran()->delete();

            // Soft delete user
            $user->delete();

            return redirect()->back()->with('success', 'User berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'Gagal menghapus user: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Restore user yang sudah dihapus
     */
    public function restoreUser($id)
    {
        try {
            $user = \App\Models\User::withTrashed()->findOrFail($id);
            $user->restore();

            // Restore juga pendaftaran yang terkait
            $user->pendaftaran()->restore();

            return redirect()->back()->with('success', 'User berhasil dipulihkan.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'Gagal memulihkan user: ' . $e->getMessage()
            ]);
        }
    }
}