<?php

namespace App\Http\Controllers;

use App\Models\Livre;
use App\Http\Requests\StoreLivreRequest;
use Illuminate\Http\Request;

class LivreController extends Controller
{
    /**
     * Liste des livres
     */
    public function index(Request $request)
    {
        $query = Livre::with(['auteur', 'categorie']);

        // Search by Title or Author
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('titre', 'LIKE', "%{$search}%")
                  ->orWhereHas('auteur', function($q2) use ($search) {
                      $q2->where('nom', 'LIKE', "%{$search}%");
                  });
            });
        }

        // Filter by Category
        if ($request->has('categorie_id') && $request->categorie_id != '') {
            $query->where('categorie_id', $request->categorie_id);
        }

        $livres = $query->paginate(10)->withQueryString();
        $categories = \App\Models\Categorie::all();

        return view('livres.index', compact('livres', 'categories'));
    }

    public function search(Request $request)
{
    $query = $request->input('q'); // mot recherché

    // Si aucun mot-clé n'est entré
    if (!$query) {
        return redirect()->back()->with('error', 'Veuillez entrer un mot clé.');
    }

    $livres = Livre::where('titre', 'LIKE', "%$query%")
                ->orWhere('description', 'LIKE', "%$query%")
                ->orWhereHas('auteur', function($a){
                    $a->where('nom', 'LIKE', "%".request('q')."%");
                })
                ->orWhereHas('categorie', function($c){
                    $c->where('nom', 'LIKE', "%".request('q')."%");
                })
                ->get();

    return view('livres.search', compact('livres', 'query'));
}

    public function show(Livre $livre)
    {
        return view('livres.show', compact('livre'));
    }

    /**
     * Formulaire d’édition
     */
    

    /**
     * Mettre à jour un livre
     */
    

    /**
     * Supprimer un livre
     */
    
}
