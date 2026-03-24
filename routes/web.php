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
