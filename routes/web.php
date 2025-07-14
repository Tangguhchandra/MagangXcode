<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\ProfilController;
use Illuminate\Support\Facades\Mail;

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// landing page
Route::get('/', [DashboardController::class, 'index'])->name('home');

// dashboard user
Route::middleware('auth')->group(function () {
    // dashboard logged 
    Route::get('/dashboard', [DashboardController::class, 'DashboardUser'])->name('user.dashboard');

    // pendaftaran
    Route::get('/pendaftaran', [PendaftaranController::class, 'create'])->name('pendaftaran.form');
    Route::post('/pendaftaranStore', [PendaftaranController::class, 'store'])->name('pendaftaran.store');

    // profil
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil');

    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/login');
    })->name('logout');
});
// Logout