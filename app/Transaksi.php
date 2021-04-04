<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    public $timestamps = false;
    protected $table = 'tbl_transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $fillable =[
    'id_transaksi','id_order','kode_order','id_pelanggan','nama_pelanggan','total_bayar','jumlah_bayar',
    'kembalian','jumlah_menu_dipesan','tanggal','level_petugas','id_petugas'
    ];
}