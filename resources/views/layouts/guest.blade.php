<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="relative min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 overflow-hidden bg-gradient-animated">
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="absolute -top-40 -right-40 w-96 h-96 bg-purple-300/30 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-blue-300/30 rounded-full blur-3xl"></div>
                <div class="absolute top-1/3 left-1/4 w-64 h-64 bg-pink-300/20 rounded-full blur-3xl"></div>
            </div>

            <div class="relative w-full sm:max-w-md px-4 animate-fade-slide-up">
                <div class="text-center mb-6">
                    <a href="/" class="inline-flex items-center gap-2 text-white/90 hover:text-white transition-colors duration-300">
                        <x-application-logo class="w-12 h-12 fill-current drop-shadow-lg" />
                    </a>
                </div>

                <div class="glass-card rounded-2xl shadow-2xl p-8">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
