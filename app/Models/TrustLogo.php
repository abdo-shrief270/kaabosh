<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrustLogo extends Model
{
    protected $fillable = [
        'name',
        'image_url',
        'alt_text',
        'context',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeForContext($query, string $context)
    {
        return $query->where('context', $context);
    }

    public function scopeSorted($query)
    {
        return $query->orderBy('sort_order');
    }
}
