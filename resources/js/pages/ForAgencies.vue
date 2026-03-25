<script setup lang="ts">
import DefaultLayout from '@/layouts/website/DefaultLayout.vue';
import ProductCard from '@/components/website/ProductCard.vue';
import TestimonialCard from '@/components/website/TestimonialCard.vue';
import { Button } from '@/components/ui/button';
import { Head, Link } from '@inertiajs/vue3';
import { Briefcase, BarChart3, Users } from 'lucide-vue-next';
import { useLocale } from '@/composables/useLocale';
import { computed } from 'vue';

const { t } = useLocale();

const painPoints = computed(() => [
    {
        icon: Briefcase,
        title: 'Juggling too many clients',
        description: 'Switching between accounts, logins, and dashboards for every client is a time sink your team can not afford.',
    },
    {
        icon: BarChart3,
        title: 'Proving ROI is a guessing game',
        description: 'Without unified reporting across clients, demonstrating results to stakeholders takes hours of manual work.',
    },
    {
        icon: Users,
        title: 'Onboarding new clients is slow',
        description: 'Setting up new client workspaces, permissions, and integrations from scratch every time wastes valuable billable hours.',
    },
]);

const products = computed(() => [
    {
        logo: '/images/products/crm-logo.svg',
        name: 'Kaabosh CRM',
        slug: 'crm',
        tagline: 'Multi-tenant CRM with client workspaces and white-label options.',
        audienceTags: ['SMBs', 'Enterprise'],
        modules: ['Contacts', 'Pipelines', 'Automation'],
        status: 'live' as const,
        description: 'Manage every client in one place.',
    },
    {
        logo: '/images/products/analytics-logo.svg',
        name: 'Kaabosh Analytics',
        slug: 'analytics',
        tagline: 'Client-facing dashboards and cross-account reporting in one click.',
        audienceTags: ['Developers', 'Enterprise'],
        modules: ['Dashboards', 'Reports', 'Integrations'],
        status: 'live' as const,
        description: 'Beautiful reports your clients will love.',
    },
    {
        logo: '/images/products/helpdesk-logo.svg',
        name: 'Kaabosh Helpdesk',
        slug: 'helpdesk',
        tagline: 'Shared inboxes and ticketing across all your client accounts.',
        audienceTags: ['SMBs', 'Consumers'],
        modules: ['Tickets', 'Knowledge Base', 'Live Chat'],
        status: 'beta' as const,
        description: 'Support that scales with your roster.',
    },
]);

const testimonial = {
    quote: 'Kaabosh lets us manage 40+ client accounts from a single dashboard. The cross-client reporting alone saves us 15 hours a week. Our clients love the branded dashboards.',
    customerName: 'Olivia Park',
    jobTitle: 'Managing Director',
    company: 'Catalyst Digital Agency',
    photoUrl: '/images/testimonials/olivia.jpg',
    productUsed: 'CRM & Analytics',
};
</script>

<template>
    <Head title="For Agencies">
        <meta name="description" content="Kaabosh for agencies — multi-client management, white-label dashboards, and cross-account reporting for digital agencies." />
    </Head>

    <DefaultLayout>
        <!-- Hero -->
        <section class="relative overflow-hidden bg-muted/30 py-20 lg:py-32">
            <div class="orb orb-1 -top-48 -right-32" aria-hidden="true" />
            <div class="orb orb-2 -bottom-32 -left-48" aria-hidden="true" />
            <div class="bg-mesh-gradient absolute inset-0" aria-hidden="true" />
            <div class="bg-dot-grid absolute inset-0" aria-hidden="true" />
            <div class="relative mx-auto max-w-4xl px-4 text-center sm:px-6 lg:px-8">
                <div class="mb-6 inline-flex items-center gap-2 rounded-full bg-primary/10 px-4 py-1.5 text-sm font-medium text-primary">
                    <Briefcase class="size-4" />
                    Built for agencies
                </div>
                <h1 class="text-4xl font-bold tracking-tight sm:text-5xl">Manage every client from one powerful platform</h1>
                <p class="mt-6 text-lg leading-relaxed text-muted-foreground">
                    Multi-tenant workspaces, white-label dashboards, and cross-client reporting. Kaabosh helps agencies deliver more value with less overhead.
                </p>
                <div class="mt-8 flex flex-col items-center justify-center gap-4 sm:flex-row">
                    <Button as-child size="lg">
                        <Link href="/contact">Start Free Trial</Link>
                    </Button>
                    <Button as-child variant="outline" size="lg">
                        <Link href="/products">Explore Products</Link>
                    </Button>
                </div>
            </div>
        </section>

        <!-- Pain Points -->
        <section class="py-20 lg:py-28">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mb-12 text-center">
                    <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">Challenges every agency faces</h2>
                    <p class="mt-4 text-lg text-muted-foreground">We built Kaabosh to solve the problems that slow agencies down.</p>
                </div>
                <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    <div v-for="point in painPoints" :key="point.title" class="rounded-xl border bg-card p-6">
                        <div class="mb-4 flex size-10 items-center justify-center rounded-lg bg-destructive/10">
                            <component :is="point.icon" class="size-5 text-destructive" />
                        </div>
                        <h3 class="text-lg font-semibold">{{ point.title }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-muted-foreground">{{ point.description }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Agency Products -->
        <section class="bg-muted/30 py-20 lg:py-28">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mb-12 text-center">
                    <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">Your agency toolkit</h2>
                    <p class="mt-4 text-lg text-muted-foreground">Everything you need to run and grow your agency.</p>
                </div>
                <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    <ProductCard
                        v-for="product in products"
                        :key="product.slug"
                        :product="product"
                        variant="large"
                    />
                </div>
            </div>
        </section>

        <!-- Testimonial -->
        <section class="py-20 lg:py-28">
            <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
                <div class="mb-8 text-center">
                    <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">Agencies love Kaabosh</h2>
                </div>
                <TestimonialCard v-bind="testimonial" />
            </div>
        </section>

        <!-- CTA Strip -->
        <section class="border-t py-16">
            <div class="mx-auto max-w-7xl px-4 text-center sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold">Ready to streamline your agency?</h2>
                <p class="mt-2 text-muted-foreground">Join hundreds of agencies already running on Kaabosh.</p>
                <div class="mt-6 flex flex-col items-center justify-center gap-4 sm:flex-row">
                    <Button as-child size="lg">
                        <Link href="/contact">Start Free Trial</Link>
                    </Button>
                    <Button as-child variant="outline" size="lg">
                        <Link href="/pricing">See Agency Pricing</Link>
                    </Button>
                </div>
            </div>
        </section>
    </DefaultLayout>
</template>
