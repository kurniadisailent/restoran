<?php
 
namespace App\Http\Controllers\Admin;
 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin;
use Auth;
 
class AdminLoginController extends Controller
{
    public function getLogin()
    {
        return view('admin.login.index');
    }
 
    public function postLogin(Request $request)
    {
 
        // validasi
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);
 
        if (Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password])) {
            // Pindah ke halaman dashboard
            return redirect()->intended('admin/dashboard');
        }else{
            return redirect()->route('admin.login')->with('gagal','Username atau Password salah');
        }
 
    }
 
    public function logout()
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } 
        return redirect('admin/login');
    }
}
 