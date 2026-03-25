<?php

use App\Http\Controllers\Web\AboutController;
use App\Http\Controllers\Web\BlogController;
use App\Http\Controllers\Web\CareerController;
use App\Http\Controllers\Web\ChangelogController;
use App\Http\Controllers\Web\CompareController;
use App\Http\Controllers\Web\ContactController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\IntegrationController;
use App\Http\Controllers\Web\LegalController;
use App\Http\Controllers\Web\PressController;
use App\Http\Controllers\Web\PricingController;
use App\Http\Controllers\Web\ProductController;
use App\Http\Controllers\Web\SecurityController;
use App\Http\Controllers\Web\SitemapController;
use App\Http\Controllers\Web\UseCaseController;
use Illuminate\Support\Facades\Route;

// Phase 1 - Launch Pages
Route::get('/', HomeController::class)->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/products/{product}/docs', [ProductController::class, 'docs'])->name('products.docs');
Route::get('/pricing', PricingController::class)->name('pricing');
Route::get('/about', AboutController::class)->name('about');
Route::get('/contact', ContactController::class)->name('contact');
Route::get('/privacy-policy', [LegalController::class, 'privacy'])->name('legal.privacy');
Route::get('/terms-of-service', [LegalController::class, 'terms'])->name('legal.terms');
Route::get('/cookie-policy', [LegalController::class, 'cookies'])->name('legal.cookies');
Route::get('/sitemap', SitemapController::class)->name('sitemap');

// Phase 2 - Growth Pages
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{blogPost}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/changelog', ChangelogController::class)->name('changelog');
Route::get('/security', SecurityController::class)->name('security');

// Phase 3 - Scale Pages
Route::get('/for-developers', [UseCaseController::class, 'developers'])->name('for-developers');
Route::get('/for-enterprise', [UseCaseController::class, 'enterprise'])->name('for-enterprise');
Route::get('/for-agencies', [UseCaseController::class, 'agencies'])->name('for-agencies');
Route::get('/integrations', [IntegrationController::class, 'index'])->name('integrations.index');
Route::get('/integrations/{integration}', [IntegrationController::class, 'show'])->name('integrations.show');
Route::get('/compare/{slug}', [CompareController::class, 'show'])->name('compare.show');
Route::get('/careers', [CareerController::class, 'index'])->name('careers.index');
Route::get('/careers/{jobRole}', [CareerController::class, 'show'])->name('careers.show');
Route::get('/press', PressController::class)->name('press');

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
    $urls->push(['loc' => route('blog.index'), 'priority' => '0.8', 'changefreq' => 'weekly']);
    $urls->push(['loc' => route('changelog'), 'priority' => '0.6', 'changefreq' => 'weekly']);
    $urls->push(['loc' => route('security'), 'priority' => '0.5', 'changefreq' => 'monthly']);
    $urls->push(['loc' => route('for-developers'), 'priority' => '0.7', 'changefreq' => 'monthly']);
    $urls->push(['loc' => route('for-enterprise'), 'priority' => '0.7', 'changefreq' => 'monthly']);
    $urls->push(['loc' => route('for-agencies'), 'priority' => '0.7', 'changefreq' => 'monthly']);
    $urls->push(['loc' => route('integrations.index'), 'priority' => '0.7', 'changefreq' => 'monthly']);
    $urls->push(['loc' => route('careers.index'), 'priority' => '0.7', 'changefreq' => 'weekly']);
    $urls->push(['loc' => route('press'), 'priority' => '0.5', 'changefreq' => 'monthly']);

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
