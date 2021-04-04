<?php

namespace App\Http\Controllers\Waiter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Waiter;
use Auth;
use Image;
class WaiterPengaturanAkunController extends Controller
{
    public function index()
    {
        $data = Waiter::where('id_waiter', Auth::guard('waiter')->user()->id_waiter)->get()->first();
        return view('waiter.pengaturanakun.index', ['data' => $data]);
    }

    public function update(Request $request)
    {
        //lokasi file foto di simpan
        $lokasi_file = public_path('/assets/foto_waiter');
        $waiteraccount = Waiter::where('id_waiter', Auth::guard('waiter')->user()->id_waiter)->get()->first();
        if (!empty($request->file_foto_waiter)) {
            //Resize foto waiter
            $foto_waiter = $request->file('file_foto_waiter');
            //rewrite nama waiter
            $nama_waiter = preg_replace('/\s+/', '', $request->nama_waiter);
            //end rewrite nama waiter
            $nama_foto_waiter = $nama_waiter . time() . '.' . $foto_waiter->getClientOriginalExtension();
            $resize_foto_waiter = Image::make($foto_waiter->getRealPath());
            $resize_foto_waiter->resize(150, 150)->save($lokasi_file . '/' . $nama_foto_waiter);
            //End resize foto waiter
            if ($request->username == $waiteraccount->username) {
                $request->validate([
                    'email' => 'email',
                ]);
                if ($request->password == NULL) {
                    $query = [
                        'file_foto_waiter' => $nama_foto_waiter,
                        'nama_waiter' => $request->nama_waiter,
                        'jenis_kelamin' => $request->jenis_kelamin,
                        'alamat' => $request->alamat,
                        'no_hp' => $request->no_hp,
                        'email' => $request->email,
                        'username' => $request->username,
                    ];
                } else {
                    $query = [
                        'file_foto_waiter' => $nama_foto_waiter,
                        'nama_waiter' => $request->nama_waiter,
                        'jenis_kelamin' => $request->jenis_kelamin,
                        'alamat' => $request->alamat,
                        'no_hp' => $request->no_hp,
                        'email' => $request->email,
                        'username' => $request->username,
                        'password' => bcrypt($request->password),
                    ];
                }
                $waiteraccount->update($query);
                return redirect()->route('waiter.pengaturanakun')->with('sukses', 'Perubahan telah disimpan !');
            } else {
                $request->validate([
                    'username' => 'unique:tbl_waiter,username',
                    'email' => 'email',
                ]);
                if ($request->password == NULL) {
                    $query = [
                        'file_foto_waiter' => $nama_foto_waiter,
                        'nama_waiter' => $request->nama_waiter,
                        'jenis_kelamin' => $request->jenis_kelamin,
                        'alamat' => $request->alamat,
                        'no_hp' => $request->no_hp,
                        'email' => $request->email,
                        'username' => $request->username,
                    ];
                } else {
                    $query = [
                        'file_foto_waiter' => $nama_foto_waiter,
                        'nama_waiter' => $request->nama_waiter,
                        'jenis_kelamin' => $request->jenis_kelamin,
                        'alamat' => $request->alamat,
                        'no_hp' => $request->no_hp,
                        'email' => $request->email,
                        'username' => $request->username,
                        'password' => bcrypt($request->password),
                    ];
                }
                $waiteraccount->update($query);
                return redirect()->route('waiter.pengaturanakun')->with('sukses', 'Perubahan telah disimpan !');
            }
        } else {
            if ($request->username == $waiteraccount->username) {
                $request->validate([
                    'email' => 'email',
                ]);
                if ($request->password == NULL) {
                    $query = [
                        'nama_waiter' => $request->nama_waiter,
                        'jenis_kelamin' => $request->jenis_kelamin,
                        'alamat' => $request->alamat,
                        'no_hp' => $request->no_hp,
                        'email' => $request->email,
                        'username' => $request->username,
                    ];
                } else {
                    $query = [
                        'nama_waiter' => $request->nama_waiter,
                        'jenis_kelamin' => $request->jenis_kelamin,
                        'alamat' => $request->alamat,
                        'no_hp' => $request->no_hp,
                        'email' => $request->email,
                        'username' => $request->username,
                        'password' => bcrypt($request->password),
                    ];
                }
                $waiteraccount->update($query);
                return redirect()->route('waiter.pengaturanakun')->with('sukses', 'Perubahan telah disimpan !');
            } else {
                $request->validate([
                    'username' => 'unique:tbl_waiter,username',
                    'email' => 'email',
                ]);
                if ($request->password == NULL) {
                    $query = [
                        'nama_waiter' => $request->nama_waiter,
                        'jenis_kelamin' => $request->jenis_kelamin,
                        'alamat' => $request->alamat,
                        'no_hp' => $request->no_hp,
                        'email' => $request->email,
                        'username' => $request->username,
                    ];
                } else {
                    $query = [
                        'nama_waiter' => $request->nama_waiter,
                        'jenis_kelamin' => $request->jenis_kelamin,
                        'alamat' => $request->alamat,
                        'no_hp' => $request->no_hp,
                        'email' => $request->email,
                        'username' => $request->username,
                        'password' => bcrypt($request->password),
                    ];
                }
                $waiteraccount->update($query);
                return redirect()->route('waiter.pengaturanakun')->with('sukses', 'Perubahan telah disimpan !');
            }
        }
    }
}
