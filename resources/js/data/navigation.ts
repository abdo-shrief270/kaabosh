import type { NavItem, FooterColumn } from './types';

export const mainNav: NavItem[] = [
    {
        label: 'Products',
        href: '/products',
        children: [
            { label: 'PipeDesk \u2014 CRM', href: '/products/pipedesk' },
            { label: 'WorkNest \u2014 HR & Payroll', href: '/products/worknest' },
            { label: 'DevLaunch \u2014 Agency OS', href: '/products/devlaunch' },
            { label: 'CloudVault \u2014 Storage', href: '/products/cloudvault' },
        ],
    },
    {
        label: 'Pricing',
        href: '/pricing',
    },
    {
        label: 'Solutions',
        href: '/solutions',
        children: [
            { label: 'For Startups', href: '/solutions/startups' },
            { label: 'For Small Business', href: '/solutions/small-business' },
            { label: 'For Enterprise', href: '/solutions/enterprise' },
            { label: 'For Agencies', href: '/solutions/agencies' },
        ],
    },
    {
        label: 'Resources',
        href: '/resources',
        children: [
            { label: 'Blog', href: '/blog' },
            { label: 'Changelog', href: '/changelog' },
            { label: 'Documentation', href: '/docs' },
            { label: 'API Reference', href: '/developers' },
            { label: 'Help Center', href: '/help' },
        ],
    },
    {
        label: 'Company',
        href: '/about',
        children: [
            { label: 'About Us', href: '/about' },
            { label: 'Team', href: '/about/team' },
            { label: 'Careers', href: '/careers' },
            { label: 'Contact', href: '/contact' },
        ],
    },
];

export const footerColumns: FooterColumn[] = [
    {
        heading: 'Products',
        links: [
            { label: 'PipeDesk', href: '/products/pipedesk' },
            { label: 'WorkNest', href: '/products/worknest' },
            { label: 'DevLaunch', href: '/products/devlaunch' },
            { label: 'CloudVault', href: '/products/cloudvault' },
            { label: 'Pricing', href: '/pricing' },
        ],
    },
    {
        heading: 'Resources',
        links: [
            { label: 'Blog', href: '/blog' },
            { label: 'Changelog', href: '/changelog' },
            { label: 'Documentation', href: '/docs' },
            { label: 'API Reference', href: '/developers' },
            { label: 'Help Center', href: '/help' },
            { label: 'Status', href: 'https://status.kaabosh.com' },
        ],
    },
    {
        heading: 'Company',
        links: [
            { label: 'About Us', href: '/about' },
            { label: 'Team', href: '/about/team' },
            { label: 'Careers', href: '/careers' },
            { label: 'Contact', href: '/contact' },
            { label: 'Press Kit', href: '/press' },
        ],
    },
    {
        heading: 'Legal',
        links: [
            { label: 'Privacy Policy', href: '/legal/privacy' },
            { label: 'Terms of Service', href: '/legal/terms' },
            { label: 'Cookie Policy', href: '/legal/cookies' },
            { label: 'DPA', href: '/legal/dpa' },
            { label: 'Security', href: '/security' },
        ],
    },
];
