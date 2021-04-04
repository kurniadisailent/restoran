<?php

namespace App\Http\Controllers\Pelanggan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pelanggan;
use Auth;

class PelangganLoginController extends Controller
{
    public function getLogin()
    {
        return view('pelanggan.login.index');
    }

    public function postLogin(Request $request)
    {
  
        // validasi
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard('pelanggan')->attempt(['username' => $request->username, 'password' => $request->password])) {
            // Pindah ke halaman dashboard
            return redirect()->intended('pelanggan/home');
        }else{
            return redirect()->route('pelanggan.login')->with('gagal','Username atau Password salah');
        }

    }

    public function postLoginQr(Request $request)
    {
        $pelanggan = Pelanggan::where('QRpassword',$request->qrcode)->first();

        if(empty($pelanggan))
        {
            return redirect()->route('pelanggan.login')->with('gagal','Username atau Password salah');
        }else
        {
            Auth::guard('pelanggan')->login($pelanggan);
            return redirect()->intended('pelanggan/home');
        }
        
        // if(Auth::guard('pelanggan')->loginUsingId($pelanggan->id_pelanggan)) {
        //     // Pindah ke halaman dashboard
            
        // }
        // return dd($request->qrcode);
    }

    public function logout()
    {
        if (Auth::guard('pelanggan')->check()) {
            Auth::guard('pelanggan')->logout();
        } 
        return redirect('/');
    }
}