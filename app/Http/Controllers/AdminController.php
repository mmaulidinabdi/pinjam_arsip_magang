<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use App\Models\Imb;
use App\Models\Arsip1;
use App\Models\Arsip2;
use App\Models\Histori;
use App\Models\Peminjam;
use Illuminate\Http\Request;
use Psy\Command\HistoryCommand;
use PhpParser\Node\Expr\FuncCall;
use App\Models\TransaksiPeminjaman;
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
        $items = Histori::with('Peminjam', 'Imb', 'Arsip1', 'Arsip2')
            ->get();


        return view('adminlayout/history', [
            'title' => 'histori',
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


    // SK

    public function viewTambahSK()
    {
        return view('adminLayout.tambahSK', [
            'title' => 'Input SK',
            'active' => 'tambahArsip'
        ]);
    }


    // Keuangan
    public function viewTambahKeuangan()
    {
        return view('adminLayout.tambahKeuangan', [
            'title' => 'Input Arsip Keuangan',
            'active' => 'tambahArsip'
        ]);
    }

    public function kelolapeminjaman()
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

    public function datalanjutan($id)
    {
        $data = TransaksiPeminjaman::with('peminjam', 'imb', 'arsip1', 'arsip2')->findOrFail($id);
        $jenis = [
            'IMB',
            'SK',
            'Keuangan',
        ];
        return view('adminlayout/lanjutan', [
            'title' => 'kelola',
            'item' => $data,
            'active' => 'peminjaman',
            'jenis' => $jenis,
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

        $validateData['peminjam_id'] = $transaksi->peminjam_id;
        $validateData['nama_arsip'] = $transaksi->nama_arsip;
        $validateData['status'] = 'ditolak';
        $validateData['tanggal_peminjaman'] = $transaksi->tanggal_peminjaman;
        $validateData['tujuan_peminjam'] = $transaksi->tujuan_peminjam;
        $validateData['dokumen_pendukung'] = $transaksi->dokumen_pendukung;
        $validateData['jenis_arsip'] = $transaksi->jenis_arsip;

        Histori::create($validateData);

        $transaksi->delete();

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

    public function updateImb($id, Request $request)
    {
        // Ambil data IMB berdasarkan ID
        $imb = Imb::findOrFail($id);

        // Validasi data input
        $validateData = $request->validate([
            'nomor_dp' => 'required|numeric',
            'nama_pemilik' => 'nullable',
            'alamat' => 'nullable',
            'lokasi' => 'nullable',
            'box' => 'nullable',
            'keterangan' => 'nullable',
            'tahun' => 'nullable',
            'imbs' => 'nullable|string',
        ]);

        // Cek apakah ada file IMB baru yang diunggah
        if ($request->filled('imbs')) {
            // Hapus file lama jika ada
            if ($imb->imbs && Storage::disk('public')->exists('imbs/' . $imb->imbs)) {
                Storage::disk('public')->delete('imbs/' . $imb->imbs);
            }

            // Decode file PDF dari base64
            $base64Pdf = $request->input('imbs');
            $pdfContent = base64_decode(preg_replace('#^data:application/pdf;base64,#i', '', $base64Pdf));

            // Generate nama file baru
            $fileName = 'imb_' . $validateData['nomor_dp'] . '_' . $validateData['tahun'] . '_' . time() . '.pdf';
            $validateData['imbs'] = $fileName;

            // Simpan file baru ke storage
            Storage::disk('public')->put('imbs/' . $fileName, $pdfContent);
        } else {
            // Periksa apakah ada perubahan pada `nomor_dp` atau `tahun`
            $nomorDpChanged = $validateData['nomor_dp'] != $imb->nomor_dp;
            $tahunChanged = $validateData['tahun'] != $imb->tahun;

            if (($nomorDpChanged || $tahunChanged) && $imb->imbs) {
                $currentFileName = $imb->imbs;
                $currentPath = 'imbs/' . $currentFileName;

                $parts = explode('_', pathinfo($currentFileName, PATHINFO_FILENAME));

                if (count($parts) >= 4) {
                    // Format nama file baru
                    $newFileName = 'imb_' . $validateData['nomor_dp'] . '_' . $validateData['tahun'] . '_' . $parts[3] . '.' . pathinfo($currentFileName, PATHINFO_EXTENSION);

                    if (!Storage::disk('public')->exists('imbs/' . $newFileName)) {
                        // Rename file
                        Storage::disk('public')->move($currentPath, 'imbs/' . $newFileName);
                        $validateData['imbs'] = $newFileName;
                    } else {
                        // Tambahkan timestamp jika nama file baru sudah ada
                        $newFileName = 'imb_' . $validateData['nomor_dp'] . '_' . $validateData['tahun'] . '_' . time() . '.' . pathinfo($currentFileName, PATHINFO_EXTENSION);
                        Storage::disk('public')->move($currentPath, 'imbs/' . $newFileName);
                        $validateData['imbs'] = $newFileName;
                    }
                } else {
                    $validateData['imbs'] = $currentFileName;
                }
            } else {
                $validateData['imbs'] = $imb->imbs;
            }
        }

        // Update data IMB
        $imb->update($validateData);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'IMB berhasil diperbarui!');
    }



    public function deleteImb($id)
    {
        $imb = Imb::where('id', $id)->firstOrFail();
        // Ambil semua parameter query string saat ini
        $queryString = request()->query();

        if ($imb->imbs) {
            // dd($imb->imbs); 
            Storage::disk('public')->delete('imbs/' . $imb->imbs);
        }

        $imb->delete();

        return redirect()->route('admin.manajemenImb')->with('success', 'Data IMB berhasil dihapus!!');
        // return redirect()->route('management', $queryString)->with('success', 'Data IMB berhasil dihapus !!');
    }


    public function history() {}

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



    public function autocomplete(Request $request)
    {
        $query = $request->get('query');
        $results = Imb::where('nomor_dp', 'LIKE', '%' . $request . '%')
            ->orWhere('nama_pemilik', 'LIKE', '%' . $query . '%')
            ->pluck('nama_pemilik');
        return response()->json($results);
    }
}
