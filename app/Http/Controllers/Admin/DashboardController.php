<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Livre;
use App\Models\Reservation;

class DashboardController extends Controller
{
    public function __construct()
    {
        // Middleware pour autoriser seulement les admins
        $this->middleware(['auth', 'is_admin']);
    }

    public function index()
    {
        // Compter les éléments pour le tableau de bord
        $nbUsers = User::count();
        $nbLivres = Livre::count();
        $nbReservations = Reservation::count();

        // Dernières réservations pour affichage
        $recentReservations = Reservation::with('user', 'livre')
                                        ->latest()
                                        ->take(10)
                                        ->get();

        return view('admin.dashboard', compact('nbUsers', 'nbLivres', 'nbReservations', 'recentReservations'));
    }

public function destroy($id)
{
    $emprunteur = Emprunteur::findOrFail($id);
    $emprunteur->delete();

    return back()->with('success', 'Emprunteur supprimé.');
}
}

