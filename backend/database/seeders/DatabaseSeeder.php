<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            ServiceSeeder::class,
            PortfolioCategorySeeder::class,
            PortfolioSeeder::class,
            TestimonialSeeder::class,
            SiteSettingSeeder::class,
        ]);
    }
}
