<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'TokoBaju Admin' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&family=playfair-display:400,500,600,700,800" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 min-h-screen flex" x-data="{ sidebarOpen: false }">
    
    <!-- Sidebar -->
    <aside class="w-64 bg-navy text-white fixed h-full z-40 transition-transform duration-300 transform md:translate-x-0" :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }">
        <div class="p-6 border-b border-gray-700">
            <a href="{{ route('admin.dashboard') }}" class="font-serif text-2xl font-bold text-terracotta">TokoBaju Admin</a>
        </div>
        
        <nav class="p-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-terracotta text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">Dashboard</a>
            <a href="{{ route('admin.products.index') }}" class="block px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('admin.products.*') ? 'bg-terracotta text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">Produk</a>
            <a href="{{ route('admin.categories.index') }}" class="block px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('admin.categories.*') ? 'bg-terracotta text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">Kategori</a>
            <a href="{{ route('admin.brands.index') }}" class="block px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('admin.brands.*') ? 'bg-terracotta text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">Brand</a>
            <a href="{{ route('admin.orders.index') }}" class="block px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('admin.orders.*') ? 'bg-terracotta text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">Pesanan</a>
            <a href="{{ route('admin.payments.index') }}" class="block px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('admin.payments.*') ? 'bg-terracotta text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">Pembayaran</a>
            <a href="{{ route('admin.users.index') }}" class="block px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-terracotta text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">Pengguna</a>
        </nav>
        
        <div class="absolute bottom-0 w-full p-4 border-t border-gray-700">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-xl transition-colors">
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    <!-- Overlay -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-black/50 z-30 md:hidden" style="display: none;"></div>

    <!-- Main Content -->
    <div class="flex-1 md:ml-64 flex flex-col h-screen overflow-hidden">
        <!-- Top header for mobile -->
        <header class="bg-white shadow-sm h-16 flex items-center px-4 md:hidden border-b border-gray-200">
            <button @click="sidebarOpen = true" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <span class="ml-4 font-serif font-bold text-terracotta text-lg">TokoBaju Admin</span>
        </header>

        <main class="flex-1 overflow-y-auto p-4 md:p-8">
            {{ $slot }}
        </main>
    </div>

</body>
</html>
