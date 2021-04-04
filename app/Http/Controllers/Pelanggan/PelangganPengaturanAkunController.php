<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pelanggan;
use Carbon\Carbon;
use Auth;
use QrCode;
class PelangganPengaturanAkunController extends Controller
{
    public function index()
    {
        $pelanggan = Pelanggan::where('id_pelanggan',Auth::guard('pelanggan')->user()->id_pelanggan)->get()->first();
        return view('pelanggan.pengaturanakun.index',[
            'id_pelanggan'=>$pelanggan->id_pelanggan,
            'nama_pelanggan'=>$pelanggan->nama_pelanggan,
            'email'=>$pelanggan->email,
            'username'=>$pelanggan->username,
            'qrpassword'=>$pelanggan->QRpassword,
        ]);
    }

    public function proses(Request $request)
    {
        $pelanggan = Pelanggan::where('id_pelanggan',Auth::guard('pelanggan')->user()->id_pelanggan)->get()->first();
        if($request->username == $pelanggan->username)
        {
            $request->validate([
                'email'=>'email',
            ]);
            if($request->password == NULL)
            {
                $query = [
                    'nama_pelanggan'=>$request->nama_pelanggan,
                    'username'=>$request->username,
                    'email'=>$request->email,
                ];
            }else
            {
                $query = [
                    'nama_pelanggan'=>$request->nama_pelanggan,
                    'username'=>$request->username,
                    'email'=>$request->email,
                    'password'=>bcrypt($request->password)
                ];
            }
            $pelanggan->update($query);
            return redirect()->route('pelanggan.pengaturan')->with('sukses','Berhasil Data telah di update !');
        }else{
            $request->validate([
                'username'=>'unique:tbl_pelanggan,username',
                'email'=>'email',
            ]);
            if($request->password == NULL)
            {
                $query = [
                    'nama_pelanggan'=>$request->nama_pelanggan,
                    'username'=>$request->username,
                    'email'=>$request->email,
                ];
            }else
            {
                $query = [
                    'nama_pelanggan'=>$request->nama_pelanggan,
                    'username'=>$request->username,
                    'email'=>$request->email,
                    'password'=>bcrypt($request->password)
                ];
            }
            $pelanggan->update($query);
            return redirect()->route('pelanggan.pengaturan')->with('sukses','Berhasil Data telah di update !');
        }
    }

    public function generate()
    {
        $pelanggan = Pelanggan::where('id_pelanggan',Auth::guard('pelanggan')->user()->id_pelanggan)->get()->first();
        $pelanggan->update([
            'QRpassword'=>$pelanggan->username.Carbon::today()->format('y-m-d').str_random(40)
        ]);
        return redirect()->route('pelanggan.pengaturan')->with('sukses','QR Code Berhasil di ubah!');
    }

    public function QrDownload()
    {
        $pelanggan = Pelanggan::where('id_pelanggan',Auth::guard('pelanggan')->user()->id_pelanggan)->get()->first();
        $image = QrCode::format('png')
            ->size(200)->errorCorrection('H')
            ->generate($pelanggan->QRpassword);
        return response($image)->header('Content-type','image/png');

    }
}