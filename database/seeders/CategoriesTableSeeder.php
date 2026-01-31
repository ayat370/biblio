<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Categorie;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        Categorie::truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        $categories = [
            ['nom' => 'Roman', 'slug' => 'roman', 'description' => 'Works of fiction that are typically longer and more complex than short stories.'],
            ['nom' => 'Science-Fiction', 'slug' => 'science-fiction', 'description' => 'Stories based on future scientific or technological advances.'],
            ['nom' => 'Fantasy', 'slug' => 'fantasy', 'description' => 'Stories that involve magic and other supernatural phenomena.'],
            ['nom' => 'Policier', 'slug' => 'policier', 'description' => 'Genre of literature enabling the reader to follow a mystery.'],
            ['nom' => 'Histoire', 'slug' => 'histoire', 'description' => 'Works that recount historical events.'],
            ['nom' => 'Biographie', 'slug' => 'biographie', 'description' => 'A detailed description of a person\'s life.'],
            ['nom' => 'Poésie', 'slug' => 'poesie', 'description' => 'Literary work in which special intensity is given to the expression of feelings and ideas.'],
            ['nom' => 'Théâtre', 'slug' => 'theatre', 'description' => 'A play or other activity or presentation considered in terms of its dramatic quality.'],
        ];

        foreach ($categories as $categorie) {
            Categorie::create($categorie);
        }
    }
}
