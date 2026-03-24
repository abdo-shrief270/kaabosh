<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { Badge } from '@/components/ui/badge';
import { ArrowRight } from 'lucide-vue-next';

interface Product {
    logo?: string;
    name: string;
    slug: string;
    tagline: string;
    audienceTags?: string[];
    modules?: string[];
    status: 'live' | 'beta' | 'coming-soon';
    description?: string;
}

defineProps<{
    product: Product;
    variant?: 'large' | 'small';
}>();

const statusConfig = {
    live: { label: 'Available', class: 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300' },
    beta: { label: 'Beta', class: 'bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-300' },
    'coming-soon': { label: 'Coming Soon', class: 'bg-muted text-muted-foreground' },
};
</script>

<template>
    <!-- Large Variant -->
    <div
        v-if="variant !== 'small'"
        class="group rounded-xl border bg-card p-6 transition-shadow hover:shadow-md"
    >
        <div class="flex items-start justify-between mb-4">
            <div class="flex items-center gap-3">
                <div class="flex size-10 items-center justify-center rounded-lg bg-primary/10 text-primary text-sm font-bold">
                    {{ product.name.split(' ')[1]?.[0] || 'K' }}
                </div>
                <div>
                    <h3 class="font-semibold">{{ product.name }}</h3>
                    <p class="text-sm text-muted-foreground">{{ product.tagline }}</p>
                </div>
            </div>
            <span
                class="inline-flex rounded-full px-2 py-0.5 text-xs font-medium"
                :class="statusConfig[product.status].class"
            >
                {{ statusConfig[product.status].label }}
            </span>
        </div>

        <div v-if="product.audienceTags?.length" class="flex flex-wrap gap-1.5 mb-4">
            <Badge v-for="tag in product.audienceTags" :key="tag" variant="secondary" class="text-xs">
                {{ tag }}
            </Badge>
        </div>

        <div v-if="product.modules?.length" class="mb-5">
            <p class="text-xs text-muted-foreground mb-1.5">Key modules:</p>
            <div class="flex flex-wrap gap-1.5">
                <span
                    v-for="mod in product.modules.slice(0, 3)"
                    :key="mod"
                    class="rounded-md bg-muted px-2 py-0.5 text-xs"
                >
                    {{ mod }}
                </span>
            </div>
        </div>

        <Button
            as-child
            :variant="product.status === 'coming-soon' ? 'secondary' : 'default'"
            :disabled="product.status === 'coming-soon'"
            size="sm"
            class="w-full"
        >
            <Link v-if="product.status !== 'coming-soon'" :href="`/products/${product.slug}`">
                Learn More
                <ArrowRight class="ml-1 size-3" />
            </Link>
            <span v-else>Coming Soon</span>
        </Button>
    </div>

    <!-- Small Variant (Mega-menu) -->
    <div v-else class="flex items-center gap-3">
        <div class="flex size-8 shrink-0 items-center justify-center rounded-md bg-primary/10 text-primary text-xs font-bold">
            {{ product.name.split(' ')[1]?.[0] || 'K' }}
        </div>
        <div class="min-w-0">
            <div class="text-sm font-medium truncate">{{ product.name }}</div>
            <div class="text-xs text-muted-foreground truncate">{{ product.description || product.tagline }}</div>
        </div>
    </div>
</template>
