<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobApplication extends Model
{
    protected $fillable = [
        'job_role_id',
        'full_name',
        'email',
        'phone',
        'country',
        'cv_path',
        'linkedin_url',
        'portfolio_url',
        'cover_letter',
        'referral_source',
        'referral_name',
        'diversity_gender',
        'diversity_ethnicity',
        'diversity_disability',
        'status',
        'reference_number',
    ];

    public function jobRole(): BelongsTo
    {
        return $this->belongsTo(JobRole::class);
    }

    public function scopeByStatus($query, string $status)
    {
        return $query->where('status', $status);
    }
}
