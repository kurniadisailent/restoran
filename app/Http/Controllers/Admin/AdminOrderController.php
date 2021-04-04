<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Haruncpi\LaravelIdGenerator\IdGenerator;
Use Carbon\Carbon;
use App\Order;
use App\DetailOrder;
use App\Meja;
use App\Menu;

class AdminOrderController extends Controller
{
    public function index(Request $request)
    {
        $condition = 1;
        $kategori = 'Semua';
        $result = Menu::where('nama_menu','like',"%{$request->keyword}%")
                        ->orWhere('deskripsi','like',"%{$request->keyword}%")
                        ->orWhere('harga','like',"%{$request->keyword}%")
                        ->paginate(4);
        return view('admin.order.index',['data'=>$result,'condition'=>$condition,'kat'=>$kategori]);
    }

    public function Order(Request $request)
    {
        $id_petugas = $request->id_petugas;
        $thisDate = Carbon::today()->format('y-m-d');
        $kode_order = DB::table('tbl_order')
                        ->select('kode_order')
                        ->where('id_petugas','=',$request->id_petugas)
                        ->where('tanggal','=',$thisDate)
                        ->where('status','=','ORDER')
                        ->pluck('kode_order')
                        ->first();
        $armtk_totalbayar = $request->total_bayar * $request->jumlah_pesan;
        if(empty($kode_order))
        {
            $jumlah_order = Order::select('kode_order')->where('tanggal','=',$thisDate)->count();
            $kode_order_new = 'ORD' . Carbon::today()->format('mdy') . ($jumlah_order + 1);
            Order::create([
                'kode_order'=> $kode_order_new,
                'tanggal'=>$thisDate,
                'keterangan'=>'nodesc',
                'status'=>'ORDER',
                'id_petugas'=>$request->id_petugas,
                'level_petugas'=>$request->level_petugas
            ]);
            $id_order = DB::table('tbl_order')
                        ->select('id_order')
                        ->where('kode_order','=',$kode_order_new)
                        ->pluck('id_order')
                        ->first();

            DetailOrder::create([
                'id_order'=>$id_order,
                'kode_order'=>$kode_order_new,
                'id_menu'=>$request->id_menu,
                'nama_menu'=>$request->nama_menu,
                'harga_menu'=>$request->harga_menu,
                'diskon'=>$request->diskon,
                'total_bayar'=>$armtk_totalbayar,
                'jumlah_pesan'=>$request->jumlah_pesan,
                'status'=>'ORDER'
            ]);
            $jumlah_bayar = DB::table('tbl_detail_order')
                            ->where('kode_order','=',$kode_order_new)
                            ->sum('total_bayar');
            $data = DetailOrder::where('kode_order','=',$kode_order_new)->get();
            return  redirect()->route('adminorder.cart',['data'=>$data,'id_petugas'=>$id_petugas]);
        }else{
            $id_order = DB::table('tbl_order')
                        ->select('id_order')
                        ->where('kode_order','=',$kode_order)
                        ->pluck('id_order')
                        ->first();
            $check_detail_order = DetailOrder::select('id_detail_order')
                                    ->where('kode_order','=',$kode_order)
                                    ->where('id_menu','=',$request->id_menu)
                                    ->pluck('id_detail_order')
                                    ->first();
            if(empty($check_detail_order))
            {
                DetailOrder::create([
                    'id_order'=>$id_order,
                    'kode_order'=>$kode_order,
                    'id_menu'=>$request->id_menu,
                    'nama_menu'=>$request->nama_menu,
                    'harga_menu'=>$request->harga_menu,
                    'diskon'=>$request->diskon,
                    'total_bayar'=>$armtk_totalbayar,
                    'jumlah_pesan'=>$request->jumlah_pesan,
                    'status'=>'ORDER'
                ]);
                $jumlah_bayar = DB::table('tbl_detail_order')
                                    ->where('kode_order','=',$kode_order)
                                    ->sum('total_bayar');
                $data = DetailOrder::where('kode_order','=',$kode_order)->get();
                return  redirect()->route('adminorder.cart',['data'=>$data,'id_petugas'=>$id_petugas]);
            }else{
                $get_totalbyr = DetailOrder::select('total_bayar')
                                            ->where('id_menu','=',$request->id_menu)
                                            ->where('kode_order','=',$kode_order)
                                            ->pluck('total_bayar')
                                            ->first();
                $get_jmlpesan = DetailOrder::select('jumlah_pesan')
                                            ->where('id_menu','=',$request->id_menu)
                                            ->where('kode_order','=',$kode_order)
                                            ->pluck('jumlah_pesan')
                                            ->first();
                $armtk_totalbyr_thp1 = $request->total_bayar * $request->jumlah_pesan;
                $armtk_totalbyr = $get_totalbyr + $armtk_totalbyr_thp1;
                $armtk_jmlpesan = $get_jmlpesan + $request->jumlah_pesan;
                DetailOrder::where('id_menu','=',$request->id_menu)
                            ->where('kode_order','=',$kode_order)
                            ->update([
                                'total_bayar' => $armtk_totalbyr,
                                'jumlah_pesan' => $armtk_jmlpesan
                             ]);
                $jumlah_bayar = DB::table('tbl_detail_order')
                                    ->where('kode_order','=',$kode_order)
                                    ->sum('total_bayar');
                $data = DetailOrder::where('kode_order','=',$kode_order)->get();
                return  redirect()->route('adminorder.cart',['data'=>$data,'id_petugas'=>$id_petugas]);
            }
        }
    }

    public function OpenCart(Request $request, $id_petugas)
    {
        $thisDate = Carbon::today()->format('y-m-d');
        $kode_order = DB::table('tbl_order')
                        ->select('kode_order')
                        ->where('id_petugas','=',$id_petugas)
                        ->where('tanggal','=',$thisDate)
                        ->where('status','=','ORDER')
                        ->pluck('kode_order')
                        ->first();
        $jumlah_bayar = DB::table('tbl_detail_order')
                            ->where('kode_order','=',$kode_order)
                            ->sum('total_bayar');
        $data = DetailOrder::where('kode_order','=',$kode_order)->get();
        return view('admin.order.cart',['data'=>$data,'jumlah_bayar'=>$jumlah_bayar]);
    }

    public function DeleteCartItem($id_petugas, $kode_order, $id_detail_order)
    {
        DetailOrder::where('id_detail_order','=',$id_detail_order)->delete();
        $jumlah_bayar = DB::table('tbl_detail_order')
                            ->where('kode_order','=',$kode_order)
                            ->sum('total_bayar');
        $data = DetailOrder::where('kode_order','=',$kode_order)->get();
        return redirect()->route('adminorder.cart',['data'=>$data,'id_petugas'=>$id_petugas])->with('destroy','Berhasil dihapus!');
    }

    public function ResetCart(Request $request, $id_petugas)
    {
        $thisDate = Carbon::today()->format('y-m-d');
        $kode_order = DB::table('tbl_order')
                        ->select('kode_order')
                        ->where('id_petugas','=',$id_petugas)
                        ->where('tanggal','=',$thisDate)
                        ->where('status','=','ORDER')
                        ->pluck('kode_order')
                        ->first();
        Order::where('kode_order','='.$kode_order)->delete();
        DetailOrder::Where('kode_order','=',$kode_order)->delete();
        $data = DetailOrder::where('kode_order','=',$kode_order)->get();
        return redirect()->route('adminorder.cart',['data'=>$data,'id_petugas'=>$id_petugas]);
    }

    public function UbahJumlahPesan(Request $request)
    {
        $thisDate = Carbon::today()->format('y-m-d');
        $kode_order = DB::table('tbl_order')
                        ->select('kode_order')
                        ->where('id_petugas','=',$request->id_petugas)
                        ->where('tanggal','=',$thisDate)
                        ->where('status','=','ORDER')
                        ->pluck('kode_order')
                        ->first();
        $harga = Menu::select('harga')->where('id_menu','=',$request->id_menu)->pluck('harga')->first();
        $diskon = Menu::select('diskon')->where('id_menu',$request->id_menu)->pluck('diskon')->first();
        $tahap1 = $diskon/100 * $harga; $harga_diskon = $harga - $tahap1;
        $totalbayar = $harga_diskon * $request->jumlah_pesan;
        DetailOrder::where('id_menu','=',$request->id_menu)
                    ->where('kode_order','=',$kode_order)
                    ->update(['jumlah_pesan'=>$request->jumlah_pesan,'total_bayar'=>$totalbayar]);
        $jumlah_bayar = DB::table('tbl_detail_order')
                    ->where('kode_order','=',$kode_order)
                    ->sum('total_bayar');
        Order::where('kode_order',$request->kode_order)->update(['total_bayar'=>$jumlah_bayar]);
        return redirect()->route('adminorder.cart',['id_petugas'=>$request->id_petugas]);
    }

    Public function Prosses(Request $request)
    {
        $thisDate = Carbon::today()->format('y-m-d');
        $kode_order = DB::table('tbl_order')
                        ->select('kode_order')
                        ->where('id_petugas','=',$request->id_petugas)
                        ->where('tanggal','=',$thisDate)
                        ->where('status','=','ORDER')
                        ->pluck('kode_order')
                        ->first();
        $jumlah_data_dorder = DetailOrder::where('kode_order','=',$kode_order)->count();
        $data_dorder = DetailOrder::where('kode_order','=',$kode_order)->get();
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
            'total_bayar'=>$request->jumlah_bayar,
            'status'=>"BELUM_BAYAR",]);
        $query2 = DetailOrder::where('kode_order','=',$kode_order);
        $query2->update([
            'no_meja'=>$request->no_meja,
            'status'=>"BELUM_BAYAR",]);
        return redirect()->route('adminentriorder.index')->with('berhasil',' Order telah di proses !');
    }

    Public function Kategori(Request $request, $kategori)
    {
        if ($kategori == 'Semua')
        {
            $condition = 1;
            $result = Menu::where('nama_menu','like',"%{$request->keyword}%")
                            ->orWhere('deskripsi','like',"%{$request->keyword}%")
                            ->orWhere('harga','like',"%{$request->keyword}%")
                            ->paginate(4);
            return view('admin.order.index',['data'=>$result,'condition'=>$condition,'kat'=>$kategori]);
        }elseif($kategori == 'Makanan'){
            $condition = 0;
            $result = Menu::where('nama_menu','like',"%{$request->keyword}%")
                            ->where('nama_kategori','=','Makanan')
                            ->paginate(4);
            return view('admin.order.index',['data'=>$result,'condition'=>$condition,'kat'=>$kategori]);
        }elseif($kategori == 'Minuman'){
            $condition = 0;
            $result = Menu::where('nama_menu','like',"%{$request->keyword}%")
                            ->where('nama_kategori','=','Minuman')
                            ->paginate(4);
            return view('admin.order.index',['data'=>$result,'condition'=>$condition,'kat'=>$kategori]);
        }elseif($kategori == 'Dessert'){
            $condition = 0;
            $result = Menu::where('nama_menu','like',"%{$request->keyword}%")
                            ->where('nama_kategori','=','Dessert')
                            ->paginate(4);
            return view('admin.order.index',['data'=>$result,'condition'=>$condition,'kat'=>$kategori]);
        }
    }
}