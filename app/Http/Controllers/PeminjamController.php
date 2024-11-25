<?php

namespace App\Http\Controllers;

use App\Models\SK;
use App\Models\Imb;
use App\Models\Arsip2;
use App\Models\Histori;
use App\Models\Peminjam;
use Illuminate\Http\Request;
use App\Models\TransaksiPeminjaman;
use Illuminate\Support\Composer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PeminjamController extends Controller
{
    //

    public function index()
    {

        $jumlahImb = Imb::count();
        $jumlahSK = SK::count();
        $jumlahArsip2  = Arsip2::count();
        $jumlahArsip = $jumlahImb + $jumlahSK + $jumlahArsip2;

        return view('userLayout/userDashboard', [
            'title' => 'SIPEKA | Dashboard ',
            'imb' => 'IMB',
            'sk' => 'SK',
            'arsip2' => 'Arsip 2',
            'transaksis' => TransaksiPeminjaman::where('peminjam_id', auth()->guard('web')->user()->id)->get(),
        ], compact('jumlahArsip', 'jumlahArsip2', 'jumlahImb', 'jumlahSK'));
    }

    public function userProfile()
    {
        return view('userLayout/userProfile', [
            'title' => 'SIPEKA | Profile',
        ]);
    }

    public function userPeminjaman()
    {
        return view('userLayout/userPeminjaman', [
            'title' => 'SIPEKA | Peminjaman',
        ]);
    }

    public function create(Request $request)
    {
        $validateData = $request->validate([
            'nama_lengkap' => 'required|max:255',
            'email' => 'required|email|unique:peminjams',
            'password' => 'required|min:5|max:255',
        ]);

        if ($validateData['password'] != $request['confirm_password']) {
            return back()->with('registErr', 'password berbeda')->withInput();
        }

        $validateData['password'] = Hash::make($validateData['password']);

        Peminjam::create($validateData);

        return redirect('/login')->with('success', 'Registrasi berhasil !!');
    }

    public function update(Request $request, Peminjam $peminjam)
    {
        $validateData = $request->validate([
            'nama_lengkap' => 'required|max:255',
            'alamat' => 'required',
            'no_telp' => 'required|unique:peminjams',
            'email' => 'required|email|unique:peminjams,email,' . $peminjam->id,
            'ktp' => 'nullable'
        ]);


        if ($request->file('ktp')) {
            if ($peminjam->ktp) {
                Storage::disk('public')->delete($peminjam->ktp);
            }
            $validateData['ktp'] = $request->file('ktp')->store('ktp', 'public');
        }

        $validateData['isVerificate'] = 'diperiksa';

        Peminjam::where('id', $peminjam->id)->update($validateData);

        // Peminjam::create($validateData);

        return redirect('/user/profile')->with('success', 'Data Disimpan');
    }

    public function delete(Peminjam $peminjam)
    {
        if ($peminjam->ktp) {
            Storage::disk('public')->delete($peminjam->ktp);
        }

        $peminjam->delete();

        return redirect()->back()->with('success', 'Akun Peminjam Berhasil Dihapus');
    }

    public function pinjam(Request $request)
    {
        $validateData = $request->validate([
            'peminjam_id' => 'required',
            'tujuan_peminjam' => 'required',
            'dokumen_pendukung' => 'nullable',
            'no_arsip' => 'nullable',
            'nama_arsip' => 'required',
            'data_arsip' => 'nullable',
            'jenis_arsip' => 'required',
        ]);

        $validateData['tanggal_peminjaman'] = now()->format('Y-m-d');
        $validateData['status'] = 'diperiksa';

        if ($request->file('dokumen_pendukung')) {
            $validateData['dokumen_pendukung'] = $request->file('dokumen_pendukung')->store('dokumen_pendukung', 'public');
        }

        TransaksiPeminjaman::create($validateData);

        return back()->with('success', 'Peminjaman Berhasil Diajukan !!');
    }

    public function userHistory()
    {
        return view('userLayout/userhistory', [
            'title' => 'SIPEKA | Histori',
            'histories' => Histori::where('peminjam_id', auth()->guard('web')->user()->id)
                ->where('status', '!=', 'diperiksa')
                ->get(),
        ]);
    }

    public function userdetail($id)
    {
        $history = Histori::with('peminjam')->findOrFail($id);
        return view('userLayout/userDetail', [
            'title' => 'kelola',
            'history' => $history,
            'active' => 'peminjaman'
        ]);
    }
}
