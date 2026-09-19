<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="font-serif text-3xl sm:text-4xl text-white font-bold mb-8 tracking-tight">Wishlist Saya</h1>

        @if($wishlists->isEmpty())
            <div class="bg-[#121218] rounded-2xl border border-[#232336] shadow-xl p-16 text-center">
                <div class="text-6xl mb-6">💝</div>
                <h3 class="font-serif text-2xl text-white mb-2 font-bold">Belum Ada Wishlist</h3>
                <p class="text-slate-400 mb-8 text-sm">Simpan produk yang kamu suka di sini biar gampang dicari nanti.</p>
                <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center px-8 py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl shadow-lg shadow-blue-600/30 hover:shadow-blue-600/50 transition-all text-sm">
                    Cari Produk Favorit
                </a>
            </div>
        @else
            <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($wishlists as $wishlist)
                    @php $product = $wishlist->product; @endphp
                    <div class="group bg-[#121218] rounded-2xl border border-[#232336] shadow-xl hover:border-blue-500/50 hover:shadow-2xl transition-all duration-300 hover:scale-[1.02] overflow-hidden flex flex-col relative">
                        <!-- Remove from Wishlist Button -->
                        <form action="{{ route('wishlist.destroy', $product) }}" method="POST" class="absolute top-3 right-3 z-10">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-8 h-8 bg-[#121218]/80 backdrop-blur rounded-full flex items-center justify-center text-slate-400 hover:text-red-400 border border-[#232336] shadow-sm transition-all cursor-pointer">
                                ✕
                            </button>
                        </form>

                        <a href="{{ route('products.show', $product->slug) }}" class="block aspect-[3/4] overflow-hidden relative bg-[#161622]">
                            <img src="{{ $product->primaryImageUrl() }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                        </a>
                        <div class="p-4 flex flex-col flex-grow">
                            <p class="text-[11px] text-slate-500 uppercase tracking-wider font-medium">{{ $product->brand->name ?? 'Jcloths' }}</p>
                            <a href="{{ route('products.show', $product->slug) }}" class="font-medium text-white mt-1 line-clamp-2 hover:text-blue-400 transition-colors text-sm">
                                {{ $product->name }}
                            </a>
                            <p class="text-base font-bold text-blue-400 mt-2 mb-4">{{ $product->formattedPrice() }}</p>
                            
                            <a href="{{ route('products.show', $product->slug) }}" class="mt-auto w-full inline-flex items-center justify-center px-4 py-2.5 bg-[#161622] border border-[#232336] text-slate-200 text-xs sm:text-sm font-semibold rounded-xl hover:bg-[#1E1E2D] hover:text-white hover:border-blue-500/50 transition-all">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
