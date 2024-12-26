<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barangs';
    public $timestamps ='false';
    protected $fillable = [
            'nama_barang',
            'sku',
            'harga_satuan'
    ];
}
