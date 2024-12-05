<?php

namespace App\Models;

use App\Casts\ArabicDateCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\CartItem;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'checked_out',
        'session_id',
        'phone_number',
        'country_code',
    ];

    protected $casts = [
        'created_at' => ArabicDateCast::class,
        'checked_out' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function getAmountAttribute(): float
    {
        return $this->items->sum(fn($item) => $item->amount);
    }

    public function scopeCheckedOut(Builder $query): Builder
    {
        return $query->where('checked_out', true);
    }

    public function scopeNotCheckedOut(Builder $query): Builder
    {
        return $query->where('checked_out', false);
    }
}
