<?php

namespace Database\Seeders;

use App\Models\TrustLogo;
use Illuminate\Database\Seeder;

class TrustLogoSeeder extends Seeder
{
    public function run(): void
    {
        $logos = [
            ['name' => 'Meridian Digital', 'image_url' => '/images/logos/meridian-digital.svg', 'alt_text' => 'Meridian Digital logo', 'sort_order' => 1],
            ['name' => 'Skyline Technologies', 'image_url' => '/images/logos/skyline-technologies.svg', 'alt_text' => 'Skyline Technologies logo', 'sort_order' => 2],
            ['name' => 'NovaBridge', 'image_url' => '/images/logos/novabridge.svg', 'alt_text' => 'NovaBridge logo', 'sort_order' => 3],
            ['name' => 'Vertex Solutions', 'image_url' => '/images/logos/vertex-solutions.svg', 'alt_text' => 'Vertex Solutions logo', 'sort_order' => 4],
            ['name' => 'Arcadia Group', 'image_url' => '/images/logos/arcadia-group.svg', 'alt_text' => 'Arcadia Group logo', 'sort_order' => 5],
            ['name' => 'CloudFirst Inc.', 'image_url' => '/images/logos/cloudfirst.svg', 'alt_text' => 'CloudFirst Inc. logo', 'sort_order' => 6],
            ['name' => 'Pinnacle Ventures', 'image_url' => '/images/logos/pinnacle-ventures.svg', 'alt_text' => 'Pinnacle Ventures logo', 'sort_order' => 7],
            ['name' => 'Atlas Commerce', 'image_url' => '/images/logos/atlas-commerce.svg', 'alt_text' => 'Atlas Commerce logo', 'sort_order' => 8],
        ];

        foreach ($logos as $logo) {
            TrustLogo::create(array_merge($logo, [
                'context' => 'homepage',
                'is_active' => true,
            ]));
        }
    }
}
