<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Emprunt extends Model
{
    use HasFactory;

    protected $fillable = [
        'livre_id',
        'emprunteur_id',
        'date_emprunt',
        'date_retour',
        'etat',
    ];

    public function livre()
    {
        return $this->belongsTo(Livre::class);
    }

    public function emprunteur()
    {
        return $this->belongsTo(Emprunteur::class);
    }
}
