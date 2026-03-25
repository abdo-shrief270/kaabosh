<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Phase 1 - Launch Pages
Route::get('/', fn () => Inertia::render('Home'))->name('home');
Route::get('/products', fn () => Inertia::render('Products/Index'))->name('products.index');
Route::get('/products/{slug}', fn ($slug) => Inertia::render('Products/Show', ['slug' => $slug]))->name('products.show');
Route::get('/products/{slug}/docs', fn ($slug) => Inertia::render('Products/Docs', ['slug' => $slug]))->name('products.docs');
Route::get('/pricing', fn () => Inertia::render('Pricing'))->name('pricing');
Route::get('/about', fn () => Inertia::render('About'))->name('about');
Route::get('/contact', fn () => Inertia::render('Contact'))->name('contact');
Route::get('/privacy-policy', fn () => Inertia::render('Legal/PrivacyPolicy'))->name('legal.privacy');
Route::get('/terms-of-service', fn () => Inertia::render('Legal/TermsOfService'))->name('legal.terms');
Route::get('/cookie-policy', fn () => Inertia::render('Legal/CookiePolicy'))->name('legal.cookies');
Route::get('/sitemap', fn () => Inertia::render('Sitemap'))->name('sitemap');


// Sitemap (generates static file)
Route::get('/generate-sitemap', function () {
    $urls = collect();

    $urls->push(['loc' => url('/'), 'priority' => '1.0', 'changefreq' => 'weekly']);
    $urls->push(['loc' => route('products.index'), 'priority' => '0.9', 'changefreq' => 'weekly']);
    $urls->push(['loc' => route('pricing'), 'priority' => '0.8', 'changefreq' => 'monthly']);
    $urls->push(['loc' => route('about'), 'priority' => '0.7', 'changefreq' => 'monthly']);
    $urls->push(['loc' => route('contact'), 'priority' => '0.7', 'changefreq' => 'monthly']);
    $urls->push(['loc' => route('legal.privacy'), 'priority' => '0.3', 'changefreq' => 'yearly']);
    $urls->push(['loc' => route('legal.terms'), 'priority' => '0.3', 'changefreq' => 'yearly']);
    $urls->push(['loc' => route('legal.cookies'), 'priority' => '0.3', 'changefreq' => 'yearly']);

    $content = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    $content .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

    foreach ($urls as $url) {
        $content .= "  <url>\n";
        $content .= "    <loc>{$url['loc']}</loc>\n";
        $content .= "    <changefreq>{$url['changefreq']}</changefreq>\n";
        $content .= "    <priority>{$url['priority']}</priority>\n";
        $content .= "  </url>\n";
    }

    $content .= '</urlset>';

    file_put_contents(public_path('sitemap.xml'), $content);

    return response($content, 200, ['Content-Type' => 'application/xml']);
})->name('generate-sitemap');
