<?php

namespace App\Http\Controllers;


use App\Models\SK;
use Carbon\Carbon;
use App\Models\Imb;
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
        $jumlahSK = SK::count();
        $jumlahArsip2  = Arsip2::count();
        $jumlahArsip = $jumlahImb + $jumlahSK + $jumlahArsip2;

        // ambil transaksi peminjaman dengan status diperiksa
        $transaksiPending = TransaksiPeminjaman::with('peminjam')->where('status', 'diperiksa')->limit(5)->get();
        // dd($transaksiPending);

        return view('adminlayout/adminDashboard', [
            'title' => 'Admin dashboard',
            'active' => 'dashboard',
            'imb' => 'IMB',
            'sk' => 'SK',
            'arsip2' => 'Arsip 2',
        ], compact('jumlahPeminjam', 'jumlahArsip', 'jumlahImb', 'jumlahSK', 'jumlahArsip2', 'transaksiPending'));
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
        $items = Histori::with('Peminjam', 'Imb', 'SK', 'Arsip2')
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
        $dataImb = Imb::orderBy('tahun', 'asc')
            ->orderBy('nomor_dp', 'asc')
            ->paginate(15);

        return view('adminLayout.imb', [
            'title' => 'Management IMB',
            'active' => 'manajemen',
            'dataImb' => $dataImb,
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
        $data = TransaksiPeminjaman::with('peminjam', 'imb', 'SK', 'arsip2')->findOrFail($id);
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

                list($dp, $nama) = explode(' - ', $validateData['arsip'], 2);

                $arsip = imb::where('nomor_dp', $dp)->first();

                $validateData['imb_id'] = $arsip->id;
                $validateData['status'] = 'diacc';
            } elseif ($validateData['jenis_arsip'] == 'sk') {

                list($sk, $tahun) = explode(' - ', $validateData['arsip'], 2);

                $arsip = sk::where('nomor_sk', $sk)->first();

                $validateData['sk_id'] = $arsip->id;
                $validateData['status'] = 'diacc';
            }
        }

        $validateData['peminjam_id'] = $transaksi->peminjam_id;
        $validateData['nama_arsip'] = $transaksi->nama_arsip;
        $validateData['tanggal_peminjaman'] = $transaksi->tanggal_peminjaman;
        $validateData['tujuan_peminjam'] = $transaksi->tujuan_peminjam;
        $validateData['dokumen_pendukung'] = $transaksi->dokumen_pendukung;

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

    public function updateImb($id_imb, Request $request)
    {
        // Ambil data IMB berdasarkan ID atau gagal jika tidak ditemukan
        $imb = Imb::findOrFail($id_imb);

        // Validasi data yang diterima dari request
        $validateData = $request->validate([
            'nomor_dp' => 'required|numeric',
            'nama_pemilik' => 'required',
            'alamat' => 'required',
            'lokasi' => 'required',
            'box' => 'required',
            'keterangan' => 'nullable',
            'tahun' => 'required',
            'imbs' => 'nullable|string', // Asumsikan imbs dikirim sebagai string base64
        ]);

        $isFileUpdated = false;

        // Cek apakah ada file PDF baru yang diupload
        if ($request->filled('imbs')) {
            $isFileUpdated = true;

            // Jika ada file lama, hapus file tersebut
            if ($imb->imbs && Storage::disk('public')->exists('imbs/' . $imb->imbs)) {
                Storage::disk('public')->delete('imbs/' . $imb->imbs);
            }

            // Decode konten PDF dari base64
            $base64Pdf = $request->input('imbs');
            $pdfContent = base64_decode(preg_replace('#^data:application/pdf;base64,#i', '', $base64Pdf));

            // Buat nama file baru
            $fileName = 'imb_' . $validateData['nomor_dp'] . '_' . $validateData['tahun'] . '_' . time() . '.pdf';
            $validateData['imbs'] = $fileName;

            // Simpan file PDF ke storage
            Storage::disk('public')->put('imbs/' . $fileName, $pdfContent);
        } else {
            // Jika tidak ada file baru yang diupload, periksa apakah ada perubahan pada nomor_dp atau tahun
            $nomorDpChanged = $validateData['nomor_dp'] != $imb->nomor_dp;
            $tahunChanged = $validateData['tahun'] != $imb->tahun;

            if (($nomorDpChanged || $tahunChanged) && $imb->imbs) {
                // Extract nama file tanpa path
                $currentFileName = $imb->imbs;

                // Tentukan path saat ini dan path baru
                $currentPath = 'imbs/' . $currentFileName;

                // Pisahkan nama file berdasarkan underscore
                $parts = explode('_', pathinfo($currentFileName, PATHINFO_FILENAME));

                // Asumsikan format nama file adalah imb_nomor_dp_tahun_timestamp.pdf
                // Jadi, kita ambil nomor_dp dan tahun dari validateData
                if (count($parts) >= 4) { // memastikan ada cukup bagian
                    $newFileName = 'imb_' . $validateData['nomor_dp'] . '_' . $validateData['tahun'] . '_' . $parts[3] . '.' . pathinfo($currentFileName, PATHINFO_EXTENSION);

                    // Cek apakah file dengan nama baru sudah ada
                    if (!Storage::disk('public')->exists('imbs/' . $newFileName)) {
                        // Rename file di storage
                        Storage::disk('public')->move($currentPath, 'imbs/' . $newFileName);

                        // Update nama file di validateData
                        $validateData['imbs'] = $newFileName;
                    } else {
                        // Handle konflik nama file, misalnya dengan menambahkan timestamp atau memberikan error
                        // Berikut ini contoh menambahkan timestamp
                        $newFileName = 'imb_' . $validateData['nomor_dp'] . '_' . $validateData['tahun'] . '_' . time() . '.' . pathinfo($currentFileName, PATHINFO_EXTENSION);
                        Storage::disk('public')->move($currentPath, 'imbs/' . $newFileName);
                        $validateData['imbs'] = $newFileName;
                    }
                } else {
                    // Jika format nama file tidak sesuai, mungkin tambahkan log atau tangani sesuai kebutuhan
                    // Misalnya, tetap menggunakan nama file lama
                    $validateData['imbs'] = $currentFileName;
                }
            } else {
                // Jika tidak ada perubahan pada nomor_dp atau tahun, tetap gunakan nama file lama
                $validateData['imbs'] = $imb->imbs;
            }
        }

        // Update data IMB dengan data yang sudah divalidasi
        $imb->update($validateData);

        // Redirect dengan pesan <sukse></sukse>s
        return redirect()->back()->with('success', 'IMB Berhasil dirubah!!');
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

        return redirect()->route('admin.manajemenImb', $queryString)->with('success', 'Data IMB berhasil dihapus!!');
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
        $jenis = $request->get('jenis_arsip');

        if ($jenis == 'IMB') {

            $results = Imb::where('nomor_dp', 'LIKE', '%' . $query . '%')
                ->orWhere('nama_pemilik', 'LIKE', '%' . $query . '%')
                ->get(['nomor_dp', 'nama_pemilik']);

        } elseif($jenis == 'SK' ){
            
            $results = sk::where('nomor_sk', 'LIKE', '%' . $query . '%')
            ->orWhere('tahun', 'LIKE', '%' . $query . '%')
            ->get(['nomor_sk', 'tahun']);

        } 




        return response()->json($results);
    }
}
