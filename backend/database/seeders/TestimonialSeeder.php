<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'client_name' => 'Andi Pratama',
                'client_role' => 'CTO, Jaya Retail Group',
                'client_photo' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuC2m4w3to0e2AGf5zSa_3eopJHf_cdVU-1vWwSq1SSRmcNRYs2mIHFPOU3UDz-sskjKtNNFvtwX8zzGxsQuGmsX9tza6f4LS-yK32GMS2t9IKySbDd5Q8mTz1_cUcqYd7ePCBgkZ3D4z1unuXpuMQCrse04gS0Xs9QciEBXf27iidU8VdPtGLS9m1AV0-M2wfRvUrwnc7VH18kYUvg5DRwECzGgj7L-9RzM8sapbJnN7iLLfeWZpC8TqlRI5-zo8Umx8vhtPZT9ydBJ',
                'content' => 'KeeTech membantu kami melakukan migrasi server dengan sangat lancar. Tidak ada downtime berarti, dan tim mereka sangat responsif.',
                'rating' => 5,
                'is_featured' => false,
            ],
            [
                'client_name' => 'Sari Wijaya',
                'client_role' => 'Owner, Coffee House JKT',
                'client_photo' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuA6-9ibvl-35x5YAB_Vls4-38Q4zfeIxdzab7YhPVwPsav-pMvmTSl5woaYQlOPTc8UBeIDlPamUYDvsteWAVrL7mULaxbUga3vxKGaY4qo-2k0q1hzDUQ2-2iOncLfBW-Llm-kWMuINoLpDbLOw7omeqkj8eyDgEUMKMsk0yApbxbK6hwWcTBoNb6Hy8aBcuty_h1it_fxTyZfX5rS3eSfMFUFFyA8rR3ZPremjZ9v5pWMnYw6Hp_55LxQlapQ42lS3gd75sbpI-lc',
                'content' => 'Sistem POS yang dibuat KeeTech sangat user-friendly. Karyawan kami bisa langsung menggunakannya tanpa perlu training lama.',
                'rating' => 5,
                'is_featured' => true,
            ],
            [
                'client_name' => 'Budi Santoso',
                'client_role' => 'Ops Manager, Logistik Maju',
                'client_photo' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBtLe-qEl2P5RwdYo1MHKsYJ58tr4sECPS5UCHuwOGKWBTB1Wy_TR03NDGd0ceWX0vxHs-LfIb0B3DEpbyW98_kqFBocU17Ohe6t-IZp_n_u51cxnOUINUj2vo6WZhkOCwf6m9QPkyhGJexL9rI_4UKfhsxfSF-1sWglqWC37-FGONYGlqCDjbASEW0vYNVzQXTe9Gpu8hoN-AUdowlLN5mNT35qUBdch_OO3EuHYVzSgndLbV-65jnfY56dR4xOFYpXBKMD7h7eQOS',
                'content' => 'Layanan maintenance hardware berkala dari KeeTech membuat operasional kantor kami jauh lebih stabil dan produktif.',
                'rating' => 5,
                'is_featured' => false,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
