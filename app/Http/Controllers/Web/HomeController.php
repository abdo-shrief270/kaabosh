<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Testimonial;
use App\Models\TrustLogo;
use App\Models\CompanyValue;
use App\Models\AnnouncementBar;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Home', [
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
            'trustLogos' => TrustLogo::forContext('homepage')->active()->sorted()->get(['name', 'image_url', 'alt_text']),
            'testimonials' => Testimonial::forPage('homepage')->active()->sorted()->get(),
            'differentiators' => CompanyValue::sorted()->get(),
        ]);
    }
}
