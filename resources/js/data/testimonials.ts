import type { Testimonial } from './types';

export const testimonials: Testimonial[] = [
    {
        quote: 'We switched from Salesforce to PipeDesk and our reps actually started updating the CRM. Pipeline visibility went from a weekly guessing game to a live dashboard the whole team trusts. We closed 23% more deals in the first quarter after switching.',
        name: 'Rachel Simmons',
        title: 'VP of Sales',
        company: 'BrightPath Analytics',
        photo: '/images/testimonials/rachel-simmons.webp',
        product: 'pipedesk',
    },
    {
        quote: 'The AI lead scoring alone paid for our PipeDesk subscription in the first month. Our SDRs stopped wasting time on cold leads and started spending their energy on prospects that were actually ready to buy. Response time to hot leads dropped from 6 hours to 12 minutes.',
        name: 'Marcus Chen',
        title: 'Head of Revenue Operations',
        company: 'Stackline',
        photo: '/images/testimonials/marcus-chen.webp',
        product: 'pipedesk',
    },
    {
        quote: 'Running payroll used to take our HR team an entire day every two weeks. With WorkNest, it takes about 15 minutes\u2014and that includes reviewing everything. The compliance alerts have saved us from at least three potential issues with state labor law changes.',
        name: 'Dana Whitfield',
        title: 'Director of People Operations',
        company: 'GreenThread Apparel',
        photo: '/images/testimonials/dana-whitfield.webp',
        product: 'worknest',
    },
    {
        quote: 'We went from spreadsheets and three different tools to WorkNest for everything\u2014hiring, onboarding, payroll, and performance reviews. Our new hires say the onboarding experience is the most organized they have ever seen. That matters when you are hiring 10 people a month.',
        name: 'James Okafor',
        title: 'CEO',
        company: 'Meridian Digital',
        photo: '/images/testimonials/james-okafor.webp',
        product: 'worknest',
    },
    {
        quote: 'DevLaunch replaced our Harvest + Asana + QuickBooks stack with one tool that actually understands how agencies work. The profitability tracking changed how we price projects\u2014we finally know which clients are worth our time and which ones are draining us.',
        name: 'Sofia Petrov',
        title: 'Co-Founder',
        company: 'Studio Rubric',
        photo: '/images/testimonials/sofia-petrov.webp',
        product: 'devlaunch',
    },
    {
        quote: 'Kaabosh is what happens when someone builds business software and actually thinks about the people who have to use it every day. The products work together in a way that feels natural, not bolted on. Our team went from five logins to one and nobody misses the old setup.',
        name: 'Tom Eriksson',
        title: 'COO',
        company: 'NorthBridge Ventures',
        photo: '/images/testimonials/tom-eriksson.webp',
        product: 'general',
    },
];

export function getTestimonialsByProduct(productSlug: string): Testimonial[] {
    return testimonials.filter(
        (t) => t.product === productSlug || t.product === 'general'
    );
}
