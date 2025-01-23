<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Casts\ArabicDateCast;

class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone_number',
        'message',
    ];

    protected $casts = [
        'created_at' => ArabicDateCast::class
    ];
}
