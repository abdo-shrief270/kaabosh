<script setup lang="ts">
import TestimonialCard from './TestimonialCard.vue';

defineProps<{
    testimonials: Array<{
        quote: string;
        customerName: string;
        jobTitle: string;
        company: string;
        photoUrl?: string;
        productUsed?: string;
    }>;
    title?: string;
}>();
</script>

<template>
    <section v-if="testimonials.length" class="relative overflow-hidden py-20 lg:py-28 bg-muted/30">
        <div class="absolute inset-0 bg-radial-glow" aria-hidden="true" />
        <div class="absolute inset-0 bg-dot-grid" aria-hidden="true" />
        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <h2 v-if="title" class="text-3xl font-bold tracking-tight text-center sm:text-4xl mb-12">{{ title }}</h2>
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <TestimonialCard
                    v-for="(t, i) in testimonials"
                    :key="i"
                    :quote="t.quote"
                    :customer-name="t.customerName"
                    :job-title="t.jobTitle"
                    :company="t.company"
                    :photo-url="t.photoUrl"
                    :product-used="t.productUsed"
                />
            </div>
        </div>
    </section>
</template>
