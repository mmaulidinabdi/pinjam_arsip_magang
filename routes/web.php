<?php

use App\Models\Imb;
use App\Http\Middleware\Admin;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SKController;
use App\Http\Controllers\ImbController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PeminjamController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\HistoriController;
use App\Http\Controllers\TransaksiPeminjamanController;
use App\Models\Peminjam;

Route::get('/', function () {
    return view('landingPage');
})->name('landingPage');



// login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.process')->middleware('guest');

// register
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register')->middleware('guest');
Route::post('/register', [PeminjamController::class, 'create'])->name('register.process')->middleware('guest');;

//Route untuk Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth:admin,web');

// route verifikasi email
Route::get('/verify-email/{token}', [PeminjamController::class, 'verifyEmail'])->name('verify.email')->middleware('guest');

// forgot password dan reset password
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');

Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.update');





// USER
Route::get('/user/dashboard', [PeminjamController::class, 'userDashboard'])->middleware('auth')->name('user.dashboard');

Route::get('/user/profile', [PeminjamController::class, 'userProfile'])->middleware('auth')->name('user.profile');

//user peminjaman
Route::get('/user/peminjaman', [PeminjamController::class, 'userPeminjaman'])->middleware('auth')->name('user.peminjaman');

Route::post('/user/peminjaman', [TransaksiPeminjamanController::class, 'create'])->middleware('auth');

Route::put('/user/{peminjam}/updateProfile', [PeminjamController::class, 'Update'])->middleware('auth')->name('user.update');

//user history
Route::get('/user/history', [PeminjamController::class, 'userHistory'])->middleware('auth')->name('user.history');

Route::get('/user/detail/{id}', [peminjamController::class, 'userdetail'])->middleware('auth')->name('user.detail');






//admin
Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard'])->middleware('admin')->name('admin.dashboard');

Route::get('/admin/kelola', [AdminController::class, 'adminKelola'])->middleware('admin')->name('admin.kelola');

Route::get('/admin/histori', [AdminController::class, 'adminHistori'])->middleware('admin')->name('admin.history');

Route::get('/admin/lanjutan', [AdminController::class, 'adminLanjutan'])->middleware('admin')->name('admin.lanjutan');

Route::get('/admin/useradmin', [AdminController::class, 'adminUsers'])->middleware('admin')->name('admin.useradmin');

Route::get('/admin/detail/{id}', [AdminController::class, 'adminDetail'])->middleware('admin')->name('admindetail');

Route::get('/admin/lanjutan/{id}', [AdminController::class, 'datalanjutan'])->middleware('admin')->name('adminlanjut');



//admin user
Route::post('/admin/tolak/{peminjam}', [AdminController::class, 'tolakStatusUser'])->middleware('admin');

Route::get('/admin/terima/{id}', [AdminController::class, 'terimaStatusUser'])->middleware('admin');

Route::delete('/admin/hapusUser/{peminjam}', [PeminjamController::class, 'delete'])->middleware('admin');

Route::put('/admin/updateUser/{peminjam}', [AdminController::class, 'updateUser'])->middleware('admin');

Route::post('/admin/kelola/simpan-ke-history/{transaksi}', [HistoriController::class, 'simpanKeHistory'])->middleware('admin')->name('simpan-ke-history');




// untuk imb
Route::get('/admin/imb', [ImbController::class, 'manajemenImb'])->middleware('admin')->name('admin.manajemenImb');

Route::get('/admin/tambahImb', [ImbController::class, 'viewTambahImb'])->middleware('admin')->name('admin.viewTambahImb');

Route::post('/admin/tambahImb', [ImbController::class, 'tambahImb'])->middleware('admin')->name('admin.tambahImb');
// lihat file imb
Route::get('/admin/lihat/imb/{name}', [ImbController::class, 'lihatImb'])->middleware('admin')->name('admin.lihatImb');
// edit imb
Route::put('/admin/edit/imb/{id}', [ImbController::class, 'updateImb'])->middleware('admin')->name('edit.imb');
// delete imb
Route::delete('/admin/delete/imb/{id}', [ImbController::class, 'deleteImb'])->middleware('admin')->name('delete.imb');
// search
Route::get('/admin/imb/search', [ImbController::class, 'search'])->middleware('admin')->name('search.imb');
// print all
Route::get('/admin/imb/printAll', [ImbController::class, 'printAll'])->middleware('admin')->name('imb.printAll');





//untuk SK
Route::get('/admin/sk', [SKController::class, 'manajemenSK'])->middleware('admin')->name('admin.manajemenSK');

Route::get('/admin/tambahSK', [SKController::class, 'viewTambahSK'])->middleware('admin')->name('admin.viewTambahSK');

Route::post('/admin/tambahSK', [SKController::class, 'tambahSK'])->middleware('admin')->name('admin.tambahSK');

Route::get('/admin/lihat/sk/{name}', [SKController::class, 'lihatSk'])->middleware('admin')->name('admin.lihatSK');
// edit imb
Route::put('/admin/edit/sk/{id}', [SKController::class, 'updateSK'])->middleware('admin')->name('edit.sk');
// hapus sk
Route::delete('/admin/delete/sk/{id}', [SKController::class, 'deleteSK'])->middleware('admin')->name('hapus.sk');
// search
Route::get('/admin/sk/search', [SKController::class, 'search'])->middleware('admin')->name('search.imb');
// print all
Route::get('/admin/sk/printAll', [SKController::class, 'printAll'])->middleware('admin')->name('sk.printAll');



//untuk histori
Route::post('admin/pengembalian/{id}', [HistoriController::class, 'pengembalian'])->name('konfirmasi.pengembalian');

Route::post('admin/pegambilan/{id}', [HistoriController::class, 'pengambilan'])->name('pengambilan');

Route::post('admin/batalkan/{id}', [HistoriController::class, 'pembatalan'])->name('pembatalan');




//autocomplete search transaksi peminjaman
Route::get('cari', [TransaksiPeminjamanController::class, 'autocomplete']);



Route::get('/tes', function () {
    return view('tes');
});


// Route::get('/admin/kelola', [AdminController::class, 'kelolapeminjaman'])->middleware('admin')->name('admin.kelola');
