<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Livre;
use App\Http\Requests\StoreReservationRequest;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Liste des réservations de l'utilisateur
     */
    public function index()
    {
        $reservations = Reservation::where('user_id', auth()->id())
            ->with('livre')
            ->latest()
            ->get();

        return view('reservations.index', compact('reservations'));
    }

    /**
     * Formulaire de réservation d'un livre
     */
    

    /**
     * Enregistrer une réservation
     */
    public function store(Request $request)
    {
        // Enforce One-Reservation Limit
        $hasActiveReservation = Reservation::where('user_id', auth()->id())
            ->whereIn('statut', ['en_attente', 'validee'])
            ->exists();

        if ($hasActiveReservation) {
            return back()->with('error', 'Vous avez déjà une réservation en cours. Vous ne pouvez réserver qu\'un seul livre à la fois.');
        }

        // Validate request (livre_id is required)
        $request->validate([
            'livre_id' => 'required|exists:livres,id',
        ]);

        Reservation::create([
            'user_id' => auth()->id(),
            'livre_id' => $request->livre_id,
            'date_debut' => \Carbon\Carbon::now(),
            'date_fin' => \Carbon\Carbon::now()->addDays(15),
            'statut' => 'en_attente',
        ]);

        return redirect()->route('reservations.index')
            ->with('success', 'Réservation envoyée avec succès. En attente de validation.');
    }

    /**
     * Afficher une réservation
     */
    public function show(Reservation $reservation)
    {
        if ($reservation->user_id !== auth()->id()) {
            abort(403, 'Action non autorisée.');
        }

        return view('reservations.show', compact('reservation'));
    }

    /**
     * Annuler une réservation
     */
    public function destroy(Reservation $reservation)
    {
        if ($reservation->user_id !== auth()->id()) {
            abort(403, 'Action non autorisée.');
        }

        $reservation->delete();

        return redirect()->route('reservations.index')
            ->with('success', 'Réservation annulée.');
    }
}
