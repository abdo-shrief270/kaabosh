<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { X } from 'lucide-vue-next';
import { useLocale } from '@/composables/useLocale';

const { t } = useLocale();

const props = withDefaults(
    defineProps<{
        isActive?: boolean;
        ctaUrl?: string;
        bgColor?: string;
        textColor?: string;
    }>(),
    {
        isActive: false,
        bgColor: 'hsl(var(--primary))',
        textColor: 'hsl(var(--primary-foreground))',
    },
);

const dismissed = ref(false);

onMounted(() => {
    if (sessionStorage.getItem('announcement-dismissed') === 'true') {
        dismissed.value = true;
    }
});

function dismiss() {
    dismissed.value = true;
    sessionStorage.setItem('announcement-dismissed', 'true');
}
</script>

<template>
    <div
        v-if="isActive && !dismissed"
        class="relative flex items-center justify-center gap-3 px-4 py-2 text-sm"
        :style="{ backgroundColor: bgColor, color: textColor }"
    >
        <span>{{ t('announcement.message') }}</span>
        <a
            v-if="ctaUrl"
            :href="ctaUrl"
            class="font-semibold underline underline-offset-2 hover:opacity-80"
        >
            {{ t('announcement.cta') }}
        </a>
        <button
            class="absolute top-1/2 -translate-y-1/2 rounded p-1 transition-opacity hover:opacity-70 ltr:right-3 rtl:left-3"
            @click="dismiss"
            aria-label="Dismiss announcement"
        >
            <X class="size-4" />
        </button>
    </div>
</template>
