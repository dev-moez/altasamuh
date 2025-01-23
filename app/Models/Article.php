<?php

namespace App\Models;

use App\Casts\ArabicDateCast;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Agent\Agent;
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

    public function isPublished()
    {
        return $this->is_published;
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }
    public function scopePinned(Builder $query): Builder
    {
        return $query->published()->where('is_pinned', true);
    }

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

    public function getContentBriefAttribute(): string
    {
        $agent = new Agent();
        if ($agent->isMobile())
            return substr(strip_tags($this->content), 0, 150) . '...';
        return substr(strip_tags($this->content), 0, 220) . '...';
    }
}
