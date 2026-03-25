<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Inertia\Inertia;

class PricingController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Pricing', [
            'products' => Product::sorted()->with([
                'pricingPlans' => fn ($q) => $q->orderBy('sort_order'),
                'pricingFeatures' => fn ($q) => $q->orderBy('sort_order'),
            ])->get()->map(fn ($p) => [
                'slug' => $p->slug,
                'name' => $p->name,
                'logo' => $p->logo,
                'tagline' => $p->tagline,
                'plans' => $p->pricingPlans,
                'comparisonFeatures' => $p->pricingFeatures,
            ]),
        ]);
    }
}
