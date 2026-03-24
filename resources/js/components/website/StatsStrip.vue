<script setup lang="ts">
defineProps<{
    stats: Array<{ value: string; label: string }>;
}>();
</script>

<template>
    <section class="relative overflow-hidden border-y bg-muted/20 py-12">
        <div class="absolute inset-0 bg-mesh-gradient" aria-hidden="true" />
        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap items-center justify-center gap-8 lg:gap-16">
                <div
                    v-for="stat in stats"
                    :key="stat.label"
                    class="text-center"
                >
                    <div class="text-3xl font-bold lg:text-4xl">{{ stat.value }}</div>
                    <div class="mt-1 text-sm text-muted-foreground">{{ stat.label }}</div>
                </div>
            </div>
        </div>
    </section>
</template>
