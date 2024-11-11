<?php

namespace App\Models;

use App\Casts\ArabicDateCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Donation;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Affiliate extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'tracking_code', 'project_id', 'visits'];

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    protected $casts = [
        'created_at' => ArabicDateCast::class
    ];
}
