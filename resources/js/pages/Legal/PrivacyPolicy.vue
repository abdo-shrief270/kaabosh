<script setup lang="ts">
import LegalLayout from '@/layouts/website/LegalLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps<{
    title?: string;
    lastUpdated?: string;
    body?: string;
}>();
</script>

<template>
    <Head title="Privacy Policy">
        <meta name="description" content="Kaabosh Privacy Policy — Learn how we collect, use, and protect your personal data." />
    </Head>

    <LegalLayout :title="props.title ?? 'Privacy Policy'" :last-updated="props.lastUpdated ?? 'March 1, 2025'">
        <div v-if="props.body" v-html="props.body" />
        <template v-else>
        <h2 id="introduction">1. Introduction</h2>
        <p>
            Welcome to Kaabosh ("Company," "we," "our," or "us"). This Privacy Policy explains how we collect, use,
            disclose, and safeguard your information when you visit our website and use our services.
        </p>
        <p>
            Please read this Privacy Policy carefully. If you do not agree with the terms of this Privacy Policy,
            please do not access the site.
        </p>

        <h2 id="information-we-collect">2. Information We Collect</h2>
        <h3>Personal Data</h3>
        <p>
            We may collect personally identifiable information, such as your name, email address, company name,
            and phone number, that you voluntarily provide when you:
        </p>
        <ul>
            <li>Register for our products or services</li>
            <li>Sign up for our newsletter or waitlist</li>
            <li>Submit a contact form or sales inquiry</li>
            <li>Apply for a job</li>
        </ul>

        <h3>Usage Data</h3>
        <p>
            We may automatically collect certain information when you visit our website, including your IP address,
            browser type, operating system, referring URLs, and pages viewed. This data is collected only with your
            consent via our cookie preferences.
        </p>

        <h2 id="how-we-use">3. How We Use Your Information</h2>
        <p>We use the information we collect to:</p>
        <ul>
            <li>Provide, operate, and maintain our website and services</li>
            <li>Respond to your comments, questions, and requests</li>
            <li>Send you product updates and marketing communications (with your consent)</li>
            <li>Monitor and analyze usage and trends to improve your experience</li>
            <li>Detect, prevent, and address technical issues</li>
        </ul>

        <h2 id="data-sharing">4. Data Sharing & Disclosure</h2>
        <p>
            We do not sell your personal information. We may share your information with third parties only in
            the following circumstances:
        </p>
        <ul>
            <li>With your consent</li>
            <li>With service providers who assist in our operations (subject to confidentiality agreements)</li>
            <li>To comply with legal obligations</li>
            <li>To protect our rights, privacy, safety, or property</li>
        </ul>

        <h2 id="cookies">5. Cookies & Tracking</h2>
        <p>
            We use cookies and similar tracking technologies to track activity on our website. You can manage your
            cookie preferences at any time through the cookie settings link in our website footer.
        </p>

        <h2 id="data-retention">6. Data Retention</h2>
        <p>
            We retain your personal data only for as long as necessary to fulfill the purposes outlined in this
            Privacy Policy, unless a longer retention period is required by law.
        </p>

        <h2 id="your-rights">7. Your Rights</h2>
        <p>Depending on your location, you may have the following rights:</p>
        <ul>
            <li>The right to access your personal data</li>
            <li>The right to correct inaccurate data</li>
            <li>The right to delete your data</li>
            <li>The right to restrict or object to processing</li>
            <li>The right to data portability</li>
            <li>The right to withdraw consent</li>
        </ul>

        <h2 id="security">8. Security</h2>
        <p>
            We use industry-standard security measures to protect your personal data, including encryption
            at rest and in transit, access controls, and regular security audits.
        </p>

        <h2 id="contact">9. Contact Us</h2>
        <p>
            If you have questions about this Privacy Policy, please contact us at:
        </p>
        <p>
            <strong>Email:</strong> privacy@kaabosh.com<br />
            <strong>Address:</strong> Dubai, United Arab Emirates
        </p>
        </template>
    </LegalLayout>
</template>
