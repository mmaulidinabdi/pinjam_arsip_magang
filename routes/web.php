<?php

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
Route::get('/dashboard', [PeminjamController::class, 'index'])->name('user.dashboard');

Route::get('/userProfile', [PeminjamController::class, 'userProfile'])->name('user.profile');
