@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8 py-8">
    <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-slate-100">
        <div class="md:flex">
            <!-- Cover Image Section -->
            <div class="md:flex-shrink-0 bg-slate-50 md:w-1/3 flex items-center justify-center p-8 border-r border-slate-100">
                @if($livre->couverture_path)
                    <img class="h-96 w-64 object-cover rounded-lg shadow-lg transform hover:scale-105 transition-transform duration-300" 
                         src="{{ Storage::url($livre->couverture_path) }}" 
                         alt="Couverture de {{ $livre->titre }}">
                @else
                    <div class="h-96 w-64 bg-slate-200 rounded-lg shadow-inner flex flex-col items-center justify-center text-slate-400">
                        <svg class="h-20 w-20 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <span class="text-sm font-medium">Pas de couverture</span>
                    </div>
                @endif
            </div>

            <!-- Details Section -->
            <div class="p-8 md:w-2/3 flex flex-col">
                <div class="flex-1">
                    <div class="flex items-center justify-between">
                        <span class="inline-flex items-center rounded-full bg-indigo-50 px-3 py-1 text-sm font-medium text-indigo-700 ring-1 ring-inset ring-indigo-700/10">
                            {{ $livre->categorie->nom }}
                        </span>
                        <span class="text-sm text-slate-500">ISBN: {{ $livre->isbn ?? 'N/A' }}</span>
                    </div>

                    <h1 class="mt-4 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">{{ $livre->titre }}</h1>
                    <p class="mt-2 text-xl text-slate-600 font-medium">{{ $livre->auteur->nom }}</p>

                    <div class="mt-8 prose prose-slate text-slate-500">
                        <h3 class="text-lg font-semibold text-slate-900 mb-2">Description</h3>
                        <p>{{ $livre->description ?? 'Aucune description disponible pour ce livre.' }}</p>
                    </div>

                    <div class="mt-8 border-t border-slate-100 pt-6">
                        <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                            <div>
                                <dt class="text-sm font-medium text-slate-500">Date de publication</dt>
                                <dd class="mt-1 text-sm text-slate-900">{{ $livre->date_publication ? \Carbon\Carbon::parse($livre->date_publication)->format('d/m/Y') : 'Non précisée' }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-slate-500">Disponibilité</dt>
                                <dd class="mt-1">
                                    @if($livre->disponible())
                                        <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-sm font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                                            Disponible ({{ $livre->nb_exemplaires }} ex.)
                                        </span>
                                    @else
                                        <span class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-sm font-medium text-red-700 ring-1 ring-inset ring-red-600/10">
                                            Indisponible
                                        </span>
                                    @endif
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <div class="mt-10 flex items-center justify-between border-t border-slate-100 pt-8">
                    <a href="{{ route('livres.index') }}" class="text-sm font-semibold leading-6 text-indigo-600 hover:text-indigo-500 flex items-center">
                        <svg class="h-4 w-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M17 10a.75.75 0 01-.75.75H5.612l4.158 3.96a.75.75 0 11-1.04 1.08l-5.5-5.25a.75.75 0 010-1.08l5.5-5.25a.75.75 0 111.04 1.08L5.612 9.25H16.25A.75.75 0 0117 10z" clip-rule="evenodd" />
                        </svg>
                        Retour au catalogue
                    </a>

                    @auth
                        @if($livre->disponible())
                            <form method="POST" action="{{ route('reservations.store') }}">
                                @csrf
                                <input type="hidden" name="livre_id" value="{{ $livre->id }}">
                                <button type="submit" class="inline-flex items-center justify-center rounded-md bg-indigo-600 px-8 py-3 text-base font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-colors">
                                    Réserver ce livre
                                </button>
                            </form>
                        @else
                            <button disabled class="inline-flex items-center justify-center rounded-md bg-slate-100 px-8 py-3 text-base font-semibold text-slate-400 cursor-not-allowed">
                                Non disponible
                            </button>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-md bg-indigo-600 px-8 py-3 text-base font-semibold text-white shadow-sm hover:bg-indigo-500 transition-colors">
                            Connectez-vous pour réserver
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
