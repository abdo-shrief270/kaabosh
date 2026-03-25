<script setup lang="ts">
import DefaultLayout from '@/layouts/website/DefaultLayout.vue';
import { Button } from '@/components/ui/button';
import { Badge } from '@/components/ui/badge';
import { Head, Link } from '@inertiajs/vue3';
import { Download, ExternalLink, Mail } from 'lucide-vue-next';
import { useLocale } from '@/composables/useLocale';

const { t } = useLocale();

const brandAssets = [
    { name: 'Logo — Full Color (SVG)', url: '/downloads/kaabosh-logo-full-color.svg', format: 'SVG' },
    { name: 'Logo — Full Color (PNG)', url: '/downloads/kaabosh-logo-full-color.png', format: 'PNG' },
    { name: 'Logo — White (SVG)', url: '/downloads/kaabosh-logo-white.svg', format: 'SVG' },
    { name: 'Logo — Dark (SVG)', url: '/downloads/kaabosh-logo-dark.svg', format: 'SVG' },
    { name: 'Icon — Square (SVG)', url: '/downloads/kaabosh-icon.svg', format: 'SVG' },
    { name: 'Brand Guidelines (PDF)', url: '/downloads/kaabosh-brand-guidelines.pdf', format: 'PDF' },
];

const pressMentions = [
    {
        title: 'Kaabosh raises Series A to build the all-in-one business platform',
        outlet: 'TechCrunch',
        date: 'January 2025',
        url: '#',
    },
    {
        title: 'Top 10 CRM tools for growing teams in 2025',
        outlet: 'Forbes',
        date: 'March 2025',
        url: '#',
    },
    {
        title: 'How Kaabosh is rethinking the SaaS suite',
        outlet: 'The Verge',
        date: 'November 2024',
        url: '#',
    },
    {
        title: 'Kaabosh Analytics: A developer-first approach to business intelligence',
        outlet: 'Hacker News',
        date: 'September 2024',
        url: '#',
    },
];
</script>

<template>
    <Head title="Press">
        <meta name="description" content="Kaabosh press kit — company overview, brand assets, press mentions, and media contact information." />
    </Head>

    <DefaultLayout>
        <!-- Page Header -->
        <section class="relative overflow-hidden bg-muted/30 py-20 lg:py-28">
            <div class="orb orb-1 -top-48 -right-32" aria-hidden="true" />
            <div class="orb orb-2 -bottom-32 -left-48" aria-hidden="true" />
            <div class="bg-mesh-gradient absolute inset-0" aria-hidden="true" />
            <div class="bg-dot-grid absolute inset-0" aria-hidden="true" />
            <div class="relative mx-auto max-w-4xl px-4 text-center sm:px-6 lg:px-8">
                <h1 class="text-4xl font-bold tracking-tight sm:text-5xl">Press & Media Kit</h1>
                <p class="mt-4 text-lg text-muted-foreground">Everything you need to write about Kaabosh. Brand assets, company information, and press contacts.</p>
            </div>
        </section>

        <!-- Company Overview -->
        <section class="py-20 lg:py-28">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mx-auto max-w-3xl">
                    <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">Company overview</h2>
                    <div class="mt-6 space-y-4 leading-relaxed text-muted-foreground">
                        <p>
                            Kaabosh is an all-in-one business platform that helps teams manage customer relationships, analyze data, support users, and collect feedback — all from a single, unified interface. Founded in 2022, Kaabosh serves thousands of teams across more than 40 countries.
                        </p>
                        <p>
                            Our mission is to replace the patchwork of disconnected SaaS tools with a cohesive platform that is powerful enough for enterprise and simple enough for small teams. Every product is API-first, built with modern architecture, and designed to work together seamlessly.
                        </p>
                        <p>
                            Kaabosh is backed by leading investors and has grown to serve organizations ranging from two-person startups to Fortune 500 enterprises. The company is headquartered with a globally distributed team.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Brand Assets -->
        <section class="bg-muted/30 py-20 lg:py-28">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mb-12 text-center">
                    <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">Brand assets</h2>
                    <p class="mt-4 text-muted-foreground">Download our logos and brand guidelines for use in your publications.</p>
                </div>
                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    <a
                        v-for="asset in brandAssets"
                        :key="asset.name"
                        :href="asset.url"
                        download
                        class="group flex items-center gap-4 rounded-xl border bg-card p-4 transition-shadow hover:shadow-md"
                    >
                        <div class="flex size-10 shrink-0 items-center justify-center rounded-lg bg-primary/10">
                            <Download class="size-5 text-primary" />
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="text-sm font-medium group-hover:text-primary transition-colors truncate">{{ asset.name }}</div>
                            <div class="text-xs text-muted-foreground">{{ asset.format }}</div>
                        </div>
                    </a>
                </div>
            </div>
        </section>

        <!-- Press Contact -->
        <section class="py-20 lg:py-28">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="grid gap-12 lg:grid-cols-2">
                    <div>
                        <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">Press contact</h2>
                        <p class="mt-4 text-muted-foreground">For press inquiries, interviews, and media requests, please reach out to our communications team.</p>
                        <div class="mt-8 space-y-4">
                            <div class="flex items-center gap-3">
                                <Mail class="size-5 text-primary" />
                                <a href="mailto:press@kaabosh.com" class="font-medium hover:text-primary transition-colors">press@kaabosh.com</a>
                            </div>
                        </div>
                        <p class="mt-6 text-sm text-muted-foreground">We typically respond to press inquiries within 24 hours.</p>
                    </div>

                    <!-- Boilerplate -->
                    <div class="rounded-xl border bg-card p-6">
                        <h3 class="text-lg font-semibold">Boilerplate</h3>
                        <p class="mt-4 text-sm leading-relaxed text-muted-foreground">
                            Kaabosh is an all-in-one business platform that unifies CRM, analytics, helpdesk, and data collection into a single, API-first platform. Serving thousands of teams worldwide, Kaabosh replaces disconnected SaaS tools with a cohesive suite that is enterprise-ready and developer-friendly. Founded in 2022, the company is backed by leading investors and operates with a globally distributed team. For more information, visit kaabosh.com.
                        </p>
                        <p class="mt-3 text-xs text-muted-foreground italic">Feel free to use this description in your publications.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Press Mentions -->
        <section class="bg-muted/30 py-20 lg:py-28">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mb-12 text-center">
                    <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">Press mentions</h2>
                    <p class="mt-4 text-muted-foreground">Recent coverage of Kaabosh in the media.</p>
                </div>
                <div class="grid gap-6 sm:grid-cols-2">
                    <a
                        v-for="mention in pressMentions"
                        :key="mention.title"
                        :href="mention.url"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="group rounded-xl border bg-card p-6 transition-shadow hover:shadow-md"
                    >
                        <div class="flex items-center justify-between mb-3">
                            <Badge variant="secondary">{{ mention.outlet }}</Badge>
                            <span class="text-xs text-muted-foreground">{{ mention.date }}</span>
                        </div>
                        <h3 class="font-semibold leading-snug group-hover:text-primary transition-colors">{{ mention.title }}</h3>
                        <div class="mt-3 flex items-center text-sm font-medium text-primary">
                            Read article
                            <ExternalLink class="ms-1 size-3" />
                        </div>
                    </a>
                </div>
            </div>
        </section>

        <!-- CTA -->
        <section class="border-t py-16">
            <div class="mx-auto max-w-7xl px-4 text-center sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold">Have questions?</h2>
                <p class="mt-2 text-muted-foreground">Our team is happy to help with any press or media inquiries.</p>
                <div class="mt-6">
                    <Button as-child size="lg">
                        <a href="mailto:press@kaabosh.com">Contact Press Team</a>
                    </Button>
                </div>
            </div>
        </section>
    </DefaultLayout>
</template>
