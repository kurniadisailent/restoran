<?php

namespace App\Exports;

use App\Laporan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Carbon\Carbon;

class LaporanExportYear implements FromCollection
{
    public function collection()
    {
        return Laporan::whereYear('tanggal', date('Y', strtotime('-1 year')))->get();
    }
}
