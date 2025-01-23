<?php

namespace App\Models;

use App\Casts\ArabicDateCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MiscDonationValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'value'
    ];

    protected $casts = [
        'created_at' => ArabicDateCast::class,
        'value' => 'integer'
    ];
}
