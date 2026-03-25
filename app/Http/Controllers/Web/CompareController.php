<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Inertia\Inertia;

class CompareController extends Controller
{
    public function show(string $slug)
    {
        $page = Page::where('slug', 'compare-' . $slug)->firstOrFail();

        return Inertia::render('Compare/Show', [
            'page' => $page,
            'slug' => $slug,
        ]);
    }
}
