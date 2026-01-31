@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 md:px-8">
    <div class="md:flex md:items-center md:justify-between mb-8">
        <div class="min-w-0 flex-1">
            <h2 class="text-2xl font-bold leading-7 text-slate-900 sm:truncate sm:text-3xl sm:tracking-tight">
                Ajouter un livre
            </h2>
        </div>
    </div>

    <div class="bg-white shadow-lg rounded-2xl border border-slate-100 overflow-hidden">
        <form method="POST" action="{{ route('admin.livres.store') }}" enctype="multipart/form-data">
            @csrf
            
            <div class="p-6 space-y-6 sm:p-8">
                <!-- Titre -->
                <div>
                    <label for="titre" class="block text-sm font-medium leading-6 text-slate-900">Titre</label>
                    <div class="mt-2">
                        <input type="text" name="titre" id="titre" value="{{ old('titre') }}" class="block w-full rounded-md border border-slate-300 bg-white py-2 px-3 text-slate-900 shadow-sm placeholder:text-slate-400 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-sm sm:leading-6 @error('titre') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror" required>
                        @error('titre')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Auteur & Catégorie -->
                <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                    <div>
                        <label for="auteur_id" class="block text-sm font-medium leading-6 text-slate-900">Auteur</label>
                        <div class="mt-2">
                            <select id="auteur_id" name="auteur_id" class="block w-full rounded-md border border-slate-300 bg-white py-2 px-3 text-slate-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-sm sm:leading-6">
                                @foreach($auteurs as $a)
                                    <option value="{{ $a->id }}">{{ $a->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="categorie_id" class="block text-sm font-medium leading-6 text-slate-900">Catégorie</label>
                        <div class="mt-2">
                            <select id="categorie_id" name="categorie_id" class="block w-full rounded-md border border-slate-300 bg-white py-2 px-3 text-slate-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-sm sm:leading-6">
                                @foreach($categories as $c)
                                    <option value="{{ $c->id }}">{{ $c->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium leading-6 text-slate-900">Description</label>
                    <div class="mt-2">
                        <textarea id="description" name="description" rows="3" class="block w-full rounded-md border border-slate-300 bg-white py-2 px-3 text-slate-900 shadow-sm placeholder:text-slate-400 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-sm sm:leading-6">{{ old('description') }}</textarea>
                    </div>
                </div>

                <!-- Date, ISBN, Exemplaires -->
                <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-3">
                    <div>
                        <label for="date_publication" class="block text-sm font-medium leading-6 text-slate-900">Date de publication</label>
                        <div class="mt-2">
                            <input type="date" name="date_publication" id="date_publication" value="{{ old('date_publication') }}" class="block w-full rounded-md border border-slate-300 bg-white py-2 px-3 text-slate-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                    <div>
                        <label for="isbn" class="block text-sm font-medium leading-6 text-slate-900">ISBN</label>
                        <div class="mt-2">
                            <input type="text" name="isbn" id="isbn" value="{{ old('isbn') }}" class="block w-full rounded-md border border-slate-300 bg-white py-2 px-3 text-slate-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                    <div>
                        <label for="nb_exemplaires" class="block text-sm font-medium leading-6 text-slate-900">Exemplaires</label>
                        <div class="mt-2">
                            <input type="number" name="nb_exemplaires" id="nb_exemplaires" min="1" value="{{ old('nb_exemplaires', 1) }}" class="block w-full rounded-md border border-slate-300 bg-white py-2 px-3 text-slate-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                </div>

                <!-- Photo de couverture -->
                <div>
                    <label for="couverture" class="block text-sm font-medium leading-6 text-slate-900">Photo de couverture</label>
                    <div class="mt-2">
                        <input type="file" name="couverture" id="couverture" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    </div>
                </div>

            </div>

            <div class="bg-slate-50 px-6 py-4 flex items-center justify-end sm:px-8">
                <a href="{{ route('admin.livres.index') }}" class="text-sm font-semibold leading-6 text-slate-900 mr-4">Annuler</a>
                <button type="submit" class="inline-flex justify-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Créer le livre
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
