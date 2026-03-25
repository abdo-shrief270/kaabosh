<?php

use Illuminate\Support\Facades\Route;

// All API routes are prefixed with /api/v1
Route::prefix('v1')->group(function () {

    // Site-level
    Route::get('site/announcement-bar', [App\Http\Controllers\Api\SiteController::class, 'announcementBar']);
    Route::get('site/navigation', [App\Http\Controllers\Api\SiteController::class, 'navigation']);
    Route::get('site/homepage', [App\Http\Controllers\Api\SiteController::class, 'homepage']);
    Route::get('site/about', [App\Http\Controllers\Api\SiteController::class, 'about']);
    Route::get('site/security', [App\Http\Controllers\Api\SiteController::class, 'security']);
    Route::get('site/use-case/{audience}', [App\Http\Controllers\Api\SiteController::class, 'useCase']);
    Route::get('site/legal/{type}', [App\Http\Controllers\Api\SiteController::class, 'legal']);

    // Products
    Route::get('products', [App\Http\Controllers\Api\ProductController::class, 'index']);
    Route::get('products/{product}', [App\Http\Controllers\Api\ProductController::class, 'show']);
    Route::get('products/{product}/docs-overview', [App\Http\Controllers\Api\ProductController::class, 'docsOverview']);

    // Pricing
    Route::get('pricing', [App\Http\Controllers\Api\PricingController::class, 'index']);

    // Blog
    Route::get('blog', [App\Http\Controllers\Api\BlogController::class, 'index']);
    Route::get('blog/{blogPost}', [App\Http\Controllers\Api\BlogController::class, 'show']);

    // Social Proof
    Route::get('social-proof/logos', [App\Http\Controllers\Api\SocialProofController::class, 'logos']);
    Route::get('social-proof/testimonials', [App\Http\Controllers\Api\SocialProofController::class, 'testimonials']);

    // Changelog
    Route::get('changelog', [App\Http\Controllers\Api\ChangelogController::class, 'index']);

    // Careers
    Route::get('careers', [App\Http\Controllers\Api\CareerController::class, 'index']);
    Route::get('careers/{jobRole}', [App\Http\Controllers\Api\CareerController::class, 'show']);

    // Search
    Route::get('search', [App\Http\Controllers\Api\SearchController::class, 'search']);

    // Mutations (POST) — rate limited to 30 requests per minute
    Route::middleware('throttle:30,1')->group(function () {
        Route::post('leads/waitlist', [App\Http\Controllers\Api\LeadController::class, 'waitlist']);
        Route::post('leads/changelog-subscribe', [App\Http\Controllers\Api\LeadController::class, 'changelogSubscribe']);
        Route::post('contact', [App\Http\Controllers\Api\ContactController::class, 'general']);
        Route::post('contact/sales', [App\Http\Controllers\Api\ContactController::class, 'sales']);
        Route::post('contact/chat-offline', [App\Http\Controllers\Api\ContactController::class, 'chatOffline']);
        Route::post('careers/interest', [App\Http\Controllers\Api\CareerController::class, 'interest']);
        Route::post('careers/{jobRole}/apply', [App\Http\Controllers\Api\CareerController::class, 'apply']);
    });
});
