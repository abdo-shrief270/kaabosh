<script setup lang="ts">
import DocsLayout from '@/layouts/website/DocsLayout.vue';
import { Button } from '@/components/ui/button';
import { Head, Link } from '@inertiajs/vue3';
import {
    BookOpen,
    Code,
    Database,
    Globe,
    Puzzle,
    Rocket,
    Settings,
    Zap,
    ExternalLink,
} from 'lucide-vue-next';
import { computed } from 'vue';

const props = defineProps<{ slug: string }>();

const productNames: Record<string, string> = {
    crm: 'Kaabosh CRM',
    analytics: 'Kaabosh Analytics',
    helpdesk: 'Kaabosh Helpdesk',
    forms: 'Kaabosh Forms',
};

const productName = computed(() => productNames[props.slug] || 'Product');

const quickStart = [
    {
        step: 1,
        title: 'Create your account',
        description: 'Sign up for free — no credit card required.',
    },
    {
        step: 2,
        title: 'Install the SDK',
        description: 'npm install @kaabosh/sdk or use our REST API directly.',
    },
    {
        step: 3,
        title: 'Make your first API call',
        description: 'Authenticate and fetch your first resource in seconds.',
    },
    {
        step: 4,
        title: 'Go live',
        description: "Switch to production keys and you're ready.",
    },
];

const docsCategories = [
    {
        icon: Rocket,
        name: 'Getting Started',
        description: 'Quick start guides and tutorials',
        url: '#',
    },
    {
        icon: Code,
        name: 'API Reference',
        description: 'Complete REST & GraphQL documentation',
        url: '#',
    },
    {
        icon: Puzzle,
        name: 'Integrations',
        description: 'Connect with third-party tools',
        url: '#',
    },
    {
        icon: Database,
        name: 'Data Models',
        description: 'Schema reference and relationships',
        url: '#',
    },
    {
        icon: Settings,
        name: 'Configuration',
        description: 'Settings, webhooks, and customization',
        url: '#',
    },
    {
        icon: Globe,
        name: 'SDKs & Libraries',
        description: 'Official SDKs for every major language',
        url: '#',
    },
    {
        icon: BookOpen,
        name: 'Guides',
        description: 'In-depth walkthroughs and best practices',
        url: '#',
    },
    {
        icon: Zap,
        name: 'Webhooks',
        description: 'Real-time event notifications',
        url: '#',
    },
];

const popularArticles = [
    { title: 'Authentication & API Keys', url: '#' },
    { title: 'Pagination & Filtering', url: '#' },
    { title: 'Error Handling', url: '#' },
    { title: 'Rate Limits', url: '#' },
    { title: 'Webhook Events Reference', url: '#' },
    { title: 'Migration Guide (v1 to v2)', url: '#' },
];

const sidebarNav = [
    { title: 'Overview', href: '#overview', active: true },
    { title: 'Quick Start', href: '#quickstart' },
    { title: 'Categories', href: '#categories' },
    { title: 'Popular Articles', href: '#popular' },
];
</script>

<template>
    <Head :title="`${productName} Documentation`">
        <meta
            :content="`Documentation overview for ${productName}. Quick start guides, API reference, and more.`"
            name="description"
        />
    </Head>

    <DocsLayout :sidebar-nav="sidebarNav">
        <!-- Docs Header -->
        <section id="overview" class="mb-12">
            <h1 class="text-3xl font-bold tracking-tight sm:text-4xl">
                {{ productName }} Documentation
            </h1>
            <p class="mt-4 text-lg text-muted-foreground">
                Everything you need to integrate and build with
                {{ productName }}.
            </p>
        </section>

        <!-- Quick Start -->
        <section id="quickstart" class="mb-16">
            <h2 class="mb-6 text-2xl font-bold">Quick Start</h2>
            <div class="rounded-xl border bg-card p-6">
                <ol class="space-y-6">
                    <li
                        v-for="item in quickStart"
                        :key="item.step"
                        class="flex gap-4"
                    >
                        <div
                            class="flex size-8 shrink-0 items-center justify-center rounded-full bg-primary text-sm font-bold text-primary-foreground"
                        >
                            {{ item.step }}
                        </div>
                        <div>
                            <h3 class="font-semibold">{{ item.title }}</h3>
                            <p class="text-sm text-muted-foreground">
                                {{ item.description }}
                            </p>
                        </div>
                    </li>
                </ol>
                <div class="mt-6">
                    <Button variant="outline" size="sm">
                        View full guide
                        <ExternalLink class="ml-2 size-3" />
                    </Button>
                </div>
            </div>
        </section>

        <!-- Docs Category Grid -->
        <section id="categories" class="mb-16">
            <h2 class="mb-6 text-2xl font-bold">Browse by Category</h2>
            <div class="grid gap-4 sm:grid-cols-2">
                <a
                    v-for="cat in docsCategories"
                    :key="cat.name"
                    :href="cat.url"
                    class="group rounded-xl border bg-card p-5 transition-colors hover:bg-accent"
                >
                    <div
                        class="mb-3 flex size-10 items-center justify-center rounded-lg bg-primary/10 transition-colors group-hover:bg-primary/20"
                    >
                        <component :is="cat.icon" class="size-5 text-primary" />
                    </div>
                    <h3
                        class="font-semibold transition-colors group-hover:text-primary"
                    >
                        {{ cat.name }}
                    </h3>
                    <p class="mt-1 text-sm text-muted-foreground">
                        {{ cat.description }}
                    </p>
                </a>
            </div>
        </section>

        <!-- Popular Articles -->
        <section id="popular" class="mb-16">
            <h2 class="mb-6 text-2xl font-bold">Popular Articles</h2>
            <ul class="space-y-3">
                <li v-for="article in popularArticles" :key="article.title">
                    <a
                        :href="article.url"
                        class="flex items-center gap-3 rounded-lg border bg-card p-4 transition-colors hover:bg-accent"
                    >
                        <BookOpen class="size-4 text-muted-foreground" />
                        <span class="font-medium">{{ article.title }}</span>
                        <ExternalLink
                            class="ml-auto size-3 text-muted-foreground"
                        />
                    </a>
                </li>
            </ul>
        </section>

        <!-- View Full Docs CTA -->
        <section class="rounded-xl border bg-primary/5 p-8 text-center">
            <h2 class="text-xl font-bold">Need the full documentation?</h2>
            <p class="mt-2 text-muted-foreground">
                Visit our dedicated docs site for complete API reference and
                guides.
            </p>
            <Button class="mt-4" size="lg">
                View Full Documentation
                <ExternalLink class="ml-2 size-4" />
            </Button>
        </section>
    </DocsLayout>
</template>
