<script setup lang="ts">
import DefaultLayout from './DefaultLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, onMounted, nextTick } from 'vue';

const props = defineProps<{
    title: string;
    lastUpdated: string;
}>();

interface TocItem {
    id: string;
    text: string;
}

const toc = ref<TocItem[]>([]);
const contentRef = ref<HTMLElement | null>(null);

onMounted(() => {
    nextTick(() => {
        if (contentRef.value) {
            const headings = contentRef.value.querySelectorAll('h2');
            toc.value = Array.from(headings).map(h => ({
                id: h.id || h.textContent?.toLowerCase().replace(/\s+/g, '-').replace(/[^\w-]/g, '') || '',
                text: h.textContent || '',
            }));
            // Assign IDs if missing
            headings.forEach((h, i) => {
                if (!h.id && toc.value[i]) {
                    h.id = toc.value[i].id;
                }
            });
        }
    });
});
</script>

<template>
    <DefaultLayout>
        <section class="py-12 lg:py-20">
            <div class="mx-auto max-w-[720px] px-4 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold tracking-tight sm:text-4xl">{{ title }}</h1>
                <p class="mt-2 text-sm text-muted-foreground">Last updated: {{ lastUpdated }}</p>

                <!-- Table of Contents -->
                <nav v-if="toc.length" class="mt-8 rounded-xl border bg-muted/30 p-4" aria-label="Table of contents">
                    <h2 class="text-sm font-semibold mb-3">Table of Contents</h2>
                    <ol class="space-y-1">
                        <li v-for="item in toc" :key="item.id">
                            <a
                                :href="`#${item.id}`"
                                class="text-sm text-muted-foreground hover:text-foreground transition-colors"
                            >
                                {{ item.text }}
                            </a>
                        </li>
                    </ol>
                </nav>

                <!-- Content -->
                <div
                    ref="contentRef"
                    class="mt-10 prose prose-sm dark:prose-invert max-w-none
                        prose-h2:text-xl prose-h2:font-bold prose-h2:mt-10 prose-h2:mb-4
                        prose-h3:text-lg prose-h3:font-semibold prose-h3:mt-6 prose-h3:mb-3
                        prose-p:text-muted-foreground prose-p:leading-relaxed prose-p:my-3
                        prose-ul:my-3 prose-li:text-muted-foreground
                        prose-a:text-primary prose-a:underline"
                >
                    <slot />
                </div>

                <!-- Legal contact -->
                <div class="mt-12 rounded-xl border bg-muted/30 p-6 text-sm text-muted-foreground">
                    For legal inquiries, contact us at <a href="mailto:legal@kaabosh.com" class="text-primary underline">legal@kaabosh.com</a>
                </div>
            </div>
        </section>
    </DefaultLayout>
</template>
