<?php

namespace Database\Seeders;

use App\Models\ChangelogEntry;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ChangelogSeeder extends Seeder
{
    public function run(): void
    {
        $crm = Product::where('slug', 'crm')->first();
        $analytics = Product::where('slug', 'analytics')->first();
        $helpdesk = Product::where('slug', 'helpdesk')->first();

        $entries = [
            // CRM entries
            [
                'product_id' => $crm->id,
                'title' => 'AI-Powered Lead Scoring',
                'description' => 'Automatically score and prioritize leads based on engagement signals, firmographic data, and historical conversion patterns. Available on Pro and Enterprise plans.',
                'category' => 'new',
                'version' => '2.4.0',
                'release_date' => now()->subDays(3)->toDateString(),
            ],
            [
                'product_id' => $crm->id,
                'title' => 'Redesigned Pipeline Board',
                'description' => 'The pipeline board now supports inline editing, customizable columns, and weighted deal values. Drag-and-drop performance has been significantly improved.',
                'category' => 'improved',
                'version' => '2.3.2',
                'release_date' => now()->subDays(14)->toDateString(),
            ],
            [
                'product_id' => $crm->id,
                'title' => 'Email Sync Reliability Fix',
                'description' => 'Resolved an issue where emails from certain IMAP providers were not syncing within the expected 5-minute window. All email providers now sync reliably.',
                'category' => 'fixed',
                'version' => '2.3.1',
                'release_date' => now()->subDays(21)->toDateString(),
            ],
            [
                'product_id' => $crm->id,
                'title' => 'Bulk Contact Import Improvements',
                'description' => 'CSV imports now support up to 100,000 rows in a single upload, with duplicate detection and field mapping previews before committing the import.',
                'category' => 'improved',
                'version' => '2.3.0',
                'release_date' => now()->subDays(35)->toDateString(),
            ],
            [
                'product_id' => $crm->id,
                'title' => 'Multi-Currency Deal Tracking',
                'description' => 'Track deals in any currency with automatic exchange rate conversion for reporting. Set a default currency per pipeline or per deal.',
                'category' => 'new',
                'version' => '2.2.0',
                'release_date' => now()->subDays(60)->toDateString(),
            ],

            // Analytics entries
            [
                'product_id' => $analytics->id,
                'title' => 'Real-Time Streaming Dashboards',
                'description' => 'Enterprise plan users can now create dashboards that update in real time via WebSocket connections. Ideal for monitoring live metrics and operational dashboards.',
                'category' => 'new',
                'version' => '1.8.0',
                'release_date' => now()->subDays(7)->toDateString(),
            ],
            [
                'product_id' => $analytics->id,
                'title' => 'Snowflake Connector',
                'description' => 'Added native support for Snowflake as a data source. Connect your Snowflake warehouse and query data directly without ETL pipelines.',
                'category' => 'new',
                'version' => '1.7.0',
                'release_date' => now()->subDays(28)->toDateString(),
            ],
            [
                'product_id' => $analytics->id,
                'title' => 'Dashboard Load Time Optimization',
                'description' => 'Dashboards with more than 10 widgets now load up to 3x faster through parallel query execution and intelligent caching of intermediate results.',
                'category' => 'improved',
                'version' => '1.6.2',
                'release_date' => now()->subDays(42)->toDateString(),
            ],
            [
                'product_id' => $analytics->id,
                'title' => 'Scheduled Report Delivery Failures',
                'description' => 'Fixed an issue where scheduled reports sent to Slack channels would silently fail if the Slack token had been rotated. Reports now retry and alert on delivery failure.',
                'category' => 'fixed',
                'version' => '1.6.1',
                'release_date' => now()->subDays(50)->toDateString(),
            ],
            [
                'product_id' => $analytics->id,
                'title' => 'Embedded Dashboard Theming',
                'description' => 'Embedded dashboards now support full CSS theming including custom fonts, colors, and border radius. Match your product brand perfectly.',
                'category' => 'improved',
                'version' => '1.6.0',
                'release_date' => now()->subDays(70)->toDateString(),
            ],

            // Helpdesk entries
            [
                'product_id' => $helpdesk->id,
                'title' => 'Live Chat Widget',
                'description' => 'Added a lightweight live chat widget that can be embedded on any website. Supports real-time messaging, file attachments, and automatic ticket creation.',
                'category' => 'new',
                'version' => '0.9.0',
                'release_date' => now()->subDays(10)->toDateString(),
            ],
            [
                'product_id' => $helpdesk->id,
                'title' => 'SLA Engine Overhaul',
                'description' => 'Rebuilt the SLA engine to support business hours, holiday calendars, per-customer overrides, and multi-tier escalation rules.',
                'category' => 'improved',
                'version' => '0.8.0',
                'release_date' => now()->subDays(30)->toDateString(),
            ],
            [
                'product_id' => $helpdesk->id,
                'title' => 'Ticket Assignment Bug Fix',
                'description' => 'Resolved a bug where round-robin ticket assignment would skip offline agents instead of reassigning to the next available agent in the rotation.',
                'category' => 'fixed',
                'version' => '0.7.3',
                'release_date' => now()->subDays(45)->toDateString(),
            ],
            [
                'product_id' => $helpdesk->id,
                'title' => 'Knowledge Base Search',
                'description' => 'Added full-text search to the knowledge base with typo tolerance, synonym matching, and result highlighting. Customers can now find answers faster.',
                'category' => 'new',
                'version' => '0.7.0',
                'release_date' => now()->subDays(55)->toDateString(),
            ],
            [
                'product_id' => $helpdesk->id,
                'title' => 'CSAT Survey Improvements',
                'description' => 'Customer satisfaction surveys now support custom questions, emoji-based ratings, and automatic follow-up for negative responses.',
                'category' => 'improved',
                'version' => '0.6.0',
                'release_date' => now()->subDays(75)->toDateString(),
            ],
        ];

        foreach ($entries as $entry) {
            ChangelogEntry::create($entry);
        }
    }
}
