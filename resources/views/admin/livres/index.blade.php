@extends('layouts.app')

@section('content')
<div class="sm:flex sm:items-center">
    <div class="sm:flex-auto">
        <h1 class="text-2xl font-bold text-slate-900">Livres</h1>
        <p class="mt-2 text-sm text-slate-700">Une liste de tous les livres de la bibliothèque, y compris leur titre, auteur et statut.</p>
    </div>
    <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
        <a href="{{ route('admin.livres.create') }}" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Nouveau livre
        </a>
    </div>
</div>

<div class="mt-6 bg-white p-4 rounded-lg shadow-sm border border-slate-200">
    <form method="GET" action="{{ route('admin.livres.index') }}" class="sm:flex sm:items-center sm:space-x-4">
        <div class="flex-grow">
            <label for="search" class="sr-only">Rechercher</label>
            <div class="relative rounded-md shadow-sm">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                    <svg class="h-5 w-5 text-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                    </svg>
                </div>
                <input type="text" name="search" id="search" placeholder="Rechercher titre, ISBN ou auteur..." value="{{ request('search') }}" class="block w-full rounded-md border-slate-300 pl-12 py-2 text-slate-900 placeholder-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 sm:text-sm shadow-sm">
            </div>
        </div>
        <div class="mt-2 sm:mt-0 sm:min-w-[200px]">
            <label for="categorie_id" class="sr-only">Catégorie</label>
            <select name="categorie_id" id="categorie_id" class="block w-full rounded-md border-slate-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-sm shadow-sm">
                <option value="">Toutes les catégories</option>
                @foreach($categories as $c)
                    <option value="{{ $c->id }}" {{ request('categorie_id') == $c->id ? 'selected' : '' }}>{{ $c->nom }}</option>
                @endforeach
            </select>
        </div>
        <div class="mt-2 sm:mt-0 flex items-center gap-2">
            <button type="submit" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto transition-colors">
                Filtrer
            </button>
            @if(request('search') || request('categorie_id'))
                <a href="{{ route('admin.livres.index') }}" class="inline-flex items-center justify-center rounded-md border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto transition-colors">
                    Réinitialiser
                </a>
            @endif
        </div>
    </form>
</div>

<div class="mt-8 flex flex-col">
    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                <table class="min-w-full divide-y divide-slate-300">
                    <thead class="bg-slate-50">
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-slate-900 sm:pl-6">Couverture</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900">Titre</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900">Auteur</th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 bg-white">
                        @forelse($livres as $livre)
                        <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                @if($livre->couverture_path)
                                    <img src="{{ Storage::url($livre->couverture_path) }}" alt="" class="h-12 w-8 object-cover rounded shadow-sm border border-slate-200">
                                @else
                                    <div class="h-12 w-8 bg-slate-100 rounded border border-slate-200 flex items-center justify-center text-slate-400 text-xs">IMG</div>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm font-medium text-slate-900">
                                {{ $livre->titre }}
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-500">
                                {{ $livre->auteur->nom }}
                            </td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                <a href="{{ route('admin.livres.edit', $livre) }}" class="text-indigo-600 hover:text-indigo-900">Modifier<span class="sr-only">, {{ $livre->titre }}</span></a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-sm text-slate-500">
                                Aucun livre trouvé.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="mt-4">
    {{ $livres->links() }}
</div>
@endsection
