<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjam;
use App\Models\TransaksiPeminjaman;
use App\Models\Histori;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class PeminjamController extends Controller
{
    //

    public function index(Peminjam $peminjam)
    {
        return view('userLayout/userDashboard', [
            'title' => 'User Dashboard',
            'transaksis' => TransaksiPeminjaman::where('peminjam_id', $peminjam->id)->get(),
        ]);
    }

    public function userProfile()
    {
        return view('userLayout/userProfile', ['title' => 'Profile']);
    }

    public function userPeminjaman()
    {
        return view('userLayout/userPeminjaman', ['title' => 'Form Peminjaman']);
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
            'email' => 'required|email|unique:peminjams',
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

    public function userHistory(Peminjam $peminjam)
    {
        return view('userLayout/userhistory', [
            'title' => 'User History',
            'histories' => Histori::where('peminjam_id', $peminjam->id)
                ->where('status', '!=', 'diperiksa')
                ->get(),
        ]);
    }
}
