<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Testimonial;
use Inertia\Inertia;

class UseCaseController extends Controller
{
    public function developers()
    {
        return Inertia::render('ForDevelopers', [
            'products' => Product::sorted()->whereJsonContains('audiences', 'developers')->get(),
            'testimonials' => Testimonial::forPage('for-developers')->active()->sorted()->get(),
        ]);
    }

    public function enterprise()
    {
        return Inertia::render('ForEnterprise', [
            'products' => Product::sorted()->whereJsonContains('audiences', 'enterprise')->get(),
            'testimonials' => Testimonial::forPage('for-enterprise')->active()->sorted()->get(),
        ]);
    }

    public function agencies()
    {
        return Inertia::render('ForAgencies', [
            'products' => Product::sorted()->whereJsonContains('audiences', 'agencies')->get(),
            'testimonials' => Testimonial::forPage('for-agencies')->active()->sorted()->get(),
        ]);
    }
}
