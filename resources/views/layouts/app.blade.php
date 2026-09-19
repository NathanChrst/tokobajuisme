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
<body class="font-sans antialiased bg-[#0A0A0F] text-slate-100 min-h-screen flex flex-col selection:bg-blue-600 selection:text-white">
    <!-- Navigation -->
    <nav x-data="{ open: false }" class="bg-[#121218]/90 backdrop-blur-md border-b border-[#232336] sticky top-0 z-50 transition-all duration-300 shadow-lg shadow-black/40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('home') }}" class="hover:opacity-90 transition-opacity">
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
                        <a href="{{ route('cart.index') }}" class="relative p-2 text-slate-300 hover:text-blue-400 transition-colors duration-200 mr-3" title="Keranjang">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                        </a>

                        <!-- Wishlist -->
                        <a href="{{ route('wishlist.index') }}" class="p-2 text-slate-300 hover:text-blue-400 transition-colors duration-200 mr-4" title="Wishlist">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </a>

                        <!-- Settings Dropdown -->
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="flex items-center text-sm font-medium text-slate-200 hover:text-white bg-[#161622] hover:bg-[#1E1E2D] px-3.5 py-2 rounded-xl border border-[#232336] hover:border-blue-500/50 focus:outline-none transition-all duration-200 cursor-pointer">
                                    <div class="font-medium">{{ Auth::user()->name }}</div>

                                    <div class="ml-1.5 text-slate-400">
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
                                <div class="border-t border-[#232336] my-1"></div>
                                <x-dropdown-link :href="route('admin.dashboard')" class="text-blue-400 hover:text-blue-300">
                                    {{ __('Dashboard Admin') }}
                                </x-dropdown-link>
                                @endif

                                <div class="border-t border-[#232336] my-1"></div>
                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();"
                                            class="text-red-400 hover:text-red-300">
                                        {{ __('Keluar') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-slate-300 hover:text-blue-400 mr-4 transition-colors">Masuk</a>
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-xl shadow-md shadow-blue-600/30 hover:shadow-blue-600/50 transition-all duration-200">Daftar</a>
                    @endauth
                </div>

                <!-- Hamburger -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-slate-400 hover:text-slate-100 hover:bg-[#1E1E2D] focus:outline-none transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-[#121218] border-b border-[#232336]">
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
            <div class="pt-4 pb-1 border-t border-[#232336]">
                <div class="px-4">
                    <div class="font-medium text-base text-slate-100">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-slate-400">{{ Auth::user()->email }}</div>
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
                    <x-responsive-nav-link :href="route('admin.dashboard')" class="text-blue-400">
                        {{ __('Dashboard Admin') }}
                    </x-responsive-nav-link>
                    @endif

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();"
                                class="text-red-400">
                            {{ __('Keluar') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
            @else
            <div class="pt-4 pb-3 border-t border-[#232336] px-4 flex flex-col gap-2">
                <a href="{{ route('login') }}" class="w-full text-center py-2 px-4 rounded-xl border border-[#232336] text-slate-200 hover:bg-[#1E1E2D]">
                    {{ __('Masuk') }}
                </a>
                <a href="{{ route('register') }}" class="w-full text-center py-2 px-4 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-medium shadow-md shadow-blue-600/30">
                    {{ __('Daftar') }}
                </a>
            </div>
            @endauth
        </div>
    </nav>

    <!-- Page Content -->
    <main class="flex-grow">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-[#0D0D12] text-slate-100 mt-20 border-t border-[#232336]">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Brand -->
                <div>
                    <a href="{{ route('home') }}" class="inline-block mb-4">
                        <x-application-logo />
                    </a>
                    <p class="text-sm text-slate-400 leading-relaxed">Temukan gaya terbaikmu dengan koleksi fashion pilihan kami. Modern, berkarakter, dan elegan di setiap kesempatan.</p>
                </div>
                
                <!-- Belanja -->
                <div>
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-200 mb-4">Belanja</h3>
                    <ul class="space-y-2.5 text-sm text-slate-400">
                        <li><a href="{{ route('products.index') }}" class="hover:text-blue-400 transition-colors">Semua Produk</a></li>
                        <li><a href="{{ route('products.index') }}" class="hover:text-blue-400 transition-colors">Pakaian Pria</a></li>
                        <li><a href="{{ route('products.index') }}" class="hover:text-blue-400 transition-colors">Pakaian Wanita</a></li>
                        <li><a href="{{ route('products.index') }}" class="hover:text-blue-400 transition-colors">Aksesoris</a></li>
                    </ul>
                </div>

                <!-- Bantuan -->
                <div>
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-200 mb-4">Bantuan</h3>
                    <ul class="space-y-2.5 text-sm text-slate-400">
                        <li><a href="#" class="hover:text-blue-400 transition-colors">Cara Belanja</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition-colors">Pengiriman</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition-colors">Pengembalian</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition-colors">FAQ</a></li>
                    </ul>
                </div>

                <!-- Ikuti Kami -->
                <div>
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-200 mb-4">Ikuti Kami</h3>
                    <ul class="space-y-2.5 text-sm text-slate-400">
                        <li><a href="#" class="hover:text-blue-400 transition-colors">Instagram</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition-colors">Facebook</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition-colors">Twitter / X</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition-colors">TikTok</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-[#232336] mt-12 pt-8 text-center text-sm text-slate-500">
                &copy; {{ date('Y') }} Jcloths. Hak Cipta Dilindungi.
            </div>
        </div>
    </footer>
</body>
</html>
