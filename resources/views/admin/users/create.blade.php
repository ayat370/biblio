@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 md:px-8">
    <div class="md:flex md:items-center md:justify-between mb-8">
        <div class="min-w-0 flex-1">
            <h2 class="text-2xl font-bold leading-7 text-slate-900 sm:truncate sm:text-3xl sm:tracking-tight">
                Ajouter un utilisateur
            </h2>
        </div>
    </div>

    <div class="bg-white shadow-lg rounded-2xl border border-slate-100 overflow-hidden">
        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf
            
            <div class="p-6 space-y-6 sm:p-8">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium leading-6 text-slate-900">Nom complet</label>
                    <div class="mt-2">
                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="block w-full rounded-md border border-slate-300 bg-white py-2 px-3 text-slate-900 shadow-sm placeholder:text-slate-400 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-sm sm:leading-6 @error('name') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror" required>
                        @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-slate-900">Adresse email</label>
                    <div class="mt-2">
                        <input type="email" name="email" id="email" value="{{ old('email') }}" class="block w-full rounded-md border border-slate-300 bg-white py-2 px-3 text-slate-900 shadow-sm placeholder:text-slate-400 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-sm sm:leading-6" required>
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Role -->
                <div>
                    <label for="role" class="block text-sm font-medium leading-6 text-slate-900">Rôle</label>
                    <div class="mt-2">
                        <select id="role" name="role" class="block w-full rounded-md border border-slate-300 bg-white py-2 px-3 text-slate-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-sm sm:leading-6">
                            <option value="user" selected>Utilisateur standard</option>
                            <option value="admin">Administrateur</option>
                        </select>
                    </div>
                </div>

                <!-- Password -->
                <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                    <div>
                        <label for="password" class="block text-sm font-medium leading-6 text-slate-900">Mot de passe</label>
                        <div class="mt-2">
                            <input type="password" name="password" id="password" class="block w-full rounded-md border border-slate-300 bg-white py-2 px-3 text-slate-900 shadow-sm placeholder:text-slate-400 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-sm sm:leading-6" required>
                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium leading-6 text-slate-900">Confirmer le mot de passe</label>
                        <div class="mt-2">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="block w-full rounded-md border border-slate-300 bg-white py-2 px-3 text-slate-900 shadow-sm placeholder:text-slate-400 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-sm sm:leading-6" required>
                        </div>
                    </div>
                </div>

            </div>

            <div class="bg-slate-50 px-6 py-4 flex items-center justify-end sm:px-8">
                <a href="{{ route('admin.users.index') }}" class="text-sm font-semibold leading-6 text-slate-900 mr-4">Annuler</a>
                <button type="submit" class="inline-flex justify-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Créer l'utilisateur
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
