<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-200/60 p-8 text-center">
                <div class="w-20 h-20 bg-cream rounded-full flex items-center justify-center mx-auto mb-4 text-3xl">
                    👋
                </div>
                <h2 class="font-serif text-3xl font-bold text-gray-900 mb-2">
                    Selamat Datang, {{ Auth::user()->name }}!
                </h2>
                <p class="text-gray-600 mb-8 max-w-lg mx-auto">
                    Senang melihat Anda kembali. Mulai belanja produk favorit Anda atau cek status pesanan Anda.
                </p>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-3xl mx-auto">
                    <a href="{{ route('orders.index') }}" class="p-6 bg-gray-50 rounded-xl border border-gray-200 hover:border-terracotta hover:shadow-md transition-all group">
                        <div class="text-3xl mb-3 group-hover:scale-110 transition-transform">📦</div>
                        <h3 class="font-bold text-gray-900 group-hover:text-terracotta transition-colors">Pesanan Saya</h3>
                        <p class="text-sm text-gray-500 mt-1">Lacak status pesanan</p>
                    </a>
                    
                    <a href="{{ route('wishlist.index') }}" class="p-6 bg-gray-50 rounded-xl border border-gray-200 hover:border-terracotta hover:shadow-md transition-all group">
                        <div class="text-3xl mb-3 group-hover:scale-110 transition-transform">❤️</div>
                        <h3 class="font-bold text-gray-900 group-hover:text-terracotta transition-colors">Wishlist</h3>
                        <p class="text-sm text-gray-500 mt-1">Lihat produk favorit</p>
                    </a>
                    
                    <a href="{{ route('profile.edit') }}" class="p-6 bg-gray-50 rounded-xl border border-gray-200 hover:border-terracotta hover:shadow-md transition-all group">
                        <div class="text-3xl mb-3 group-hover:scale-110 transition-transform">⚙️</div>
                        <h3 class="font-bold text-gray-900 group-hover:text-terracotta transition-colors">Pengaturan Profil</h3>
                        <p class="text-sm text-gray-500 mt-1">Ubah info dan password</p>
                    </a>
                </div>
                
                <div class="mt-12">
                    <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center px-6 py-3 bg-terracotta text-white font-semibold rounded-xl shadow-sm hover:bg-[#C96B50] hover:shadow-md transition-all duration-300">
                        Mulai Belanja &rarr;
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
