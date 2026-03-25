<script setup lang="ts">
import DefaultLayout from '@/layouts/website/DefaultLayout.vue';
import ProductCard from '@/components/website/ProductCard.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Head, Link } from '@inertiajs/vue3';
import { Search, X } from 'lucide-vue-next';
import { computed, ref } from 'vue';
import { useLocale } from '@/composables/useLocale';

const props = defineProps<{
    products?: Array<{
        logo: string; name: string; slug: string; tagline: string;
        audienceTags: string[]; modules: string[]; status: 'live' | 'beta' | 'coming-soon';
        description: string; category: string;
    }>;
}>();

const { t } = useLocale();

const products = computed(() => props.products ?? [
    {
        logo: '/images/products/crm-logo.svg',
        name: t('products.crm.name'),
        slug: 'crm',
        tagline: t('products.crm.tagline'),
        audienceTags: ['SMBs', 'Enterprise'],
        modules: ['Contacts', 'Pipelines', 'Automation'],
        status: 'live' as const,
        description: t('products.crm.description'),
        category: 'Sales',
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
        category: 'Data',
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
        category: 'Support',
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
        category: 'Data',
    },
]);

const audienceFilters = [t('common.all'), 'Developers', 'SMBs', 'Enterprise', 'Consumers'];
const categoryFilters = computed(() => [t('common.all'), ...new Set(products.value.map(p => p.category))]);

const selectedAudience = ref(t('common.all'));
const selectedCategory = ref(t('common.all'));
const searchQuery = ref('');

const filteredProducts = computed(() => {
    return products.value.filter(p => {
        const matchAudience = selectedAudience.value === t('common.all') || p.audienceTags.includes(selectedAudience.value);
        const matchCategory = selectedCategory.value === t('common.all') || p.category === selectedCategory.value;
        const matchSearch = !searchQuery.value || p.name.toLowerCase().includes(searchQuery.value.toLowerCase()) || p.tagline.toLowerCase().includes(searchQuery.value.toLowerCase());
        return matchAudience && matchCategory && matchSearch;
    });
});

const hasActiveFilters = computed(() => {
    return selectedAudience.value !== t('common.all') || selectedCategory.value !== t('common.all') || searchQuery.value !== '';
});

function clearFilters() {
    selectedAudience.value = t('common.all');
    selectedCategory.value = t('common.all');
    searchQuery.value = '';
}
</script>

<template>
    <Head title="Products">
        <meta name="description" :content="t('products.metaDescription')" />
    </Head>

    <DefaultLayout>
        <!-- Page Header -->
        <section class="relative overflow-hidden bg-muted/30 py-16 lg:py-24">
            <div class="orb orb-2 -top-40 -right-40" aria-hidden="true" />
            <div class="orb orb-3 -top-32 -left-32" aria-hidden="true" />
            <div class="absolute inset-0 bg-mesh-gradient" aria-hidden="true" />
            <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-4xl font-bold tracking-tight sm:text-5xl">{{ t('products.pageTitle') }}</h1>
                <p class="mt-4 text-lg text-muted-foreground max-w-2xl mx-auto">{{ t('products.pageDescription') }}</p>
            </div>
        </section>

        <!-- Filter Bar -->
        <section class="border-b bg-background sticky top-16 z-30">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                    <div class="flex flex-wrap gap-2">
                        <span class="text-sm font-medium text-muted-foreground me-2 self-center">{{ t('common.audience') }}</span>
                        <button
                            v-for="filter in audienceFilters"
                            :key="filter"
                            class="rounded-full px-3 py-1 text-sm font-medium transition-colors"
                            :class="selectedAudience === filter
                                ? 'bg-primary text-primary-foreground'
                                : 'bg-muted text-muted-foreground hover:bg-muted/80'"
                            @click="selectedAudience = filter"
                        >
                            {{ filter }}
                        </button>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <span class="text-sm font-medium text-muted-foreground me-2 self-center">{{ t('common.category') }}</span>
                        <button
                            v-for="filter in categoryFilters"
                            :key="filter"
                            class="rounded-full px-3 py-1 text-sm font-medium transition-colors"
                            :class="selectedCategory === filter
                                ? 'bg-primary text-primary-foreground'
                                : 'bg-muted text-muted-foreground hover:bg-muted/80'"
                            @click="selectedCategory = filter"
                        >
                            {{ filter }}
                        </button>
                    </div>
                </div>
                <div class="mt-4 flex items-center gap-4">
                    <div class="relative flex-1 max-w-sm">
                        <Search class="absolute top-1/2 -translate-y-1/2 size-4 text-muted-foreground ltr:left-3 rtl:right-3" />
                        <Input
                            v-model="searchQuery"
                            :placeholder="t('common.searchProducts')"
                            class="ltr:pl-9 rtl:pr-9"
                        />
                    </div>
                    <span class="text-sm text-muted-foreground">
                        {{ t('common.showing') }} {{ filteredProducts.length }} {{ t('common.of') }} {{ products.length }} {{ t('common.products') }}
                    </span>
                    <Button
                        v-if="hasActiveFilters"
                        variant="ghost"
                        size="sm"
                        @click="clearFilters"
                    >
                        <X class="me-1 size-4" />
                        {{ t('common.clearAll') }}
                    </Button>
                </div>
            </div>
        </section>

        <!-- Product Cards Grid -->
        <section class="py-12 lg:py-20">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div v-if="filteredProducts.length" class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    <ProductCard
                        v-for="product in filteredProducts"
                        :key="product.slug"
                        :product="product"
                        variant="large"
                    />
                </div>
                <div v-else class="py-20 text-center">
                    <p class="text-lg text-muted-foreground">{{ t('products.noMatch') }}</p>
                    <Button variant="outline" class="mt-4" @click="clearFilters">{{ t('products.clearFilters') }}</Button>
                </div>
            </div>
        </section>

        <!-- Comparison CTA -->
        <section class="border-t bg-muted/30 py-12">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center">
                <Button as-child variant="outline" size="lg">
                    <Link href="/pricing">
                        {{ t('products.compareAll') }}
                        <span class="ms-2">&rarr;</span>
                    </Link>
                </Button>
            </div>
        </section>
    </DefaultLayout>
</template>
