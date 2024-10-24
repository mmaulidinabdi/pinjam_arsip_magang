<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
            'username' => 'required',
        ]);
    }

    public function register(Request $request){
        $validateData = $request->validate([
            'nama_lengkap' => 'required|max:255',
            'email' => 'required|email:dns|unique:peminjams',
            'password' => 'required|min:5|max:255',
        ]);

        if($validateData['password'] != $request['confirm_password']){
            return back()->with('registErr', 'password berbeda')->withInput();
        }

        $validateData['password'] = Hash::make($validateData['password']);

        Peminjam::create($validateData);

        return redirect('/login')->with('success', 'Registrasi berhasil !!');
    }
}
