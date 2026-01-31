<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Emprunt;
use App\Models\Livre;
use App\Models\Emprunteur;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EmpruntController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','is_admin']);
    }

    public function index()
    {
        $emprunts = Emprunt::with('livre','emprunteur')->latest()->paginate(20);
        return view('admin.emprunts.index', compact('emprunts'));
    }

    public function create()
    {
        $livres = Livre::all();
        $emprunteurs = Emprunteur::all();
        return view('admin.emprunts.create', compact('livres','emprunteurs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'livre_id' => 'required|exists:livres,id',
            'emprunteur_id' => 'required|exists:emprunteurs,id',
            'date_emprunt' => 'required|date',
            'date_retour' => 'nullable|date|after_or_equal:date_emprunt',
            'etat' => 'required|in:en_cours,rendu,en_retard',
        ]);

        Emprunt::create($request->all());
        return redirect()->route('admin.emprunts.index')->with('success','Emprunt créé.');
    }

    public function edit(Emprunt $emprunt)
    {
        $livres = Livre::all();
        $emprunteurs = Emprunteur::all();
        return view('admin.emprunts.edit', compact('emprunt','livres','emprunteurs'));
    }

    public function update(Request $request, Emprunt $emprunt)
    {
        $request->validate([
            'livre_id' => 'required|exists:livres,id',
            'emprunteur_id' => 'required|exists:emprunteurs,id',
            'date_emprunt' => 'required|date',
            'date_retour' => 'nullable|date|after_or_equal:date_emprunt',
            'etat' => 'required|in:en_cours,rendu,en_retard',
        ]);

        $emprunt->update($request->all());
        return redirect()->route('admin.emprunts.index')->with('success','Emprunt mis à jour.');
    }

    public function destroy(Emprunt $emprunt)
    {
        $emprunt->delete();
        return back()->with('success','Emprunt supprimé.');
    }
}
