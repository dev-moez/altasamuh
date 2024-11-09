<?php

namespace App\Models;

use App\Casts\ArabicDateCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Project;

class ProjectQuickDonation extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'amount',
    ];

    protected $casts = [
        'created_at' => ArabicDateCast::class,
        'amount' => 'integer',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
