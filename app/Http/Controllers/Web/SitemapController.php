<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\BlogPost;
use App\Models\Integration;
use App\Models\JobRole;
use Inertia\Inertia;

class SitemapController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Sitemap', [
            'products' => Product::sorted()->get(['slug', 'name']),
            'blogPosts' => BlogPost::published()->latest('published_at')->get(['slug', 'title']),
            'integrations' => Integration::active()->sorted()->get(['slug', 'name']),
            'careers' => JobRole::active()->notExpired()->get(['slug', 'title']),
        ]);
    }
}
