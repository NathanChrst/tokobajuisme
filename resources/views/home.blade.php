<x-app-layout>
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-b from-cream to-white overflow-hidden py-20 lg:py-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto">
                <h1 class="font-serif text-5xl md:text-7xl font-bold text-gray-900 mb-6 leading-tight">
                    Temukan Gaya<br/><span class="text-terracotta">Terbaikmu</span>
                </h1>
                <p class="text-lg md:text-xl text-gray-600 mb-10">
                    Koleksi pakaian eksklusif untuk mengekspresikan diri Anda. Elegansi, kenyamanan, dan gaya di setiap kesempatan.
                </p>
                <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
                    <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center px-8 py-4 bg-terracotta text-white font-semibold rounded-xl shadow-lg hover:bg-[#C96B50] hover:shadow-xl hover:scale-105 transition-all duration-300 w-full sm:w-auto">
                        Jelajahi Koleksi &rarr;
                    </a>
                    <a href="#new-arrivals" class="inline-flex items-center justify-center px-8 py-4 bg-white border border-gray-200 text-gray-800 font-semibold rounded-xl shadow-sm hover:bg-gray-50 hover:shadow-md transition-all duration-300 w-full sm:w-auto">
                        Koleksi Terbaru
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Decorative blobs -->
        <div class="absolute top-0 left-0 w-64 h-64 bg-terracotta/5 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob"></div>
        <div class="absolute top-0 right-0 w-64 h-64 bg-navy/5 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-20 w-64 h-64 bg-yellow-200/20 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob animation-delay-4000"></div>
    </section>

    <!-- Categories Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="font-serif text-3xl md:text-4xl font-bold text-gray-900">Kategori Populer</h2>
                <div class="w-24 h-1 bg-terracotta mx-auto mt-4 rounded-full"></div>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <!-- Example Categories - in a real app these would be dynamic -->
                <a href="{{ route('products.index', ['category' => 'pakaian-pria']) }}" class="group block text-center p-6 bg-cream rounded-2xl hover:bg-terracotta transition-colors duration-300">
                    <div class="w-16 h-16 mx-auto bg-white rounded-full flex items-center justify-center mb-4 shadow-sm group-hover:scale-110 transition-transform duration-300 text-3xl">
                        👔
                    </div>
                    <h3 class="font-semibold text-gray-900 group-hover:text-white transition-colors">Pakaian Pria</h3>
                </a>
                
                <a href="{{ route('products.index', ['category' => 'pakaian-wanita']) }}" class="group block text-center p-6 bg-cream rounded-2xl hover:bg-terracotta transition-colors duration-300">
                    <div class="w-16 h-16 mx-auto bg-white rounded-full flex items-center justify-center mb-4 shadow-sm group-hover:scale-110 transition-transform duration-300 text-3xl">
                        👗
                    </div>
                    <h3 class="font-semibold text-gray-900 group-hover:text-white transition-colors">Pakaian Wanita</h3>
                </a>
                
                <a href="{{ route('products.index', ['category' => 'sepatu']) }}" class="group block text-center p-6 bg-cream rounded-2xl hover:bg-terracotta transition-colors duration-300">
                    <div class="w-16 h-16 mx-auto bg-white rounded-full flex items-center justify-center mb-4 shadow-sm group-hover:scale-110 transition-transform duration-300 text-3xl">
                        👟
                    </div>
                    <h3 class="font-semibold text-gray-900 group-hover:text-white transition-colors">Sepatu</h3>
                </a>
                
                <a href="{{ route('products.index', ['category' => 'aksesoris']) }}" class="group block text-center p-6 bg-cream rounded-2xl hover:bg-terracotta transition-colors duration-300">
                    <div class="w-16 h-16 mx-auto bg-white rounded-full flex items-center justify-center mb-4 shadow-sm group-hover:scale-110 transition-transform duration-300 text-3xl">
                        ⌚
                    </div>
                    <h3 class="font-semibold text-gray-900 group-hover:text-white transition-colors">Aksesoris</h3>
                </a>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-10">
                <div>
                    <h2 class="font-serif text-3xl md:text-4xl font-bold text-gray-900">Produk Unggulan</h2>
                    <div class="w-24 h-1 bg-terracotta mt-4 rounded-full"></div>
                </div>
                <a href="{{ route('products.index') }}" class="hidden sm:inline-flex items-center text-terracotta font-medium hover:text-[#C96B50] transition-colors">
                    Lihat Semua &rarr;
                </a>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
                @if(isset($featuredProducts) && $featuredProducts->count() > 0)
                    @foreach($featuredProducts as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                @else
                    <!-- Fallback if no data -->
                    <div class="col-span-full text-center py-10 text-gray-500">
                        Belum ada produk yang tersedia.
                    </div>
                @endif
            </div>
            
            <div class="mt-8 text-center sm:hidden">
                <a href="{{ route('products.index') }}" class="inline-flex items-center px-6 py-3 bg-white border border-gray-200 rounded-xl shadow-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                    Lihat Semua Produk
                </a>
            </div>
        </div>
    </section>

    <!-- Brand Showcase -->
    <section class="py-16 bg-white border-y border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-center text-sm font-bold tracking-widest text-gray-400 uppercase mb-8">Brand Ternama</h2>
            <div class="flex flex-wrap justify-center items-center gap-8 md:gap-16 opacity-60 grayscale hover:grayscale-0 transition-all duration-500">
                <div class="text-2xl font-serif font-bold text-navy">ZARA</div>
                <div class="text-2xl font-sans font-black tracking-tighter text-navy">H&M</div>
                <div class="text-2xl font-serif italic font-bold text-navy">Gucci</div>
                <div class="text-2xl font-sans font-bold text-navy">UNIQLO</div>
                <div class="text-2xl font-serif font-bold tracking-widest text-navy">CHANEL</div>
            </div>
        </div>
    </section>

    <!-- New Arrivals -->
    <section id="new-arrivals" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="font-serif text-3xl md:text-4xl font-bold text-gray-900">Koleksi Terbaru</h2>
                <div class="w-24 h-1 bg-terracotta mx-auto mt-4 rounded-full"></div>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
                @if(isset($newProducts) && $newProducts->count() > 0)
                    @foreach($newProducts as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                @else
                    <!-- Fallback if no data -->
                    <div class="col-span-full text-center py-10 text-gray-500">
                        Belum ada koleksi terbaru.
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Newsletter CTA -->
    <section class="py-20 bg-navy text-white relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-terracotta/20 rounded-full filter blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-blue-500/20 rounded-full filter blur-3xl"></div>
        
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h2 class="font-serif text-3xl md:text-4xl font-bold mb-4">Jangan Ketinggalan Tren Terbaru!</h2>
            <p class="text-gray-300 mb-8 text-lg">Dapatkan info eksklusif, promo menarik, dan inspirasi gaya langsung di inbox Anda.</p>
            
            <form class="flex flex-col sm:flex-row gap-3 max-w-xl mx-auto">
                <input type="email" placeholder="Masukkan alamat email Anda" class="flex-1 px-4 py-3 rounded-xl text-gray-900 focus:ring-2 focus:ring-terracotta border-0 outline-none" required>
                <button type="submit" class="px-6 py-3 bg-terracotta text-white font-semibold rounded-xl hover:bg-[#C96B50] transition-colors whitespace-nowrap">
                    Berlangganan
                </button>
            </form>
        </div>
    </section>
</x-app-layout>
