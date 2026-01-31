<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Auteur;

class AuteursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks to allow truncation
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        Auteur::truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        $auteurs = [
            ['nom' => 'Rowling', 'prenom' => 'J.K.', 'bio' => 'British author, philanthropist, film producer, television producer, and screenwriter.', 'date_naissance' => '1965-07-31'],
            ['nom' => 'Martin', 'prenom' => 'George R.R.', 'bio' => 'American novelist and short story writer, screenwriter, and television producer.', 'date_naissance' => '1948-09-20'],
            ['nom' => 'Tolkien', 'prenom' => 'J.R.R.', 'bio' => 'English writer, poet, philologist, and academic.', 'date_naissance' => '1892-01-03'],
            ['nom' => 'Herbert', 'prenom' => 'Frank', 'bio' => 'American science fiction author.', 'date_naissance' => '1920-10-08'],
            ['nom' => 'Asimov', 'prenom' => 'Isaac', 'bio' => 'American writer and professor of biochemistry at Boston University.', 'date_naissance' => '1920-01-02'],
            ['nom' => 'Orwell', 'prenom' => 'George', 'bio' => 'English novelist, essayist, journalist and critic.', 'date_naissance' => '1903-06-25'],
            ['nom' => 'King', 'prenom' => 'Stephen', 'bio' => 'American author of horror, supernatural fiction, suspense, crime, science-fiction, and fantasy novels.', 'date_naissance' => '1947-09-21'],
            ['nom' => 'Christie', 'prenom' => 'Agatha', 'bio' => 'English writer known for her sixty-six detective novels and fourteen short story collections.', 'date_naissance' => '1890-09-15'],
            ['nom' => 'Hugo', 'prenom' => 'Victor', 'bio' => 'French poet, novelist, and dramatist of the Romantic movement.', 'date_naissance' => '1802-02-26'],
            ['nom' => 'Dumas', 'prenom' => 'Alexandre', 'bio' => 'French writer. His works have been translated into many languages, and he is one of the most widely read French authors.', 'date_naissance' => '1802-07-24'],
        ];

        foreach ($auteurs as $auteur) {
            Auteur::create($auteur);
        }
    }
}
