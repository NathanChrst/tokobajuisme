<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h1 class="font-serif text-4xl text-[#3D405B] font-bold mb-10">Wishlist Saya</h1>

        @if($wishlists->isEmpty())
            <div class="bg-white rounded-2xl border border-gray-200/60 shadow-sm p-16 text-center">
                <div class="text-6xl mb-6">💝</div>
                <h3 class="font-serif text-2xl text-[#3D405B] mb-2 font-bold">Belum Ada Wishlist</h3>
                <p class="text-gray-500 mb-8">Simpan produk yang kamu suka di sini biar gampang dicari nanti.</p>
                <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center px-8 py-3 bg-[#E07A5F] text-white font-semibold rounded-xl shadow-sm hover:bg-[#C96B50] hover:shadow-md transition-all duration-300">
                    Cari Produk Favorit
                </a>
            </div>
        @else
            <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($wishlists as $wishlist)
                    @php $product = $wishlist->product; @endphp
                    <div class="group bg-white rounded-2xl border border-gray-200/60 shadow-sm hover:shadow-md transition-all duration-300 hover:scale-[1.02] overflow-hidden flex flex-col relative">
                        <!-- Remove from Wishlist Button -->
                        <form action="{{ route('wishlist.destroy', $product) }}" method="POST" class="absolute top-3 right-3 z-10">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-8 h-8 bg-white/90 backdrop-blur rounded-full flex items-center justify-center text-[#E07A5F] hover:bg-red-50 hover:text-red-600 shadow-sm transition-all">
                                ✕
                            </button>
                        </form>

                        <a href="{{ route('products.show', $product->slug) }}" class="block aspect-[3/4] overflow-hidden relative">
                            <img src="{{ $product->primaryImageUrl() }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                        </a>
                        <div class="p-4 flex flex-col flex-grow">
                            <p class="text-xs text-gray-400 uppercase tracking-wider">{{ $product->brand->name ?? 'Brand' }}</p>
                            <a href="{{ route('products.show', $product->slug) }}" class="font-medium text-gray-900 mt-1 line-clamp-2 hover:text-[#E07A5F] transition-colors">
                                {{ $product->name }}
                            </a>
                            <p class="text-lg font-bold text-[#E07A5F] mt-2 mb-4">{{ $product->formattedPrice() }}</p>
                            
                            <a href="{{ route('products.show', $product->slug) }}" class="mt-auto w-full inline-flex items-center justify-center px-4 py-2 bg-gray-50 border border-gray-200 text-gray-700 text-sm font-semibold rounded-xl hover:bg-white hover:border-[#E07A5F] hover:text-[#E07A5F] transition-all duration-300">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
