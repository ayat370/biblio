@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-bold text-slate-900">Gestion des réservations</h1>
            <p class="mt-2 text-sm text-slate-700">Vue d'ensemble des réservations en cours.</p>
        </div>
    </div>

    <div class="mt-8 flex flex-col">
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                    <table class="min-w-full divide-y divide-slate-300">
                        <thead class="bg-slate-50">
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-slate-900 sm:pl-6">Utilisateur</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900">Livre</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900">Statut</th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 bg-white">
                            @foreach($reservations as $r)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-slate-900 sm:pl-6">
                                    {{ $r->user->name }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-700">
                                    {{ $r->livre->titre }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-700">
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
                                    @endphp
                                    <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium 
                                        {{ $statusClasses[$r->statut] ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ $statusLabels[$r->statut] ?? ucfirst($r->statut) }}
                                    </span>
                                </td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                    <div class="flex justify-end gap-2">
                                        @if($r->statut === 'en_attente')
                                            <form action="{{ route('admin.reservations.update', $r) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="statut" value="validee">
                                                <button type="submit" class="text-green-600 hover:text-green-900 font-semibold">Valider</button>
                                            </form>
                                            <form action="{{ route('admin.reservations.update', $r) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="statut" value="annulee">
                                                <button type="submit" class="text-red-600 hover:text-red-900 font-semibold" onclick="return confirm('Refuser cette réservation ?')">Refuser</button>
                                            </form>
                                        @elseif($r->statut === 'validee')
                                            <form action="{{ route('admin.reservations.update', $r) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="statut" value="annulee">
                                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Annuler cette réservation ?')">Annuler</button>
                                            </form>
                                        @endif
                                        
                                        <form action="{{ route('admin.reservations.destroy', $r) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer définitivement ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-slate-400 hover:text-slate-600 ml-2">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
