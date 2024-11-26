<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use App\Models\Peminjam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        $title = 'Login Page';

        return view('auth.login', ['title' => $title]);
    }

    public function showRegisterForm()
    {
        $title = 'Register Page';

        return view('auth.register', ['title' => $title]);
    }

    public function login(Request $request)
    {
        $validateData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $peminjam = Peminjam::where('email', $request->email)->first();



        if (Auth::guard('web')->attempt($validateData)) {
            if (!$peminjam || !$peminjam->is_account_verified) {
                return back()->with('error', 'Akun belum diverifikasi atau tidak ditemukan.')->withInput();
            }
            
            $request->session()->regenerate();
            return redirect()->intended('/user/dashboard');
        }

        if (Auth::guard('admin')->attempt($validateData)) {
            // dd($request);
            $request->session()->regenerate();
            return redirect()->intended('admin/dashboard');
        }

        return back()->with('error', 'Login gagal!')->withInput();
    }



    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
