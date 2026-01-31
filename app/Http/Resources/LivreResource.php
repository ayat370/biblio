<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LivreResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'titre' => $this->titre,
            'description' => $this->description,
            'isbn' => $this->isbn,
            'auteur' => [
                'id' => $this->auteur->id,
                'nom_complet' => $this->auteur->nom . ' ' . $this->auteur->prenom,
            ],
            'categorie' => [
                'id' => $this->categorie->id,
                'nom' => $this->categorie->nom,
            ],
            'image' => $this->couverture_path ? asset('storage/' . $this->couverture_path) : null,
            'disponible' => $this->nb_exemplaires > 0,
        ];
    }
}
