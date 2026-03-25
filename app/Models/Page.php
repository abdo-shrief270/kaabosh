<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'slug',
        'type',
        'title',
        'body',
        'seo',
        'locale',
        'last_updated_at',
    ];

    protected $casts = [
        'seo' => 'array',
        'last_updated_at' => 'datetime',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopeByType($query, string $type)
    {
        return $query->where('type', $type);
    }

    public function scopeByLocale($query, string $locale = 'en')
    {
        return $query->where('locale', $locale);
    }
}
