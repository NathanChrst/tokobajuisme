<x-app-layout>
    <div class="py-12 bg-[#0A0A0F] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-[#121218] overflow-hidden shadow-2xl rounded-2xl border border-[#232336] p-8 sm:p-12 text-center">
                <div class="w-20 h-20 bg-[#161622] border border-[#232336] rounded-full flex items-center justify-center mx-auto mb-6 text-3xl shadow-inner">
                    👋
                </div>
                <h2 class="font-serif text-3xl sm:text-4xl font-bold text-white mb-3 tracking-tight">
                    Selamat Datang, {{ Auth::user()->name }}!
                </h2>
                <p class="text-slate-400 mb-10 max-w-lg mx-auto text-sm sm:text-base">
                    Senang melihat Anda kembali. Mulai belanja produk fashion favorit Anda atau cek status pesanan terkini.
                </p>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-3xl mx-auto">
                    <a href="{{ route('orders.index') }}" class="p-6 bg-[#161622] rounded-2xl border border-[#232336] hover:border-blue-500/50 hover:bg-[#1E1E2D] hover:shadow-xl transition-all group">
                        <div class="text-3xl mb-3 group-hover:scale-110 transition-transform">📦</div>
                        <h3 class="font-bold text-white group-hover:text-blue-400 transition-colors">Pesanan Saya</h3>
                        <p class="text-xs sm:text-sm text-slate-400 mt-1">Lacak status & riwayat pesanan</p>
                    </a>
                    
                    <a href="{{ route('wishlist.index') }}" class="p-6 bg-[#161622] rounded-2xl border border-[#232336] hover:border-blue-500/50 hover:bg-[#1E1E2D] hover:shadow-xl transition-all group">
                        <div class="text-3xl mb-3 group-hover:scale-110 transition-transform">❤️</div>
                        <h3 class="font-bold text-white group-hover:text-blue-400 transition-colors">Wishlist</h3>
                        <p class="text-xs sm:text-sm text-slate-400 mt-1">Lihat koleksi produk favorit</p>
                    </a>
                    
                    <a href="{{ route('profile.edit') }}" class="p-6 bg-[#161622] rounded-2xl border border-[#232336] hover:border-blue-500/50 hover:bg-[#1E1E2D] hover:shadow-xl transition-all group">
                        <div class="text-3xl mb-3 group-hover:scale-110 transition-transform">⚙️</div>
                        <h3 class="font-bold text-white group-hover:text-blue-400 transition-colors">Pengaturan Profil</h3>
                        <p class="text-xs sm:text-sm text-slate-400 mt-1">Ubah info akun & kata sandi</p>
                    </a>
                </div>
                
                <div class="mt-12">
                    <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center px-8 py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl shadow-lg shadow-blue-600/30 hover:shadow-blue-600/50 hover:scale-105 transition-all duration-200">
                        Mulai Belanja &rarr;
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
