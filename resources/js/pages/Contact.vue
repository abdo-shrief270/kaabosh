<script setup lang="ts">
import DefaultLayout from '@/layouts/website/DefaultLayout.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Head } from '@inertiajs/vue3';
import { Send, Clock, MapPin, Linkedin, Twitter, Github, CheckCircle, AlertCircle } from 'lucide-vue-next';
import { ref, computed } from 'vue';
import { useLocale } from '@/composables/useLocale';

const { t } = useLocale();

const activeTab = ref<'general' | 'sales'>('general');

// General Form
const generalForm = ref({ name: '', email: '', subject: '', message: '' });
const generalErrors = ref<Record<string, string>>({});
const generalSubmitting = ref(false);
const generalSuccess = ref(false);
const generalError = ref('');

const subjectOptions = computed(() => [
    { value: 'Sales', label: t('contact.subjects.sales') },
    { value: 'Support', label: t('contact.subjects.support') },
    { value: 'Press', label: t('contact.subjects.press') },
    { value: 'Partnership', label: t('contact.subjects.partnership') },
    { value: 'Other', label: t('contact.subjects.other') },
]);

function validateGeneral() {
    const errors: Record<string, string> = {};
    if (!generalForm.value.name || generalForm.value.name.length < 2) errors.name = t('contact.validation.nameMin');
    if (!generalForm.value.email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(generalForm.value.email)) errors.email = t('contact.validation.emailInvalid');
    if (!generalForm.value.subject) errors.subject = t('contact.validation.subjectRequired');
    if (!generalForm.value.message || generalForm.value.message.length < 20) errors.message = t('contact.validation.messageMin');
    generalErrors.value = errors;
    return Object.keys(errors).length === 0;
}

async function submitGeneral() {
    if (!validateGeneral()) return;
    generalSubmitting.value = true;
    generalError.value = '';
    await new Promise(r => setTimeout(r, 1500));
    generalSubmitting.value = false;
    generalSuccess.value = true;
}

// Sales Form
const salesForm = ref({ name: '', email: '', company: '', teamSize: '', productInterest: [] as string[], message: '' });
const salesErrors = ref<Record<string, string>>({});
const salesSubmitting = ref(false);
const salesSuccess = ref(false);

const teamSizeOptions = ['1-10', '11-50', '51-200', '201-1000', '1000+'];
const productOptions = ['CRM', 'Analytics', 'Helpdesk', 'Forms'];

function validateSales() {
    const errors: Record<string, string> = {};
    if (!salesForm.value.name || salesForm.value.name.length < 2) errors.name = t('contact.validation.nameRequired');
    if (!salesForm.value.email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(salesForm.value.email)) errors.email = t('contact.validation.emailRequired');
    if (!salesForm.value.company) errors.company = t('contact.validation.companyRequired');
    if (!salesForm.value.teamSize) errors.teamSize = t('contact.validation.teamSizeRequired');
    salesErrors.value = errors;
    return Object.keys(errors).length === 0;
}

async function submitSales() {
    if (!validateSales()) return;
    salesSubmitting.value = true;
    await new Promise(r => setTimeout(r, 1500));
    salesSubmitting.value = false;
    salesSuccess.value = true;
}

function toggleProduct(product: string) {
    const idx = salesForm.value.productInterest.indexOf(product);
    if (idx >= 0) salesForm.value.productInterest.splice(idx, 1);
    else salesForm.value.productInterest.push(product);
}
</script>

<template>
    <Head title="Contact">
        <meta name="description" :content="t('contact.metaDescription')" />
    </Head>

    <DefaultLayout>
        <section class="relative overflow-hidden py-20 lg:py-28">
            <div class="orb orb-3 -top-32 -right-32" aria-hidden="true" />
            <div class="orb orb-1 bottom-0 -left-48" aria-hidden="true" />
            <div class="absolute inset-0 bg-dot-grid" aria-hidden="true" />
            <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="grid gap-12 lg:grid-cols-3">
                    <!-- Left Column: Form -->
                    <div class="lg:col-span-2">
                        <h1 class="text-4xl font-bold tracking-tight">{{ t('contact.title') }}</h1>
                        <p class="mt-4 text-lg text-muted-foreground">{{ t('contact.description') }}</p>

                        <!-- Tab Switcher -->
                        <div class="mt-8 flex gap-2 border-b">
                            <button
                                class="px-4 py-2 text-sm font-medium border-b-2 transition-colors -mb-px"
                                :class="activeTab === 'general' ? 'border-primary text-foreground' : 'border-transparent text-muted-foreground hover:text-foreground'"
                                @click="activeTab = 'general'"
                            >
                                {{ t('contact.generalTab') }}
                            </button>
                            <button
                                class="px-4 py-2 text-sm font-medium border-b-2 transition-colors -mb-px"
                                :class="activeTab === 'sales' ? 'border-primary text-foreground' : 'border-transparent text-muted-foreground hover:text-foreground'"
                                @click="activeTab = 'sales'"
                            >
                                {{ t('contact.salesTab') }}
                            </button>
                        </div>

                        <!-- General Contact Form -->
                        <div v-if="activeTab === 'general'" class="mt-8">
                            <div v-if="generalSuccess" class="rounded-xl border bg-green-50 dark:bg-green-950/20 p-8 text-center">
                                <CheckCircle class="mx-auto size-12 text-green-600 dark:text-green-400" />
                                <h3 class="mt-4 text-lg font-semibold">{{ t('contact.successTitle') }}</h3>
                                <p class="mt-2 text-muted-foreground">{{ t('contact.successDescription') }}</p>
                            </div>
                            <form v-else class="space-y-6" @submit.prevent="submitGeneral">
                                <div>
                                    <Label for="general-name">{{ t('contact.name') }}</Label>
                                    <Input id="general-name" v-model="generalForm.name" :placeholder="t('contact.namePlaceholder')" class="mt-1" />
                                    <p v-if="generalErrors.name" class="mt-1 text-sm text-destructive">{{ generalErrors.name }}</p>
                                </div>
                                <div>
                                    <Label for="general-email">{{ t('contact.email') }}</Label>
                                    <Input id="general-email" v-model="generalForm.email" type="email" :placeholder="t('contact.emailPlaceholder')" class="mt-1" />
                                    <p v-if="generalErrors.email" class="mt-1 text-sm text-destructive">{{ generalErrors.email }}</p>
                                </div>
                                <div>
                                    <Label for="general-subject">{{ t('contact.subject') }}</Label>
                                    <select
                                        id="general-subject"
                                        v-model="generalForm.subject"
                                        class="mt-1 flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-xs transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring"
                                    >
                                        <option value="" disabled>{{ t('contact.selectSubject') }}</option>
                                        <option v-for="opt in subjectOptions" :key="opt.value" :value="opt.value">{{ opt.label }}</option>
                                    </select>
                                    <p v-if="generalErrors.subject" class="mt-1 text-sm text-destructive">{{ generalErrors.subject }}</p>
                                </div>
                                <div>
                                    <Label for="general-message">{{ t('contact.message') }}</Label>
                                    <textarea
                                        id="general-message"
                                        v-model="generalForm.message"
                                        rows="5"
                                        :placeholder="t('contact.messagePlaceholder')"
                                        class="mt-1 flex w-full rounded-md border border-input bg-transparent px-3 py-2 text-sm shadow-xs transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring"
                                    />
                                    <p v-if="generalErrors.message" class="mt-1 text-sm text-destructive">{{ generalErrors.message }}</p>
                                </div>
                                <div v-if="generalError" class="flex items-center gap-2 text-sm text-destructive">
                                    <AlertCircle class="size-4" />
                                    {{ generalError }}
                                </div>
                                <Button type="submit" :disabled="generalSubmitting" size="lg">
                                    <template v-if="generalSubmitting">{{ t('common.sending') }}</template>
                                    <template v-else>
                                        {{ t('common.sendMessage') }}
                                        <Send class="ms-2 size-4 rtl:rotate-180" />
                                    </template>
                                </Button>
                            </form>
                        </div>

                        <!-- Sales / Enterprise Form -->
                        <div v-if="activeTab === 'sales'" class="mt-8">
                            <div v-if="salesSuccess" class="rounded-xl border bg-green-50 dark:bg-green-950/20 p-8 text-center">
                                <CheckCircle class="mx-auto size-12 text-green-600 dark:text-green-400" />
                                <h3 class="mt-4 text-lg font-semibold">{{ t('contact.salesSuccessTitle') }}</h3>
                                <p class="mt-2 text-muted-foreground">{{ t('contact.salesSuccessDescription') }}</p>
                            </div>
                            <form v-else class="space-y-6" @submit.prevent="submitSales">
                                <div class="grid gap-6 sm:grid-cols-2">
                                    <div>
                                        <Label for="sales-name">{{ t('contact.name') }}</Label>
                                        <Input id="sales-name" v-model="salesForm.name" :placeholder="t('contact.namePlaceholder')" class="mt-1" />
                                        <p v-if="salesErrors.name" class="mt-1 text-sm text-destructive">{{ salesErrors.name }}</p>
                                    </div>
                                    <div>
                                        <Label for="sales-email">{{ t('contact.email') }}</Label>
                                        <Input id="sales-email" v-model="salesForm.email" type="email" :placeholder="t('contact.emailCompanyPlaceholder')" class="mt-1" />
                                        <p v-if="salesErrors.email" class="mt-1 text-sm text-destructive">{{ salesErrors.email }}</p>
                                    </div>
                                </div>
                                <div class="grid gap-6 sm:grid-cols-2">
                                    <div>
                                        <Label for="sales-company">{{ t('contact.company') }}</Label>
                                        <Input id="sales-company" v-model="salesForm.company" :placeholder="t('contact.companyPlaceholder')" class="mt-1" />
                                        <p v-if="salesErrors.company" class="mt-1 text-sm text-destructive">{{ salesErrors.company }}</p>
                                    </div>
                                    <div>
                                        <Label for="sales-team">{{ t('contact.teamSize') }}</Label>
                                        <select
                                            id="sales-team"
                                            v-model="salesForm.teamSize"
                                            class="mt-1 flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-xs transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring"
                                        >
                                            <option value="" disabled>{{ t('contact.selectTeamSize') }}</option>
                                            <option v-for="opt in teamSizeOptions" :key="opt" :value="opt">{{ opt }}</option>
                                        </select>
                                        <p v-if="salesErrors.teamSize" class="mt-1 text-sm text-destructive">{{ salesErrors.teamSize }}</p>
                                    </div>
                                </div>
                                <div>
                                    <Label>{{ t('contact.productsOfInterest') }}</Label>
                                    <div class="mt-2 flex flex-wrap gap-2">
                                        <button
                                            v-for="product in productOptions"
                                            :key="product"
                                            type="button"
                                            class="rounded-full px-3 py-1 text-sm font-medium border transition-colors"
                                            :class="salesForm.productInterest.includes(product)
                                                ? 'bg-primary text-primary-foreground border-primary'
                                                : 'bg-background text-muted-foreground border-input hover:bg-muted'"
                                            @click="toggleProduct(product)"
                                        >
                                            {{ product }}
                                        </button>
                                    </div>
                                </div>
                                <div>
                                    <Label for="sales-message">{{ t('contact.messageOptional') }}</Label>
                                    <textarea
                                        id="sales-message"
                                        v-model="salesForm.message"
                                        rows="4"
                                        :placeholder="t('contact.salesMessagePlaceholder')"
                                        class="mt-1 flex w-full rounded-md border border-input bg-transparent px-3 py-2 text-sm shadow-xs transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring"
                                    />
                                </div>
                                <Button type="submit" :disabled="salesSubmitting" size="lg">
                                    <template v-if="salesSubmitting">{{ t('common.sending') }}</template>
                                    <template v-else>
                                        {{ t('common.requestDemo') }}
                                        <Send class="ms-2 size-4 rtl:rotate-180" />
                                    </template>
                                </Button>
                            </form>
                        </div>
                    </div>

                    <!-- Right Column: Info -->
                    <div class="space-y-8">
                        <div class="rounded-xl border bg-muted/30 p-6">
                            <h3 class="font-semibold">{{ t('contact.existingCustomer') }}</h3>
                            <p class="mt-2 text-sm text-muted-foreground">{{ t('contact.existingCustomerDescription') }}</p>
                        </div>
                        <div class="flex items-start gap-3">
                            <Clock class="size-5 text-muted-foreground mt-0.5" />
                            <div>
                                <h3 class="font-semibold">{{ t('contact.responseTime') }}</h3>
                                <p class="text-sm text-muted-foreground">{{ t('contact.responseTimeDescription') }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <MapPin class="size-5 text-muted-foreground mt-0.5" />
                            <div>
                                <h3 class="font-semibold">{{ t('contact.location') }}</h3>
                                <p class="text-sm text-muted-foreground">{{ t('contact.locationValue') }}</p>
                            </div>
                        </div>
                        <div>
                            <h3 class="font-semibold mb-3">{{ t('contact.connectWithUs') }}</h3>
                            <div class="flex gap-3">
                                <a href="#" class="flex size-10 items-center justify-center rounded-lg border bg-card text-muted-foreground hover:text-foreground hover:bg-accent transition-colors" target="_blank" rel="noopener noreferrer">
                                    <Linkedin class="size-5" />
                                </a>
                                <a href="#" class="flex size-10 items-center justify-center rounded-lg border bg-card text-muted-foreground hover:text-foreground hover:bg-accent transition-colors" target="_blank" rel="noopener noreferrer">
                                    <Twitter class="size-5" />
                                </a>
                                <a href="#" class="flex size-10 items-center justify-center rounded-lg border bg-card text-muted-foreground hover:text-foreground hover:bg-accent transition-colors" target="_blank" rel="noopener noreferrer">
                                    <Github class="size-5" />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </DefaultLayout>
</template>
