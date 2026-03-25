<script setup lang="ts">
import { ref, watch, onMounted, onUnmounted } from 'vue';
import { X, ChevronLeft, ChevronRight } from 'lucide-vue-next';

const props = defineProps<{
    images: { src: string; alt?: string }[];
    modelValue: boolean;
    startIndex?: number;
}>();

const emit = defineEmits<{
    'update:modelValue': [value: boolean];
}>();

const currentIndex = ref(props.startIndex ?? 0);

watch(() => props.startIndex, (val) => {
    if (val !== undefined) currentIndex.value = val;
});

function close() {
    emit('update:modelValue', false);
}

function prev() {
    currentIndex.value = (currentIndex.value - 1 + props.images.length) % props.images.length;
}

function next() {
    currentIndex.value = (currentIndex.value + 1) % props.images.length;
}

function onKeydown(e: KeyboardEvent) {
    if (!props.modelValue) return;
    if (e.key === 'Escape') close();
    if (e.key === 'ArrowLeft') prev();
    if (e.key === 'ArrowRight') next();
}

onMounted(() => document.addEventListener('keydown', onKeydown));
onUnmounted(() => document.removeEventListener('keydown', onKeydown));
</script>

<template>
    <Teleport to="body">
        <Transition name="fade">
            <div
                v-if="modelValue"
                class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm"
                @click.self="close"
            >
                <button
                    class="absolute top-4 right-4 rounded-full bg-white/10 p-2 text-white transition-colors hover:bg-white/20"
                    @click="close"
                    aria-label="Close lightbox"
                >
                    <X class="size-6" />
                </button>

                <button
                    v-if="images.length > 1"
                    class="absolute left-4 rounded-full bg-white/10 p-2 text-white transition-colors hover:bg-white/20"
                    @click="prev"
                    aria-label="Previous image"
                >
                    <ChevronLeft class="size-6" />
                </button>

                <div class="max-h-[85vh] max-w-[90vw]">
                    <img
                        :src="images[currentIndex]?.src"
                        :alt="images[currentIndex]?.alt ?? ''"
                        class="max-h-[85vh] max-w-full rounded-lg object-contain"
                    />
                </div>

                <button
                    v-if="images.length > 1"
                    class="absolute right-4 rounded-full bg-white/10 p-2 text-white transition-colors hover:bg-white/20"
                    @click="next"
                    aria-label="Next image"
                >
                    <ChevronRight class="size-6" />
                </button>

                <div
                    v-if="images.length > 1"
                    class="absolute bottom-6 text-sm text-white/70"
                >
                    {{ currentIndex + 1 }} / {{ images.length }}
                </div>
            </div>
        </Transition>
    </Teleport>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.2s ease;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
