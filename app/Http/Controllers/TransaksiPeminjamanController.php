<?php

namespace App\Http\Controllers;

use App\Models\SK;
use App\Models\Imb;
use App\Models\TransaksiPeminjaman;
use Illuminate\Http\Request;

class TransaksiPeminjamanController extends Controller
{
    //

    public function create(Request $request)
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

    public function autocomplete(Request $request)
    {
        $query = $request->get('query');
        $jenis = $request->get('jenis_arsip');

        if ($jenis == 'IMB') {

            $results = Imb::where('nomor_dp', 'LIKE', '%' . $query . '%')
                ->orWhere('tahun', 'LIKE', '%' . $query . '%')
                ->orWhere('nama_pemilik', 'LIKE', '%' . $query . '%')
                ->get(['nomor_dp', 'tahun', 'nama_pemilik']);
        } elseif ($jenis == 'SK') {

            $results = sk::where('nomor_sk', 'LIKE', '%' . $query . '%')
                ->orWhere('tahun', 'LIKE', '%' . $query . '%')
                ->get(['nomor_sk', 'tahun']);
        }

        return response()->json($results);
    }
}
