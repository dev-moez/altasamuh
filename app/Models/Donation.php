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

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'donationable_type',
        'donationable_id',
        'user_id',
        'amount',
    ];

    protected $casts = [
        'created_at' => ArabicDateCast::class
    ];


    public function donationable()
    {
        return $this->morphTo();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function transaction(): MorphOne
    {
        return $this->morphOne(Transaction::class, 'transactionable');
    }
}
