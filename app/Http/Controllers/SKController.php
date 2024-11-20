<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SKController extends Controller
{
    //
    // SK

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

        dd($validateData);

        return view('adminLayout.adminDashboard');
    }
}
