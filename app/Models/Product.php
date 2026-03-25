<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'slug',
        'name',
        'tagline',
        'description',
        'accent_color',
        'logo',
        'status',
        'audiences',
        'demo_video_url',
        'external_app_url',
        'external_docs_url',
        'seo',
        'sort_order',
    ];

    protected $casts = [
        'audiences' => 'array',
        'seo' => 'array',
        'sort_order' => 'integer',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    // Relationships

    public function modules(): HasMany
    {
        return $this->hasMany(ProductModule::class)->orderBy('sort_order');
    }

    public function features(): HasMany
    {
        return $this->hasMany(ProductFeature::class)->orderBy('sort_order');
    }

    public function faqs(): HasMany
    {
        return $this->hasMany(ProductFaq::class)->orderBy('sort_order');
    }

    public function pricingPlans(): HasMany
    {
        return $this->hasMany(ProductPricingPlan::class)->orderBy('sort_order');
    }

    public function pricingFeatures(): HasMany
    {
        return $this->hasMany(ProductPricingFeature::class)->orderBy('sort_order');
    }

    public function screenshots(): HasMany
    {
        return $this->hasMany(ProductScreenshot::class)->orderBy('sort_order');
    }

    public function changelogEntries(): HasMany
    {
        return $this->hasMany(ChangelogEntry::class)->orderByDesc('release_date');
    }

    // Scopes

    public function scopeLive($query)
    {
        return $query->where('status', 'live');
    }

    public function scopeActive($query)
    {
        return $query->whereIn('status', ['live', 'beta']);
    }

    public function scopeSorted($query)
    {
        return $query->orderBy('sort_order');
    }
}
