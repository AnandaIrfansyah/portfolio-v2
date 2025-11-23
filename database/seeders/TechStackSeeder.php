<?php

namespace Database\Seeders;

use App\Models\TechStack;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechStackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // ===== Framework / Library =====
            [
                'name' => 'Laravel',
                'slug' => 'laravel',
                'icon_class' => 'fab fa-laravel',
                'category' => 'Framework',
            ],
            [
                'name' => 'TailwindCSS',
                'slug' => 'tailwindcss',
                'icon_class' => 'fab fa-css3-alt', // generic css icon
                'category' => 'CSS Framework',
            ],
            [
                'name' => 'Bootstrap',
                'slug' => 'bootstrap',
                'icon_class' => 'fab fa-bootstrap',
                'category' => 'CSS Framework',
            ],
            [
                'name' => 'jQuery',
                'slug' => 'jquery',
                'icon_class' => 'fas fa-code',
                'category' => 'JavaScript Library',
            ],
            [
                'name' => 'Livewire',
                'slug' => 'livewire',
                'icon_class' => 'bi bi-lightning-charge-fill', // best match
                'category' => 'Framework',
            ],

            // ===== Languages =====
            [
                'name' => 'PHP',
                'slug' => 'php',
                'icon_class' => 'fab fa-php',
                'category' => 'Programming Language',
            ],
            [
                'name' => 'JavaScript',
                'slug' => 'javascript',
                'icon_class' => 'fab fa-js',
                'category' => 'Programming Language',
            ],
            [
                'name' => 'HTML5',
                'slug' => 'html5',
                'icon_class' => 'fab fa-html5',
                'category' => 'Markup Language',
            ],
            [
                'name' => 'CSS3',
                'slug' => 'css3',
                'icon_class' => 'fab fa-css3-alt',
                'category' => 'Style Sheet',
            ],

            // ===== Tools =====
            [
                'name' => 'Git',
                'slug' => 'git',
                'icon_class' => 'fab fa-git-alt',
                'category' => 'Tools',
            ],
            [
                'name' => 'GitHub',
                'slug' => 'github',
                'icon_class' => 'fab fa-github',
                'category' => 'Tools',
            ],
            [
                'name' => 'Composer',
                'slug' => 'composer',
                'icon_class' => 'fas fa-music', // closest match
                'category' => 'Tools',
            ],
            [
                'name' => 'VSCode',
                'slug' => 'vscode',
                'icon_class' => 'fas fa-code',
                'category' => 'Editor',
            ],
            [
                'name' => 'Figma',
                'slug' => 'figma',
                'icon_class' => 'fab fa-figma',
                'category' => 'Design',
            ],

            // ===== Database =====
            [
                'name' => 'MySQL',
                'slug' => 'mysql',
                'icon_class' => 'fas fa-database',
                'category' => 'Database',
            ],
            [
                'name' => 'phpMyAdmin',
                'slug' => 'phpmyadmin',
                'icon_class' => 'fas fa-database',
                'category' => 'Database Tool',
            ],
        ];

        foreach ($data as $item) {
            TechStack::updateOrCreate(
                ['slug' => $item['slug']],
                $item
            );
        }
    }
}
