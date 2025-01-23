<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Gallery;
use App\Casts\ArabicDateCast;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class GalleryItem extends Model implements HasMedia
{

    use InteractsWithMedia;

    use HasFactory;

    const GALLERY_MEDIA = 'gallery';

    protected $fillable = [
        'gallery_id',
        'caption',
        'youtube_url',
        'display_order',
    ];

    protected $casts = [
        'created_at' => ArabicDateCast::class
    ];

    public function gallery(): BelongsTo
    {
        return $this->belongsTo(Gallery::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(static::GALLERY_MEDIA)->singleFile();
    }

    public function registerMediaConversions($media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(300)
            ->height(300);
    }
}
