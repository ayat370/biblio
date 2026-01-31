<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Livre;
use App\Models\Auteur;
use App\Models\Categorie;

class LivresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        Livre::truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        // Fetch Authors to map names to IDs
        $authors = Auteur::all()->pluck('id', 'nom');
        // Fetch Categories to map names to IDs
        $categories = Categorie::all()->pluck('id', 'slug');

        $books = [
            // J.K. Rowling
            [
                'titre' => 'Harry Potter a l\'ecole des sorciers',
                'description' => 'The first novel in the Harry Potter series and J. K. Rowling\'s debut novel.',
                'auteur_id' => $authors['Rowling'] ?? 1,
                'categorie_id' => $categories['fantasy'] ?? 1,
                'date_publication' => '1997-06-26',
                'isbn' => '9780747532699',
                'nb_exemplaires' => 5,
                'couverture_path' => 'https://covers.openlibrary.org/b/id/8091563-L.jpg', 
            ],
            [
                'titre' => 'Harry Potter et la Chambre des secrets',
                'description' => 'The second novel in the Harry Potter series.',
                'auteur_id' => $authors['Rowling'] ?? 1,
                'categorie_id' => $categories['fantasy'] ?? 1,
                'date_publication' => '1998-07-02',
                'isbn' => '9780747538493',
                'nb_exemplaires' => 4,
                'couverture_path' => 'https://covers.openlibrary.org/b/id/8107877-L.jpg', 
            ],
            [
                'titre' => 'Harry Potter et le Prisonnier d\'Azkaban',
                'description' => 'The third novel in the Harry Potter series.',
                'auteur_id' => $authors['Rowling'] ?? 1,
                'categorie_id' => $categories['fantasy'] ?? 1,
                'date_publication' => '1999-07-08',
                'isbn' => '9780747542155',
                'nb_exemplaires' => 6,
                'couverture_path' => 'https://covers.openlibrary.org/b/id/10580436-L.jpg', 
            ],
             [
                'titre' => 'Harry Potter et la Coupe de feu',
                'description' => 'The fourth novel in the Harry Potter series.',
                'auteur_id' => $authors['Rowling'] ?? 1,
                'categorie_id' => $categories['fantasy'] ?? 1,
                'date_publication' => '2000-07-08',
                'isbn' => '9780747546245',
                'nb_exemplaires' => 8,
                'couverture_path' => 'https://covers.openlibrary.org/b/id/10523291-L.jpg', 
            ],
            // George R.R. Martin
            [
                'titre' => 'A Game of Thrones',
                'description' => 'The first novel in A Song of Ice and Fire.',
                'auteur_id' => $authors['Martin'] ?? 2,
                'categorie_id' => $categories['fantasy'] ?? 1,
                'date_publication' => '1996-08-01',
                'isbn' => '9780553103540',
                'nb_exemplaires' => 3,
                'couverture_path' => 'https://covers.openlibrary.org/b/id/9269962-L.jpg', 
            ],
            [
                'titre' => 'A Clash of Kings',
                'description' => 'The second novel in A Song of Ice and Fire.',
                'auteur_id' => $authors['Martin'] ?? 2,
                'categorie_id' => $categories['fantasy'] ?? 1,
                'date_publication' => '1998-11-16',
                'isbn' => '9780553108033',
                'nb_exemplaires' => 3,
                'couverture_path' => 'https://covers.openlibrary.org/b/id/6446869-L.jpg', 
            ],
            [
                'titre' => 'A Storm of Swords',
                'description' => 'The third novel in A Song of Ice and Fire.',
                'auteur_id' => $authors['Martin'] ?? 2,
                'categorie_id' => $categories['fantasy'] ?? 1,
                'date_publication' => '2000-08-08',
                'isbn' => '9780553106633',
                'nb_exemplaires' => 2,
                'couverture_path' => 'https://covers.openlibrary.org/b/id/8118671-L.jpg', 
            ],
            // J.R.R. Tolkien
            [
                'titre' => 'The Hobbit',
                'description' => 'A children\'s fantasy novel by J. R. R. Tolkien.',
                'auteur_id' => $authors['Tolkien'] ?? 3,
                'categorie_id' => $categories['fantasy'] ?? 1,
                'date_publication' => '1937-09-21',
                'isbn' => '9780048230025',
                'nb_exemplaires' => 10,
                'couverture_path' => 'https://covers.openlibrary.org/b/id/6979861-L.jpg', 
            ],
             [
                'titre' => 'The Fellowship of the Ring',
                'description' => 'The first volume of The Lord of the Rings.',
                'auteur_id' => $authors['Tolkien'] ?? 3,
                'categorie_id' => $categories['fantasy'] ?? 1,
                'date_publication' => '1954-07-29',
                'isbn' => '9780618002221',
                'nb_exemplaires' => 7,
                'couverture_path' => 'https://covers.openlibrary.org/b/id/13936495-L.jpg', 
            ],
             [
                'titre' => 'The Two Towers',
                'description' => 'The second volume of The Lord of the Rings.',
                'auteur_id' => $authors['Tolkien'] ?? 3,
                'categorie_id' => $categories['fantasy'] ?? 1,
                'date_publication' => '1954-11-11',
                'isbn' => '9780618002238',
                'nb_exemplaires' => 7,
                'couverture_path' => 'https://covers.openlibrary.org/b/id/8394463-L.jpg', 
            ],
              [
                'titre' => 'The Return of the King',
                'description' => 'The third and final volume of The Lord of the Rings.',
                'auteur_id' => $authors['Tolkien'] ?? 3,
                'categorie_id' => $categories['fantasy'] ?? 1,
                'date_publication' => '1955-10-20',
                'isbn' => '9780618002245',
                'nb_exemplaires' => 7,
                'couverture_path' => 'https://covers.openlibrary.org/b/id/10156976-L.jpg', 
            ],
            // Frank Herbert
            [
                'titre' => 'Dune',
                'description' => 'Set on the desert planet Arrakis, Dune is the story of the boy Paul Atreides.',
                'auteur_id' => $authors['Herbert'] ?? 4,
                'categorie_id' => $categories['science-fiction'] ?? 2,
                'date_publication' => '1965-08-01',
                'isbn' => '9780441172719',
                'nb_exemplaires' => 5,
                'couverture_path' => 'https://covers.openlibrary.org/b/id/9103282-L.jpg', 
            ],
             [
                'titre' => 'Dune Messiah',
                'description' => 'The second novel in the Dune Chronicles.',
                'auteur_id' => $authors['Herbert'] ?? 4,
                'categorie_id' => $categories['science-fiction'] ?? 2,
                'date_publication' => '1969-01-01',
                'isbn' => '9780441172696',
                'nb_exemplaires' => 4,
                'couverture_path' => 'https://covers.openlibrary.org/b/id/296582-L.jpg', 
            ],
            // Isaac Asimov
            [
                'titre' => 'Foundation',
                'description' => 'The first book in the Foundation Series.',
                'auteur_id' => $authors['Asimov'] ?? 5,
                'categorie_id' => $categories['science-fiction'] ?? 2,
                'date_publication' => '1951-01-01',
                'isbn' => '9780553293357',
                'nb_exemplaires' => 6,
                'couverture_path' => 'https://covers.openlibrary.org/b/id/8993208-L.jpg', 
            ],
            [
                'titre' => 'I, Robot',
                'description' => 'A fix-up of science fiction short stories or essays.',
                'auteur_id' => $authors['Asimov'] ?? 5,
                'categorie_id' => $categories['science-fiction'] ?? 2,
                'date_publication' => '1950-12-02',
                'isbn' => '9780553294385',
                'nb_exemplaires' => 8,
                'couverture_path' => 'https://covers.openlibrary.org/b/id/7942732-L.jpg', 
            ],
            // George Orwell
            [
                'titre' => '1984',
                'description' => 'A dystopian social science fiction novel.',
                'auteur_id' => $authors['Orwell'] ?? 6,
                'categorie_id' => $categories['science-fiction'] ?? 2,
                'date_publication' => '1949-06-08',
                'isbn' => '9780451524935',
                'nb_exemplaires' => 12,
                'couverture_path' => 'https://covers.openlibrary.org/b/id/7222246-L.jpg', 
            ],
             [
                'titre' => 'Animal Farm',
                'description' => 'A beast fable, in form of satirical allegorical novella.',
                'auteur_id' => $authors['Orwell'] ?? 6,
                'categorie_id' => $categories['roman'] ?? 1,
                'date_publication' => '1945-08-17',
                'isbn' => '9780451526342',
                'nb_exemplaires' => 15,
                'couverture_path' => 'https://covers.openlibrary.org/b/id/11174621-L.jpg', 
            ],
            // Stephen King
            [
                'titre' => 'The Shining',
                'description' => 'A horror novel by American author Stephen King.',
                'auteur_id' => $authors['King'] ?? 7,
                'categorie_id' => $categories['roman'] ?? 1,
                'date_publication' => '1977-01-28',
                'isbn' => '9780385121675',
                'nb_exemplaires' => 4,
                'couverture_path' => 'https://covers.openlibrary.org/b/id/8259445-L.jpg', 
            ],
            [
                'titre' => 'It',
                'description' => 'A horror novel by American author Stephen King.',
                'auteur_id' => $authors['King'] ?? 7,
                'categorie_id' => $categories['roman'] ?? 1,
                'date_publication' => '1986-09-15',
                'isbn' => '9780670813025',
                'nb_exemplaires' => 3,
                'couverture_path' => 'https://covers.openlibrary.org/b/id/8303867-L.jpg', 
            ],
             [
                'titre' => 'Misery',
                'description' => 'A psychological horror thriller novel.',
                'auteur_id' => $authors['King'] ?? 7,
                'categorie_id' => $categories['roman'] ?? 1,
                'date_publication' => '1987-06-08',
                'isbn' => '9780670813643',
                'nb_exemplaires' => 2,
                 'couverture_path' => 'https://covers.openlibrary.org/b/id/6497330-L.jpg', 
            ],
            // Agatha Christie
            [
                'titre' => 'Murder on the Orient Express',
                'description' => 'A detective novel featuring the Belgian detective Hercule Poirot.',
                'auteur_id' => $authors['Christie'] ?? 8,
                'categorie_id' => $categories['policier'] ?? 4,
                'date_publication' => '1934-01-01',
                'isbn' => '9780007119318',
                'nb_exemplaires' => 6,
                'couverture_path' => 'https://covers.openlibrary.org/b/id/8240561-L.jpg', 
            ],
             [
                'titre' => 'And Then There Were None',
                'description' => 'A mystery novel by the English writer Agatha Christie.',
                'auteur_id' => $authors['Christie'] ?? 8,
                'categorie_id' => $categories['policier'] ?? 4,
                'date_publication' => '1939-11-06',
                'isbn' => '9780312330873',
                'nb_exemplaires' => 5,
                'couverture_path' => 'https://covers.openlibrary.org/b/id/10398375-L.jpg', 
            ],
             [
                'titre' => 'The Murder of Roger Ackroyd',
                'description' => 'A detective novel by Agatha Christie associated with her character Hercule Poirot.',
                'auteur_id' => $authors['Christie'] ?? 8,
                'categorie_id' => $categories['policier'] ?? 4,
                'date_publication' => '1926-06-01',
                'isbn' => '9780007119349',
                'nb_exemplaires' => 4,
                'couverture_path' => 'https://covers.openlibrary.org/b/id/8372675-L.jpg', 
            ],
            // Victor Hugo
            [
                'titre' => 'Les Misérables',
                'description' => 'A French historical novel.',
                'auteur_id' => $authors['Hugo'] ?? 9,
                'categorie_id' => $categories['roman'] ?? 1,
                'date_publication' => '1862-01-01',
                'isbn' => '9780451419439',
                'nb_exemplaires' => 8,
                'couverture_path' => 'https://covers.openlibrary.org/b/id/12423351-L.jpg', 
            ],
             [
                'titre' => 'Notre-Dame de Paris',
                'description' => 'A French Romantic/Gothic novel.',
                'auteur_id' => $authors['Hugo'] ?? 9,
                'categorie_id' => $categories['roman'] ?? 1,
                'date_publication' => '1831-03-16',
                'isbn' => '9780140443530',
                'nb_exemplaires' => 5,
                'couverture_path' => 'https://covers.openlibrary.org/b/id/8440097-L.jpg', 
            ],
            // Alexandre Dumas
            [
                'titre' => 'Les Trois Mousquetaires',
                'description' => 'A French historical adventure novel.',
                'auteur_id' => $authors['Dumas'] ?? 10,
                'categorie_id' => $categories['roman'] ?? 1,
                'date_publication' => '1844-01-01',
                'isbn' => '9780199538461',
                'nb_exemplaires' => 10,
                'couverture_path' => 'https://covers.openlibrary.org/b/id/9254716-L.jpg', 
            ],
             [
                'titre' => 'Le Comte de Monte-Cristo',
                'description' => 'An adventure novel widely considered to be one of the authors most popular works.',
                'auteur_id' => $authors['Dumas'] ?? 10,
                'categorie_id' => $categories['roman'] ?? 1,
                'date_publication' => '1844-08-28',
                'isbn' => '9780140449266',
                'nb_exemplaires' => 6,
                'couverture_path' => 'https://covers.openlibrary.org/b/id/12539097-L.jpg', 
            ],
        ];

        foreach ($books as $book) {
            Livre::create($book);
        }
    }
}
