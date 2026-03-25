<script setup lang="ts">
import DefaultLayout from '@/layouts/website/DefaultLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const sections = [
    {
        title: 'Core Pages',
        links: [
            { label: 'Home', href: '/' },
            { label: 'Products', href: '/products' },
            { label: 'Pricing', href: '/pricing' },
            { label: 'About', href: '/about' },
            { label: 'Contact', href: '/contact' },
        ],
    },
    {
        title: 'Products',
        links: [
            { label: 'Kaabosh CRM', href: '/products/crm' },
            { label: 'Kaabosh Analytics', href: '/products/analytics' },
            { label: 'Kaabosh Helpdesk', href: '/products/helpdesk' },
            { label: 'Kaabosh Forms', href: '/products/forms' },
        ],
    },
    {
        title: 'Documentation',
        links: [
            { label: 'CRM Docs', href: '/products/crm/docs' },
            { label: 'Analytics Docs', href: '/products/analytics/docs' },
            { label: 'Helpdesk Docs', href: '/products/helpdesk/docs' },
        ],
    },
    {
        title: 'Blog & Updates',
        links: [
            { label: 'Blog', href: '/blog' },
            { label: 'Changelog', href: '/changelog' },
        ],
    },
    {
        title: 'Use Cases',
        links: [
            { label: 'For Developers', href: '/for-developers' },
            { label: 'For Enterprise', href: '/for-enterprise' },
            { label: 'For Agencies', href: '/for-agencies' },
        ],
    },
    {
        title: 'Resources',
        links: [
            { label: 'Integrations', href: '/integrations' },
            { label: 'Security', href: '/security' },
            { label: 'Press', href: '/press' },
        ],
    },
    {
        title: 'Careers',
        links: [
            { label: 'Open Roles', href: '/careers' },
        ],
    },
    {
        title: 'Legal',
        links: [
            { label: 'Privacy Policy', href: '/privacy-policy' },
            { label: 'Terms of Service', href: '/terms-of-service' },
            { label: 'Cookie Policy', href: '/cookie-policy' },
        ],
    },
];
</script>

<template>
    <Head title="Sitemap">
        <meta name="description" content="Kaabosh website sitemap — Find every page on our website." />
    </Head>

    <DefaultLayout>
        <section class="py-20 lg:py-28">
            <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
                <h1 class="text-4xl font-bold tracking-tight">Sitemap</h1>
                <p class="mt-4 text-lg text-muted-foreground">A complete list of all pages on our website.</p>

                <div class="mt-12 grid gap-12 sm:grid-cols-2">
                    <div v-for="section in sections" :key="section.title">
                        <h2 class="text-lg font-semibold border-b pb-2 mb-4">{{ section.title }}</h2>
                        <ul class="space-y-2">
                            <li v-for="link in section.links" :key="link.href">
                                <Link
                                    :href="link.href"
                                    class="text-muted-foreground hover:text-foreground transition-colors"
                                >
                                    {{ link.label }}
                                </Link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </DefaultLayout>
</template>
