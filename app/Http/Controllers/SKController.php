<?php

namespace App\Http\Controllers;

use App\Models\SK;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SKController extends Controller
{
    //
    // SK
    public function manajemenSK()
    {
        $dataSK = SK::orderBy('tahun', 'asc')
            ->orderBy('nomor_sk')
            ->paginate(15);

        return view('adminLayout.sk', [
            'title' => 'Manajemen SK',
            'dataSK' => $dataSK,
            'active' => 'manajemen'
        ]);
    }

    public function viewTambahSK()
    {
        return view('adminLayout.tambahSK', [
            'title' => 'Input SK',
            'active' => 'tambahArsip'
        ]);
    }

    public function tambahSK(Request $request)
    {
        $validateData = $request->validate([
            'nomor_sk' => 'required|numeric',
            'tahun' => 'nullable',
            'tanggal_penetapan' => 'required|date',
            'tentang' => 'nullable',
            'sk' => 'nullable'
        ]);

        // ganti format tanggal
        $originalDate = $request['tanggal_penetapan'];
        // konversi tanggal
        $formattedDate = date('Y-m-d', strtotime($originalDate));
        // ganti nilai  tanggal_penetapan di request
        $validateData['tanggal_penetapan'] = $formattedDate;


        // decode
        $base64Pdf = $request->input('sk');
        $pdfContent = base64_decode(preg_replace('#^data:application/pdf;base64,#i', '', $base64Pdf));

        // Simpan file ke storage Laravel (atau folder tertentu)
        $fileName = 'sk_' . $request['nomor_sk'] . '_' . $request['tahun'] . '_' . time() . '.pdf';
        $validateData['sk'] = $fileName;

        Storage::disk('public')->put('sk/' . $fileName, $pdfContent);

        SK::create($validateData);

        return redirect()->route('admin.manajemenSK')->with('success', 'Data Berhasil Masuk!! ');
    }

    public function show($name)
    {
        $path = storage_path('app/public/sk/' . $name);

        return response()->file($path, [
            'Content-Type' => 'application/pdf'
        ]);
    }

    // edit sk
    public function updateSK($id, Request $request)
    {
        $sk = SK::findOrFail($id);

        $validateData = $request->validate([
            'nomor_sk' => 'required|numeric',
            'tahun' => 'nullable',
            'tanggal_penetapan' => 'required|date',
            'tentang' => 'nullable',
            'sk' => 'nullable'
        ]);

        // ganti format tanggal
        $originalDate = $request['tanggal_penetapan'];
        // konversi tanggal
        $formattedDate = date('Y-m-d', strtotime($originalDate));
        // ganti nilai  tanggal_penetapan di request
        $validateData['tanggal_penetapan'] = $formattedDate;

        $isFileUpdated = false;

        // Cek apakah ada file PDF baru yang diupload
        if ($request->filled('sk')) {
            $isFileUpdated = true;

            // Jika ada file lama, hapus file tersebut
            if ($sk->sk && Storage::disk('public')->exists('sk/' . $sk->sk)) {
                Storage::disk('public')->delete('sk/' . $sk->sk);
            }

            // Decode konten PDF dari base64
            $base64Pdf = $request->input('sk');
            $pdfContent = base64_decode(preg_replace('#^data:application/pdf;base64,#i', '', $base64Pdf));

            // Buat nama file baru
            $fileName = 'sk_' . $validateData['nomor_sk'] . '_' . $validateData['tahun'] . '_' . time() . '.pdf';
            $validateData['sk'] = $fileName;

            // Simpan file PDF ke storage
            Storage::disk('public')->put('sk/' . $fileName, $pdfContent);
        } else {
            // Jika tidak ada file baru yang diupload, periksa apakah ada perubahan pada nomor_dp atau tahun
            $nomorDpChanged = $validateData['nomor_sk'] != $sk->nomor_sk;
            $tahunChanged = $validateData['tahun'] != $sk->tahun;

            if (($nomorDpChanged || $tahunChanged) && $sk->sk) {
                // Extract nama file tanpa path
                $currentFileName = $sk->sk;

                // Tentukan path saat ini dan path baru
                $currentPath = 'sk/' . $currentFileName;

                // Pisahkan nama file berdasarkan underscore
                $parts = explode('_', pathinfo($currentFileName, PATHINFO_FILENAME));

                // Asumsikan format nama file adalah imb_nomor_dp_tahun_timestamp.pdf
                // Jadi, kita ambil nomor_dp dan tahun dari validateData
                if (count($parts) >= 4) { // memastikan ada cukup bagian
                    $newFileName = 'imb_' . $validateData['nomor_dp'] . '_' . $validateData['tahun'] . '_' . $parts[3] . '.' . pathinfo($currentFileName, PATHINFO_EXTENSION);

                    // Cek apakah file dengan nama baru sudah ada
                    if (!Storage::disk('public')->exists('sk/' . $newFileName)) {
                        // Rename file di storage
                        Storage::disk('public')->move($currentPath, 'sk/' . $newFileName);

                        // Update nama file di validateData
                        $validateData['sk'] = $newFileName;
                    } else {
                        // Handle konflik nama file, misalnya dengan menambahkan timestamp atau memberikan error
                        // Berikut ini contoh menambahkan timestamp
                        $newFileName = 'imb_' . $validateData['nomor_dp'] . '_' . $validateData['tahun'] . '_' . time() . '.' . pathinfo($currentFileName, PATHINFO_EXTENSION);
                        Storage::disk('public')->move($currentPath, 'sk/' . $newFileName);
                        $validateData['sk'] = $newFileName;
                    }
                } else {
                    // Jika format nama file tidak sesuai, mungkin tambahkan log atau tangani sesuai kebutuhan
                    // Misalnya, tetap menggunakan nama file lama
                    $validateData['sk'] = $currentFileName;
                }
            } else {
                // Jika tidak ada perubahan pada nomor_dp atau tahun, tetap gunakan nama file lama
                $validateData['sk'] = $sk->sk;
            }
        }

        // Update data IMB dengan data yang sudah divalidasi
        $sk->update($validateData);

        // Redirect dengan pesan <sukse></sukse>s
        return redirect()->back()->with('success', 'SK Berhasil dirubah!!');
    }

    // hapus SK
    public function deleteSK($id)
    {
        $sk = SK::where('id', $id)->firstOrFail();

        // ambil semua querystring saat ini
        $queryString = request()->query();

        if ($sk->sk) {
            Storage::disk('public')->delete('sk/' . $sk->sk);
        }

        $sk->delete();
        return redirect()->route('admin.manajemenSK', $queryString)->with('success', 'Data SK berhasil dihapus!!');
    }


    public function search(Request $request)
    {
        $query = $request->input('query');
        $field = $request->input('field');

        $active = 'manajemen';

        // Cek jika field dan query kosong
        if ((!$request->filled('query') && !$request->filled('field')) || ((!$request->filled('query') && $request->filled('field')))) {
            // Jika tidak ada isian query atau field, kembali ke halaman management
            return redirect()->to('/admin/sk');
        }

        // Lakukan pencarian berdasarkan field yang dipilih
        if ($request->filled('query') && $request->filled('field')) {
            $dataSK = SK::where($field, 'like', '%' . $query . '%')->orderBy('nomor_sk', 'asc')->paginate()->withQueryString();
        } elseif ($request->filled('query')) {
            // Jika hanya query yang terisi, cari semua data
            $dataSK = SK::where('nomor_sk', 'like', '%' . $query . '%')
                ->orWhere('tahun', 'like', '%' . $query . '%')
                ->orWhere('tanggal_penetapan', 'like', '%' . $query . '%')
                ->orWhere('tentang', 'like', '%' . $query . '%')
                ->paginate()->withQueryString();
        }

        $title = 'Data SK';

        return view('adminLayout.sk', compact('dataSK', 'title', 'active'));
    }

    public function printAll(Request $request)
    {
        $query = $request->input('query');
        $field = $request->input('field');

        // Pastikan $field tidak kosong dan valid
        if ($field && $query) {
            // Lakukan pencarian dengan filter yang diberikan
            $dataSK = SK::where($field, 'like', '%' . $query . '%')
                ->orderBy('tahun', 'asc')
                ->orderBy('nomor_sk', 'asc')
                ->get();
        } elseif ($request->filled('query')) {
            // Jika hanya query yang terisi, cari semua data berdasarkan query
            $dataSK = SK::where('nomor_sk', 'like', '%' . $query . '%')
                ->orWhere('tahun', 'like', '%' . $query . '%')
                ->orWhere('tanggal_penetapan', 'like', '%' . $query . '%')
                ->orWhere('tentang', 'like', '%' . $query . '%')
                ->get();
        } else {
            $dataSK = SK::orderBy('tahun', 'asc')
                ->orderBy('nomor_sk', 'asc')->get();
        }

        // Menampilkan view yang sudah diformat untuk print
        return view('sk_print', compact('dataSK'));
    }
}
