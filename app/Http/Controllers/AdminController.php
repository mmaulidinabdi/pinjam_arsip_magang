<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjam;

class AdminController extends Controller
{
    //
    public function admindashboard()
    {
        return view('adminlayout/adminDashboard', ['title' => 'Admin dashboard']);
    }

    public function kelola()
    {
        return view('adminlayout/kelolapeminjaman', ['title' => 'Kelola peminjaman']);
    }

    public function historyadmin()
    {
        return view('adminlayout/history', ['title' => 'History peminjaman']);
    }

    public function lanjutan()
    {
        return view('adminlayout/lanjutan', ['title' => 'Data Peminjam']);
    }

    public function detail()
    {
        return view('adminlayout/detailhistory', ['title' => 'detail Peminjam']);
    }

    public function useradmin()
    {
        return view('adminlayout/user', [
            'title' => 'user',
            'peminjams' => Peminjam::whereIn('isVerificate', ['diterima', 'diperiksa'])->get(),
        ]);
    }

    public function terimaStatus($id)
    {
        $peminjam = Peminjam::findOrFail($id);
        $peminjam->isVerificate = 'diterima';
        $peminjam->save();

        return redirect()->back();
    }

    public function tolakStatus(Request $request, Peminjam $peminjam){
        $validateData =  $request->validate([
            'alasan_ditolak' => 'required',
        ]);

        $validateData['isVerificate'] = 'ditolak';

        Peminjam::where('id', $peminjam->id)->update($validateData);

        return redirect()->back();
    }
}
