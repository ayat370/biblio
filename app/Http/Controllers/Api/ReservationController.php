<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Http\Resources\ReservationResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    // List user's reservations
    public function index()
    {
        $reservations = Auth::user()->reservations()->with('livre.auteur', 'livre.categorie')->latest()->get();
        return ReservationResource::collection($reservations);
    }

    // Create a new reservation
    public function store(Request $request)
    {
        $request->validate([
            'livre_id' => 'required|exists:livres,id',
        ]);

        // Check active reservations
        $hasActive = Reservation::where('user_id', Auth::id())
            ->whereIn('statut', ['en_attente', 'validee'])
            ->exists();

        if ($hasActive) {
            return response()->json(['message' => 'Vous avez déjà une réservation active.'], 400);
        }

        $reservation = Reservation::create([
            'user_id' => Auth::id(),
            'livre_id' => $request->livre_id,
            'date_debut' => \Carbon\Carbon::now(),
            'date_fin' => \Carbon\Carbon::now()->addDays(15),
            'statut' => 'en_attente',
        ]);

        return new ReservationResource($reservation);
    }
}
