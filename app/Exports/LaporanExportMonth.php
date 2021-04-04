<?php

namespace App\Exports;

use App\Laporan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Carbon\Carbon;

class LaporanExportMonth implements FromCollection
{
    public function collection()
    {
        return Laporan::whereMonth('tanggal','=',Carbon::now()->subMonth()->month)->get();
    }
}