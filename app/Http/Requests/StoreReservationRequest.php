<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;
use App\Models\Reservation;

class StoreReservationRequest extends FormRequest
{
    /**
     * Autoriser tout utilisateur connecté
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Règles de validation
     */
    public function rules()
    {
        return [
            'livre_id' => 'required|exists:livres,id',
            'date_debut' => 'required|date|after_or_equal:today',
            'date_fin' => 'required|date|after:date_debut',
        ];
    }

    /**
     * Validation supplémentaire après les règles
     */
    public function withValidator($validator)
    {
        $validator->after(function ($v) {
            if ($this->user()) {
                $has = Reservation::where('user_id', $this->user()->id)
                    ->whereIn('statut', ['en_attente', 'validee'])
                    ->whereDate('date_fin', '>=', Carbon::today())
                    ->exists();

                if ($has) {
                    $v->errors()->add('reservation', 'Vous avez déjà une réservation active.');
                }
            }
        });
    }
}
