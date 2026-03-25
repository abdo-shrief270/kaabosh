<script setup lang="ts">
import DefaultLayout from '@/layouts/website/DefaultLayout.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Badge } from '@/components/ui/badge';
import { Head, Link } from '@inertiajs/vue3';
import {
    Search, X, MapPin, Briefcase, Heart, GraduationCap, Clock, Globe,
    Zap, Coffee, Laptop, Shield, TrendingUp, Users, ArrowRight, Send,
    CheckCircle, AlertCircle,
} from 'lucide-vue-next';
import { ref, computed } from 'vue';
import { useLocale } from '@/composables/useLocale';
import { Label } from '@/components/ui/label';

const props = defineProps<{
    roles?: Array<{
        slug: string; title: string; department: string;
        location: string; workType: string; description: string;
    }>;
}>();

const { t } = useLocale();

const benefits = [
    { icon: Heart, title: 'Health & Wellness', description: 'Comprehensive medical, dental, and vision coverage for you and your family.' },
    { icon: GraduationCap, title: 'Learning Budget', description: '$2,000 annual learning stipend for courses, conferences, and books.' },
    { icon: Laptop, title: 'Remote-First', description: 'Work from anywhere. We provide the equipment and support you need.' },
    { icon: Clock, title: 'Flexible Hours', description: 'We trust you to manage your time. Results matter, not hours logged.' },
    { icon: TrendingUp, title: 'Equity Package', description: 'Every team member gets stock options. We grow together.' },
    { icon: Coffee, title: 'Unlimited PTO', description: 'Take the time you need to recharge. We mean it.' },
];

const perks = [
    { icon: Globe, title: 'Annual Team Retreats', description: 'In-person meetups in exciting locations twice a year.' },
    { icon: Shield, title: '401(k) Matching', description: 'We match up to 4% of your salary toward retirement.' },
    { icon: Zap, title: 'Home Office Stipend', description: '$1,500 to set up your ideal workspace at home.' },
    { icon: Users, title: 'Parental Leave', description: '16 weeks paid parental leave for all new parents.' },
];

const hiringSteps = [
    { title: 'Application Review', description: 'Our team carefully reviews every application within 5 business days.' },
    { title: 'Intro Call', description: '30-minute conversation with a recruiter to learn about each other.' },
    { title: 'Technical / Role Interview', description: 'A deeper dive into your skills with the hiring team. No trick questions.' },
    { title: 'Offer & Onboarding', description: 'We move fast. Expect an offer within a week of your final interview.' },
];

const roles = computed(() => props.roles ?? [
    { slug: 'senior-frontend-engineer', title: 'Senior Frontend Engineer', department: 'Engineering', location: 'Remote (Global)', workType: 'Full-time', description: 'Build beautiful, performant user interfaces for our product suite using Vue.js and TypeScript.' },
    { slug: 'backend-engineer', title: 'Backend Engineer', department: 'Engineering', location: 'Remote (US/EU)', workType: 'Full-time', description: 'Design and implement scalable APIs and services powering the Kaabosh platform.' },
    { slug: 'product-designer', title: 'Product Designer', department: 'Design', location: 'Remote (Global)', workType: 'Full-time', description: 'Shape the user experience across our products from research through pixel-perfect delivery.' },
    { slug: 'content-marketing-manager', title: 'Content Marketing Manager', department: 'Marketing', location: 'Remote (US)', workType: 'Full-time', description: 'Create compelling content that drives awareness and educates our audience.' },
    { slug: 'account-executive', title: 'Account Executive', department: 'Sales', location: 'New York, NY', workType: 'Full-time', description: 'Own the full sales cycle for mid-market accounts and drive revenue growth.' },
    { slug: 'devops-engineer', title: 'DevOps Engineer', department: 'Engineering', location: 'Remote (EU)', workType: 'Full-time', description: 'Build and maintain our cloud infrastructure with a focus on reliability and security.' },
    { slug: 'ux-researcher', title: 'UX Researcher', department: 'Design', location: 'Remote (Global)', workType: 'Contract', description: 'Lead user research initiatives to uncover insights that drive product decisions.' },
    { slug: 'sales-development-rep', title: 'Sales Development Representative', department: 'Sales', location: 'Remote (US)', workType: 'Full-time', description: 'Generate and qualify leads to fuel our growing sales pipeline.' },
]);

const departments = computed(() => ['All', ...new Set(roles.value.map((r: any) => r.department))]);
const workTypes = computed(() => ['All', ...new Set(roles.value.map((r: any) => r.workType))]);

const selectedDepartment = ref('All');
const selectedWorkType = ref('All');
const searchQuery = ref('');

const filteredRoles = computed(() => {
    return roles.value.filter((r: any) => {
        const matchDept = selectedDepartment.value === 'All' || r.department === selectedDepartment.value;
        const matchType = selectedWorkType.value === 'All' || r.workType === selectedWorkType.value;
        const matchSearch = !searchQuery.value || r.title.toLowerCase().includes(searchQuery.value.toLowerCase()) || r.description.toLowerCase().includes(searchQuery.value.toLowerCase());
        return matchDept && matchType && matchSearch;
    });
});

const hasActiveFilters = computed(() => {
    return selectedDepartment.value !== 'All' || selectedWorkType.value !== 'All' || searchQuery.value !== '';
});

function clearFilters() {
    selectedDepartment.value = 'All';
    selectedWorkType.value = 'All';
    searchQuery.value = '';
}

function scrollToRoles() {
    document.getElementById('open-roles')?.scrollIntoView({ behavior: 'smooth' });
}

// General interest form
const interestForm = ref({ name: '', email: '', message: '' });
const interestErrors = ref<Record<string, string>>({});
const interestSubmitting = ref(false);
const interestSuccess = ref(false);

function validateInterest() {
    const errors: Record<string, string> = {};
    if (!interestForm.value.name || interestForm.value.name.length < 2) errors.name = 'Name must be at least 2 characters.';
    if (!interestForm.value.email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(interestForm.value.email)) errors.email = 'Please enter a valid email address.';
    if (!interestForm.value.message || interestForm.value.message.length < 10) errors.message = 'Message must be at least 10 characters.';
    interestErrors.value = errors;
    return Object.keys(errors).length === 0;
}

async function submitInterest() {
    if (!validateInterest()) return;
    interestSubmitting.value = true;
    await new Promise(r => setTimeout(r, 1500));
    interestSubmitting.value = false;
    interestSuccess.value = true;
}
</script>

<template>
    <Head title="Careers">
        <meta name="description" content="Join the Kaabosh team and help build the future of business software. Explore open roles and discover our culture." />
    </Head>

    <DefaultLayout>
        <!-- Hero -->
        <section class="relative overflow-hidden bg-muted/30 py-20 lg:py-32">
            <div class="absolute inset-0">
                <img src="/images/careers/team-hero.jpg" alt="Kaabosh team" class="size-full object-cover opacity-20" loading="eager" />
            </div>
            <div class="orb orb-1 -top-48 -right-32" aria-hidden="true" />
            <div class="orb orb-2 -bottom-32 -left-48" aria-hidden="true" />
            <div class="bg-mesh-gradient absolute inset-0" aria-hidden="true" />
            <div class="relative mx-auto max-w-4xl px-4 text-center sm:px-6 lg:px-8">
                <h1 class="text-4xl font-bold tracking-tight sm:text-5xl">Build the future of business software</h1>
                <p class="mt-6 text-lg leading-relaxed text-muted-foreground">
                    We are a team of makers, thinkers, and dreamers on a mission to simplify how businesses operate. Come build with us.
                </p>
                <div class="mt-8">
                    <Button size="lg" @click="scrollToRoles">
                        View Open Roles
                        <ArrowRight class="ms-2 size-4" />
                    </Button>
                </div>
            </div>
        </section>

        <!-- Mission & Culture -->
        <section class="py-20 lg:py-28">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="grid gap-12 lg:grid-cols-2 lg:items-center">
                    <div>
                        <h2 class="text-3xl font-bold tracking-tight">Our Mission & Culture</h2>
                        <div class="mt-6 space-y-4 leading-relaxed text-muted-foreground">
                            <p>
                                At Kaabosh, we believe great software is built by diverse, empowered teams. We are remote-first, async by default, and deeply committed to creating an environment where everyone can do the best work of their careers.
                            </p>
                            <p>
                                We ship fast, learn constantly, and treat each other with respect. Our culture values transparency, ownership, and curiosity. We do not have endless meetings or rigid hierarchies — we have clear goals, open communication, and trust.
                            </p>
                            <p>
                                Whether you are an engineer, designer, marketer, or sales professional, you will have a direct impact on products used by thousands of teams worldwide.
                            </p>
                        </div>
                    </div>
                    <div class="flex aspect-video items-center justify-center rounded-xl border bg-muted/30">
                        <img src="/images/careers/culture.jpg" alt="Kaabosh culture" class="h-full w-full rounded-lg object-cover" loading="lazy" />
                    </div>
                </div>
            </div>
        </section>

        <!-- Why Join Us -->
        <section class="relative overflow-hidden bg-muted/30 py-20 lg:py-28">
            <div class="bg-radial-glow absolute inset-0" aria-hidden="true" />
            <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mb-12 text-center">
                    <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">Why Join Kaabosh?</h2>
                    <p class="mt-4 text-lg text-muted-foreground">We invest in our people so they can do their best work.</p>
                </div>
                <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    <div v-for="benefit in benefits" :key="benefit.title" class="rounded-xl border bg-card p-6">
                        <div class="mb-4 flex size-10 items-center justify-center rounded-lg bg-primary/10">
                            <component :is="benefit.icon" class="size-5 text-primary" />
                        </div>
                        <h3 class="text-lg font-semibold">{{ benefit.title }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-muted-foreground">{{ benefit.description }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Benefits & Perks -->
        <section class="py-20 lg:py-28">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mb-12 text-center">
                    <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">Benefits & Perks</h2>
                </div>
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    <div v-for="perk in perks" :key="perk.title" class="flex items-start gap-4">
                        <div class="flex size-10 shrink-0 items-center justify-center rounded-lg bg-primary/10">
                            <component :is="perk.icon" class="size-5 text-primary" />
                        </div>
                        <div>
                            <h3 class="font-semibold">{{ perk.title }}</h3>
                            <p class="mt-1 text-sm text-muted-foreground">{{ perk.description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Hiring Process -->
        <section class="relative overflow-hidden bg-muted/30 py-20 lg:py-28">
            <div class="bg-dot-grid absolute inset-0" aria-hidden="true" />
            <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mb-16 text-center">
                    <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">Our Hiring Process</h2>
                    <p class="mt-4 text-lg text-muted-foreground">Transparent, respectful, and fast. Here is what to expect.</p>
                </div>
                <div class="grid gap-8 sm:grid-cols-4">
                    <div
                        v-for="(step, index) in hiringSteps"
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
                            v-if="index < hiringSteps.length - 1"
                            class="hidden sm:block absolute top-6 left-[calc(50%+24px)] w-[calc(100%-48px)] h-px bg-border"
                        />
                    </div>
                </div>
            </div>
        </section>

        <!-- Open Roles -->
        <section id="open-roles" class="py-20 lg:py-28">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mb-12 text-center">
                    <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">Open Roles</h2>
                    <p class="mt-4 text-lg text-muted-foreground">Find the role that is right for you.</p>
                </div>

                <!-- Filter Bar -->
                <div class="mb-8 rounded-xl border bg-card p-4">
                    <div class="flex flex-col gap-4 lg:flex-row lg:items-center">
                        <div class="flex-1">
                            <div class="relative">
                                <Search class="absolute top-1/2 -translate-y-1/2 size-4 text-muted-foreground ltr:left-3 rtl:right-3" />
                                <Input
                                    v-model="searchQuery"
                                    placeholder="Search roles..."
                                    class="ltr:pl-9 rtl:pr-9"
                                />
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-3">
                            <select
                                v-model="selectedDepartment"
                                class="flex h-9 rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-xs transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring"
                            >
                                <option v-for="dept in departments" :key="dept" :value="dept">{{ dept === 'All' ? 'All Departments' : dept }}</option>
                            </select>
                            <select
                                v-model="selectedWorkType"
                                class="flex h-9 rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-xs transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring"
                            >
                                <option v-for="wt in workTypes" :key="wt" :value="wt">{{ wt === 'All' ? 'All Work Types' : wt }}</option>
                            </select>
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
                    <div class="mt-3 text-sm text-muted-foreground">
                        Showing {{ filteredRoles.length }} of {{ roles.length }} roles
                    </div>
                </div>

                <!-- Role Cards -->
                <div v-if="filteredRoles.length" class="space-y-4">
                    <Link
                        v-for="role in filteredRoles"
                        :key="role.slug"
                        :href="`/careers/${role.slug}`"
                        class="block rounded-xl border bg-card p-6 transition-colors hover:bg-accent/50"
                    >
                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold">{{ role.title }}</h3>
                                <div class="mt-2 flex flex-wrap items-center gap-2">
                                    <Badge variant="secondary">{{ role.department }}</Badge>
                                    <span class="flex items-center gap-1 text-sm text-muted-foreground">
                                        <MapPin class="size-3.5" />
                                        {{ role.location }}
                                    </span>
                                    <Badge variant="outline">{{ role.workType }}</Badge>
                                </div>
                                <p class="mt-3 text-sm text-muted-foreground">{{ role.description }}</p>
                            </div>
                            <div class="shrink-0">
                                <Button variant="outline" size="sm">
                                    Apply Now
                                    <ArrowRight class="ms-1 size-3.5" />
                                </Button>
                            </div>
                        </div>
                    </Link>
                </div>

                <!-- Empty State -->
                <div v-else class="rounded-xl border bg-card py-20 text-center">
                    <Briefcase class="mx-auto size-12 text-muted-foreground" />
                    <h3 class="mt-4 text-lg font-semibold">No roles match your filters</h3>
                    <p class="mt-2 text-muted-foreground">Try adjusting your search or filters, or submit a general interest form below.</p>
                    <Button variant="outline" class="mt-4" @click="clearFilters">Clear Filters</Button>
                </div>
            </div>
        </section>

        <!-- General Interest Form -->
        <section class="border-t bg-muted/30 py-20 lg:py-28">
            <div class="mx-auto max-w-2xl px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2 class="text-3xl font-bold tracking-tight">Don't see the right role?</h2>
                    <p class="mt-4 text-muted-foreground">Send us your details and we will reach out when a matching position opens up.</p>
                </div>

                <div v-if="interestSuccess" class="mt-8 rounded-xl border bg-green-50 p-8 text-center dark:bg-green-950/20">
                    <CheckCircle class="mx-auto size-12 text-green-600 dark:text-green-400" />
                    <h3 class="mt-4 text-lg font-semibold">Thanks for your interest!</h3>
                    <p class="mt-2 text-muted-foreground">We have received your submission. We will be in touch if a matching role opens up.</p>
                </div>
                <form v-else class="mt-8 space-y-6" @submit.prevent="submitInterest">
                    <div>
                        <Label for="interest-name">Full Name</Label>
                        <Input id="interest-name" v-model="interestForm.name" placeholder="Your full name" class="mt-1" />
                        <p v-if="interestErrors.name" class="mt-1 text-sm text-destructive">{{ interestErrors.name }}</p>
                    </div>
                    <div>
                        <Label for="interest-email">Email</Label>
                        <Input id="interest-email" v-model="interestForm.email" type="email" placeholder="you@example.com" class="mt-1" />
                        <p v-if="interestErrors.email" class="mt-1 text-sm text-destructive">{{ interestErrors.email }}</p>
                    </div>
                    <div>
                        <Label for="interest-message">What kind of role are you looking for?</Label>
                        <textarea
                            id="interest-message"
                            v-model="interestForm.message"
                            rows="4"
                            placeholder="Tell us about your experience and what you are looking for..."
                            class="mt-1 flex w-full rounded-md border border-input bg-transparent px-3 py-2 text-sm shadow-xs transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring"
                        />
                        <p v-if="interestErrors.message" class="mt-1 text-sm text-destructive">{{ interestErrors.message }}</p>
                    </div>
                    <Button type="submit" :disabled="interestSubmitting" size="lg">
                        <template v-if="interestSubmitting">Submitting...</template>
                        <template v-else>
                            Submit Interest
                            <Send class="ms-2 size-4 rtl:rotate-180" />
                        </template>
                    </Button>
                </form>
            </div>
        </section>
    </DefaultLayout>
</template>
