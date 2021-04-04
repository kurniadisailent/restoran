<?php

namespace App\Http\Controllers\Owner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Owner;
use Auth;

class OwnerLoginController extends Controller
{
    public function getLogin()
    {
        return view('owner.login.index');
    }

    public function postLogin(Request $request)
    {
  
        // validasi
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard('owner')->attempt(['username' => $request->username, 'password' => $request->password])) {
            // Pindah ke halaman dashboard
            return redirect()->intended('owner/dashboard');
        }else{
            return redirect()->route('owner.login')->with('gagal','Username atau Password salah');
        }

    }

    public function logout()
    {
        if (Auth::guard('owner')->check()) {
            Auth::guard('owner')->logout();
        } 
        return redirect('owner/login');
    }
}
