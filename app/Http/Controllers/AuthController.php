<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Peminjam;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        $title = 'Login Page';

        return view('auth.login',['title' => $title]);
    }

    public function showRegisterForm()
    {
        $title = 'Register Page';

        return view('auth.register',['title'=>$title]);
    }

    public function login(Request $request){
        $validateData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::guard('web')->attempt($validateData)){
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        if(Auth::guard('admin')->attempt($validateData)){
            dd($request);
        }

        return back()->with('loginError', 'Login gagal!');
    }

    public function register(Request $request){
        $validateData = $request->validate([
            'nama_lengkap' => 'required|max:255',
            'email' => 'required|email|unique:peminjams',
            'password' => 'required|min:5|max:255',
        ]);

        if($validateData['password'] != $request['confirm_password']){
            return back()->with('registErr', 'password berbeda')->withInput();
        }

        $validateData['password'] = Hash::make($validateData['password']);

        Peminjam::create($validateData);

        return redirect('/login')->with('success', 'Registrasi berhasil !!');
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
