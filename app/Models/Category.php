<?php

namespace App\Models;

use App\Casts\ArabicDateCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Project;
use App\Models\CategoryProject;
use Illuminate\Database\Eloquent\Builder;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Category extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;

    const MEDIA_CATEGORY = 'category';

    protected $fillable = [
        'name',
        'description',
        'parent_id',
        'display_on_navbar',
        'display_on_homepage'
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    protected $casts = [
        'display_on_navbar' => 'boolean',
        'display_on_homepage' => 'boolean',
        'created_at' => ArabicDateCast::class
    ];

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class)->using(CategoryProject::class)->withTimestamps();
    }

    public function scopeNavbarCategories(Builder $query): Builder
    {
        return $query->where('display_on_navbar', true);
    }
}
