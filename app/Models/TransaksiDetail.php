<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransaksiDetail extends Model
{

    protected $table = 'transaksi_details';

    protected $fillable = [
        'barang_id',
        'transaksi_id',
        'produk_id',
        'jumlah_barang',
        'harga',
        'harga_total'
    ];

    protected static function booted()
    {
        static::creating(function ($transaksiDetail) {
            // Menghitung harga total berdasarkan jumlah barang dan harga satuan
            $transaksiDetail->harga_total = $transaksiDetail->jumlah_barang * $transaksiDetail->harga;
        });
    }

    public function transaksi(): BelongsTo
    {
        return $this->belongsTo(Transaksi::class);
    }


    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class);
    }
}
