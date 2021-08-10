<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    public $incrementing = false;

    public $table = 'obat';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'kode_obat','nama_obat','harga_obat','sisa_obat','tgl_kadarluarsa'
    ];
}
