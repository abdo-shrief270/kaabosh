<script setup lang="ts">
import DefaultLayout from './DefaultLayout.vue';
import { ref, onMounted, onUnmounted } from 'vue';

const progress = ref(0);

function updateProgress() {
    const scrollTop = window.scrollY;
    const docHeight =
        document.documentElement.scrollHeight - window.innerHeight;
    progress.value = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
}

onMounted(() => {
    window.addEventListener('scroll', updateProgress, { passive: true });
});

onUnmounted(() => {
    window.removeEventListener('scroll', updateProgress);
});
</script>

<template>
    <DefaultLayout>
        <!-- Reading Progress Bar -->
        <div class="fixed top-0 right-0 left-0 z-[60] h-1 bg-transparent">
            <div
                class="h-full bg-primary transition-[width] duration-100 ease-out"
                :style="{ width: `${progress}%` }"
            />
        </div>

        <article class="mx-auto max-w-3xl px-4 py-12 sm:px-6 lg:px-8 lg:py-16">
            <slot />
        </article>

        <!-- Related Posts -->
        <div v-if="$slots.related" class="border-t bg-muted/30 py-12">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <slot name="related" />
            </div>
        </div>
    </DefaultLayout>
</template>
