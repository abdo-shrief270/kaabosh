<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductModule;
use App\Models\ProductFaq;
use App\Models\ProductFeature;
use App\Models\ProductPricingPlan;
use App\Models\ProductPricingFeature;
use App\Models\ProductScreenshot;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedCrm();
        $this->seedAnalytics();
        $this->seedHelpdesk();
        $this->seedForms();
    }

    private function seedCrm(): void
    {
        $product = Product::create([
            'name' => 'CRM',
            'slug' => 'crm',
            'tagline' => 'Close more deals with intelligent relationship management',
            'description' => 'Kaabosh CRM helps sales teams build stronger relationships, automate repetitive tasks, and close deals faster. Track every interaction, manage your pipeline, and gain actionable insights into your sales performance.',
            'accent_color' => '#3b82f6',
            'logo' => '/images/products/crm-logo.svg',
            'status' => 'live',
            'audiences' => ['Sales Teams', 'Account Managers', 'Business Development', 'Revenue Operations'],
            'external_app_url' => 'https://app.kaabosh.com/crm',
            'external_docs_url' => 'https://docs.kaabosh.com/crm',
            'seo' => [
                'title' => 'Kaabosh CRM - Intelligent Sales & Relationship Management',
                'description' => 'Close more deals with Kaabosh CRM. Manage contacts, automate pipelines, track emails, and gain sales insights all in one platform.',
                'keywords' => ['crm', 'sales management', 'pipeline management', 'contact management'],
            ],
            'sort_order' => 1,
        ]);

        // Modules
        $modules = [
            ['icon' => 'users', 'name' => 'Contacts', 'description' => 'Centralize all your contacts, companies, and communication history in one searchable database. Automatically enrich profiles with social and firmographic data.', 'sort_order' => 1],
            ['icon' => 'git-branch', 'name' => 'Pipelines', 'description' => 'Visualize your sales process with customizable drag-and-drop pipelines. Track deal stages, probabilities, and expected close dates at a glance.', 'sort_order' => 2],
            ['icon' => 'zap', 'name' => 'Automation', 'description' => 'Automate follow-ups, task assignments, and deal progression with powerful workflow rules. Eliminate manual data entry and focus on selling.', 'sort_order' => 3],
            ['icon' => 'mail', 'name' => 'Email Tracking', 'description' => 'Send, track, and analyze emails directly from the CRM. Know when prospects open your emails, click links, and download attachments.', 'sort_order' => 4],
            ['icon' => 'bar-chart-2', 'name' => 'Reporting', 'description' => 'Generate real-time sales reports and forecasts. Track team performance, conversion rates, and revenue metrics with interactive dashboards.', 'sort_order' => 5],
            ['icon' => 'link', 'name' => 'Integrations', 'description' => 'Connect with your existing tools including email, calendar, Slack, and hundreds of other apps through native integrations and our open API.', 'sort_order' => 6],
        ];
        foreach ($modules as $m) {
            ProductModule::create(array_merge($m, ['product_id' => $product->id]));
        }

        // Features
        $features = [
            ['icon' => 'target', 'name' => 'Smart Lead Scoring', 'description' => 'Automatically score and prioritize leads based on engagement, fit, and behavioral signals so your team focuses on the hottest opportunities.', 'sort_order' => 1],
            ['icon' => 'clock', 'name' => 'Activity Timeline', 'description' => 'See a complete chronological view of every interaction with a contact, including emails, calls, meetings, and notes in one unified timeline.', 'sort_order' => 2],
            ['icon' => 'repeat', 'name' => 'Workflow Automation', 'description' => 'Build multi-step automation sequences that trigger based on deal changes, time delays, or contact actions to keep your pipeline moving.', 'sort_order' => 3],
            ['icon' => 'trending-up', 'name' => 'Revenue Forecasting', 'description' => 'Predict future revenue with AI-powered forecasting that analyzes historical data, pipeline health, and team performance trends.', 'sort_order' => 4],
        ];
        foreach ($features as $f) {
            ProductFeature::create(array_merge($f, ['product_id' => $product->id]));
        }

        // FAQs
        $faqs = [
            ['question' => 'How many contacts can I store?', 'answer' => 'The Free plan includes up to 1,000 contacts. Pro plans support up to 50,000 contacts, and Enterprise plans have no contact limit.', 'sort_order' => 1],
            ['question' => 'Can I import contacts from another CRM?', 'answer' => 'Yes, we support CSV imports and direct migrations from Salesforce, HubSpot, Pipedrive, and Zoho CRM. Our migration team can assist with complex data transfers.', 'sort_order' => 2],
            ['question' => 'Does the CRM integrate with my email?', 'answer' => 'Kaabosh CRM integrates natively with Gmail, Outlook, and any IMAP-compatible email provider. Two-way sync keeps your inbox and CRM in perfect harmony.', 'sort_order' => 3],
            ['question' => 'Is there a mobile app?', 'answer' => 'Yes, Kaabosh CRM is available on iOS and Android with full access to contacts, deals, and activity tracking while you are on the go.', 'sort_order' => 4],
            ['question' => 'What kind of reporting is available?', 'answer' => 'Built-in reports include pipeline analytics, sales forecasting, team leaderboards, conversion funnels, and activity metrics. Pro and Enterprise plans include custom report builders.', 'sort_order' => 5],
            ['question' => 'How does the free trial work?', 'answer' => 'You get 14 days of full Pro plan access with no credit card required. At the end of the trial, you can downgrade to Free or choose a paid plan.', 'sort_order' => 6],
        ];
        foreach ($faqs as $f) {
            ProductFaq::create(array_merge($f, ['product_id' => $product->id]));
        }

        // Pricing Plans
        ProductPricingPlan::create([
            'product_id' => $product->id,
            'name' => 'Free',
            'monthly_price' => 0,
            'annual_price' => 0,
            'description' => 'For individuals and small teams getting started with CRM.',
            'features' => ['Up to 1,000 contacts', '1 sales pipeline', 'Basic email tracking', 'Mobile app access', 'Community support'],
            'is_popular' => false,
            'is_enterprise' => false,
            'sort_order' => 1,
        ]);
        ProductPricingPlan::create([
            'product_id' => $product->id,
            'name' => 'Pro',
            'monthly_price' => 29.00,
            'annual_price' => 290.00,
            'description' => 'For growing teams that need automation and advanced features.',
            'features' => ['Up to 50,000 contacts', 'Unlimited pipelines', 'Workflow automation', 'Email sequences', 'Custom reporting', 'API access', 'Priority support'],
            'is_popular' => true,
            'is_enterprise' => false,
            'sort_order' => 2,
        ]);
        ProductPricingPlan::create([
            'product_id' => $product->id,
            'name' => 'Enterprise',
            'monthly_price' => null,
            'annual_price' => null,
            'description' => 'For large organizations with advanced security and customization needs.',
            'features' => ['Unlimited contacts', 'Unlimited pipelines', 'Advanced automation', 'AI lead scoring', 'Custom integrations', 'Dedicated account manager', 'SSO & SAML', 'SLA guarantee', '24/7 phone support'],
            'is_popular' => false,
            'is_enterprise' => true,
            'sort_order' => 3,
        ]);

        // Screenshots
        for ($i = 1; $i <= 3; $i++) {
            $alts = ['CRM pipeline board view', 'Contact detail with activity timeline', 'Sales dashboard and reporting'];
            ProductScreenshot::create([
                'product_id' => $product->id,
                'url' => "/images/products/crm-screenshot-{$i}.png",
                'alt_text' => $alts[$i - 1],
                'sort_order' => $i,
            ]);
        }

        // Comparison Features
        $comparisonFeatures = [
            ['group' => 'Core', 'feature_name' => 'Contacts', 'plan_values' => ['Free' => '1,000', 'Pro' => '50,000', 'Enterprise' => 'Unlimited'], 'sort_order' => 1],
            ['group' => 'Core', 'feature_name' => 'Pipelines', 'plan_values' => ['Free' => '1', 'Pro' => 'Unlimited', 'Enterprise' => 'Unlimited'], 'sort_order' => 2],
            ['group' => 'Automation', 'feature_name' => 'Workflow Automation', 'plan_values' => ['Free' => false, 'Pro' => true, 'Enterprise' => true], 'sort_order' => 3],
            ['group' => 'Reporting', 'feature_name' => 'Custom Reports', 'plan_values' => ['Free' => false, 'Pro' => true, 'Enterprise' => true], 'sort_order' => 4],
            ['group' => 'Support', 'feature_name' => 'Dedicated Account Manager', 'plan_values' => ['Free' => false, 'Pro' => false, 'Enterprise' => true], 'sort_order' => 5],
        ];
        foreach ($comparisonFeatures as $cf) {
            ProductPricingFeature::create(array_merge($cf, ['product_id' => $product->id]));
        }
    }

    private function seedAnalytics(): void
    {
        $product = Product::create([
            'name' => 'Analytics',
            'slug' => 'analytics',
            'tagline' => 'Turn your data into decisions with powerful analytics',
            'description' => 'Kaabosh Analytics gives your team real-time visibility into the metrics that matter. Connect your data sources, build interactive dashboards, and share insights across your organization without writing a single line of code.',
            'accent_color' => '#8b5cf6',
            'logo' => '/images/products/analytics-logo.svg',
            'status' => 'live',
            'audiences' => ['Data Analysts', 'Product Managers', 'Marketing Teams', 'Executives'],
            'external_app_url' => 'https://app.kaabosh.com/analytics',
            'external_docs_url' => 'https://docs.kaabosh.com/analytics',
            'seo' => [
                'title' => 'Kaabosh Analytics - Real-Time Business Intelligence & Dashboards',
                'description' => 'Build interactive dashboards, connect your data sources, and gain real-time insights with Kaabosh Analytics.',
                'keywords' => ['analytics', 'business intelligence', 'dashboards', 'data visualization'],
            ],
            'sort_order' => 2,
        ]);

        // Modules
        $modules = [
            ['icon' => 'layout', 'name' => 'Dashboards', 'description' => 'Build beautiful, interactive dashboards with drag-and-drop widgets. Share live dashboards with your team or embed them in your own applications.', 'sort_order' => 1],
            ['icon' => 'file-text', 'name' => 'Reports', 'description' => 'Create detailed reports with charts, tables, and pivot views. Schedule automated report delivery to stakeholders via email or Slack.', 'sort_order' => 2],
            ['icon' => 'database', 'name' => 'Data Connectors', 'description' => 'Connect to 50+ data sources including databases, SaaS tools, spreadsheets, and APIs. Set up real-time or scheduled data syncing.', 'sort_order' => 3],
            ['icon' => 'bell', 'name' => 'Alerts', 'description' => 'Set threshold-based alerts on any metric. Get notified via email, Slack, or SMS when key metrics spike, drop, or hit your targets.', 'sort_order' => 4],
            ['icon' => 'download', 'name' => 'Exports', 'description' => 'Export your data and visualizations in PDF, CSV, Excel, or image formats. Schedule recurring exports for compliance and archival.', 'sort_order' => 5],
        ];
        foreach ($modules as $m) {
            ProductModule::create(array_merge($m, ['product_id' => $product->id]));
        }

        // Features
        $features = [
            ['icon' => 'pie-chart', 'name' => 'Visual Query Builder', 'description' => 'Explore your data without SQL. The visual query builder lets anyone create complex analyses with an intuitive point-and-click interface.', 'sort_order' => 1],
            ['icon' => 'refresh-cw', 'name' => 'Real-Time Streaming', 'description' => 'See your data update in real time with streaming connections. Monitor live user activity, transaction volumes, and system health as it happens.', 'sort_order' => 2],
            ['icon' => 'share-2', 'name' => 'Embedded Analytics', 'description' => 'Embed interactive charts and dashboards directly into your own product with our white-label embedding SDK. Fully customizable themes and permissions.', 'sort_order' => 3],
            ['icon' => 'shield', 'name' => 'Row-Level Security', 'description' => 'Control who sees what data with granular row-level security policies. Ensure compliance while still sharing dashboards across teams.', 'sort_order' => 4],
        ];
        foreach ($features as $f) {
            ProductFeature::create(array_merge($f, ['product_id' => $product->id]));
        }

        // FAQs
        $faqs = [
            ['question' => 'What data sources can I connect?', 'answer' => 'Kaabosh Analytics supports 50+ connectors including PostgreSQL, MySQL, BigQuery, Snowflake, Google Sheets, Salesforce, Stripe, and more. We also support custom API and webhook connectors.', 'sort_order' => 1],
            ['question' => 'Do I need to know SQL?', 'answer' => 'No. The visual query builder allows anyone to explore data without writing code. For advanced users, we also provide a full SQL editor with autocomplete and version history.', 'sort_order' => 2],
            ['question' => 'Can I embed dashboards in my product?', 'answer' => 'Yes, Pro and Enterprise plans include our embedded analytics SDK. You can white-label dashboards and charts with your own branding and control access with tokens.', 'sort_order' => 3],
            ['question' => 'How often does data refresh?', 'answer' => 'Refresh frequency depends on your plan. Free plans refresh every hour, Pro plans every 5 minutes, and Enterprise plans support real-time streaming connections.', 'sort_order' => 4],
            ['question' => 'Is my data secure?', 'answer' => 'All data is encrypted at rest and in transit. We are SOC 2 Type II certified and support SSO, row-level security, and audit logging on Enterprise plans.', 'sort_order' => 5],
        ];
        foreach ($faqs as $f) {
            ProductFaq::create(array_merge($f, ['product_id' => $product->id]));
        }

        // Pricing Plans
        ProductPricingPlan::create([
            'product_id' => $product->id,
            'name' => 'Free',
            'monthly_price' => 0,
            'annual_price' => 0,
            'description' => 'For individuals exploring data and building personal dashboards.',
            'features' => ['3 dashboards', '5 data connectors', 'Hourly data refresh', 'CSV exports', 'Community support'],
            'is_popular' => false,
            'is_enterprise' => false,
            'sort_order' => 1,
        ]);
        ProductPricingPlan::create([
            'product_id' => $product->id,
            'name' => 'Pro',
            'monthly_price' => 39.00,
            'annual_price' => 390.00,
            'description' => 'For teams that need real-time insights and collaboration.',
            'features' => ['Unlimited dashboards', 'Unlimited connectors', '5-minute data refresh', 'Embedded analytics', 'Scheduled reports', 'Slack & email alerts', 'Priority support'],
            'is_popular' => true,
            'is_enterprise' => false,
            'sort_order' => 2,
        ]);
        ProductPricingPlan::create([
            'product_id' => $product->id,
            'name' => 'Enterprise',
            'monthly_price' => null,
            'annual_price' => null,
            'description' => 'For organizations with advanced security and scale requirements.',
            'features' => ['Everything in Pro', 'Real-time streaming', 'Row-level security', 'Custom connectors', 'White-label embedding', 'SSO & SAML', 'Dedicated support engineer', 'SLA guarantee'],
            'is_popular' => false,
            'is_enterprise' => true,
            'sort_order' => 3,
        ]);

        // Screenshots
        $alts = ['Analytics dashboard with KPI widgets', 'Visual query builder interface', 'Scheduled reports configuration'];
        for ($i = 1; $i <= 3; $i++) {
            ProductScreenshot::create([
                'product_id' => $product->id,
                'url' => "/images/products/analytics-screenshot-{$i}.png",
                'alt_text' => $alts[$i - 1],
                'sort_order' => $i,
            ]);
        }

        // Comparison Features
        $comparisonFeatures = [
            ['group' => 'Core', 'feature_name' => 'Dashboards', 'plan_values' => ['Free' => '3', 'Pro' => 'Unlimited', 'Enterprise' => 'Unlimited'], 'sort_order' => 1],
            ['group' => 'Core', 'feature_name' => 'Data Connectors', 'plan_values' => ['Free' => '5', 'Pro' => 'Unlimited', 'Enterprise' => 'Unlimited'], 'sort_order' => 2],
            ['group' => 'Performance', 'feature_name' => 'Data Refresh', 'plan_values' => ['Free' => 'Hourly', 'Pro' => '5 minutes', 'Enterprise' => 'Real-time'], 'sort_order' => 3],
            ['group' => 'Advanced', 'feature_name' => 'Embedded Analytics', 'plan_values' => ['Free' => false, 'Pro' => true, 'Enterprise' => true], 'sort_order' => 4],
            ['group' => 'Security', 'feature_name' => 'Row-Level Security', 'plan_values' => ['Free' => false, 'Pro' => false, 'Enterprise' => true], 'sort_order' => 5],
        ];
        foreach ($comparisonFeatures as $cf) {
            ProductPricingFeature::create(array_merge($cf, ['product_id' => $product->id]));
        }
    }

    private function seedHelpdesk(): void
    {
        $product = Product::create([
            'name' => 'Helpdesk',
            'slug' => 'helpdesk',
            'tagline' => 'Deliver exceptional support at every touchpoint',
            'description' => 'Kaabosh Helpdesk unifies your support channels into a single workspace. Manage tickets, chat with customers in real time, build a knowledge base, and enforce SLAs to ensure every customer gets the help they need.',
            'accent_color' => '#ec4899',
            'logo' => '/images/products/helpdesk-logo.svg',
            'status' => 'beta',
            'audiences' => ['Support Teams', 'Customer Success Managers', 'IT Helpdesks', 'Operations'],
            'external_app_url' => 'https://app.kaabosh.com/helpdesk',
            'external_docs_url' => 'https://docs.kaabosh.com/helpdesk',
            'seo' => [
                'title' => 'Kaabosh Helpdesk - Unified Customer Support Platform',
                'description' => 'Manage tickets, live chat, knowledge base, and SLAs in one platform. Deliver exceptional customer support with Kaabosh Helpdesk.',
                'keywords' => ['helpdesk', 'customer support', 'ticketing system', 'live chat', 'knowledge base'],
            ],
            'sort_order' => 3,
        ]);

        // Modules
        $modules = [
            ['icon' => 'inbox', 'name' => 'Tickets', 'description' => 'Manage support requests from email, chat, and web forms in a unified inbox. Assign, prioritize, and track tickets through resolution.', 'sort_order' => 1],
            ['icon' => 'book-open', 'name' => 'Knowledge Base', 'description' => 'Build a self-service portal with articles, guides, and FAQs. Reduce ticket volume by helping customers find answers on their own.', 'sort_order' => 2],
            ['icon' => 'message-circle', 'name' => 'Live Chat', 'description' => 'Engage customers in real-time with a lightweight chat widget. Route conversations to the right agent and escalate to tickets when needed.', 'sort_order' => 3],
            ['icon' => 'clock', 'name' => 'SLA Management', 'description' => 'Define response and resolution time targets for different ticket priorities. Monitor SLA compliance and get alerts before breaches.', 'sort_order' => 4],
            ['icon' => 'globe', 'name' => 'Customer Portal', 'description' => 'Give customers a branded portal to submit and track their own tickets, browse the knowledge base, and view past conversations.', 'sort_order' => 5],
        ];
        foreach ($modules as $m) {
            ProductModule::create(array_merge($m, ['product_id' => $product->id]));
        }

        // Features
        $features = [
            ['icon' => 'layers', 'name' => 'Omnichannel Inbox', 'description' => 'Consolidate email, live chat, social media, and web form requests into a single inbox. Every channel, one interface.', 'sort_order' => 1],
            ['icon' => 'cpu', 'name' => 'AI-Powered Suggestions', 'description' => 'Get real-time article suggestions and response templates powered by AI, helping agents resolve tickets faster and more consistently.', 'sort_order' => 2],
            ['icon' => 'bar-chart', 'name' => 'Satisfaction Surveys', 'description' => 'Automatically send CSAT surveys after ticket resolution. Track satisfaction trends and identify areas for improvement.', 'sort_order' => 3],
        ];
        foreach ($features as $f) {
            ProductFeature::create(array_merge($f, ['product_id' => $product->id]));
        }

        // FAQs
        $faqs = [
            ['question' => 'Is Helpdesk available for production use?', 'answer' => 'Helpdesk is currently in public beta. It is stable and used by hundreds of teams, but some features are still being refined. We recommend it for teams comfortable with an evolving product.', 'sort_order' => 1],
            ['question' => 'What channels does Helpdesk support?', 'answer' => 'Currently we support email, live chat, and web form channels. Social media integrations for Twitter and Facebook are planned for general availability.', 'sort_order' => 2],
            ['question' => 'Can I customize the knowledge base?', 'answer' => 'Yes, you can fully brand your knowledge base with your own logo, colors, domain, and CSS. Articles support rich text, images, videos, and code snippets.', 'sort_order' => 3],
            ['question' => 'How does SLA tracking work?', 'answer' => 'You define SLA policies by ticket priority with first response and resolution time targets. The system tracks compliance in real time and sends escalation alerts before breaches.', 'sort_order' => 4],
            ['question' => 'Is the beta free?', 'answer' => 'During the beta period, all users get access to Pro-level features at no cost. Once we launch generally, beta users will receive a 30% loyalty discount on their first year.', 'sort_order' => 5],
        ];
        foreach ($faqs as $f) {
            ProductFaq::create(array_merge($f, ['product_id' => $product->id]));
        }

        // Pricing Plans
        ProductPricingPlan::create([
            'product_id' => $product->id,
            'name' => 'Free',
            'monthly_price' => 0,
            'annual_price' => 0,
            'description' => 'For small teams handling low ticket volumes.',
            'features' => ['Up to 100 tickets/month', '1 agent', 'Email channel', 'Basic knowledge base', 'Community support'],
            'is_popular' => false,
            'is_enterprise' => false,
            'sort_order' => 1,
        ]);
        ProductPricingPlan::create([
            'product_id' => $product->id,
            'name' => 'Pro',
            'monthly_price' => 25.00,
            'annual_price' => 250.00,
            'description' => 'For growing support teams with multi-channel needs.',
            'features' => ['Unlimited tickets', 'Up to 10 agents', 'Email, chat & web forms', 'SLA management', 'CSAT surveys', 'Custom knowledge base domain', 'Priority support'],
            'is_popular' => true,
            'is_enterprise' => false,
            'sort_order' => 2,
        ]);
        ProductPricingPlan::create([
            'product_id' => $product->id,
            'name' => 'Enterprise',
            'monthly_price' => null,
            'annual_price' => null,
            'description' => 'For large support operations with complex requirements.',
            'features' => ['Everything in Pro', 'Unlimited agents', 'AI-powered suggestions', 'Advanced SLA rules', 'Customer portal', 'SSO & SAML', 'Dedicated account manager', '99.9% uptime SLA'],
            'is_popular' => false,
            'is_enterprise' => true,
            'sort_order' => 3,
        ]);

        // Screenshots
        $alts = ['Helpdesk unified inbox view', 'Knowledge base article editor', 'SLA compliance dashboard'];
        for ($i = 1; $i <= 3; $i++) {
            ProductScreenshot::create([
                'product_id' => $product->id,
                'url' => "/images/products/helpdesk-screenshot-{$i}.png",
                'alt_text' => $alts[$i - 1],
                'sort_order' => $i,
            ]);
        }
    }

    private function seedForms(): void
    {
        $product = Product::create([
            'name' => 'Forms',
            'slug' => 'forms',
            'tagline' => 'Beautiful forms that convert, no code required',
            'description' => 'Kaabosh Forms lets you build stunning, logic-driven forms and surveys in minutes. Collect responses, process payments, and integrate with your workflow without writing a line of code.',
            'accent_color' => '#f59e0b',
            'logo' => '/images/products/forms-logo.svg',
            'status' => 'coming-soon',
            'audiences' => ['Marketing Teams', 'Product Managers', 'HR Teams', 'Event Organizers'],
            'external_app_url' => null,
            'external_docs_url' => null,
            'seo' => [
                'title' => 'Kaabosh Forms - Beautiful No-Code Form Builder',
                'description' => 'Build smart forms with conditional logic, collect responses, and integrate with your stack. Coming soon from Kaabosh.',
                'keywords' => ['form builder', 'online forms', 'surveys', 'no-code'],
            ],
            'sort_order' => 4,
        ]);

        // Modules
        $modules = [
            ['icon' => 'edit-3', 'name' => 'Builder', 'description' => 'Drag-and-drop form builder with 30+ field types, themes, and responsive layouts. Preview your form on any device before publishing.', 'sort_order' => 1],
            ['icon' => 'git-merge', 'name' => 'Logic', 'description' => 'Add conditional logic to show, hide, or skip fields based on previous answers. Create branching paths for personalized form experiences.', 'sort_order' => 2],
            ['icon' => 'inbox', 'name' => 'Submissions', 'description' => 'View, filter, and export submissions in real time. Set up email notifications, webhooks, and integrations for every new response.', 'sort_order' => 3],
            ['icon' => 'copy', 'name' => 'Templates', 'description' => 'Start from 100+ professionally designed templates for surveys, registrations, feedback forms, applications, and more.', 'sort_order' => 4],
        ];
        foreach ($modules as $m) {
            ProductModule::create(array_merge($m, ['product_id' => $product->id]));
        }

        // Features
        $features = [
            ['icon' => 'smartphone', 'name' => 'Mobile-First Design', 'description' => 'Every form is fully responsive and optimized for mobile devices. Achieve higher completion rates with a seamless mobile experience.', 'sort_order' => 1],
            ['icon' => 'credit-card', 'name' => 'Payment Collection', 'description' => 'Accept one-time or recurring payments through Stripe directly within your forms. Perfect for registrations, donations, and orders.', 'sort_order' => 2],
            ['icon' => 'globe', 'name' => 'Multi-Language Support', 'description' => 'Create forms in multiple languages and let respondents choose their preferred language. Ideal for global teams and audiences.', 'sort_order' => 3],
        ];
        foreach ($features as $f) {
            ProductFeature::create(array_merge($f, ['product_id' => $product->id]));
        }

        // FAQs
        $faqs = [
            ['question' => 'When will Forms be available?', 'answer' => 'We are targeting a public beta in Q3 2026. Join the waitlist to get early access and help shape the product with your feedback.', 'sort_order' => 1],
            ['question' => 'Will there be a free plan?', 'answer' => 'Yes, Forms will include a generous free plan with unlimited forms and up to 100 submissions per month. Paid plans will unlock advanced features like payment collection and custom branding.', 'sort_order' => 2],
            ['question' => 'Can I accept payments through forms?', 'answer' => 'Yes, Forms will integrate with Stripe to accept one-time and recurring payments. You can add payment fields to any form with a few clicks.', 'sort_order' => 3],
            ['question' => 'Will Forms integrate with other Kaabosh products?', 'answer' => 'Absolutely. Form submissions can automatically create CRM contacts, Helpdesk tickets, or trigger Analytics events. Deep integration is a key benefit of the Kaabosh platform.', 'sort_order' => 4],
        ];
        foreach ($faqs as $f) {
            ProductFaq::create(array_merge($f, ['product_id' => $product->id]));
        }

        // Pricing Plans
        ProductPricingPlan::create([
            'product_id' => $product->id,
            'name' => 'Free',
            'monthly_price' => 0,
            'annual_price' => 0,
            'description' => 'For individuals creating simple forms and surveys.',
            'features' => ['Unlimited forms', '100 submissions/month', 'Basic templates', 'Email notifications', 'Community support'],
            'is_popular' => false,
            'is_enterprise' => false,
            'sort_order' => 1,
        ]);
        ProductPricingPlan::create([
            'product_id' => $product->id,
            'name' => 'Pro',
            'monthly_price' => 19.00,
            'annual_price' => 190.00,
            'description' => 'For teams that need advanced logic and integrations.',
            'features' => ['Unlimited submissions', 'Conditional logic', 'Payment collection', 'File uploads', 'Custom branding', 'Webhooks & API', 'Priority support'],
            'is_popular' => true,
            'is_enterprise' => false,
            'sort_order' => 2,
        ]);
        ProductPricingPlan::create([
            'product_id' => $product->id,
            'name' => 'Enterprise',
            'monthly_price' => null,
            'annual_price' => null,
            'description' => 'For organizations with compliance and white-label needs.',
            'features' => ['Everything in Pro', 'HIPAA compliance', 'White-label forms', 'Custom domain', 'SSO & SAML', 'Advanced analytics', 'Dedicated support', 'SLA guarantee'],
            'is_popular' => false,
            'is_enterprise' => true,
            'sort_order' => 3,
        ]);
    }
}
