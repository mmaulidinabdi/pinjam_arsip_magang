<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjam;
use App\Models\TransaksiPeminjaman;
use App\Models\Histori;
use App\Models\Imb;
use App\Models\Arsip1;
use App\Models\Arsip2;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Expr\FuncCall;

class AdminController extends Controller
{
    //
    public function admindashboard()
    {


        return view('adminlayout/adminDashboard', [
            'title' => 'Admin dashboard',
            'active' => 'dashboard'
        ]);
    }

    public function kelola()
    {
        return view('adminlayout/kelolapeminjaman', [
            'title' => 'Kelola peminjaman',
            'active' => 'peminjaman'
        ]);
    }

    public function historyadmin()
    {
        
        $items = Histori::with('Peminjam','Imb','Arsip1','Arsip2')
        ->get();
        

        return view('adminlayout/history', [
            'title' => 'kelola',
            'items' => $items,
            'active' => 'peminjaman'
        ]);
    }

    public function lanjutan()
    {
        return view('adminlayout/lanjutan', [
            'title' => 'Data Peminjam',
            'active' => 'tindakLanjut',
        ]);
    }

    public function detail()
    {

        return view('adminlayout/detailhistory', [
            'title' => 'detail Peminjam',
            'active' => 'peminjaman'
        ]);
    }

    public function useradmin()
    {
        return view('adminlayout/user', [
            'title' => 'user',
            'active' => 'user',
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

    public function tolakStatus(Request $request, Peminjam $peminjam)
    {
        $validateData = $request->validate([
            'alasan_ditolak' => 'required',
        ]);

        $validateData['isVerificate'] = 'ditolak';

        Peminjam::where('id', $peminjam->id)->update($validateData);

        return redirect()->back();
    }

    public function updateUser(Request $request, Peminjam $peminjam)
    {
        $validateData = $request->validate([
            'password' => 'required|min:5|max:255'
        ]);

        if ($validateData['password'] != $request['confirm_password']) {
            return back()->with('passBeda', 'Password berbeda');
        }

        $validateData['password'] = Hash::make($validateData['password']);

        Peminjam::where('id', $peminjam->id)->update($validateData);

        return back()->with('success', 'Password berhasil diganti');
    }

    public function manajemenImb()
    {
        return view('adminLayout.imb', [
            'title' => 'Management IMB',
            'active' => 'manajemen'
        ]);
    }

    public function manajemenSuratLain()
    {
        return view('adminLayout.suratlain', [
            'title' => 'Management Surat Lain',
            'active' => 'manajemen'
        ]);
    }

    public function tambahImb()
    {
        return view('adminLayout.tambahImb', [
            'title' => 'Input IMB',
            'active' => 'tambahArsip'
        ]);
    }

    public function tambahSuratLain()
    {
        return view('adminLayout.tambahSuratlain', [
            'title' => 'Input Surat Lain',
            'active' => 'tambahArsip'
        ]);
    }

    public function kelolapeminjaman()
    {
        $items = TransaksiPeminjaman::with('peminjam')
        ->where('status', 'diperiksa')
        ->get();

        return view('adminlayout/kelolapeminjaman', [
            'title' => 'kelola',
            'items' => $items,
            'active' => 'peminjaman'
        ]);

    }

    public function datalanjutan($id)
    {
        $data = TransaksiPeminjaman::with('peminjam')->findOrFail($id);
        return view('adminlayout/lanjutan', [
            'title' => 'kelola',
            'item' => $data,
            'active' => 'peminjaman'
        ]);

    }

    public function simpanKeHistory(request $request, TransaksiPeminjaman $transaksi)
    {
        $validateData = $request->validate([
            'alasan_ditolak' => 'required|max:255',
        ]);


        $validateData['peminjaman_id'] = $transaksi->id;
        $validateData['peminjam_id'] = $transaksi->peminjam_id;
        $validateData['status'] = 'ditolak';
        $validateData['tanggal_peminjaman'] = $transaksi->tanggal_peminjaman;
        $validateData['tujuan_peminjam'] = $transaksi->tujuan_peminjam;
        $validateData['dokumen_pendukung'] = $transaksi->dokumen_pendukung;
        $validateData['jenis_arsip'] = $transaksi->jenis_arsip;

        // dd($validateData);

        Histori::create($validateData);
        TransaksiPeminjaman::where('id', $transaksi->id)->delete();

        // if ($request->status === 'tolak') {
        //     $history = new Histori();
        //     $history->id_peminjam = $peminjam->id;
        //     $history->id_transaksi = $request->id; 
        //     $history->alasan_penolakan = $request->alasan;
        //     $history->save();
        // }

        return redirect('/admin/histori')->with(['title' => 'History Peminjaman', 'active' => 'peminjaman']);
    }

    public function history()
    {

    }
}
