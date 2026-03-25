<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'email',
        'first_name',
        'product_interest',
        'source',
        'locale',
    ];

    public function scopeBySource($query, string $source)
    {
        return $query->where('source', $source);
    }

    public function scopeByLocale($query, string $locale = 'en')
    {
        return $query->where('locale', $locale);
    }
}
