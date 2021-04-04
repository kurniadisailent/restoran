<?php

namespace App\Http\Controllers\Kasir;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
use App\Order;
Use App\DetailOrder;
use App\Laporan;
use App\Transaksi;
Use Carbon\Carbon;
use App\Meja;
use PDF;

class KasirTransaksiController extends Controller
{
    public function order(Request $request)
    {
        $data = DB::table('tbl_detail_order')->where('kode_order','=',$request->kode_order)->where('status','=','BELUM_BAYAR');
        $data = $data->get();
        $id_order = DB::table('tbl_order')->select('id_order')->where('kode_order','=',$request->kode_order)->where('status','=','BELUM_BAYAR');
        $id_order = $id_order->pluck('id_order');
        $id_pelanggan = DB::table('tbl_order')->select('id_pelanggan')->where('kode_order','=',$request->kode_order)->where('status','=','BELUM_BAYAR');
        $id_pelanggan = $id_pelanggan->pluck('id_pelanggan')->first();
        $jumlah_bayar = DB::table('tbl_detail_order')->where('kode_order','=', $request->kode_order)->where('status','=','BELUM_BAYAR')->sum('total_bayar');
        $namapemesan = DB::table('tbl_order')->select('nama_pelanggan')->where('kode_order','=', $request->kode_order)->where('status','=','BELUM_BAYAR')->pluck('nama_pelanggan')->first();
        $kode_order = $request->kode_order;
        $jumlah_menu_dipesan = DB::table('tbl_detail_order')->where('kode_order','=', $request->kode_order)->where('status','=','BELUM_BAYAR')->sum('jumlah_pesan');
        $nomeja = DB::table('tbl_detail_order')->select('no_meja')->where('kode_order','=', $request->kode_order)->where('status','=','BELUM_BAYAR')->pluck('no_meja')->first();
        return view('kasir.transaksi.index',[
            'data'=>$data,
            'jumlah_bayar'=>$jumlah_bayar,
            'nomeja'=>$nomeja,
            'namapemesan'=>$namapemesan,
            'kode_order'=>$kode_order,
            'id_order'=>$id_order,
            'id_pelanggan'=>$id_pelanggan,
            'jumlah_menu_dipesan'=>$jumlah_menu_dipesan]);

        // return dd($id_pelanggan);
    }

    public function CariKodeOrder(Request $request)
    {
        $data = DB::table('tbl_detail_order')->where('kode_order','=',$request->kode_order)->where('status','=','BELUM_BAYAR');
        $data = $data->get();
        $id_order = DB::table('tbl_order')->select('id_order')->where('kode_order','=',$request->kode_order)->where('status','=','BELUM_BAYAR');
        $id_order = $id_order->pluck('id_order')->first();
        $id_pelanggan = DB::table('tbl_order')->select('id_pelanggan')->where('kode_order','=',$request->kode_order)->where('status','=','BELUM_BAYAR');
        $id_pelanggan = $id_pelanggan->pluck('id_pelanggan')->first();
        $jumlah_bayar = DB::table('tbl_detail_order')->where('kode_order','=', $request->kode_order)->where('status','=','BELUM_BAYAR')->sum('total_bayar');
        $namapemesan = DB::table('tbl_order')->select('nama_pelanggan')->where('kode_order','=', $request->kode_order)->where('status','=','BELUM_BAYAR')->pluck('nama_pelanggan')->first();
        $kode_order = $request->kode_order;
        $jumlah_menu_dipesan = DB::table('tbl_detail_order')->where('kode_order','=', $request->kode_order)->where('status','=','BELUM_BAYAR')->sum('jumlah_pesan');
        $nomeja = DB::table('tbl_detail_order')->select('no_meja')->where('kode_order','=', $request->kode_order)->where('status','=','BELUM_BAYAR')->pluck('no_meja')->first();
        // return dd($jumlah_menu_dipesan);
        return view('kasir.transaksi.index',[
            'data'=>$data,
            'jumlah_bayar'=>$jumlah_bayar,
            'nomeja'=>$nomeja,
            'namapemesan'=>$namapemesan,
            'kode_order'=>$kode_order,
            'id_order'=>$id_order,
            'id_pelanggan'=>$id_pelanggan,
            'jumlah_menu_dipesan'=>$jumlah_menu_dipesan]);

        // return dd($id_pelanggan);
    }

    // public function FromEntri(Request $request)
    // {
    //     $data = DB::table('tbl_detail_order')->where('kode_order','=',$request->kode_order)->where('status','=','BELUM_BAYAR');
    //     $data = $data->get();
    //     $id_order = DB::table('tbl_order')->select('id_order')->where('kode_order','=',$request->kode_order)->where('status','=','BELUM_BAYAR');
    //     $id_order = $id_order->pluck('id_order')->first();
    //     $id_pelanggan = DB::table('tbl_order')->select('id_pelanggan')->where('kode_order','=',$request->kode_order)->where('status','=','BELUM_BAYAR');
    //     $id_pelanggan = $id_pelanggan->pluck('id_pelanggan')->first();
    //     $jumlah_bayar = DB::table('tbl_detail_order')->where('kode_order','=', $request->kode_order)->where('status','=','BELUM_BAYAR')->sum('total_bayar');
    //     $namapemesan = DB::table('tbl_order')->select('nama_pelanggan')->where('kode_order','=', $request->kode_order)->where('status','=','BELUM_BAYAR')->pluck('nama_pelanggan')->first();
    //     $kode_order = $request->kode_order;
    //     $jumlah_menu_dipesan = DB::table('tbl_detail_order')->where('kode_order','=', $request->kode_order)->where('status','=','BELUM_BAYAR')->sum('jumlah_pesan');
    //     $nomeja = DB::table('tbl_detail_order')->select('no_meja')->where('kode_order','=', $request->kode_order)->where('status','=','BELUM_BAYAR')->pluck('no_meja')->first();
    //     // return dd($jumlah_menu_dipesan);
    //     return view('kasir.transaksi.index',[
    //         'data'=>$data,
    //         'jumlah_bayar'=>$jumlah_bayar,
    //         'nomeja'=>$nomeja,
    //         'namapemesan'=>$namapemesan,
    //         'kode_order'=>$kode_order,
    //         'id_order'=>$id_order,
    //         'id_pelanggan'=>$id_pelanggan,
    //         'jumlah_menu_dipesan'=>$jumlah_menu_dipesan]);

    //     // return dd($id_pelanggan);
    // }

    public function Bayar(Request $request)
    {
        // //UPDATE STATUS
        $statusselesai = ['status'=>'SELESAI'];
        Order::where('kode_order','=',$request->kode_order)->update($statusselesai);
        DetailOrder::where('kode_order','=',$request->kode_order)->update($statusselesai);
        // //END UPDATE STATUS
        
        // //INSERT INTO LAPORAN
        $tanggal_sekarang = Carbon::today()->format('y-m-d');
        $check_data = Laporan::where('tanggal','=',$tanggal_sekarang)->count();
        $jumlah_transaksi_awal = 1;
        $jumlah_produk_terjual = DB::table('tbl_detail_order')->where('kode_order','=', $request->kode_order)->sum('jumlah_pesan');
        if ($check_data == 0)
        {
            Laporan::create([
                'tanggal'=>$tanggal_sekarang,
                'jumlah_transaksi'=>$jumlah_transaksi_awal,
                'jumlah_penghasilan'=>$request->jumlah_bayar,
                'jumlah_produk_terjual'=>$jumlah_produk_terjual,
            ]);
            // return redirect()->route('kasir.transaksi');
        }else{
            //GATHERING DATA
            $jml_transaksi = Laporan::where('tanggal','=',$tanggal_sekarang)->latest('tanggal')->pluck('jumlah_transaksi');
            $jml_penghasilan = Laporan::where('tanggal','=',$tanggal_sekarang)->latest('tanggal')->pluck('jumlah_penghasilan');
            $jml_produk_terjual = Laporan::where('tanggal','=',$tanggal_sekarang)->latest('tanggal')->pluck('jumlah_produk_terjual');
            $artmtk_jml_transaksi = $jml_transaksi[0] + 1;
            $artmtk_jml_penghasilan = $jml_penghasilan[0] + $request->jumlah_bayar;
            $artmtk_jml_produk_terjual = $jml_produk_terjual[0] + $jumlah_produk_terjual;
            $nomeja = Order::select('no_meja')->where('kode_order',$request->kode_order)->pluck('no_meja')->first();
            // return dd($jml_transaksi);
            //END GATHERING DATA

            $query = 
            [
              'jumlah_transaksi'=>$artmtk_jml_transaksi,
              'jumlah_penghasilan'=>$artmtk_jml_penghasilan,
              'jumlah_produk_terjual'=>$artmtk_jml_produk_terjual,  
            ];

            //UPDATE DATA
            Laporan::where('tanggal','=',$tanggal_sekarang)->update($query);
            // return redirect()->route('kasir.transaksi');
        }
        //END INSERT LAPORAN

        //INSERT INTO TRANSAKSI
        Transaksi::create([
            'kembalian'=>$request->kembalian,
            'kode_order'=>$request->kode_order,
            'total_bayar'=>$request->total_bayar,
            'jumlah_bayar'=>$request->jumlah_bayar,
            'nama_pelanggan'=>$request->nama_pelanggan,
            'jumlah_menu_dipesan'=>$request->jumlah_menu_dipesan,
            'id_pelanggan'=>$request->id_pelanggan,
            'id_petugas'=>$request->id_kasir,
            'id_order'=>$request->id_order,
            'tanggal'=>$tanggal_sekarang,
            'level_petugas'=>'KASIR'
        ]);
        $nomeja = DB::table('tbl_detail_order')->select('no_meja')->where('kode_order','=', $request->kode_order)->where('status','=','BELUM_BAYAR')->pluck('no_meja')->first();
        $update = Meja::where('no_meja',$nomeja);
        $update->update(['status'=>'KOSONG']);

        return redirect()->route('kasir.transaksi');
        // return dd($request->jumlah_menu_dipesan);
    }

    public function CetakStruk(Request $request)
    {
        $papersize = array(0,0,323.15,459.21);
        $lokasi_file_struk = public_path('/assets/struk_transaksi/' . $request->kode_order . '.pdf');
        $data = DB::table('tbl_detail_order')->where('kode_order','=',$request->kode_order)->get();
        $pdf = PDF::loadView('kasir.transaksi.report',[
            'nama_pelanggan'=>$request->nama_pelanggan,
            'kembalian'=>$request->kembalian,
            'kode_order'=>$request->kode_order,
            'tanggal'=>Carbon::today()->format('y-m-d'),
            'total_bayar'=>$request->total_bayar,
            'jumlah_bayar'=>$request->jumlah_bayar,
            'data'=>$data,
            'title'=>$request->kode_order
        ])->save($lokasi_file_struk);
        // ->setPaper($papersize,'potrait')
        Transaksi::where('kode_order','=',$request->kode_order)->update(['file_struk_transaksi'=>$request->kode_order . '.pdf']);
        return $pdf->stream($request->kode_order.'.pdf');
    }
}
