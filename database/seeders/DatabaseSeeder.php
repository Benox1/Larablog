<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $categories = [
            'Technologie',
            'Sport',
            'Jeux vidéo',
            'Cinéma',
            'Musique',
            'IA',
            'Développement',
            'Informatique'
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create(['name' => $category]);
        }
    }
}
