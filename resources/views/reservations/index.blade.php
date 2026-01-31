@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Mes réservations</h1>
            <p class="mt-2 text-lg text-slate-600">Suivez le statut de vos demandes de lecture.</p>
        </div>
    </div>

    <div class="mt-8">
        @if($reservations->count() == 0)
        <!-- Empty State with Larger Illustration -->
        <div class="text-center py-16 px-6 sm:px-10 lg:py-24 lg:px-12 bg-white rounded-3xl shadow-xl border border-slate-100 ring-1 ring-slate-900/5">
            <div class="mx-auto w-full max-w-lg text-slate-200">
                <!-- Larger, engaging illustration -->
                <svg viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full drop-shadow-sm">
                    <circle cx="100" cy="100" r="90" fill="#F8FAFC" />
                    <circle cx="100" cy="100" r="70" fill="#F1F5F9" />
                    <!-- Book -->
                    <rect x="50" y="70" width="100" height="70" fill="#94A3B8" rx="6" />
                    <rect x="55" y="75" width="90" height="60" fill="white" rx="4" />
                    <line x1="100" y1="70" x2="100" y2="140" stroke="#64748B" stroke-width="3" />
                    
                    <!-- Text lines -->
                    <path d="M65 90 H90 M65 105 H90 M65 120 H90" stroke="#CBD5E1" stroke-width="3" stroke-linecap="round" />
                    <path d="M110 90 H135 M110 105 H135 M110 120 H135" stroke="#CBD5E1" stroke-width="3" stroke-linecap="round" />
                    
                    <!-- Floating Elements (Stars/Sparks) to make it "not boring" -->
                    <path d="M160 40 L165 50 L175 50 L168 58 L170 68 L160 62 L150 68 L152 58 L145 50 L155 50 Z" fill="#FFD700" />
                    <circle cx="40" cy="160" r="5" fill="#6366F1" />
                    <circle cx="170" cy="150" r="8" fill="#ec4899" opacity="0.5" />
                </svg>
            </div>
            
            <h3 class="mt-8 text-2xl font-bold text-slate-900">C'est un peu vide ici !</h3>
            <p class="mt-4 text-base text-slate-500 max-w-md mx-auto leading-relaxed">
                Vous n'avez pas encore de réservations. Plongez dans notre collection et réservez votre prochaine aventure dès aujourd'hui.
            </p>
            <div class="mt-10">
                <a href="{{ route('livres.index') }}" class="inline-flex items-center px-8 py-3.5 border border-transparent shadow-lg text-base font-semibold rounded-full text-white bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 transition-all transform hover:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="-ml-1 mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    Explorer le catalogue
                </a>
            </div>
        </div>
        @else
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($reservations as $reservation)
            <div class="bg-white overflow-hidden shadow-lg rounded-2xl border border-slate-100 hover:shadow-xl transition-all">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex-shrink-0">
                            <span class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-indigo-100 text-indigo-600">
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </span>
                        </div>
                        @php
                            $statusClasses = [
                                'en_attente' => 'bg-yellow-100 text-yellow-800',
                                'validee' => 'bg-green-100 text-green-800',
                                'annulee' => 'bg-red-100 text-red-800',
                            ];
                            $statusLabels = [
                                'en_attente' => 'En attente',
                                'validee' => 'Validée',
                                'annulee' => 'Annulée',
                            ];
                            $currentStatus = $reservation->statut;
                        @endphp
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $statusClasses[$currentStatus] ?? 'bg-gray-100 text-gray-800' }}">
                            {{ $statusLabels[$currentStatus] ?? ucfirst($currentStatus) }}
                        </span>
                    </div>
                    
                    <h3 class="text-xl font-bold text-slate-900 mb-1">{{ $reservation->livre->titre }}</h3>
                    <p class="text-sm text-slate-500 mb-4">Réservé le {{ $reservation->created_at->format('d/m/Y') }}</p>
                    
                    <div class="border-t border-slate-100 pt-4 mt-4">
                        <form method="POST" action="{{ route('reservations.destroy', $reservation) }}" onsubmit="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-red-700 bg-red-50 hover:bg-red-100 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                <svg class="-ml-1 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Annuler
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>
@endsection
