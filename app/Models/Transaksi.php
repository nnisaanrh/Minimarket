<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaksi extends Model
{

        // Menentukan relasi dengan model TransaksiDetail
        
        protected $fillable = [
            'tanggal_penjualan',
        'total'
    ];
    
        // Event untuk mengisi total dan kolom lainnya saat transaksi dibuat
        protected static function booted()
        {
            static::creating(function ($transaksi) {
                // Menghitung total transaksi berdasarkan transaksi details
                $total = $transaksi->transaksiDetails->sum('harga_total');
    
                // Mengisi kolom total, user_id, dan cabang_id secara otomatis
                $transaksi->total = $total;
                $transaksi->user_id = auth()->user()->id;  // Menyesuaikan dengan user yang sedang login
                $transaksi->cabang_id = auth()->user()->cabang_id;  // Mengambil cabang dari user yang sedang login
            });
        }
    
        public function cabang(): BelongsTo
        {
            return $this->belongsTo(Cabang::class);
        }
    
    
        public function user(): BelongsTo
        {
            return $this->belongsTo(User::class);
        }
        
        public function transaksiDetails()
        {
            return $this->hasMany(TransaksiDetail::class);
        }
}
