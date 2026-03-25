<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ChangelogEntry;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ChangelogController extends Controller
{
    public function __invoke(Request $request)
    {
        $query = ChangelogEntry::with('product')->latest('release_date');

        if ($productSlug = $request->get('product')) {
            $query->whereHas('product', fn ($q) => $q->where('slug', $productSlug));
        }

        $entries = $query->get()->groupBy(fn ($entry) => $entry->release_date->format('F Y'));

        return Inertia::render('Changelog', [
            'entries' => $entries,
            'products' => Product::sorted()->get(['slug', 'name']),
            'currentProduct' => $request->get('product'),
        ]);
    }
}
