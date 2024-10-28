<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PeminjamController extends Controller
{
    //

    public function index(){
        return view('userDashboard',['title'=>'User Dashboard']);
    }

    public function userProfile(){
        return view('userProfile',['title' => 'Profile']);
    }

    public function userPeminjaman(){
        return view('userPeminjaman',['title'=>'Form Peminjaman']);
    }
}
