<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Casts\ArabicDateCast;

class BoardMember extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'role',
        'position'
    ];

    protected $casts = [
        'created_at' => ArabicDateCast::class
    ];
}
