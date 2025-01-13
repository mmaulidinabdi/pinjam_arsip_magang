<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Histori;
use App\Models\Imb;
use App\Models\SK;
use App\Models\TransaksiPeminjaman;
use Carbon\Carbon;

class HistoriController extends Controller
{

    public function simpanKeHistory(request $request, TransaksiPeminjaman $transaksi)
    {

        if ($request->status == 'tolak') {
            $validateData = $request->validate([
                'jenis_arsip' => 'required',
                'alasan_ditolak' => 'required|max:255',
                'status' => 'required',
            ]);

            $validateData['status'] = 'ditolak';
        } elseif ($request->status == 'acc') {

            $validateData = $request->validate([
                'jenis_arsip' => 'required',
                'arsip' => 'required',
            ]);

            if ($validateData['jenis_arsip'] == 'IMB') {

                list($dp, $tahun, $nama) = explode(' - ', $validateData['arsip']);

                $arsip = imb::where('nomor_dp', $dp)->first();
                $validateData['imb_id'] = $arsip->id;
            } elseif ($validateData['jenis_arsip'] == 'SK') {

                list($sk, $tahun) = explode(' - ', $validateData['arsip'], 2);

                $arsip = sk::where('nomor_sk', $sk)->first();
                $validateData['sk_id'] = $arsip->id;
            }

            $validateData['status'] = 'diacc';
        } elseif ($request->status == 'diperiksa') {
            return back()->with('success', 'Pastikan Status Peminjaman Sudah Valid!');
        }

        $validateData['peminjam_id'] = $transaksi->peminjam_id;
        $validateData['nama_arsip'] = $transaksi->nama_arsip;
        $validateData['tanggal_peminjaman'] = $transaksi->tanggal_peminjaman;
        $validateData['tujuan_peminjam'] = $transaksi->tujuan_peminjam;
        $validateData['dokumen_pendukung'] = $transaksi->dokumen_pendukung;
        $validateData['tanggal_divalidasi'] = Carbon::now();
        Histori::create($validateData);

        $transaksi->delete();

        return redirect('/admin/histori')->with(['title' => 'History Peminjaman', 'active' => 'peminjaman']);
    }

    public function pengembalian($id)
    {

        // Ambil data histori berdasarkan id
        $historis = Histori::findOrFail($id);

        // Update tanggal_pengembalian dengan waktu saat ini
        $historis->tanggal_pengembalian = Carbon::now()->toDateString();

        // Simpan perubahan ke database
        $historis->save();

        // Redirect ke halaman dashboard dengan pesan sukses
        return redirect()->back()->with('success', 'Tanggal pengembalian berhasil diperbarui.');
    }

    public function pengambilan($id)
    {
        // Cari data berdasarkan ID
        $history = Histori::findOrFail($id);

        $arsip = $history->imb ?? $history->sk;
        $arsip->status = 'Dipinjam';
        $arsip->save();

        $history->tanggal_pengambilan = Carbon::now()->toDateString();
        $history->save();

        // Redirect atau kembalikan respons sukses
        return redirect()->back()->with('success', 'Tanggal pengambilan berhasil diperbarui.');
    }

    public function pembatalan($id)
    {
        // Cari data berdasarkan ID
        $history = Histori::findOrFail($id);

        $history->status = 'batal';
        $history->save();

        // Redirect atau kembalikan respons sukses
        return redirect()->back()->with('success', 'Tanggal pengambilan berhasil diperbarui.');
    }
}
