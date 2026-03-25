<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            // Homepage testimonials
            [
                'quote' => 'Kaabosh replaced three separate tools for our team. Having CRM, analytics, and support in one platform has saved us over 20 hours a week and cut our software budget by 40%.',
                'customer_name' => 'Rebecca Torres',
                'job_title' => 'Chief Operating Officer',
                'company' => 'Meridian Digital',
                'photo' => '/images/testimonials/rebecca-torres.jpg',
                'product_used' => null,
                'page' => 'homepage',
                'sort_order' => 1,
            ],
            [
                'quote' => 'We evaluated a dozen platforms before choosing Kaabosh. The depth of features combined with the simplicity of the interface is something we have not found anywhere else. Our onboarding time dropped from two weeks to two days.',
                'customer_name' => 'Marcus Chen',
                'job_title' => 'VP of Revenue Operations',
                'company' => 'Skyline Technologies',
                'photo' => '/images/testimonials/marcus-chen.jpg',
                'product_used' => null,
                'page' => 'homepage',
                'sort_order' => 2,
            ],
            [
                'quote' => 'As a startup, we needed a platform that could grow with us. Kaabosh gave us enterprise-grade tools at a price point that made sense for our stage. Two years later, we are 10x the size and still on the same platform.',
                'customer_name' => 'Aisha Patel',
                'job_title' => 'Founder & CEO',
                'company' => 'NovaBridge',
                'photo' => '/images/testimonials/aisha-patel.jpg',
                'product_used' => null,
                'page' => 'homepage',
                'sort_order' => 3,
            ],
            // CRM testimonial
            [
                'quote' => 'Kaabosh CRM transformed how our sales team operates. The pipeline automation alone has increased our close rate by 28%, and the AI lead scoring helps our reps focus on the deals that actually matter.',
                'customer_name' => 'Daniel Okonkwo',
                'job_title' => 'Head of Sales',
                'company' => 'Vertex Solutions',
                'photo' => '/images/testimonials/daniel-okonkwo.jpg',
                'product_used' => 'crm',
                'page' => 'product',
                'sort_order' => 1,
            ],
            // Analytics testimonial
            [
                'quote' => 'We went from spending days building reports in spreadsheets to having real-time dashboards that update automatically. Kaabosh Analytics has made data-driven decision making accessible to every team in our company.',
                'customer_name' => 'Emma Lindqvist',
                'job_title' => 'Director of Business Intelligence',
                'company' => 'Arcadia Group',
                'photo' => '/images/testimonials/emma-lindqvist.jpg',
                'product_used' => 'analytics',
                'page' => 'product',
                'sort_order' => 2,
            ],
            // Helpdesk testimonial
            [
                'quote' => 'Even in beta, Kaabosh Helpdesk is already better than the ticketing system we used for three years. The unified inbox and SLA tracking have cut our average response time from 4 hours to under 30 minutes.',
                'customer_name' => 'Tomás Herrera',
                'job_title' => 'Customer Support Manager',
                'company' => 'CloudFirst Inc.',
                'photo' => '/images/testimonials/tomas-herrera.jpg',
                'product_used' => 'helpdesk',
                'page' => 'product',
                'sort_order' => 3,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
