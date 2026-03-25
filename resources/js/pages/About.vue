<script setup lang="ts">
import DefaultLayout from '@/layouts/website/DefaultLayout.vue';
import { Button } from '@/components/ui/button';
import { Head, Link } from '@inertiajs/vue3';
import { Linkedin, Heart, Target, Users, Lightbulb, Rocket } from 'lucide-vue-next';
import { useLocale } from '@/composables/useLocale';
import { computed } from 'vue';

const props = defineProps<{
    team?: Array<{ photo: string; name: string; title: string; bio: string; linkedinUrl: string }>;
    values?: Array<{ icon: string; title: string; body: string }>;
    milestones?: Array<{ date: string; title: string; description: string }>;
}>();

const { t } = useLocale();

const displayTeam = computed(() => props.team ?? [
    { photo: '/images/team/member-1.jpg', name: t('about.team.ahmed.name'), title: t('about.team.ahmed.title'), bio: t('about.team.ahmed.bio'), linkedinUrl: '#' },
    { photo: '/images/team/member-2.jpg', name: t('about.team.sarah.name'), title: t('about.team.sarah.title'), bio: t('about.team.sarah.bio'), linkedinUrl: '#' },
    { photo: '/images/team/member-3.jpg', name: t('about.team.carlos.name'), title: t('about.team.carlos.title'), bio: t('about.team.carlos.bio'), linkedinUrl: '#' },
    { photo: '/images/team/member-4.jpg', name: t('about.team.fatima.name'), title: t('about.team.fatima.title'), bio: t('about.team.fatima.bio'), linkedinUrl: '#' },
    { photo: '/images/team/member-5.jpg', name: t('about.team.david.name'), title: t('about.team.david.title'), bio: t('about.team.david.bio'), linkedinUrl: '#' },
    { photo: '/images/team/member-6.jpg', name: t('about.team.priya.name'), title: t('about.team.priya.title'), bio: t('about.team.priya.bio'), linkedinUrl: '#' },
    { photo: '/images/team/member-7.jpg', name: t('about.team.james.name'), title: t('about.team.james.title'), bio: t('about.team.james.bio'), linkedinUrl: '#' },
    { photo: '/images/team/member-8.jpg', name: t('about.team.lisa.name'), title: t('about.team.lisa.title'), bio: t('about.team.lisa.bio'), linkedinUrl: '#' },
]);

const displayValues = computed(() => props.values?.map(v => ({ ...v, icon: v.icon })) ?? [
    { icon: Target, title: t('about.values.customerFirst.title'), body: t('about.values.customerFirst.body') },
    { icon: Lightbulb, title: t('about.values.simplicity.title'), body: t('about.values.simplicity.body') },
    { icon: Rocket, title: t('about.values.shipIterate.title'), body: t('about.values.shipIterate.body') },
    { icon: Users, title: t('about.values.oneTeam.title'), body: t('about.values.oneTeam.body') },
    { icon: Heart, title: t('about.values.honest.title'), body: t('about.values.honest.body') },
]);

const displayMilestones = computed(() => props.milestones ?? [
    { date: '2022', title: t('about.milestones.founded.title'), description: t('about.milestones.founded.description') },
    { date: '2023 Q1', title: t('about.milestones.firstLaunch.title'), description: t('about.milestones.firstLaunch.description') },
    { date: '2023 Q3', title: t('about.milestones.thousandTeams.title'), description: t('about.milestones.thousandTeams.description') },
    { date: '2024 Q1', title: t('about.milestones.analyticsLaunch.title'), description: t('about.milestones.analyticsLaunch.description') },
    { date: '2024 Q3', title: t('about.milestones.tenThousandTeams.title'), description: t('about.milestones.tenThousandTeams.description') },
    { date: '2025', title: t('about.milestones.seriesA.title'), description: t('about.milestones.seriesA.description') },
]);
</script>

<template>
    <Head title="About">
        <meta name="description" :content="t('about.metaDescription')" />
    </Head>

    <DefaultLayout>
        <!-- Mission Statement -->
        <section class="relative overflow-hidden bg-muted/30 py-20 lg:py-32">
            <div class="orb orb-1 -top-48 -right-32" aria-hidden="true" />
            <div class="orb orb-2 -bottom-32 -left-48" aria-hidden="true" />
            <div class="bg-mesh-gradient absolute inset-0" aria-hidden="true" />
            <div class="bg-dot-grid absolute inset-0" aria-hidden="true" />
            <div class="relative mx-auto max-w-4xl px-4 text-center sm:px-6 lg:px-8">
                <h1 class="text-4xl font-bold tracking-tight sm:text-5xl">{{ t('about.missionTitle') }}</h1>
                <p class="mt-6 text-lg leading-relaxed text-muted-foreground">{{ t('about.missionDescription') }}</p>
            </div>
        </section>

        <!-- Company Story -->
        <section class="py-20 lg:py-28">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="grid gap-12 lg:grid-cols-2 lg:items-center">
                    <div>
                        <h2 class="text-3xl font-bold tracking-tight">{{ t('about.storyTitle') }}</h2>
                        <div class="mt-6 space-y-4 leading-relaxed text-muted-foreground">
                            <p>{{ t('about.storyP1') }}</p>
                            <p>{{ t('about.storyP2') }}</p>
                            <p>{{ t('about.storyP3') }}</p>
                        </div>
                    </div>
                    <div class="flex aspect-video items-center justify-center rounded-xl border bg-muted/30">
                        <img src="/images/about/team-photo.jpg" alt="Kaabosh team" class="h-full w-full rounded-lg object-cover" loading="eager" fetchpriority="high" />
                    </div>
                </div>
            </div>
        </section>

        <!-- Team Section -->
        <section class="relative overflow-hidden bg-muted/30 py-20 lg:py-28">
            <div class="bg-radial-glow absolute inset-0" aria-hidden="true" />
            <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mb-12 text-center">
                    <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">{{ t('about.teamTitle') }}</h2>
                    <p class="mt-4 text-lg text-muted-foreground">{{ t('about.teamDescription') }}</p>
                </div>
                <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
                    <div v-for="member in displayTeam" :key="member.name" class="rounded-xl border bg-card p-6 text-center">
                        <div class="mx-auto mb-4 size-24 overflow-hidden rounded-full bg-muted">
                            <img :src="member.photo" :alt="member.name" class="size-full object-cover" loading="lazy" />
                        </div>
                        <h3 class="font-semibold">{{ member.name }}</h3>
                        <p class="text-sm text-muted-foreground">{{ member.title }}</p>
                        <p class="mt-3 text-sm leading-relaxed text-muted-foreground">{{ member.bio }}</p>
                        <a v-if="member.linkedinUrl" :href="member.linkedinUrl" class="mt-3 inline-flex items-center text-sm text-muted-foreground transition-colors hover:text-foreground" target="_blank" rel="noopener noreferrer">
                            <Linkedin class="size-4" />
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Values -->
        <section class="py-20 lg:py-28">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mb-12 text-center">
                    <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">{{ t('about.valuesTitle') }}</h2>
                </div>
                <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    <div v-for="value in displayValues" :key="value.title" class="rounded-xl border bg-card p-6">
                        <div class="mb-4 flex size-10 items-center justify-center rounded-lg bg-primary/10">
                            <component :is="value.icon" class="size-5 text-primary" />
                        </div>
                        <h3 class="text-lg font-semibold">{{ value.title }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-muted-foreground">{{ value.body }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Milestones / Timeline -->
        <section class="relative overflow-hidden bg-muted/30 py-20 lg:py-28">
            <div class="orb orb-3 top-1/4 -right-32" aria-hidden="true" />
            <div class="bg-dot-grid absolute inset-0" aria-hidden="true" />
            <div class="relative mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
                <div class="mb-12 text-center">
                    <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">{{ t('about.journeyTitle') }}</h2>
                </div>
                <div class="relative">
                    <div class="absolute top-0 bottom-0 w-px bg-border ltr:left-4 rtl:right-4 lg:left-1/2 lg:right-auto" />
                    <div class="space-y-12">
                        <div
                            v-for="(milestone, index) in displayMilestones"
                            :key="milestone.date"
                            class="relative ltr:pl-12 rtl:pr-12 lg:pl-0 lg:pr-0"
                            :class="index % 2 === 0 ? 'lg:pr-[calc(50%+2rem)] lg:text-right' : 'lg:pl-[calc(50%+2rem)]'"
                        >
                            <div class="absolute top-1 size-3 rounded-full bg-primary ltr:left-2.5 rtl:right-2.5 lg:left-[calc(50%-6px)] lg:right-auto" />
                            <div class="rounded-xl border bg-card p-4">
                                <span class="text-sm font-semibold text-primary">{{ milestone.date }}</span>
                                <h3 class="mt-1 font-semibold">{{ milestone.title }}</h3>
                                <p class="mt-1 text-sm text-muted-foreground">{{ milestone.description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Strip -->
        <section class="border-t py-16">
            <div class="mx-auto max-w-7xl px-4 text-center sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold">{{ t('about.ctaTitle') }}</h2>
                <p class="mt-2 text-muted-foreground">{{ t('about.ctaDescription') }}</p>
                <div class="mt-6 flex flex-col items-center justify-center gap-4 sm:flex-row">
                    <Button as-child size="lg">
                        <Link href="/careers">{{ t('about.viewRoles') }}</Link>
                    </Button>
                    <Button as-child variant="outline" size="lg">
                        <Link href="/contact">{{ t('about.getInTouch') }}</Link>
                    </Button>
                </div>
            </div>
        </section>
    </DefaultLayout>
</template>
