<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Keranjang Belanja') }}
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
                    @forelse ($cartItems as $item)
                        <div class="flex items-center gap-4 py-4 border-b border-gray-100 last:border-0">
                            <div class="w-20 h-20 bg-gray-100 rounded-lg flex items-center justify-center shrink-0">
                                @if ($item->product->image)
                                    <img src="{{ Storage::url($item->product->image) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover rounded-lg">
                                @else
                                    <span class="text-gray-400 text-xs">No Image</span>
                                @endif
                            </div>
                            <div class="flex-1">
                                <a href="{{ route('products.show', $item->product) }}" class="text-lg font-semibold text-gray-900 hover:text-indigo-600">
                                    {{ $item->product->name }}
                                </a>
                                <p class="text-indigo-600 font-medium">Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>
                            </div>
                            <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center gap-2">
                                @csrf
                                @method('PATCH')
                                <x-input-label for="quantity-{{ $item->id }}" :value="__('Qty')" class="sr-only" />
                                <x-text-input id="quantity-{{ $item->id }}" name="quantity" type="number" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}" class="w-20 text-center" />
                                <x-primary-button class="text-sm">{{ __('Update') }}</x-primary-button>
                            </form>
                            <p class="text-lg font-semibold text-gray-900 min-w-[120px] text-right">
                                Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                            </p>
                            <form action="{{ route('cart.destroy', $item) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-red-400 hover:text-red-600 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    @empty
                        <div class="text-center py-12 text-gray-500">
                            <p class="text-lg">Keranjang belanja masih kosong.</p>
                            <a href="{{ route('products.index') }}" class="text-indigo-600 hover:text-indigo-800 mt-2 inline-block">Jelajahi produk &rarr;</a>
                        </div>
                    @endforelse

                    @if ($cartItems->isNotEmpty())
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <div class="flex items-center justify-between">
                                <span class="text-xl font-bold text-gray-900">Total:</span>
                                <span class="text-2xl font-bold text-indigo-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                            <div class="mt-4 text-right">
                                <a href="{{ route('orders.checkout') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 transition-colors">
                                    {{ __('Checkout') }}
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
