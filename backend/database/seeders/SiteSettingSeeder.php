<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // General
            ['key' => 'company_name', 'value' => 'KeeTech', 'group' => 'general'],
            ['key' => 'company_tagline', 'value' => 'Solusi Digital Terpadu untuk Bisnis Anda', 'group' => 'general'],
            ['key' => 'company_description', 'value' => 'Penyedia solusi IT komprehensif yang mengedepankan kualitas, transparansi, dan inovasi masa depan untuk bisnis Indonesia.', 'group' => 'general'],
            ['key' => 'company_logo', 'value' => null, 'group' => 'general'],
            ['key' => 'company_favicon', 'value' => null, 'group' => 'general'],

            // Hero Section
            ['key' => 'hero_badge', 'value' => '✦ IT SERVICE & SOFTWARE DEVELOPER PROFESIONAL ✦', 'group' => 'hero'],
            ['key' => 'hero_title', 'value' => 'Solusi Digital <span>Terpadu</span> untuk Bisnis Anda', 'group' => 'hero'],
            ['key' => 'hero_description', 'value' => 'Kami menyediakan layanan IT lengkap — mulai dari perbaikan hardware, infrastruktur jaringan, hingga pengembangan software dan pengadaan perangkat IT.', 'group' => 'hero'],
            ['key' => 'hero_image', 'value' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCIl5hoAzy8INzWtmGt1XM4TFquA9MKQYaREd-_R7ui-3DK_1nRJPEsfOHiG8mZNGpR6DZusQb3tez5Dvt3NtDhXcSrlmEqiQ3_p17TmNiTqtL_1hO_tuGt75tvr2TWnzZtPQdjYTjzkhaZPwMEw1VqDeiVliRUkIZjXVpXStNJMSf4MQ_qRa3MwFs8AMFGsUAFK1Fo-dmdmd7pzihHJk-AUeVzSfKY2NHo9FmM1LjFauySW0hrii9Xv-Wk9NlgFbv_CQyuWc0IIwhi', 'group' => 'hero'],
            ['key' => 'hero_cta_primary_text', 'value' => 'Konsultasi Gratis', 'group' => 'hero'],
            ['key' => 'hero_cta_primary_link', 'value' => '#kontak', 'group' => 'hero'],
            ['key' => 'hero_cta_secondary_text', 'value' => 'Lihat Layanan', 'group' => 'hero'],
            ['key' => 'hero_cta_secondary_link', 'value' => '#layanan', 'group' => 'hero'],
            ['key' => 'hero_floating_title', 'value' => 'Terpercaya', 'group' => 'hero'],
            ['key' => 'hero_floating_subtitle', 'value' => 'ISO 27001 Certified', 'group' => 'hero'],

            // About Section
            ['key' => 'about_heading', 'value' => 'Mengapa Memilih KeeTech?', 'group' => 'about'],
            ['key' => 'about_image', 'value' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBHqP99601yHucGH8xXrprN4LmD7jXf2SaupqYmYuWkLS40cqrr6UDo-0PEOvTsALGh1RxtVCJoq8pOAwBSIrEhOCbNNpKre9nGULK9g4Q3TUoB2JHrJILCYOqwaKJothu6hmkNG9UVTfApp21w3fPux3nzpIkWIINAg88pCBl9oOnLqISX-wTkPf0am3TbIq1Jq8-C9U_e30Jzvo3b54aB1h4zn3eZU7nKkJ_IvutrE-Y_K_RuB6MvtQRI6PHFtAzNDxQ4ES4vdkF0', 'group' => 'about'],
            ['key' => 'about_experience_years', 'value' => '5+', 'group' => 'about'],

            // Contact
            ['key' => 'company_address', 'value' => 'Jl. Teknologi Raya No. 42, Jakarta Selatan, Indonesia', 'group' => 'contact'],
            ['key' => 'company_phone', 'value' => '+62 812-3456-7890', 'group' => 'contact'],
            ['key' => 'company_email', 'value' => 'hello@keetech.co.id', 'group' => 'contact'],
            ['key' => 'company_whatsapp', 'value' => '6281234567890', 'group' => 'contact'],

            // Social
            ['key' => 'social_instagram', 'value' => 'https://instagram.com/keetech', 'group' => 'social'],
            ['key' => 'social_facebook', 'value' => 'https://facebook.com/keetech', 'group' => 'social'],
            ['key' => 'social_linkedin', 'value' => 'https://linkedin.com/company/keetech', 'group' => 'social'],
            ['key' => 'social_whatsapp', 'value' => 'https://wa.me/6281234567890', 'group' => 'social'],

            // Stats
            ['key' => 'stat_experience', 'value' => '5+', 'group' => 'stats'],
            ['key' => 'stat_clients', 'value' => '50+', 'group' => 'stats'],
            ['key' => 'stat_projects', 'value' => '200+', 'group' => 'stats'],
            ['key' => 'stat_satisfaction', 'value' => '99%', 'group' => 'stats'],
            ['key' => 'stat_support', 'value' => '24/7', 'group' => 'stats'],

            // Why Choose Us
            ['key' => 'why_title_1', 'value' => 'Harga Transparan', 'group' => 'features'],
            ['key' => 'why_desc_1', 'value' => 'Tidak ada biaya tersembunyi. Semua estimasi diberikan secara jujur dan detail.', 'group' => 'features'],
            ['key' => 'why_title_2', 'value' => 'Dukungan 24/7', 'group' => 'features'],
            ['key' => 'why_desc_2', 'value' => 'Tim teknis kami selalu siap siaga membantu operasional bisnis Anda kapanpun.', 'group' => 'features'],
            ['key' => 'why_title_3', 'value' => 'Garansi Layanan', 'group' => 'features'],
            ['key' => 'why_desc_3', 'value' => 'Kami menjamin kualitas setiap pekerjaan dengan perlindungan garansi resmi.', 'group' => 'features'],

            // Footer
            ['key' => 'footer_description', 'value' => 'Penyedia solusi IT komprehensif yang mengedepankan kualitas, transparansi, dan inovasi masa depan untuk bisnis Indonesia.', 'group' => 'footer'],
            ['key' => 'footer_copyright', 'value' => '© 2026 KeeTech Professional IT Services. All rights reserved.', 'group' => 'footer'],

            // Webhook
            ['key' => 'n8n_webhook_url', 'value' => null, 'group' => 'webhook'],
        ];

        foreach ($settings as $setting) {
            // Hanya buat jika key belum ada di database
            // Ini mencegah data yang sudah Anda ubah di admin tertimpa kembali ke default
            if (!SiteSetting::where('key', $setting['key'])->exists()) {
                SiteSetting::create($setting);
            }
        }
    }
}
