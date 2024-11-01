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

        // Cek apakah user atau admin ada di db
        $userExist = Peminjam::where('email', $validateData['email'])->exists();
        $adminExist = Admin::where('email', $validateData['email'])->exists();

        if (!$userExist && !$adminExist) {
            return back()->with('loginError', 'Akun tidak ditemukan')->withInput();
        }

        if (Auth::guard('web')->attempt($validateData)) {
            $request->session()->regenerate();
            return redirect()->intended('/user/dashboard');
        }

        if (Auth::guard('admin')->attempt($validateData)) {
            // dd($request);
            $request->session()->regenerate();
            return redirect()->intended('admin/dashboard');
        }

        return back()->with('loginError', 'Login gagal!')->withInput();
    }

    public function register(Request $request)
    {
        $validateData = $request->validate([
            'nama_lengkap' => 'required|max:255',
            'email' => 'required|email|unique:peminjams',
            'password' => 'required|min:5|max:255',
        ]);

        if ($validateData['password'] != $request['confirm_password']) {
            return back()->with('registErr', 'password berbeda')->withInput();
        }

        $validateData['password'] = Hash::make($validateData['password']);

        Peminjam::create($validateData);

        return redirect('/login')->with('success', 'Registrasi berhasil !!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
