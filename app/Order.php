<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false;
    protected $table = 'tbl_order';
    protected $primaryKey = 'id_order';
    protected $fillable = [
        'id_order','kode_order','id_meja','no_meja','id_pelanggan','nama_pelanggan','tanggal','total_bayar','keterangan','status','id_petugas','level_petugas'
    ];
}