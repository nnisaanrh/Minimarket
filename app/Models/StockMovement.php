<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockMovement extends Model
{
    protected $table = 'stock_movements';


    protected $fillable = [
        'cabang_id',
        'barang_id',
        'user_id',
        'type',
        'quantity',
        'movement_date'
    ];


    public function cabang(): belongsTo
    {
        return $this->belongsTo(Cabang::class);
    }
    
    public function barang(): belongsTo
    {
        return $this->belongsTo(Barang::class);
    }
    
    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }
    
}
