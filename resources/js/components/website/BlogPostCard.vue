<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { Badge } from '@/components/ui/badge';

interface Post {
    featuredImage?: string;
    title: string;
    excerpt?: string;
    author: { name: string; photo?: string };
    publishedAt: string;
    category?: string;
    readingTime?: string;
    slug: string;
}

defineProps<{
    post: Post;
    variant?: 'feed' | 'compact';
}>();
</script>

<template>
    <!-- Feed Variant -->
    <Link
        v-if="variant !== 'compact'"
        :href="`/blog/${post.slug}`"
        class="group block overflow-hidden rounded-xl border bg-card transition-shadow hover:shadow-md"
    >
        <div
            v-if="post.featuredImage"
            class="aspect-video overflow-hidden bg-muted"
        >
            <img
                :src="post.featuredImage"
                :alt="post.title"
                class="h-full w-full object-cover transition-transform group-hover:scale-105"
                loading="lazy"
            />
        </div>
        <div class="p-5">
            <Badge
                v-if="post.category"
                variant="secondary"
                class="mb-3 text-xs"
                >{{ post.category }}</Badge
            >
            <h3
                class="line-clamp-2 font-semibold transition-colors group-hover:text-primary"
            >
                {{ post.title }}
            </h3>
            <p
                v-if="post.excerpt"
                class="mt-2 line-clamp-2 text-sm text-muted-foreground"
            >
                {{ post.excerpt }}
            </p>
            <div
                class="mt-4 flex items-center gap-3 text-xs text-muted-foreground"
            >
                <div class="flex items-center gap-2">
                    <div class="size-6 overflow-hidden rounded-full bg-muted">
                        <img
                            v-if="post.author.photo"
                            :src="post.author.photo"
                            :alt="post.author.name"
                            class="size-full object-cover"
                        />
                    </div>
                    <span>{{ post.author.name }}</span>
                </div>
                <span>&middot;</span>
                <span>{{ post.publishedAt }}</span>
                <span v-if="post.readingTime"
                    >&middot; {{ post.readingTime }}</span
                >
            </div>
        </div>
    </Link>

    <!-- Compact Variant -->
    <Link
        v-else
        :href="`/blog/${post.slug}`"
        class="group flex gap-4 rounded-lg p-3 transition-colors hover:bg-accent"
    >
        <div class="min-w-0 flex-1">
            <h4
                class="line-clamp-2 text-sm font-medium transition-colors group-hover:text-primary"
            >
                {{ post.title }}
            </h4>
            <div class="mt-1 text-xs text-muted-foreground">
                {{ post.author.name }} &middot; {{ post.publishedAt }}
            </div>
        </div>
    </Link>
</template>
