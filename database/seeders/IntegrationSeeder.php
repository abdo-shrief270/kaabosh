<?php

namespace Database\Seeders;

use App\Models\Integration;
use Illuminate\Database\Seeder;

class IntegrationSeeder extends Seeder
{
    public function run(): void
    {
        $integrations = [
            [
                'slug' => 'slack',
                'name' => 'Slack',
                'description' => 'Get real-time notifications in Slack when deals close, tickets are created, or dashboards hit alert thresholds. Send messages to channels and DMs directly from Kaabosh.',
                'logo' => '/images/integrations/slack.svg',
                'category' => 'Communication',
                'connected_products' => ['crm', 'analytics', 'helpdesk'],
                'setup_steps' => [
                    'Navigate to Settings > Integrations > Slack',
                    'Click "Connect to Slack" and authorize the Kaabosh app in your workspace',
                    'Select the channels where you want to receive notifications',
                    'Configure notification preferences for each product',
                    'Test the connection by sending a test message',
                ],
                'external_url' => 'https://slack.com',
                'sort_order' => 1,
            ],
            [
                'slug' => 'zapier',
                'name' => 'Zapier',
                'description' => 'Connect Kaabosh to 5,000+ apps through Zapier. Automate workflows between Kaabosh and the tools your team already uses without writing any code.',
                'logo' => '/images/integrations/zapier.svg',
                'category' => 'Automation',
                'connected_products' => ['crm', 'analytics', 'helpdesk'],
                'setup_steps' => [
                    'Create a Zapier account or log in to your existing account',
                    'Search for "Kaabosh" in the Zapier app directory',
                    'Create a new Zap and select Kaabosh as the trigger or action app',
                    'Authenticate with your Kaabosh API key (found in Settings > API)',
                    'Configure your trigger/action and test the Zap',
                ],
                'external_url' => 'https://zapier.com',
                'sort_order' => 2,
            ],
            [
                'slug' => 'stripe',
                'name' => 'Stripe',
                'description' => 'Sync Stripe payment data with your CRM contacts and Analytics dashboards. Track revenue, subscriptions, and churn metrics alongside your sales and support data.',
                'logo' => '/images/integrations/stripe.svg',
                'category' => 'Payments',
                'connected_products' => ['crm', 'analytics'],
                'setup_steps' => [
                    'Navigate to Settings > Integrations > Stripe',
                    'Click "Connect Stripe" and log in to your Stripe account',
                    'Select which Stripe data to sync (customers, subscriptions, invoices)',
                    'Map Stripe customers to CRM contacts by email or external ID',
                    'Enable real-time webhook sync for instant data updates',
                ],
                'external_url' => 'https://stripe.com',
                'sort_order' => 3,
            ],
            [
                'slug' => 'hubspot',
                'name' => 'HubSpot',
                'description' => 'Migrate from HubSpot or run both platforms side by side. Sync contacts, deals, and company data bidirectionally between HubSpot and Kaabosh CRM.',
                'logo' => '/images/integrations/hubspot.svg',
                'category' => 'CRM',
                'connected_products' => ['crm'],
                'setup_steps' => [
                    'Navigate to Settings > Integrations > HubSpot',
                    'Click "Connect HubSpot" and authorize the Kaabosh integration',
                    'Choose sync direction: one-way (import), one-way (export), or bidirectional',
                    'Map HubSpot fields to Kaabosh CRM fields',
                    'Run an initial sync and review the mapping preview',
                    'Enable ongoing sync with conflict resolution rules',
                ],
                'external_url' => 'https://hubspot.com',
                'sort_order' => 4,
            ],
            [
                'slug' => 'github',
                'name' => 'GitHub',
                'description' => 'Link GitHub issues and pull requests to Helpdesk tickets. Track engineering progress on customer-reported bugs directly from the support interface.',
                'logo' => '/images/integrations/github.svg',
                'category' => 'Development',
                'connected_products' => ['helpdesk'],
                'setup_steps' => [
                    'Navigate to Settings > Integrations > GitHub',
                    'Click "Connect GitHub" and authorize the Kaabosh GitHub App',
                    'Select the repositories you want to connect',
                    'Configure the link between Helpdesk ticket tags and GitHub labels',
                    'Test by creating a linked issue from a Helpdesk ticket',
                ],
                'external_url' => 'https://github.com',
                'sort_order' => 5,
            ],
            [
                'slug' => 'google-workspace',
                'name' => 'Google Workspace',
                'description' => 'Sync Gmail, Google Calendar, and Google Contacts with Kaabosh CRM. Log emails automatically, schedule meetings from deal views, and keep contacts in sync.',
                'logo' => '/images/integrations/google-workspace.svg',
                'category' => 'Productivity',
                'connected_products' => ['crm', 'analytics'],
                'setup_steps' => [
                    'Navigate to Settings > Integrations > Google Workspace',
                    'Click "Connect Google" and sign in with your Google account',
                    'Grant permissions for Gmail, Calendar, and Contacts access',
                    'Configure email sync preferences (all emails or CRM contacts only)',
                    'Enable calendar sync to log meetings as CRM activities',
                ],
                'external_url' => 'https://workspace.google.com',
                'sort_order' => 6,
            ],
            [
                'slug' => 'salesforce',
                'name' => 'Salesforce',
                'description' => 'Migrate from Salesforce or sync data between platforms. Import contacts, opportunities, and custom objects with full field mapping and deduplication.',
                'logo' => '/images/integrations/salesforce.svg',
                'category' => 'CRM',
                'connected_products' => ['crm', 'analytics'],
                'setup_steps' => [
                    'Navigate to Settings > Integrations > Salesforce',
                    'Click "Connect Salesforce" and log in to your Salesforce org',
                    'Select objects to sync (Contacts, Accounts, Opportunities, custom objects)',
                    'Map Salesforce fields to Kaabosh CRM fields using the visual mapper',
                    'Configure deduplication rules and conflict resolution',
                    'Run a preview sync to verify data mapping before committing',
                ],
                'external_url' => 'https://salesforce.com',
                'sort_order' => 7,
            ],
            [
                'slug' => 'jira',
                'name' => 'Jira',
                'description' => 'Connect Jira projects to Helpdesk for seamless bug tracking. Create Jira issues from support tickets, track resolution status, and notify customers when fixes are deployed.',
                'logo' => '/images/integrations/jira.svg',
                'category' => 'Development',
                'connected_products' => ['helpdesk'],
                'setup_steps' => [
                    'Navigate to Settings > Integrations > Jira',
                    'Click "Connect Jira" and authorize the Kaabosh app in your Atlassian account',
                    'Select the Jira projects to link with Helpdesk',
                    'Configure default issue types and priority mappings',
                    'Enable automatic status sync between Jira issues and Helpdesk tickets',
                ],
                'external_url' => 'https://atlassian.com/jira',
                'sort_order' => 8,
            ],
        ];

        foreach ($integrations as $integration) {
            Integration::create($integration);
        }
    }
}
