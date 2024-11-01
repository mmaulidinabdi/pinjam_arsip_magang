<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjam;
use Illuminate\Support\Facades\Storage;

class PeminjamController extends Controller
{
    //

    public function index(){
        return view('userDashboard',['title'=>'User Dashboard']);
    }

    public function userProfile(){
        return view('userProfile',['title' => 'Profile']);
    }

    public function userPeminjaman(){
        return view('userPeminjaman',['title'=>'Form Peminjaman']);
    }

    public function update(Request $request, Peminjam $peminjam){
        $validateData = $request->validate([
            'nama_lengkap' => 'required|max:255',
            'alamat' => 'required',
            'no_telp' => 'required',
            'email' => 'required|email',
            'ktp' => 'nullable'
        ]);


        if($request->file('ktp')){
            if($peminjam->ktp){
                Storage::disk('public')->delete($peminjam->ktp);
            }
            $validateData['ktp'] = $request->file('ktp')->store('ktp', 'public');
        }

        Peminjam::where('id', $peminjam->id)->update($validateData);
        
        // Peminjam::create($validateData);

        return redirect('/user/profile')->with('success', 'Data Disimpan');
    }

    public function userHistory(){
        return view('userhistory',['title'=>'User History']);
    }
}
