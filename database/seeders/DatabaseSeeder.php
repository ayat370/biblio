<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Auteur;
use App\Models\Categorie;
use App\Models\Livre;
use App\Models\Emprunteur;
use App\Models\Emprunt;
use App\Models\Reservation;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1️⃣ Users (admin + users normaux)
        User::firstOrCreate(
            ['email' => 'admin@bibliotheque.com'], // Vérifie si l'admin existe déjà
            [
                'name' => 'Admin',
                'role' => 'admin',
                'password' => bcrypt('password'),
            ]
        );

        User::factory(5)->create();

        // 2️⃣ Call Custom Seeders
        $this->call([
            AuteursTableSeeder::class,
            CategoriesTableSeeder::class,
            LivresTableSeeder::class,
        ]);
        
        // 3️⃣ Emprunteurs
        Schema::disableForeignKeyConstraints();
        \DB::table('emprunteurs')->truncate();
        Schema::enableForeignKeyConstraints();
        Emprunteur::factory(15)->create();

        // 4️⃣ Emprunts (chaque emprunt lié à un emprunteur et un livre)
        Schema::disableForeignKeyConstraints();
        \DB::table('emprunts')->truncate();
        Schema::enableForeignKeyConstraints();
        
        // Ensure we have books and borrowers before creating loans
        if (Livre::count() > 0 && Emprunteur::count() > 0) {
             Emprunt::factory(30)->create()->each(function($emprunt) {
                $emprunt->livre_id = Livre::inRandomOrder()->first()->id;
                $emprunt->emprunteur_id = Emprunteur::inRandomOrder()->first()->id;
                $emprunt->save();
            });
        }
       

        // 5️⃣ Réservations (chaque réservation liée à un utilisateur et un livre)
        Schema::disableForeignKeyConstraints();
        \DB::table('reservations')->truncate();
        Schema::enableForeignKeyConstraints();
        
        // Ensure we have books and users before creating reservations
         if (Livre::count() > 0 && User::count() > 0) {
            Reservation::factory(20)->create()->each(function($reservation) {
                $reservation->livre_id = Livre::inRandomOrder()->first()->id;
                $reservation->user_id = User::inRandomOrder()->first()->id;
                $reservation->save();
            });
         }
    }
}
