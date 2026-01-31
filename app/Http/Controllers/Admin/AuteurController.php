<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Auteur;
use Illuminate\Http\Request;

class AuteurController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','is_admin']);
    }

    public function index()
    {
        $auteurs = Auteur::paginate(20);
        return view('admin.auteurs.index', compact('auteurs'));
    }

    public function create()
    {
        return view('admin.auteurs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
        ]);

        Auteur::create($request->all());
        return redirect()->route('admin.auteurs.index')->with('success','Auteur créé.');
    }

    public function edit(Auteur $auteur)
    {
        return view('admin.auteurs.edit', compact('auteur'));
    }

    public function update(Request $request, Auteur $auteur)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
        ]);

        $auteur->update($request->all());
        return redirect()->route('admin.auteurs.index')->with('success','Auteur mis à jour.');
    }

    public function destroy(Auteur $auteur)
    {
        $auteur->delete();
        return back()->with('success','Auteur supprimé.');
    }
}
