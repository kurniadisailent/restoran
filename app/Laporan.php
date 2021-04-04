<?php
 
namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Laporan extends Model
{
    public $timestamps = false;
    protected $table = 'tbl_laporan';
    protected $primaryKey = 'id_laporan';
    protected $fillable = 
    ['id_laporan','tanggal','jumlah_transaksi','jumlah_penghasilan','jumlah_suplier_masuk','jumlah_produk_terjual','jumlah_uang_masuk','jumlah_uang_keluar'];
}
 