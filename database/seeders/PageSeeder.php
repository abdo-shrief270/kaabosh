<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        Page::create([
            'slug' => 'privacy-policy',
            'type' => 'legal',
            'title' => 'Privacy Policy',
            'body' => $this->privacyPolicyContent(),
            'seo' => [
                'title' => 'Privacy Policy - Kaabosh',
                'description' => 'Learn how Kaabosh collects, uses, and protects your personal data. Our privacy policy explains your rights and our obligations.',
            ],
            'locale' => 'en',
            'last_updated_at' => '2026-03-01 00:00:00',
        ]);

        Page::create([
            'slug' => 'terms-of-service',
            'type' => 'legal',
            'title' => 'Terms of Service',
            'body' => $this->termsOfServiceContent(),
            'seo' => [
                'title' => 'Terms of Service - Kaabosh',
                'description' => 'Read the terms and conditions governing your use of the Kaabosh platform and services.',
            ],
            'locale' => 'en',
            'last_updated_at' => '2026-03-01 00:00:00',
        ]);

        Page::create([
            'slug' => 'cookie-policy',
            'type' => 'legal',
            'title' => 'Cookie Policy',
            'body' => $this->cookiePolicyContent(),
            'seo' => [
                'title' => 'Cookie Policy - Kaabosh',
                'description' => 'Understand how Kaabosh uses cookies and similar technologies on our website and application.',
            ],
            'locale' => 'en',
            'last_updated_at' => '2026-03-01 00:00:00',
        ]);

        Page::create([
            'slug' => 'security',
            'type' => 'informational',
            'title' => 'Security at Kaabosh',
            'body' => $this->securityContent(),
            'seo' => [
                'title' => 'Security - Kaabosh',
                'description' => 'Learn about the security measures, certifications, and practices that protect your data on the Kaabosh platform.',
            ],
            'locale' => 'en',
            'last_updated_at' => '2026-02-15 00:00:00',
        ]);
    }

    private function privacyPolicyContent(): string
    {
        return <<<'HTML'
<h2>1. Introduction</h2>
<p>Kaabosh, Inc. ("Kaabosh," "we," "us," or "our") respects your privacy and is committed to protecting your personal data. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website, use our products, or interact with our services.</p>
<p>This policy applies to all Kaabosh products including CRM, Analytics, Helpdesk, and Forms, as well as our marketing website at kaabosh.com.</p>

<h2>2. Information We Collect</h2>
<h3>2.1 Information You Provide</h3>
<p>We collect information you provide directly to us, including:</p>
<ul>
    <li><strong>Account information:</strong> name, email address, password, company name, and job title when you create an account.</li>
    <li><strong>Payment information:</strong> billing address and payment method details processed through our payment provider, Stripe. We do not store credit card numbers on our servers.</li>
    <li><strong>Content:</strong> any data, files, or content you upload, create, or store within Kaabosh products.</li>
    <li><strong>Communications:</strong> information you provide when contacting support, submitting feedback, or participating in surveys.</li>
</ul>

<h3>2.2 Information Collected Automatically</h3>
<p>When you use our services, we automatically collect certain information, including:</p>
<ul>
    <li><strong>Usage data:</strong> features accessed, actions taken, time spent, and interaction patterns within our products.</li>
    <li><strong>Device information:</strong> browser type, operating system, device identifiers, and screen resolution.</li>
    <li><strong>Log data:</strong> IP address, access times, pages viewed, and referring URLs.</li>
    <li><strong>Cookies and similar technologies:</strong> as described in our Cookie Policy.</li>
</ul>

<h2>3. How We Use Your Information</h2>
<p>We use the information we collect to:</p>
<ul>
    <li>Provide, maintain, and improve our products and services.</li>
    <li>Process transactions and send related information, including confirmations and invoices.</li>
    <li>Send technical notices, updates, security alerts, and support messages.</li>
    <li>Respond to your comments, questions, and customer service requests.</li>
    <li>Monitor and analyze usage trends to improve user experience.</li>
    <li>Detect, investigate, and prevent fraudulent or unauthorized activity.</li>
    <li>Comply with legal obligations and enforce our terms of service.</li>
</ul>

<h2>4. Data Sharing and Disclosure</h2>
<p>We do not sell your personal data. We may share your information in the following circumstances:</p>
<ul>
    <li><strong>Service providers:</strong> with third-party vendors who perform services on our behalf, such as hosting, payment processing, and analytics.</li>
    <li><strong>Legal requirements:</strong> when required by law, regulation, or legal process.</li>
    <li><strong>Business transfers:</strong> in connection with a merger, acquisition, or sale of assets.</li>
    <li><strong>With your consent:</strong> when you have given us explicit permission to share your data.</li>
</ul>

<h2>5. Data Retention</h2>
<p>We retain your personal data for as long as your account is active or as needed to provide you services. We retain and use your information as necessary to comply with legal obligations, resolve disputes, and enforce our agreements. You may request deletion of your account and associated data at any time by contacting support@kaabosh.com.</p>

<h2>6. Your Rights</h2>
<p>Depending on your location, you may have the following rights regarding your personal data:</p>
<ul>
    <li>Access and receive a copy of your personal data.</li>
    <li>Correct inaccurate or incomplete personal data.</li>
    <li>Request deletion of your personal data.</li>
    <li>Object to or restrict processing of your personal data.</li>
    <li>Data portability: receive your data in a structured, machine-readable format.</li>
    <li>Withdraw consent where processing is based on consent.</li>
</ul>
<p>To exercise any of these rights, please contact us at privacy@kaabosh.com.</p>

<h2>7. Security</h2>
<p>We implement appropriate technical and organizational measures to protect your personal data against unauthorized access, alteration, disclosure, or destruction. For more details, please visit our <a href="/security">Security page</a>.</p>

<h2>8. Contact Us</h2>
<p>If you have any questions about this Privacy Policy or our data practices, please contact us at:</p>
<p>Kaabosh, Inc.<br>privacy@kaabosh.com</p>
HTML;
    }

    private function termsOfServiceContent(): string
    {
        return <<<'HTML'
<h2>1. Acceptance of Terms</h2>
<p>By accessing or using any Kaabosh product or service ("Services"), you agree to be bound by these Terms of Service ("Terms"). If you are using the Services on behalf of an organization, you agree to these Terms on behalf of that organization and represent that you have the authority to do so.</p>

<h2>2. Description of Services</h2>
<p>Kaabosh provides a suite of cloud-based business tools including customer relationship management (CRM), analytics, helpdesk, and form building software. The specific features and functionality available to you depend on your subscription plan.</p>

<h2>3. Account Registration</h2>
<p>To use our Services, you must create an account and provide accurate, complete, and current information. You are responsible for maintaining the confidentiality of your account credentials and for all activities that occur under your account. You must notify us immediately of any unauthorized use of your account.</p>

<h2>4. Acceptable Use</h2>
<p>You agree not to:</p>
<ul>
    <li>Use the Services for any unlawful purpose or in violation of any applicable laws or regulations.</li>
    <li>Upload or transmit viruses, malware, or other malicious code.</li>
    <li>Attempt to gain unauthorized access to any part of the Services or related systems.</li>
    <li>Interfere with or disrupt the integrity or performance of the Services.</li>
    <li>Use the Services to send unsolicited communications (spam).</li>
    <li>Reverse engineer, decompile, or disassemble any aspect of the Services.</li>
    <li>Resell or redistribute the Services without written authorization.</li>
</ul>

<h2>5. Your Data</h2>
<p>You retain ownership of all data you upload, create, or store within the Services ("Your Data"). By using the Services, you grant Kaabosh a limited license to host, store, and process Your Data solely for the purpose of providing the Services to you. We will not access Your Data except as necessary to provide the Services, prevent or address technical issues, or as required by law.</p>

<h2>6. Subscription and Payment</h2>
<p>Paid subscriptions are billed in advance on a monthly or annual basis. All fees are non-refundable except as expressly stated in these Terms. We reserve the right to change our pricing with 30 days notice. If you do not agree to a price change, you may cancel your subscription before the change takes effect.</p>

<h2>7. Cancellation and Termination</h2>
<p>You may cancel your subscription at any time through your account settings. Upon cancellation, your access to paid features will continue until the end of your current billing period. We may terminate or suspend your account immediately if you violate these Terms. Upon termination, you may request an export of Your Data within 30 days.</p>

<h2>8. Limitation of Liability</h2>
<p>To the maximum extent permitted by law, Kaabosh shall not be liable for any indirect, incidental, special, consequential, or punitive damages, or any loss of profits or revenues, whether incurred directly or indirectly, or any loss of data, use, goodwill, or other intangible losses resulting from your use of the Services.</p>

<h2>9. Disclaimer of Warranties</h2>
<p>The Services are provided "as is" and "as available" without warranties of any kind, either express or implied, including but not limited to implied warranties of merchantability, fitness for a particular purpose, and non-infringement.</p>

<h2>10. Changes to Terms</h2>
<p>We may update these Terms from time to time. We will notify you of material changes by email or through the Services at least 30 days before the changes take effect. Your continued use of the Services after changes become effective constitutes acceptance of the updated Terms.</p>

<h2>11. Governing Law</h2>
<p>These Terms shall be governed by and construed in accordance with the laws of the State of Delaware, United States, without regard to its conflict of law provisions.</p>

<h2>12. Contact</h2>
<p>If you have questions about these Terms, please contact us at legal@kaabosh.com.</p>
HTML;
    }

    private function cookiePolicyContent(): string
    {
        return <<<'HTML'
<h2>1. What Are Cookies</h2>
<p>Cookies are small text files that are stored on your device when you visit a website. They are widely used to make websites work efficiently, provide analytics information, and enable personalized experiences. This policy explains how Kaabosh uses cookies and similar technologies.</p>

<h2>2. How We Use Cookies</h2>
<p>We use cookies for the following purposes:</p>

<h3>2.1 Essential Cookies</h3>
<p>These cookies are necessary for the Services to function properly. They enable core functionality such as authentication, session management, and security. You cannot opt out of essential cookies as the Services would not work without them.</p>

<h3>2.2 Analytics Cookies</h3>
<p>We use analytics cookies to understand how visitors interact with our website and products. This helps us improve our Services and user experience. We use privacy-focused analytics that do not track individual users across websites.</p>

<h3>2.3 Preference Cookies</h3>
<p>These cookies remember your settings and preferences, such as language, theme, and display options. They improve your experience by personalizing the Services to your needs.</p>

<h3>2.4 Marketing Cookies</h3>
<p>With your consent, we may use marketing cookies to deliver relevant advertisements and measure the effectiveness of our marketing campaigns. These cookies may be set by third-party advertising partners.</p>

<h2>3. Third-Party Cookies</h2>
<p>Some cookies on our website are set by third-party services that appear on our pages. We use the following third-party services that may set cookies:</p>
<ul>
    <li><strong>Stripe:</strong> for secure payment processing.</li>
    <li><strong>Plausible Analytics:</strong> for privacy-focused website analytics.</li>
    <li><strong>Intercom:</strong> for live chat and customer support on our marketing website.</li>
</ul>

<h2>4. Managing Cookies</h2>
<p>You can control and manage cookies through your browser settings. Most browsers allow you to refuse cookies, delete existing cookies, and set preferences for specific websites. Please note that disabling certain cookies may affect the functionality of our Services.</p>

<h2>5. Updates to This Policy</h2>
<p>We may update this Cookie Policy from time to time to reflect changes in our practices or applicable laws. We will post the updated policy on this page with a revised "last updated" date.</p>

<h2>6. Contact</h2>
<p>If you have questions about our use of cookies, please contact us at privacy@kaabosh.com.</p>
HTML;
    }

    private function securityContent(): string
    {
        return <<<'HTML'
<h2>Our Commitment to Security</h2>
<p>At Kaabosh, security is not an afterthought; it is a core part of how we build and operate our platform. We understand that you trust us with your business data, and we take that responsibility seriously. This page outlines the measures we take to protect your information.</p>

<h2>Infrastructure Security</h2>
<ul>
    <li><strong>Cloud hosting:</strong> Kaabosh is hosted on Amazon Web Services (AWS) in SOC 2 certified data centers with physical access controls, redundant power, and environmental monitoring.</li>
    <li><strong>Encryption at rest:</strong> All customer data is encrypted at rest using AES-256 encryption.</li>
    <li><strong>Encryption in transit:</strong> All data transmitted between your browser and our servers is encrypted using TLS 1.3.</li>
    <li><strong>Network security:</strong> We use VPCs, security groups, and Web Application Firewalls (WAF) to protect our infrastructure from unauthorized access and common web exploits.</li>
    <li><strong>DDoS protection:</strong> AWS Shield and CloudFront provide automatic protection against distributed denial-of-service attacks.</li>
</ul>

<h2>Application Security</h2>
<ul>
    <li><strong>Secure development:</strong> Our engineering team follows OWASP guidelines and conducts security reviews as part of every code change.</li>
    <li><strong>Dependency scanning:</strong> We automatically scan all dependencies for known vulnerabilities and apply patches promptly.</li>
    <li><strong>Penetration testing:</strong> We engage third-party security firms to conduct annual penetration tests of our platform.</li>
    <li><strong>Bug bounty program:</strong> We maintain a responsible disclosure program and reward security researchers who report vulnerabilities.</li>
</ul>

<h2>Access Control</h2>
<ul>
    <li><strong>Role-based access:</strong> Kaabosh supports granular role-based access control (RBAC) so you can define exactly who has access to what data.</li>
    <li><strong>Single Sign-On (SSO):</strong> Enterprise plans support SAML-based SSO integration with providers like Okta, Azure AD, and Google Workspace.</li>
    <li><strong>Two-factor authentication (2FA):</strong> All accounts can enable 2FA using authenticator apps or hardware security keys.</li>
    <li><strong>Audit logging:</strong> Enterprise plans include comprehensive audit logs of all user actions for compliance and investigation purposes.</li>
</ul>

<h2>Compliance</h2>
<ul>
    <li><strong>SOC 2 Type II:</strong> Kaabosh has completed a SOC 2 Type II audit covering security, availability, and confidentiality. Contact sales for a copy of our report.</li>
    <li><strong>GDPR:</strong> We comply with the General Data Protection Regulation and offer Data Processing Agreements (DPAs) for all customers.</li>
    <li><strong>CCPA:</strong> We comply with the California Consumer Privacy Act and honor all data subject access requests.</li>
    <li><strong>Data residency:</strong> Enterprise customers can choose their preferred data hosting region (US, EU, or Asia-Pacific).</li>
</ul>

<h2>Incident Response</h2>
<p>We maintain a documented incident response plan that includes detection, containment, investigation, and notification procedures. In the event of a security incident affecting your data, we will notify you within 72 hours in accordance with applicable regulations.</p>

<h2>Questions</h2>
<p>If you have security questions or want to report a vulnerability, please contact our security team at security@kaabosh.com.</p>
HTML;
    }
}
