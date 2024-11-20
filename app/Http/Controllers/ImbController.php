<?php

namespace App\Http\Controllers;

use App\Models\Imb;
use Illuminate\Http\Request;
use Psy\CodeCleaner\FunctionReturnInWriteContextPass;

class ImbController extends Controller
{
    //

public function search(Request $request)
    {
        $query = $request->input('query');
        $field = $request->input('field');

        $active = 'manajemen';

        // Cek jika field dan query kosong
        if ((!$request->filled('query') && !$request->filled('field')) || ((!$request->filled('query') && $request->filled('field')))) {
            // Jika tidak ada isian query atau field, kembali ke halaman management
            return redirect()->to('/admin/imb');
        }

        // Lakukan pencarian berdasarkan field yang dipilih
        if ($request->filled('query') && $request->filled('field')) {
            $dataImb = Imb::where($field, 'like', '%' . $query . '%')->orderBy('nomor_dp', 'asc')->paginate()->withQueryString();
        } elseif ($request->filled('query')) {
            // Jika hanya query yang terisi, cari semua data
            $dataImb = Imb::where('nomor_dp', 'like', '%' . $query . '%')
                ->orWhere('nama_pemilik', 'like', '%' . $query . '%')
                ->orWhere('alamat', 'like', '%' . $query . '%')
                ->orWhere('lokasi', 'like', '%' . $query . '%')
                ->orWhere('box', 'like', '%' . $query . '%')
                ->orWhere('keterangan', 'like', '%' . $query . '%')
                ->orWhere('tahun', 'like', '%' . $query . '%')
                ->orderBy('nomor_dp', 'asc')->paginate()->withQueryString();
        }

        $title = 'Data IMB';

        return view('adminLayout.imb', compact('dataImb', 'title','active'));
    }

    public function printAll(Request $request)
    {

        $query = $request->input('query');
        $field = $request->input('field');

        // Pastikan $field tidak kosong dan valid
        if ($field && $query) {
            // Lakukan pencarian dengan filter yang diberikan
            $dataImb = Imb::where($field, 'like', '%' . $query . '%')
                ->orderBy('tahun', 'asc')
                ->orderBy('nomor_dp', 'asc')
                ->get();
        } elseif ($request->filled('query')) {
            // Jika hanya query yang terisi, cari semua data berdasarkan query
            $dataImb = Imb::where('nomor_dp', 'like', '%' . $query . '%')
                ->orWhere('nama_pemilik', 'like', '%' . $query . '%')
                ->orWhere('alamat', 'like', '%' . $query . '%')
                ->orWhere('lokasi', 'like', '%' . $query . '%')
                ->orWhere('box', 'like', '%' . $query . '%')
                ->orWhere('keterangan', 'like', '%' . $query . '%')
                ->orWhere('tahun', 'like', '%' . $query . '%')
                ->orderBy('nomor_dp', 'asc')->get();
        } else {
            $dataImb = Imb::orderBy('tahun', 'asc')
                ->orderBy('nomor_dp', 'asc')->get();
        }

        // Menampilkan view yang sudah diformat untuk print
        return view('imb_print', compact('dataImb'));
    }
}
