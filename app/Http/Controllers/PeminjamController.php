<?php

namespace App\Http\Controllers;

use App\Models\SK;
use Carbon\Carbon;
use App\Models\Imb;
use App\Models\Arsip2;
use App\Models\Histori;
use App\Models\Peminjam;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Composer;
use Illuminate\Support\Facades\DB;
use App\Models\TransaksiPeminjaman;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;
use App\Notifications\VerifyEmailNotification;

class PeminjamController extends Controller
{
    //
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

        //generate token
        $verificationToken = Str::random(30);

        // simpan data sementara ke table pending_users
        DB::table('pending_users')->insert([
            'nama_lengkap' => $validateData['nama_lengkap'],
            'email' => $validateData['email'],
            'password' => Hash::make($validateData['password']),
            'verification_token' => $verificationToken,
        ]);



        // Kirim Email Verifikasi
        $verificationUrl = route('verify.email', ['token' => $verificationToken]);
        Notification::route('mail', $validateData['email'])
            ->notify(new VerifyEmailNotification($verificationUrl, $validateData['nama_lengkap']));

        return redirect('/login')->with('success', 'Silakan cek email Anda untuk verifikasi.');
    }

    public function update(Request $request, Peminjam $peminjam)
    {
        $validateData = $request->validate([
            'nama_lengkap' => 'required|max:255',
            'alamat' => 'required',
            'no_telp' => 'required||max:15|min:10|unique:peminjams,no_telp,' . $peminjam->id,
            'email' => 'required|email|unique:peminjams,email,' . $peminjam->id,
            'ktp' => 'nullable|mimes:jpg,png|max:3072'
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

    public function userDashboard()
    {
        $userId = auth()->guard('web')->user()->id;
        $jumlahminjam = Histori::where('peminjam_id', $userId)
            ->whereNull('tanggal_pengembalian')
            ->where('status', 'diacc')
            ->count();

        $jumlahselesai = Histori::where('peminjam_id', $userId)
            ->where('status', 'diacc')
            ->count();

        $histori = Histori::where('peminjam_id', $userId)
            ->whereNotNull('tanggal_pengambilan') // Pastikan tanggal_pengambilan tidak null
            ->whereNull('tanggal_pengembalian') // Pastikan tanggal_pengembalian null
            ->where('status', 'diacc') // Status diacc
            ->orderByRaw('DATEDIFF(CURDATE(), tanggal_pengambilan) desc') // Urutkan berdasarkan selisih waktu terbesar
            ->first(); // Ambil data dengan selisih terbesar

        $hariTersisa = null;
        if ($histori) {
            // Ambil tanggal_pengambilan dari histori yang ditemukan
            $tanggalPengambilan = Carbon::parse($histori->tanggal_pengambilan);

            // Hitung selisih hari antara tanggal_pengambilan dan sekarang
            $hariTersisa = floor($tanggalPengambilan->diffInDays(Carbon::now()->subDays(30)));
        }


        return view('userLayout/userDashboard', [
            'title' => 'SIPEKA | Dashboard ',
            'imb' => 'IMB',
            'sk' => 'SK',
            'arsip2' => 'Arsip 2',
            'peminjamans' => TransaksiPeminjaman::where('peminjam_id', $userId)->get()

        ], compact('hariTersisa', 'histori', 'jumlahminjam', 'jumlahselesai'));
    }

    public function userProfile()
    {
        return view('userLayout/userProfile', [
            'title' => 'SIPEKA | Profile',
        ]);
    }

    public function userPeminjaman()
    {

        if (Auth::guard('web')->user()->isVerificate !== 'diterima') {

            $status = 'belumVerifikasi';
            return view('/userLayout/userPeminjaman', [
                'status' => $status,
                'title' => 'SIPEKA | Peminjaman',
            ]);
        }

        $status = 'terverifikasi';
        return view('userLayout/userPeminjaman', [
            'status' => $status,
            'title' => 'SIPEKA | Peminjaman',
        ]);
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

    public function sendReminderEmails()
    {
        // Dapatkan instance dari Kernel
        $kernel = app(\App\Console\Kernel::class);

        // Panggil fungsi sendReminderEmails
        $kernel->sendReminderEmails();

        return 'Reminder Emails sent!';
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
        DB::table('pending_users')->where('verification_token', $token)->delete();


        return redirect('/login')->with('success', 'Email berhasil diverifikasi! Anda dapat login sekarang.');
    }
}
