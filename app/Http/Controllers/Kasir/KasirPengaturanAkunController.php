<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kasir;
use Auth;
use Image;
class KasirPengaturanAkunController extends Controller
{
    public function index()
    {
        $data = Kasir::where('id_kasir', Auth::guard('kasir')->user()->id_kasir)->get()->first();
        return view('kasir.pengaturanakun.index', ['data' => $data]);
    }

    public function update(Request $request)
    {
        //lokasi file foto di simpan
        $lokasi_file = public_path('/assets/foto_kasir');
        $kasiraccount = Kasir::where('id_kasir', Auth::guard('kasir')->user()->id_kasir)->get()->first();
        if (!empty($request->file_foto_kasir)) {
            //Resize foto kasir
            $foto_kasir = $request->file('file_foto_kasir');
            //rewrite nama kasir
            $nama_kasir = preg_replace('/\s+/', '', $request->nama_kasir);
            //end rewrite nama kasir
            $nama_foto_kasir = $nama_kasir . time() . '.' . $foto_kasir->getClientOriginalExtension();
            $resize_foto_kasir = Image::make($foto_kasir->getRealPath());
            $resize_foto_kasir->resize(150, 150)->save($lokasi_file . '/' . $nama_foto_kasir);
            //End resize foto kasir
            if ($request->username == $kasiraccount->username) {
                $request->validate([
                    'email' => 'email',
                ]);
                if ($request->password == NULL) {
                    $query = [
                        'file_foto_kasir' => $nama_foto_kasir,
                        'nama_kasir' => $request->nama_kasir,
                        'jenis_kelamin' => $request->jenis_kelamin,
                        'alamat' => $request->alamat,
                        'no_hp' => $request->no_hp,
                        'email' => $request->email,
                        'username' => $request->username,
                    ];
                } else {
                    $query = [
                        'file_foto_kasir' => $nama_foto_kasir,
                        'nama_kasir' => $request->nama_kasir,
                        'jenis_kelamin' => $request->jenis_kelamin,
                        'alamat' => $request->alamat,
                        'no_hp' => $request->no_hp,
                        'email' => $request->email,
                        'username' => $request->username,
                        'password' => bcrypt($request->password),
                    ];
                }
                $kasiraccount->update($query);
                return redirect()->route('kasir.pengaturanakun')->with('sukses', 'Perubahan telah disimpan !');
            } else {
                $request->validate([
                    'username' => 'unique:tbl_kasir,username',
                    'email' => 'email',
                ]);
                if ($request->password == NULL) {
                    $query = [
                        'file_foto_kasir' => $nama_foto_kasir,
                        'nama_kasir' => $request->nama_kasir,
                        'jenis_kelamin' => $request->jenis_kelamin,
                        'alamat' => $request->alamat,
                        'no_hp' => $request->no_hp,
                        'email' => $request->email,
                        'username' => $request->username,
                    ];
                } else {
                    $query = [
                        'file_foto_kasir' => $nama_foto_kasir,
                        'nama_kasir' => $request->nama_kasir,
                        'jenis_kelamin' => $request->jenis_kelamin,
                        'alamat' => $request->alamat,
                        'no_hp' => $request->no_hp,
                        'email' => $request->email,
                        'username' => $request->username,
                        'password' => bcrypt($request->password),
                    ];
                }
                $kasiraccount->update($query);
                return redirect()->route('kasir.pengaturanakun')->with('sukses', 'Perubahan telah disimpan !');
            }
        } else {
            if ($request->username == $kasiraccount->username) {
                $request->validate([
                    'email' => 'email',
                ]);
                if ($request->password == NULL) {
                    $query = [
                        'nama_kasir' => $request->nama_kasir,
                        'jenis_kelamin' => $request->jenis_kelamin,
                        'alamat' => $request->alamat,
                        'no_hp' => $request->no_hp,
                        'email' => $request->email,
                        'username' => $request->username,
                    ];
                } else {
                    $query = [
                        'nama_kasir' => $request->nama_kasir,
                        'jenis_kelamin' => $request->jenis_kelamin,
                        'alamat' => $request->alamat,
                        'no_hp' => $request->no_hp,
                        'email' => $request->email,
                        'username' => $request->username,
                        'password' => bcrypt($request->password),
                    ];
                }
                $kasiraccount->update($query);
                return redirect()->route('kasir.pengaturanakun')->with('sukses', 'Perubahan telah disimpan !');
            } else {
                $request->validate([
                    'username' => 'unique:tbl_kasir,username',
                    'email' => 'email',
                ]);
                if ($request->password == NULL) {
                    $query = [
                        'nama_kasir' => $request->nama_kasir,
                        'jenis_kelamin' => $request->jenis_kelamin,
                        'alamat' => $request->alamat,
                        'no_hp' => $request->no_hp,
                        'email' => $request->email,
                        'username' => $request->username,
                    ];
                } else {
                    $query = [
                        'nama_kasir' => $request->nama_kasir,
                        'jenis_kelamin' => $request->jenis_kelamin,
                        'alamat' => $request->alamat,
                        'no_hp' => $request->no_hp,
                        'email' => $request->email,
                        'username' => $request->username,
                        'password' => bcrypt($request->password),
                    ];
                }
                $kasiraccount->update($query);
                return redirect()->route('kasir.pengaturanakun')->with('sukses', 'Perubahan telah disimpan !');
            }
        }
    }
}
