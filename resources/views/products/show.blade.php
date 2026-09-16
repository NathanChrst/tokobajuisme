<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid md:grid-cols-2 gap-12">
            <!-- Left: Image Gallery -->
            <div x-data="{ selectedImage: 0 }" class="space-y-4">
                <div class="aspect-[3/4] rounded-2xl overflow-hidden bg-white border border-gray-200/60 shadow-sm relative">
                    @foreach($product->images as $index => $image)
                        <img x-show="selectedImage === {{ $index }}" src="{{ Storage::url($image->path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition-opacity duration-300" x-cloak />
                    @endforeach
                    <!-- Wishlist Button -->
                    <form action="{{ route('wishlist.store') }}" method="POST" class="absolute top-4 right-4">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="w-10 h-10 bg-white/90 backdrop-blur rounded-full flex items-center justify-center hover:bg-white shadow-sm transition-all hover:scale-110 {{ $isWishlisted ? 'text-[#E07A5F]' : 'text-gray-400' }}">
                            ♥
                        </button>
                    </form>
                </div>
                <!-- Thumbnails -->
                <div class="grid grid-cols-4 gap-4">
                    @foreach($product->images as $index => $image)
                        <button @click="selectedImage = {{ $index }}" :class="{ 'ring-2 ring-[#E07A5F]': selectedImage === {{ $index }} }" class="aspect-square rounded-xl overflow-hidden bg-white border border-gray-200/60 shadow-sm hover:opacity-80 transition-all">
                            <img src="{{ Storage::url($image->path) }}" alt="Thumbnail {{ $index }}" class="w-full h-full object-cover" />
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Right: Product Info -->
            <div class="flex flex-col">
                <div class="mb-6">
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-600 mb-3">{{ $product->brand->name ?? 'Brand' }}</span>
                    <h1 class="font-serif text-4xl text-[#3D405B] font-bold mb-2">{{ $product->name }}</h1>
                    <p class="text-3xl font-bold text-[#E07A5F]">{{ $product->formattedPrice() }}</p>
                </div>

                <div class="prose prose-sm text-gray-600 mb-8 max-w-none">
                    {{ $product->description }}
                </div>

                <form action="{{ route('cart.store') }}" method="POST" x-data="{ selectedColor: '', selectedSize: '', quantity: 1 }">
                    @csrf
                    <!-- Variants Selection (Simplified representation) -->
                    <div class="space-y-6 mb-8">
                        <div>
                            <h3 class="text-sm font-medium text-gray-900 mb-3">Warna</h3>
                            <div class="flex flex-wrap gap-3">
                                @foreach($product->availableColors() as $color)
                                    <button type="button" @click="selectedColor = '{{ $color }}'" :class="{ 'ring-2 ring-[#E07A5F] border-transparent': selectedColor === '{{ $color }}' }" class="px-4 py-2 rounded-xl border border-gray-200 text-sm font-medium hover:border-[#E07A5F] transition-all bg-white">
                                        {{ $color }}
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-gray-900 mb-3">Ukuran</h3>
                            <div class="flex flex-wrap gap-3">
                                @foreach($product->availableSizes() as $size)
                                    <button type="button" @click="selectedSize = '{{ $size }}'" :class="{ 'ring-2 ring-[#E07A5F] border-transparent': selectedSize === '{{ $size }}' }" class="w-12 h-12 rounded-xl border border-gray-200 text-sm font-medium hover:border-[#E07A5F] transition-all bg-white flex items-center justify-center">
                                        {{ $size }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                        
                        <div>
                            <h3 class="text-sm font-medium text-gray-900 mb-3">Jumlah</h3>
                            <div class="flex items-center w-32 bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                                <button type="button" @click="if(quantity > 1) quantity--" class="w-10 h-10 flex items-center justify-center text-gray-500 hover:text-[#E07A5F] hover:bg-gray-50 transition-colors">-</button>
                                <input type="number" name="quantity" x-model="quantity" class="w-full h-10 border-0 text-center text-gray-900 focus:ring-0 p-0 text-sm font-medium appearance-none" min="1">
                                <button type="button" @click="quantity++" class="w-10 h-10 flex items-center justify-center text-gray-500 hover:text-[#E07A5F] hover:bg-gray-50 transition-colors">+</button>
                            </div>
                        </div>
                    </div>

                    <!-- Hidden input to represent the chosen variant -> normally you'd map color+size to variant ID using Alpine or Livewire -->
                    <input type="hidden" name="product_variant_id" value="{{ $product->variants->first()->id ?? '' }}">

                    <div class="flex gap-4">
                        <button type="submit" class="flex-1 inline-flex items-center justify-center px-8 py-4 bg-[#E07A5F] text-white text-lg font-semibold rounded-xl shadow-sm hover:bg-[#C96B50] hover:shadow-md hover:scale-[1.02] transition-all duration-300">
                            🛒 Tambah ke Keranjang
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
            <div class="mt-24">
                <h2 class="font-serif text-3xl text-[#3D405B] font-bold mb-8 text-center">Produk Terkait</h2>
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($relatedProducts as $related)
                        <!-- Product Card Reused -->
                        <div class="group bg-white rounded-2xl border border-gray-200/60 shadow-sm hover:shadow-md transition-all duration-300 hover:scale-[1.02] overflow-hidden flex flex-col">
                            <a href="{{ route('products.show', $related->slug) }}" class="block aspect-[3/4] overflow-hidden relative">
                                <img src="{{ $related->primaryImageUrl() }}" alt="{{ $related->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                            </a>
                            <div class="p-4 flex flex-col flex-grow">
                                <p class="text-xs text-gray-400 uppercase tracking-wider">{{ $related->brand->name ?? 'Brand' }}</p>
                                <a href="{{ route('products.show', $related->slug) }}" class="font-medium text-gray-900 mt-1 line-clamp-2 hover:text-[#E07A5F] transition-colors">
                                    {{ $related->name }}
                                </a>
                                <p class="text-lg font-bold text-[#E07A5F] mt-auto pt-2">{{ $related->formattedPrice() }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
