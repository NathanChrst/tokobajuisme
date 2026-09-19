<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jcloths — Modern & Elegant Fashion</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&family=playfair-display:400,500,600,700,800" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-[#0A0A0F] text-slate-100 min-h-screen flex flex-col selection:bg-blue-600 selection:text-white">

    <header class="bg-[#121218]/90 backdrop-blur-md border-b border-[#232336] sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <a href="/" class="flex items-center gap-2">
                <x-application-logo />
            </a>
            <div class="flex items-center gap-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm font-semibold shadow-md shadow-blue-600/30 transition-all">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-slate-300 hover:text-white transition-colors">Masuk</a>
                    <a href="{{ route('register') }}" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm font-semibold shadow-md shadow-blue-600/30 transition-all">Daftar</a>
                @endauth
            </div>
        </div>
    </header>

    <main class="flex-1 flex flex-col items-center justify-center text-center px-4 py-24">
        <div class="max-w-3xl">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-blue-600/10 border border-blue-500/30 text-blue-400 text-xs font-semibold uppercase tracking-wider mb-8">
                ✨ Koleksi Busana Eksklusif
            </div>
            <h1 class="font-serif text-5xl sm:text-7xl font-bold text-white mb-8 tracking-tight">
                Tampil Stylish & Elegan Bersama <span class="text-blue-500">Jcloths</span>
            </h1>
            <p class="text-lg text-slate-300 mb-10 max-w-xl mx-auto leading-relaxed">
                Pusat belanja busana pria, wanita, dan aksesoris modern dengan kurasi kualitas terbaik dan desain eksklusif.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('products.index') }}" class="px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl shadow-xl shadow-blue-600/40 hover:scale-105 transition-all duration-200">
                    Mulai Belanja &rarr;
                </a>
            </div>
        </div>
    </main>

    <footer class="border-t border-[#232336] bg-[#0D0D12] py-8 text-center text-sm text-slate-500">
        &copy; {{ date('Y') }} Jcloths. Hak Cipta Dilindungi.
    </footer>

</body>
</html>
