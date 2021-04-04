<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model
{
    public $timestamps = false;
    protected $table = 'tbl_detail_order';
    protected $primaryKey = 'id_detail_order';
    protected $fillable = 
    ['id_detail_order','id_order','diskon','total_bayar','kode_order','id_menu','nama_menu','harga_menu','jumlah_pesan','no_meja','status'];
}