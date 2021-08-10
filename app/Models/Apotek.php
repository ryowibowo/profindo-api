<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apotek extends Model
{
    public $incrementing = false;

    public $table = 'apoteker';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'kode_apoteker','nama_apoteker','tgl_lahir'
    ];
}
