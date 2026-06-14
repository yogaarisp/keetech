<?php

namespace Database\Seeders;

use App\Models\PortfolioCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PortfolioCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Software Dev',
            'IT Infra',
            'Web Design',
            'IT Sourcing'
        ];

        foreach ($categories as $category) {
            PortfolioCategory::create([
                'name' => $category,
                'slug' => Str::slug($category),
            ]);
        }
    }
}
