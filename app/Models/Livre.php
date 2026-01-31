<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Livre extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description',
        'auteur_id',
        'categorie_id',
        'date_publication',
        'isbn',
        'nb_exemplaires',
        'couverture_path',
    ];

    // Relation vers Auteur
    public function auteur()
    {
        return $this->belongsTo(Auteur::class);
    }

    // Relation vers Categorie
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    // Relation vers Reservation
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    // Vérifie si le livre est disponible
    public function disponible()
    {
        $active = $this->reservations()
            ->where('statut', 'validee')
            ->whereDate('date_fin', '>=', Carbon::today())
            ->count();

        return $this->nb_exemplaires > $active;
    }
}
