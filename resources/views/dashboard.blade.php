<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <a href="{{ route('products.index') }}" class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-indigo-100 rounded-lg">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Katalog Produk</p>
                            <p class="text-lg font-semibold text-gray-900">Jelajahi</p>
                        </div>
                    </div>
                </a>
                <a href="{{ route('cart.index') }}" class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-green-100 rounded-lg">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Keranjang</p>
                            <p class="text-lg font-semibold text-gray-900">{{ auth()->user()->carts()->count() }} item</p>
                        </div>
                    </div>
                </a>
                <a href="{{ route('wishlist.index') }}" class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-red-100 rounded-lg">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Wishlist</p>
                            <p class="text-lg font-semibold text-gray-900">{{ auth()->user()->wishlists()->count() }} item</p>
                        </div>
                    </div>
                </a>
                <a href="{{ route('orders.index') }}" class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-yellow-100 rounded-lg">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Pesanan</p>
                            <p class="text-lg font-semibold text-gray-900">{{ auth()->user()->orders()->count() }} pesanan</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Selamat datang, {{ Auth::user()->name }}!</h3>
                    <p class="text-gray-600">Mulai belanja kebutuhan baju Anda dari katalog produk.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
