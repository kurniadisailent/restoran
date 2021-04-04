<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pelanggan;
use Carbon\Carbon;

class PelangganDaftarController extends Controller
{
    public function index()
    {
        return view('pelanggan.daftar.index');
    }

    public function prosses(Request $request)
    {
        $qrPassword = $request->username . Carbon::today()->format('y-m-d') . str_random(40);
        $request->validate([
            'email' => 'email|unique:tbl_pelanggan,email',
            'username' => 'unique:tbl_pelanggan,username'
        ]);
        Pelanggan::create([
            'nama_pelanggan' => $request->nama_pelanggan,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'QRpassword' => $qrPassword
        ]);
        return redirect()->route('pelanggan.login')->with('regis', 'Berhasil Daftar, Silahkan login');
    }
}