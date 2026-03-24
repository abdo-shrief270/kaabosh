<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { X, CheckCircle, AlertCircle, Info } from 'lucide-vue-next';

export interface Toast {
    id: number;
    type: 'success' | 'error' | 'info';
    message: string;
}

const toasts = ref<Toast[]>([]);
let nextId = 0;

function addToast(type: Toast['type'], message: string) {
    const id = nextId++;
    toasts.value.push({ id, type, message });
    setTimeout(() => removeToast(id), 3000);
}

function removeToast(id: number) {
    toasts.value = toasts.value.filter(t => t.id !== id);
}

const iconMap = {
    success: CheckCircle,
    error: AlertCircle,
    info: Info,
};

const colorMap = {
    success: 'border-green-500/30 bg-green-50 text-green-800 dark:bg-green-950/30 dark:text-green-300',
    error: 'border-destructive/30 bg-red-50 text-red-800 dark:bg-red-950/30 dark:text-red-300',
    info: 'border-blue-500/30 bg-blue-50 text-blue-800 dark:bg-blue-950/30 dark:text-blue-300',
};

defineExpose({ addToast });
</script>

<template>
    <Teleport to="body">
        <div class="fixed top-4 right-4 z-[100] flex flex-col gap-2 w-80" aria-live="polite">
            <TransitionGroup
                enter-active-class="transition-all duration-200 ease-out"
                enter-from-class="opacity-0 translate-x-4"
                enter-to-class="opacity-100 translate-x-0"
                leave-active-class="transition-all duration-150 ease-in"
                leave-from-class="opacity-100 translate-x-0"
                leave-to-class="opacity-0 translate-x-4"
            >
                <div
                    v-for="toast in toasts"
                    :key="toast.id"
                    class="flex items-start gap-3 rounded-lg border p-3 shadow-lg"
                    :class="colorMap[toast.type]"
                >
                    <component :is="iconMap[toast.type]" class="size-5 shrink-0 mt-0.5" />
                    <p class="flex-1 text-sm">{{ toast.message }}</p>
                    <button
                        class="shrink-0 rounded p-0.5 hover:opacity-70 transition-opacity"
                        @click="removeToast(toast.id)"
                        aria-label="Dismiss"
                    >
                        <X class="size-4" />
                    </button>
                </div>
            </TransitionGroup>
        </div>
    </Teleport>
</template>
