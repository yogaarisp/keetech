<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'icon' => 'desktop_windows',
                'title' => 'IT Service',
                'description' => 'Perbaikan dan maintenance perangkat keras untuk menjaga performa optimal bisnis Anda.',
                'features' => ['Hardware Repair', 'Maintenance', 'OS Installation'],
                'sort_order' => 1,
            ],
            [
                'icon' => 'lan',
                'title' => 'IT Infra',
                'description' => 'Instalasi dan pemeliharaan infrastruktur jaringan serta sistem keamanan terintegrasi.',
                'features' => ['CCTV System', 'Networking', 'Server Setup'],
                'sort_order' => 2,
            ],
            [
                'icon' => 'code',
                'title' => 'IT Programmer',
                'description' => 'Pengembangan software dan aplikasi custom sesuai kebutuhan bisnis Anda.',
                'features' => ['Web & App Dev', 'SaaS Solution', 'Custom Softwares'],
                'sort_order' => 3,
            ],
            [
                'icon' => 'inventory_2',
                'title' => 'Procurement',
                'description' => 'Pengadaan perangkat IT berkualitas dengan harga kompetitif dan garansi resmi.',
                'features' => ['Hardware Supply', 'Device Lifecycle', 'IT Sourcing'],
                'sort_order' => 4,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
