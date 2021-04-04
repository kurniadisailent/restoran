<?php

namespace App\Http\Controllers\Owner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use Carbon\Carbon;
use App\Laporan;
use App\Waiter;
use App\Kasir;
use DB;

class OwnerDashboardController extends Controller
{
    public function index()
    {
        $totalorder = Order::whereMonth('tanggal','=',Carbon::now()->month)->count();
        $totalorder_selesai = Order::whereMonth('tanggal','=',Carbon::now()->month)->where('status','SELESAI')->count();
        $totalorder_pending = Order::whereMonth('tanggal','=',Carbon::now()->month)->where('status','ORDER')->orWhere('status','BELUM_BAYAR')->count();
        $totalwaiter = Waiter::where('status','Aktif')->count();
        $totalkasir = Kasir::where('status','Aktif')->count();
        $totalkaryawan = $totalwaiter + $totalkasir;

        $total_pendapatan_hariini = Laporan::whereDay('tanggal','=',Carbon::now()->format('d'))->sum('jumlah_penghasilan');
        $total_pendapatan_mingguini = Laporan::where(DB::Raw('week(tanggal)'), '=', Carbon::now()->weekOfYear)->sum('jumlah_penghasilan');
        $total_pendapatan_bulanini = Laporan::whereMonth('tanggal',Carbon::now()->format('m'))->sum('jumlah_penghasilan');
        $total_pendapatan_tahunini = Laporan::whereYear('tanggal',Carbon::now()->format('Y'))->sum('jumlah_penghasilan');

        $total_pendapatan_satuharilalu = Laporan::whereDay('tanggal','=',Carbon::now()->subDays(1))->sum('jumlah_penghasilan');
        $previous_week = strtotime("-1 week +1 day");
        $start_week = strtotime("last sunday midnight",$previous_week);
        $end_week = strtotime("next saturday",$start_week);
        $start_week = date("Y-m-d",$start_week);
        $end_week = date("Y-m-d",$end_week);
        $total_pendapatan_satuminggulalu = Laporan::whereBetween('tanggal',[$start_week, $end_week])->sum('jumlah_penghasilan');
        $total_pendapatan_satubulanlalu = Laporan::whereMonth('tanggal','=',Carbon::now()->subMonth()->month)->sum('jumlah_penghasilan');
        $total_pendapatan_satutahunlalu = Laporan::whereYear('tanggal', date('Y', strtotime('-1 year')))->sum('jumlah_penghasilan');
        $minggulalu = Carbon::now()->subDays(7)->format('Y-m-d');
        $dat = Laporan::where('tanggal','=',$minggulalu)->sum('jumlah_penghasilan');
        $datachrt = array();
        //persentase hari
        if ($total_pendapatan_satuharilalu == 0 || $total_pendapatan_hariini == 0)
        {
            $persentase_hari = 0;
        }else{
            if($total_pendapatan_satuharilalu <= $total_pendapatan_hariini){
                $persentase_hari =  ($total_pendapatan_hariini - $total_pendapatan_satuharilalu) / $total_pendapatan_satuharilalu * 100;
            }else{
                $persentase_hari =  ($total_pendapatan_satuharilalu - $total_pendapatan_hariini) / $total_pendapatan_satuharilalu * 100;
            }
        }
        //persentase minggu
        if ($total_pendapatan_satuminggulalu == 0 || $total_pendapatan_mingguini == 0)
        {
            $persentase_minggu = 0;
        }else{
            if($total_pendapatan_satuminggulalu <= $total_pendapatan_mingguini){
                $persentase_minggu =  ($total_pendapatan_mingguini - $total_pendapatan_satuminggulalu) / $total_pendapatan_satuminggulalu * 100;
            }else{
                $persentase_minggu =  ($total_pendapatan_satuminggulalu - $total_pendapatan_mingguini) / $total_pendapatan_satuminggulalu * 100;
            }
        }
        //persentase bulan
        if ($total_pendapatan_satubulanlalu == 0 || $total_pendapatan_bulanini == 0)
        {
            $persentase_bulan = 0;
        }else{
            if($total_pendapatan_satubulanlalu <= $total_pendapatan_bulanini){
                $persentase_bulan =  ($total_pendapatan_bulanini - $total_pendapatan_satubulanlalu) / $total_pendapatan_satubulanlalu * 100;
            }else{
                $persentase_bulan =  ($total_pendapatan_satubulanlalu - $total_pendapatan_bulanini) / $total_pendapatan_satubulanlalu * 100;
            }
        }
        //persentase tahun
        if ($total_pendapatan_satutahunlalu == 0 || $total_pendapatan_tahunini == 0)
        {
            $persentase_tahun = 0;
        }else{
            if($total_pendapatan_satutahunlalu <= $total_pendapatan_tahunini){
                $persentase_tahun =  ($total_pendapatan_tahunini - $total_pendapatan_satutahunlalu) / $total_pendapatan_satutahunlalu * 100;
            }else{
                $persentase_tahun =  ($total_pendapatan_satutahunlalu - $total_pendapatan_tahunini) / $total_pendapatan_satutahunlalu * 100;
            }
        }

        for($i = 7; $i >= 0; $i-- )
        {
            ${'hari'.$i} = Carbon::now()->subDays($i)->format('Y-m-d');
            ${'data'.$i} = Laporan::where('tanggal','=',${'hari'.$i})->sum('jumlah_penghasilan');
            if (${'data'.$i} == null)
            {
                ${'data'.$i} = "0";
            }
            array_push($datachrt, ${'data'.$i});
        }
        // return dd(array_values($datachrt));
        // return dd($persentase_hari);
        return view('owner.dashboard.index',[
            'totalorder'=>$totalorder,
            'totalorder_selesai'=>$totalorder_selesai,
            'totalorder_pending'=>$totalorder_pending,
            'totalkaryawan'=>$totalkaryawan,
            'datachrt'=>$datachrt,
            'total_pendapatan_hariini'=>$total_pendapatan_hariini,
            'total_pendapatan_mingguini'=>$total_pendapatan_mingguini,
            'total_pendapatan_bulanini'=>$total_pendapatan_bulanini,
            'total_pendapatan_tahunini'=>$total_pendapatan_tahunini,
            'total_pendapatan_satuharilalu'=>$total_pendapatan_satuharilalu,
            'total_pendapatan_satuminggulalu'=>$total_pendapatan_satuminggulalu,
            'total_pendapatan_satubulanlalu'=>$total_pendapatan_satubulanlalu,
            'total_pendapatan_satutahunlalu'=>$total_pendapatan_satutahunlalu,
            'persentase_hari'=>$persentase_hari,
            'persentase_minggu'=>$persentase_minggu,
            'persentase_bulan'=>$persentase_bulan,
            'persentase_tahun'=>$persentase_tahun,
        ]);
    }
}
