<?php

namespace App\Http\Controllers;
use App\Models\Arsip1;
use App\Models\Arsip2;
use App\Models\Imb;
use Illuminate\Http\Request;
use App\Models\Peminjam;
use App\Models\TransaksiPeminjaman;
use App\Models\Histori;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Expr\FuncCall;
use Psy\Command\HistoryCommand;
use Carbon\Carbon;

class AdminController extends Controller
{
    //
    public function admindashboard()
    {
        $jumlahPeminjam = Peminjam::count();

        $jumlahImb = Imb::count();
        $jumlahArsip1 = Arsip1::count();
        $jumlahArsip2  = Arsip2::count();
        $jumlahArsip = $jumlahImb + $jumlahArsip1 + $jumlahArsip2;

        // ambil transaksi peminjaman dengan status diperiksa
        $transaksiPending = TransaksiPeminjaman::with('peminjam')->where('status', 'diperiksa')->limit(5)->get();
        // dd($transaksiPending);

        return view('adminlayout/adminDashboard', [
            'title' => 'Admin dashboard',
            'active' => 'dashboard',
            'imb' => 'IMB',
            'arsip1' => 'Arsip 1',
            'arsip2' => 'Arsip 2',
        ], compact('jumlahPeminjam', 'jumlahArsip', 'jumlahImb', 'jumlahArsip1', 'jumlahArsip2', 'transaksiPending'));
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
        $dataImb = Imb::all();


        return view('adminLayout.imb', [
            'title' => 'Management IMB',
            'active' => 'manajemen',
            'dataImb' => $dataImb,
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
            'title' => 'History',
            'items' => $items,
            'active' => 'peminjaman'
        ]);

    }

    public function datalanjutan($id)
    {
        $data = TransaksiPeminjaman::with('peminjam','imb','arsip1','arsip2')->findOrFail($id);
        return view('adminlayout/lanjutan', [
            'title' => 'kelola',
            'item' => $data,
            'active' => 'peminjaman'
        ]);

    }

    public function datadetail($id)
    {
        $data = Histori::with('peminjam')->findOrFail($id);
        return view('adminLayout/detailhistory', [
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
        $validateData['nama_arsip'] = $transaksi->nama_arsip;
        $validateData['status'] = 'ditolak';
        $validateData['tanggal_peminjaman'] = $transaksi->tanggal_peminjaman;
        $validateData['tujuan_peminjam'] = $transaksi->tujuan_peminjam;
        $validateData['dokumen_pendukung'] = $transaksi->dokumen_pendukung;
        $validateData['jenis_arsip'] = $transaksi->jenis_arsip;



        Histori::create($validateData);

        TransaksiPeminjaman::where('id', $transaksi->id)->delete();

        return redirect('/admin/histori')->with(['title' => 'History Peminjaman', 'active' => 'peminjaman']);
    }

    public function history()
    {

    }

    public function konfirmasiPengembalian($id)
    {
        // Cari data berdasarkan ID
        $history = Histori::findOrFail($id);

        // Perbarui tanggal_pengembalian dengan tanggal saat ini
        $history->tanggal_pengembalian = Carbon::now()->toDateString();
        $history->save();

        // Redirect atau kembalikan respons sukses
        return redirect()->back()->with('success', 'Tanggal pengembalian berhasil diperbarui.');
    }
}