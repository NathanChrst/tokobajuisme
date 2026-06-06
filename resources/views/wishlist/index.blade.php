<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Wishlist Saya') }}
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
                <div class="p-6">
                    @forelse ($wishlists as $wishlist)
                        <div class="flex items-center gap-4 py-4 border-b border-gray-100 last:border-0">
                            <div class="w-20 h-20 bg-gray-100 rounded-lg flex items-center justify-center shrink-0">
                                @if ($wishlist->product->image)
                                    <img src="{{ Storage::url($wishlist->product->image) }}" alt="{{ $wishlist->product->name }}" class="w-full h-full object-cover rounded-lg">
                                @else
                                    <span class="text-gray-400 text-xs">No Image</span>
                                @endif
                            </div>
                            <div class="flex-1">
                                <a href="{{ route('products.show', $wishlist->product) }}" class="text-lg font-semibold text-gray-900 hover:text-indigo-600">
                                    {{ $wishlist->product->name }}
                                </a>
                                <p class="text-indigo-600 font-medium">Rp {{ number_format($wishlist->product->price, 0, ',', '.') }}</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <form action="{{ route('cart.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $wishlist->product_id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <x-primary-button class="text-sm">{{ __('+ Keranjang') }}</x-primary-button>
                                </form>
                                <form action="{{ route('wishlist.destroy', $wishlist->product) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-red-400 hover:text-red-600 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12 text-gray-500">
                            <p class="text-lg">Wishlist masih kosong.</p>
                            <a href="{{ route('products.index') }}" class="text-indigo-600 hover:text-indigo-800 mt-2 inline-block">Jelajahi produk &rarr;</a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
