<?php

namespace App\Http\Controllers\Kasir;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Kasir;
use Auth;

class KasirLoginController extends Controller
{
    public function getLogin()
    {
        return view('kasir.login.index');
    }

    public function postLogin(Request $request)
    {

        // validasi
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard('kasir')->attempt(['username' => $request->username, 'password' => $request->password, 'status' => 'Aktif'])) {
            // Pindah ke halaman dashboard
            return redirect()->intended('kasir/');
        } else {
            return redirect()->route('kasir.login')->with('gagal', 'Username atau Password salah');
        }
    }

    public function logout()
    {
        if (Auth::guard('kasir')->check()) {
            Auth::guard('kasir')->logout();
        }
        return redirect('kasir/login');
    }
}
