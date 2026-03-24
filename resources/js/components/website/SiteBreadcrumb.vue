<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { ChevronRight, Home } from 'lucide-vue-next';

export interface BreadcrumbItem {
    label: string;
    href?: string;
}

defineProps<{
    items: BreadcrumbItem[];
}>();
</script>

<template>
    <nav aria-label="Breadcrumb" class="py-3">
        <ol class="flex items-center gap-1.5 text-sm flex-wrap">
            <li class="flex items-center gap-1.5">
                <Link href="/" class="text-muted-foreground hover:text-foreground transition-colors">
                    <Home class="size-3.5" />
                    <span class="sr-only">Home</span>
                </Link>
            </li>
            <template v-for="(item, index) in items" :key="index">
                <li class="flex items-center gap-1.5">
                    <ChevronRight class="size-3.5 text-muted-foreground/50" />
                    <Link
                        v-if="item.href && index < items.length - 1"
                        :href="item.href"
                        class="text-muted-foreground hover:text-foreground transition-colors"
                    >
                        {{ item.label }}
                    </Link>
                    <!-- Last item: non-linked, bold -->
                    <span
                        v-else
                        class="font-medium text-foreground truncate max-w-[200px] sm:max-w-none"
                    >
                        {{ item.label }}
                    </span>
                </li>
            </template>
        </ol>
    </nav>
</template>
