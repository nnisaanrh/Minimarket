<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransaksiDetail extends Model
{

    protected $table = 'transaksi_details';

    protected $fillable = [
        'transaksi_id',
        'produk_id',
        'jumlah_barang',
        'harga',
        'harga_total'
    ];


    public function transaksi(): BelongsTo
    {
        return $this->belongsTo(Transaksi::class);
    }


    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class);
    }
}
