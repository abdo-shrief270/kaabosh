<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Product::active()
            ->sorted()
            ->with(['modules', 'features']);

        if ($request->has('audience')) {
            $audience = $request->input('audience');
            $query->whereJsonContains('audiences', $audience);
        }

        $products = $query->get();

        return response()->json([
            'products' => $products,
        ]);
    }

    public function show(Product $product): JsonResponse
    {
        $product->load([
            'modules',
            'features',
            'faqs',
            'screenshots',
            'pricingPlans',
        ]);

        return response()->json([
            'product' => $product,
        ]);
    }

    public function docsOverview(Product $product): JsonResponse
    {
        return response()->json([
            'product' => [
                'slug' => $product->slug,
                'name' => $product->name,
                'externalDocsUrl' => $product->external_docs_url,
            ],
            'modules' => $product->modules()->get(['id', 'name', 'slug', 'description', 'sort_order']),
        ]);
    }
}
