<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Page;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request): JsonResponse
    {
        $query = $request->input('q', '');

        if (strlen($query) < 2) {
            return response()->json([
                'results' => [],
                'query' => $query,
            ]);
        }

        $term = '%' . $query . '%';

        $products = Product::active()
            ->where(function ($q) use ($term) {
                $q->where('name', 'like', $term)
                    ->orWhere('tagline', 'like', $term)
                    ->orWhere('description', 'like', $term);
            })
            ->limit(5)
            ->get(['slug', 'name', 'tagline', 'logo'])
            ->map(fn ($p) => [
                'type' => 'product',
                'title' => $p->name,
                'description' => $p->tagline,
                'url' => "/products/{$p->slug}",
                'logo' => $p->logo,
            ]);

        $posts = BlogPost::published()
            ->where(function ($q) use ($term) {
                $q->where('title', 'like', $term)
                    ->orWhere('excerpt', 'like', $term)
                    ->orWhere('body', 'like', $term);
            })
            ->limit(5)
            ->get(['slug', 'title', 'excerpt', 'featured_image'])
            ->map(fn ($p) => [
                'type' => 'blog',
                'title' => $p->title,
                'description' => $p->excerpt,
                'url' => "/blog/{$p->slug}",
                'image' => $p->featured_image,
            ]);

        $pages = Page::where(function ($q) use ($term) {
                $q->where('title', 'like', $term)
                    ->orWhere('body', 'like', $term);
            })
            ->where('locale', 'en')
            ->limit(5)
            ->get(['slug', 'title', 'type'])
            ->map(fn ($p) => [
                'type' => 'page',
                'title' => $p->title,
                'description' => null,
                'url' => "/{$p->slug}",
            ]);

        $results = $products->concat($posts)->concat($pages);

        return response()->json([
            'results' => $results->values(),
            'query' => $query,
            'total' => $results->count(),
        ]);
    }
}
