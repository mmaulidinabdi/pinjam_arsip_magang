<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use App\Models\SK;
use App\Models\Imb;
use App\Models\Histori;
use App\Models\Peminjam;
use Illuminate\Http\Request;
use App\Models\TransaksiPeminjaman;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    //
    public function adminDashboard()
    {
        $jumlahPeminjam = Peminjam::count();
        $historis = Histori::where('tanggal_pengambilan', '<=', Carbon::now()->subDays(20))
            ->where('status', 'diacc')
            ->whereNull('tanggal_pengembalian')
            ->get();
        $jumlahImb = Imb::count();
        $jumlahSK = SK::count();
        // $jumlahArsip2  = Arsip2::count();
        $jumlahArsip = $jumlahImb + $jumlahSK;

        // ambil transaksi peminjaman dengan status diperiksa
        $transaksiPending = TransaksiPeminjaman::with('peminjam')->where('status', 'diperiksa')->limit(5)->get();
        // dd($transaksiPending);

        return view('adminlayout/adminDashboard', [
            'title' => 'Admin dashboard',
            'active' => 'dashboard',
            'imb' => 'IMB',
            'histori' => $historis,
            'sk' => 'SK',
            'arsip2' => 'Arsip 2',
        ], compact('jumlahPeminjam', 'jumlahArsip', 'jumlahImb', 'jumlahSK', 'transaksiPending'));
    }

    public function adminKelola()
    {
        $items = TransaksiPeminjaman::with('peminjam')
            ->where('status', 'diperiksa')
            ->get();

        return view('adminlayout/kelolapeminjaman', [
            'title' => 'Kelola',
            'items' => $items,
            'active' => 'peminjaman'
        ]);
    }

    public function adminHistori()
    {
        $items = Histori::orderBy('tanggal_peminjaman')->get();


        return view('adminlayout/history', [
            'title' => 'histori',
            'items' => $items,
            'active' => 'peminjaman'
        ]);
    }

    public function adminUsers()
    {
        return view('adminlayout/user', [
            'title' => 'user',
            'active' => 'user',
            // ambil yg status nya diterima dan diperiksa
            'peminjams' => Peminjam::whereIn('isVerificate', ['diterima', 'diperiksa'])->get(),
        ]);
    }

    public function adminLanjutan()
    {
        return view('adminlayout/lanjutan', [
            'title' => 'Data Peminjam',
            'active' => 'tindakLanjut',
        ]);
    }

    public function adminDetail($id)
    {
        $data = Histori::with('peminjam')->findOrFail($id);
        return view('adminLayout/detailhistory', [
            'title' => 'kelola',
            'item' => $data,
            'active' => 'peminjaman'
        ]);
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

    public function terimaStatusUser($id)
    {
        $peminjam = Peminjam::findOrFail($id);
        $peminjam->isVerificate = 'diterima';
        $peminjam->save();

        return redirect()->back();
    }

    public function tolakStatusUser(Request $request, Peminjam $peminjam)
    {
        $validateData = $request->validate([
            'alasan_ditolak' => 'required',
        ]);


        $validateData['isVerificate'] = 'ditolak';

        Peminjam::where('id', $peminjam->id)->update($validateData);

        return redirect()->back();
    }

    public function datalanjutan($id)
    {
        $data = TransaksiPeminjaman::with('peminjam', 'imb', 'SK', 'arsip2')->findOrFail($id);
        $jenis = [
            'IMB',
            'SK',
            'Keuangan',
        ];
        // dd($data,$jenis);
        return view('adminlayout/lanjutan', [
            'title' => 'kelola',
            'item' => $data,
            'active' => 'peminjaman',
            'jenis' => $jenis,
        ]);
    }
}
