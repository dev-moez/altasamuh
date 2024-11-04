<?php

namespace App\Models;

use App\Casts\ArabicDateCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use App\Models\Donation;

class MiscDonation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title'
    ];

    protected $casts = [
        'created_at' => ArabicDateCast::class
    ];

    public function donations(): MorphToMany
    {
        return $this->morphToMany(Donation::class, 'donationable');
    }
}
