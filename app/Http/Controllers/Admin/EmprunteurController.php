<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Emprunteur;
use Illuminate\Http\Request;

class EmprunteurController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','is_admin']);
    }

    public function index()
    {
        $emprunteurs = Emprunteur::paginate(20);
        return view('admin.emprunteurs.index', compact('emprunteurs'));
    }

    public function create()
    {
        return view('admin.emprunteurs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:emprunteurs,email',
            'telephone' => 'nullable|string|max:20',
        ]);

        Emprunteur::create($request->all());
        return redirect()->route('admin.emprunteurs.index')->with('success','Emprunteur créé.');
    }

    public function edit(Emprunteur $emprunteur)
    {
        return view('admin.emprunteurs.edit', compact('emprunteur'));
    }

    public function update(Request $request, Emprunteur $emprunteur)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:emprunteurs,email,' . $emprunteur->id,
            'telephone' => 'nullable|string|max:20',
        ]);

        $emprunteur->update($request->all());
        return redirect()->route('admin.emprunteurs.index')->with('success','Emprunteur mis à jour.');
    }

    public function destroy(Emprunteur $emprunteur)
    {
        $emprunteur->delete();
        return back()->with('success','Emprunteur supprimé.');
    }
}
