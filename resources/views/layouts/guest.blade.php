<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        @auth
            @include('layouts.navigation')
        @endauth

        @guest
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block z-50">
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 underline font-bold bg-white p-2 rounded shadow">Se connecter</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline font-bold bg-white p-2 rounded shadow">S'inscrire</a>
                    @endif
                </div>
            @endif
        @endguest

        <div class="font-sans text-gray-900 antialiased bg-gray-100 min-h-screen">
            <div class="pt-8 pb-12">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
