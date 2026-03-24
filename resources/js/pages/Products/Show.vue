<script setup lang="ts">
import ProductLayout from '@/layouts/website/ProductLayout.vue';
import TrustBar from '@/components/website/TrustBar.vue';
import FaqAccordion from '@/components/website/FaqAccordion.vue';
import TestimonialsSection from '@/components/website/TestimonialsSection.vue';
import VideoPlayer from '@/components/website/VideoPlayer.vue';
import PricingCard from '@/components/website/PricingCard.vue';
import { Button } from '@/components/ui/button';
import { Badge } from '@/components/ui/badge';
import { Head, Link } from '@inertiajs/vue3';
import { ArrowRight, Shield, Download, Globe, Server, Zap, BarChart3, Users, Mail, CheckCircle } from 'lucide-vue-next';
import { computed } from 'vue';

const props = defineProps<{ slug: string }>();

// Mock product data - would come from API in production
const productData: Record<string, any> = {
    crm: {
        name: 'Kaabosh CRM',
        slug: 'crm',
        accentColor: '#3b82f6',
        status: 'live',
        headline: 'Close more deals with less effort',
        subheadline: 'A modern CRM that helps your sales team build relationships, track pipelines, and automate the busywork.',
        heroImage: '/images/products/crm-hero.png',
        demoVideoUrl: null,
        problems: [
            { icon: 'Users', title: 'Lost leads', description: 'Leads fall through the cracks when your tools are scattered.' },
            { icon: 'BarChart3', title: 'No visibility', description: 'Without pipeline visibility, forecasting is just guessing.' },
            { icon: 'Mail', title: 'Manual follow-ups', description: 'Your team spends hours on repetitive emails instead of selling.' },
        ],
        features: [
            { icon: 'Users', name: 'Contact Management', description: 'Keep every interaction in one place. Notes, emails, calls, and deals — all tied to each contact.', image: '/images/products/crm-feature-1.png' },
            { icon: 'BarChart3', name: 'Visual Pipelines', description: 'Drag-and-drop deal stages. See your entire pipeline at a glance and know exactly where every deal stands.', image: '/images/products/crm-feature-2.png' },
            { icon: 'Zap', name: 'Workflow Automation', description: 'Automate follow-ups, task assignments, and notifications. Your CRM works while you sleep.', image: '/images/products/crm-feature-3.png' },
        ],
        modules: [
            { icon: 'Users', name: 'Contacts', description: 'Unified contact database' },
            { icon: 'BarChart3', name: 'Pipelines', description: 'Visual deal tracking' },
            { icon: 'Zap', name: 'Automation', description: 'Workflow engine' },
            { icon: 'Mail', name: 'Email', description: 'Built-in email sync' },
            { icon: 'CheckCircle', name: 'Tasks', description: 'Team task management' },
            { icon: 'Globe', name: 'Reporting', description: 'Custom dashboards' },
        ],
        howItWorks: [
            { title: 'Import your contacts', description: 'Upload a CSV or connect your email. We auto-deduplicate and enrich your data.' },
            { title: 'Set up your pipeline', description: 'Customize deal stages to match your sales process. Drag and drop to organize.' },
            { title: 'Start closing deals', description: 'Track every interaction, automate follow-ups, and watch your revenue grow.' },
        ],
        screenshots: [
            { src: '/images/products/crm-screen-1.png', alt: 'CRM Dashboard' },
            { src: '/images/products/crm-screen-2.png', alt: 'Pipeline View' },
            { src: '/images/products/crm-screen-3.png', alt: 'Contact Detail' },
        ],
        pricing: [
            { name: 'Free', price: '$0', interval: '/month', description: 'For individuals getting started.', features: ['Up to 250 contacts', '1 pipeline', 'Basic reporting'], isPopular: false, isEnterprise: false, ctaLabel: 'Start Free', ctaUrl: '/pricing?product=crm' },
            { name: 'Pro', price: '$29', interval: '/user/month', description: 'For growing sales teams.', features: ['Unlimited contacts', 'Unlimited pipelines', 'Automation', 'Email integration', 'Advanced reporting'], isPopular: true, isEnterprise: false, ctaLabel: 'Start Free Trial', ctaUrl: '/pricing?product=crm' },
            { name: 'Enterprise', price: 'Custom', interval: '', description: 'For large organizations.', features: ['Everything in Pro', 'SSO & SCIM', 'Audit logs', 'Dedicated support', 'Custom SLA'], isPopular: false, isEnterprise: true, ctaLabel: 'Contact Sales', ctaUrl: '/contact?inquiry=enterprise&product=crm' },
        ],
        testimonials: [
            { quote: 'Kaabosh CRM transformed how we manage our pipeline. 40% more deals closed in Q1.', customerName: 'Sarah Chen', jobTitle: 'VP of Sales', company: 'TechFlow Inc.', photoUrl: '/images/testimonials/sarah.jpg', productUsed: 'CRM' },
            { quote: 'Finally a CRM that our team actually enjoys using. Adoption was nearly instant.', customerName: 'James Wright', jobTitle: 'Sales Director', company: 'ScaleUp Co.', photoUrl: '/images/testimonials/james.jpg', productUsed: 'CRM' },
        ],
        securityBadges: ['GDPR Compliant', 'SSO Available', 'Data Export', 'EU Hosting'],
        faq: [
            { question: 'Can I import my existing contacts?', answer: 'Yes! You can import contacts via CSV upload, or connect directly to your existing CRM, email, or spreadsheet. We handle deduplication automatically.' },
            { question: 'Is there a free trial?', answer: 'Yes, the Pro plan includes a 14-day free trial with full access to all features. No credit card required.' },
            { question: 'How does pricing work for teams?', answer: 'Pro and Enterprise plans are priced per user per month. Annual billing saves you 20%. Volume discounts available for teams of 50+.' },
            { question: 'Can I customize the pipeline stages?', answer: 'Absolutely. You can create unlimited custom pipelines with any stages that match your sales process.' },
            { question: 'What integrations are available?', answer: 'We integrate with 100+ tools including Slack, Gmail, Outlook, Zapier, and more. Our API also allows custom integrations.' },
            { question: 'Is my data secure?', answer: 'Yes. We are SOC 2 compliant, encrypt all data at rest and in transit, and offer EU hosting for GDPR compliance.' },
        ],
    },
};

// Fallback for unknown slugs
const product = computed(() => productData[props.slug] || productData.crm);

const trustLogos = [
    { src: '/images/logos/company-1.svg', alt: 'Company 1' },
    { src: '/images/logos/company-2.svg', alt: 'Company 2' },
    { src: '/images/logos/company-3.svg', alt: 'Company 3' },
    { src: '/images/logos/company-4.svg', alt: 'Company 4' },
    { src: '/images/logos/company-5.svg', alt: 'Company 5' },
    { src: '/images/logos/company-6.svg', alt: 'Company 6' },
];
</script>

<template>
    <Head :title="product.name">
        <meta :content="`${product.name} — ${product.subheadline}`" name="description" />
    </Head>

    <ProductLayout :product="product">
        <!-- Product Hero -->
        <section id="features" class="relative overflow-hidden py-20 lg:py-32">
            <div class="orb orb-1 -top-48 -right-48" aria-hidden="true" />
            <div class="orb orb-2 top-1/2 -left-32" aria-hidden="true" />
            <div class="absolute inset-0 bg-mesh-gradient" aria-hidden="true" />
            <div class="absolute inset-0 bg-dot-grid" aria-hidden="true" />
            <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="grid gap-12 lg:grid-cols-2 lg:items-center">
                    <div>
                        <h1 class="text-4xl font-bold tracking-tight sm:text-5xl">
                            {{ product.headline }}
                        </h1>
                        <p class="mt-6 text-lg text-muted-foreground">
                            {{ product.subheadline }}
                        </p>
                        <div class="mt-8 flex flex-col sm:flex-row gap-4">
                            <Button size="lg">
                                {{ product.status === 'live' ? 'Start Free Trial' : 'Join Waitlist' }}
                                <ArrowRight class="ml-2 size-4" />
                            </Button>
                            <Button as-child variant="outline" size="lg">
                                <Link :href="`/products/${product.slug}/docs`">View Docs</Link>
                            </Button>
                        </div>
                    </div>
                    <div class="rounded-xl border bg-muted/30 p-2">
                        <img
                            :src="product.heroImage"
                            :alt="product.name"
                            class="rounded-lg w-full"
                            loading="eager"
                        />
                    </div>
                </div>
            </div>
        </section>

        <!-- Social Proof Bar -->
        <TrustBar :logos="trustLogos" />

        <!-- Problem Statement -->
        <section class="py-20 lg:py-28 bg-muted/30">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold tracking-tight text-center sm:text-4xl mb-12">Sound familiar?</h2>
                <div class="grid gap-8 sm:grid-cols-3">
                    <div
                        v-for="problem in product.problems"
                        :key="problem.title"
                        class="rounded-xl border bg-card p-6 text-center"
                    >
                        <div class="mx-auto mb-4 flex size-12 items-center justify-center rounded-lg bg-destructive/10">
                            <component :is="problem.icon" class="size-6 text-destructive" />
                        </div>
                        <h3 class="text-lg font-semibold">{{ problem.title }}</h3>
                        <p class="mt-2 text-sm text-muted-foreground">{{ problem.description }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Feature Highlights -->
        <section class="py-20 lg:py-28">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold tracking-tight text-center sm:text-4xl mb-16">Everything you need</h2>
                <div class="space-y-20">
                    <div
                        v-for="(feature, index) in product.features"
                        :key="feature.name"
                        class="grid gap-12 lg:grid-cols-2 lg:items-center"
                        :class="index % 2 === 1 ? 'lg:flex-row-reverse' : ''"
                    >
                        <div :class="index % 2 === 1 ? 'lg:order-2' : ''">
                            <h3 class="text-2xl font-bold">{{ feature.name }}</h3>
                            <p class="mt-4 text-muted-foreground">{{ feature.description }}</p>
                        </div>
                        <div :class="index % 2 === 1 ? 'lg:order-1' : ''">
                            <div class="rounded-xl border bg-muted/30 p-2">
                                <img :src="feature.image" :alt="feature.name" class="rounded-lg w-full" loading="lazy" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Module Overview -->
        <section id="modules" class="py-20 lg:py-28 bg-muted/30">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold tracking-tight text-center sm:text-4xl mb-12">Modules</h2>
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    <div
                        v-for="mod in product.modules"
                        :key="mod.name"
                        class="rounded-xl border bg-card p-6"
                    >
                        <div class="mb-3 flex size-10 items-center justify-center rounded-lg bg-primary/10">
                            <component :is="mod.icon" class="size-5 text-primary" />
                        </div>
                        <h3 class="font-semibold">{{ mod.name }}</h3>
                        <p class="mt-1 text-sm text-muted-foreground">{{ mod.description }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- How It Works -->
        <section class="py-20 lg:py-28">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold tracking-tight text-center sm:text-4xl mb-16">How It Works</h2>
                <div class="grid gap-8 sm:grid-cols-3">
                    <div
                        v-for="(step, index) in product.howItWorks"
                        :key="step.title"
                        class="relative text-center"
                    >
                        <div class="mx-auto mb-4 flex size-12 items-center justify-center rounded-full bg-primary text-primary-foreground font-bold text-lg">
                            {{ index + 1 }}
                        </div>
                        <h3 class="text-lg font-semibold">{{ step.title }}</h3>
                        <p class="mt-2 text-sm text-muted-foreground">{{ step.description }}</p>
                        <!-- Connector line (desktop only) -->
                        <div
                            v-if="index < product.howItWorks.length - 1"
                            class="hidden sm:block absolute top-6 left-[calc(50%+24px)] w-[calc(100%-48px)] h-px bg-border"
                        />
                    </div>
                </div>
            </div>
        </section>

        <!-- Screenshots / Demo -->
        <section class="py-20 lg:py-28 bg-muted/30">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold tracking-tight text-center sm:text-4xl mb-12">See It in Action</h2>
                <VideoPlayer
                    :video-url="product.demoVideoUrl"
                    :poster-image="product.screenshots?.[0]?.src"
                    :screenshots="product.screenshots"
                />
            </div>
        </section>

        <!-- Pricing Preview -->
        <section id="pricing" class="py-20 lg:py-28">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold tracking-tight text-center sm:text-4xl mb-4">Simple, Transparent Pricing</h2>
                <p class="text-center text-muted-foreground mb-12">Start free, scale as you grow.</p>
                <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3 max-w-5xl mx-auto">
                    <PricingCard
                        v-for="plan in product.pricing"
                        :key="plan.name"
                        :plan="plan"
                    />
                </div>
                <div class="mt-8 text-center">
                    <Button as-child variant="link">
                        <Link :href="`/pricing?product=${product.slug}`">See full pricing &rarr;</Link>
                    </Button>
                </div>
            </div>
        </section>

        <!-- Testimonials -->
        <TestimonialsSection :testimonials="product.testimonials" title="What Our Users Say" />

        <!-- Security & Compliance Strip -->
        <section class="py-12 border-y bg-muted/20">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex flex-wrap items-center justify-center gap-8">
                    <div
                        v-for="badge in product.securityBadges"
                        :key="badge"
                        class="flex items-center gap-2 text-sm text-muted-foreground"
                    >
                        <Shield class="size-5 text-green-600 dark:text-green-400" />
                        <span>{{ badge }}</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ -->
        <section class="py-20 lg:py-28">
            <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold tracking-tight text-center sm:text-4xl mb-12">Frequently Asked Questions</h2>
                <FaqAccordion :items="product.faq" />
            </div>
        </section>

        <!-- Final CTA -->
        <section class="relative overflow-hidden py-20 lg:py-28 bg-primary text-primary-foreground">
            <div class="orb orb-1 -top-32 -left-32 !bg-white/10" aria-hidden="true" />
            <div class="orb orb-2 -bottom-32 -right-32 !bg-white/8" aria-hidden="true" />
            <div class="absolute inset-0 bg-dot-grid !bg-[radial-gradient(circle,hsl(0_0%_100%/0.08)_1px,transparent_1px)]" aria-hidden="true" />
            <div class="relative mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">Ready to get started?</h2>
                <p class="mt-4 text-lg opacity-90">
                    Join thousands of teams already using {{ product.name }}.
                </p>
                <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-4">
                    <Button size="lg" variant="secondary">
                        {{ product.status === 'live' ? 'Start Free Trial' : 'Join Waitlist' }}
                        <ArrowRight class="ml-2 size-4" />
                    </Button>
                    <Button as-child size="lg" variant="outline" class="border-primary-foreground/30 text-primary-foreground hover:bg-primary-foreground/10">
                        <Link :href="`/contact?product=${product.slug}`">Talk to Sales</Link>
                    </Button>
                </div>
            </div>
        </section>
    </ProductLayout>
</template>
