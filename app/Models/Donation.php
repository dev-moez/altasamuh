<?php

namespace App\Models;

use App\Casts\ArabicDateCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Affiliate;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'donationable_type',
        'donationable_id',
        'user_id',
        'transaction_id',
        'amount',
        'phone_number',
        'name',
        'affiliate_id'
    ];

    protected $casts = [
        'created_at' => ArabicDateCast::class
    ];


    public function donationable()
    {
        return $this->morphTo();
    }

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopePaid(Builder $query): Builder
    {
        return $query->whereHas('transaction', fn($query) => $query->whereNotNull('paid_at')->where('status', Transaction::STATUS_PAID))
            ->orWhereNull('transaction_id');
    }

    public function affiliate(): BelongsTo
    {
        return $this->belongsTo(Affiliate::class);
    }
}
