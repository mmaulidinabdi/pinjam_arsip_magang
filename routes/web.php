<?php

use App\Models\Imb;
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImbController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PeminjamController;
use App\Http\Controllers\SKController;

Route::get('/', function () {
    return view('landingPage');
})->name('landingPage');



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

Route::post('/user/peminjaman', [PeminjamController::class, 'Pinjam']);

Route::put('/user/{peminjam}/updateProfile', [PeminjamController::class, 'Update'])->middleware('auth')->name('user.update');

// history
Route::get('/user/history', [PeminjamController::class, 'userHistory'])->middleware('auth')->name('user.history');

//detail history
Route::get('/user/detail/{id}', [peminjamController::class, 'userdetail'])->middleware('auth')->name('user.detail');

//admin
//Dashboard
Route::get('/admin/dashboard', [AdminController::class, 'admindashboard'])->middleware('admin')->name('admin.dashboard');

Route::get('/admin/kelola', [AdminController::class, 'kelolapeminjaman'])->middleware('admin')->name('admin.kelola');

Route::get('/admin/histori', [AdminController::class, 'historyadmin'])->middleware('admin')->name('admin.history');

Route::get('/admin/lanjutan', [AdminController::class, 'lanjutan'])->middleware('admin')->name('admin.lanjutan');


Route::get('/admin/useradmin', [AdminController::class, 'useradmin'])->middleware('admin')->name('admin.useradmin');






Route::get('/admin/lanjutan/{id}', [AdminController::class, 'datalanjutan'])->middleware('admin')->name('adminlanjut');

Route::get('/admin/terima/{id}', [AdminController::class, 'terimaStatus']);

Route::post('/admin/tolak/{peminjam}', [AdminController::class, 'tolakStatus']);

Route::delete('/admin/hapusUser/{peminjam}', [PeminjamController::class, 'delete']);

Route::put('/admin/updateUser/{peminjam}', [AdminController::class, 'updateUser']);

Route::post('/admin/kelola/simpan-ke-history/{transaksi}', [AdminController::class, 'simpanKeHistory'])->name('simpan-ke-history');

Route::get('/admin/detail/{id}', [AdminController::class, 'datadetail'])->middleware('admin')->name('admindetail');


// untuk imb
Route::get('/admin/imb', [AdminController::class, 'manajemenImb'])->middleware('admin')->name('admin.manajemenImb');

Route::get('/admin/tambahImb', [AdminController::class, 'viewTambahImb'])->middleware('admin')->name('admin.viewTambahImb');
Route::post('/admin/tambahImb', [AdminController::class, 'tambahImb'])->middleware('admin')->name('admin.tambahImb');
// lihat file imb
Route::get('/admin/lihat/imb/{name}', [AdminController::class, 'show'])->middleware('admin')->name('admin.lihatImb');
// edit imb
Route::put('/admin/edit/imb/{id}', [AdminController::class, 'updateImb'])->middleware('admin')->name('edit.imb');
// delete imb
Route::get('/admin/delete/imb/{id}', [AdminController::class, 'deleteImb'])->middleware('admin')->name('delete.imb');

// search
Route::get('/admin/imb/search',[ImbController::class,'search'])->middleware('admin')->name('search.imb');
// print all
Route::get('/admin/imb/printAll',[ImbController::class,'printAll'])->middleware('admin')->name('imb.printAll');

Route::post('admin/kelola/{id}', [AdminController::class, 'konfirmasiPengembalian'])->name('konfirmasi.pengembalian');

//untuk SK
Route::get('/admin/sk',[SKController::class,'manajemenSK'])->middleware('admin')->name('admin.manajemenSK');
Route::get('/admin/tambahSK', [SKController::class, 'viewTambahSK'])->middleware('admin')->name('admin.viewTambahSK');
Route::post('/admin/tambahSK', [SKController::class, 'tambahSK'])->middleware('admin')->name('admin.tambahSK');

Route::get('/admin/lihat/sk/{name}',[SKController::class,'show'])->middleware('admin')->name('admin.lihatSK');


// untuk Keuangan
Route::get('/admin/tambahKeuangan', [AdminController::class, 'viewTambahKeuangan'])->middleware('admin')->name('admin.viewTambahKeuangan');
ROute::post('/admin/tambahKeuangan', [AdminController::class, 'tambahKeuangan'])->middleware('admin')->name('admin.tambahKeuangan');


Route::get('/tes', function () {
    return view('tes');
});

Route::get('cari', [AdminController::class, 'autocomplete']);


// Route::get('/admin/kelola', [AdminController::class, 'kelolapeminjaman'])->middleware('admin')->name('admin.kelola');
