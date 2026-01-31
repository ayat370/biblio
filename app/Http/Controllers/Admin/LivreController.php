<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLivreRequest;
use App\Models\Livre;
use App\Models\Auteur;
use App\Models\Categorie;
use Illuminate\Http\Request;

class LivreController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'is_admin']);
    }

    public function index(Request $request)
    {
        $query = Livre::with('auteur', 'categorie');

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('titre', 'LIKE', "%{$search}%")
                  ->orWhereHas('auteur', function($q2) use ($search) {
                      $q2->where('nom', 'LIKE', "%{$search}%");
                  });
            });
        }

        if ($request->has('categorie_id') && $request->categorie_id != '') {
            $query->where('categorie_id', $request->categorie_id);
        }

        $livres = $query->paginate(15)->withQueryString();
        $categories = Categorie::all();
        
        return view('admin.livres.index', compact('livres', 'categories'));
    }

    public function create()
    {
        $auteurs = Auteur::all();
        $categories = Categorie::all();
        return view('admin.livres.create', compact('auteurs', 'categories'));
    }

    public function store(StoreLivreRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('couverture')) {
            $data['couverture_path'] = $request->file('couverture')->store('covers','public');
        }

        Livre::create($data);
        return redirect()->route('admin.livres.index')->with('success','Livre créé.');
    }

    public function edit(Livre $livre)
    {
        $auteurs = Auteur::all();
        $categories = Categorie::all();
        return view('admin.livres.edit', compact('livre', 'auteurs', 'categories'));
    }

    public function update(StoreLivreRequest $request, Livre $livre)
    {
        $data = $request->validated();

        if ($request->hasFile('couverture')) {
            $data['couverture_path'] = $request->file('couverture')->store('covers','public');
        }

        $livre->update($data);
        return redirect()->route('admin.livres.index')->with('success','Livre mis à jour.');
    }

    public function destroy(Livre $livre)
    {
        $livre->delete();
        return back()->with('success','Livre supprimé.');
    }
}
