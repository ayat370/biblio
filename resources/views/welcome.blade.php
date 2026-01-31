<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'EduBiblio 📚') }}</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans text-slate-600 bg-white">
        <div class="relative overflow-hidden bg-white">
            <!-- Background decoration -->
            <div class="absolute top-0 bottom-0 left-0 right-0 pointer-events-none" aria-hidden="true">
                <svg class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-0 opacity-30" width="1000" height="1000" fill="none" xmlns="http://www.w3.org/2000/svg">
                     <defs>
                        <linearGradient id="blob" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" style="stop-color: #4F46E5; stop-opacity: 1" />
                            <stop offset="100%" style="stop-color: #7C3AED; stop-opacity: 1" />
                        </linearGradient>
                    </defs>
                    <circle cx="500" cy="500" r="500" fill="url(#blob)" filter="blur(80px)" />
                </svg>
            </div>

            <div class="relative pt-6 pb-16 sm:pb-24">
                <!-- Navigation -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6">
                    <nav class="relative flex items-center justify-between sm:h-10 md:justify-center" aria-label="Global">
                        <div class="flex items-center flex-1 md:absolute md:inset-y-0 md:left-0">
                            <div class="flex items-center justify-between w-full md:w-auto">
                                <a href="#">
                                    <span class="sr-only">EduBiblio 📚</span>
                                    <span class="h-10 w-auto sm:h-12 text-3xl font-extrabold bg-gradient-to-r from-indigo-600 to-violet-600 bg-clip-text text-transparent">
                                        {{ config('app.name', 'EduBiblio 📚') }}
                                    </span>
                                </a>
                            </div>
                        </div>
                        <div class="hidden md:absolute md:flex md:items-center md:justify-end md:inset-y-0 md:right-0">
                            @auth
                                <a href="{{ url('/admin/dashboard') }}" class="font-medium text-indigo-600 hover:text-indigo-500">Dashboard</a>
                            @else
                                <span class="inline-flex rounded-md shadow">
                                    <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md text-indigo-600 bg-white hover:bg-slate-50">
                                        Connexion
                                    </a>
                                </span>
                                <span class="inline-flex rounded-md shadow ml-4">
                                    <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                        Inscription
                                    </a>
                                </span>
                            @endauth
                        </div>
                    </nav>
                </div>

                <!-- Hero Section -->
                <main class="mt-16 mx-auto max-w-7xl px-4 sm:mt-24 sm:px-6 lg:mt-32">
                    <div class="lg:grid lg:grid-cols-12 lg:gap-8">
                        <div class="sm:text-center md:max-w-2xl md:mx-auto lg:col-span-6 lg:text-left">
                            <h1>
                                <span class="block text-sm font-semibold uppercase tracking-wide text-indigo-600 sm:text-base lg:text-sm xl:text-base">Gestion de EduBiblio 📚</span>
                                <span class="mt-1 block text-4xl tracking-tight font-extrabold sm:text-5xl xl:text-6xl">
                                    <span class="block text-slate-900">Gérez vos livres</span>
                                    <span class="block text-indigo-600">simplement et efficacement</span>
                                </span>
                            </h1>
                            <p class="mt-3 text-base text-slate-500 sm:mt-5 sm:text-xl lg:text-lg xl:text-xl">
                                Une plateforme moderne pour la gestion complète de votre catalogue, de vos adhérents et de vos emprunts. Puissant, rapide et intuitif.
                            </p>
                            
                            @guest
                            <div class="mt-8 sm:max-w-lg sm:mx-auto sm:text-center lg:text-left lg:mx-0">
                                <p class="text-base font-medium text-slate-900">
                                    Commencez dès maintenant.
                                </p>
                                <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                                    <div class="rounded-md shadow">
                                        <a href="{{ route('register') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 md:py-4 md:text-lg md:px-10">
                                            Créer un compte
                                        </a>
                                    </div>
                                    <div class="mt-3 sm:mt-0 sm:ml-3">
                                        <a href="{{ route('login') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 md:py-4 md:text-lg md:px-10">
                                            Se connecter
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endguest
                        </div>
                        <div class="mt-12 relative sm:max-w-lg sm:mx-auto lg:mt-0 lg:max-w-none lg:mx-0 lg:col-span-6 lg:flex lg:items-center">
                            <div class="relative mx-auto w-full rounded-lg shadow-lg lg:max-w-md overflow-hidden">
                                <div class="relative block w-full bg-white rounded-lg overflow-hidden">
                                     <img class="w-full" src="https://images.unsplash.com/photo-1507842217153-e2123525d65a?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80" alt="Bibliothèque">
                                     <div class="absolute inset-0 bg-indigo-500 mix-blend-multiply opacity-20"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>
