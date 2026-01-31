<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'livre_id',
        'date_debut',
        'date_fin',
        'statut',
        'admin_comment',
    ];

    // Relation vers User
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    // Relation vers Livre
    public function livre()
    {
        return $this->belongsTo(Livre::class);
    }
}
