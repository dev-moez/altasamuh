<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\GalleryItem;
use App\Casts\ArabicDateCast;

class Gallery extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'display_order'
    ];

    protected $casts = [
        'created_at' => ArabicDateCast::class
    ];

    public function items(): HasMany
    {
        return $this->hasMany(GalleryItem::class);
    }
}
