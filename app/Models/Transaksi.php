<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    public $incrementing = false;

    public $table = 'trans_obat';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'trans_id','kode_obat','jumlah_jual','kode_apoteker','tgl_beli'
    ];
}
