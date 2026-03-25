<?php

namespace Database\Seeders;

use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call([
            AnnouncementBarSeeder::class,
            ProductSeeder::class,
            TeamSeeder::class,
            TestimonialSeeder::class,
            TrustLogoSeeder::class,
            BlogSeeder::class,
            ChangelogSeeder::class,
            CareerSeeder::class,
            IntegrationSeeder::class,
            PageSeeder::class,
        ]);
    }
}
