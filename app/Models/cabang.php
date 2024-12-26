<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HasFactory;

class Cabang extends Model
{


    protected $table = 'cabangs';

    protected $fillable = [
        'name',
        'alamat',
        'kota'
    ];
}
