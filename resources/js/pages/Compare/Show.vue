<script setup lang="ts">
import DefaultLayout from '@/layouts/website/DefaultLayout.vue';
import TestimonialCard from '@/components/website/TestimonialCard.vue';
import { Button } from '@/components/ui/button';
import { Badge } from '@/components/ui/badge';
import { Head, Link } from '@inertiajs/vue3';
import { CheckCircle, XCircle, ArrowRight } from 'lucide-vue-next';
import { useLocale } from '@/composables/useLocale';
import { computed } from 'vue';

const { t } = useLocale();

const props = defineProps<{ slug: string }>();

const competitorData: Record<string, any> = {
    default: {
        name: 'Competitor',
        comparisonRows: [
            { feature: 'Free tier available', kaabosh: true, competitor: true },
            { feature: 'API-first architecture', kaabosh: true, competitor: false },
            { feature: 'Real-time webhooks', kaabosh: true, competitor: false },
            { feature: 'Built-in analytics', kaabosh: true, competitor: false },
            { feature: 'Multi-product platform', kaabosh: true, competitor: false },
            { feature: 'SSO & SCIM', kaabosh: true, competitor: true },
            { feature: 'Audit logs', kaabosh: true, competitor: true },
            { feature: 'White-label options', kaabosh: true, competitor: false },
            { feature: 'Workflow automation', kaabosh: true, competitor: true },
            { feature: 'Native integrations (100+)', kaabosh: true, competitor: true },
            { feature: 'EU data residency', kaabosh: true, competitor: false },
            { feature: 'Per-seat pricing transparency', kaabosh: true, competitor: false },
        ],
        differentiators: [
            {
                title: 'Unified platform, not a patchwork',
                description: 'Kaabosh combines CRM, analytics, helpdesk, and forms in one platform. No need to buy, integrate, and maintain separate tools.',
            },
            {
                title: 'API-first by design',
                description: 'Every feature is accessible via our REST API with full OpenAPI specs, SDKs in five languages, and real-time webhooks.',
            },
            {
                title: 'Transparent, predictable pricing',
                description: 'No hidden fees, no per-contact charges, no surprise overages. You always know what you will pay.',
            },
        ],
        testimonial: {
            quote: 'We switched from our old CRM to Kaabosh in under a week. The migration tool handled everything, and our team was productive from day one. We are saving 40% on tooling costs.',
            customerName: 'Amara Johnson',
            jobTitle: 'Head of Revenue Ops',
            company: 'GrowthPath Solutions',
            photoUrl: '/images/testimonials/amara.jpg',
            productUsed: 'CRM',
        },
    },
};

const competitor = computed(() => {
    const data = competitorData[props.slug] || competitorData.default;
    if (props.slug && props.slug !== 'default') {
        data.name = props.slug.charAt(0).toUpperCase() + props.slug.slice(1).replace(/-/g, ' ');
    }
    return data;
});
</script>

<template>
    <Head :title="`Kaabosh vs ${competitor.name}`">
        <meta :content="`See how Kaabosh compares to ${competitor.name}. Feature-by-feature comparison, key differentiators, and real customer stories.`" name="description" />
    </Head>

    <DefaultLayout>
        <!-- Hero -->
        <section class="relative overflow-hidden bg-muted/30 py-20 lg:py-32">
            <div class="orb orb-1 -top-48 -right-32" aria-hidden="true" />
            <div class="orb orb-2 -bottom-32 -left-48" aria-hidden="true" />
            <div class="bg-mesh-gradient absolute inset-0" aria-hidden="true" />
            <div class="bg-dot-grid absolute inset-0" aria-hidden="true" />
            <div class="relative mx-auto max-w-4xl px-4 text-center sm:px-6 lg:px-8">
                <Badge variant="secondary" class="mb-6">Comparison</Badge>
                <h1 class="text-4xl font-bold tracking-tight sm:text-5xl">Kaabosh vs {{ competitor.name }}</h1>
                <p class="mt-6 text-lg leading-relaxed text-muted-foreground">
                    See how Kaabosh stacks up against {{ competitor.name }}. A transparent, feature-by-feature look at what each platform offers.
                </p>
                <div class="mt-8 flex flex-col items-center justify-center gap-4 sm:flex-row">
                    <Button as-child size="lg">
                        <Link href="/contact">Start Free Trial</Link>
                    </Button>
                    <Button as-child variant="outline" size="lg">
                        <Link href="/pricing">See Pricing</Link>
                    </Button>
                </div>
            </div>
        </section>

        <!-- Comparison Table -->
        <section class="py-20 lg:py-28">
            <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
                <div class="mb-12 text-center">
                    <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">Feature comparison</h2>
                    <p class="mt-4 text-muted-foreground">A side-by-side look at what matters most.</p>
                </div>
                <div class="overflow-hidden rounded-xl border">
                    <!-- Table Header -->
                    <div class="grid grid-cols-3 border-b bg-muted/50 px-4 py-3 text-sm font-semibold">
                        <div>Feature</div>
                        <div class="text-center">Kaabosh</div>
                        <div class="text-center">{{ competitor.name }}</div>
                    </div>
                    <!-- Table Rows -->
                    <div
                        v-for="(row, index) in competitor.comparisonRows"
                        :key="row.feature"
                        class="grid grid-cols-3 items-center px-4 py-3 text-sm"
                        :class="index % 2 === 0 ? 'bg-card' : 'bg-muted/20'"
                    >
                        <div>{{ row.feature }}</div>
                        <div class="flex justify-center">
                            <CheckCircle v-if="row.kaabosh" class="size-5 text-green-600 dark:text-green-400" />
                            <XCircle v-else class="size-5 text-muted-foreground/40" />
                        </div>
                        <div class="flex justify-center">
                            <CheckCircle v-if="row.competitor" class="size-5 text-green-600 dark:text-green-400" />
                            <XCircle v-else class="size-5 text-muted-foreground/40" />
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Key Differentiators -->
        <section class="bg-muted/30 py-20 lg:py-28">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mb-12 text-center">
                    <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">Why teams switch to Kaabosh</h2>
                </div>
                <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    <div v-for="diff in competitor.differentiators" :key="diff.title" class="rounded-xl border bg-card p-6">
                        <h3 class="text-lg font-semibold">{{ diff.title }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-muted-foreground">{{ diff.description }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonial from Switcher -->
        <section class="py-20 lg:py-28">
            <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
                <div class="mb-8 text-center">
                    <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">Hear from a switcher</h2>
                </div>
                <TestimonialCard v-bind="competitor.testimonial" />
            </div>
        </section>

        <!-- CTA -->
        <section class="border-t py-16">
            <div class="mx-auto max-w-7xl px-4 text-center sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold">Ready to make the switch?</h2>
                <p class="mt-2 text-muted-foreground">Try Kaabosh free for 14 days. We will even help you migrate your data.</p>
                <div class="mt-6 flex flex-col items-center justify-center gap-4 sm:flex-row">
                    <Button as-child size="lg">
                        <Link href="/contact">
                            Start Free Trial
                            <ArrowRight class="ms-2 size-4" />
                        </Link>
                    </Button>
                    <Button as-child variant="outline" size="lg">
                        <Link href="/contact?inquiry=migration">Request Migration Help</Link>
                    </Button>
                </div>
            </div>
        </section>
    </DefaultLayout>
</template>
