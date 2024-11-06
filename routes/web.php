<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landingPage');
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
Route::post('/register', [PeminjamController::class, 'create'])->name('register.process')->middleware('guest');;

//Route untuk Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// USER
// Dashboard
Route::get('/user/dashboard', [PeminjamController::class, 'index'])->middleware('auth')->name('user.dashboard');

Route::get('/user/profile', [PeminjamController::class, 'userProfile'])->middleware('auth')->name('user.profile');

// Peminjaman
Route::get('/user/peminjaman', [PeminjamController::class, 'userPeminjaman'])->middleware('auth')->name('user.peminjaman');

Route::put('/user/{peminjam}/updateProfile', [PeminjamController::class, 'Update'])->middleware('auth')->name('user.update');

// history
Route::get('/user/history',[PeminjamController::class, 'userHistory'])->middleware('auth')->name('user.history');


//admin
//Dashboard
Route::get('/admin/dashboard', [AdminController::class, 'admindashboard'])->middleware('admin')->name('admin.dashboard');

Route::get('/admin/kelola', [AdminController::class, 'kelola'])->middleware('admin')->name('admin.kelola');

Route::get('/admin/histori', [AdminController::class, 'historyadmin'])->middleware('admin')->name('admin.history');

Route::get('/admin/lanjutan', [AdminController::class, 'lanjutan'])->middleware('admin')->name('admin.lanjutan');

Route::get('/admin/detail', [AdminController::class, 'detail'])->middleware('admin')->name('admin.detail');

Route::get('/admin/useradmin', [AdminController::class, 'useradmin'])->middleware('admin')->name('admin.useradmin');

Route::get('/admin/terima/{id}', [AdminController::class, 'terimaStatus']);

Route::post('/admin/tolak/{peminjam}', [AdminController::class, 'tolakStatus']);

Route::delete('/admin/hapusUser/{peminjam}', [PeminjamController::class, 'delete']);

Route::put('/admin/updateUser/{peminjam}', [AdminController::class, 'updateUser']);