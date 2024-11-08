<?php

namespace App\Models;

use App\Casts\ArabicDateCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Category;
use App\Models\CategoryProject;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Models\Donation;
use App\Models\ProjectQuickDonation;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use App\Models\Transaction;

class Project extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    // use Sluggable;

    const MEDIA_COLLECTION = 'project-cover';

    protected $fillable = [
        'display_in_navbar',
        'display_in_homepage',
        'title',
        'description',
        'details',
        'minimum_donation_value',
        'donationـofficer_name',
        'donationـofficer_number',
        'required_donation_value',
        'requires_donator_phone_number',
    ];

    protected $casts = [
        'created_at' => ArabicDateCast::class,
        'details' => 'array',
        'requires_donator_phone_number' => 'boolean',
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class)->using(CategoryProject::class)->withTimestamps();
    }

    public function transactions(): MorphMany
    {
        return $this->morphMany(Transaction::class, 'transactionable');
    }
    public function donations(): MorphMany
    {
        return $this->morphMany(Donation::class, 'donationable');
    }

    public function quickDonationValues(): HasMany
    {
        return $this->hasMany(ProjectQuickDonation::class);
    }
}
