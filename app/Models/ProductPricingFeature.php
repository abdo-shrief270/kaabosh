<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductPricingFeature extends Model
{
    protected $fillable = [
        'product_id',
        'group',
        'feature_name',
        'plan_values',
        'sort_order',
    ];

    protected $casts = [
        'plan_values' => 'array',
        'sort_order' => 'integer',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function scopeSorted($query)
    {
        return $query->orderBy('sort_order');
    }
}
