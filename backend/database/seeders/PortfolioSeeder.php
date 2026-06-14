<?php

namespace Database\Seeders;

use App\Models\Portfolio;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        $categories = \App\Models\PortfolioCategory::all()->keyBy('name');

        $portfolios = [
            [
                'title' => 'Web POS System Cloud',
                'portfolio_category_id' => $categories['Software Dev']->id,
                'description' => 'Sistem kasir berbasis cloud dengan integrasi stok inventaris real-time untuk jaringan ritel.',
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuA_vGlGCWiMgF914N4TyTAXZNyezWksgrjsmtL3UhUOHBgPV5cHhuc_p40WYVWB4PXkNZlA7JxtmYzn4kAY1lkratGS65be1G6yW5ZkUltTh36wSTd3782DHcnyKC-dTEyKEjy47uuDL3b0SOSOuldqv1fUqbpTi9s5W09taCbP3gA7VeUi9Wy2iWJXLAZSv5WteAT8qgoKpw9fiMYXRJ_QX0FOcjEcJ2DvCEKSbigY8E1yFuXYWTJfT-iwvDmfcsebjdGe4WpqxVTR',
                'client_name' => 'WartegKee',
                'sort_order' => 1,
            ],
            [
                'title' => 'Enterprise CCTV System',
                'portfolio_category_id' => $categories['IT Infra']->id,
                'description' => 'Instalasi keamanan terintegrasi dengan akses remote via mobile untuk gedung perkantoran.',
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBJd8NHp_u9BiqV24Zzu-wPetN2LWM0Zc6Z47DsExfi_sP0JKYOGFl9Ab6PlfC9c0u-xofW1zi4vZYmpdXH96Wa4W9KfDRAQ4dfUmAInsgyVP9d0C60bFDlGW-n8okIG6IPYckuip_N5Nm_l7n6K_wY8ky0_Ece3w7pPeE3AJMwIgLJAXdFTgqCZhpqgfTXaudG9dKsZQm8OLrDhVcbD8F_atbH6c5SemsizXHYbqOmEqGpvq-jTqCFOjnooIw-NXnH-wMEPj7OE5zF',
                'client_name' => 'PT. Gedung Maju',
                'sort_order' => 2,
            ],
            [
                'title' => 'Premium Company Profile',
                'portfolio_category_id' => $categories['Web Design']->id,
                'description' => 'Website profil perusahaan berstandar internasional dengan performa SEO terbaik.',
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCugpEwQKmtTpsr7SGwTVztQgWurf97olzWK-v-Oz6V-Kb_nnG9fbSHaLfSbs6dRapEzrGQAGWo3-tTHUy048t3vYhINIkovtNokJF3LQhs7WKJ3QA8Tz-A95jHQTegHVy445AjssSvQo-86wfVYaEENuUs_HfrjU5chvnwYWIlSSKA7CQOgA7ixIMKyEMAKvCf5SJ0dTIPmegtJTHbqGLNR99AmqZ0Fv1AMSwrKGKrmYiLMt5Ha6DzlJ53ERISd95NAqLOx7807HLJ',
                'client_name' => 'CV. Digital Nusantara',
                'sort_order' => 3,
            ],
        ];

        foreach ($portfolios as $portfolio) {
            Portfolio::create($portfolio);
        }
    }
}
