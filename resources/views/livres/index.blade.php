@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
    <div class="sm:flex sm:items-center sm:justify-between">
        <div class="sm:flex-auto">
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Catalogue des livres</h1>
            <p class="mt-2 text-lg text-slate-600">Explorez notre vaste collection et trouvez votre prochaine lecture.</p>
        </div>
    </div>

    <!-- Search Section -->
    <div class="mt-8 bg-white p-6 shadow-lg rounded-2xl border border-slate-100">
        <form method="GET" action="{{ route('livres.index') }}">
            <div class="flex flex-col sm:flex-row gap-4">
                <div class="relative flex-grow">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                        <svg class="h-6 w-6 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </div>
                    <input type="text" name="search" id="search" class="block w-full rounded-xl border-0 py-4 pl-12 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-200 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-lg sm:leading-6 transition-shadow" placeholder="Rechercher par titre ou auteur..." value="{{ request('search') }}">
                </div>
                
                <div class="sm:w-64">
                    <select name="categorie_id" class="block w-full rounded-xl border-0 py-4 pl-4 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-200 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-lg sm:leading-6">
                        <option value="">Toutes les catégories</option>
                        @foreach($categories as $c)
                            <option value="{{ $c->id }}" {{ request('categorie_id') == $c->id ? 'selected' : '' }}>{{ $c->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex-none">
                    <button type="submit" class="h-full w-full sm:w-auto inline-flex items-center justify-center rounded-lg bg-indigo-600 px-6 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-all">
                        Filtrer
                    </button>
                    @if(request('search') || request('categorie_id'))
                        <a href="{{ route('livres.index') }}" class="mt-2 sm:mt-0 sm:ml-2 inline-flex items-center justify-center text-sm font-medium text-slate-500 hover:text-indigo-600">Réinitialiser</a>
                    @endif
                </div>
            </div>
        </form>
    </div>

    <!-- Catalogue Table -->
    <div class="mt-8 flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-md ring-1 ring-black ring-opacity-5 rounded-xl bg-white">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th scope="col" class="py-4 pl-4 pr-3 text-left text-sm font-semibold text-slate-900 sm:pl-6">Titre</th>
                                <th scope="col" class="px-3 py-4 text-left text-sm font-semibold text-slate-900">Auteur</th>
                                <th scope="col" class="px-3 py-4 text-left text-sm font-semibold text-slate-900">Catégorie</th>
                                <th scope="col" class="relative py-4 pl-3 pr-4 sm:pr-6">
                                    <span class="sr-only">Action</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 bg-white">
                            @forelse($livres as $livre)
                            <tr class="hover:bg-slate-50 transition-colors group">
                                <td class="whitespace-nowrap py-5 pl-4 pr-3 text-sm sm:pl-6">
                                    <div class="flex items-center">
                                        <div class="h-16 w-12 flex-shrink-0">
                                            @if($livre->couverture_path)
                                                <img class="h-16 w-12 object-cover rounded shadow-sm border border-slate-200" src="{{ Storage::url($livre->couverture_path) }}" alt="">
                                            @else
                                                <div class="h-16 w-12 bg-slate-100 rounded border border-slate-200 flex items-center justify-center">
                                                    <svg class="h-6 w-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="font-medium text-slate-900 group-hover:text-indigo-600 transition-colors">{{ $livre->titre }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-5 text-sm text-slate-600">
                                    {{ $livre->auteur->nom }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-5 text-sm text-slate-500">
                                    <span class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-700 border border-slate-200">
                                        {{ $livre->categorie->nom }}
                                    </span>
                                </td>
                                <td class="relative whitespace-nowrap py-5 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                    <a href="{{ route('livres.show', $livre) }}" class="text-indigo-600 hover:text-indigo-900 font-semibold hover:underline">
                                        Voir détails<span class="sr-only">, {{ $livre->titre }}</span>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-24 text-center">
                                    <div class="mx-auto h-80 w-80 text-slate-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="0.5" stroke="currentColor" class="w-full h-full">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                        </svg>
                                    </div>
                                    <h3 class="mt-6 text-2xl font-bold text-slate-900">Aucun livre trouvé</h3>
                                    <p class="mt-2 text-lg text-slate-500">Nous n'avons trouvé aucun résultat correspondant à votre recherche.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
