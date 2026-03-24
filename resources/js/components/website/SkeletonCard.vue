<script setup lang="ts">
withDefaults(defineProps<{
    variant?: 'product' | 'blog' | 'testimonial';
}>(), {
    variant: 'product',
});
</script>

<template>
    <!-- Product Card Skeleton -->
    <div v-if="variant === 'product'" class="rounded-xl border bg-card p-6 animate-pulse">
        <div class="flex items-start gap-3 mb-4">
            <div class="size-10 rounded-lg bg-muted" />
            <div class="flex-1 space-y-2">
                <div class="h-4 w-32 rounded bg-muted" />
                <div class="h-3 w-48 rounded bg-muted" />
            </div>
        </div>
        <div class="flex gap-1.5 mb-4">
            <div class="h-5 w-16 rounded-full bg-muted" />
            <div class="h-5 w-20 rounded-full bg-muted" />
        </div>
        <div class="space-y-1.5 mb-5">
            <div class="h-3 w-24 rounded bg-muted" />
            <div class="flex gap-1.5">
                <div class="h-5 w-16 rounded bg-muted" />
                <div class="h-5 w-20 rounded bg-muted" />
                <div class="h-5 w-18 rounded bg-muted" />
            </div>
        </div>
        <div class="h-9 w-full rounded-md bg-muted" />
    </div>

    <!-- Blog Card Skeleton -->
    <div v-else-if="variant === 'blog'" class="rounded-xl border bg-card overflow-hidden animate-pulse">
        <div class="aspect-video bg-muted" />
        <div class="p-5 space-y-3">
            <div class="h-5 w-16 rounded-full bg-muted" />
            <div class="h-5 w-3/4 rounded bg-muted" />
            <div class="space-y-1.5">
                <div class="h-3 w-full rounded bg-muted" />
                <div class="h-3 w-2/3 rounded bg-muted" />
            </div>
            <div class="flex items-center gap-2 pt-2">
                <div class="size-6 rounded-full bg-muted" />
                <div class="h-3 w-24 rounded bg-muted" />
            </div>
        </div>
    </div>

    <!-- Testimonial Skeleton -->
    <div v-else-if="variant === 'testimonial'" class="rounded-xl border bg-card p-6 animate-pulse">
        <div class="h-4 w-6 rounded bg-muted mb-3" />
        <div class="space-y-2 mb-4">
            <div class="h-3 w-full rounded bg-muted" />
            <div class="h-3 w-full rounded bg-muted" />
            <div class="h-3 w-2/3 rounded bg-muted" />
        </div>
        <div class="flex items-center gap-3">
            <div class="size-10 rounded-full bg-muted" />
            <div class="space-y-1.5">
                <div class="h-3 w-24 rounded bg-muted" />
                <div class="h-3 w-32 rounded bg-muted" />
            </div>
        </div>
    </div>
</template>
