import type { PricingTier, FeatureComparison, ProductPricing } from './types';
import {
    pipeDeskPricing,
    workNestPricing,
    devLaunchPricing,
    cloudVaultPricing,
    allProductPricing,
} from './products';

// Re-export product pricing for convenience
export { pipeDeskPricing, workNestPricing, devLaunchPricing, cloudVaultPricing, allProductPricing };

// ============================================================================
// Flat pricing tiers for the main pricing page (all products combined)
// ============================================================================

export interface PricingPageTier {
    name: string;
    description: string;
    priceLabel: string;
    priceSubtext: string;
    highlighted: boolean;
    ctaLabel: string;
    ctaUrl: string;
    includedProducts: string[];
}

export const pricingPageTiers: PricingPageTier[] = [
    {
        name: 'Free',
        description: 'Try every Kaabosh product with generous free tiers. No credit card required.',
        priceLabel: '$0',
        priceSubtext: 'forever',
        highlighted: false,
        ctaLabel: 'Get Started',
        ctaUrl: '/signup',
        includedProducts: [
            'PipeDesk \u2014 1,000 contacts, 1 pipeline',
            'WorkNest \u2014 Up to 10 employees',
            'DevLaunch \u2014 1 user, 3 projects',
            'CloudVault \u2014 15 GB storage',
        ],
    },
    {
        name: 'Pro',
        description: 'Unlock the full power of each product with advanced features and integrations.',
        priceLabel: 'From $12',
        priceSubtext: '/user/month, billed annually',
        highlighted: true,
        ctaLabel: 'Start 14-Day Trial',
        ctaUrl: '/signup?plan=pro',
        includedProducts: [
            'PipeDesk Pro \u2014 $24/user/mo (annual)',
            'WorkNest Pro \u2014 $10/employee/mo (annual)',
            'DevLaunch Pro \u2014 $32/workspace/mo (annual)',
            'CloudVault Pro \u2014 $12/user/mo (annual)',
        ],
    },
    {
        name: 'Enterprise',
        description: 'Advanced security, compliance, custom contracts, and dedicated support for large organizations.',
        priceLabel: 'Custom',
        priceSubtext: 'volume discounts available',
        highlighted: false,
        ctaLabel: 'Talk to Sales',
        ctaUrl: '/contact?segment=enterprise',
        includedProducts: [
            'All Pro features across every product',
            'SSO, SCIM, and audit logs',
            'SOC 2, HIPAA, GDPR compliance',
            'Dedicated account manager and 99.99% SLA',
        ],
    },
];

// ============================================================================
// Feature comparison tables for the pricing page
// ============================================================================

export const pipeDeskComparison: FeatureComparison[] = [
    {
        category: 'Pipeline & Contacts',
        features: [
            { name: 'Contacts', free: 'Up to 1,000', pro: 'Up to 50,000', enterprise: 'Unlimited' },
            { name: 'Sales pipelines', free: '1', pro: 'Unlimited', enterprise: 'Unlimited' },
            { name: 'Custom fields', free: '5', pro: '50', enterprise: 'Unlimited' },
            { name: 'Contact enrichment', free: false, pro: true, enterprise: true },
            { name: 'Custom objects', free: false, pro: false, enterprise: true },
        ],
    },
    {
        category: 'Automation & Intelligence',
        features: [
            { name: 'Email sequences', free: false, pro: true, enterprise: true },
            { name: 'Workflow automations', free: false, pro: '25', enterprise: 'Unlimited' },
            { name: 'AI lead scoring', free: false, pro: true, enterprise: true },
            { name: 'Smart send times', free: false, pro: true, enterprise: true },
        ],
    },
    {
        category: 'Reporting',
        features: [
            { name: 'Pre-built reports', free: '5', pro: '25+', enterprise: '25+' },
            { name: 'Custom report builder', free: false, pro: true, enterprise: true },
            { name: 'Scheduled report emails', free: false, pro: true, enterprise: true },
            { name: 'Revenue forecasting', free: false, pro: true, enterprise: true },
        ],
    },
    {
        category: 'Admin & Security',
        features: [
            { name: 'Role-based permissions', free: 'Basic', pro: 'Advanced', enterprise: 'Advanced' },
            { name: 'SSO (SAML/OIDC)', free: false, pro: false, enterprise: true },
            { name: 'Audit logs', free: false, pro: false, enterprise: true },
            { name: 'API access', free: false, pro: true, enterprise: true },
        ],
    },
];

export const workNestComparison: FeatureComparison[] = [
    {
        category: 'Core HR',
        features: [
            { name: 'Employees', free: 'Up to 10', pro: 'Unlimited', enterprise: 'Unlimited' },
            { name: 'Employee directory & org chart', free: true, pro: true, enterprise: true },
            { name: 'Document storage', free: '1 GB', pro: '10 GB', enterprise: 'Unlimited' },
            { name: 'PTO tracking', free: true, pro: true, enterprise: true },
            { name: 'Custom fields & workflows', free: false, pro: false, enterprise: true },
        ],
    },
    {
        category: 'Payroll & Benefits',
        features: [
            { name: 'Full payroll processing', free: false, pro: true, enterprise: true },
            { name: 'Direct deposit', free: false, pro: true, enterprise: true },
            { name: 'Benefits administration', free: false, pro: true, enterprise: true },
            { name: 'Tax filing (federal & state)', free: false, pro: true, enterprise: true },
            { name: 'Compensation benchmarking', free: false, pro: false, enterprise: true },
        ],
    },
    {
        category: 'Talent',
        features: [
            { name: 'Job postings', free: false, pro: '10 active', enterprise: 'Unlimited' },
            { name: 'Applicant tracking', free: false, pro: true, enterprise: true },
            { name: 'Onboarding workflows', free: false, pro: true, enterprise: true },
            { name: 'Performance reviews', free: false, pro: true, enterprise: true },
            { name: 'Advanced people analytics', free: false, pro: false, enterprise: true },
        ],
    },
];

export const devLaunchComparison: FeatureComparison[] = [
    {
        category: 'Projects & Tracking',
        features: [
            { name: 'Users', free: '1', pro: 'Up to 15', enterprise: 'Unlimited' },
            { name: 'Active projects', free: '3', pro: 'Unlimited', enterprise: 'Unlimited' },
            { name: 'Time tracking', free: true, pro: true, enterprise: true },
            { name: 'Project templates', free: false, pro: true, enterprise: true },
            { name: 'Resource planning', free: false, pro: false, enterprise: true },
        ],
    },
    {
        category: 'Client & Billing',
        features: [
            { name: 'Client portal', free: 'Kaabosh branding', pro: 'White-label', enterprise: 'White-label' },
            { name: 'Invoicing', free: 'Basic', pro: 'Advanced', enterprise: 'Advanced' },
            { name: 'Stripe payments', free: false, pro: true, enterprise: true },
            { name: 'Retainer management', free: false, pro: true, enterprise: true },
            { name: 'Profitability tracking', free: false, pro: true, enterprise: true },
        ],
    },
    {
        category: 'Collaboration',
        features: [
            { name: 'Approval workflows', free: false, pro: true, enterprise: true },
            { name: 'Integrations (Figma, GitHub)', free: false, pro: true, enterprise: true },
            { name: 'Custom fields', free: false, pro: false, enterprise: true },
            { name: 'SSO', free: false, pro: false, enterprise: true },
        ],
    },
];

export const cloudVaultComparison: FeatureComparison[] = [
    {
        category: 'Storage & Files',
        features: [
            { name: 'Storage', free: '15 GB', pro: '1 TB/user', enterprise: 'Custom (5 TB+)' },
            { name: 'Max file size', free: '2 GB', pro: '50 GB', enterprise: '50 GB' },
            { name: 'Version history', free: '30 days', pro: '180 days', enterprise: 'Unlimited' },
            { name: 'Full-text search & OCR', free: false, pro: true, enterprise: true },
            { name: 'Smart folders & tags', free: false, pro: true, enterprise: true },
        ],
    },
    {
        category: 'Security & Compliance',
        features: [
            { name: 'End-to-end encryption', free: true, pro: true, enterprise: true },
            { name: 'Zero-knowledge encryption', free: false, pro: true, enterprise: true },
            { name: 'Compliance suite (HIPAA, SOC 2)', free: false, pro: false, enterprise: true },
            { name: 'Data residency controls', free: false, pro: false, enterprise: true },
            { name: 'Legal hold & retention', free: false, pro: false, enterprise: true },
        ],
    },
    {
        category: 'Collaboration',
        features: [
            { name: 'Secure link sharing', free: true, pro: true, enterprise: true },
            { name: 'Team spaces', free: false, pro: true, enterprise: true },
            { name: 'Watermarking', free: false, pro: true, enterprise: true },
            { name: 'Audit logs', free: false, pro: false, enterprise: true },
            { name: 'SSO & SCIM', free: false, pro: false, enterprise: true },
        ],
    },
];

export const allComparisons: Record<string, FeatureComparison[]> = {
    pipedesk: pipeDeskComparison,
    worknest: workNestComparison,
    devlaunch: devLaunchComparison,
    cloudvault: cloudVaultComparison,
};

export function getComparisonByProduct(slug: string): FeatureComparison[] {
    return allComparisons[slug] ?? [];
}
