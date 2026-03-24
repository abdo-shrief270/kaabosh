// ============================================================================
// Core Data Types for Kaabosh Marketing Website
// ============================================================================

export type ProductStatus = 'live' | 'beta' | 'coming-soon';

export interface ProductModule {
    icon: string;
    name: string;
    description: string;
}

export interface ProductFeature {
    icon: string;
    name: string;
    description: string;
    image?: string;
}

export interface FaqItem {
    question: string;
    answer: string;
}

export interface Product {
    slug: string;
    name: string;
    tagline: string;
    description: string;
    accentColor: string;
    status: ProductStatus;
    audienceTags: string[];
    modules: ProductModule[];
    features: ProductFeature[];
    faq: FaqItem[];
    demoVideoUrl?: string;
    screenshots: string[];
}

export interface PricingTier {
    name: string;
    price: {
        monthly: number;
        annual: number;
    };
    description: string;
    features: string[];
    highlighted: boolean;
    ctaLabel: string;
    ctaUrl: string;
}

export interface ProductPricing {
    productSlug: string;
    productName: string;
    tiers: PricingTier[];
}

export interface FeatureComparison {
    category: string;
    features: {
        name: string;
        free: boolean | string;
        pro: boolean | string;
        enterprise: boolean | string;
    }[];
}

export interface Testimonial {
    quote: string;
    name: string;
    title: string;
    company: string;
    photo: string;
    product: string;
}

export interface TeamMember {
    name: string;
    title: string;
    bio: string;
    photo: string;
    linkedinUrl: string;
}

export interface NavItem {
    label: string;
    href: string;
    children?: NavItem[];
}

export interface FooterColumn {
    heading: string;
    links: NavItem[];
}

export interface Stat {
    value: string;
    label: string;
}

export interface AudienceTab {
    id: string;
    label: string;
    headline: string;
    body: string;
    benefits: string[];
    ctaLabel: string;
    ctaUrl: string;
}

export interface Differentiator {
    icon: string;
    title: string;
    description: string;
}

export interface HeroContent {
    headline: string;
    subheadline: string;
    primaryCta: { label: string; href: string };
    secondaryCta: { label: string; href: string };
    trustSignal: string;
}

export interface ChangelogEntry {
    date: string;
    version: string;
    title: string;
    description: string;
    tags: string[];
}

export interface BlogPost {
    slug: string;
    title: string;
    excerpt: string;
    author: string;
    date: string;
    category: string;
    coverImage: string;
    readTimeMinutes: number;
}

export interface LegalSection {
    title: string;
    content: string;
}

export interface LegalDocument {
    title: string;
    lastUpdated: string;
    sections: LegalSection[];
}
