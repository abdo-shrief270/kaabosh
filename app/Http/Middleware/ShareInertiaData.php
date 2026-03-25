<?php

namespace App\Http\Middleware;

use App\Models\AnnouncementBar;
use App\Models\Product;
use Closure;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ShareInertiaData
{
    public function handle(Request $request, Closure $next)
    {
        Inertia::share([
            'announcement' => fn () => AnnouncementBar::where('is_active', true)->latest()->first(),
            'navProducts' => fn () => Product::sorted()->get(['slug', 'name', 'tagline', 'logo', 'status']),
        ]);

        return $next($request);
    }
}
