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
        if (! User::where('email', 'dev.abdo.shrief@gmail.com')->exists()) {
            User::create([
                'name' => 'Abdo Shrief',
                'email' => 'dev.abdo.shrief@gmail.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]);
        }

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
