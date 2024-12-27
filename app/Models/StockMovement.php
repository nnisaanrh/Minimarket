<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockMovement extends Model
{
    protected $table = 'stock_movements';


    protected $fillable = [
        'branch_id',
        'product_id',
        'user_id',
        'type',
        'quantity',
        'movement_date'
    ];


     public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }


    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    } 
    
}
