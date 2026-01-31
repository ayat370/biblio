<?php

namespace App\Http\Middleware;

use Illuminate\Routing\Middleware\ThrottleRequests as Middleware;

class ThrottleRequests extends Middleware
{
    /**
     * Définir le nombre maximum de tentatives et le temps de decay.
     * Par défaut Laravel utilise 60 requêtes par minute.
     */

    protected $maxAttempts = 60;      // Nombre maximum de requêtes
    protected $decayMinutes = 1;      // Temps en minutes avant de réinitialiser le compteur

    // Tu peux aussi surcharger la méthode handle si tu veux une logique personnalisée
    // public function handle($request, \Closure $next, $maxAttempts = 60, $decayMinutes = 1, $prefix = '')
    // {
    //     return parent::handle($request, $next, $maxAttempts, $decayMinutes, $prefix);
    // }
}
