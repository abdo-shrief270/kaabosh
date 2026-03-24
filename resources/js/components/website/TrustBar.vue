<script setup lang="ts">
defineProps<{
    logos: Array<{ src: string; alt: string }>;
}>();
</script>

<template>
    <section class="border-y py-8 overflow-hidden">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <p class="text-center text-xs text-muted-foreground uppercase tracking-widest mb-6">Trusted by leading teams</p>
            <div class="relative group">
                <div class="flex animate-marquee gap-12 group-hover:[animation-play-state:paused]">
                    <div
                        v-for="(logo, i) in [...logos, ...logos]"
                        :key="`${logo.alt}-${i}`"
                        class="flex shrink-0 items-center justify-center"
                    >
                        <div class="h-8 w-24 rounded bg-muted flex items-center justify-center text-xs text-muted-foreground">
                            {{ logo.alt }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
@keyframes marquee {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}
.animate-marquee {
    animation: marquee 30s linear infinite;
}
</style>
