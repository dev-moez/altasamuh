<?php

namespace App\Models;

use App\Casts\ArabicDateCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PhoneNumberVerification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'otp',
        'phone_number'
    ];

    protected $casts = [
        'created_at' => ArabicDateCast::class
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
