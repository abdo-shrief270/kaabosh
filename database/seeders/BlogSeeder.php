<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        // Authors
        $authors = [
            Author::create([
                'name' => 'Sarah Johnson',
                'slug' => 'sarah-johnson',
                'bio' => 'CTO at Kaabosh. Passionate about building scalable platforms and empowering engineering teams. Previously led engineering at two Y Combinator startups.',
                'photo' => '/images/authors/sarah-johnson.jpg',
                'linkedin_url' => 'https://linkedin.com/in/sarah-johnson',
            ]),
            Author::create([
                'name' => 'Carlos Mendoza',
                'slug' => 'carlos-mendoza',
                'bio' => 'VP of Product at Kaabosh. Focused on building products that solve real business problems. Former product lead at Atlassian.',
                'photo' => '/images/authors/carlos-mendoza.jpg',
                'linkedin_url' => 'https://linkedin.com/in/carlos-mendoza',
            ]),
            Author::create([
                'name' => 'Priya Sharma',
                'slug' => 'priya-sharma',
                'bio' => 'Head of Marketing at Kaabosh. Storyteller, data nerd, and growth strategist with 10+ years in B2B SaaS marketing.',
                'photo' => '/images/authors/priya-sharma.jpg',
                'linkedin_url' => 'https://linkedin.com/in/priya-sharma',
            ]),
        ];

        // Categories
        $categories = [];
        foreach (['Product Updates', 'Tutorials', 'Company News', 'Industry Insights', 'Engineering'] as $name) {
            $categories[$name] = BlogCategory::create([
                'name' => $name,
                'slug' => str($name)->slug()->toString(),
            ]);
        }

        // Blog Posts
        $posts = [
            [
                'slug' => 'introducing-kaabosh-crm-2-0',
                'title' => 'Introducing Kaabosh CRM 2.0: Smarter Pipelines, Faster Workflows',
                'excerpt' => 'Today we are launching CRM 2.0 with redesigned pipelines, a new automation engine, and AI-powered lead scoring. Here is what is new.',
                'body' => '<p>We are thrilled to announce the general availability of Kaabosh CRM 2.0, our biggest update since launch. This release focuses on three areas our customers have been asking for: smarter pipeline management, faster workflow automation, and intelligent lead prioritization.</p><p>The new pipeline view introduces customizable columns, weighted deal scoring, and inline editing so you can update deals without leaving the board. We have also rebuilt the automation engine from the ground up, supporting multi-step sequences with branching logic, time delays, and webhook triggers.</p><p>Perhaps most exciting is our new AI-powered lead scoring system. It analyzes engagement patterns, firmographic data, and historical conversion rates to assign a dynamic score to every contact, helping your team focus on the opportunities most likely to close.</p>',
                'featured_image' => '/images/blog/crm-2-0-launch.jpg',
                'author_id' => $authors[1]->id,
                'blog_category_id' => $categories['Product Updates']->id,
                'tags' => ['CRM', 'Product Launch', 'AI'],
                'reading_time' => 4,
                'published_at' => now()->subDays(5),
            ],
            [
                'slug' => 'how-to-build-sales-dashboard',
                'title' => 'How to Build a Sales Dashboard in Under 10 Minutes',
                'excerpt' => 'A step-by-step tutorial on creating a real-time sales dashboard using Kaabosh Analytics with data from your CRM.',
                'body' => '<p>One of the most common requests we hear from sales leaders is the ability to visualize pipeline health in real time. In this tutorial, we will walk you through building a comprehensive sales dashboard using Kaabosh Analytics, pulling live data from your CRM.</p><p>First, connect your CRM as a data source in Analytics. Navigate to Settings, then Data Connectors, and select Kaabosh CRM. The connection is automatic if you are on the same workspace. Within seconds, your deals, contacts, and activity data will be available for querying.</p><p>Next, create a new dashboard and add your first widget. We recommend starting with a pipeline funnel chart showing deal counts by stage. Drag the Deals table onto the canvas, group by Stage, and select the funnel visualization. Add filters for date range and sales rep to make the dashboard interactive for your whole team.</p>',
                'featured_image' => '/images/blog/sales-dashboard-tutorial.jpg',
                'author_id' => $authors[0]->id,
                'blog_category_id' => $categories['Tutorials']->id,
                'tags' => ['Analytics', 'Tutorial', 'Sales'],
                'reading_time' => 7,
                'published_at' => now()->subDays(12),
            ],
            [
                'slug' => 'kaabosh-raises-series-b',
                'title' => 'Kaabosh Raises $42M Series B to Expand Product Suite',
                'excerpt' => 'We are excited to announce our Series B funding round led by Sequoia Capital. Here is how we plan to use the investment.',
                'body' => '<p>Today we are announcing that Kaabosh has raised $42 million in Series B funding led by Sequoia Capital, with participation from existing investors Andreessen Horowitz and Y Combinator. This brings our total funding to $58 million.</p><p>Since our seed round 18 months ago, we have grown from a single CRM product to a platform of three products used by over 5,000 businesses worldwide. Our revenue has grown 4x year over year, and our team has expanded from 12 to 85 people across four countries.</p><p>We plan to use this investment to accelerate product development, with Kaabosh Forms and two additional products planned for 2026. We are also doubling our engineering and customer success teams to ensure every customer gets the support they deserve as we scale.</p>',
                'featured_image' => '/images/blog/series-b-announcement.jpg',
                'author_id' => $authors[2]->id,
                'blog_category_id' => $categories['Company News']->id,
                'tags' => ['Funding', 'Company', 'Growth'],
                'reading_time' => 3,
                'published_at' => now()->subDays(18),
            ],
            [
                'slug' => 'future-of-customer-support-ai',
                'title' => 'The Future of Customer Support: How AI Is Changing the Game',
                'excerpt' => 'AI is transforming customer support from reactive ticket resolution to proactive customer success. Here is what we see coming.',
                'body' => '<p>Customer support is undergoing its biggest transformation in decades. The rise of large language models and generative AI is enabling support teams to move beyond reactive ticket resolution toward proactive, personalized customer experiences. At Kaabosh, we are building these capabilities into Helpdesk.</p><p>The most immediate impact is in agent assistance. AI can analyze incoming tickets, suggest relevant knowledge base articles, draft response templates, and even predict which tickets are likely to escalate. Early adopters report 30-40% reductions in average handle time.</p><p>Looking further ahead, we see AI enabling truly predictive support. By analyzing product usage patterns and historical ticket data, systems will be able to identify customers likely to encounter issues and reach out proactively with solutions before problems arise. This shift from reactive to proactive support will redefine customer success metrics.</p>',
                'featured_image' => '/images/blog/ai-customer-support.jpg',
                'author_id' => $authors[1]->id,
                'blog_category_id' => $categories['Industry Insights']->id,
                'tags' => ['AI', 'Customer Support', 'Trends'],
                'reading_time' => 6,
                'published_at' => now()->subDays(25),
            ],
            [
                'slug' => 'migrating-to-event-driven-architecture',
                'title' => 'How We Migrated to an Event-Driven Architecture',
                'excerpt' => 'A deep dive into our migration from a monolithic architecture to event-driven microservices, and the lessons we learned along the way.',
                'body' => '<p>When Kaabosh started, we built a classic Laravel monolith. It served us well through our first 1,000 customers, but as we added Analytics and Helpdesk, the codebase became increasingly coupled. Changes in one product would sometimes break another, and deployments became risky, coordinated affairs.</p><p>We decided to migrate to an event-driven architecture using Apache Kafka as our message broker. Each product now operates as an independent service, communicating through well-defined events. When a CRM deal closes, it emits a DealClosed event that Analytics consumes to update dashboards and Helpdesk uses to adjust customer priority.</p><p>The migration took six months and was not without challenges. We had to solve for eventual consistency, implement idempotent event handlers, and build robust monitoring to trace events across services. But the payoff has been enormous: deployment frequency increased 5x, cross-product bugs dropped 90%, and each team can now ship independently.</p>',
                'featured_image' => '/images/blog/event-driven-architecture.jpg',
                'author_id' => $authors[0]->id,
                'blog_category_id' => $categories['Engineering']->id,
                'tags' => ['Architecture', 'Engineering', 'Kafka'],
                'reading_time' => 9,
                'published_at' => now()->subDays(32),
            ],
            [
                'slug' => 'analytics-custom-dashboards-guide',
                'title' => 'Mastering Custom Dashboards in Kaabosh Analytics',
                'excerpt' => 'Learn how to create, customize, and share powerful dashboards that give your team the insights they need.',
                'body' => '<p>Custom dashboards are the heart of Kaabosh Analytics. They transform raw data into visual stories that drive decisions. In this guide, we will cover everything from creating your first dashboard to advanced techniques like dynamic filters, drill-downs, and embedded sharing.</p><p>Start by defining your audience and key questions. A dashboard for executives should focus on high-level KPIs and trends, while an operational dashboard for a support team might show real-time ticket volumes and SLA compliance. Clarity of purpose leads to more effective dashboards.</p><p>Once your layout is set, add interactivity. Dashboard filters let viewers slice data by date range, product, region, or any dimension in your dataset. Drill-down links let users click a chart element to see the underlying detail. These features turn static reports into exploratory tools that invite curiosity.</p>',
                'featured_image' => '/images/blog/custom-dashboards-guide.jpg',
                'author_id' => $authors[1]->id,
                'blog_category_id' => $categories['Tutorials']->id,
                'tags' => ['Analytics', 'Tutorial', 'Dashboards'],
                'reading_time' => 8,
                'published_at' => now()->subDays(40),
            ],
            [
                'slug' => 'kaabosh-forms-preview',
                'title' => 'Sneak Peek: What to Expect from Kaabosh Forms',
                'excerpt' => 'We are giving you an early look at Forms, our upcoming no-code form builder with conditional logic, payments, and deep platform integrations.',
                'body' => '<p>We have been heads down building Kaabosh Forms, and today we want to share a preview of what is coming. Forms is designed to be the most intuitive form builder on the market, with powerful features hidden behind a beautifully simple interface.</p><p>The drag-and-drop builder supports 30+ field types, from standard text inputs to file uploads, signature fields, and Stripe payment elements. Every form is responsive by default and can be embedded on any website, shared via link, or used within the Kaabosh platform.</p><p>What sets Forms apart is its deep integration with the Kaabosh ecosystem. A form submission can automatically create a CRM contact, open a Helpdesk ticket, or trigger an Analytics event. Combined with conditional logic and multi-page branching, Forms becomes a powerful tool for lead capture, customer onboarding, and internal workflows.</p>',
                'featured_image' => '/images/blog/forms-preview.jpg',
                'author_id' => $authors[1]->id,
                'blog_category_id' => $categories['Product Updates']->id,
                'tags' => ['Forms', 'Product Preview', 'No-Code'],
                'reading_time' => 5,
                'published_at' => now()->subDays(48),
            ],
            [
                'slug' => 'state-of-b2b-saas-2026',
                'title' => 'The State of B2B SaaS in 2026: Trends We Are Watching',
                'excerpt' => 'From AI-native products to platform consolidation, here are the trends shaping the B2B SaaS landscape this year.',
                'body' => '<p>The B2B SaaS market is evolving faster than ever. After a period of contraction in 2024, growth has returned but the landscape looks fundamentally different. Buyers are more discerning, budgets are under tighter scrutiny, and the bar for product quality has never been higher.</p><p>The biggest trend we see is platform consolidation. Companies are moving away from best-of-breed point solutions toward integrated platforms that reduce complexity and total cost of ownership. This is exactly the thesis behind the Kaabosh platform, and we are seeing it validated by our fastest-growing customers.</p><p>AI-native products are also reshaping expectations. Customers no longer view AI as a nice-to-have; they expect intelligent features as table stakes. Products that use AI to automate tedious work, surface insights, and predict outcomes are winning market share from incumbents that bolt on AI as an afterthought.</p>',
                'featured_image' => '/images/blog/b2b-saas-trends-2026.jpg',
                'author_id' => $authors[2]->id,
                'blog_category_id' => $categories['Industry Insights']->id,
                'tags' => ['SaaS', 'Trends', 'AI', 'Industry'],
                'reading_time' => 6,
                'published_at' => now()->subDays(55),
            ],
            [
                'slug' => 'setting-up-helpdesk-sla-policies',
                'title' => 'Setting Up SLA Policies in Kaabosh Helpdesk',
                'excerpt' => 'A practical guide to configuring SLA policies that keep your support team accountable and your customers happy.',
                'body' => '<p>Service Level Agreements are the backbone of professional customer support. They set clear expectations for response and resolution times, and they give your team measurable targets to hit. In this tutorial, we will walk through setting up SLA policies in Kaabosh Helpdesk.</p><p>Navigate to Helpdesk Settings, then SLA Policies, and create your first policy. Define the priority levels (Critical, High, Medium, Low) and set response and resolution time targets for each. For example, Critical tickets might require a first response within 1 hour and resolution within 4 hours.</p><p>Next, configure escalation rules. When a ticket is approaching its SLA deadline, you want the right people notified. Set up tiered escalations: warn the assigned agent at 75% of the time limit, escalate to the team lead at 90%, and notify the support manager if the SLA is breached. These guardrails ensure nothing falls through the cracks.</p>',
                'featured_image' => '/images/blog/sla-policies-guide.jpg',
                'author_id' => $authors[0]->id,
                'blog_category_id' => $categories['Tutorials']->id,
                'tags' => ['Helpdesk', 'Tutorial', 'SLA'],
                'reading_time' => 6,
                'published_at' => now()->subDays(62),
            ],
            [
                'slug' => 'building-accessible-ui-components',
                'title' => 'Building Accessible UI Components: Lessons from the Kaabosh Design System',
                'excerpt' => 'How our design team approaches accessibility in our component library, and practical tips you can apply to your own projects.',
                'body' => '<p>Accessibility is not a feature; it is a responsibility. At Kaabosh, we believe that every user deserves an equally excellent experience regardless of their abilities. Our design system, which powers all four Kaabosh products, is built with accessibility as a core constraint, not an afterthought.</p><p>We start with semantic HTML. Every interactive element uses the correct native element or ARIA role. Buttons are buttons, not styled divs. Links navigate, buttons act. This foundation ensures that screen readers, keyboard users, and voice control software can interact with our products reliably.</p><p>Color contrast is another area where we invest heavily. Our design tokens include contrast-checked color pairings for every theme. We test with simulated color blindness filters during design review, and our CI pipeline runs automated contrast checks on every pull request. The result is a product that is readable and usable by everyone.</p>',
                'featured_image' => '/images/blog/accessible-ui-components.jpg',
                'author_id' => $authors[0]->id,
                'blog_category_id' => $categories['Engineering']->id,
                'tags' => ['Accessibility', 'Design System', 'Engineering'],
                'reading_time' => 7,
                'published_at' => now()->subDays(70),
            ],
            [
                'slug' => 'crm-email-automation-best-practices',
                'title' => '5 Email Automation Workflows Every Sales Team Needs',
                'excerpt' => 'Boost your sales productivity with these proven email automation workflows built inside Kaabosh CRM.',
                'body' => '<p>Email automation is one of the highest-leverage tools available to sales teams. When done right, it ensures consistent follow-up, shortens sales cycles, and frees reps to focus on high-value conversations. Here are five workflows we see top-performing Kaabosh CRM users deploy.</p><p>The first is the welcome sequence. When a new lead enters your CRM, automatically send a personalized welcome email, followed by a value-driven follow-up two days later, and a soft call-to-action on day five. This sequence warms leads without manual effort. The second is the stale deal re-engagement workflow, which triggers when a deal has not been updated in 14 days.</p><p>The remaining three workflows cover post-demo follow-up, lost deal win-back campaigns, and customer expansion outreach. Each can be built in Kaabosh CRM using our visual automation builder in under 15 minutes. The key is to keep messages personal, provide genuine value, and respect your prospect\'s time and inbox.</p>',
                'featured_image' => '/images/blog/email-automation-workflows.jpg',
                'author_id' => $authors[2]->id,
                'blog_category_id' => $categories['Tutorials']->id,
                'tags' => ['CRM', 'Email', 'Automation', 'Sales'],
                'reading_time' => 5,
                'published_at' => now()->subDays(78),
            ],
            [
                'slug' => 'helpdesk-beta-update-march-2026',
                'title' => 'Helpdesk Beta Update: Live Chat, Improved SLAs, and More',
                'excerpt' => 'A recap of everything we shipped in the Helpdesk beta this month, including live chat, SLA improvements, and performance upgrades.',
                'body' => '<p>March has been a productive month for the Helpdesk team. We shipped live chat support, overhauled our SLA engine, and made significant performance improvements. Here is a summary of what is new in the beta.</p><p>Live chat is now available for all Helpdesk beta users. Add our lightweight JavaScript widget to your website and start chatting with customers in real time. Conversations can be converted to tickets with one click, and chat history is stored alongside email threads for a complete customer timeline.</p><p>We also rebuilt the SLA engine to support business hours, holiday calendars, and per-customer SLA overrides. Combined with new escalation rules and a real-time SLA compliance dashboard, your team now has full visibility into response and resolution performance across all channels.</p>',
                'featured_image' => '/images/blog/helpdesk-beta-march-update.jpg',
                'author_id' => $authors[1]->id,
                'blog_category_id' => $categories['Product Updates']->id,
                'tags' => ['Helpdesk', 'Beta', 'Product Update'],
                'reading_time' => 4,
                'published_at' => now()->subDays(85),
            ],
        ];

        foreach ($posts as $post) {
            BlogPost::create($post);
        }
    }
}
