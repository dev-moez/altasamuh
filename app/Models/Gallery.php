<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\GalleryItem;
use App\Casts\ArabicDateCast;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Gallery extends Model implements HasMedia
{
    use InteractsWithMedia;

    use HasFactory;
    const MEDIA_COLLECTION = 'gallery-cover';

    protected $fillable = [
        'title',
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
