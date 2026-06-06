<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Toko Baju</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-white text-gray-900">

    {{-- Navbar --}}
    <nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center gap-8">
                    <a href="/" class="text-xl font-bold tracking-tight">TokoBaju</a>
                    <div class="hidden md:flex items-center gap-6 text-sm font-medium text-gray-600">
                        <a href="#" class="hover:text-gray-900">Beranda</a>
                        <a href="#" class="hover:text-gray-900">Kategori</a>
                        <a href="#" class="hover:text-gray-900">Koleksi</a>
                        <a href="#" class="hover:text-gray-900">Tentang</a>
                    </div>
                </div>
                <div class="flex items-center gap-4 text-sm font-medium">
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900">Masuk</a>
                    <a href="{{ route('register') }}" class="bg-gray-900 text-white px-4 py-2 rounded-full hover:bg-gray-800">Daftar</a>
                </div>
            </div>
        </div>
    </nav>

    {{-- Hero --}}
    <section class="relative bg-gradient-to-br from-gray-50 to-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-32">
            <div class="max-w-2xl">
                <span class="inline-block text-sm font-medium text-gray-500 tracking-wide uppercase mb-4">Koleksi Terbaru 2026</span>
                <h1 class="text-4xl md:text-6xl font-bold tracking-tight text-gray-900 leading-tight">
                    Tampil Stylish<br>Setiap Hari
                </h1>
                <p class="mt-4 text-lg text-gray-600 leading-relaxed">
                    Temukan pakaian terbaik untuk gaya Anda. Dari kasual hingga formal, kami punya semuanya.
                </p>
                <div class="mt-8 flex items-center gap-4">
                    <a href="#" class="bg-gray-900 text-white px-6 py-3 rounded-full text-sm font-medium hover:bg-gray-800">Belanja Sekarang</a>
                    <a href="#" class="border border-gray-300 text-gray-700 px-6 py-3 rounded-full text-sm font-medium hover:border-gray-400">Lihat Koleksi</a>
                </div>
            </div>
        </div>
    </section>

    {{-- Kategori --}}
    <section class="py-16 md:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold tracking-tight">Kategori</h2>
                <p class="mt-2 text-gray-500">Pilih sesuai kebutuhan Anda</p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                <div class="bg-gray-50 rounded-2xl p-6 text-center hover:bg-gray-100 transition-colors cursor-pointer">
                    <div class="w-12 h-12 bg-gray-200 rounded-xl mx-auto mb-4"></div>
                    <h3 class="font-semibold">Atasan</h3>
                    <p class="text-sm text-gray-500 mt-1">Kemeja, Kaos, Blouse</p>
                </div>
                <div class="bg-gray-50 rounded-2xl p-6 text-center hover:bg-gray-100 transition-colors cursor-pointer">
                    <div class="w-12 h-12 bg-gray-200 rounded-xl mx-auto mb-4"></div>
                    <h3 class="font-semibold">Bawahan</h3>
                    <p class="text-sm text-gray-500 mt-1">Celana, Rok, Shorts</p>
                </div>
                <div class="bg-gray-50 rounded-2xl p-6 text-center hover:bg-gray-100 transition-colors cursor-pointer">
                    <div class="w-12 h-12 bg-gray-200 rounded-xl mx-auto mb-4"></div>
                    <h3 class="font-semibold">Outerwear</h3>
                    <p class="text-sm text-gray-500 mt-1">Jaket, Hoodie, Blazer</p>
                </div>
                <div class="bg-gray-50 rounded-2xl p-6 text-center hover:bg-gray-100 transition-colors cursor-pointer">
                    <div class="w-12 h-12 bg-gray-200 rounded-xl mx-auto mb-4"></div>
                    <h3 class="font-semibold">Aksesoris</h3>
                    <p class="text-sm text-gray-500 mt-1">Topi, Tas, Sepatu</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Produk Unggulan --}}
    <section class="py-16 md:py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-end justify-between mb-12">
                <div>
                    <h2 class="text-3xl font-bold tracking-tight">Produk Unggulan</h2>
                    <p class="mt-2 text-gray-500">Paling laris bulan ini</p>
                </div>
                <a href="#" class="text-sm font-medium text-gray-900 hover:underline">Lihat Semua</a>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                @foreach (range(1, 8) as $i)
                    <div class="group cursor-pointer">
                        <div class="aspect-[3/4] bg-gray-200 rounded-xl overflow-hidden mb-3">
                            <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 group-hover:scale-105 transition-transform duration-300"></div>
                        </div>
                        <h3 class="font-medium text-sm">Produk {{ $i }}</h3>
                        <p class="text-sm text-gray-500 mt-0.5">Rp {{ number_format(rand(50000, 500000), 0, ',', '.') }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Newsletter --}}
    <section class="py-16 md:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold tracking-tight">Dapatkan Info Terbaru</h2>
            <p class="mt-2 text-gray-500 max-w-md mx-auto">Berlangganan newsletter kami untuk mendapatkan promo dan koleksi terbaru.</p>
            <form class="mt-8 max-w-md mx-auto flex gap-3">
                <input type="email" placeholder="Email Anda" class="flex-1 px-4 py-3 border border-gray-300 rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent">
                <button type="submit" class="bg-gray-900 text-white px-6 py-3 rounded-full text-sm font-medium hover:bg-gray-800 shrink-0">Langganan</button>
            </form>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-gray-900 text-gray-400 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="col-span-2 md:col-span-1">
                    <span class="text-white text-lg font-bold">TokoBaju</span>
                    <p class="mt-2 text-sm">Toko pakaian online terpercaya sejak 2026.</p>
                </div>
                <div>
                    <h4 class="text-white text-sm font-semibold mb-3">Belanja</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white">Kategori</a></li>
                        <li><a href="#" class="hover:text-white">Koleksi</a></li>
                        <li><a href="#" class="hover:text-white">Promo</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white text-sm font-semibold mb-3">Bantuan</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white">FAQ</a></li>
                        <li><a href="#" class="hover:text-white">Pengiriman</a></li>
                        <li><a href="#" class="hover:text-white">Hubungi Kami</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white text-sm font-semibold mb-3">Ikuti Kami</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white">Instagram</a></li>
                        <li><a href="#" class="hover:text-white">TikTok</a></li>
                        <li><a href="#" class="hover:text-white">Shopee</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-10 pt-6 text-sm text-center">
                &copy; {{ date('Y') }} TokoBaju. All rights reserved.
            </div>
        </div>
    </footer>

</body>
</html>
