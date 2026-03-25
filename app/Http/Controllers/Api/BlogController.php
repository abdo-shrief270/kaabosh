<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $locale = $request->input('locale', 'en');
        $perPage = min((int) $request->input('perPage', 12), 50);

        $query = BlogPost::published()
            ->byLocale($locale)
            ->with(['author', 'category'])
            ->orderByDesc('published_at');

        if ($request->filled('category')) {
            $category = BlogCategory::where('slug', $request->input('category'))->first();
            if ($category) {
                $query->byCategory($category->id);
            }
        }

        if ($request->filled('tag')) {
            $query->whereJsonContains('tags', $request->input('tag'));
        }

        $posts = $query->paginate($perPage);

        return response()->json([
            'posts' => $posts->items(),
            'pagination' => [
                'currentPage' => $posts->currentPage(),
                'lastPage' => $posts->lastPage(),
                'perPage' => $posts->perPage(),
                'total' => $posts->total(),
            ],
            'categories' => BlogCategory::orderBy('name')->get(['id', 'slug', 'name']),
        ]);
    }

    public function show(BlogPost $blogPost): JsonResponse
    {
        $blogPost->load(['author', 'category']);

        $related = BlogPost::published()
            ->where('id', '!=', $blogPost->id)
            ->where('blog_category_id', $blogPost->blog_category_id)
            ->orderByDesc('published_at')
            ->limit(3)
            ->get();

        return response()->json([
            'post' => $blogPost,
            'relatedPosts' => $related,
        ]);
    }
}
