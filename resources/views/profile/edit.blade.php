@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 md:px-8">
    <div class="md:flex md:items-center md:justify-between mb-8">
        <div class="min-w-0 flex-1">
            <h2 class="text-2xl font-bold leading-7 text-slate-900 sm:truncate sm:text-3xl sm:tracking-tight">
                Mon Profil
            </h2>
            <p class="mt-1 text-sm text-slate-500">
                Gérez vos informations personnelles et votre sécurité.
            </p>
        </div>
    </div>

    @if (session('success'))
        <div class="rounded-md bg-green-50 p-4 mb-6 border border-green-200">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="bg-white shadow-lg rounded-2xl border border-slate-100 overflow-hidden">
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')
            
            <div class="p-6 space-y-6 sm:p-8">
                <!-- Personal Info Section -->
                <div>
                    <h3 class="text-lg font-medium leading-6 text-slate-900">Informations Personnelles</h3>
                    <p class="mt-1 text-sm text-slate-500">Mettez à jour vos coordonnées publiques.</p>
                </div>

                <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="name" class="block text-sm font-medium leading-6 text-slate-900">Nom complet</label>
                        <div class="mt-2">
                            <input type="text" name="name" id="name" autocomplete="name" value="{{ old('name', $user->name) }}" class="block w-full rounded-md border border-slate-300 bg-white py-2 px-3 text-slate-900 shadow-sm placeholder:text-slate-400 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-sm sm:leading-6 @error('name') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror">
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="email" class="block text-sm font-medium leading-6 text-slate-900">Adresse Email</label>
                        <div class="mt-2">
                            <input type="email" name="email" id="email" autocomplete="email" value="{{ old('email', $user->email) }}" class="block w-full rounded-md border border-slate-300 bg-white py-2 px-3 text-slate-900 shadow-sm placeholder:text-slate-400 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-sm sm:leading-6 @error('email') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror">
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="phone" class="block text-sm font-medium leading-6 text-slate-900">Téléphone</label>
                        <div class="mt-2">
                            <input type="text" name="phone" id="phone" autocomplete="tel" value="{{ old('phone', $user->phone) }}" class="block w-full rounded-md border border-slate-300 bg-white py-2 px-3 text-slate-900 shadow-sm placeholder:text-slate-400 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-sm sm:leading-6 @error('phone') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror">
                            @error('phone')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="border-t border-slate-200 pt-6"></div>

                <!-- Password Section -->
                <div>
                    <h3 class="text-lg font-medium leading-6 text-slate-900">Sécurité</h3>
                    <p class="mt-1 text-sm text-slate-500">Laissez vide si vous ne souhaitez pas modifier votre mot de passe.</p>
                </div>

                <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="password" class="block text-sm font-medium leading-6 text-slate-900">Nouveau mot de passe</label>
                        <div class="mt-2">
                            <input type="password" name="password" id="password" autocomplete="new-password" class="block w-full rounded-md border border-slate-300 bg-white py-2 px-3 text-slate-900 shadow-sm placeholder:text-slate-400 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-sm sm:leading-6 @error('password') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror">
                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="password_confirmation" class="block text-sm font-medium leading-6 text-slate-900">Confirmer le mot de passe</label>
                        <div class="mt-2">
                            <input type="password" name="password_confirmation" id="password_confirmation" autocomplete="new-password" class="block w-full rounded-md border border-slate-300 bg-white py-2 px-3 text-slate-900 shadow-sm placeholder:text-slate-400 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-slate-50 px-6 py-4 flex items-center justify-end sm:px-8">
                <button type="submit" class="inline-flex justify-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Sauvegarder les modifications
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
