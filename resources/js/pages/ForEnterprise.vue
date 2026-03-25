<script setup lang="ts">
import DefaultLayout from '@/layouts/website/DefaultLayout.vue';
import ProductCard from '@/components/website/ProductCard.vue';
import TestimonialCard from '@/components/website/TestimonialCard.vue';
import { Button } from '@/components/ui/button';
import { Badge } from '@/components/ui/badge';
import { Head, Link } from '@inertiajs/vue3';
import { Building2, Shield, Users, Lock } from 'lucide-vue-next';
import { useLocale } from '@/composables/useLocale';
import { computed } from 'vue';

const { t } = useLocale();

const painPoints = computed(() => [
    {
        icon: Users,
        title: 'Scaling across departments',
        description: 'As your organization grows, aligning sales, support, and operations on one platform becomes critical and painful.',
    },
    {
        icon: Shield,
        title: 'Compliance and governance gaps',
        description: 'Meeting SOC 2, GDPR, and industry-specific requirements with patchwork tools creates risk and audit headaches.',
    },
    {
        icon: Lock,
        title: 'Security without friction',
        description: 'Enterprise-grade access controls, SSO, and audit trails are table stakes — but most tools treat them as afterthoughts.',
    },
]);

const products = computed(() => [
    {
        logo: '/images/products/crm-logo.svg',
        name: 'Kaabosh CRM',
        slug: 'crm',
        tagline: 'Enterprise CRM with SSO, SCIM, and advanced permissions.',
        audienceTags: ['SMBs', 'Enterprise'],
        modules: ['Contacts', 'Pipelines', 'Automation'],
        status: 'live' as const,
        description: 'A CRM that scales with your org.',
    },
    {
        logo: '/images/products/analytics-logo.svg',
        name: 'Kaabosh Analytics',
        slug: 'analytics',
        tagline: 'Custom dashboards, role-based access, and data governance built in.',
        audienceTags: ['Developers', 'Enterprise'],
        modules: ['Dashboards', 'Reports', 'Integrations'],
        status: 'live' as const,
        description: 'Analytics your whole org can trust.',
    },
]);

const testimonial = {
    quote: 'Moving to Kaabosh consolidated five separate tools into one platform. Our compliance team was thrilled with the audit logs, and onboarding 200+ users via SCIM was seamless.',
    customerName: 'Diana Kessler',
    jobTitle: 'CTO',
    company: 'Meridian Financial Group',
    photoUrl: '/images/testimonials/diana.jpg',
    productUsed: 'CRM & Analytics',
};

const securityBadges = [
    'SOC 2 Type II',
    'GDPR Compliant',
    'SSO & SCIM',
    'Audit Logs',
    'EU Data Residency',
    '99.99% Uptime SLA',
];
</script>

<template>
    <Head title="For Enterprise">
        <meta name="description" content="Kaabosh for enterprise — SSO, SCIM, audit logs, compliance, and dedicated support for large organizations." />
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
                    <Building2 class="size-4" />
                    Enterprise-ready
                </div>
                <h1 class="text-4xl font-bold tracking-tight sm:text-5xl">The platform that scales with your organization</h1>
                <p class="mt-6 text-lg leading-relaxed text-muted-foreground">
                    Security, compliance, and governance built into every layer. Kaabosh gives enterprise teams the control they need without sacrificing speed.
                </p>
                <div class="mt-8 flex flex-col items-center justify-center gap-4 sm:flex-row">
                    <Button as-child size="lg">
                        <Link href="/contact?inquiry=enterprise">Talk to Sales</Link>
                    </Button>
                    <Button as-child variant="outline" size="lg">
                        <Link href="/products">View All Products</Link>
                    </Button>
                </div>
            </div>
        </section>

        <!-- Pain Points -->
        <section class="py-20 lg:py-28">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mb-12 text-center">
                    <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">Enterprise challenges we solve</h2>
                    <p class="mt-4 text-lg text-muted-foreground">Built from day one for organizations that need more.</p>
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

        <!-- Enterprise Products -->
        <section class="bg-muted/30 py-20 lg:py-28">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mb-12 text-center">
                    <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">Products built for scale</h2>
                    <p class="mt-4 text-lg text-muted-foreground">Every product includes enterprise-grade security and admin controls.</p>
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

        <!-- Testimonial -->
        <section class="py-20 lg:py-28">
            <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
                <div class="mb-8 text-center">
                    <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">Trusted by industry leaders</h2>
                </div>
                <TestimonialCard v-bind="testimonial" />
            </div>
        </section>

        <!-- Security & Compliance Trust Signals -->
        <section class="border-y bg-muted/20 py-20 lg:py-28">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mb-12 text-center">
                    <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">Security & compliance</h2>
                    <p class="mt-4 text-lg text-muted-foreground">Enterprise-grade trust built into every product.</p>
                </div>
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    <div
                        v-for="badge in securityBadges"
                        :key="badge"
                        class="flex items-center gap-3 rounded-xl border bg-card p-4"
                    >
                        <div class="flex size-10 shrink-0 items-center justify-center rounded-lg bg-green-100 dark:bg-green-900/30">
                            <Shield class="size-5 text-green-600 dark:text-green-400" />
                        </div>
                        <span class="font-medium">{{ badge }}</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Talk to Sales CTA -->
        <section class="border-t py-16">
            <div class="mx-auto max-w-7xl px-4 text-center sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold">Ready to bring your organization onto Kaabosh?</h2>
                <p class="mt-2 text-muted-foreground">Our enterprise team will build a custom plan tailored to your needs.</p>
                <div class="mt-6 flex flex-col items-center justify-center gap-4 sm:flex-row">
                    <Button as-child size="lg">
                        <Link href="/contact?inquiry=enterprise">Talk to Sales</Link>
                    </Button>
                    <Button as-child variant="outline" size="lg">
                        <Link href="/pricing">See Enterprise Pricing</Link>
                    </Button>
                </div>
            </div>
        </section>
    </DefaultLayout>
</template>
