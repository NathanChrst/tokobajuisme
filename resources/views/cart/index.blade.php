<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h1 class="font-serif text-4xl text-[#3D405B] font-bold mb-10">Keranjang Belanja</h1>

        @if($cartItems->isEmpty())
            <div class="bg-white rounded-2xl border border-gray-200/60 shadow-sm p-16 text-center">
                <div class="text-6xl mb-6">🛒</div>
                <h3 class="font-serif text-2xl text-[#3D405B] mb-2 font-bold">Keranjang Masih Kosong</h3>
                <p class="text-gray-500 mb-8">Yuk, mulai tambahkan produk favoritmu! Banyak koleksi baru menunggu lho.</p>
                <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center px-8 py-3 bg-[#E07A5F] text-white font-semibold rounded-xl shadow-sm hover:bg-[#C96B50] hover:shadow-md transition-all duration-300">
                    Jelajahi Katalog
                </a>
            </div>
        @else
            <div class="flex flex-col lg:flex-row gap-10">
                <!-- Cart Items -->
                <div class="w-full lg:w-2/3 space-y-6">
                    @foreach($cartItems as $item)
                        <div class="flex gap-6 bg-white p-4 rounded-2xl border border-gray-200/60 shadow-sm hover:shadow-md transition-all">
                            <!-- Image -->
                            <div class="w-24 h-32 flex-shrink-0 rounded-xl overflow-hidden bg-gray-50">
                                <img src="{{ $item->productVariant->product->primaryImageUrl() }}" alt="{{ $item->productVariant->product->name }}" class="w-full h-full object-cover">
                            </div>
                            
                            <!-- Info -->
                            <div class="flex-grow flex flex-col justify-between py-1">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">{{ $item->productVariant->product->brand->name ?? 'Brand' }}</p>
                                        <a href="{{ route('products.show', $item->productVariant->product->slug) }}" class="font-medium text-lg text-gray-900 hover:text-[#E07A5F] transition-colors line-clamp-1">
                                            {{ $item->productVariant->product->name }}
                                        </a>
                                        <div class="flex items-center gap-2 mt-2">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-600 border border-gray-200">Warna: {{ $item->productVariant->color }}</span>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-600 border border-gray-200">Size: {{ $item->productVariant->size }}</span>
                                        </div>
                                    </div>
                                    
                                    <!-- Delete Button -->
                                    <form action="{{ route('cart.destroy', $item) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors p-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                                
                                <div class="flex justify-between items-end mt-4">
                                    <p class="font-bold text-[#E07A5F]">{{ $item->productVariant->product->formattedPrice() }}</p>
                                    
                                    <!-- Update Quantity Form -->
                                    <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center w-28 bg-gray-50 rounded-xl border border-gray-200/60 overflow-hidden">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" name="quantity" value="{{ $item->quantity - 1 }}" class="w-8 h-8 flex items-center justify-center text-gray-500 hover:text-[#E07A5F] hover:bg-white transition-colors">-</button>
                                        <input type="number" readonly value="{{ $item->quantity }}" class="w-full h-8 border-0 text-center bg-transparent text-gray-900 focus:ring-0 p-0 text-sm font-medium">
                                        <button type="submit" name="quantity" value="{{ $item->quantity + 1 }}" class="w-8 h-8 flex items-center justify-center text-gray-500 hover:text-[#E07A5F] hover:bg-white transition-colors">+</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Summary Sidebar -->
                <div class="w-full lg:w-1/3">
                    <div class="bg-white p-6 rounded-2xl border border-gray-200/60 shadow-sm sticky top-8">
                        <h2 class="font-serif text-2xl text-[#3D405B] font-bold mb-6">Ringkasan Belanja</h2>
                        
                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between text-gray-600">
                                <span>Subtotal</span>
                                <span class="font-medium text-gray-900">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Estimasi Ongkir</span>
                                <span class="text-sm italic">Dihitung saat checkout</span>
                            </div>
                        </div>
                        
                        <div class="border-t border-gray-200 pt-4 mb-8">
                            <div class="flex justify-between items-center">
                                <span class="font-medium text-gray-900">Total</span>
                                <span class="font-bold text-2xl text-[#E07A5F]">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        
                        <a href="{{ route('checkout.index') }}" class="w-full flex items-center justify-center px-6 py-4 bg-[#3D405B] text-white text-lg font-semibold rounded-xl shadow-sm hover:bg-[#2A2C3F] hover:shadow-md transition-all duration-300">
                            Lanjut ke Pembayaran
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
