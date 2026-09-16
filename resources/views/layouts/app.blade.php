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
<body class="font-sans antialiased bg-cream min-h-screen flex flex-col">
    <!-- Navigation -->
    <nav x-data="{ open: false }" class="bg-white/80 backdrop-blur-md border-b border-gray-200/60 sticky top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('home') }}">
                            <x-application-logo />
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                            {{ __('Beranda') }}
                        </x-nav-link>
                        <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.index')">
                            {{ __('Katalog') }}
                        </x-nav-link>
                    </div>
                </div>

                <!-- Right Side Navigation -->
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    @auth
                        <!-- Cart -->
                        <a href="{{ route('cart.index') }}" class="relative p-2 text-gray-600 hover:text-terracotta transition-colors duration-300 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            <!-- Count badge placeholder -->
                            <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-terracotta rounded-full">
                                0
                            </span>
                        </a>

                        <!-- Wishlist -->
                        <a href="{{ route('wishlist.index') }}" class="p-2 text-gray-600 hover:text-terracotta transition-colors duration-300 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </a>

                        <!-- Settings Dropdown -->
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="flex items-center text-sm font-medium text-gray-600 hover:text-terracotta focus:outline-none transition-colors duration-300">
                                    <div>{{ Auth::user()->name }}</div>

                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profil') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('addresses.index')">
                                    {{ __('Alamat Saya') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('orders.index')">
                                    {{ __('Pesanan Saya') }}
                                </x-dropdown-link>
                                
                                @if(Auth::user()->is_admin)
                                <x-dropdown-link :href="route('admin.dashboard')">
                                    {{ __('Dashboard Admin') }}
                                </x-dropdown-link>
                                @endif

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        {{ __('Keluar') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 hover:text-terracotta mr-4 transition-colors">Masuk</a>
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-4 py-2 bg-terracotta text-white text-sm font-medium rounded-xl shadow-sm hover:bg-[#C96B50] hover:shadow-md transition-all duration-300">Daftar</a>
                    @endauth
                </div>

                <!-- Hamburger -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white">
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                    {{ __('Beranda') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.index')">
                    {{ __('Katalog') }}
                </x-responsive-nav-link>
            </div>

            <!-- Responsive Settings Options -->
            @auth
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profil') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('addresses.index')">
                        {{ __('Alamat Saya') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('orders.index')">
                        {{ __('Pesanan Saya') }}
                    </x-responsive-nav-link>
                    
                    @if(Auth::user()->is_admin)
                    <x-responsive-nav-link :href="route('admin.dashboard')">
                        {{ __('Dashboard Admin') }}
                    </x-responsive-nav-link>
                    @endif

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Keluar') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
            @else
            <div class="pt-4 pb-1 border-t border-gray-200">
                <x-responsive-nav-link :href="route('login')">
                    {{ __('Masuk') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('register')">
                    {{ __('Daftar') }}
                </x-responsive-nav-link>
            </div>
            @endauth
        </div>
    </nav>

    <!-- Page Content -->
    <main class="flex-grow">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-navy text-white mt-16">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Brand -->
                <div>
                    <a href="{{ route('home') }}" class="font-serif text-2xl font-bold text-terracotta inline-block mb-4">TokoBaju</a>
                    <p class="text-sm text-gray-300">Temukan gaya terbaikmu dengan koleksi pilihan kami. Elegansi di setiap kesempatan.</p>
                </div>
                
                <!-- Belanja -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Belanja</h3>
                    <ul class="space-y-2 text-sm text-gray-300">
                        <li><a href="#" class="hover:text-terracotta transition-colors">Pakaian Pria</a></li>
                        <li><a href="#" class="hover:text-terracotta transition-colors">Pakaian Wanita</a></li>
                        <li><a href="#" class="hover:text-terracotta transition-colors">Sepatu</a></li>
                        <li><a href="#" class="hover:text-terracotta transition-colors">Aksesoris</a></li>
                    </ul>
                </div>

                <!-- Bantuan -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Bantuan</h3>
                    <ul class="space-y-2 text-sm text-gray-300">
                        <li><a href="#" class="hover:text-terracotta transition-colors">Cara Belanja</a></li>
                        <li><a href="#" class="hover:text-terracotta transition-colors">Pengiriman</a></li>
                        <li><a href="#" class="hover:text-terracotta transition-colors">Pengembalian</a></li>
                        <li><a href="#" class="hover:text-terracotta transition-colors">FAQ</a></li>
                    </ul>
                </div>

                <!-- Ikuti Kami -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Ikuti Kami</h3>
                    <ul class="space-y-2 text-sm text-gray-300">
                        <li><a href="#" class="hover:text-terracotta transition-colors">Instagram</a></li>
                        <li><a href="#" class="hover:text-terracotta transition-colors">Facebook</a></li>
                        <li><a href="#" class="hover:text-terracotta transition-colors">Twitter</a></li>
                        <li><a href="#" class="hover:text-terracotta transition-colors">TikTok</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-12 pt-8 text-center text-sm text-gray-400">
                &copy; {{ date('Y') }} TokoBaju. Hak Cipta Dilindungi.
            </div>
        </div>
    </footer>
</body>
</html>
