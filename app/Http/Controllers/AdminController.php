<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function admindashboard(){
        return view('adminlayout/adminDashboard',['title' => 'Admin Dashboard']);
    }

    public function kelola(){
        return view('adminlayout/kelolapeminjaman',['title' => 'kelola peminjaman']);
    }

    public function historyadmin(){
        return view('adminlayout/history',['title' => 'History peminjaman']);
    }

    public function lanjutan(){
        return view('adminlayout/lanjutan',['title' => 'Data Peminjam']);
    }
}
