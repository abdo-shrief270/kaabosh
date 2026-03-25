<?php

namespace Database\Seeders;

use App\Models\AnnouncementBar;
use Illuminate\Database\Seeder;

class AnnouncementBarSeeder extends Seeder
{
    public function run(): void
    {
        AnnouncementBar::create([
            'message' => 'Kaabosh Forms is launching soon!',
            'cta_label' => 'Join the waitlist',
            'cta_url' => '/products/forms',
            'bg_color' => '#f59e0b',
            'text_color' => '#ffffff',
            'is_active' => true,
        ]);
    }
}
