<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showRegisterForm() {
        return view('auth.register');
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed' // ← ini otomatis validasi dgn password_confirmation
        ]);
    
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
    
        return redirect('/login')->with('success', 'Registrasi berhasil!');
    }
    

    public function showLoginForm() {
        return view('auth.login');
    }

    public function login(Request $request) {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect('/admin/dashboard'); // khusus admin
        } else {
            return redirect('/dashboard'); // untuk pemagang biasa
        }
    }

    return back()->withErrors(['email' => 'Email atau password salah.']);
}
}
