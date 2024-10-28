<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PeminjamController;

// Route untuk menampilkan form login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');

// Route untuk menampilkan form register
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register')->middleware('guest');

// Route untuk memproses login
Route::post('/login', [AuthController::class, 'login'])->name('login.process')->middleware('guest');;

// Route untuk memproses register
Route::post('/register', [AuthController::class, 'register'])->name('register.process')->middleware('guest');;

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// USER
// Dashboard
Route::get('/user/dashboard', [PeminjamController::class, 'index'])->name('user.dashboard');

Route::get('/user/Profile', [PeminjamController::class, 'userProfile'])->name('user.profile');

// Peminjaman
Route::get('user/peminjaman', [PeminjamController::class, 'userPeminjaman'])->name('user.peminjaman');


//admin
//Dashboard
Route::get('/admin/dashboard', [AdminController::class, 'admindashboard'])->name('admin.dashboard');

Route::get('/admin/kelola', [AdminController::class, 'kelola'])->name('admin.kelola');

Route::get('/admin/histori', [AdminController::class, 'historyadmin'])->name('admin.history');
Route::get('/admin/lanjutan', [AdminController::class, 'lanjutan'])->name('lanjutan');
