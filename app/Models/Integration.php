<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Integration extends Model
{
    protected $fillable = [
        'slug',
        'name',
        'description',
        'logo',
        'category',
        'connected_products',
        'setup_steps',
        'external_url',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'connected_products' => 'array',
        'setup_steps' => 'array',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByCategory($query, string $category)
    {
        return $query->where('category', $category);
    }

    public function scopeSorted($query)
    {
        return $query->orderBy('sort_order');
    }
}
