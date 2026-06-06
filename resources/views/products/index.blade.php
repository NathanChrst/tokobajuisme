<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Katalog Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <form method="GET" action="{{ route('products.index') }}" class="flex flex-wrap gap-4">
                    <div class="flex-1 min-w-[200px]">
                        <x-text-input id="search" name="search" type="text" class="mt-1 block w-full" placeholder="Cari produk..." :value="request('search')" />
                    </div>
                    <div>
                        <select name="category" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Semua Kategori</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat }}" @selected(request('category') === $cat)>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex items-end">
                        <x-primary-button>{{ __('Filter') }}</x-primary-button>
                    </div>
                </form>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse ($products as $product)
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-300">
                        <a href="{{ route('products.show', $product) }}">
                            <div class="h-48 bg-gray-100 flex items-center justify-center">
                                @if ($product->image)
                                    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                @else
                                    <span class="text-gray-400">No Image</span>
                                @endif
                            </div>
                        </a>
                        <div class="p-4">
                            <p class="text-sm text-indigo-600 font-medium">{{ $product->category }}</p>
                            <a href="{{ route('products.show', $product) }}">
                                <h3 class="text-lg font-semibold text-gray-900 mt-1">{{ $product->name }}</h3>
                            </a>
                            <p class="text-gray-600 text-sm mt-1 line-clamp-2">{{ $product->description }}</p>
                            <div class="mt-3 flex items-center justify-between">
                                <span class="text-xl font-bold text-gray-900">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                <span class="text-sm text-gray-500">Stok: {{ $product->stock }}</span>
                            </div>
                            @auth
                                <div class="mt-3 flex gap-2">
                                    <form action="{{ route('cart.store') }}" method="POST" class="flex-1">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <x-primary-button class="w-full justify-center text-sm">
                                            {{ __('+ Keranjang') }}
                                        </x-primary-button>
                                    </form>
                                    <form action="{{ route('wishlist.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button type="submit" class="p-2 text-gray-400 hover:text-red-500 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            @endauth
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-gray-500">
                        Belum ada produk.
                    </div>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
