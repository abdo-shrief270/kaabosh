<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'slug',
        'title',
        'excerpt',
        'body',
        'featured_image',
        'author_id',
        'blog_category_id',
        'tags',
        'reading_time',
        'locale',
        'seo',
        'published_at',
    ];

    protected $casts = [
        'tags' => 'array',
        'seo' => 'array',
        'reading_time' => 'integer',
        'published_at' => 'datetime',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }

    // Scopes

    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')->where('published_at', '<=', now());
    }

    public function scopeByLocale($query, string $locale = 'en')
    {
        return $query->where('locale', $locale);
    }

    public function scopeByCategory($query, int $categoryId)
    {
        return $query->where('blog_category_id', $categoryId);
    }
}
