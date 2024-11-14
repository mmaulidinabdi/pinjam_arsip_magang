<?php

namespace App\Http\Controllers;


use App\Models\Peminjam;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use App\Models\TransaksiPeminjaman;
use App\Models\Histori;
use App\Models\Imb;
use App\Models\Arsip1;
use App\Models\Arsip2;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
            // ambil yg status nya diterima dan diperiksa
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


    public function viewTambahImb()
    {

        return view('adminLayout.tambahImb', [
            'title' => 'Input IMB',
            'active' => 'tambahArsip'
        ]);
    }

    public function tambahImb(Request $request)
    {
        $validateData = $request->validate([
            'nomor_dp' => 'required|numeric',
            'nama_pemilik' => 'nullable',
            'alamat' => 'nullable',
            'lokasi' => 'nullable',
            'box' => 'nullable',
            'keterangan' => 'nullable',
            'tahun' => 'nullable',
            'imbs' => 'nullable',
        ]);


        // Decode base64 to store as file
        $base64Pdf = $request->input('imbs');
        $pdfContent = base64_decode(preg_replace('#^data:application/pdf;base64,#i', '', $base64Pdf));

        // Simpan file ke storage Laravel (atau folder tertentu)
        $fileName = 'imb_' . $request['nomor_dp'] . '_' . $request['tahun'] . '_' . time() . '.pdf';
        $validateData['imbs'] = $fileName;

        Storage::disk('public')->put('imbs/' . $fileName, $pdfContent);
        Imb::create($validateData);

        return redirect()->route('admin.manajemenImb')->with('success', 'Data Berhasil Masuk!!');
    }

    public function viewTambahSuratLain()
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


    // untuk lihat file imb
    public function show($name)
    {
        $path = storage_path('app/public/imbs/' . $name);
        // dd($path);
        return response()->file($path, [
            'Content-Type' => 'application/pdf'
        ]);
    }
}
