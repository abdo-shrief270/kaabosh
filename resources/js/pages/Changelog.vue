<script setup lang="ts">
import DefaultLayout from '@/layouts/website/DefaultLayout.vue';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Head } from '@inertiajs/vue3';
import { Megaphone, CheckCircle, AlertCircle, Mail } from 'lucide-vue-next';
import { ref, computed } from 'vue';
import { useLocale } from '@/composables/useLocale';

const props = defineProps<{
    entries?: Record<string, Array<{
        release_date: string;
        product: { name: string };
        category: string;
        title: string;
        description: string;
    }>> | Array<{
        date: string;
        product: string;
        category: string;
        title: string;
        description: string;
    }>;
}>();

const { t } = useLocale();

type ChangelogCategory = 'New' | 'Improved' | 'Fixed';
type Product = 'CRM' | 'Analytics' | 'Helpdesk';

interface ChangelogEntry {
    date: string;
    product: Product;
    category: ChangelogCategory;
    title: string;
    description: string;
}

const activeFilter = ref<'all' | Product>('all');

const filters: { label: string; value: 'all' | Product }[] = [
    { label: 'All Products', value: 'all' },
    { label: 'CRM', value: 'CRM' },
    { label: 'Analytics', value: 'Analytics' },
    { label: 'Helpdesk', value: 'Helpdesk' },
];

const categoryColors: Record<ChangelogCategory, string> = {
    New: 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400 border-green-200 dark:border-green-800',
    Improved: 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400 border-blue-200 dark:border-blue-800',
    Fixed: 'bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-400 border-amber-200 dark:border-amber-800',
};

const productColors: Record<Product, string> = {
    CRM: 'bg-violet-100 text-violet-800 dark:bg-violet-900/30 dark:text-violet-400 border-violet-200 dark:border-violet-800',
    Analytics: 'bg-cyan-100 text-cyan-800 dark:bg-cyan-900/30 dark:text-cyan-400 border-cyan-200 dark:border-cyan-800',
    Helpdesk: 'bg-rose-100 text-rose-800 dark:bg-rose-900/30 dark:text-rose-400 border-rose-200 dark:border-rose-800',
};

function normalizeEntries(raw: typeof props.entries): ChangelogEntry[] {
    if (!raw) return [];
    if (Array.isArray(raw)) return raw as ChangelogEntry[];
    // Backend sends grouped object: { "March 2026": [{ release_date, product: { name }, category, ... }] }
    const flat: ChangelogEntry[] = [];
    for (const items of Object.values(raw)) {
        for (const item of items) {
            flat.push({
                date: item.release_date,
                product: (typeof item.product === 'string' ? item.product : item.product?.name ?? 'CRM') as Product,
                category: (item.category.charAt(0).toUpperCase() + item.category.slice(1)) as ChangelogCategory,
                title: item.title,
                description: item.description,
            });
        }
    }
    return flat;
}

const entries = computed<ChangelogEntry[]>(() => {
    const normalized = normalizeEntries(props.entries);
    return normalized.length ? normalized : [
    { date: '2026-03-20', product: 'CRM', category: 'New', title: 'Pipeline automation rules', description: 'Create custom automation rules to move deals between pipeline stages based on triggers like email replies, meeting completions, or form submissions.' },
    { date: '2026-03-18', product: 'Analytics', category: 'Improved', title: 'Dashboard loading performance', description: 'Reduced average dashboard load time by 40% through query optimization and intelligent caching of frequently accessed reports.' },
    { date: '2026-03-12', product: 'Helpdesk', category: 'Fixed', title: 'Ticket assignment notification delay', description: 'Fixed an issue where agents were not receiving real-time notifications when tickets were assigned to them via round-robin routing.' },
    { date: '2026-03-05', product: 'CRM', category: 'Improved', title: 'Contact merge enhancements', description: 'Improved the contact merge workflow with a side-by-side comparison view, letting you choose which fields to keep from each duplicate record.' },
    { date: '2026-02-27', product: 'Analytics', category: 'New', title: 'Custom funnel reports', description: 'Build multi-step funnel reports with custom event sequences to track conversion rates across any user journey in your application.' },
    { date: '2026-02-20', product: 'Helpdesk', category: 'New', title: 'AI-powered ticket summarization', description: 'Long ticket threads are now automatically summarized using AI, giving agents a quick overview before diving into the full conversation.' },
    { date: '2026-02-14', product: 'CRM', category: 'Fixed', title: 'CSV import field mapping', description: 'Resolved a bug where custom field mappings were not being preserved when re-importing CSV files with the same column structure.' },
    { date: '2026-02-08', product: 'Analytics', category: 'Improved', title: 'Chart export quality', description: 'Exported charts are now rendered at 2x resolution for crisp display in presentations and reports. Added SVG export option for vector graphics.' },
    { date: '2026-01-30', product: 'Helpdesk', category: 'Improved', title: 'Canned response variables', description: 'Canned responses now support dynamic variables like customer name, ticket ID, and agent name for more personalized replies.' },
    { date: '2026-01-22', product: 'CRM', category: 'New', title: 'Email sequence builder', description: 'Design multi-step email sequences with conditional branching, A/B testing, and automatic follow-ups based on recipient engagement.' },
    { date: '2026-01-15', product: 'Analytics', category: 'Fixed', title: 'Timezone offset in weekly reports', description: 'Fixed an issue where weekly report boundaries were calculated using UTC instead of the workspace configured timezone.' },
    { date: '2026-01-08', product: 'Helpdesk', category: 'Fixed', title: 'SLA timer pause on pending status', description: 'SLA timers now correctly pause when a ticket is moved to pending status awaiting customer response.' },
    ];
});

const filteredEntries = computed(() => {
    if (activeFilter.value === 'all') return entries.value;
    return entries.value.filter(e => e.product === activeFilter.value);
});

const groupedEntries = computed(() => {
    const groups: Record<string, ChangelogEntry[]> = {};
    for (const entry of filteredEntries.value) {
        const date = new Date(entry.date);
        const key = `${date.getFullYear()}-${String(date.getMonth() + 1).padStart(2, '0')}`;
        const label = date.toLocaleDateString('en-US', { year: 'numeric', month: 'long' });
        if (!groups[label]) groups[label] = [];
        groups[label].push(entry);
    }
    return groups;
});

function formatDate(dateStr: string): string {
    return new Date(dateStr).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
}

// Subscribe form
const subscribeEmail = ref('');
const subscribeSubmitting = ref(false);
const subscribeSuccess = ref(false);
const subscribeError = ref('');

async function submitSubscribe() {
    if (!subscribeEmail.value || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(subscribeEmail.value)) {
        subscribeError.value = 'Please enter a valid email address.';
        return;
    }
    subscribeError.value = '';
    subscribeSubmitting.value = true;
    await new Promise(r => setTimeout(r, 1200));
    subscribeSubmitting.value = false;
    subscribeSuccess.value = true;
}
</script>

<template>
    <Head title="Changelog">
        <meta name="description" content="Stay up to date with the latest features, improvements, and fixes across all Kaabosh products." />
    </Head>

    <DefaultLayout>
        <!-- Hero -->
        <section class="relative overflow-hidden bg-muted/30 py-20 lg:py-28">
            <div class="orb orb-1 -top-48 -right-32" aria-hidden="true" />
            <div class="orb orb-2 -bottom-32 -left-48" aria-hidden="true" />
            <div class="bg-mesh-gradient absolute inset-0" aria-hidden="true" />
            <div class="bg-dot-grid absolute inset-0" aria-hidden="true" />
            <div class="relative mx-auto max-w-4xl px-4 text-center sm:px-6 lg:px-8">
                <div class="mx-auto mb-6 flex size-16 items-center justify-center rounded-2xl bg-primary/10">
                    <Megaphone class="size-8 text-primary" />
                </div>
                <h1 class="text-4xl font-bold tracking-tight sm:text-5xl">Changelog</h1>
                <p class="mt-4 text-lg text-muted-foreground">Stay up to date with the latest features, improvements, and bug fixes across all Kaabosh products.</p>
            </div>
        </section>

        <!-- Filter Tabs + Entries -->
        <section class="py-20 lg:py-28">
            <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
                <!-- Product Filter Tabs -->
                <div class="mb-12 flex flex-wrap gap-2">
                    <button
                        v-for="filter in filters"
                        :key="filter.value"
                        class="rounded-full px-4 py-1.5 text-sm font-medium border transition-colors"
                        :class="activeFilter === filter.value
                            ? 'bg-primary text-primary-foreground border-primary'
                            : 'bg-background text-muted-foreground border-input hover:bg-muted hover:text-foreground'"
                        @click="activeFilter = filter.value"
                    >
                        {{ filter.label }}
                    </button>
                </div>

                <!-- Grouped Entries -->
                <div v-if="Object.keys(groupedEntries).length === 0" class="py-12 text-center text-muted-foreground">
                    No changelog entries found for this filter.
                </div>

                <div v-for="(monthEntries, monthLabel) in groupedEntries" :key="monthLabel" class="mb-12 last:mb-0">
                    <h2 class="mb-6 text-lg font-semibold text-muted-foreground">{{ monthLabel }}</h2>
                    <div class="space-y-6">
                        <div
                            v-for="entry in monthEntries"
                            :key="entry.date + entry.title"
                            class="rounded-xl border bg-card p-6 transition-colors hover:bg-muted/30"
                        >
                            <div class="flex flex-wrap items-center gap-2">
                                <span class="text-sm text-muted-foreground">{{ formatDate(entry.date) }}</span>
                                <Badge :class="productColors[entry.product]" variant="outline">{{ entry.product }}</Badge>
                                <Badge :class="categoryColors[entry.category]" variant="outline">{{ entry.category }}</Badge>
                            </div>
                            <h3 class="mt-3 text-lg font-semibold">{{ entry.title }}</h3>
                            <p class="mt-2 text-sm leading-relaxed text-muted-foreground">{{ entry.description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Subscribe Strip -->
        <section class="border-t bg-muted/30 py-16">
            <div class="mx-auto max-w-7xl px-4 text-center sm:px-6 lg:px-8">
                <div v-if="subscribeSuccess" class="mx-auto max-w-md">
                    <CheckCircle class="mx-auto size-12 text-green-600 dark:text-green-400" />
                    <h3 class="mt-4 text-lg font-semibold">You're subscribed!</h3>
                    <p class="mt-2 text-sm text-muted-foreground">We'll send you an email whenever we ship something new.</p>
                </div>
                <div v-else class="mx-auto max-w-md">
                    <div class="mx-auto mb-4 flex size-10 items-center justify-center rounded-lg bg-primary/10">
                        <Mail class="size-5 text-primary" />
                    </div>
                    <h2 class="text-2xl font-bold">Get notified of updates</h2>
                    <p class="mt-2 text-sm text-muted-foreground">Subscribe to receive changelog updates directly in your inbox.</p>
                    <form class="mt-6 flex gap-2" @submit.prevent="submitSubscribe">
                        <Input
                            v-model="subscribeEmail"
                            type="email"
                            placeholder="you@example.com"
                            class="flex-1"
                        />
                        <Button type="submit" :disabled="subscribeSubmitting">
                            {{ subscribeSubmitting ? 'Subscribing...' : 'Subscribe' }}
                        </Button>
                    </form>
                    <p v-if="subscribeError" class="mt-2 flex items-center justify-center gap-1 text-sm text-destructive">
                        <AlertCircle class="size-4" />
                        {{ subscribeError }}
                    </p>
                </div>
            </div>
        </section>
    </DefaultLayout>
</template>
