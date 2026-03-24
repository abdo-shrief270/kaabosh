import type { Product, ProductPricing } from './types';

// ============================================================================
// PipeDesk - CRM Platform
// ============================================================================

export const pipeDesk: Product = {
    slug: 'pipedesk',
    name: 'PipeDesk',
    tagline: 'Close deals faster with a CRM that works the way you sell.',
    description:
        'PipeDesk is a modern CRM built for sales teams that move fast. Track every deal from first touch to closed-won, automate repetitive follow-ups, and get real-time pipeline visibility that actually helps you forecast. No bloated features, no six-month onboarding\u2014just the tools your reps need to hit quota.',
    accentColor: '#3B82F6',
    status: 'live',
    audienceTags: ['Sales Teams', 'Startups', 'SMBs', 'Account Executives'],
    modules: [
        {
            icon: 'LayoutDashboard',
            name: 'Pipeline Management',
            description:
                'Visual drag-and-drop pipelines with customizable stages, weighted forecasting, and deal rot alerts that keep your pipeline healthy.',
        },
        {
            icon: 'Users',
            name: 'Contact Intelligence',
            description:
                'Unified contact profiles enriched with social data, interaction history, and engagement scoring to prioritize your hottest leads.',
        },
        {
            icon: 'Mail',
            name: 'Email Sequences',
            description:
                'Multi-step outreach sequences with A/B testing, smart send times, and automatic replies detection to keep conversations flowing.',
        },
        {
            icon: 'BarChart3',
            name: 'Revenue Analytics',
            description:
                'Real-time dashboards tracking conversion rates, average deal size, sales velocity, and rep performance across every pipeline stage.',
        },
        {
            icon: 'Workflow',
            name: 'Workflow Automation',
            description:
                'Trigger-based automations for lead assignment, task creation, Slack notifications, and deal stage progression without writing code.',
        },
        {
            icon: 'Plug',
            name: 'Integrations Hub',
            description:
                'Native connections to Slack, Gmail, Outlook, Calendly, Stripe, and 40+ other tools your team already uses every day.',
        },
    ],
    features: [
        {
            icon: 'Zap',
            name: 'Smart Lead Scoring',
            description:
                'Machine-learning lead scoring that analyzes engagement patterns, firmographic data, and behavioral signals to surface your most promising opportunities automatically.',
            image: '/images/features/pipedesk-lead-scoring.webp',
        },
        {
            icon: 'MessageSquare',
            name: 'Conversation Tracking',
            description:
                'Every email, call, and meeting automatically logged and linked to the right deal. Full conversation threads give reps complete context before every interaction.',
            image: '/images/features/pipedesk-conversations.webp',
        },
        {
            icon: 'Target',
            name: 'Quota Tracking & Forecasting',
            description:
                'Set individual and team quotas, track progress in real time, and get AI-assisted forecasts that account for deal velocity, historical close rates, and pipeline coverage.',
        },
        {
            icon: 'Smartphone',
            name: 'Mobile CRM',
            description:
                'A full-featured mobile app for iOS and Android that lets reps update deals, log calls, and check pipeline health from anywhere\u2014even offline.',
        },
        {
            icon: 'Lock',
            name: 'Role-Based Permissions',
            description:
                'Granular access controls that let managers see everything while reps only see their own deals. Territory management and team hierarchies built in.',
            image: '/images/features/pipedesk-permissions.webp',
        },
    ],
    faq: [
        {
            question: 'How long does it take to set up PipeDesk?',
            answer: 'Most teams are up and running in under 30 minutes. Import your contacts via CSV or connect your existing CRM, configure your pipeline stages, and start selling. We also offer free migration assistance from Salesforce, HubSpot, and Pipedrive.',
        },
        {
            question: 'Can I import data from my current CRM?',
            answer: 'Yes. We support one-click migrations from Salesforce, HubSpot, Pipedrive, Zoho, and Close. For other CRMs, you can import via CSV or use our API. All your contacts, deals, notes, and activity history come along.',
        },
        {
            question: 'Does PipeDesk integrate with my email provider?',
            answer: 'PipeDesk has native two-way sync with Gmail and Outlook. Emails are automatically logged against the right contacts and deals, and you can send tracked emails directly from PipeDesk.',
        },
        {
            question: 'Is there a limit on the number of contacts?',
            answer: 'Free plans include up to 1,000 contacts. Pro plans support up to 50,000 contacts, and Enterprise plans have no contact limits. All plans include unlimited deal tracking.',
        },
        {
            question: 'How does the AI lead scoring work?',
            answer: 'Our scoring model analyzes over 30 signals including email engagement, website visits, company size, deal stage velocity, and historical conversion patterns. Scores update in real time and improve as your team closes more deals.',
        },
        {
            question: 'Can I customize my pipeline stages?',
            answer: 'Absolutely. Create unlimited custom pipelines with as many stages as you need. Set win probability percentages per stage, add required fields for stage transitions, and configure automation triggers for each stage change.',
        },
        {
            question: 'What kind of reporting is available?',
            answer: 'PipeDesk includes 25+ pre-built reports covering pipeline health, rep activity, conversion funnels, revenue forecasting, and win/loss analysis. Pro and Enterprise plans include a custom report builder with drag-and-drop chart creation.',
        },
        {
            question: 'Do you offer phone support?',
            answer: 'Enterprise plans include dedicated phone support and a named account manager. Pro plans get priority email and chat support with a 4-hour SLA. Free plans have access to our help center and community forum.',
        },
    ],
    demoVideoUrl: 'https://www.youtube.com/watch?v=demo-pipedesk',
    screenshots: [
        '/images/screenshots/pipedesk-pipeline.webp',
        '/images/screenshots/pipedesk-dashboard.webp',
        '/images/screenshots/pipedesk-contacts.webp',
        '/images/screenshots/pipedesk-analytics.webp',
    ],
};

export const pipeDeskPricing: ProductPricing = {
    productSlug: 'pipedesk',
    productName: 'PipeDesk',
    tiers: [
        {
            name: 'Free',
            price: { monthly: 0, annual: 0 },
            description: 'For individuals and small teams getting started with CRM.',
            features: [
                'Up to 1,000 contacts',
                '1 sales pipeline',
                'Email integration (Gmail/Outlook)',
                'Basic reporting (5 reports)',
                'Mobile app access',
                'Community support',
            ],
            highlighted: false,
            ctaLabel: 'Start Free',
            ctaUrl: '/signup?product=pipedesk&plan=free',
        },
        {
            name: 'Pro',
            price: { monthly: 29, annual: 24 },
            description: 'For growing sales teams that need automation and insights.',
            features: [
                'Up to 50,000 contacts',
                'Unlimited pipelines',
                'Email sequences & templates',
                'AI lead scoring',
                'Custom report builder',
                'Workflow automation (25 workflows)',
                'API access',
                'Priority support (4h SLA)',
            ],
            highlighted: true,
            ctaLabel: 'Start 14-Day Trial',
            ctaUrl: '/signup?product=pipedesk&plan=pro',
        },
        {
            name: 'Enterprise',
            price: { monthly: 79, annual: 65 },
            description: 'For organizations that need advanced security, compliance, and scale.',
            features: [
                'Unlimited contacts',
                'Unlimited pipelines',
                'Advanced automation (unlimited)',
                'Custom objects & fields',
                'Territory management',
                'SSO & SCIM provisioning',
                'Audit logs & compliance tools',
                'Dedicated account manager',
                'Phone support',
                '99.99% uptime SLA',
            ],
            highlighted: false,
            ctaLabel: 'Contact Sales',
            ctaUrl: '/contact?product=pipedesk&plan=enterprise',
        },
    ],
};

// ============================================================================
// WorkNest - HR & Payroll Platform
// ============================================================================

export const workNest: Product = {
    slug: 'worknest',
    name: 'WorkNest',
    tagline: 'HR, payroll, and people ops\u2014all in one place.',
    description:
        'WorkNest brings together hiring, onboarding, payroll, benefits, time tracking, and performance management into a single platform that HR teams and employees actually enjoy using. Automate the busywork so you can focus on building a great workplace.',
    accentColor: '#8B5CF6',
    status: 'live',
    audienceTags: ['HR Teams', 'People Ops', 'Finance', 'Small Business'],
    modules: [
        {
            icon: 'UserPlus',
            name: 'Hiring & Onboarding',
            description:
                'Post jobs to 20+ boards, track applicants through customizable stages, and onboard new hires with automated document collection, e-signatures, and welcome workflows.',
        },
        {
            icon: 'Banknote',
            name: 'Payroll',
            description:
                'Automated payroll for salaried and hourly employees with tax calculations, direct deposit, garnishments, and year-end tax form generation for all 50 U.S. states.',
        },
        {
            icon: 'Heart',
            name: 'Benefits Administration',
            description:
                'Manage health insurance, 401(k), HSA, and other benefits. Employees self-enroll during open enrollment with guided plan comparisons and cost calculators.',
        },
        {
            icon: 'Clock',
            name: 'Time & Attendance',
            description:
                'Clock-in via web, mobile, or kiosk. Automatic overtime calculations, PTO tracking, shift scheduling, and manager approvals with configurable policies.',
        },
        {
            icon: 'TrendingUp',
            name: 'Performance Management',
            description:
                'Goal setting, 1-on-1 meeting templates, continuous feedback, and structured review cycles that replace clunky spreadsheets with real-time performance insights.',
        },
        {
            icon: 'FileText',
            name: 'Compliance & Documents',
            description:
                'Auto-generated I-9s, W-4s, and offer letters. Built-in compliance checklists for federal and state regulations, with alerts for upcoming deadlines.',
        },
    ],
    features: [
        {
            icon: 'CalendarCheck',
            name: 'Automated Payroll Runs',
            description:
                'Set it and forget it. Configure your payroll schedule once and WorkNest handles calculations, deductions, tax filings, and direct deposits automatically. Review and approve in one click.',
            image: '/images/features/worknest-payroll.webp',
        },
        {
            icon: 'Sparkles',
            name: 'Employee Self-Service Portal',
            description:
                'Employees manage their own profiles, view pay stubs, request PTO, update tax withholdings, and enroll in benefits\u2014without filing a single HR ticket.',
            image: '/images/features/worknest-self-service.webp',
        },
        {
            icon: 'GitBranch',
            name: 'Org Chart & Directory',
            description:
                'A live organizational chart that updates as people join, move, or leave. Search the company directory by name, department, location, or skill.',
        },
        {
            icon: 'Shield',
            name: 'Compliance Autopilot',
            description:
                'Stay ahead of labor law changes with automatic policy updates, required training tracking, and audit-ready reporting for FLSA, ACA, COBRA, and more.',
            image: '/images/features/worknest-compliance.webp',
        },
        {
            icon: 'Globe',
            name: 'Multi-State & Remote Support',
            description:
                'Hire and pay employees in all 50 states with automatic tax jurisdiction handling, state-specific compliance rules, and remote work policy management.',
        },
        {
            icon: 'BarChart3',
            name: 'People Analytics',
            description:
                'Headcount trends, turnover analysis, compensation benchmarking, DEI metrics, and custom dashboards that give leadership visibility into workforce health.',
        },
    ],
    faq: [
        {
            question: 'Which states does WorkNest support for payroll?',
            answer: 'WorkNest supports payroll processing, tax filing, and compliance for all 50 U.S. states plus Washington D.C. We handle state income tax, unemployment insurance, and local taxes automatically.',
        },
        {
            question: 'Can WorkNest handle both salaried and hourly employees?',
            answer: 'Yes. WorkNest supports salaried, hourly, and contract workers. Hourly employees can clock in/out via web or mobile, and overtime is calculated automatically based on your configured rules (federal, state, or custom).',
        },
        {
            question: 'How does the benefits enrollment process work?',
            answer: 'During open enrollment, employees see a guided experience comparing available plans with estimated costs. They can enroll, make changes, or waive coverage. Life events trigger special enrollment windows automatically.',
        },
        {
            question: 'Is WorkNest SOC 2 compliant?',
            answer: 'Yes. WorkNest is SOC 2 Type II certified and undergoes annual audits. We use AES-256 encryption at rest and TLS 1.3 in transit. All payroll and PII data is stored in U.S.-based data centers.',
        },
        {
            question: 'Can I migrate from ADP, Gusto, or Rippling?',
            answer: 'We offer white-glove migration from ADP, Gusto, Rippling, Paychex, and BambooHR. Our team handles employee data, payroll history, tax documents, and benefits enrollment transfers at no extra cost.',
        },
        {
            question: 'How does performance management work?',
            answer: 'Set company, team, and individual goals with measurable key results. Managers and reports have regular 1-on-1s tracked in the platform. Structured review cycles can be quarterly, semi-annual, or annual with customizable review forms.',
        },
        {
            question: 'Do employees need a separate login?',
            answer: 'Employees get their own self-service portal accessible via web or mobile app. They can use SSO (Google, Okta, Azure AD) or email/password. No separate software installation is required.',
        },
        {
            question: 'What reporting does WorkNest offer?',
            answer: 'Over 40 pre-built reports covering payroll summaries, tax liabilities, headcount, turnover, PTO balances, benefits utilization, and more. Enterprise plans include a custom report builder and scheduled report delivery.',
        },
    ],
    demoVideoUrl: 'https://www.youtube.com/watch?v=demo-worknest',
    screenshots: [
        '/images/screenshots/worknest-dashboard.webp',
        '/images/screenshots/worknest-payroll.webp',
        '/images/screenshots/worknest-onboarding.webp',
        '/images/screenshots/worknest-performance.webp',
    ],
};

export const workNestPricing: ProductPricing = {
    productSlug: 'worknest',
    productName: 'WorkNest',
    tiers: [
        {
            name: 'Free',
            price: { monthly: 0, annual: 0 },
            description: 'For small teams up to 10 employees with basic HR needs.',
            features: [
                'Up to 10 employees',
                'Employee directory & org chart',
                'PTO tracking',
                'Document storage (1 GB)',
                'Basic reporting',
                'Email support',
            ],
            highlighted: false,
            ctaLabel: 'Start Free',
            ctaUrl: '/signup?product=worknest&plan=free',
        },
        {
            name: 'Pro',
            price: { monthly: 12, annual: 10 },
            description: 'Per employee/month. Full HR suite with payroll and benefits.',
            features: [
                'Unlimited employees',
                'Full payroll processing',
                'Benefits administration',
                'Time & attendance tracking',
                'Hiring & onboarding workflows',
                'Performance reviews',
                'Compliance alerts',
                '40+ pre-built reports',
                'API access',
                'Priority support (4h SLA)',
            ],
            highlighted: true,
            ctaLabel: 'Start 14-Day Trial',
            ctaUrl: '/signup?product=worknest&plan=pro',
        },
        {
            name: 'Enterprise',
            price: { monthly: 22, annual: 18 },
            description: 'Per employee/month. Advanced compliance, analytics, and support.',
            features: [
                'Everything in Pro',
                'Custom workflows & approvals',
                'Advanced people analytics',
                'Compensation benchmarking',
                'SSO & SCIM provisioning',
                'Audit logs',
                'Dedicated account manager',
                'Phone support',
                'Custom integrations',
                '99.99% uptime SLA',
            ],
            highlighted: false,
            ctaLabel: 'Contact Sales',
            ctaUrl: '/contact?product=worknest&plan=enterprise',
        },
    ],
};

// ============================================================================
// DevLaunch - Agency OS
// ============================================================================

export const devLaunch: Product = {
    slug: 'devlaunch',
    name: 'DevLaunch',
    tagline: 'Ship client projects on time, every time.',
    description:
        'DevLaunch is the operating system for digital agencies and freelance studios. Manage projects, track billable hours, collaborate with clients, and invoice\u2014all from a single workspace designed for the way agencies actually work.',
    accentColor: '#F59E0B',
    status: 'beta',
    audienceTags: ['Agencies', 'Freelancers', 'Developers', 'Designers'],
    modules: [
        {
            icon: 'FolderKanban',
            name: 'Project Management',
            description:
                'Kanban boards, Gantt timelines, and sprint views for every project. Track milestones, dependencies, and deliverables with real-time progress indicators.',
        },
        {
            icon: 'Timer',
            name: 'Time Tracking',
            description:
                'One-click timers, manual entries, and automatic tracking via browser extension. Billable vs. non-billable categorization with per-project budgets and alerts.',
        },
        {
            icon: 'Receipt',
            name: 'Invoicing & Billing',
            description:
                'Generate invoices from tracked time, fixed-fee milestones, or custom line items. Accept payments via Stripe, send reminders, and track outstanding balances.',
        },
        {
            icon: 'MessageCircle',
            name: 'Client Portal',
            description:
                'A branded portal where clients review deliverables, leave feedback, approve milestones, and access project documents without needing a full account.',
        },
        {
            icon: 'FileCode',
            name: 'Resource Planning',
            description:
                'See team availability, allocate people to projects, and spot bottlenecks before they become missed deadlines. Capacity planning with utilization targets.',
        },
    ],
    features: [
        {
            icon: 'Palette',
            name: 'White-Label Client Portal',
            description:
                'Customize the client portal with your agency\u2019s logo, colors, and domain. Clients see your brand at every touchpoint\u2014from project updates to invoices.',
            image: '/images/features/devlaunch-portal.webp',
        },
        {
            icon: 'Calculator',
            name: 'Profitability Tracking',
            description:
                'Know which projects and clients are profitable in real time. Compare budgeted vs. actual hours, track margins by project type, and identify scope creep early.',
            image: '/images/features/devlaunch-profitability.webp',
        },
        {
            icon: 'Repeat',
            name: 'Retainer Management',
            description:
                'Track monthly retainer hours, roll over unused time, and auto-generate invoices. Clients get a live dashboard showing hours used vs. remaining.',
        },
        {
            icon: 'GitPullRequest',
            name: 'Approval Workflows',
            description:
                'Route designs, copy, and deliverables through multi-step approval chains. Clients annotate directly on images, PDFs, and websites with contextual feedback.',
            image: '/images/features/devlaunch-approvals.webp',
        },
        {
            icon: 'Layers',
            name: 'Project Templates',
            description:
                'Clone entire project structures\u2014tasks, milestones, timelines, and team assignments\u2014from templates. Launch new client engagements in minutes instead of hours.',
        },
    ],
    faq: [
        {
            question: 'Is DevLaunch ready for production use?',
            answer: 'DevLaunch is currently in public beta. Core features (project management, time tracking, invoicing, client portal) are stable and used by 200+ agencies. We are still refining resource planning and some advanced reporting features.',
        },
        {
            question: 'Will my data be preserved after the beta ends?',
            answer: 'Absolutely. All data created during the beta will carry over to the general release. Beta users also receive a 50% discount on their first year when DevLaunch officially launches.',
        },
        {
            question: 'Can clients access the portal without creating an account?',
            answer: 'Yes. Clients receive a magic link via email that gives them instant access to their project portal. No password or account creation required. You control what they can see and do.',
        },
        {
            question: 'How does invoicing work?',
            answer: 'Create invoices from tracked time (hourly), project milestones (fixed-fee), or custom line items. Connect Stripe to accept credit card and ACH payments directly. Automatic payment reminders reduce overdue invoices.',
        },
        {
            question: 'Does DevLaunch integrate with design and development tools?',
            answer: 'Yes. We integrate with Figma, GitHub, GitLab, Slack, Notion, Google Drive, and Dropbox. Our browser extension adds time tracking to any web app your team uses.',
        },
        {
            question: 'Can I track profitability per project and per client?',
            answer: 'Yes. Set hourly cost rates for each team member and billing rates for each client. DevLaunch calculates gross margin in real time for every project, client, and service type.',
        },
    ],
    demoVideoUrl: 'https://www.youtube.com/watch?v=demo-devlaunch',
    screenshots: [
        '/images/screenshots/devlaunch-projects.webp',
        '/images/screenshots/devlaunch-timesheet.webp',
        '/images/screenshots/devlaunch-invoicing.webp',
    ],
};

export const devLaunchPricing: ProductPricing = {
    productSlug: 'devlaunch',
    productName: 'DevLaunch',
    tiers: [
        {
            name: 'Free',
            price: { monthly: 0, annual: 0 },
            description: 'For freelancers and solo consultants.',
            features: [
                '1 user',
                '3 active projects',
                'Time tracking',
                'Basic invoicing',
                'Client portal (Kaabosh branding)',
                'Email support',
            ],
            highlighted: false,
            ctaLabel: 'Start Free',
            ctaUrl: '/signup?product=devlaunch&plan=free',
        },
        {
            name: 'Pro',
            price: { monthly: 39, annual: 32 },
            description: 'Per workspace/month. For agencies and small studios.',
            features: [
                'Up to 15 users',
                'Unlimited projects',
                'White-label client portal',
                'Profitability tracking',
                'Retainer management',
                'Approval workflows',
                'Project templates',
                'Integrations (Figma, GitHub, Slack)',
                'Priority support',
            ],
            highlighted: true,
            ctaLabel: 'Join the Beta',
            ctaUrl: '/signup?product=devlaunch&plan=pro',
        },
        {
            name: 'Enterprise',
            price: { monthly: 89, annual: 74 },
            description: 'Per workspace/month. For large agencies with advanced needs.',
            features: [
                'Unlimited users',
                'Unlimited projects',
                'Resource planning & capacity',
                'Advanced analytics & dashboards',
                'Custom fields & workflows',
                'SSO & role-based access',
                'Dedicated onboarding',
                'Phone support',
                'Custom integrations',
            ],
            highlighted: false,
            ctaLabel: 'Contact Sales',
            ctaUrl: '/contact?product=devlaunch&plan=enterprise',
        },
    ],
};

// ============================================================================
// CloudVault - Cloud Storage
// ============================================================================

export const cloudVault: Product = {
    slug: 'cloudvault',
    name: 'CloudVault',
    tagline: 'Secure cloud storage built for teams that take data seriously.',
    description:
        'CloudVault delivers enterprise-grade file storage, sharing, and collaboration with end-to-end encryption, granular access controls, and compliance certifications your security team will love. Fast sync, smart organization, and zero-knowledge encryption by default.',
    accentColor: '#10B981',
    status: 'coming-soon',
    audienceTags: ['Enterprise', 'Legal', 'Healthcare', 'Finance', 'Remote Teams'],
    modules: [
        {
            icon: 'HardDrive',
            name: 'Encrypted Storage',
            description:
                'AES-256 encryption at rest with optional zero-knowledge mode. Your files are encrypted before they leave your device\u2014we never see your data.',
        },
        {
            icon: 'Share2',
            name: 'Secure Sharing',
            description:
                'Share files and folders with expiring links, password protection, download limits, and watermarking. Revoke access instantly from anywhere.',
        },
        {
            icon: 'RefreshCw',
            name: 'Smart Sync',
            description:
                'Selective sync keeps your local drive lean while giving you instant access to everything in the cloud. Files stream on demand\u2014no waiting for downloads.',
        },
        {
            icon: 'Search',
            name: 'Full-Text Search',
            description:
                'Search inside PDFs, Office documents, images (via OCR), and even audio transcriptions. Find any file in seconds across terabytes of data.',
        },
        {
            icon: 'History',
            name: 'Version History',
            description:
                'Every edit creates a new version. Browse, compare, and restore any previous version up to 365 days back. Unlimited version history on Enterprise plans.',
        },
        {
            icon: 'ShieldCheck',
            name: 'Compliance Suite',
            description:
                'Built-in tools for HIPAA, SOC 2, GDPR, and CCPA compliance. Data residency controls, retention policies, legal hold, and complete audit trails.',
        },
    ],
    features: [
        {
            icon: 'Lock',
            name: 'Zero-Knowledge Encryption',
            description:
                'In zero-knowledge mode, your encryption keys never leave your device. Even Kaabosh engineers cannot access your files. Perfect for regulated industries and sensitive data.',
            image: '/images/features/cloudvault-encryption.webp',
        },
        {
            icon: 'FolderTree',
            name: 'Smart Folders & Tags',
            description:
                'Organize files with nested folders, color-coded tags, and smart folders that automatically collect files based on rules you define (file type, date, author, tag).',
        },
        {
            icon: 'Users',
            name: 'Team Spaces',
            description:
                'Create dedicated spaces for departments, projects, or clients. Each space has its own storage quota, permissions, and sharing policies.',
            image: '/images/features/cloudvault-teams.webp',
        },
        {
            icon: 'Activity',
            name: 'Activity Feed & Audit Log',
            description:
                'See who viewed, edited, shared, or downloaded any file. Complete audit trails for compliance reporting and security investigations.',
        },
    ],
    faq: [
        {
            question: 'When will CloudVault be available?',
            answer: 'CloudVault is currently in private development with a planned public beta in Q3 2026. Join the waitlist to get early access and a founding member discount.',
        },
        {
            question: 'How does zero-knowledge encryption work?',
            answer: 'In zero-knowledge mode, files are encrypted on your device before upload using a key derived from your passphrase. The encrypted data is stored on our servers, but we never have access to the decryption key. This means only you can read your files.',
        },
        {
            question: 'What compliance certifications will CloudVault have?',
            answer: 'At launch, CloudVault will be SOC 2 Type II certified, HIPAA compliant (with BAA available), and GDPR/CCPA compliant. We are also pursuing FedRAMP authorization for government customers.',
        },
        {
            question: 'How much storage is included?',
            answer: 'Free plans will include 15 GB, Pro plans 1 TB per user, and Enterprise plans offer custom storage pools starting at 5 TB. Additional storage can be purchased in 1 TB increments.',
        },
        {
            question: 'Will there be desktop and mobile apps?',
            answer: 'Yes. CloudVault will launch with native apps for Windows, macOS, Linux, iOS, and Android. All apps support offline access with automatic sync when you reconnect.',
        },
        {
            question: 'Can I migrate from Dropbox, Google Drive, or OneDrive?',
            answer: 'We are building one-click migration tools for Dropbox, Google Drive, OneDrive, and Box. Folder structures, sharing permissions, and version history will be preserved during migration.',
        },
        {
            question: 'Is there a file size limit?',
            answer: 'Free plans support files up to 2 GB. Pro and Enterprise plans support files up to 50 GB, with chunked uploads and resume capability for large files on slow connections.',
        },
        {
            question: 'How can I get early access?',
            answer: 'Join the waitlist on our website. We are granting early access in waves, starting with enterprise customers and teams in regulated industries. Waitlist members get 30% off their first year.',
        },
    ],
    screenshots: [
        '/images/screenshots/cloudvault-files.webp',
        '/images/screenshots/cloudvault-sharing.webp',
        '/images/screenshots/cloudvault-search.webp',
    ],
};

export const cloudVaultPricing: ProductPricing = {
    productSlug: 'cloudvault',
    productName: 'CloudVault',
    tiers: [
        {
            name: 'Free',
            price: { monthly: 0, annual: 0 },
            description: 'For personal use and trying out CloudVault.',
            features: [
                '15 GB storage',
                'File size limit: 2 GB',
                'End-to-end encryption',
                'Sharing with link expiry',
                '30-day version history',
                'Web & mobile apps',
            ],
            highlighted: false,
            ctaLabel: 'Join Waitlist',
            ctaUrl: '/waitlist?product=cloudvault',
        },
        {
            name: 'Pro',
            price: { monthly: 15, annual: 12 },
            description: 'Per user/month. For teams that need serious storage and security.',
            features: [
                '1 TB per user',
                'File size limit: 50 GB',
                'Zero-knowledge encryption',
                'Team spaces',
                'Full-text search & OCR',
                'Smart folders & tags',
                '180-day version history',
                'Priority support',
            ],
            highlighted: true,
            ctaLabel: 'Join Waitlist',
            ctaUrl: '/waitlist?product=cloudvault&plan=pro',
        },
        {
            name: 'Enterprise',
            price: { monthly: 25, annual: 20 },
            description: 'Per user/month. For organizations with compliance requirements.',
            features: [
                'Custom storage pools (5 TB+)',
                'File size limit: 50 GB',
                'Zero-knowledge encryption',
                'Compliance suite (HIPAA, SOC 2)',
                'Data residency controls',
                'Unlimited version history',
                'Legal hold & retention policies',
                'SSO & advanced admin',
                'Dedicated support & SLA',
            ],
            highlighted: false,
            ctaLabel: 'Contact Sales',
            ctaUrl: '/contact?product=cloudvault&plan=enterprise',
        },
    ],
};

// ============================================================================
// Exports
// ============================================================================

export const allProducts: Product[] = [pipeDesk, workNest, devLaunch, cloudVault];

export const allProductPricing: ProductPricing[] = [
    pipeDeskPricing,
    workNestPricing,
    devLaunchPricing,
    cloudVaultPricing,
];

export function getProductBySlug(slug: string): Product | undefined {
    return allProducts.find((p) => p.slug === slug);
}

export function getProductPricingBySlug(slug: string): ProductPricing | undefined {
    return allProductPricing.find((p) => p.productSlug === slug);
}
