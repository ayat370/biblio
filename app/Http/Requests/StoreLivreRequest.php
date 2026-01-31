<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLivreRequest extends FormRequest
{
    /**
     * Autoriser uniquement les admins
     */
    public function authorize()
    {
        return auth()->check() && auth()->user()->isAdmin();
    }

    /**
     * Règles de validation
     */
    public function rules()
    {
        return [
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'auteur_id' => 'required|exists:auteurs,id',
            'categorie_id' => 'required|exists:categories,id',
            'date_publication' => 'nullable|date',
            'isbn' => 'nullable|string|max:50|unique:livres,isbn,' . $this->route('livre'),
            'nb_exemplaires' => 'required|integer|min:1',
            'couverture' => 'nullable|image|max:2048', // taille max 2MB
        ];
    }
}
