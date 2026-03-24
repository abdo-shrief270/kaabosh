<script setup lang="ts">
import { useAppearance } from '@/composables/useAppearance';
import { Button } from '@/components/ui/button';
import { Sun, Moon } from 'lucide-vue-next';

const { resolvedAppearance, updateAppearance } = useAppearance();

function toggle() {
    updateAppearance(resolvedAppearance.value === 'dark' ? 'light' : 'dark');
}
</script>

<template>
    <Button
        variant="ghost"
        size="icon"
        :title="
            resolvedAppearance === 'dark'
                ? 'Switch to light mode'
                : 'Switch to dark mode'
        "
        @click="toggle"
    >
        <Sun v-if="resolvedAppearance === 'dark'" class="size-5" />
        <Moon v-else class="size-5" />
        <span class="sr-only">Toggle dark mode</span>
    </Button>
</template>
