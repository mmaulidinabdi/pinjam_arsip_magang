<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
