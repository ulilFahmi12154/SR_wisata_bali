<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // ======================
    // SHOW LOGIN USER
    // ======================
    public function showUserLogin()
    {
        return view('pages.auth.user.login');
    }

    // ======================
    // SHOW LOGIN ADMIN
    // ======================
    public function showAdminLogin()
    {
        return view('pages.auth.admin.login');
    }

    // ======================
    // LOGIN PROCESS (GLOBAL)
    // ======================
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            $user = Auth::user();

            // 🔥 redirect berdasarkan role
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('user.recommendation');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah',
        ]);
    }

    // ======================
    // LOGOUT
    // ======================
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}