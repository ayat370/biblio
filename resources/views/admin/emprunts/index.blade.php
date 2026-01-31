@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-bold text-slate-900">Gestion des emprunts</h1>
            <p class="mt-2 text-sm text-slate-700">Suivi des livres empruntés.</p>
        </div>
        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
            <a href="{{ route('admin.emprunts.create') }}" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                </svg>
                Nouvel emprunt
            </a>
        </div>
    </div>

    <div class="mt-8 flex flex-col">
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                    <table class="min-w-full divide-y divide-slate-300">
                        <thead class="bg-slate-50">
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-slate-900 sm:pl-6">Livre</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900">Emprunteur</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900">Sortie</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900">Retour / Échéance</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900">Etat</th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 bg-white">
                            @foreach($emprunts as $emprunt)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-slate-900 sm:pl-6">
                                    {{ $emprunt->livre->titre }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-700">
                                    {{ $emprunt->emprunteur->nom }} {{ $emprunt->emprunteur->prenom }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-700">
                                    {{ \Carbon\Carbon::parse($emprunt->date_emprunt)->format('d/m/Y') }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-700">
                                    @if($emprunt->date_retour)
                                        <div class="flex flex-col">
                                            <span class="text-xs text-gray-400">Rendu le</span>
                                            <span class="font-medium text-green-700">{{ \Carbon\Carbon::parse($emprunt->date_retour)->format('d/m/Y') }}</span>
                                        </div>
                                    @else
                                        @php
                                            $dateEcheance = \Carbon\Carbon::parse($emprunt->date_emprunt)->addDays(30);
                                            $isOverdue = now()->gt($dateEcheance);
                                        @endphp
                                        <div class="flex flex-col">
                                            <span class="text-xs text-gray-400">À rendre le</span>
                                            <span class="font-medium {{ $isOverdue ? 'text-red-600' : 'text-slate-700' }}">
                                                {{ $dateEcheance->format('d/m/Y') }}
                                            </span>
                                        </div>
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-700">
                                    @php
                                        $loanClasses = [
                                            'en_cours' => 'bg-blue-100 text-blue-800',
                                            'rendu' => 'bg-green-100 text-green-800',
                                            'en_retard' => 'bg-red-100 text-red-800',
                                        ];
                                        $loanLabels = [
                                            'en_cours' => 'En cours',
                                            'rendu' => 'Rendu',
                                            'en_retard' => 'En retard',
                                        ];
                                    @endphp
                                    <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium 
                                        {{ $loanClasses[$emprunt->etat] ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ $loanLabels[$emprunt->etat] ?? ucfirst(str_replace('_', ' ', $emprunt->etat)) }}
                                    </span>
                                </td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('admin.emprunts.edit', $emprunt) }}" class="text-indigo-600 hover:text-indigo-900">Modifier</a>
                                        <form action="{{ route('admin.emprunts.destroy', $emprunt) }}" method="POST" onsubmit="return confirm('Supprimer cet emprunt ?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 ml-2">Supprimer</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <div class="mt-4">
        {{ $emprunts->links() }}
    </div>
</div>
@endsection
