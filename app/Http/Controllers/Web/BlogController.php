<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = BlogPost::published()->byLocale($request->get('locale', 'en'))
            ->with('author', 'category')
            ->latest('published_at');

        if ($category = $request->get('category')) {
            $query->whereHas('category', fn ($q) => $q->where('slug', $category));
        }

        return Inertia::render('Blog/Index', [
            'posts' => $query->paginate(9)->through(fn ($post) => [
                'slug' => $post->slug,
                'title' => $post->title,
                'excerpt' => $post->excerpt,
                'featuredImage' => $post->featured_image,
                'author' => ['name' => $post->author->name, 'photo' => $post->author->photo],
                'publishedAt' => $post->published_at->format('M d, Y'),
                'readingTime' => $post->reading_time . ' min read',
                'category' => $post->category?->name,
            ]),
            'categories' => BlogCategory::all(['name', 'slug']),
            'currentCategory' => $request->get('category'),
        ]);
    }

    public function show(BlogPost $blogPost)
    {
        $blogPost->load('author', 'category');

        $relatedPosts = BlogPost::published()
            ->where('id', '!=', $blogPost->id)
            ->where('blog_category_id', $blogPost->blog_category_id)
            ->latest('published_at')
            ->take(3)
            ->with('author')
            ->get()
            ->map(fn ($p) => [
                'slug' => $p->slug,
                'title' => $p->title,
                'excerpt' => $p->excerpt,
                'featuredImage' => $p->featured_image,
                'author' => ['name' => $p->author->name, 'photo' => $p->author->photo],
                'publishedAt' => $p->published_at->format('M d, Y'),
                'readingTime' => $p->reading_time . ' min read',
                'category' => $p->category?->name,
            ]);

        return Inertia::render('Blog/Show', [
            'post' => [
                'slug' => $blogPost->slug,
                'title' => $blogPost->title,
                'excerpt' => $blogPost->excerpt,
                'body' => $blogPost->body,
                'featuredImage' => $blogPost->featured_image,
                'author' => [
                    'name' => $blogPost->author->name,
                    'photo' => $blogPost->author->photo,
                    'bio' => $blogPost->author->bio,
                    'slug' => $blogPost->author->slug,
                ],
                'publishedAt' => $blogPost->published_at->format('M d, Y'),
                'readingTime' => $blogPost->reading_time . ' min read',
                'category' => $blogPost->category?->name,
                'tags' => $blogPost->tags ?? [],
            ],
            'relatedPosts' => $relatedPosts,
        ]);
    }
}
