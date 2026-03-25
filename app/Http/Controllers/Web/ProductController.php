<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Testimonial;
use App\Models\TrustLogo;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        return Inertia::render('Products/Index', [
            'products' => Product::sorted()->get()->map(fn ($p) => [
                'logo' => $p->logo,
                'name' => $p->name,
                'slug' => $p->slug,
                'tagline' => $p->tagline,
                'audienceTags' => $p->audiences,
                'modules' => $p->modules()->sorted()->take(3)->pluck('name')->toArray(),
                'status' => $p->status,
                'description' => $p->description,
            ]),
        ]);
    }

    public function show(Product $product)
    {
        $product->load(['modules' => fn ($q) => $q->orderBy('sort_order'),
            'features' => fn ($q) => $q->orderBy('sort_order'),
            'faqs' => fn ($q) => $q->orderBy('sort_order'),
            'pricingPlans' => fn ($q) => $q->orderBy('sort_order'),
            'screenshots' => fn ($q) => $q->orderBy('sort_order'),
        ]);

        return Inertia::render('Products/Show', [
            'product' => $product,
            'testimonials' => Testimonial::where('product_used', $product->slug)->active()->sorted()->get(),
            'trustLogos' => TrustLogo::forContext($product->slug)->active()->sorted()->get(),
        ]);
    }

    public function docs(Product $product)
    {
        return Inertia::render('Products/Docs', [
            'product' => $product->only('slug', 'name', 'tagline', 'external_docs_url'),
        ]);
    }
}
