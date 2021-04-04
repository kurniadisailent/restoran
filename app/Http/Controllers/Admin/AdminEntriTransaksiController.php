<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\Transaksi;

class AdminEntriTransaksiController extends Controller
{
    public function index(Request $request)
    {
        $result = Order::where('status','!=',"ORDER")->where('status','=',"SELESAI")
                        ->orWhere('status','=',"BELUM_BAYAR")
                        ->orderBy('id_order','DESC')->paginate(10);;
        return view('admin.entriTransaksi.index',['data'=>$result]);
    }

    public function StatusSelesai(Request $request)
    {
        $result = Order::where('status','=',"SELESAI")
                        ->orderBy('id_order','DESC')->paginate(10);
        return view('admin.entriTransaksi.index',['data'=>$result]);
    }

    public function StatusBelumbayar(Request $request)
    {
        $result = Order::where('status','=',"BELUM_BAYAR")
                        ->orderBy('id_order','DESC')->paginate(10);
        return view('admin.entriTransaksi.index',['data'=>$result]);
    }

    public function Cari(Request $request)
    {
        $result = Order::where('nama_pelanggan','like',"%{$request->keyword}%")->where('status','!=','SELESAI')
                        ->orWhere('kode_order','like',"%{$request->keyword}%")->where('status','!=','SELESAI')
                        ->orWhere('total_bayar','like',"%{$request->keyword}%")->where('status','!=','SELESAI')
                        ->orWhere('tanggal','like',"%{$request->keyword}%")->where('status','!=','SELESAI')
                        ->orderBy('id_order','DESC')->paginate(10);
        return view('admin.entriOrder.index',['data'=>$result]);
    }

    public function OpenPDF($kodeorder)
    {
        $lokasi_file_struk = public_path('/assets/struk_transaksi/' . $kodeorder .'.pdf');
        return response()->file($lokasi_file_struk);
        // return dd($lokasi_file_struk);
    }
}