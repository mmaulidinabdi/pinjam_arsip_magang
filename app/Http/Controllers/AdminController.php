<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function admindashboard(){
        return view('adminlayout/adminDashboard',['title' => 'Admin dashboard']);
    }

    public function kelola(){
        return view('adminlayout/kelolapeminjaman',['title' => 'Kelola peminjaman']);
    }

    public function historyadmin(){
        return view('adminlayout/history',['title' => 'History peminjaman']);
    }
}
