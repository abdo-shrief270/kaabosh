<script setup lang="ts">
import DefaultLayout from '@/layouts/website/DefaultLayout.vue';
import PricingCard from '@/components/website/PricingCard.vue';
import FaqAccordion from '@/components/website/FaqAccordion.vue';
import { Button } from '@/components/ui/button';
import { Badge } from '@/components/ui/badge';
import { Head } from '@inertiajs/vue3';
import { Shield, CreditCard, RefreshCw, Check, X as XIcon } from 'lucide-vue-next';
import { ref, computed } from 'vue';
import { useLocale } from '@/composables/useLocale';

const { t } = useLocale();

const billingCycle = ref<'monthly' | 'annual'>('monthly');

const productTabs = ['CRM', 'Analytics', 'Helpdesk', 'Forms'];
const activeProduct = ref('CRM');

const pricingData: Record<string, any[]> = {
    CRM: [
        { name: 'Free', monthlyPrice: '$0', annualPrice: '$0', interval: '/month', description: 'For individuals getting started.', features: ['Up to 250 contacts', '1 pipeline', 'Basic reporting', 'Email support'], isPopular: false, isEnterprise: false, ctaLabel: t('common.startFree'), ctaUrl: '#' },
        { name: 'Pro', monthlyPrice: '$29', annualPrice: '$23', interval: '/user/month', description: 'For growing sales teams.', features: ['Unlimited contacts', 'Unlimited pipelines', 'Workflow automation', 'Email integration', 'Advanced reporting', 'Priority support'], isPopular: true, isEnterprise: false, ctaLabel: t('common.startFreeTrial'), ctaUrl: '#', savingsPercent: 20 },
        { name: 'Business', monthlyPrice: '$59', annualPrice: '$47', interval: '/user/month', description: 'For scaling organizations.', features: ['Everything in Pro', 'Custom fields', 'API access', 'Webhooks', 'Team permissions', 'Phone support'], isPopular: false, isEnterprise: false, ctaLabel: t('common.startFreeTrial'), ctaUrl: '#', savingsPercent: 20 },
        { name: 'Enterprise', monthlyPrice: 'Custom', annualPrice: 'Custom', interval: '', description: 'For large organizations.', features: ['Everything in Business', 'SSO & SCIM', 'Audit logs', 'Dedicated support', 'Custom SLA', 'On-premise option'], isPopular: false, isEnterprise: true, ctaLabel: t('common.contactSales'), ctaUrl: '/contact?inquiry=enterprise&product=crm' },
    ],
    Analytics: [
        { name: 'Free', monthlyPrice: '$0', annualPrice: '$0', interval: '/month', description: 'For personal projects.', features: ['Up to 1,000 events/mo', '1 dashboard', '7-day retention', 'Community support'], isPopular: false, isEnterprise: false, ctaLabel: t('common.startFree'), ctaUrl: '#' },
        { name: 'Pro', monthlyPrice: '$39', annualPrice: '$31', interval: '/month', description: 'For growing products.', features: ['Up to 100K events/mo', 'Unlimited dashboards', '12-month retention', 'Funnels & cohorts', 'Priority support'], isPopular: true, isEnterprise: false, ctaLabel: t('common.startFreeTrial'), ctaUrl: '#', savingsPercent: 20 },
        { name: 'Enterprise', monthlyPrice: 'Custom', annualPrice: 'Custom', interval: '', description: 'For high-volume needs.', features: ['Unlimited events', 'Unlimited retention', 'SQL access', 'SSO', 'Dedicated support'], isPopular: false, isEnterprise: true, ctaLabel: t('common.contactSales'), ctaUrl: '/contact?inquiry=enterprise&product=analytics' },
    ],
    Helpdesk: [
        { name: 'Free', monthlyPrice: '$0', annualPrice: '$0', interval: '/month', description: 'For small teams.', features: ['Up to 100 tickets/mo', '1 agent', 'Email ticketing', 'Knowledge base'], isPopular: false, isEnterprise: false, ctaLabel: t('common.startFree'), ctaUrl: '#' },
        { name: 'Pro', monthlyPrice: '$19', annualPrice: '$15', interval: '/agent/month', description: 'For support teams.', features: ['Unlimited tickets', 'Live chat', 'Automation rules', 'CSAT surveys', 'Reporting'], isPopular: true, isEnterprise: false, ctaLabel: t('common.startFreeTrial'), ctaUrl: '#', savingsPercent: 21 },
        { name: 'Enterprise', monthlyPrice: 'Custom', annualPrice: 'Custom', interval: '', description: 'For large support orgs.', features: ['Everything in Pro', 'SSO', 'SLA management', 'Custom roles', 'API access'], isPopular: false, isEnterprise: true, ctaLabel: t('common.contactSales'), ctaUrl: '/contact?inquiry=enterprise&product=helpdesk' },
    ],
    Forms: [
        { name: 'Free', monthlyPrice: '$0', annualPrice: '$0', interval: '/month', description: 'For basic forms.', features: ['Up to 3 forms', '100 submissions/mo', 'Basic fields', 'Email notifications'], isPopular: false, isEnterprise: false, ctaLabel: t('common.comingSoon'), ctaUrl: '#' },
        { name: 'Pro', monthlyPrice: '$15', annualPrice: '$12', interval: '/month', description: 'For power users.', features: ['Unlimited forms', 'Unlimited submissions', 'Conditional logic', 'File uploads', 'Integrations'], isPopular: true, isEnterprise: false, ctaLabel: t('common.comingSoon'), ctaUrl: '#', savingsPercent: 20 },
    ],
};

const currentPlans = computed(() => {
    const plans = pricingData[activeProduct.value] || [];
    return plans.map(plan => ({
        ...plan,
        price: billingCycle.value === 'annual' ? plan.annualPrice : plan.monthlyPrice,
    }));
});

const faqItems = computed(() => [
    { question: t('pricing.faq.switch.q'), answer: t('pricing.faq.switch.a') },
    { question: t('pricing.faq.trial.q'), answer: t('pricing.faq.trial.a') },
    { question: t('pricing.faq.payment.q'), answer: t('pricing.faq.payment.a') },
    { question: t('pricing.faq.cancel.q'), answer: t('pricing.faq.cancel.a') },
    { question: t('pricing.faq.nonprofit.q'), answer: t('pricing.faq.nonprofit.a') },
    { question: t('pricing.faq.limits.q'), answer: t('pricing.faq.limits.a') },
]);

const comparisonFeatures: Record<string, Record<string, Record<string, string | boolean>>> = {
    CRM: {
        'Core Features': {
            Contacts: { Free: 'Up to 250', Pro: 'Unlimited', Business: 'Unlimited', Enterprise: 'Unlimited' },
            Pipelines: { Free: '1', Pro: 'Unlimited', Business: 'Unlimited', Enterprise: 'Unlimited' },
            'Email Integration': { Free: false, Pro: true, Business: true, Enterprise: true },
            Automation: { Free: false, Pro: true, Business: true, Enterprise: true },
        },
        'Advanced': {
            'Custom Fields': { Free: false, Pro: false, Business: true, Enterprise: true },
            'API Access': { Free: false, Pro: false, Business: true, Enterprise: true },
            'SSO & SCIM': { Free: false, Pro: false, Business: false, Enterprise: true },
            'Audit Logs': { Free: false, Pro: false, Business: false, Enterprise: true },
        },
    },
};

const expandedGroups = ref<Record<string, boolean>>({});

function toggleGroup(group: string) {
    expandedGroups.value[group] = !expandedGroups.value[group];
}
</script>

<template>
    <Head title="Pricing">
        <meta name="description" :content="t('pricing.metaDescription')" />
    </Head>

    <DefaultLayout>
        <!-- Page Header -->
        <section class="relative overflow-hidden bg-muted/30 py-16 lg:py-24">
            <div class="orb orb-1 -top-48 -left-32" aria-hidden="true" />
            <div class="orb orb-2 -top-32 -right-48" aria-hidden="true" />
            <div class="absolute inset-0 bg-mesh-gradient" aria-hidden="true" />
            <div class="absolute inset-0 bg-dot-grid" aria-hidden="true" />
            <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-4xl font-bold tracking-tight sm:text-5xl">{{ t('pricing.title') }}</h1>
                <p class="mt-4 text-lg text-muted-foreground max-w-2xl mx-auto">{{ t('pricing.description') }}</p>
                <!-- Billing Toggle -->
                <div class="mt-8 inline-flex items-center gap-3 rounded-full border bg-background p-1">
                    <button
                        class="rounded-full px-4 py-2 text-sm font-medium transition-colors"
                        :class="billingCycle === 'monthly' ? 'bg-primary text-primary-foreground' : 'text-muted-foreground hover:text-foreground'"
                        @click="billingCycle = 'monthly'"
                    >
                        {{ t('common.monthly') }}
                    </button>
                    <button
                        class="rounded-full px-4 py-2 text-sm font-medium transition-colors flex items-center gap-2"
                        :class="billingCycle === 'annual' ? 'bg-primary text-primary-foreground' : 'text-muted-foreground hover:text-foreground'"
                        @click="billingCycle = 'annual'"
                    >
                        {{ t('common.annual') }}
                        <Badge v-if="billingCycle !== 'annual'" variant="secondary" class="text-xs">{{ t('common.save20') }}</Badge>
                    </button>
                </div>
            </div>
        </section>

        <!-- Product Selector Tabs -->
        <section class="border-b bg-background sticky top-16 z-30">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex gap-1 overflow-x-auto py-2">
                    <button
                        v-for="product in productTabs"
                        :key="product"
                        class="rounded-lg px-4 py-2 text-sm font-medium whitespace-nowrap transition-colors"
                        :class="activeProduct === product
                            ? 'bg-primary text-primary-foreground'
                            : 'text-muted-foreground hover:bg-muted hover:text-foreground'"
                        @click="activeProduct = product"
                    >
                        {{ product }}
                    </button>
                </div>
            </div>
        </section>

        <!-- Pricing Cards -->
        <section class="py-16 lg:py-24">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4 max-w-6xl mx-auto" :class="currentPlans.length === 3 ? 'lg:grid-cols-3' : ''">
                    <PricingCard
                        v-for="plan in currentPlans"
                        :key="plan.name"
                        :plan="plan"
                        :show-savings="billingCycle === 'annual' && plan.savingsPercent"
                        :savings-percent="plan.savingsPercent"
                    />
                </div>
            </div>
        </section>

        <!-- Feature Comparison Table -->
        <section v-if="comparisonFeatures[activeProduct]" class="py-16 lg:py-24 bg-muted/30">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold text-center mb-8">{{ t('pricing.featureComparison') }}</h2>
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead class="sticky top-32 bg-muted/30 backdrop-blur-sm">
                            <tr>
                                <th class="text-start p-4 font-medium text-muted-foreground">Feature</th>
                                <th v-for="plan in currentPlans" :key="plan.name" class="p-4 text-center font-semibold">
                                    {{ plan.name }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-for="(features, group) in comparisonFeatures[activeProduct]" :key="group">
                                <tr class="border-t bg-muted/50 cursor-pointer" @click="toggleGroup(String(group))">
                                    <td :colspan="currentPlans.length + 1" class="p-4 font-semibold">{{ group }}</td>
                                </tr>
                                <tr v-for="(values, feature) in features" :key="String(feature)" class="border-t">
                                    <td class="p-4 text-sm">{{ feature }}</td>
                                    <td v-for="plan in currentPlans" :key="plan.name" class="p-4 text-center text-sm">
                                        <template v-if="typeof (values as Record<string, any>)[plan.name] === 'boolean'">
                                            <Check v-if="(values as Record<string, any>)[plan.name]" class="size-5 text-green-600 dark:text-green-400 mx-auto" />
                                            <XIcon v-else class="size-5 text-muted-foreground/40 mx-auto" />
                                        </template>
                                        <template v-else>
                                            {{ (values as Record<string, any>)[plan.name] || '—' }}
                                        </template>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- FAQ -->
        <section class="py-16 lg:py-24">
            <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-center mb-12">{{ t('pricing.billingFaq') }}</h2>
                <FaqAccordion :items="faqItems" />
            </div>
        </section>

        <!-- Trust Strip -->
        <section class="border-t py-12 bg-muted/20">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex flex-wrap items-center justify-center gap-8 text-sm text-muted-foreground">
                    <div class="flex items-center gap-2">
                        <CreditCard class="size-5" />
                        <span>{{ t('common.noCreditCard') }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <RefreshCw class="size-5" />
                        <span>{{ t('common.cancelAnytime') }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <Shield class="size-5" />
                        <span>{{ t('common.moneyBackGuarantee') }}</span>
                    </div>
                </div>
            </div>
        </section>
    </DefaultLayout>
</template>
