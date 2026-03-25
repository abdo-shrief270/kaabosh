<script setup lang="ts">
import DefaultLayout from '@/layouts/website/DefaultLayout.vue';
import ProductCard from '@/components/website/ProductCard.vue';
import TestimonialCard from '@/components/website/TestimonialCard.vue';
import { Button } from '@/components/ui/button';
import { Head, Link } from '@inertiajs/vue3';
import { Code, Terminal, Zap, GitBranch } from 'lucide-vue-next';
import { useLocale } from '@/composables/useLocale';
import { computed } from 'vue';

const { t } = useLocale();

const painPoints = computed(() => [
    {
        icon: Terminal,
        title: 'Context switching kills flow',
        description: 'Jumping between dashboards, terminals, and docs wastes hours every week. Your tools should work where you do.',
    },
    {
        icon: Code,
        title: 'APIs that fight back',
        description: 'Poorly documented endpoints, inconsistent responses, and breaking changes slow your team to a crawl.',
    },
    {
        icon: GitBranch,
        title: 'Data silos across services',
        description: 'Customer data lives in ten different places. Building a unified view means stitching together fragile integrations.',
    },
]);

const products = computed(() => [
    {
        logo: '/images/products/crm-logo.svg',
        name: 'Kaabosh CRM',
        slug: 'crm',
        tagline: 'API-first CRM with webhooks, SDKs, and full REST coverage.',
        audienceTags: ['Developers', 'Enterprise'],
        modules: ['Contacts', 'Pipelines', 'Automation'],
        status: 'live' as const,
        description: 'A CRM built for teams that ship.',
    },
    {
        logo: '/images/products/analytics-logo.svg',
        name: 'Kaabosh Analytics',
        slug: 'analytics',
        tagline: 'Real-time dashboards with SQL access and custom event tracking.',
        audienceTags: ['Developers', 'Enterprise'],
        modules: ['Dashboards', 'Reports', 'Integrations'],
        status: 'live' as const,
        description: 'Analytics that speak your language.',
    },
]);

const testimonial = {
    quote: 'We integrated Kaabosh into our CI pipeline in under a day. The API docs are stellar, and the webhooks just work. It replaced three internal tools for us.',
    customerName: 'Marcus Rivera',
    jobTitle: 'Lead Engineer',
    company: 'DevStack Labs',
    photoUrl: '/images/testimonials/marcus.jpg',
    productUsed: 'CRM & Analytics',
};
</script>

<template>
    <Head title="For Developers">
        <meta name="description" content="Kaabosh for developers — API-first tools, SDKs, webhooks, and integrations built for engineering teams." />
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
                    <Code class="size-4" />
                    Built for developers
                </div>
                <h1 class="text-4xl font-bold tracking-tight sm:text-5xl">Ship faster with tools that respect your workflow</h1>
                <p class="mt-6 text-lg leading-relaxed text-muted-foreground">
                    API-first architecture, comprehensive SDKs, real-time webhooks, and documentation that actually helps. Kaabosh is the platform your engineering team has been waiting for.
                </p>
                <div class="mt-8 flex flex-col items-center justify-center gap-4 sm:flex-row">
                    <Button as-child size="lg">
                        <Link href="/products">Explore the API</Link>
                    </Button>
                    <Button as-child variant="outline" size="lg">
                        <Link href="/products/crm/docs">Read the Docs</Link>
                    </Button>
                </div>
            </div>
        </section>

        <!-- Pain Points -->
        <section class="py-20 lg:py-28">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mb-12 text-center">
                    <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">Sound familiar?</h2>
                    <p class="mt-4 text-lg text-muted-foreground">Common frustrations we built Kaabosh to solve.</p>
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

        <!-- Developer-focused Products -->
        <section class="bg-muted/30 py-20 lg:py-28">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mb-12 text-center">
                    <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">Tools built your way</h2>
                    <p class="mt-4 text-lg text-muted-foreground">Every product comes with a full REST API, webhooks, and client SDKs.</p>
                </div>
                <div class="mx-auto grid max-w-4xl gap-8 sm:grid-cols-2">
                    <ProductCard
                        v-for="product in products"
                        :key="product.slug"
                        :product="product"
                        variant="large"
                    />
                </div>
            </div>
        </section>

        <!-- Developer Features -->
        <section class="py-20 lg:py-28">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mb-12 text-center">
                    <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">Why developers choose Kaabosh</h2>
                </div>
                <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    <div class="rounded-xl border bg-card p-6">
                        <div class="mb-4 flex size-10 items-center justify-center rounded-lg bg-primary/10">
                            <Code class="size-5 text-primary" />
                        </div>
                        <h3 class="text-lg font-semibold">RESTful APIs</h3>
                        <p class="mt-2 text-sm leading-relaxed text-muted-foreground">Clean, versioned endpoints with consistent JSON responses. Full OpenAPI specs included.</p>
                    </div>
                    <div class="rounded-xl border bg-card p-6">
                        <div class="mb-4 flex size-10 items-center justify-center rounded-lg bg-primary/10">
                            <Zap class="size-5 text-primary" />
                        </div>
                        <h3 class="text-lg font-semibold">Real-time Webhooks</h3>
                        <p class="mt-2 text-sm leading-relaxed text-muted-foreground">Subscribe to events and get instant notifications. Retry logic and delivery logs built in.</p>
                    </div>
                    <div class="rounded-xl border bg-card p-6">
                        <div class="mb-4 flex size-10 items-center justify-center rounded-lg bg-primary/10">
                            <GitBranch class="size-5 text-primary" />
                        </div>
                        <h3 class="text-lg font-semibold">SDKs & Libraries</h3>
                        <p class="mt-2 text-sm leading-relaxed text-muted-foreground">Official clients for JavaScript, Python, PHP, Ruby, and Go. Community libraries for everything else.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonial -->
        <section class="bg-muted/30 py-20 lg:py-28">
            <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
                <div class="mb-8 text-center">
                    <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">Loved by engineering teams</h2>
                </div>
                <TestimonialCard v-bind="testimonial" />
            </div>
        </section>

        <!-- CTA Strip -->
        <section class="border-t py-16">
            <div class="mx-auto max-w-7xl px-4 text-center sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold">Ready to build?</h2>
                <p class="mt-2 text-muted-foreground">Get your API keys in minutes. No sales call required.</p>
                <div class="mt-6 flex flex-col items-center justify-center gap-4 sm:flex-row">
                    <Button as-child size="lg">
                        <Link href="/contact">Start Free Trial</Link>
                    </Button>
                    <Button as-child variant="outline" size="lg">
                        <Link href="/products/crm/docs">Read the Docs</Link>
                    </Button>
                </div>
            </div>
        </section>
    </DefaultLayout>
</template>
