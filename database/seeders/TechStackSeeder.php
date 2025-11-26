<?php

namespace Database\Seeders;

use App\Models\TechStack;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TechStackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [

            // Bahasa Pemrograman
            [
                'category' => 'Bahasa Pemrograman',
                'name' => 'PHP',
                'icon_class' => 'bi bi-filetype-php',
                'icon_color' => '#777bb3'
            ],
            [
                'category' => 'Bahasa Pemrograman',
                'name' => 'Dart',
                'icon_class' => 'bi bi-filetype-js', // BI tidak punya dart
                'icon_color' => '#0175C2'
            ],
            [
                'category' => 'Bahasa Pemrograman',
                'name' => 'JavaScript',
                'icon_class' => 'bi bi-filetype-js',
                'icon_color' => '#f7df1e'
            ],

            // Pengembangan Web
            [
                'category' => 'Pengembangan Web',
                'name' => 'HTML',
                'icon_class' => 'bi bi-filetype-html',
                'icon_color' => '#e44d26'
            ],
            [
                'category' => 'Pengembangan Web',
                'name' => 'CSS',
                'icon_class' => 'bi bi-filetype-css',
                'icon_color' => '#1572b6'
            ],
            [
                'category' => 'Pengembangan Web',
                'name' => 'Bootstrap',
                'icon_class' => 'bi bi-bootstrap',
                'icon_color' => '#7952b3'
            ],
            [
                'category' => 'Pengembangan Web',
                'name' => 'WordPress',
                'icon_class' => 'bi bi-wordpress',
                'icon_color' => '#21759b'
            ],
            [
                'category' => 'Pengembangan Web',
                'name' => 'Laravel',
                'icon_class' => 'fab fa-laravel', // pakai Laravel icon unofficial
                'icon_color' => '#ff2d20'
            ],

            // Mobile Developer
            [
                'category' => 'Mobile Developer',
                'name' => 'Flutter',
                'icon_class' => 'bi bi-phone', // BI tidak punya flutter
                'icon_color' => '#02569B'
            ],

            // UI/UX
            [
                'category' => 'UI/UX Designer',
                'name' => 'Figma',
                'icon_class' => 'bi bi-palette',
                'icon_color' => '#F24E1E'
            ],

            // Database
            [
                'category' => 'Database',
                'name' => 'MySQL',
                'icon_class' => 'bi bi-database',
                'icon_color' => '#00618A'
            ],
            [
                'category' => 'Database',
                'name' => 'SQLite',
                'icon_class' => 'bi bi-collection',
                'icon_color' => '#003B57'
            ],

            // Version Control
            [
                'category' => 'Version Control',
                'name' => 'Git',
                'icon_class' => 'bi bi-git',
                'icon_color' => '#f05032'
            ],
            [
                'category' => 'Version Control',
                'name' => 'GitHub',
                'icon_class' => 'bi bi-github',
                'icon_color' => '#ffffff'
            ],

            // API & Testing
            [
                'category' => 'API & Testing',
                'name' => 'Postman',
                'icon_class' => 'bi bi-clipboard-data',
                'icon_color' => '#ff6c37'
            ],

            // PaaS
            [
                'category' => 'PaaS',
                'name' => 'Vercel',
                'icon_class' => 'bi bi-triangle-fill',
                'icon_color' => '#000000'
            ],
            [
                'category' => 'PaaS',
                'name' => 'Cloudflare Pages',
                'icon_class' => 'bi bi-cloud-fill',
                'icon_color' => '#f38020'
            ],

            // Serverless
            [
                'category' => 'Serverless',
                'name' => 'Cloudflare Workers',
                'icon_class' => 'bi bi-cloud-lightning-fill',
                'icon_color' => '#f38020'
            ],

            // Web Server
            [
                'category' => 'Web Server',
                'name' => 'Apache',
                'icon_class' => 'bi bi-fire',
                'icon_color' => '#d22128'
            ],

            // Code Editor
            [
                'category' => 'Code Editor',
                'name' => 'Visual Studio Code',
                'icon_class' => 'bi bi-code-square',
                'icon_color' => '#007acc'
            ],
        ];

        foreach ($items as $item) {
            TechStack::create([
                'category' => $item['category'],
                'name' => $item['name'],
                'slug' => Str::slug($item['name']),
                'icon_class' => $item['icon_class'],
                'icon_color' => $item['icon_color'],
            ]);
        }
    }
}
