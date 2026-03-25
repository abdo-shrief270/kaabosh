<script setup lang="ts">
import DefaultLayout from '@/layouts/website/DefaultLayout.vue';
import { Button } from '@/components/ui/button';
import { Badge } from '@/components/ui/badge';
import { Head, Link } from '@inertiajs/vue3';
import { ArrowLeft, ArrowRight, CheckCircle } from 'lucide-vue-next';
import { useLocale } from '@/composables/useLocale';
import { computed } from 'vue';

const { t } = useLocale();

const props = defineProps<{
    slug: string;
    integration?: Record<string, any>;
}>();

const fallbackIntegrationData: Record<string, any> = {
    slack: {
        name: 'Slack',
        logo: '/images/integrations/slack.svg',
        category: 'Communication',
        description: 'Connect Kaabosh with Slack to get real-time notifications, create deals from messages, and keep your entire team in the loop without ever leaving your favorite messaging app.',
        connectedProducts: ['Kaabosh CRM', 'Kaabosh Analytics', 'Kaabosh Helpdesk'],
        setupSteps: [
            { title: 'Connect your Slack workspace', description: 'Click "Add to Slack" and authorize Kaabosh to access your workspace.' },
            { title: 'Choose your channels', description: 'Select which Slack channels should receive notifications for deals, tickets, and reports.' },
            { title: 'Configure triggers', description: 'Set up which events send Slack messages — new deals, closed tickets, weekly reports, and more.' },
            { title: 'Start collaborating', description: 'Your team will receive real-time updates. Use slash commands to create deals and look up contacts from Slack.' },
        ],
    },
    zapier: {
        name: 'Zapier',
        logo: '/images/integrations/zapier.svg',
        category: 'Automation',
        description: 'Use Zapier to connect Kaabosh with 5,000+ apps. Build no-code automation workflows that trigger actions across your entire stack whenever key events happen in Kaabosh.',
        connectedProducts: ['Kaabosh CRM', 'Kaabosh Analytics', 'Kaabosh Helpdesk', 'Kaabosh Forms'],
        setupSteps: [
            { title: 'Create a Zapier account', description: 'Sign up for Zapier if you do not already have an account.' },
            { title: 'Search for Kaabosh', description: 'Find Kaabosh in the Zapier app directory and connect your account with your API key.' },
            { title: 'Build your Zap', description: 'Choose a trigger event in Kaabosh and an action in another app — or vice versa.' },
            { title: 'Test and activate', description: 'Run a test to confirm data flows correctly, then turn on your Zap.' },
        ],
    },
    stripe: {
        name: 'Stripe',
        logo: '/images/integrations/stripe.svg',
        category: 'Payments',
        description: 'Sync Stripe payment data with your Kaabosh CRM. Track revenue per contact, automate invoicing from your pipeline, and get a complete picture of customer lifetime value.',
        connectedProducts: ['Kaabosh CRM', 'Kaabosh Analytics'],
        setupSteps: [
            { title: 'Connect your Stripe account', description: 'Authenticate with Stripe using OAuth. No API keys to copy.' },
            { title: 'Map your data', description: 'Choose how Stripe customers, charges, and subscriptions map to Kaabosh contacts and deals.' },
            { title: 'Enable auto-sync', description: 'Turn on bi-directional sync so payment events update your CRM in real time.' },
            { title: 'View revenue insights', description: 'Open your Kaabosh Analytics dashboard to see revenue metrics alongside your sales data.' },
        ],
    },
    hubspot: {
        name: 'HubSpot',
        logo: '/images/integrations/hubspot.svg',
        category: 'CRM',
        description: 'Migrate from HubSpot to Kaabosh or run both platforms side by side. Our bi-directional sync keeps contacts, deals, and notes in perfect alignment.',
        connectedProducts: ['Kaabosh CRM'],
        setupSteps: [
            { title: 'Authorize HubSpot', description: 'Connect your HubSpot account via OAuth to establish a secure connection.' },
            { title: 'Select sync direction', description: 'Choose one-way import, one-way export, or bi-directional sync based on your migration plan.' },
            { title: 'Map custom fields', description: 'Our field mapper auto-matches common fields and lets you manually map custom properties.' },
            { title: 'Start the sync', description: 'Kick off the initial sync. Progress is tracked in real time on your integration dashboard.' },
        ],
    },
    github: {
        name: 'GitHub',
        logo: '/images/integrations/github.svg',
        category: 'Developer Tools',
        description: 'Link GitHub pull requests and issues to customer tickets. Track feature requests from customers all the way through to merged code.',
        connectedProducts: ['Kaabosh CRM', 'Kaabosh Helpdesk'],
        setupSteps: [
            { title: 'Install the GitHub App', description: 'Install the Kaabosh GitHub App on your organization and select the repositories to connect.' },
            { title: 'Link repositories', description: 'Map GitHub repos to Kaabosh products or projects for automatic issue linking.' },
            { title: 'Enable event tracking', description: 'Choose which GitHub events (PRs, issues, releases) appear in Kaabosh timelines.' },
            { title: 'Close the loop', description: 'When a linked PR is merged, the associated customer ticket is automatically updated.' },
        ],
    },
    'google-workspace': {
        name: 'Google Workspace',
        logo: '/images/integrations/google-workspace.svg',
        category: 'Productivity',
        description: 'Sync Gmail, Google Calendar, and Google Contacts with Kaabosh. Emails are logged automatically, meetings appear on contact timelines, and contacts stay in sync.',
        connectedProducts: ['Kaabosh CRM', 'Kaabosh Analytics'],
        setupSteps: [
            { title: 'Sign in with Google', description: 'Authenticate with your Google Workspace account. Admin consent may be required for org-wide sync.' },
            { title: 'Enable Gmail sync', description: 'Choose to auto-log sent and received emails on matching contact records in Kaabosh.' },
            { title: 'Connect Calendar', description: 'Sync your Google Calendar so meetings with contacts appear on their timeline.' },
            { title: 'Sync Contacts', description: 'Enable bi-directional contact sync to keep Google Contacts and Kaabosh in alignment.' },
        ],
    },
    salesforce: {
        name: 'Salesforce',
        logo: '/images/integrations/salesforce.svg',
        category: 'CRM',
        description: 'Migrate from Salesforce to Kaabosh with our dedicated import tool. Map custom fields, preserve your history, and make the switch without losing a single record.',
        connectedProducts: ['Kaabosh CRM', 'Kaabosh Analytics'],
        setupSteps: [
            { title: 'Connect Salesforce', description: 'Authenticate with your Salesforce org using OAuth. Supports both Production and Sandbox environments.' },
            { title: 'Select objects to migrate', description: 'Choose which Salesforce objects to import: Accounts, Contacts, Opportunities, Tasks, and more.' },
            { title: 'Map fields', description: 'Our auto-mapper handles standard fields. Review and adjust custom field mappings as needed.' },
            { title: 'Run the migration', description: 'Start the import with full progress tracking. Rollback is available if anything looks off.' },
        ],
    },
    jira: {
        name: 'Jira',
        logo: '/images/integrations/jira.svg',
        category: 'Developer Tools',
        description: 'Turn customer feedback into Jira tickets automatically. Track issue status from within Kaabosh and keep customers updated as their requests move through your backlog.',
        connectedProducts: ['Kaabosh CRM', 'Kaabosh Helpdesk'],
        setupSteps: [
            { title: 'Connect Jira', description: 'Link your Atlassian account and select the Jira projects to connect with Kaabosh.' },
            { title: 'Configure ticket creation', description: 'Set rules for when customer tickets or feature requests should auto-create Jira issues.' },
            { title: 'Map issue types', description: 'Choose how Kaabosh categories map to Jira issue types (Bug, Story, Task, etc.).' },
            { title: 'Enable status sync', description: 'When Jira issues move through your workflow, linked Kaabosh tickets update automatically.' },
        ],
    },
};

const integration = computed(() => props.integration ?? fallbackIntegrationData[props.slug] ?? fallbackIntegrationData.slack);
</script>

<template>
    <Head :title="`${integration.name} Integration`">
        <meta :content="`Connect ${integration.name} with Kaabosh — ${integration.description.slice(0, 120)}...`" name="description" />
    </Head>

    <DefaultLayout>
        <!-- Back Link -->
        <section class="border-b">
            <div class="mx-auto max-w-7xl px-4 py-3 sm:px-6 lg:px-8">
                <Link href="/integrations" class="inline-flex items-center text-sm text-muted-foreground transition-colors hover:text-foreground">
                    <ArrowLeft class="me-1 size-4" />
                    All Integrations
                </Link>
            </div>
        </section>

        <!-- Integration Header -->
        <section class="relative overflow-hidden bg-muted/30 py-20 lg:py-28">
            <div class="bg-mesh-gradient absolute inset-0" aria-hidden="true" />
            <div class="bg-dot-grid absolute inset-0" aria-hidden="true" />
            <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col items-center text-center sm:flex-row sm:text-start sm:gap-6">
                    <div class="mb-6 flex size-20 items-center justify-center rounded-2xl border bg-card sm:mb-0">
                        <img :src="integration.logo" :alt="integration.name" class="size-12" />
                    </div>
                    <div>
                        <div class="flex items-center justify-center gap-3 sm:justify-start">
                            <h1 class="text-3xl font-bold tracking-tight sm:text-4xl">{{ integration.name }}</h1>
                            <Badge variant="secondary">{{ integration.category }}</Badge>
                        </div>
                        <p class="mt-4 max-w-2xl text-lg leading-relaxed text-muted-foreground">{{ integration.description }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Connected Products -->
        <section class="py-20 lg:py-28">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">Connected products</h2>
                <p class="mt-4 text-muted-foreground">This integration works with the following Kaabosh products.</p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <div
                        v-for="product in integration.connectedProducts"
                        :key="product"
                        class="flex items-center gap-2 rounded-xl border bg-card px-4 py-3"
                    >
                        <CheckCircle class="size-5 text-green-600 dark:text-green-400" />
                        <span class="font-medium">{{ product }}</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Setup Steps -->
        <section class="bg-muted/30 py-20 lg:py-28">
            <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
                <div class="mb-12 text-center">
                    <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">Setup in minutes</h2>
                    <p class="mt-4 text-muted-foreground">Get {{ integration.name }} connected to Kaabosh in just a few steps.</p>
                </div>
                <div class="space-y-6">
                    <div
                        v-for="(step, index) in integration.setupSteps"
                        :key="step.title"
                        class="flex gap-4"
                    >
                        <div class="flex size-10 shrink-0 items-center justify-center rounded-full bg-primary text-primary-foreground font-bold">
                            {{ index + 1 }}
                        </div>
                        <div class="rounded-xl border bg-card p-4 flex-1">
                            <h3 class="font-semibold">{{ step.title }}</h3>
                            <p class="mt-1 text-sm text-muted-foreground">{{ step.description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA -->
        <section class="border-t py-16">
            <div class="mx-auto max-w-7xl px-4 text-center sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold">Ready to connect {{ integration.name }}?</h2>
                <p class="mt-2 text-muted-foreground">Start your free trial and set up this integration in minutes.</p>
                <div class="mt-6 flex flex-col items-center justify-center gap-4 sm:flex-row">
                    <Button as-child size="lg">
                        <Link href="/contact">Start Free Trial</Link>
                    </Button>
                    <Button as-child variant="outline" size="lg">
                        <Link href="/integrations">Browse All Integrations</Link>
                    </Button>
                </div>
            </div>
        </section>
    </DefaultLayout>
</template>
