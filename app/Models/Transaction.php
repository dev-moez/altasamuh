<?php

namespace App\Models;

use App\Casts\ArabicDateCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Project;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Cart;
use App\Models\Affiliate;

class Transaction extends Model
{
    use HasFactory;
    use SoftDeletes;

    const STATUS_PENDING = 'pending';
    const STATUS_PAID = 'SUCCESS';
    const STATUS_FAILED = 'FAILED';

    protected $fillable = [
        'user_id',
        'project_id',
        'invoice_url',
        'invoice_id',
        'order_id',
        'paid_at',
        'cart_id',
        'callback_response',
        'redirect_response',
        'status',
        'amount',
        'affiliate_id',
        'phone_number',
        'country_code',
    ];

    protected $casts = [
        'created_at' => ArabicDateCast::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    // public function project(): BelongsTo
    // {
    //     return $this->belongsTo(Project::class);
    // }

    // public function transactionable()
    // {
    //     return $this->morphTo();
    // }

    public function isPaid(): bool
    {
        return $this->status === self::STATUS_PAID && $this->paid_at !== null;
    }

    public function scopePaid($query)
    {
        return $query->where('status', self::STATUS_PAID)->whereNotNull('paid_at');
    }

    public static function getStatusOptions()
    {
        return self::select('status')->distinct()->get()->pluck('status', 'status')->toArray();
    }

    public function affiliate(): BelongsTo
    {
        return $this->belongsTo(Affiliate::class);
    }

    public function fullPhoneNumber()
    {
        if ($this->user) {
            return $this->user->fullPhoneNumber();
        }
        return $this->country_code . $this->phone_number;
    }
}
