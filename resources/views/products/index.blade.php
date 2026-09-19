<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Sidebar Filter -->
            <div class="w-full md:w-1/4">
                <div class="bg-[#121218] p-6 rounded-2xl border border-[#232336] shadow-xl sticky top-24">
                    <h2 class="font-serif text-xl text-white mb-6 font-bold tracking-tight">Filter Produk</h2>
                    
                    <form action="{{ route('products.index') }}" method="GET">
                        <!-- Search -->
                        <div class="mb-5">
                            <label class="block text-sm font-medium text-slate-300 mb-2">Pencarian</label>
                            <input type="text" name="search" value="{{ request('search') }}" class="w-full rounded-xl bg-[#161622] border border-[#232336] text-slate-100 placeholder-slate-500 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/25 text-sm" placeholder="Cari produk...">
                        </div>

                        <!-- Category -->
                        <div class="mb-5">
                            <label class="block text-sm font-medium text-slate-300 mb-2">Kategori</label>
                            <select name="category" class="w-full rounded-xl bg-[#161622] border border-[#232336] text-slate-200 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/25 text-sm cursor-pointer">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Price Range -->
                        <div class="mb-5">
                            <label class="block text-sm font-medium text-slate-300 mb-2">Rentang Harga</label>
                            <div class="flex items-center gap-2">
                                <input type="number" name="min_price" value="{{ request('min_price') }}" class="w-full rounded-xl bg-[#161622] border border-[#232336] text-slate-100 placeholder-slate-500 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/25 text-sm" placeholder="Min">
                                <span class="text-slate-500">-</span>
                                <input type="number" name="max_price" value="{{ request('max_price') }}" class="w-full rounded-xl bg-[#161622] border border-[#232336] text-slate-100 placeholder-slate-500 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/25 text-sm" placeholder="Max">
                            </div>
                        </div>
                        
                        <!-- Sort -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-slate-300 mb-2">Urutkan</label>
                            <select name="sort" class="w-full rounded-xl bg-[#161622] border border-[#232336] text-slate-200 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/25 text-sm cursor-pointer">
                                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga Terendah</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga Tertinggi</option>
                                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama A-Z</option>
                            </select>
                        </div>

                        <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl shadow-lg shadow-blue-600/30 hover:shadow-blue-600/50 transition-all duration-200 text-sm cursor-pointer">
                            Terapkan Filter
                        </button>
                    </form>
                </div>
            </div>

            <!-- Product Grid -->
            <div class="w-full md:w-3/4">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-6 pb-4 border-b border-[#232336]">
                    <h1 class="font-serif text-3xl text-white font-bold tracking-tight">Katalog Produk</h1>
                    <span class="text-xs sm:text-sm text-slate-400 bg-[#121218] border border-[#232336] px-3 py-1 rounded-full">{{ $products->total() }} Produk Ditemukan</span>
                </div>

                <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @forelse($products as $product)
                        <div class="group bg-[#121218] rounded-2xl border border-[#232336] shadow-xl hover:border-blue-500/50 hover:shadow-2xl hover:shadow-black/70 transition-all duration-300 hover:scale-[1.02] overflow-hidden flex flex-col">
                            <a href="{{ route('products.show', $product->slug) }}" class="block aspect-[3/4] overflow-hidden relative bg-[#161622]">
                                <img src="{{ $product->primaryImageUrl() }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                                @if($product->isNew())
                                    <span class="absolute top-3 left-3 bg-blue-600 text-white text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wider shadow-md shadow-blue-600/40">Baru</span>
                                @endif
                            </a>
                            <div class="p-4 flex flex-col flex-grow">
                                <p class="text-[11px] text-slate-500 uppercase tracking-wider font-medium">{{ $product->brand->name ?? 'Jcloths' }}</p>
                                <a href="{{ route('products.show', $product->slug) }}" class="font-medium text-slate-100 mt-1 line-clamp-2 hover:text-blue-400 transition-colors text-sm">
                                    {{ $product->name }}
                                </a>
                                <p class="text-base font-bold text-blue-400 mt-auto pt-3">{{ $product->formattedPrice() }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-20 bg-[#121218] rounded-2xl border border-[#232336]">
                            <div class="text-5xl mb-4">🔍</div>
                            <h3 class="font-serif text-xl text-white mb-2">Produk Tidak Ditemukan</h3>
                            <p class="text-slate-400 mb-6 text-sm">Coba sesuaikan kata kunci atau ubah filter pencarian Anda.</p>
                            <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center px-6 py-2.5 bg-[#161622] hover:bg-[#1E1E2D] border border-[#232336] text-slate-200 hover:text-white font-semibold rounded-xl transition-all text-sm">
                                Reset Filter
                            </a>
                        </div>
                    @endforelse
                </div>

                <div class="mt-12">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
