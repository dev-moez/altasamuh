<?php

namespace App\Models;

use App\Casts\ArabicDateCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Cart;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'cartable_id',
        'cartable_type',
        'amount'
    ];

    protected $casts = [
        'created_at' => ArabicDateCast::class
    ];

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    public function cartable()
    {
        return $this->morphTo();
    }
}
