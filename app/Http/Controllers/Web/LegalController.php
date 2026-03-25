<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Inertia\Inertia;

class LegalController extends Controller
{
    public function privacy()
    {
        $page = Page::where('slug', 'privacy-policy')->first();

        return Inertia::render('Legal/PrivacyPolicy', [
            'page' => $page,
        ]);
    }

    public function terms()
    {
        $page = Page::where('slug', 'terms-of-service')->first();

        return Inertia::render('Legal/TermsOfService', [
            'page' => $page,
        ]);
    }

    public function cookies()
    {
        $page = Page::where('slug', 'cookie-policy')->first();

        return Inertia::render('Legal/CookiePolicy', [
            'page' => $page,
        ]);
    }
}
