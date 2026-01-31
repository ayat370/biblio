@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 md:px-8">
    <div class="md:flex md:items-center md:justify-between mb-8">
        <div class="min-w-0 flex-1">
            <h2 class="text-2xl font-bold leading-7 text-slate-900 sm:truncate sm:text-3xl sm:tracking-tight">
                Modifier un auteur
            </h2>
        </div>
    </div>

    <div class="bg-white shadow-lg rounded-2xl border border-slate-100 overflow-hidden">
        <form method="POST" action="{{ route('admin.auteurs.update', $auteur) }}">
            @csrf
            @method('PUT')
            
            <div class="p-6 space-y-6 sm:p-8">
                <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="nom" class="block text-sm font-medium leading-6 text-slate-900">Nom</label>
                        <div class="mt-2">
                            <input type="text" name="nom" id="nom" value="{{ old('nom', $auteur->nom) }}" required class="block w-full rounded-md border border-slate-300 py-2 px-3 text-slate-900 shadow-sm placeholder:text-slate-400 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-slate-50 px-6 py-4 flex items-center justify-end gap-x-4 sm:px-8">
                <a href="{{ route('admin.auteurs.index') }}" class="text-sm font-semibold leading-6 text-slate-900 hover:text-slate-700">Annuler</a>
                <button type="submit" class="inline-flex justify-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
