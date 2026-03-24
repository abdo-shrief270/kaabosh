import type { HeroContent, Stat, Differentiator, AudienceTab } from './types';

export const heroContent: HeroContent = {
    headline: 'The tools your business runs on\u2014built to work together.',
    subheadline:
        'CRM, HR, project management, and secure storage in one connected platform. Stop juggling disconnected apps and start running your business from a single source of truth.',
    primaryCta: {
        label: 'Get Started Free',
        href: '/signup',
    },
    secondaryCta: {
        label: 'Watch the Demo',
        href: '/demo',
    },
    trustSignal: 'Trusted by 10,000+ teams worldwide. No credit card required.',
};

export const stats: Stat[] = [
    { value: '10,000+', label: 'Teams Worldwide' },
    { value: '99.9%', label: 'Uptime SLA' },
    { value: '50+', label: 'Integrations' },
    { value: '4.9/5', label: 'Average Rating' },
];

export const differentiators: Differentiator[] = [
    {
        icon: 'Blocks',
        title: 'One Platform, Not Ten',
        description:
            'CRM, HR, project management, and storage share a single data layer. No more CSV exports, broken integrations, or duplicate data across tools.',
    },
    {
        icon: 'Zap',
        title: 'Set Up in Minutes, Not Months',
        description:
            'Skip the six-month implementation project. Import your data, invite your team, and start working today. Most teams are fully onboarded in under an hour.',
    },
    {
        icon: 'Shield',
        title: 'Security That Doesn\u2019t Compromise',
        description:
            'SOC 2 Type II certified, end-to-end encryption, SSO, and granular permissions across every product. Enterprise-grade security without the enterprise price tag.',
    },
    {
        icon: 'HeartHandshake',
        title: 'Support That Actually Helps',
        description:
            'Real humans who know the product, not ticket routers. Pro and Enterprise customers get priority responses within 4 hours, plus dedicated account managers.',
    },
];

export const audienceTabs: AudienceTab[] = [
    {
        id: 'developers',
        label: 'Developers',
        headline: 'APIs and extensibility built for developers who ship fast.',
        body: 'Every Kaabosh product comes with a comprehensive REST API, webhooks, and TypeScript SDKs. Build custom integrations, automate workflows, and extend functionality without waiting on us.',
        benefits: [
            'Full REST API with OpenAPI specs for every product',
            'TypeScript & Python SDKs with complete type coverage',
            'Webhooks with retry logic and delivery logs',
            'OAuth 2.0 and API key authentication',
            'Sandbox environments for testing',
            'Extensive developer documentation with runnable examples',
        ],
        ctaLabel: 'Explore the API',
        ctaUrl: '/developers',
    },
    {
        id: 'businesses',
        label: 'Small Business',
        headline: 'Everything you need to run your business, nothing you don\u2019t.',
        body: 'Stop paying for five different SaaS subscriptions and spending your weekends duct-taping them together. Kaabosh gives small teams professional-grade tools at a price that makes sense.',
        benefits: [
            'Generous free tiers for every product',
            'No per-seat minimums\u2014start with just one user',
            'Import data from tools you already use',
            'Mobile apps for managing your business on the go',
            'Guided onboarding that gets you productive in 30 minutes',
            'Transparent pricing with no hidden fees or contracts',
        ],
        ctaLabel: 'See Pricing',
        ctaUrl: '/pricing',
    },
    {
        id: 'enterprise',
        label: 'Enterprise',
        headline: 'Scale, security, and compliance for organizations that can\u2019t cut corners.',
        body: 'Kaabosh Enterprise gives IT and security teams the controls they need\u2014SSO, SCIM provisioning, audit logs, data residency, and dedicated support\u2014while giving end users tools they actually want to use.',
        benefits: [
            'SSO with SAML 2.0 and OIDC support',
            'SCIM user provisioning and de-provisioning',
            'SOC 2 Type II, HIPAA, GDPR compliance',
            'Data residency in US, EU, or APAC regions',
            'Dedicated account manager and 99.99% uptime SLA',
            'Volume discounts and custom invoicing',
        ],
        ctaLabel: 'Talk to Sales',
        ctaUrl: '/contact?segment=enterprise',
    },
    {
        id: 'everyone',
        label: 'Everyone',
        headline: 'Start free, scale when you\u2019re ready.',
        body: 'Whether you\u2019re a solo founder, a growing team, or an established company, Kaabosh has a plan that fits. Every product offers a generous free tier with no time limits and no credit card required.',
        benefits: [
            'Free tiers with no time limits',
            'No credit card required to get started',
            'Upgrade, downgrade, or cancel anytime',
            'Your data is always exportable',
            'Community forum and help center for all users',
            'Regular feature updates and improvements',
        ],
        ctaLabel: 'Get Started Free',
        ctaUrl: '/signup',
    },
];

export const trustLogos: string[] = [
    'Vercel',
    'Linear',
    'Notion',
    'Raycast',
    'Supabase',
    'Resend',
    'Cal.com',
    'Dub.co',
];
