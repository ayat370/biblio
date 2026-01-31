<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index()
    {
        $categories = Categorie::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate(['nom' => 'required|unique:categories,nom']);
        
        $data = $request->all();
        $data['slug'] = \Illuminate\Support\Str::slug($request->nom);
        
        Categorie::create($data);
        return redirect()->route('admin.categories.index');
    }

    public function edit(Categorie $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Categorie $category)
    {
        $request->validate(['nom' => 'required|unique:categories,nom,'.$category->id]);
        
        $data = $request->all();
        $data['slug'] = \Illuminate\Support\Str::slug($request->nom);
        
        $category->update($data);
        return redirect()->route('admin.categories.index');
    }

    public function destroy(Categorie $category)
    {
        $category->delete();
        return back();
    }
}
