<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'TokoBaju' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&family=playfair-display:400,500,600,700,800" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-cream min-h-screen flex flex-col items-center justify-center p-4">
    
    <div class="mb-8">
        <a href="/">
            <x-application-logo />
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-lg max-w-md w-full p-8 border border-gray-200/60">
        {{ $slot }}
    </div>

</body>
</html>
