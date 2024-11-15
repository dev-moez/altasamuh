<?php

namespace App\Models;

use App\Casts\ArabicDateCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'selected_by_default',
    ];

    protected $casts = [
        'created_at' => ArabicDateCast::class,
        'selected_by_default' => 'boolean',
    ];
}
