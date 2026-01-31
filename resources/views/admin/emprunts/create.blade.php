@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50/50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        
        <!-- Main Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            
            <!-- Header Section with Pattern -->
            <div class="bg-indigo-600 px-8 py-10 relative overflow-hidden">
                <!-- Background Decoration -->
                <svg class="absolute right-0 top-0 h-full w-48 text-indigo-500 opacity-20 transform translate-x-10 -translate-y-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M4 6h16v12H4z" fill="none"/> <!-- spacer -->
                    <path d="M18 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM6 4h5v8l-2.5-1.5L6 12V4z"/>
                </svg>

                <div class="relative z-10">
                    <h1 class="text-3xl font-bold text-white tracking-tight">Enregistrer un emprunt</h1>
                    <p class="mt-2 text-indigo-100 text-lg max-w-xl">
                        Créer une nouvelle fiche de prêt pour un adhérent de la bibliothèque.
                    </p>
                </div>
            </div>

            <!-- Form Section -->
            <form method="POST" action="{{ route('admin.emprunts.store') }}" class="px-8 py-10">
                @csrf
                
                <div class="space-y-8">
                    
                    <!-- Section: Sélection -->
                    <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                        
                        <!-- Input: Livre -->
                        <div class="md:col-span-2">
                            <label for="livre_id" class="block text-sm font-semibold text-gray-700 mb-2">
                                Sélectionner un livre
                            </label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                                <select id="livre_id" name="livre_id" class="block w-full pl-10 pr-10 py-3 bg-gray-50 border border-gray-300 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent focus:bg-white transition duration-200 sm:text-sm appearance-none">
                                    <option value="" disabled selected>Rechercher par titre ou ISBN...</option>
                                    @foreach($livres as $livre)
                                        <option value="{{ $livre->id }}">{{ $livre->titre }}</option>
                                    @endforeach
                                </select>
                                <!-- Custom Chevron -->
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            @error('livre_id') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <!-- Input: Emprunteur -->
                        <div class="md:col-span-2">
                            <label for="emprunteur_id" class="block text-sm font-semibold text-gray-700 mb-2">
                                Emprunteur
                            </label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <select id="emprunteur_id" name="emprunteur_id" class="block w-full pl-10 pr-10 py-3 bg-gray-50 border border-gray-300 rounded-xl text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent focus:bg-white transition duration-200 sm:text-sm appearance-none">
                                    <option value="" disabled selected>Choisir un membre...</option>
                                    @foreach($emprunteurs as $emprunteur)
                                        <option value="{{ $emprunteur->id }}">{{ $emprunteur->nom }} {{ $emprunteur->prenom }}</option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            @error('emprunteur_id') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <!-- Details Row -->
                        <div class="md:col-span-1">
                            <label for="date_emprunt" class="block text-sm font-semibold text-gray-700 mb-2">
                                Date de sortie
                            </label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <input type="date" name="date_emprunt" id="date_emprunt" value="{{ old('date_emprunt', date('Y-m-d')) }}" class="block w-full pl-10 py-3 bg-gray-50 border border-gray-300 rounded-xl text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent focus:bg-white transition duration-200 sm:text-sm">
                            </div>
                            @error('date_emprunt') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-1">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                État initial
                            </label>
                            <div class="w-full h-[46px] px-4 bg-emerald-50 border border-emerald-100 rounded-xl flex items-center">
                                <span class="flex h-3 w-3 relative mr-3">
                                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                  <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                                </span>
                                <span class="text-sm font-medium text-emerald-800">Emprunt actif (En cours)</span>
                            </div>
                            <input type="hidden" name="etat" value="en_cours">
                        </div>
                    </div>

                </div>

                <!-- Footer / Actions -->
                <div class="pt-10 flex items-center justify-end space-x-4">
                    <a href="{{ route('admin.emprunts.index') }}" class="px-5 py-2.5 rounded-xl text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition duration-200">
                        Annuler
                    </a>
                    <button type="submit" class="inline-flex items-center justify-center px-8 py-2.5 border border-transparent rounded-xl shadow-lg shadow-indigo-500/30 text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transform hover:-translate-y-0.5 transition-all duration-200">
                        <svg class="w-5 h-5 mr-2 -ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Confirmer l'emprunt
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Helper text below card -->
        <p class="text-center text-sm text-gray-400 mt-6">
            Les champs marqués sont obligatoires pour la gestion du stock.
        </p>
    </div>
</div>
@endsection