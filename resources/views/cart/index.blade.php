<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="font-serif text-3xl sm:text-4xl text-white font-bold mb-8 tracking-tight">Keranjang Belanja</h1>

        @if($cartItems->isEmpty())
            <div class="bg-[#121218] rounded-2xl border border-[#232336] shadow-xl p-16 text-center">
                <div class="text-6xl mb-6">🛒</div>
                <h3 class="font-serif text-2xl text-white mb-2 font-bold">Keranjang Masih Kosong</h3>
                <p class="text-slate-400 mb-8 text-sm">Yuk, mulai tambahkan produk favoritmu! Banyak koleksi baru menunggu lho.</p>
                <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center px-8 py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl shadow-lg shadow-blue-600/30 hover:shadow-blue-600/50 transition-all text-sm">
                    Jelajahi Katalog
                </a>
            </div>
        @else
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Cart Items -->
                <div class="w-full lg:w-2/3 space-y-4">
                    @foreach($cartItems as $item)
                        <div class="flex gap-4 sm:gap-6 bg-[#121218] p-4 sm:p-5 rounded-2xl border border-[#232336] shadow-xl transition-all">
                            <!-- Image -->
                            <div class="w-20 sm:w-24 h-28 sm:h-32 flex-shrink-0 rounded-xl overflow-hidden bg-[#161622] border border-[#232336]">
                                <img src="{{ $item->productVariant->product->primaryImageUrl() }}" alt="{{ $item->productVariant->product->name }}" class="w-full h-full object-cover">
                            </div>
                            
                            <!-- Info -->
                            <div class="flex-grow flex flex-col justify-between py-1">
                                <div class="flex justify-between items-start gap-2">
                                    <div>
                                        <p class="text-[11px] text-slate-500 uppercase tracking-wider mb-1 font-medium">{{ $item->productVariant->product->brand->name ?? 'Jcloths' }}</p>
                                        <a href="{{ route('products.show', $item->productVariant->product->slug) }}" class="font-semibold text-base sm:text-lg text-white hover:text-blue-400 transition-colors line-clamp-1">
                                            {{ $item->productVariant->product->name }}
                                        </a>
                                        <div class="flex flex-wrap items-center gap-2 mt-2">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-[#161622] text-slate-300 border border-[#232336]">Warna: {{ $item->productVariant->color }}</span>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-[#161622] text-slate-300 border border-[#232336]">Ukuran: {{ $item->productVariant->size }}</span>
                                        </div>
                                    </div>
                                    
                                    <!-- Delete Button -->
                                    <form action="{{ route('cart.destroy', $item) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-slate-400 hover:text-red-400 transition-colors p-1.5 cursor-pointer">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                                
                                <div class="flex justify-between items-end mt-4">
                                    <p class="font-bold text-blue-400 text-base sm:text-lg">{{ $item->productVariant->product->formattedPrice() }}</p>
                                    
                                    <!-- Update Quantity Form -->
                                    <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center w-28 bg-[#161622] rounded-xl border border-[#232336] overflow-hidden">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" name="quantity" value="{{ $item->quantity - 1 }}" class="w-8 h-8 flex items-center justify-center text-slate-400 hover:text-blue-400 hover:bg-[#1E1E2D] transition-colors cursor-pointer">-</button>
                                        <input type="number" readonly value="{{ $item->quantity }}" class="w-full h-8 border-0 text-center bg-transparent text-white focus:ring-0 p-0 text-xs sm:text-sm font-medium">
                                        <button type="submit" name="quantity" value="{{ $item->quantity + 1 }}" class="w-8 h-8 flex items-center justify-center text-slate-400 hover:text-blue-400 hover:bg-[#1E1E2D] transition-colors cursor-pointer">+</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Summary Sidebar -->
                <div class="w-full lg:w-1/3">
                    <div class="bg-[#121218] p-6 rounded-2xl border border-[#232336] shadow-xl sticky top-24">
                        <h2 class="font-serif text-2xl text-white font-bold mb-6 tracking-tight">Ringkasan Belanja</h2>
                        
                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between text-slate-300 text-sm">
                                <span>Subtotal</span>
                                <span class="font-medium text-white">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-slate-400 text-sm">
                                <span>Estimasi Ongkir</span>
                                <span class="text-xs italic">Dihitung saat checkout</span>
                            </div>
                        </div>
                        
                        <div class="border-t border-[#232336] pt-4 mb-6">
                            <div class="flex justify-between items-center">
                                <span class="font-medium text-slate-200">Total</span>
                                <span class="font-bold text-2xl text-blue-400">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        
                        <a href="{{ route('checkout.index') }}" class="w-full flex items-center justify-center px-6 py-3.5 bg-blue-600 hover:bg-blue-700 text-white text-base font-semibold rounded-xl shadow-lg shadow-blue-600/30 hover:shadow-blue-600/50 transition-all duration-200">
                            Lanjut ke Pembayaran
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
