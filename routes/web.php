<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\AdminDashboardController;

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard'); // file: resources/views/dashboard.blade.php
})->middleware('auth')->name('dashboard');

// Logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

Route::get('/', function () {
    return view('home'); // nanti kita buat file view-nya di bawah
});

Route::middleware(['auth'])->group(function () {
    Route::get('/pendaftaran', [PendaftaranController::class, 'create'])->name('pendaftaran.form');
    Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');
});

Route::get('/profil', [App\Http\Controllers\ProfilController::class, 'index'])->name('profil');

Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->middleware('auth');
Route::patch('/admin/update-status/{id}', [App\Http\Controllers\AdminDashboardController::class, 'updateStatus'])->name('admin.updateStatus');
