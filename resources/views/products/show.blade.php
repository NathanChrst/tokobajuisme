<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid md:grid-cols-2 gap-12">
            <!-- Left: Image Gallery -->
            <div x-data="{ selectedImage: 0 }" class="space-y-4">
                <div class="aspect-[3/4] rounded-2xl overflow-hidden bg-[#121218] border border-[#232336] shadow-xl relative">
                    @foreach($product->images as $index => $image)
                        <img x-show="selectedImage === {{ $index }}" src="{{ Storage::url($image->path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition-opacity duration-300" x-cloak />
                    @endforeach
                    <!-- Wishlist Button -->
                    <form action="{{ route('wishlist.store') }}" method="POST" class="absolute top-4 right-4">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="w-10 h-10 bg-[#121218]/80 backdrop-blur rounded-full flex items-center justify-center hover:bg-[#161622] border border-[#232336] shadow-md transition-all hover:scale-110 cursor-pointer {{ $isWishlisted ? 'text-blue-500' : 'text-slate-400 hover:text-blue-400' }}">
                            ♥
                        </button>
                    </form>
                </div>
                <!-- Thumbnails -->
                <div class="grid grid-cols-4 gap-4">
                    @foreach($product->images as $index => $image)
                        <button type="button" @click="selectedImage = {{ $index }}" :class="{ 'ring-2 ring-blue-500 border-transparent': selectedImage === {{ $index }} }" class="aspect-square rounded-xl overflow-hidden bg-[#121218] border border-[#232336] shadow-sm hover:opacity-80 transition-all cursor-pointer">
                            <img src="{{ Storage::url($image->path) }}" alt="Thumbnail {{ $index }}" class="w-full h-full object-cover" />
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Right: Product Info -->
            <div class="flex flex-col">
                <div class="mb-6 pb-6 border-b border-[#232336]">
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-blue-950/60 text-blue-400 border border-blue-800/60 mb-3">{{ $product->brand->name ?? 'Jcloths' }}</span>
                    <h1 class="font-serif text-3xl sm:text-4xl text-white font-bold mb-3 tracking-tight">{{ $product->name }}</h1>
                    <p class="text-3xl font-bold text-blue-400">{{ $product->formattedPrice() }}</p>
                </div>

                <div class="prose prose-invert prose-sm text-slate-300 mb-8 max-w-none leading-relaxed">
                    {{ $product->description }}
                </div>

                <form action="{{ route('cart.store') }}" method="POST" x-data="{ selectedColor: '', selectedSize: '', quantity: 1 }">
                    @csrf
                    <!-- Variants Selection -->
                    <div class="space-y-6 mb-8">
                        <div>
                            <h3 class="text-sm font-medium text-slate-200 mb-3">Pilihan Warna</h3>
                            <div class="flex flex-wrap gap-3">
                                @foreach($product->availableColors() as $color)
                                    <button type="button" @click="selectedColor = '{{ $color }}'" :class="{ 'ring-2 ring-blue-500 bg-blue-600/20 text-blue-400 border-blue-500/50': selectedColor === '{{ $color }}' }" class="px-4 py-2 rounded-xl border border-[#232336] text-sm font-medium text-slate-300 hover:border-blue-500/40 hover:text-white transition-all bg-[#121218] cursor-pointer">
                                        {{ $color }}
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-slate-200 mb-3">Pilihan Ukuran</h3>
                            <div class="flex flex-wrap gap-3">
                                @foreach($product->availableSizes() as $size)
                                    <button type="button" @click="selectedSize = '{{ $size }}'" :class="{ 'ring-2 ring-blue-500 bg-blue-600/20 text-blue-400 border-blue-500/50': selectedSize === '{{ $size }}' }" class="w-12 h-12 rounded-xl border border-[#232336] text-sm font-medium text-slate-300 hover:border-blue-500/40 hover:text-white transition-all bg-[#121218] flex items-center justify-center cursor-pointer">
                                        {{ $size }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                        
                        <div>
                            <h3 class="text-sm font-medium text-slate-200 mb-3">Jumlah</h3>
                            <div class="flex items-center w-32 bg-[#121218] rounded-xl border border-[#232336] shadow-sm overflow-hidden">
                                <button type="button" @click="if(quantity > 1) quantity--" class="w-10 h-10 flex items-center justify-center text-slate-400 hover:text-blue-400 hover:bg-[#161622] transition-colors cursor-pointer">-</button>
                                <input type="number" name="quantity" x-model="quantity" class="w-full h-10 border-0 bg-transparent text-center text-white focus:ring-0 p-0 text-sm font-medium appearance-none" min="1">
                                <button type="button" @click="quantity++" class="w-10 h-10 flex items-center justify-center text-slate-400 hover:text-blue-400 hover:bg-[#161622] transition-colors cursor-pointer">+</button>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="product_variant_id" value="{{ $product->variants->first()->id ?? '' }}">

                    <div class="flex gap-4">
                        <button type="submit" class="flex-1 inline-flex items-center justify-center px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white text-base sm:text-lg font-semibold rounded-xl shadow-xl shadow-blue-600/30 hover:shadow-blue-600/50 hover:scale-[1.01] transition-all duration-200 cursor-pointer">
                            🛒 Tambah ke Keranjang
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
            <div class="mt-24 pt-12 border-t border-[#232336]">
                <h2 class="font-serif text-3xl text-white font-bold mb-8 text-center tracking-tight">Produk Terkait</h2>
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($relatedProducts as $related)
                        <div class="group bg-[#121218] rounded-2xl border border-[#232336] shadow-xl hover:border-blue-500/50 hover:shadow-2xl transition-all duration-300 hover:scale-[1.02] overflow-hidden flex flex-col">
                            <a href="{{ route('products.show', $related->slug) }}" class="block aspect-[3/4] overflow-hidden relative bg-[#161622]">
                                <img src="{{ $related->primaryImageUrl() }}" alt="{{ $related->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                            </a>
                            <div class="p-4 flex flex-col flex-grow">
                                <p class="text-[11px] text-slate-500 uppercase tracking-wider font-medium">{{ $related->brand->name ?? 'Jcloths' }}</p>
                                <a href="{{ route('products.show', $related->slug) }}" class="font-medium text-slate-100 mt-1 line-clamp-2 hover:text-blue-400 transition-colors text-sm">
                                    {{ $related->name }}
                                </a>
                                <p class="text-base font-bold text-blue-400 mt-auto pt-3">{{ $related->formattedPrice() }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
