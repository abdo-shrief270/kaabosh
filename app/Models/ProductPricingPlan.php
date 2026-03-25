<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductPricingPlan extends Model
{
    protected $fillable = [
        'product_id',
        'name',
        'monthly_price',
        'annual_price',
        'billing_interval',
        'description',
        'features',
        'is_popular',
        'is_enterprise',
        'sort_order',
    ];

    protected $casts = [
        'monthly_price' => 'decimal:2',
        'annual_price' => 'decimal:2',
        'features' => 'array',
        'is_popular' => 'boolean',
        'is_enterprise' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function scopePopular($query)
    {
        return $query->where('is_popular', true);
    }

    public function scopeSorted($query)
    {
        return $query->orderBy('sort_order');
    }
}
