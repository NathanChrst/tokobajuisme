<x-app-layout>
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-b from-[#0A0A0F] via-[#121218] to-[#0A0A0F] overflow-hidden py-24 lg:py-36 border-b border-[#232336]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-600/10 border border-blue-500/30 text-blue-400 text-xs font-semibold uppercase tracking-wider mb-6">
                    <span>✨ Koleksi Eksklusif Jcloths</span>
                </div>
                <h1 class="font-serif text-5xl md:text-7xl font-bold text-white mb-6 leading-tight tracking-tight">
                    Temukan Gaya<br/><span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-blue-600">Terbaikmu</span>
                </h1>
                <p class="text-lg md:text-xl text-slate-300 mb-10 leading-relaxed max-w-2xl mx-auto">
                    Koleksi pakaian eksklusif untuk mengekspresikan diri Anda. Elegansi, kenyamanan, dan karakter modern di setiap kesempatan.
                </p>
                <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
                    <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl shadow-xl shadow-blue-600/30 hover:shadow-blue-600/50 hover:scale-105 transition-all duration-300 w-full sm:w-auto">
                        Jelajahi Koleksi &rarr;
                    </a>
                    <a href="#new-arrivals" class="inline-flex items-center justify-center px-8 py-4 bg-[#161622] border border-[#232336] text-slate-200 hover:text-white font-semibold rounded-xl shadow-sm hover:bg-[#1E1E2D] hover:border-blue-500/50 transition-all duration-300 w-full sm:w-auto">
                        Koleksi Terbaru
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Decorative subtle glows -->
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-blue-600/10 rounded-full filter blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-10 right-1/4 w-96 h-96 bg-blue-900/15 rounded-full filter blur-3xl pointer-events-none"></div>
    </section>

    <!-- Categories Section -->
    <section class="py-20 bg-[#0A0A0F] border-b border-[#232336]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14">
                <h2 class="font-serif text-3xl md:text-4xl font-bold text-white">Kategori Populer</h2>
                <p class="text-sm text-slate-400 mt-2">Pilih kategori favorit sesuai dengan gaya dan kebutuhanmu</p>
                <div class="w-20 h-1 bg-blue-600 mx-auto mt-4 rounded-full"></div>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <a href="{{ route('products.index', ['category' => 'pakaian-pria']) }}" class="group block text-center p-8 bg-[#121218] rounded-2xl border border-[#232336] hover:border-blue-500/50 hover:bg-[#161622] shadow-xl hover:shadow-2xl transition-all duration-300">
                    <div class="w-16 h-16 mx-auto bg-[#161622] border border-[#232336] group-hover:border-blue-500/40 rounded-2xl flex items-center justify-center mb-4 shadow-sm group-hover:scale-110 group-hover:bg-blue-600/20 transition-all duration-300 text-3xl">
                        👔
                    </div>
                    <h3 class="font-semibold text-slate-200 group-hover:text-blue-400 transition-colors">Pakaian Pria</h3>
                </a>
                
                <a href="{{ route('products.index', ['category' => 'pakaian-wanita']) }}" class="group block text-center p-8 bg-[#121218] rounded-2xl border border-[#232336] hover:border-blue-500/50 hover:bg-[#161622] shadow-xl hover:shadow-2xl transition-all duration-300">
                    <div class="w-16 h-16 mx-auto bg-[#161622] border border-[#232336] group-hover:border-blue-500/40 rounded-2xl flex items-center justify-center mb-4 shadow-sm group-hover:scale-110 group-hover:bg-blue-600/20 transition-all duration-300 text-3xl">
                        👗
                    </div>
                    <h3 class="font-semibold text-slate-200 group-hover:text-blue-400 transition-colors">Pakaian Wanita</h3>
                </a>
                
                <a href="{{ route('products.index', ['category' => 'sepatu']) }}" class="group block text-center p-8 bg-[#121218] rounded-2xl border border-[#232336] hover:border-blue-500/50 hover:bg-[#161622] shadow-xl hover:shadow-2xl transition-all duration-300">
                    <div class="w-16 h-16 mx-auto bg-[#161622] border border-[#232336] group-hover:border-blue-500/40 rounded-2xl flex items-center justify-center mb-4 shadow-sm group-hover:scale-110 group-hover:bg-blue-600/20 transition-all duration-300 text-3xl">
                        👟
                    </div>
                    <h3 class="font-semibold text-slate-200 group-hover:text-blue-400 transition-colors">Sepatu</h3>
                </a>
                
                <a href="{{ route('products.index', ['category' => 'aksesoris']) }}" class="group block text-center p-8 bg-[#121218] rounded-2xl border border-[#232336] hover:border-blue-500/50 hover:bg-[#161622] shadow-xl hover:shadow-2xl transition-all duration-300">
                    <div class="w-16 h-16 mx-auto bg-[#161622] border border-[#232336] group-hover:border-blue-500/40 rounded-2xl flex items-center justify-center mb-4 shadow-sm group-hover:scale-110 group-hover:bg-blue-600/20 transition-all duration-300 text-3xl">
                        ⌚
                    </div>
                    <h3 class="font-semibold text-slate-200 group-hover:text-blue-400 transition-colors">Aksesoris</h3>
                </a>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="py-20 bg-[#0D0D12] border-b border-[#232336]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h2 class="font-serif text-3xl md:text-4xl font-bold text-white">Produk Unggulan</h2>
                    <p class="text-sm text-slate-400 mt-2">Pilihan fashion paling diminati dengan kualitas premium</p>
                    <div class="w-20 h-1 bg-blue-600 mt-4 rounded-full"></div>
                </div>
                <a href="{{ route('products.index') }}" class="hidden sm:inline-flex items-center text-blue-400 font-semibold hover:text-blue-300 transition-colors gap-1">
                    <span>Lihat Semua</span> &rarr;
                </a>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
                @if(isset($featuredProducts) && $featuredProducts->count() > 0)
                    @foreach($featuredProducts as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                @else
                    <div class="col-span-full text-center py-16 text-slate-500 bg-[#121218] rounded-2xl border border-[#232336]">
                        Belum ada produk yang tersedia.
                    </div>
                @endif
            </div>
            
            <div class="mt-10 text-center sm:hidden">
                <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center px-6 py-3 bg-[#161622] border border-[#232336] rounded-xl shadow-sm font-medium text-slate-200 hover:text-white transition-colors w-full">
                    Lihat Semua Produk
                </a>
            </div>
        </div>
    </section>

    <!-- Brand Showcase -->
    <section class="py-16 bg-[#0A0A0F] border-b border-[#232336]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-center text-xs font-bold tracking-widest text-slate-500 uppercase mb-10">Brand Fashion Ternama</h2>
            <div class="flex flex-wrap justify-center items-center gap-8 md:gap-16 opacity-70 hover:opacity-100 transition-opacity duration-300">
                <div class="text-2xl font-serif font-bold text-slate-300 hover:text-blue-400 transition-colors">ZARA</div>
                <div class="text-2xl font-sans font-black tracking-tighter text-slate-300 hover:text-blue-400 transition-colors">H&M</div>
                <div class="text-2xl font-serif italic font-bold text-slate-300 hover:text-blue-400 transition-colors">Gucci</div>
                <div class="text-2xl font-sans font-bold text-slate-300 hover:text-blue-400 transition-colors">UNIQLO</div>
                <div class="text-2xl font-serif font-bold tracking-widest text-slate-300 hover:text-blue-400 transition-colors">CHANEL</div>
            </div>
        </div>
    </section>

    <!-- New Arrivals -->
    <section id="new-arrivals" class="py-20 bg-[#0D0D12] border-b border-[#232336]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14">
                <h2 class="font-serif text-3xl md:text-4xl font-bold text-white">Koleksi Terbaru</h2>
                <p class="text-sm text-slate-400 mt-2">Dapatkan model pakaian terkini yang baru saja tiba di toko kami</p>
                <div class="w-20 h-1 bg-blue-600 mx-auto mt-4 rounded-full"></div>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
                @if(isset($newProducts) && $newProducts->count() > 0)
                    @foreach($newProducts as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                @else
                    <div class="col-span-full text-center py-16 text-slate-500 bg-[#121218] rounded-2xl border border-[#232336]">
                        Belum ada koleksi terbaru.
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Newsletter CTA -->
    <section class="py-24 bg-[#121218] text-white relative overflow-hidden">
        <div class="absolute top-0 right-0 w-80 h-80 bg-blue-600/15 rounded-full filter blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-blue-900/20 rounded-full filter blur-3xl pointer-events-none"></div>
        
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h2 class="font-serif text-3xl md:text-5xl font-bold mb-4 tracking-tight">Jangan Ketinggalan Tren Terbaru!</h2>
            <p class="text-slate-300 mb-8 text-base md:text-lg max-w-xl mx-auto">Dapatkan info eksklusif, promo menarik, dan inspirasi gaya busana langsung di email Anda.</p>
            
            <form class="flex flex-col sm:flex-row gap-3 max-w-xl mx-auto" onsubmit="event.preventDefault(); alert('Terima kasih telah berlangganan!');">
                <input type="email" placeholder="Masukkan alamat email Anda" class="flex-1 px-4 py-3 rounded-xl bg-[#161622] border border-[#232336] text-white placeholder-slate-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/25 outline-none text-sm" required>
                <button type="submit" class="px-8 py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl shadow-lg shadow-blue-600/30 hover:shadow-blue-600/50 transition-all whitespace-nowrap text-sm cursor-pointer">
                    Berlangganan
                </button>
            </form>
        </div>
    </section>
</x-app-layout>
