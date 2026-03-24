<script setup lang="ts">
import { ref } from 'vue';
import { Play, ChevronLeft, ChevronRight, X } from 'lucide-vue-next';

const props = defineProps<{
    videoUrl?: string | null;
    posterImage?: string;
    screenshots?: Array<{ src: string; alt: string }>;
}>();

const playing = ref(false);
const lightboxOpen = ref(false);
const lightboxIndex = ref(0);

function openLightbox(index: number) {
    lightboxIndex.value = index;
    lightboxOpen.value = true;
}

function closeLightbox() {
    lightboxOpen.value = false;
}

function prevImage() {
    if (!props.screenshots) return;
    lightboxIndex.value = (lightboxIndex.value - 1 + props.screenshots.length) % props.screenshots.length;
}

function nextImage() {
    if (!props.screenshots) return;
    lightboxIndex.value = (lightboxIndex.value + 1) % props.screenshots.length;
}

function handleLightboxKey(e: KeyboardEvent) {
    if (e.key === 'Escape') closeLightbox();
    if (e.key === 'ArrowLeft') prevImage();
    if (e.key === 'ArrowRight') nextImage();
}
</script>

<template>
    <!-- Video Player -->
    <div v-if="videoUrl" class="relative rounded-xl overflow-hidden bg-muted aspect-video max-w-4xl mx-auto">
        <video
            v-if="playing"
            :src="videoUrl"
            controls
            autoplay
            class="w-full h-full object-cover"
        />
        <template v-else>
            <img
                v-if="posterImage"
                :src="posterImage"
                alt="Video thumbnail"
                class="w-full h-full object-cover"
            />
            <div class="absolute inset-0 flex items-center justify-center bg-black/20">
                <button
                    class="flex size-16 items-center justify-center rounded-full bg-white/90 text-black shadow-lg transition-transform hover:scale-110"
                    @click="playing = true"
                >
                    <Play class="size-6 ml-1" />
                </button>
            </div>
        </template>
    </div>

    <!-- Screenshot Gallery -->
    <div v-else-if="screenshots?.length" class="max-w-4xl mx-auto">
        <div class="grid gap-4 sm:grid-cols-3">
            <button
                v-for="(screenshot, i) in screenshots"
                :key="i"
                class="rounded-xl border overflow-hidden bg-muted transition-shadow hover:shadow-md cursor-pointer"
                @click="openLightbox(i)"
            >
                <img :src="screenshot.src" :alt="screenshot.alt" class="w-full aspect-video object-cover" loading="lazy" />
            </button>
        </div>

        <!-- Lightbox -->
        <Teleport to="body">
            <div
                v-if="lightboxOpen"
                class="fixed inset-0 z-[90] flex items-center justify-center bg-black/90"
                @click.self="closeLightbox"
                @keydown="handleLightboxKey"
                tabindex="0"
            >
                <button class="absolute top-4 right-4 text-white/80 hover:text-white" @click="closeLightbox">
                    <X class="size-8" />
                </button>
                <button v-if="screenshots.length > 1" class="absolute left-4 text-white/80 hover:text-white" @click="prevImage">
                    <ChevronLeft class="size-10" />
                </button>
                <img
                    :src="screenshots[lightboxIndex].src"
                    :alt="screenshots[lightboxIndex].alt"
                    class="max-h-[80vh] max-w-[90vw] rounded-lg object-contain"
                />
                <button v-if="screenshots.length > 1" class="absolute right-4 text-white/80 hover:text-white" @click="nextImage">
                    <ChevronRight class="size-10" />
                </button>
                <div class="absolute bottom-4 text-white/60 text-sm">
                    {{ lightboxIndex + 1 }} / {{ screenshots.length }}
                </div>
            </div>
        </Teleport>
    </div>

    <!-- Fallback -->
    <div v-else class="rounded-xl border bg-muted/30 p-12 text-center text-muted-foreground max-w-4xl mx-auto">
        No demo available yet.
    </div>
</template>
