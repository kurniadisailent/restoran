<?php

namespace App\Http\Controllers\Waiter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Waiter;
use Auth;

class WaiterLoginController extends Controller
{
    public function getLogin()
    {
        return view('waiter.login.index');
    }

    public function postLogin(Request $request)
    {

        // validasi
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard('waiter')->attempt(['username' => $request->username, 'password' => $request->password, 'status' => 'Aktif'])) {
            // Pindah ke halaman dashboard
            return redirect()->intended('waiter/');
        } else {
            return redirect()->route('waiter.login')->with('gagal', 'Username atau Password salah');
        }
    }

    public function logout()
    {
        if (Auth::guard('waiter')->check()) {
            Auth::guard('waiter')->logout();
        }
        return redirect('waiter/login');
    }
}
