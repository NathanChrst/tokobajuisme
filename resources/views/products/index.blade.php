<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Sidebar Filter -->
            <div class="w-full md:w-1/4">
                <div class="bg-white p-6 rounded-2xl border border-gray-200/60 shadow-sm">
                    <h2 class="font-serif text-xl text-[#3D405B] mb-6 font-bold">Filter Produk</h2>
                    
                    <form action="{{ route('products.index') }}" method="GET">
                        <!-- Search -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pencarian</label>
                            <input type="text" name="search" value="{{ request('search') }}" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-[#E07A5F] focus:ring-[#E07A5F]" placeholder="Cari produk...">
                        </div>

                        <!-- Category -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                            <select name="category" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-[#E07A5F] focus:ring-[#E07A5F]">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Price Range -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Harga</label>
                            <div class="flex items-center gap-2">
                                <input type="number" name="min_price" value="{{ request('min_price') }}" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-[#E07A5F] focus:ring-[#E07A5F] text-sm" placeholder="Min">
                                <span class="text-gray-400">-</span>
                                <input type="number" name="max_price" value="{{ request('max_price') }}" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-[#E07A5F] focus:ring-[#E07A5F] text-sm" placeholder="Max">
                            </div>
                        </div>
                        
                        <!-- Sort -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Urutkan</label>
                            <select name="sort" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-[#E07A5F] focus:ring-[#E07A5F]">
                                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga Terendah</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga Tertinggi</option>
                                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama A-Z</option>
                            </select>
                        </div>

                        <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 bg-[#E07A5F] text-white font-semibold rounded-xl shadow-sm hover:bg-[#C96B50] hover:shadow-md transition-all duration-300">
                            Terapkan Filter
                        </button>
                    </form>
                </div>
            </div>

            <!-- Product Grid -->
            <div class="w-full md:w-3/4">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="font-serif text-3xl text-[#3D405B] font-bold">Katalog Produk</h1>
                    <span class="text-gray-500">{{ $products->total() }} Produk Ditemukan</span>
                </div>

                <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @forelse($products as $product)
                        <div class="group bg-white rounded-2xl border border-gray-200/60 shadow-sm hover:shadow-md transition-all duration-300 hover:scale-[1.02] overflow-hidden flex flex-col">
                            <a href="{{ route('products.show', $product->slug) }}" class="block aspect-[3/4] overflow-hidden relative">
                                <img src="{{ $product->primaryImageUrl() }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                                @if($product->isNew())
                                    <span class="absolute top-3 left-3 bg-[#E07A5F] text-white text-xs font-bold px-3 py-1 rounded-full">Baru</span>
                                @endif
                            </a>
                            <div class="p-4 flex flex-col flex-grow">
                                <p class="text-xs text-gray-400 uppercase tracking-wider">{{ $product->brand->name ?? 'Brand' }}</p>
                                <a href="{{ route('products.show', $product->slug) }}" class="font-medium text-gray-900 mt-1 line-clamp-2 hover:text-[#E07A5F] transition-colors">
                                    {{ $product->name }}
                                </a>
                                <p class="text-lg font-bold text-[#E07A5F] mt-auto pt-2">{{ $product->formattedPrice() }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-16">
                            <div class="text-6xl mb-4">🔍</div>
                            <h3 class="font-serif text-xl text-gray-700 mb-2">Produk Tidak Ditemukan</h3>
                            <p class="text-gray-500 mb-6">Coba ubah filter pencarian Anda.</p>
                            <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center px-6 py-3 bg-[#3D405B] text-white font-semibold rounded-xl shadow-sm hover:bg-[#2A2C3F] transition-all duration-300">
                                Reset Filter
                            </a>
                        </div>
                    @endforelse
                </div>

                <div class="mt-10">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
