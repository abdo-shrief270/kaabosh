<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use App\Models\CompanyValue;
use App\Models\Milestone;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedTeamMembers();
        $this->seedCompanyValues();
        $this->seedMilestones();
    }

    private function seedTeamMembers(): void
    {
        $members = [
            [
                'name' => 'Ahmed Al-Rashid',
                'title' => 'Chief Executive Officer',
                'bio' => 'Ahmed founded Kaabosh with the vision of building an integrated business platform that is powerful yet simple. With 15 years of experience scaling SaaS companies across the Middle East and North America, he brings a unique perspective on building products for global markets. Previously, Ahmed co-founded a fintech startup acquired by a major regional bank.',
                'photo' => '/images/team/member-1.jpg',
                'linkedin_url' => 'https://linkedin.com/in/ahmed-al-rashid',
                'sort_order' => 1,
            ],
            [
                'name' => 'Sarah Johnson',
                'title' => 'Chief Technology Officer',
                'bio' => 'Sarah leads the engineering organization at Kaabosh, overseeing architecture, infrastructure, and developer experience. She previously held senior engineering roles at two Y Combinator startups and spent five years at Google working on Cloud Platform. Sarah is passionate about building scalable systems and fostering inclusive engineering cultures.',
                'photo' => '/images/team/member-2.jpg',
                'linkedin_url' => 'https://linkedin.com/in/sarah-johnson',
                'sort_order' => 2,
            ],
            [
                'name' => 'Carlos Mendoza',
                'title' => 'VP of Product',
                'bio' => 'Carlos drives the product vision and roadmap across all Kaabosh products. Before joining Kaabosh, he spent six years at Atlassian leading product for Jira Service Management. Carlos is known for his customer-obsessed approach to product development and his ability to balance user needs with business objectives.',
                'photo' => '/images/team/member-3.jpg',
                'linkedin_url' => 'https://linkedin.com/in/carlos-mendoza',
                'sort_order' => 3,
            ],
            [
                'name' => 'Fatima Hassan',
                'title' => 'VP of Engineering',
                'bio' => 'Fatima manages the day-to-day engineering operations, ensuring teams ship high-quality software on schedule. She brings a decade of experience from Amazon Web Services, where she led teams building distributed systems at scale. Fatima is an advocate for test-driven development and continuous delivery practices.',
                'photo' => '/images/team/member-4.jpg',
                'linkedin_url' => 'https://linkedin.com/in/fatima-hassan',
                'sort_order' => 4,
            ],
            [
                'name' => 'David Kim',
                'title' => 'Head of Design',
                'bio' => 'David leads the design team responsible for the Kaabosh design system, product UX, and brand identity. Previously a design lead at Figma, David brings deep expertise in design systems, accessibility, and user research. He believes that great design is invisible and that the best interfaces get out of the user\'s way.',
                'photo' => '/images/team/member-5.jpg',
                'linkedin_url' => 'https://linkedin.com/in/david-kim',
                'sort_order' => 5,
            ],
            [
                'name' => 'Priya Sharma',
                'title' => 'Head of Marketing',
                'bio' => 'Priya oversees all marketing efforts at Kaabosh, from brand strategy and content to demand generation and community building. With 10 years in B2B SaaS marketing, including stints at HubSpot and Intercom, she specializes in building authentic brand narratives that resonate with technical and business audiences alike.',
                'photo' => '/images/team/member-6.jpg',
                'linkedin_url' => 'https://linkedin.com/in/priya-sharma',
                'sort_order' => 6,
            ],
            [
                'name' => 'James Wright',
                'title' => 'Head of Sales',
                'bio' => 'James leads the sales organization, building and coaching a team of account executives and solutions engineers. He spent eight years at Salesforce in various sales leadership roles before joining Kaabosh to help build a sales-led growth engine. James is passionate about consultative selling and long-term customer partnerships.',
                'photo' => '/images/team/member-7.jpg',
                'linkedin_url' => 'https://linkedin.com/in/james-wright',
                'sort_order' => 7,
            ],
            [
                'name' => 'Lisa Chen',
                'title' => 'Head of Customer Success',
                'bio' => 'Lisa leads the customer success team, ensuring every Kaabosh customer achieves their goals with the platform. Before Kaabosh, she built the customer success function at Notion from the ground up, scaling it from 50 to 2,000 enterprise accounts. Lisa believes that customer success starts with genuine empathy and deep product knowledge.',
                'photo' => '/images/team/member-8.jpg',
                'linkedin_url' => 'https://linkedin.com/in/lisa-chen',
                'sort_order' => 8,
            ],
        ];

        foreach ($members as $member) {
            TeamMember::create($member);
        }
    }

    private function seedCompanyValues(): void
    {
        $values = [
            [
                'icon' => 'users',
                'title' => 'Customer Obsession',
                'body' => 'Every decision starts with the customer. We listen deeply, build with empathy, and measure success by the outcomes our customers achieve, not the features we ship.',
                'sort_order' => 1,
            ],
            [
                'icon' => 'zap',
                'title' => 'Bias for Action',
                'body' => 'We value speed and iteration over perfection. Ship early, learn fast, and improve continuously. Progress beats planning when you have a clear direction and tight feedback loops.',
                'sort_order' => 2,
            ],
            [
                'icon' => 'unlock',
                'title' => 'Radical Transparency',
                'body' => 'We share information openly across the company. From financials to product roadmaps, everyone has the context they need to make great decisions. Trust is built through openness.',
                'sort_order' => 3,
            ],
            [
                'icon' => 'heart',
                'title' => 'Craftsmanship',
                'body' => 'We take pride in the quality of our work. From pixel-perfect interfaces to well-tested code, we believe that details matter and that excellence is a habit, not an accident.',
                'sort_order' => 4,
            ],
            [
                'icon' => 'globe',
                'title' => 'Inclusive by Default',
                'body' => 'We build for everyone. Our products are accessible, our content is localized, and our team reflects the diversity of the global community we serve. Different perspectives make us stronger.',
                'sort_order' => 5,
            ],
        ];

        foreach ($values as $value) {
            CompanyValue::create($value);
        }
    }

    private function seedMilestones(): void
    {
        $milestones = [
            [
                'date_label' => 'January 2024',
                'title' => 'Kaabosh Founded',
                'description' => 'Ahmed Al-Rashid and Sarah Johnson incorporate Kaabosh with the mission to build an integrated business platform for modern teams.',
                'sort_order' => 1,
            ],
            [
                'date_label' => 'June 2024',
                'title' => 'Seed Round & CRM Launch',
                'description' => 'Raised $4M seed round led by Y Combinator. Launched Kaabosh CRM to our first 100 beta customers.',
                'sort_order' => 2,
            ],
            [
                'date_label' => 'January 2025',
                'title' => '1,000 Customers',
                'description' => 'Reached 1,000 paying customers across 30 countries. Team grew to 25 people.',
                'sort_order' => 3,
            ],
            [
                'date_label' => 'July 2025',
                'title' => 'Analytics Launch & Series A',
                'description' => 'Launched Kaabosh Analytics as our second product. Raised $12M Series A led by Andreessen Horowitz.',
                'sort_order' => 4,
            ],
            [
                'date_label' => 'January 2026',
                'title' => 'Series B & 5,000 Customers',
                'description' => 'Raised $42M Series B led by Sequoia Capital. Surpassed 5,000 customers and 85 team members. Launched Helpdesk in public beta.',
                'sort_order' => 5,
            ],
            [
                'date_label' => 'March 2026',
                'title' => 'Forms Announced',
                'description' => 'Announced Kaabosh Forms, our fourth product, with a public waitlist. Targeting Q3 2026 for public beta.',
                'sort_order' => 6,
            ],
        ];

        foreach ($milestones as $milestone) {
            Milestone::create($milestone);
        }
    }
}
