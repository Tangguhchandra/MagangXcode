<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\AdminDashboardController;

// Register & Login
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Landing Page
Route::get('/', [DashboardController::class, 'index'])->name('home');

// Protected Routes (Login Required)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'DashboardUser'])->name('user.dashboard');
    Route::get('/pendaftaran', [PendaftaranController::class, 'create'])->name('pendaftaran.form');
    Route::post('/pendaftaranStore', [PendaftaranController::class, 'store'])->name('pendaftaran.store');


    // Profil Routes
    Route::get('/profil/edit/{id}', [ProfilController::class, 'edit'])->name('profil.edit');
    Route::patch('/profil/update/{id}', [ProfilController::class, 'update'])->name('profil.update');
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil');

    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/');
    })->name('logout');

    // Admin Routes (Login + Admin Middleware)
    Route::middleware('admin')->group(function () {
        Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/admin/pendaftar', [AdminDashboardController::class, 'listPendaftar'])->name('admin.pendaftar');
        Route::get('/admin/pendaftar/{id}/detail', [AdminDashboardController::class, 'showDetail']);
        Route::patch('/admin/update-status/{id}', [AdminDashboardController::class, 'updateStatus'])->name('admin.updateStatus');
        Route::delete('/pendaftar/{id}', [PendaftaranController::class, 'destroy'])->name('pendaftar.destroy');

    });
});
// Logout

// admin dashboard
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->middleware('auth')->name('admin.dashboard');