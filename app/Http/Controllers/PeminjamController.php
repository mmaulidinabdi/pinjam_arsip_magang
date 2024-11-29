<?php

namespace App\Http\Controllers;

use App\Models\SK;
use App\Models\Imb;
use App\Models\Arsip2;
use App\Models\Histori;
use App\Models\Peminjam;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Composer;
use Illuminate\Support\Facades\DB;
use App\Models\TransaksiPeminjaman;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;
use App\Notifications\VerifyEmailNotification;

class PeminjamController extends Controller
{
    //

    public function index()
    {

         
        $userId = auth()->guard('web')->user()->id;
        $jumlahminjam = Histori::where('peminjam_id', $userId)
            ->whereNull('tanggal_pengembalian')
            ->where('status', 'diacc')
            ->count();
        
$histori = Histori::where('peminjam_id', $userId)
        ->wherenull('tanggal_pengembalian')
    ->where('status', 'diacc')
    ->orderByRaw('DATEDIFF(CURDATE(), tanggal_divalidasi) desc') // Urutkan berdasarkan selisih waktu terbesar
    ->first(); // Ambil data dengan perbedaan terbesar

$hariTersisa = null;
if ($histori) {
    $hariTersisa = null;
    if ($histori) {
        // Hitung selisih hari antara tanggal divalidasi dan tanggal sekarang
        $tanggalDivalidasi = Carbon::parse($histori->tanggal_divalidasi);

// Hitung selisih hari antara tanggal divalidasi dan 30 hari sebelumnya, pastikan hasilnya positif
$hariTersisa = floor(abs($tanggalDivalidasi->diffInDays(Carbon::now()->subDays(30))));


    }

}



        return view('userLayout/userDashboard', [
            'title' => 'SIPEKA | Dashboard ',
            'imb' => 'IMB',
            'sk' => 'SK',
            'arsip2' => 'Arsip 2',
            'peminjamans' => TransaksiPeminjaman::where('peminjam_id', $userId)->get()

        ], compact( 'hariTersisa', 'histori', 'jumlahminjam',));
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

        $verificationToken = Str::random(30);

        // simpan data sementara ke table pending_users
        DB::table('pending_users')->insert([
            'nama_lengkap' => $validateData['nama_lengkap'],
            'email' => $validateData['email'],
            'password' => Hash::make($validateData['password']),
            'verification_token' => $verificationToken,
        ]);

        // $validateData['password'] = Hash::make($validateData['password']);
        // $validateData['verification_token'] = Str::random(30);

        // Peminjam::create($validateData);

        // Kirim Email Verifikasi
        $verificationUrl = route('verify.email', ['token' => $verificationToken]);
        Notification::route('mail', $validateData['email'])
            ->notify(new VerifyEmailNotification($verificationUrl, $validateData['nama_lengkap']));

        return redirect('/login')->with('success', 'Silakan cek email Anda untuk verifikasi.');
    }

    public function verifyEmail($token)
    {
        // cari pengguna di table pending_users
        $pendingUser = DB::table('pending_users')->where('verification_token', $token)->first();

        if (!$pendingUser) {
            return redirect('/login')->with('error', 'Token verifikasi tidak valid atau telah kadaluarsa.');
        }

        // Simpan ke database
        Peminjam::create([
            'nama_lengkap' => $pendingUser->nama_lengkap,
            'email' => $pendingUser->email,
            'password' => $pendingUser->password,
            'is_verified' => true,
        ]);

        // Hapus dari table pending_users
        DB::table('pending_users')->where('id', $pendingUser->id)->delete();

        return redirect('/login')->with('success', 'Email berhasil diverifikasi! Anda dapat login sekarang.');
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
