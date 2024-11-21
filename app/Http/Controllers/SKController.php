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
}
