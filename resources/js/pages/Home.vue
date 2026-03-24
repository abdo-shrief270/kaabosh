<script setup lang="ts">
import DefaultLayout from '@/layouts/website/DefaultLayout.vue';
import TrustBar from '@/components/website/TrustBar.vue';
import ProductCard from '@/components/website/ProductCard.vue';
import AudienceSelector from '@/components/website/AudienceSelector.vue';
import TestimonialsSection from '@/components/website/TestimonialsSection.vue';
import StatsStrip from '@/components/website/StatsStrip.vue';
import EmailCapture from '@/components/website/EmailCapture.vue';
import { Button } from '@/components/ui/button';
import { Head, Link } from '@inertiajs/vue3';
import { ArrowRight, Sparkles } from 'lucide-vue-next';
import { useLocale } from '@/composables/useLocale';
import { computed } from 'vue';

const { t } = useLocale();

const products = computed(() => [
    {
        logo: '/images/products/crm-logo.svg',
        name: t('products.crm.name'),
        slug: 'crm',
        tagline: t('products.crm.tagline'),
        audienceTags: ['SMBs', 'Enterprise'],
        modules: ['Contacts', 'Pipelines', 'Automation'],
        status: 'live' as const,
        description: t('products.crm.description'),
    },
    {
        logo: '/images/products/analytics-logo.svg',
        name: t('products.analytics.name'),
        slug: 'analytics',
        tagline: t('products.analytics.tagline'),
        audienceTags: ['Developers', 'Enterprise'],
        modules: ['Dashboards', 'Reports', 'Integrations'],
        status: 'live' as const,
        description: t('products.analytics.description'),
    },
    {
        logo: '/images/products/helpdesk-logo.svg',
        name: t('products.helpdesk.name'),
        slug: 'helpdesk',
        tagline: t('products.helpdesk.tagline'),
        audienceTags: ['SMBs', 'Consumers'],
        modules: ['Tickets', 'Knowledge Base', 'Live Chat'],
        status: 'beta' as const,
        description: t('products.helpdesk.description'),
    },
    {
        logo: '/images/products/forms-logo.svg',
        name: t('products.forms.name'),
        slug: 'forms',
        tagline: t('products.forms.tagline'),
        audienceTags: ['Developers', 'SMBs', 'Consumers'],
        modules: ['Builder', 'Logic', 'Submissions'],
        status: 'coming-soon' as const,
        description: t('products.forms.description'),
    },
]);

const trustLogos = [
    { src: '/images/logos/company-1.svg', alt: 'Company 1' },
    { src: '/images/logos/company-2.svg', alt: 'Company 2' },
    { src: '/images/logos/company-3.svg', alt: 'Company 3' },
    { src: '/images/logos/company-4.svg', alt: 'Company 4' },
    { src: '/images/logos/company-5.svg', alt: 'Company 5' },
    { src: '/images/logos/company-6.svg', alt: 'Company 6' },
    { src: '/images/logos/company-7.svg', alt: 'Company 7' },
    { src: '/images/logos/company-8.svg', alt: 'Company 8' },
];

const differentiators = computed(() => [
    { icon: 'Zap', title: t('home.differentiators.fast.title'), body: t('home.differentiators.fast.body') },
    { icon: 'Shield', title: t('home.differentiators.secure.title'), body: t('home.differentiators.secure.body') },
    { icon: 'Puzzle', title: t('home.differentiators.integrated.title'), body: t('home.differentiators.integrated.body') },
    { icon: 'Heart', title: t('home.differentiators.simple.title'), body: t('home.differentiators.simple.body') },
]);

const audienceTabs = computed(() => [
    {
        id: 'developers',
        label: t('home.audiences.developers.label'),
        headline: t('home.audiences.developers.headline'),
        body: t('home.audiences.developers.body'),
        benefits: [t('home.audiences.developers.benefits.0'), t('home.audiences.developers.benefits.1'), t('home.audiences.developers.benefits.2')],
        ctaLabel: t('home.audiences.developers.cta'),
        ctaUrl: '/for-developers',
    },
    {
        id: 'businesses',
        label: t('home.audiences.businesses.label'),
        headline: t('home.audiences.businesses.headline'),
        body: t('home.audiences.businesses.body'),
        benefits: [t('home.audiences.businesses.benefits.0'), t('home.audiences.businesses.benefits.1'), t('home.audiences.businesses.benefits.2')],
        ctaLabel: t('home.audiences.businesses.cta'),
        ctaUrl: '/pricing',
    },
    {
        id: 'enterprise',
        label: t('home.audiences.enterprise.label'),
        headline: t('home.audiences.enterprise.headline'),
        body: t('home.audiences.enterprise.body'),
        benefits: [t('home.audiences.enterprise.benefits.0'), t('home.audiences.enterprise.benefits.1'), t('home.audiences.enterprise.benefits.2')],
        ctaLabel: t('home.audiences.enterprise.cta'),
        ctaUrl: '/contact',
    },
    {
        id: 'everyone',
        label: t('home.audiences.everyone.label'),
        headline: t('home.audiences.everyone.headline'),
        body: t('home.audiences.everyone.body'),
        benefits: [t('home.audiences.everyone.benefits.0'), t('home.audiences.everyone.benefits.1'), t('home.audiences.everyone.benefits.2')],
        ctaLabel: t('home.audiences.everyone.cta'),
        ctaUrl: '/pricing',
    },
]);

const testimonials = computed(() => [
    {
        quote: t('testimonials.sarah.quote'),
        customerName: t('testimonials.sarah.name'),
        jobTitle: t('testimonials.sarah.title'),
        company: t('testimonials.sarah.company'),
        photoUrl: '/images/testimonials/sarah.jpg',
        productUsed: 'CRM',
    },
    {
        quote: t('testimonials.marcus.quote'),
        customerName: t('testimonials.marcus.name'),
        jobTitle: t('testimonials.marcus.title'),
        company: t('testimonials.marcus.company'),
        photoUrl: '/images/testimonials/marcus.jpg',
        productUsed: 'Analytics',
    },
    {
        quote: t('testimonials.aisha.quote'),
        customerName: t('testimonials.aisha.name'),
        jobTitle: t('testimonials.aisha.title'),
        company: t('testimonials.aisha.company'),
        photoUrl: '/images/testimonials/aisha.jpg',
        productUsed: 'Helpdesk',
    },
]);

const stats = computed(() => [
    { value: '10,000+', label: t('home.stats.teams') },
    { value: '99.9%', label: t('home.stats.uptime') },
    { value: '50M+', label: t('home.stats.apiCalls') },
    { value: '4.9/5', label: t('home.stats.rating') },
]);
</script>

<template>
    <Head title="Home">
        <meta name="description" :content="t('home.metaDescription')" />
    </Head>

    <DefaultLayout>
        <!-- Hero -->
        <section class="relative overflow-hidden bg-gradient-to-b from-muted/50 to-background py-20 lg:py-32">
            <!-- Animated orbs -->
            <div class="orb orb-1 -top-48 -left-48" aria-hidden="true" />
            <div class="orb orb-2 -top-32 -right-32" aria-hidden="true" />
            <div class="orb orb-3 bottom-0 left-1/3" aria-hidden="true" />
            <!-- Mesh gradient overlay -->
            <div class="absolute inset-0 bg-mesh-gradient" aria-hidden="true" />
            <!-- Dot grid -->
            <div class="absolute inset-0 bg-dot-grid" aria-hidden="true" />
            <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center">
                <div class="inline-flex items-center gap-2 rounded-full border bg-background px-4 py-1.5 text-sm text-muted-foreground mb-6">
                    <Sparkles class="size-4" />
                    <span>{{ t('home.trustedBy') }}</span>
                </div>
                <h1 class="text-4xl font-bold tracking-tight sm:text-5xl lg:text-6xl">
                    {{ t('home.heroTitle') }}
                    <span class="text-primary">{{ t('home.heroTitleHighlight') }}</span>
                </h1>
                <p class="mx-auto mt-6 max-w-2xl text-lg text-muted-foreground">
                    {{ t('home.heroDescription') }}
                </p>
                <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
                    <Button as-child size="lg">
                        <Link href="/pricing">
                            {{ t('common.startFreeTrial') }}
                            <ArrowRight class="ms-2 size-4 rtl:rotate-180" />
                        </Link>
                    </Button>
                    <Button as-child variant="outline" size="lg">
                        <Link href="/products">{{ t('common.exploreProducts') }}</Link>
                    </Button>
                </div>
            </div>
        </section>

        <!-- Trust Bar -->
        <TrustBar :logos="trustLogos" />

        <!-- Product Grid -->
        <section class="py-20 lg:py-28">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">{{ t('home.productsTitle') }}</h2>
                    <p class="mt-4 text-lg text-muted-foreground">{{ t('home.productsDescription') }}</p>
                </div>
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    <ProductCard
                        v-for="product in products"
                        :key="product.slug"
                        :product="product"
                        variant="large"
                    />
                </div>
            </div>
        </section>

        <!-- Why Choose Us -->
        <section class="relative overflow-hidden bg-muted/30 py-20 lg:py-28">
            <div class="absolute inset-0 bg-radial-glow" aria-hidden="true" />
            <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">{{ t('home.whyTitle') }}</h2>
                    <p class="mt-4 text-lg text-muted-foreground">{{ t('home.whyDescription') }}</p>
                </div>
                <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
                    <div
                        v-for="item in differentiators"
                        :key="item.title"
                        class="rounded-xl border bg-card p-6 text-center"
                    >
                        <div class="mx-auto mb-4 flex size-12 items-center justify-center rounded-lg bg-primary/10">
                            <component :is="item.icon" class="size-6 text-primary" />
                        </div>
                        <h3 class="text-lg font-semibold">{{ item.title }}</h3>
                        <p class="mt-2 text-sm text-muted-foreground">{{ item.body }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Audience Selector -->
        <section class="py-20 lg:py-28">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">{{ t('home.audienceTitle') }}</h2>
                </div>
                <AudienceSelector :tabs="audienceTabs" />
            </div>
        </section>

        <!-- Testimonials -->
        <TestimonialsSection :testimonials="testimonials" :title="t('home.testimonialsTitle')" />

        <!-- Stats Strip -->
        <StatsStrip :stats="stats" />

        <!-- Newsletter / Waitlist -->
        <section class="relative overflow-hidden py-20 lg:py-28">
            <div class="orb orb-2 -bottom-32 -right-32" aria-hidden="true" />
            <div class="orb orb-1 -bottom-48 -left-48" aria-hidden="true" />
            <div class="absolute inset-0 bg-mesh-gradient" aria-hidden="true" />
            <div class="relative mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">{{ t('home.newsletterTitle') }}</h2>
                <p class="mt-4 text-lg text-muted-foreground">{{ t('home.newsletterDescription') }}</p>
                <div class="mt-8">
                    <EmailCapture variant="inline" />
                </div>
            </div>
        </section>
    </DefaultLayout>
</template>
