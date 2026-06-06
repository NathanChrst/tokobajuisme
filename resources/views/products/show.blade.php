<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $product->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <div class="h-96 bg-gray-100 rounded-lg flex items-center justify-center">
                            @if ($product->image)
                                <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover rounded-lg">
                            @else
                                <span class="text-gray-400 text-lg">No Image</span>
                            @endif
                        </div>
                    </div>
                    <div>
                        <p class="text-sm text-indigo-600 font-medium">{{ $product->category ?? 'Umum' }}</p>
                        <h3 class="text-2xl font-bold text-gray-900 mt-2">{{ $product->name }}</h3>
                        <p class="text-3xl font-bold text-indigo-600 mt-4">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <p class="text-gray-600 mt-4">{{ $product->description }}</p>
                        <div class="mt-4 flex items-center gap-2">
                            <span class="text-sm font-medium text-gray-700">Stok:</span>
                            <span class="text-sm {{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                                {{ $product->stock > 0 ? $product->stock . ' tersedia' : 'Habis' }}
                            </span>
                        </div>
                        @auth
                            <div class="mt-6 space-y-3">
                                <form action="{{ route('cart.store') }}" method="POST" class="flex items-center gap-4">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <div>
                                        <x-input-label for="quantity" :value="__('Jumlah')" />
                                        <x-text-input id="quantity" name="quantity" type="number" class="mt-1 block w-24" value="1" min="1" max="{{ $product->stock }}" />
                                    </div>
                                    <x-primary-button class="mt-5">{{ __('Tambah ke Keranjang') }}</x-primary-button>
                                </form>
                                <form action="{{ route('wishlist.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="inline-flex items-center gap-2 text-gray-600 hover:text-red-500 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                        </svg>
                                        {{ __('Tambah ke Wishlist') }}
                                    </button>
                                </form>
                            </div>
                        @endauth
                        <div class="mt-6">
                            <a href="{{ route('products.index') }}" class="text-indigo-600 hover:text-indigo-800">&larr; Kembali ke Katalog</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
