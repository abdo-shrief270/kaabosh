<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobRole extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'slug',
        'title',
        'department',
        'location',
        'work_type',
        'employment_type',
        'experience_level',
        'summary',
        'about_team',
        'responsibilities',
        'requirements',
        'nice_to_have',
        'what_we_offer',
        'hiring_process',
        'salary_range',
        'requires_portfolio',
        'is_active',
        'seo',
        'posted_at',
        'expires_at',
    ];

    protected $casts = [
        'responsibilities' => 'array',
        'requirements' => 'array',
        'nice_to_have' => 'array',
        'what_we_offer' => 'array',
        'hiring_process' => 'array',
        'seo' => 'array',
        'requires_portfolio' => 'boolean',
        'is_active' => 'boolean',
        'posted_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function applications(): HasMany
    {
        return $this->hasMany(JobApplication::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByDepartment($query, string $department)
    {
        return $query->where('department', $department);
    }

    public function scopeNotExpired($query)
    {
        return $query->where(function ($q) {
            $q->whereNull('expires_at')->orWhere('expires_at', '>', now());
        });
    }
}
