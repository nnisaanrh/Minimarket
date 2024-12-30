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

    public function stok()
{
    return $this->hasMany(Stok::class);
}

public function stockMovements()
{
    return $this->hasMany(StockMovement::class);
}


public function stoks()
{
    return $this->hasMany(Stok::class);
}


}
