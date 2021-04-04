<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DetailOrder;
use App\Order;
use App\Menu;
use App\Meja;
use Illuminate\Support\Facades\DB;

class AdminEntriOrderController extends Controller
{
    public function index(Request $request)
    {
        $result = Order::where('status','=',"BELUM_BAYAR")->orWhere('status','=',"ORDER")->orderBy('tanggal','DESC')->paginate(10);
        return view('admin.entriOrder.index',['data'=>$result]);
    }

    public function StatusOrder(Request $request)
    {
        $result = Order::where('status','=',"ORDER")->orderBy('tanggal','DESC')->paginate(10);
        return view('admin.entriOrder.index',['data'=>$result]);
    }

    public function StatusBelumbayar(Request $request)
    {
        $result = Order::where('status','=',"BELUM_BAYAR")->orderBy('tanggal','DESC')->paginate(10);
        return view('admin.entriOrder.index',['data'=>$result]);
    }

    public function Cari(Request $request)
    {
        $result = Order::where('nama_pelanggan','like',"%{$request->keyword}%")->where('status','!=','SELESAI')
                        ->orWhere('kode_order','like',"%{$request->keyword}%")->where('status','!=','SELESAI')
                        ->orWhere('total_bayar','like',"%{$request->keyword}%")->where('status','!=','SELESAI')
                        ->orWhere('tanggal','like',"%{$request->keyword}%")->where('status','!=','SELESAI')
                        ->orderBy('tanggal','DESC')->paginate(10);
        return view('admin.entriOrder.index',['data'=>$result]);
    }

    public function detail(Request $request,$kode_order)
    {
        $result = DetailOrder::where('kode_order','=',$kode_order)->get();
        $status = Order::select('status')->where('kode_order','=',$kode_order)->pluck('status')->first();
        $jumlah_bayar = DB::table('tbl_detail_order')
                            ->where('kode_order','=',$kode_order)
                            ->sum('total_bayar');
        return view('admin.entriorder.detail',['data'=>$result,'jumlah_bayar'=>$jumlah_bayar,'status'=>$status,'kode_order'=>$kode_order]);
    }

    public function ShowTambahMenu(Request $request, $kode_order)
    {
        $condition = 1;
        $kategori = 'Semua';
        $result = Menu::where('nama_menu','like',"%{$request->keyword}%")
                        ->orWhere('deskripsi','like',"%{$request->keyword}%")
                        ->orWhere('harga','like',"%{$request->keyword}%")
                        ->paginate(4);
        return view('admin.entriOrder.menu',['data'=>$result,'condition'=>$condition,'kat'=>$kategori,'kode_order'=>$kode_order]);
    }

    public function TambahMenu(Request $request)
    {
        $result = DetailOrder::where('kode_order','=',$request->kode_order)->get();
        $status = Order::select('status')->where('kode_order','=',$request->kode_order)->pluck('status')->first();
        $jumlah_bayar = DB::table('tbl_detail_order')
                            ->where('kode_order','=',$request->kode_order)
                            ->sum('total_bayar');

        $armtk_totalbayar = $request->total_bayar * $request->jumlah_pesan;
        $id_order = DB::table('tbl_order')
                        ->select('id_order')
                        ->where('kode_order','=',$request->kode_order)
                        ->pluck('id_order')
                        ->first();
        $check_detail_order = DetailOrder::select('id_detail_order')
                                    ->where('kode_order','=',$request->kode_order)
                                    ->where('id_menu','=',$request->id_menu)
                                    ->pluck('id_detail_order')
                                    ->first();
        if(empty($check_detail_order))
        {
            $order = Order::where('kode_order',$request->kode_order)->get()->first();
            $detailorder = DetailOrder::where('kode_order',$request->kode_order)->get();

            $armtk_total_bayar = $request->total_bayar * $request->jumlah_pesan;
            $armtk_hasil_total = $order->total_bayar + $armtk_total_bayar;

            $query = Order::where('kode_order',$request->kode_order);
            $query->update([
                'total_bayar'=>$armtk_hasil_total,
            ]);

            DetailOrder::create([
                    'id_order'=>$id_order,
                    'kode_order'=>$request->kode_order,
                    'id_menu'=>$request->id_menu,
                    'nama_menu'=>$request->nama_menu,
                    'harga_menu'=>$request->harga_menu,
                    'diskon'=>$request->diskon,
                    'total_bayar'=>$armtk_totalbayar,
                    'jumlah_pesan'=>$request->jumlah_pesan,
                    'status'=>'ORDER'
            ]);
            $jumlah_bayar = DB::table('tbl_detail_order')
                                    ->where('kode_order','=',$request->kode_order)
                                    ->sum('total_bayar');
            $data = DetailOrder::where('kode_order','=',$request->kode_order)->get();
            return  redirect()->route('adminadminentriorder.detail',['data'=>$result,'jumlah_bayar'=>$jumlah_bayar,'status'=>$status,'kode_order'=>$request->kode_order])->with('sukses',' Berhasil Menu Telah Di tambahkan');
        
        }else{

            $order = Order::where('kode_order',$request->kode_order)->get()->first();
            $detailorder = DetailOrder::where('kode_order',$request->kode_order)->get();

            $armtk_total_bayar = $request->total_bayar * $request->jumlah_pesan;
            $armtk_hasil_total = $order->total_bayar + $armtk_total_bayar;

            $query = Order::where('kode_order',$request->kode_order);
            $query->update([
                'total_bayar'=>$armtk_hasil_total,
            ]);

            $get_totalbyr = DetailOrder::select('total_bayar')
                                            ->where('id_menu','=',$request->id_menu)
                                            ->where('kode_order','=',$request->kode_order)
                                            ->pluck('total_bayar')
                                            ->first();
            $get_jmlpesan = DetailOrder::select('jumlah_pesan')
                                            ->where('id_menu','=',$request->id_menu)
                                            ->where('kode_order','=',$request->kode_order)
                                            ->pluck('jumlah_pesan')
                                            ->first();
            $armtk_totalbyr_thp1 = $request->total_bayar * $request->jumlah_pesan;
            $armtk_totalbyr = $get_totalbyr + $armtk_totalbyr_thp1;
            $armtk_jmlpesan = $get_jmlpesan + $request->jumlah_pesan;
            DetailOrder::where('id_menu','=',$request->id_menu)
                            ->where('kode_order','=',$request->kode_order)
                            ->update([
                                'total_bayar' => $armtk_totalbyr,
                                'jumlah_pesan' => $armtk_jmlpesan
                            ]);
            $jumlah_bayar = DB::table('tbl_detail_order')
                                    ->where('kode_order','=',$request->kode_order)
                                    ->sum('total_bayar');
            $data = DetailOrder::where('kode_order','=',$request->kode_order)->get();
            return  redirect()->route('adminadminentriorder.detail',['data'=>$result,'jumlah_bayar'=>$jumlah_bayar,'status'=>$status,'kode_order'=>$request->kode_order])->with('sukses',' Berhasil Menu Telah Di tambahkan');
        }
    }

    public function update(Request $request)
    {
        $result = DetailOrder::where('kode_order','=',$request->kode_order)->get();
        $status = Order::select('status')->where('kode_order','=',$request->kode_order)->pluck('status')->first();
        $jumlah_bayar = DB::table('tbl_detail_order')
                                ->where('kode_order','=',$request->kode_order)
                                ->sum('total_bayar');
        $data = DetailOrder::where('kode_order','=',$request->kode_order)->get(); 
        $check = Meja::select('status')->where('no_meja',$request->no_meja)->pluck('status')->first();
        $no_meja = Order::select('no_meja')->where('kode_order',$request->kode_order)->pluck('no_meja')->first();
        if($check == 'DITEMPATI' && $no_meja != $request->no_meja)
        {
            return redirect()->back()->with('gagal','Meja telah Ditempati silahkan pilih meja lain');
        }else{
            $qmejaubh = Meja::where('no_meja',$no_meja);
            $qmejaubh->update(['status'=>'KOSONG']);
            $qmeja = Meja::where('no_meja',$request->no_meja);
            $qmeja->update(['status'=>'DITEMPATI']);
            $qorder = Order::where('kode_order',$request->kode_order);
            $qorder->update(['nama_pelanggan'=>$request->nama_pelanggan,'total_bayar'=>$jumlah_bayar,'no_meja'=>$request->no_meja]);
            return redirect()->back()->with('sukses','Update Berhasil');
        }
    }

    public function TambahJumlah(Request $request)
    {
        $harga = Menu::select('harga')->where('id_menu','=',$request->id_menu)->pluck('harga')->first();
        $diskon = Menu::select('diskon')->where('id_menu',$request->id_menu)->pluck('diskon')->first();
        $tahap1 = $diskon/100 * $harga; $harga_diskon = $harga - $tahap1;
        $totalbayar = $harga_diskon * $request->jumlah_pesan;
        DetailOrder::where('id_menu','=',$request->id_menu)
                    ->where('kode_order','=',$request->kode_order)
                    ->update(['jumlah_pesan'=>$request->jumlah_pesan,'total_bayar'=>$totalbayar]);
        $jumlah_bayar = DB::table('tbl_detail_order')
                    ->where('kode_order','=',$request->kode_order)
                    ->sum('total_bayar');
        Order::where('kode_order',$request->kode_order)->update(['total_bayar'=>$jumlah_bayar]);
        return redirect()->route('adminorder.cart',['id_petugas'=>$request->id_petugas]);
    }

    public function ProsesOrder(Request $request)
    {
        $kode_order = $request->kode_order;
        $jumlah_data_dorder = DetailOrder::where('kode_order','=',$kode_order)->count();
        $data_dorder = DetailOrder::where('kode_order','=',$kode_order)->get();
        $jumlah_bayar = DB::table('tbl_detail_order')
                        ->where('kode_order','=',$kode_order)
                        ->sum('total_bayar');
        $stack = array();
        $a = 0;
        $fotru = 0;
        $namamenu = "";
        $stokmaskaan = "";
        for($i = 0; $i < $jumlah_data_dorder; $i++)
        {
            ${'jumlah_pesan'.$i} = DetailOrder::select('jumlah_pesan')->where('kode_order','=',$kode_order)->pluck('jumlah_pesan')->get($i);
            $id_menu = DetailOrder::select('id_menu')->where('kode_order','=',$kode_order)->pluck('id_menu')->get($i);
            ${'jumlah_stok'.$i} = Menu::select('stok')->where('id_menu','=',$id_menu)->first();
            ${'jml_stk'.$i} = ${'jumlah_stok'.$i}->stok;
            ${'armtk_jmlmenu'.$i} = ${'jml_stk'.$i} - ${'jumlah_pesan'.$i};
            $name = Menu::select('nama_menu')->where('id_menu','=',$id_menu)->first();
            if (${'jumlah_pesan'.$i} > ${'jml_stk'.$i})
            {
                $fotru = 1;
                $namamenu = $name->nama_menu;
                $stokmaskaan = "Tersisa " . ${'jumlah_stok'.$i}->stok;
                if($stokmaskaan <= 0)
                {
                    $stokmaskaan = "Habis";
                }
                // return redirect()->route('adminorder.cart',['id_petugas'=>$request->id_petugas])->with('stok',' Stok '. $namamenu->nama_menu . ' Tersisa ' . ${'jml_stk'.$i} . ' Silahkan Kurangi jumlah pemesanan');
            }
            // else{
            //     ${'query'.$i} = menu::where('id_menu','=', $id_menu);
            //     ${'query'.$i}->update(['stok'=>${'armtk_jmlmenu'.$i}]);
            // }
            // array_push($stack, ${'jml_stk'.$i});  
        }

        for($i = 0; $i < $jumlah_data_dorder; $i++)
        {
            ${'jumlah_pesan'.$i} = DetailOrder::select('jumlah_pesan')->where('kode_order','=',$kode_order)->pluck('jumlah_pesan')->get($i);
            $id_menu = DetailOrder::select('id_menu')->where('kode_order','=',$kode_order)->pluck('id_menu')->get($i);
            ${'jumlah_stok'.$i} = Menu::select('stok')->where('id_menu','=',$id_menu)->first();
            ${'jml_stk'.$i} = ${'jumlah_stok'.$i}->stok;
            ${'armtk_jmlmenu'.$i} = ${'jml_stk'.$i} - ${'jumlah_pesan'.$i};
            if ($fotru == 1)
            {
                return redirect()->route('adminorder.cart',['id_petugas'=>$request->id_petugas])->with('stok',' Stok '. $namamenu. ' ' . $stokmaskaan . ' Silahkan Kurangi jumlah pemesanan atau hubungi waiter');
            }
            else{
                if (${'armtk_jmlmenu'.$i} == 0)
                {
                    ${'query'.$i} = Menu::where('id_menu','=', $id_menu);
                    ${'query'.$i}->update(['stok'=>${'armtk_jmlmenu'.$i},'status'=>'HABIS']);
                    ${'query2'.$i} = Meja::where('no_meja',$request->no_meja);
                    ${'query2'.$i}->update(['status'=>'DITEMPATI']);
                }else{
                    ${'query'.$i} = Menu::where('id_menu','=', $id_menu);
                    ${'query'.$i}->update(['stok'=>${'armtk_jmlmenu'.$i}]);
                    ${'query2'.$i} = Meja::where('no_meja',$request->no_meja);
                    ${'query2'.$i}->update(['status'=>'DITEMPATI']);
                }
            }
        }
        $id_meja = Meja::select('id_meja')->where('no_meja','=',$request->no_meja)->pluck('id_meja')->first();
        $query = Order::where('kode_order','=',$kode_order);
        $query->update([
            'id_meja'=>$id_meja,
            'no_meja'=>$request->no_meja,
            'nama_pelanggan'=>$request->nama_pelanggan,
            'total_bayar'=>$jumlah_bayar,
            'status'=>"BELUM_BAYAR",]);
        $query2 = DetailOrder::where('kode_order','=',$kode_order);
        $query2->update([
            'no_meja'=>$request->no_meja,
            'status'=>"BELUM_BAYAR",]);
        return redirect()->route('adminentriorder.index')->with('berhasil','Order telah di proses !');
    }

    public function hapusdata($kodeorder)
    {
        $dorder = Order::where('kode_order',$kodeorder);
        $dorder->delete();
        $ddorder = DetailOrder::where('kode_order',$kodeorder);
        $ddorder->delete();
        return redirect()->route('adminentriorder.index')->with('berhasil','Order telah di hapus');
    }
}