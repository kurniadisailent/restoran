<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public $timestamps = false;
    protected $table = 'tbl_menu';
    protected $primaryKey = 'id_menu';
    protected $fillable = [
        'file_gambar_menu','nama_menu','nama_kategori','deskripsi','harga','diskon','stok','status'
    ];
}