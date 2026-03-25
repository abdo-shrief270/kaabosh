<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class PricingController extends Controller
{
    public function index(): JsonResponse
    {
        $products = Product::active()
            ->sorted()
            ->with(['pricingPlans' => fn ($q) => $q->sorted(), 'pricingFeatures' => fn ($q) => $q->sorted()])
            ->get();

        return response()->json([
            'products' => $products->map(function (Product $product) {
                return [
                    'slug' => $product->slug,
                    'name' => $product->name,
                    'tagline' => $product->tagline,
                    'logo' => $product->logo,
                    'accentColor' => $product->accent_color,
                    'plans' => $product->pricingPlans,
                    'comparisonFeatures' => $product->pricingFeatures,
                ];
            }),
        ]);
    }
}
