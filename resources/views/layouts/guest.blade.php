<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Jcloths' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&family=playfair-display:400,500,600,700,800" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-[#0A0A0F] text-slate-100 min-h-screen flex flex-col items-center justify-center p-4 selection:bg-blue-600 selection:text-white">
    
    <div class="mb-8">
        <a href="/" class="hover:opacity-90 transition-opacity">
            <x-application-logo />
        </a>
    </div>

    <div class="bg-[#121218] rounded-2xl shadow-2xl shadow-black/80 max-w-md w-full p-8 border border-[#232336]">
        {{ $slot }}
    </div>

</body>
</html>
