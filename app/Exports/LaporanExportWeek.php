<?php

namespace App\Exports;

use App\Laporan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Carbon\Carbon;

class LaporanExportWeek implements FromCollection
{
    public function collection()
    {
        $previous_week = strtotime("-1 week +1 day");
        $start_week = strtotime("last sunday midnight",$previous_week);
        $end_week = strtotime("next saturday",$start_week);
        $start_week = date("Y-m-d",$start_week);
        $end_week = date("Y-m-d",$end_week);
        return Laporan::whereBetween('tanggal',[$start_week, $end_week])->get();
    }
}
