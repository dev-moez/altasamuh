<?php

namespace App\Models;

use App\Casts\ArabicDateCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Article extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    const MEDIA_COVER = 'article_cover';

    protected $fillable = [
        'title',
        'content',
        'is_published',
        'is_pinned',
        'slug'
    ];

    protected $casts = [
        'created_at' => ArabicDateCast::class,
        'is_pinned' => 'boolean',
        'is_published' => 'boolean',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(static::MEDIA_COVER)->singleFile();
    }

    public function registerMediaConversions($media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(300)
            ->height(300);
    }
}
