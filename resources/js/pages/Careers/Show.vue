<script setup lang="ts">
import DefaultLayout from '@/layouts/website/DefaultLayout.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Badge } from '@/components/ui/badge';
import { Head, Link } from '@inertiajs/vue3';
import {
    MapPin, Calendar, ArrowRight, Send, CheckCircle, AlertCircle,
    Upload, Briefcase, ArrowLeft,
} from 'lucide-vue-next';
import { ref, computed } from 'vue';
import { useLocale } from '@/composables/useLocale';

const props = defineProps<{
    slug: string;
    role?: Record<string, any>;
    relatedRoles?: Array<{ slug: string; title: string; department: string; location: string; workType: string }>;
}>();

const { t } = useLocale();

const fallbackRolesData: Record<string, any> = {
    'senior-frontend-engineer': {
        title: 'Senior Frontend Engineer',
        department: 'Engineering',
        location: 'Remote (Global)',
        workType: 'Full-time',
        postedDate: '2026-03-10',
        summary: 'We are looking for a Senior Frontend Engineer to help build beautiful, performant user interfaces across the Kaabosh product suite. You will work closely with designers and backend engineers to deliver features that delight thousands of users every day.',
        whatYouWillDo: [
            'Build and maintain complex UI components using Vue.js 3 and TypeScript',
            'Collaborate with product designers to translate wireframes into polished interfaces',
            'Improve frontend performance, accessibility, and code quality',
            'Mentor junior engineers and contribute to architectural decisions',
            'Write unit and integration tests to ensure reliability',
            'Participate in code reviews and contribute to engineering best practices',
        ],
        required: [
            '5+ years of professional frontend development experience',
            'Strong proficiency in Vue.js (v3), TypeScript, and modern CSS',
            'Experience with state management patterns and component architecture',
            'Understanding of web performance optimization techniques',
            'Excellent communication skills and ability to work asynchronously',
        ],
        niceToHave: [
            'Experience with Inertia.js and Laravel',
            'Familiarity with Tailwind CSS and headless UI libraries',
            'Contributions to open-source projects',
            'Experience in a remote-first environment',
        ],
        whatWeOffer: [
            'Competitive salary and equity package',
            'Comprehensive health, dental, and vision insurance',
            '$2,000 annual learning and development budget',
            'Flexible working hours and unlimited PTO',
            '$1,500 home office setup stipend',
            'Annual team retreats in exciting locations',
        ],
    },
    'backend-engineer': {
        title: 'Backend Engineer',
        department: 'Engineering',
        location: 'Remote (US/EU)',
        workType: 'Full-time',
        postedDate: '2026-03-12',
        summary: 'Join our backend team to design and implement the scalable APIs and services that power Kaabosh. You will work with modern PHP and Laravel to build reliable, high-performance systems.',
        whatYouWillDo: [
            'Design and build RESTful APIs and backend services using Laravel',
            'Optimize database queries and ensure data integrity at scale',
            'Implement authentication, authorization, and security best practices',
            'Collaborate with frontend engineers to define API contracts',
            'Participate in on-call rotations and incident response',
            'Contribute to CI/CD pipelines and infrastructure automation',
        ],
        required: [
            '3+ years of backend development experience with PHP/Laravel',
            'Strong understanding of relational databases (PostgreSQL/MySQL)',
            'Experience designing and building RESTful APIs',
            'Knowledge of software design patterns and SOLID principles',
            'Familiarity with version control (Git) and collaborative workflows',
        ],
        niceToHave: [
            'Experience with Redis, Elasticsearch, or message queues',
            'Familiarity with Docker and Kubernetes',
            'Experience with event-driven architectures',
            'Background in SaaS or multi-tenant applications',
        ],
        whatWeOffer: [
            'Competitive salary and equity package',
            'Comprehensive health, dental, and vision insurance',
            '$2,000 annual learning and development budget',
            'Flexible working hours and unlimited PTO',
            '$1,500 home office setup stipend',
            'Annual team retreats in exciting locations',
        ],
    },
};

const role = computed(() => props.role ?? fallbackRolesData[props.slug] ?? fallbackRolesData['senior-frontend-engineer']);

const hiringSteps = [
    { title: 'Application Review', description: 'We review every application within 5 business days.' },
    { title: 'Intro Call', description: '30-minute conversation with a recruiter.' },
    { title: 'Technical Interview', description: 'A deeper dive into your skills with the team.' },
    { title: 'Offer & Onboarding', description: 'Expect an offer within a week of your final interview.' },
];

const displayRelatedRoles = computed(() => props.relatedRoles ?? [
    { slug: 'backend-engineer', title: 'Backend Engineer', department: 'Engineering', location: 'Remote (US/EU)', workType: 'Full-time' },
    { slug: 'product-designer', title: 'Product Designer', department: 'Design', location: 'Remote (Global)', workType: 'Full-time' },
    { slug: 'devops-engineer', title: 'DevOps Engineer', department: 'Engineering', location: 'Remote (EU)', workType: 'Full-time' },
].filter(r => r.slug !== props.slug).slice(0, 3));

// Application form
const form = ref({
    fullName: '',
    email: '',
    phone: '',
    country: '',
    cv: null as File | null,
    linkedinUrl: '',
    portfolioUrl: '',
    coverLetter: '',
    referralSource: '',
    referralName: '',
    diversityGender: '',
    diversityEthnicity: '',
    diversityDisability: '',
});

const errors = ref<Record<string, string>>({});
const submitting = ref(false);
const submitted = ref(false);
const submitError = ref('');

const countries = [
    'United States', 'United Kingdom', 'Canada', 'Germany', 'France', 'Netherlands',
    'Australia', 'India', 'Brazil', 'United Arab Emirates', 'Saudi Arabia', 'Egypt',
    'Japan', 'Singapore', 'South Korea', 'Other',
];

const referralSources = [
    'LinkedIn', 'Job Board', 'Company Website', 'Referral', 'Social Media', 'Other',
];

const showPortfolio = computed(() => {
    return role.value.department === 'Design';
});

const showReferralName = computed(() => {
    return form.value.referralSource === 'Referral';
});

function handleFileChange(event: Event) {
    const target = event.target as HTMLInputElement;
    if (target.files && target.files.length > 0) {
        form.value.cv = target.files[0];
    }
}

function validate() {
    const errs: Record<string, string> = {};
    if (!form.value.fullName || form.value.fullName.length < 2) errs.fullName = 'Full name is required.';
    if (!form.value.email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(form.value.email)) errs.email = 'Please enter a valid email address.';
    if (!form.value.phone) errs.phone = 'Phone number is required.';
    if (!form.value.country) errs.country = 'Please select a country.';
    if (!form.value.cv) errs.cv = 'Please upload your CV.';
    if (!form.value.coverLetter || form.value.coverLetter.length < 50) errs.coverLetter = 'Cover letter must be at least 50 characters.';
    if (!form.value.referralSource) errs.referralSource = 'Please select how you heard about us.';
    if (form.value.referralSource === 'Referral' && !form.value.referralName) errs.referralName = 'Please provide the referrer name.';
    if (showPortfolio.value && !form.value.portfolioUrl) errs.portfolioUrl = 'Portfolio URL is required for design roles.';
    errors.value = errs;
    return Object.keys(errs).length === 0;
}

async function submitApplication() {
    if (!validate()) return;
    submitting.value = true;
    submitError.value = '';
    await new Promise(r => setTimeout(r, 2000));
    submitting.value = false;
    submitted.value = true;
}

function scrollToApplication() {
    document.getElementById('apply')?.scrollIntoView({ behavior: 'smooth' });
}
</script>

<template>
    <Head :title="`${role.title} - Careers`">
        <meta :content="`${role.title} at Kaabosh - ${role.department} | ${role.location}`" name="description" />
    </Head>

    <DefaultLayout>
        <!-- Role Header -->
        <section class="relative overflow-hidden bg-muted/30 py-20 lg:py-28">
            <div class="orb orb-1 -top-48 -right-32" aria-hidden="true" />
            <div class="orb orb-2 -bottom-32 -left-48" aria-hidden="true" />
            <div class="bg-mesh-gradient absolute inset-0" aria-hidden="true" />
            <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mb-6">
                    <Button as-child variant="ghost" size="sm">
                        <Link href="/careers">
                            <ArrowLeft class="me-1 size-4" />
                            All Roles
                        </Link>
                    </Button>
                </div>
                <h1 class="text-4xl font-bold tracking-tight sm:text-5xl">{{ role.title }}</h1>
                <div class="mt-4 flex flex-wrap items-center gap-3">
                    <Badge variant="secondary">{{ role.department }}</Badge>
                    <span class="flex items-center gap-1 text-sm text-muted-foreground">
                        <MapPin class="size-4" />
                        {{ role.location }}
                    </span>
                    <Badge variant="outline">{{ role.workType }}</Badge>
                    <span class="flex items-center gap-1 text-sm text-muted-foreground">
                        <Calendar class="size-4" />
                        Posted {{ role.postedDate }}
                    </span>
                </div>
                <div class="mt-8">
                    <Button size="lg" @click="scrollToApplication">
                        Apply Now
                        <ArrowRight class="ms-2 size-4" />
                    </Button>
                </div>
            </div>
        </section>

        <!-- Role Details -->
        <section class="py-20 lg:py-28">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="grid gap-12 lg:grid-cols-3">
                    <!-- Main Content -->
                    <div class="lg:col-span-2 space-y-12">
                        <!-- Summary -->
                        <div>
                            <p class="text-lg leading-relaxed text-muted-foreground">{{ role.summary }}</p>
                        </div>

                        <!-- What You Will Do -->
                        <div>
                            <h2 class="text-2xl font-bold tracking-tight">What You Will Do</h2>
                            <ul class="mt-4 space-y-3">
                                <li v-for="item in role.whatYouWillDo" :key="item" class="flex items-start gap-3">
                                    <CheckCircle class="mt-0.5 size-5 shrink-0 text-primary" />
                                    <span class="text-muted-foreground">{{ item }}</span>
                                </li>
                            </ul>
                        </div>

                        <!-- What We Are Looking For -->
                        <div>
                            <h2 class="text-2xl font-bold tracking-tight">What We Are Looking For</h2>
                            <h3 class="mt-6 text-lg font-semibold">Required</h3>
                            <ul class="mt-3 space-y-3">
                                <li v-for="item in role.required" :key="item" class="flex items-start gap-3">
                                    <CheckCircle class="mt-0.5 size-5 shrink-0 text-primary" />
                                    <span class="text-muted-foreground">{{ item }}</span>
                                </li>
                            </ul>
                            <h3 class="mt-6 text-lg font-semibold">Nice to Have</h3>
                            <ul class="mt-3 space-y-3">
                                <li v-for="item in role.niceToHave" :key="item" class="flex items-start gap-3">
                                    <CheckCircle class="mt-0.5 size-5 shrink-0 text-muted-foreground/60" />
                                    <span class="text-muted-foreground">{{ item }}</span>
                                </li>
                            </ul>
                        </div>

                        <!-- What We Offer -->
                        <div>
                            <h2 class="text-2xl font-bold tracking-tight">What We Offer</h2>
                            <ul class="mt-4 space-y-3">
                                <li v-for="item in role.whatWeOffer" :key="item" class="flex items-start gap-3">
                                    <CheckCircle class="mt-0.5 size-5 shrink-0 text-green-600 dark:text-green-400" />
                                    <span class="text-muted-foreground">{{ item }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="space-y-8">
                        <!-- Quick Info Card -->
                        <div class="rounded-xl border bg-card p-6">
                            <h3 class="font-semibold">Role Details</h3>
                            <dl class="mt-4 space-y-3 text-sm">
                                <div class="flex justify-between">
                                    <dt class="text-muted-foreground">Department</dt>
                                    <dd class="font-medium">{{ role.department }}</dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt class="text-muted-foreground">Location</dt>
                                    <dd class="font-medium">{{ role.location }}</dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt class="text-muted-foreground">Type</dt>
                                    <dd class="font-medium">{{ role.workType }}</dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt class="text-muted-foreground">Posted</dt>
                                    <dd class="font-medium">{{ role.postedDate }}</dd>
                                </div>
                            </dl>
                            <Button class="mt-6 w-full" size="lg" @click="scrollToApplication">
                                Apply Now
                                <ArrowRight class="ms-2 size-4" />
                            </Button>
                        </div>

                        <!-- Hiring Process -->
                        <div class="rounded-xl border bg-card p-6">
                            <h3 class="font-semibold">Hiring Process</h3>
                            <div class="relative mt-4">
                                <div class="absolute top-3 bottom-3 w-px bg-border ltr:left-3 rtl:right-3" />
                                <div class="space-y-6">
                                    <div
                                        v-for="(step, index) in hiringSteps"
                                        :key="step.title"
                                        class="relative ltr:pl-8 rtl:pr-8"
                                    >
                                        <div class="absolute top-1 flex size-6 items-center justify-center rounded-full bg-primary text-xs font-bold text-primary-foreground ltr:left-0 rtl:right-0">
                                            {{ index + 1 }}
                                        </div>
                                        <h4 class="text-sm font-semibold">{{ step.title }}</h4>
                                        <p class="mt-1 text-xs text-muted-foreground">{{ step.description }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Application Form -->
        <section id="apply" class="border-t bg-muted/30 py-20 lg:py-28">
            <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2 class="text-3xl font-bold tracking-tight">Apply for {{ role.title }}</h2>
                    <p class="mt-4 text-muted-foreground">Fill out the form below and we will get back to you within 5 business days.</p>
                </div>

                <div v-if="submitted" class="mt-8 rounded-xl border bg-green-50 p-8 text-center dark:bg-green-950/20">
                    <CheckCircle class="mx-auto size-12 text-green-600 dark:text-green-400" />
                    <h3 class="mt-4 text-lg font-semibold">Application Submitted!</h3>
                    <p class="mt-2 text-muted-foreground">Thank you for applying. Our team will review your application and get back to you soon.</p>
                    <Button as-child variant="outline" class="mt-6">
                        <Link href="/careers">Browse More Roles</Link>
                    </Button>
                </div>

                <form v-else class="mt-8 space-y-6" @submit.prevent="submitApplication">
                    <!-- Full Name & Email -->
                    <div class="grid gap-6 sm:grid-cols-2">
                        <div>
                            <Label for="app-name">Full Name *</Label>
                            <Input id="app-name" v-model="form.fullName" placeholder="Your full name" class="mt-1" />
                            <p v-if="errors.fullName" class="mt-1 text-sm text-destructive">{{ errors.fullName }}</p>
                        </div>
                        <div>
                            <Label for="app-email">Email *</Label>
                            <Input id="app-email" v-model="form.email" type="email" placeholder="you@example.com" class="mt-1" />
                            <p v-if="errors.email" class="mt-1 text-sm text-destructive">{{ errors.email }}</p>
                        </div>
                    </div>

                    <!-- Phone & Country -->
                    <div class="grid gap-6 sm:grid-cols-2">
                        <div>
                            <Label for="app-phone">Phone *</Label>
                            <Input id="app-phone" v-model="form.phone" type="tel" placeholder="+1 (555) 123-4567" class="mt-1" />
                            <p v-if="errors.phone" class="mt-1 text-sm text-destructive">{{ errors.phone }}</p>
                        </div>
                        <div>
                            <Label for="app-country">Country *</Label>
                            <select
                                id="app-country"
                                v-model="form.country"
                                class="mt-1 flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-xs transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring"
                            >
                                <option value="" disabled>Select your country</option>
                                <option v-for="c in countries" :key="c" :value="c">{{ c }}</option>
                            </select>
                            <p v-if="errors.country" class="mt-1 text-sm text-destructive">{{ errors.country }}</p>
                        </div>
                    </div>

                    <!-- CV Upload -->
                    <div>
                        <Label for="app-cv">CV / Resume *</Label>
                        <div class="mt-1">
                            <label
                                for="app-cv"
                                class="flex cursor-pointer items-center justify-center gap-2 rounded-md border border-dashed border-input px-4 py-6 text-sm text-muted-foreground transition-colors hover:bg-muted/50"
                            >
                                <Upload class="size-5" />
                                <span v-if="form.cv">{{ form.cv.name }}</span>
                                <span v-else>Click to upload PDF, DOC, or DOCX (max 5MB)</span>
                            </label>
                            <input
                                id="app-cv"
                                type="file"
                                accept=".pdf,.doc,.docx"
                                class="hidden"
                                @change="handleFileChange"
                            />
                        </div>
                        <p v-if="errors.cv" class="mt-1 text-sm text-destructive">{{ errors.cv }}</p>
                    </div>

                    <!-- LinkedIn & Portfolio -->
                    <div class="grid gap-6 sm:grid-cols-2">
                        <div>
                            <Label for="app-linkedin">LinkedIn URL</Label>
                            <Input id="app-linkedin" v-model="form.linkedinUrl" placeholder="https://linkedin.com/in/..." class="mt-1" />
                        </div>
                        <div v-if="showPortfolio">
                            <Label for="app-portfolio">Portfolio URL *</Label>
                            <Input id="app-portfolio" v-model="form.portfolioUrl" placeholder="https://your-portfolio.com" class="mt-1" />
                            <p v-if="errors.portfolioUrl" class="mt-1 text-sm text-destructive">{{ errors.portfolioUrl }}</p>
                        </div>
                    </div>

                    <!-- Cover Letter -->
                    <div>
                        <Label for="app-cover">Cover Letter *</Label>
                        <textarea
                            id="app-cover"
                            v-model="form.coverLetter"
                            rows="5"
                            placeholder="Tell us why you are interested in this role and what makes you a great fit..."
                            class="mt-1 flex w-full rounded-md border border-input bg-transparent px-3 py-2 text-sm shadow-xs transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring"
                        />
                        <p v-if="errors.coverLetter" class="mt-1 text-sm text-destructive">{{ errors.coverLetter }}</p>
                    </div>

                    <!-- Referral Source -->
                    <div class="grid gap-6 sm:grid-cols-2">
                        <div>
                            <Label for="app-referral">How did you hear about us? *</Label>
                            <select
                                id="app-referral"
                                v-model="form.referralSource"
                                class="mt-1 flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-xs transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring"
                            >
                                <option value="" disabled>Select an option</option>
                                <option v-for="src in referralSources" :key="src" :value="src">{{ src }}</option>
                            </select>
                            <p v-if="errors.referralSource" class="mt-1 text-sm text-destructive">{{ errors.referralSource }}</p>
                        </div>
                        <div v-if="showReferralName">
                            <Label for="app-referral-name">Referrer Name *</Label>
                            <Input id="app-referral-name" v-model="form.referralName" placeholder="Who referred you?" class="mt-1" />
                            <p v-if="errors.referralName" class="mt-1 text-sm text-destructive">{{ errors.referralName }}</p>
                        </div>
                    </div>

                    <!-- Diversity & Inclusion (Optional) -->
                    <div class="rounded-xl border bg-muted/30 p-6 space-y-5">
                        <div>
                            <h3 class="text-base font-semibold">Diversity & Inclusion (Optional)</h3>
                            <p class="mt-1 text-sm text-muted-foreground">
                                We are committed to building a diverse and inclusive workplace. The information below is entirely optional and will not affect your application. It is collected anonymously for aggregate reporting to help us measure and improve our hiring practices.
                            </p>
                        </div>
                        <div>
                            <Label for="app-diversity-gender">Gender Identity</Label>
                            <select
                                id="app-diversity-gender"
                                v-model="form.diversityGender"
                                class="mt-1 flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-xs transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring"
                            >
                                <option value="">Prefer not to say</option>
                                <option value="woman">Woman</option>
                                <option value="man">Man</option>
                                <option value="non-binary">Non-binary</option>
                                <option value="self-describe">Prefer to self-describe</option>
                            </select>
                        </div>
                        <div>
                            <Label for="app-diversity-ethnicity">Ethnicity</Label>
                            <select
                                id="app-diversity-ethnicity"
                                v-model="form.diversityEthnicity"
                                class="mt-1 flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-xs transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring"
                            >
                                <option value="">Prefer not to say</option>
                                <option value="asian">Asian</option>
                                <option value="black">Black or African American</option>
                                <option value="hispanic">Hispanic or Latino</option>
                                <option value="indigenous">Indigenous or Native</option>
                                <option value="middle-eastern">Middle Eastern or North African</option>
                                <option value="white">White or European</option>
                                <option value="multiracial">Multiracial / Mixed</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div>
                            <Label for="app-diversity-disability">Disability Status</Label>
                            <select
                                id="app-diversity-disability"
                                v-model="form.diversityDisability"
                                class="mt-1 flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-xs transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring"
                            >
                                <option value="">Prefer not to say</option>
                                <option value="yes">Yes, I have a disability</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                    </div>

                    <div v-if="submitError" class="flex items-center gap-2 text-sm text-destructive">
                        <AlertCircle class="size-4" />
                        {{ submitError }}
                    </div>

                    <Button type="submit" :disabled="submitting" size="lg">
                        <template v-if="submitting">Submitting Application...</template>
                        <template v-else>
                            Submit Application
                            <Send class="ms-2 size-4 rtl:rotate-180" />
                        </template>
                    </Button>
                </form>
            </div>
        </section>

        <!-- Related Roles -->
        <section class="py-20 lg:py-28">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mb-12 text-center">
                    <h2 class="text-3xl font-bold tracking-tight">Other Open Roles</h2>
                </div>
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    <Link
                        v-for="r in displayRelatedRoles"
                        :key="r.slug"
                        :href="`/careers/${r.slug}`"
                        class="rounded-xl border bg-card p-6 transition-colors hover:bg-accent/50"
                    >
                        <h3 class="text-lg font-semibold">{{ r.title }}</h3>
                        <div class="mt-2 flex flex-wrap items-center gap-2">
                            <Badge variant="secondary">{{ r.department }}</Badge>
                            <span class="flex items-center gap-1 text-sm text-muted-foreground">
                                <MapPin class="size-3.5" />
                                {{ r.location }}
                            </span>
                            <Badge variant="outline">{{ r.workType }}</Badge>
                        </div>
                        <div class="mt-4">
                            <span class="text-sm font-medium text-primary">View Role &rarr;</span>
                        </div>
                    </Link>
                </div>
                <div class="mt-8 text-center">
                    <Button as-child variant="outline" size="lg">
                        <Link href="/careers">View All Roles</Link>
                    </Button>
                </div>
            </div>
        </section>
    </DefaultLayout>
</template>
