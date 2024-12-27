<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaksi extends Model
{



        protected $fillable = [
            'cabang_id',
            'user_id',
            'total'
        ];
    
    
        public function cabang(): BelongsTo
        {
            return $this->belongsTo(Cabang::class);
        }
    
    
        public function user(): BelongsTo
        {
            return $this->belongsTo(User::class);
        }
}
