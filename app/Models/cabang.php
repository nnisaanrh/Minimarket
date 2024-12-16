<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cabang extends Model
{
    protected $table = 'cabangs';

    protected $fillable = [
        'mamacabang',
        'alamatcabang',
        'kota'
    ];

}
