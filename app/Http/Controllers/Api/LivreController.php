<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Livre;
use App\Http\Resources\LivreResource;
use Illuminate\Http\Request;

class LivreController extends Controller
{
    public function index()
    {
        $livres = Livre::with(['auteur', 'categorie'])->paginate(10);
        return LivreResource::collection($livres);
    }

    public function show(Livre $livre)
    {
        return new LivreResource($livre->load(['auteur', 'categorie']));
    }
}
