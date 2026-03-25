<script setup lang="ts">
import DefaultLayout from '@/layouts/website/DefaultLayout.vue';
import { Button } from '@/components/ui/button';
import { Head, Link } from '@inertiajs/vue3';
import { Shield, Lock, Server, Eye, CheckCircle, FileCheck, Mail, ExternalLink } from 'lucide-vue-next';
import { useLocale } from '@/composables/useLocale';

const { t } = useLocale();

const certifications = [
    {
        icon: FileCheck,
        name: 'GDPR',
        description: 'Fully compliant with the EU General Data Protection Regulation. We provide data processing agreements, support data subject rights, and maintain transparent data handling practices.',
    },
    {
        icon: Shield,
        name: 'SOC 2 Type II',
        description: 'Independently audited for security, availability, and confidentiality controls. Our SOC 2 Type II report is available to customers under NDA upon request.',
    },
    {
        icon: Lock,
        name: 'ISO 27001',
        description: 'Certified under the international standard for information security management systems, demonstrating our commitment to systematic risk management.',
    },
    {
        icon: Eye,
        name: 'CCPA',
        description: 'Compliant with the California Consumer Privacy Act. We honor all consumer rights requests including data access, deletion, and opt-out of data sales.',
    },
];

const dataHandlingPractices = [
    'All data is encrypted at rest using AES-256 and in transit using TLS 1.3.',
    'Customer data is stored in geographically isolated regions with configurable data residency.',
    'Daily encrypted backups with point-in-time recovery for up to 30 days.',
    'Strict role-based access controls with principle of least privilege for all internal systems.',
    'Regular third-party penetration testing and vulnerability assessments.',
    'Automated security scanning integrated into our CI/CD pipeline.',
    'Comprehensive audit logging with tamper-evident storage for all system actions.',
    'Data retention policies with automatic purging when subscriptions are terminated.',
];

const securityFeatures = [
    { feature: 'SSO / SAML 2.0', crm: true, analytics: true, helpdesk: true },
    { feature: 'Two-factor authentication', crm: true, analytics: true, helpdesk: true },
    { feature: 'Role-based access control', crm: true, analytics: true, helpdesk: true },
    { feature: 'IP allowlisting', crm: true, analytics: true, helpdesk: true },
    { feature: 'Audit logs', crm: true, analytics: true, helpdesk: true },
    { feature: 'Data export & portability', crm: true, analytics: true, helpdesk: true },
    { feature: 'Custom data retention', crm: true, analytics: false, helpdesk: true },
    { feature: 'Field-level encryption', crm: true, analytics: false, helpdesk: false },
    { feature: 'Session management', crm: true, analytics: true, helpdesk: true },
    { feature: 'Webhook signing', crm: true, analytics: true, helpdesk: true },
];
</script>

<template>
    <Head title="Security">
        <meta name="description" content="Learn about Kaabosh's security practices, compliance certifications, and how we protect your data." />
    </Head>

    <DefaultLayout>
        <!-- Hero -->
        <section class="relative overflow-hidden bg-muted/30 py-20 lg:py-32">
            <div class="orb orb-1 -top-48 -right-32" aria-hidden="true" />
            <div class="orb orb-2 -bottom-32 -left-48" aria-hidden="true" />
            <div class="bg-mesh-gradient absolute inset-0" aria-hidden="true" />
            <div class="bg-dot-grid absolute inset-0" aria-hidden="true" />
            <div class="relative mx-auto max-w-4xl px-4 text-center sm:px-6 lg:px-8">
                <div class="mx-auto mb-6 flex size-16 items-center justify-center rounded-2xl bg-primary/10">
                    <Shield class="size-8 text-primary" />
                </div>
                <h1 class="text-4xl font-bold tracking-tight sm:text-5xl">Security & Compliance</h1>
                <p class="mt-6 text-lg leading-relaxed text-muted-foreground">
                    Your data security is our top priority. We implement industry-leading security practices and maintain rigorous compliance standards so you can focus on growing your business.
                </p>
            </div>
        </section>

        <!-- Compliance Certifications -->
        <section class="py-20 lg:py-28">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mb-12 text-center">
                    <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">Compliance Certifications</h2>
                    <p class="mt-4 text-lg text-muted-foreground">We meet and exceed the industry's most demanding security and privacy standards.</p>
                </div>
                <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
                    <div v-for="cert in certifications" :key="cert.name" class="rounded-xl border bg-card p-6">
                        <div class="mb-4 flex size-12 items-center justify-center rounded-lg bg-primary/10">
                            <component :is="cert.icon" class="size-6 text-primary" />
                        </div>
                        <h3 class="text-lg font-semibold">{{ cert.name }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-muted-foreground">{{ cert.description }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Data Handling Practices -->
        <section class="relative overflow-hidden bg-muted/30 py-20 lg:py-28">
            <div class="bg-radial-glow absolute inset-0" aria-hidden="true" />
            <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="grid gap-12 lg:grid-cols-2 lg:items-start">
                    <div>
                        <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">Data Handling Practices</h2>
                        <p class="mt-4 text-lg text-muted-foreground">We follow strict protocols to ensure your data is handled securely at every stage.</p>
                    </div>
                    <ul class="space-y-4">
                        <li v-for="practice in dataHandlingPractices" :key="practice" class="flex items-start gap-3">
                            <CheckCircle class="mt-0.5 size-5 shrink-0 text-green-600 dark:text-green-400" />
                            <span class="text-sm leading-relaxed text-muted-foreground">{{ practice }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- Security Features Per Product -->
        <section class="py-20 lg:py-28">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mb-12 text-center">
                    <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">Security Features by Product</h2>
                    <p class="mt-4 text-lg text-muted-foreground">Enterprise-grade security controls available across our product suite.</p>
                </div>
                <div class="overflow-x-auto rounded-xl border">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b bg-muted/50">
                                <th class="px-6 py-4 text-left font-semibold">Feature</th>
                                <th class="px-6 py-4 text-center font-semibold">CRM</th>
                                <th class="px-6 py-4 text-center font-semibold">Analytics</th>
                                <th class="px-6 py-4 text-center font-semibold">Helpdesk</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="row in securityFeatures" :key="row.feature" class="border-b last:border-b-0 transition-colors hover:bg-muted/30">
                                <td class="px-6 py-4 font-medium">{{ row.feature }}</td>
                                <td class="px-6 py-4 text-center">
                                    <CheckCircle v-if="row.crm" class="mx-auto size-5 text-green-600 dark:text-green-400" />
                                    <span v-else class="text-muted-foreground">&mdash;</span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <CheckCircle v-if="row.analytics" class="mx-auto size-5 text-green-600 dark:text-green-400" />
                                    <span v-else class="text-muted-foreground">&mdash;</span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <CheckCircle v-if="row.helpdesk" class="mx-auto size-5 text-green-600 dark:text-green-400" />
                                    <span v-else class="text-muted-foreground">&mdash;</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- Contact for Security Inquiries -->
        <section class="border-t bg-muted/30 py-16">
            <div class="mx-auto max-w-7xl px-4 text-center sm:px-6 lg:px-8">
                <div class="mx-auto mb-4 flex size-10 items-center justify-center rounded-lg bg-primary/10">
                    <Lock class="size-5 text-primary" />
                </div>
                <h2 class="text-2xl font-bold">Security Questions or Concerns?</h2>
                <p class="mt-2 text-muted-foreground">Our security team is here to help. Reach out for security inquiries, to report vulnerabilities, or to request compliance documentation.</p>
                <div class="mt-6 flex flex-col items-center justify-center gap-4 sm:flex-row">
                    <Button as-child size="lg">
                        <a href="mailto:security@kaabosh.com">
                            <Mail class="me-2 size-4" />
                            security@kaabosh.com
                        </a>
                    </Button>
                    <Button as-child variant="outline" size="lg">
                        <Link href="/contact">
                            Contact Us
                            <ExternalLink class="ms-2 size-4" />
                        </Link>
                    </Button>
                </div>
            </div>
        </section>
    </DefaultLayout>
</template>
