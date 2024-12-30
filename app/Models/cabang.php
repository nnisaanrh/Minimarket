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

    public function users()
{
    return $this->hasMany(User::class);
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
