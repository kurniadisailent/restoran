<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    public $timestamps = false;
    protected $table = 'tbl_meja';
    protected $primaryKey = 'id_meja';
    protected $fillable = [
        'no_meja','keterangan','status'
    ];
}