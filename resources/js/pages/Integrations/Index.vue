<script setup lang="ts">
import DefaultLayout from '@/layouts/website/DefaultLayout.vue';
import { Button } from '@/components/ui/button';
import { Badge } from '@/components/ui/badge';
import { Input } from '@/components/ui/input';
import { Head, Link } from '@inertiajs/vue3';
import { Search, X, ArrowRight } from 'lucide-vue-next';
import { useLocale } from '@/composables/useLocale';
import { computed, ref } from 'vue';

const props = defineProps<{
    integrations?: Array<{
        slug: string; name: string; logo: string;
        description: string; category: string;
    }>;
}>();

const { t } = useLocale();

const allIntegrations = computed(() => props.integrations ?? [
    {
        slug: 'slack',
        name: 'Slack',
        logo: '/images/integrations/slack.svg',
        description: 'Get real-time notifications, create deals from messages, and keep your team in sync without leaving Slack.',
        category: 'Communication',
    },
    {
        slug: 'zapier',
        name: 'Zapier',
        logo: '/images/integrations/zapier.svg',
        description: 'Connect Kaabosh to 5,000+ apps with no-code automation workflows. Trigger actions across your entire stack.',
        category: 'Automation',
    },
    {
        slug: 'stripe',
        name: 'Stripe',
        logo: '/images/integrations/stripe.svg',
        description: 'Sync payment data, track revenue per contact, and automate invoicing directly from your CRM pipeline.',
        category: 'Payments',
    },
    {
        slug: 'hubspot',
        name: 'HubSpot',
        logo: '/images/integrations/hubspot.svg',
        description: 'Migrate from HubSpot or run both platforms side by side with bi-directional contact and deal sync.',
        category: 'CRM',
    },
    {
        slug: 'github',
        name: 'GitHub',
        logo: '/images/integrations/github.svg',
        description: 'Link pull requests to customer tickets, track feature requests, and close the loop between engineering and support.',
        category: 'Developer Tools',
    },
    {
        slug: 'google-workspace',
        name: 'Google Workspace',
        logo: '/images/integrations/google-workspace.svg',
        description: 'Sync Gmail, Google Calendar, and Contacts. Log emails automatically and schedule meetings from your CRM.',
        category: 'Productivity',
    },
    {
        slug: 'salesforce',
        name: 'Salesforce',
        logo: '/images/integrations/salesforce.svg',
        description: 'Migrate from Salesforce with our dedicated import tool. Map custom fields, preserve history, and switch seamlessly.',
        category: 'CRM',
    },
    {
        slug: 'jira',
        name: 'Jira',
        logo: '/images/integrations/jira.svg',
        description: 'Turn customer feedback into Jira tickets automatically. Track issue status from within Kaabosh and keep customers updated.',
        category: 'Developer Tools',
    },
]);

const categories = computed(() => ['All', ...new Set(allIntegrations.value.map(i => i.category))]);
const selectedCategory = ref('All');
const searchQuery = ref('');

const filteredIntegrations = computed(() => {
    return allIntegrations.value.filter(i => {
        const matchCategory = selectedCategory.value === 'All' || i.category === selectedCategory.value;
        const matchSearch = !searchQuery.value || i.name.toLowerCase().includes(searchQuery.value.toLowerCase()) || i.description.toLowerCase().includes(searchQuery.value.toLowerCase());
        return matchCategory && matchSearch;
    });
});

const hasActiveFilters = computed(() => {
    return selectedCategory.value !== 'All' || searchQuery.value !== '';
});

function clearFilters() {
    selectedCategory.value = 'All';
    searchQuery.value = '';
}
</script>

<template>
    <Head title="Integrations">
        <meta name="description" content="Browse Kaabosh integrations — connect with Slack, Zapier, Stripe, GitHub, and 100+ tools your team already uses." />
    </Head>

    <DefaultLayout>
        <!-- Page Header -->
        <section class="relative overflow-hidden bg-muted/30 py-20 lg:py-28">
            <div class="orb orb-1 -top-48 -right-32" aria-hidden="true" />
            <div class="orb orb-2 -bottom-32 -left-48" aria-hidden="true" />
            <div class="bg-mesh-gradient absolute inset-0" aria-hidden="true" />
            <div class="bg-dot-grid absolute inset-0" aria-hidden="true" />
            <div class="relative mx-auto max-w-4xl px-4 text-center sm:px-6 lg:px-8">
                <h1 class="text-4xl font-bold tracking-tight sm:text-5xl">Integrations</h1>
                <p class="mt-4 text-lg text-muted-foreground">Connect Kaabosh with the tools your team already uses. Browse our growing library of integrations.</p>
            </div>
        </section>

        <!-- Search & Filter Bar -->
        <section class="sticky top-16 z-30 border-b bg-background">
            <div class="mx-auto max-w-7xl px-4 py-4 sm:px-6 lg:px-8">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                    <div class="flex flex-wrap gap-2">
                        <button
                            v-for="category in categories"
                            :key="category"
                            class="rounded-full px-3 py-1 text-sm font-medium transition-colors"
                            :class="selectedCategory === category
                                ? 'bg-primary text-primary-foreground'
                                : 'bg-muted text-muted-foreground hover:bg-muted/80'"
                            @click="selectedCategory = category"
                        >
                            {{ category }}
                        </button>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="relative max-w-sm flex-1">
                            <Search class="absolute top-1/2 -translate-y-1/2 size-4 text-muted-foreground ltr:left-3 rtl:right-3" />
                            <Input
                                v-model="searchQuery"
                                placeholder="Search integrations..."
                                class="ltr:pl-9 rtl:pr-9"
                            />
                        </div>
                        <Button
                            v-if="hasActiveFilters"
                            variant="ghost"
                            size="sm"
                            @click="clearFilters"
                        >
                            <X class="me-1 size-4" />
                            Clear
                        </Button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Integration Cards Grid -->
        <section class="py-20 lg:py-28">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div v-if="filteredIntegrations.length" class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    <Link
                        v-for="integration in filteredIntegrations"
                        :key="integration.slug"
                        :href="`/integrations/${integration.slug}`"
                        class="group rounded-xl border bg-card p-6 transition-shadow hover:shadow-md"
                    >
                        <div class="mb-4 flex items-start justify-between">
                            <div class="flex size-12 items-center justify-center rounded-lg bg-muted">
                                <img
                                    :src="integration.logo"
                                    :alt="integration.name"
                                    class="size-8"
                                    loading="lazy"
                                />
                            </div>
                            <Badge variant="secondary" class="text-xs">{{ integration.category }}</Badge>
                        </div>
                        <h3 class="text-lg font-semibold group-hover:text-primary transition-colors">{{ integration.name }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-muted-foreground">{{ integration.description }}</p>
                        <div class="mt-4 flex items-center text-sm font-medium text-primary">
                            Learn more
                            <ArrowRight class="ms-1 size-3" />
                        </div>
                    </Link>
                </div>
                <div v-else class="py-20 text-center">
                    <p class="text-lg text-muted-foreground">No integrations match your search.</p>
                    <Button variant="outline" class="mt-4" @click="clearFilters">Clear Filters</Button>
                </div>
            </div>
        </section>
    </DefaultLayout>
</template>
