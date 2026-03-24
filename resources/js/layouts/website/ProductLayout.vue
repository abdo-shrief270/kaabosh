<script setup lang="ts">
import DefaultLayout from './DefaultLayout.vue';
import { Button } from '@/components/ui/button';
import { Link } from '@inertiajs/vue3';
import { ArrowRight } from 'lucide-vue-next';

const props = defineProps<{
    product: {
        name: string;
        slug: string;
        accentColor?: string;
        status?: string;
    };
}>();

const anchorLinks = [
    { label: 'Features', href: '#features' },
    { label: 'Modules', href: '#modules' },
    { label: 'Pricing', href: '#pricing' },
    { label: 'Docs', href: 'docs' },
    { label: 'Changelog', href: '#changelog' },
];
</script>

<template>
    <DefaultLayout>
        <!-- Product Navigation Bar -->
        <div
            class="sticky top-16 z-40 border-b bg-background/95 backdrop-blur supports-[backdrop-filter]:bg-background/60"
            :style="props.product.accentColor ? { '--product-accent': props.product.accentColor } : {}"
        >
            <div class="mx-auto flex h-12 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
                <div class="flex items-center gap-4 overflow-x-auto">
                    <span class="font-semibold text-sm whitespace-nowrap">{{ product.name }}</span>
                    <nav class="flex items-center gap-1" aria-label="Product navigation">
                        <a
                            v-for="link in anchorLinks"
                            :key="link.label"
                            :href="link.href.startsWith('#') ? link.href : `/products/${product.slug}/${link.href}`"
                            class="rounded-md px-2.5 py-1 text-sm text-muted-foreground hover:text-foreground hover:bg-accent transition-colors whitespace-nowrap"
                        >
                            {{ link.label }}
                        </a>
                    </nav>
                </div>
                <Button size="sm" class="shrink-0 ml-4">
                    {{ product.status === 'coming-soon' ? 'Join Waitlist' : 'Start Free Trial' }}
                    <ArrowRight class="ml-1 size-3" />
                </Button>
            </div>
        </div>

        <slot />
    </DefaultLayout>
</template>
