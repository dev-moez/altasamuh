<?php

namespace App\Models;

use App\Casts\ArabicDateCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class HomeSlider extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;

    const HOME_SLIDER_MEDIA = 'home_slider';

    protected $fillable = [
        'url',
        'display_order',
    ];

    protected $casts = [
        'created_at' => ArabicDateCast::class
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(static::HOME_SLIDER_MEDIA)->singleFile();
    }
}
