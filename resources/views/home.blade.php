@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
    <div class="md:flex md:items-center md:justify-between">
        <div class="min-w-0 flex-1">
            <h2 class="text-2xl font-bold leading-7 text-slate-900 sm:truncate sm:text-3xl sm:tracking-tight">
                Bonjour, {{ Auth::user()->name }} !
            </h2>
            <p class="mt-1 text-sm text-slate-500">
                Bienvenue sur votre espace personnel.
            </p>
        </div>
    </div>

    <!-- Quick Actions Grid -->
    <div class="mt-8 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
        <!-- Card 1: Catalogue -->
        <div class="bg-white overflow-hidden shadow rounded-lg hover:shadow-md transition-shadow cursor-pointer border border-slate-100" onclick="window.location='{{ route('livres.index') }}'">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="rounded-md bg-indigo-500 p-3">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-slate-500 truncate">Catalogue</dt>
                            <dd>
                                <div class="text-lg font-medium text-slate-900">Parcourir les livres</div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-slate-50 px-5 py-3">
                <div class="text-sm">
                    <a href="{{ route('livres.index') }}" class="font-medium text-indigo-700 hover:text-indigo-900">Voir tout le catalogue <span aria-hidden="true">&rarr;</span></a>
                </div>
            </div>
        </div>

        <!-- Card 2: Mes Réservations -->
        <div class="bg-white overflow-hidden shadow rounded-lg hover:shadow-md transition-shadow cursor-pointer border border-slate-100" onclick="window.location='{{ route('reservations.index') }}'">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="rounded-md bg-violet-500 p-3">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-slate-500 truncate">Mes Réservations</dt>
                            <dd>
                                <div class="text-lg font-medium text-slate-900">Gérer mes réservations</div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-slate-50 px-5 py-3">
                <div class="text-sm">
                    <a href="{{ route('reservations.index') }}" class="font-medium text-violet-700 hover:text-violet-900">Voir mes réservations <span aria-hidden="true">&rarr;</span></a>
                </div>
            </div>
        </div>

        <!-- Card 3: Mon Profil -->
        <div class="bg-white overflow-hidden shadow rounded-lg hover:shadow-md transition-shadow cursor-pointer border border-slate-100" onclick="window.location='{{ route('profile.edit') }}'">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="rounded-md bg-emerald-500 p-3">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-slate-500 truncate">Mon Profil</dt>
                            <dd>
                                <div class="text-lg font-medium text-slate-900">Mettre à jour mes infos</div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-slate-50 px-5 py-3">
                <div class="text-sm">
                    <a href="{{ route('profile.edit') }}" class="font-medium text-emerald-700 hover:text-emerald-900">Modifier mon profil <span aria-hidden="true">&rarr;</span></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Section or Hero -->
    <div class="mt-8 bg-indigo-50 rounded-2xl p-6 sm:p-10">
        <div class="sm:flex sm:items-center sm:justify-between">
            <div>
                <h3 class="text-lg font-medium text-indigo-900">Besoin de trouver un livre ?</h3>
                <p class="mt-2 text-indigo-700 max-w-2xl">
                    Notre catalogue est mis à jour quotidiennement. Utilisez la recherche pour trouver votre prochain livre préféré.
                </p>
            </div>
            <div class="mt-4 sm:mt-0">
                <a href="{{ route('livres.index') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-indigo-700 bg-white hover:bg-indigo-50 shadow-sm ring-1 ring-indigo-200">
                    Rechercher
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
