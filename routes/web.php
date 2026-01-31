<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


// Frontend Controllers
use App\Http\Controllers\LivreController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
// Admin Controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LivreController as AdminLivreController;
use App\Http\Controllers\Admin\ReservationController as AdminReservationController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\AuteurController as AdminAuteurController;
use App\Http\Controllers\Admin\CategorieController as AdminCategorieController;
use App\Http\Controllers\Admin\EmpruntController as AdminEmpruntController;
use App\Http\Controllers\Admin\EmprunteurController as AdminEmprunteurController;

/*
|--------------------------------------------------------------------------
| AUTHENTIFICATION
|--------------------------------------------------------------------------
*/
Auth::routes();

/*
|--------------------------------------------------------------------------
| FRONTEND (UTILISATEUR)
|--------------------------------------------------------------------------
*/

// Page d’accueil publique
Route::get('/', [LivreController::class, 'index'])->name('home');

// Livres
Route::get('/livres', [LivreController::class, 'index'])->name('livres.index');
Route::get('/livres/search', [LivreController::class, 'search'])->name('livres.search');
Route::get('/livres/{livre}', [LivreController::class, 'show'])->name('livres.show');




// Réservations (UTILISATEUR CONNECTÉ)
Route::middleware('auth')->group(function () {
    Route::get('/mes-reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Home utilisateur connecté
Route::get('/home', [HomeController::class, 'index'])
    ->middleware('auth')
    ->name('user.home');

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'is_admin'])
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Livres
        Route::resource('livres', AdminLivreController::class);

        // Réservations
        Route::resource('reservations', AdminReservationController::class)->only([
            'index', 'show', 'update', 'destroy'
        ]);

        // Utilisateurs
        Route::resource('users', AdminUserController::class)->except([
            'show'
        ]);

        // Auteurs
        Route::resource('auteurs', AdminAuteurController::class);

        // Catégories
        Route::resource('categories', AdminCategorieController::class);

        // Emprunts
        Route::resource('emprunts', AdminEmpruntController::class);

        // Emprunteurs
        Route::resource('emprunteurs', AdminEmprunteurController::class);
    });
