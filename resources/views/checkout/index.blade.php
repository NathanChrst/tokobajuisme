<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="font-serif text-3xl sm:text-4xl text-white font-bold mb-8 tracking-tight">Checkout</h1>

        <form action="{{ route('checkout.store') }}" method="POST" class="flex flex-col lg:flex-row gap-8">
            @csrf
            
            <div class="w-full lg:w-2/3 space-y-6">
                <!-- Alamat Pengiriman -->
                <div class="bg-[#121218] p-6 sm:p-8 rounded-2xl border border-[#232336] shadow-xl">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="font-serif text-xl sm:text-2xl text-white font-bold tracking-tight">1. Alamat Pengiriman</h2>
                        <a href="{{ route('addresses.create') }}" class="text-sm font-semibold text-blue-400 hover:text-blue-300 transition-colors">+ Tambah Alamat</a>
                    </div>
                    
                    @if($addresses->isEmpty())
                        <div class="p-4 bg-amber-950/40 border border-amber-800/60 text-amber-400 rounded-xl text-sm mb-4">
                            Kamu belum memiliki alamat pengiriman. Silakan tambah alamat terlebih dahulu.
                        </div>
                    @else
                        <div class="space-y-3">
                            @foreach($addresses as $address)
                                <label class="flex p-4 border rounded-xl cursor-pointer hover:bg-[#161622] transition-colors {{ $address->is_default ? 'border-blue-500 bg-blue-950/30' : 'border-[#232336] bg-[#161622]/50' }}">
                                    <div class="flex-shrink-0 mt-1 mr-4">
                                        <input type="radio" name="address_id" value="{{ $address->id }}" class="text-blue-600 focus:ring-blue-500 bg-[#121218] border-[#232336]" {{ $address->is_default ? 'checked' : '' }} required>
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-2 mb-1">
                                            <span class="font-semibold text-white">{{ $address->label }}</span>
                                            @if($address->is_default)
                                                <span class="px-2 py-0.5 text-[10px] font-bold bg-blue-600 text-white rounded-full">Utama</span>
                                            @endif
                                        </div>
                                        <p class="text-sm text-slate-300 leading-relaxed">{{ $address->fullAddress() }}</p>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Metode Pembayaran -->
                <div class="bg-[#121218] p-6 sm:p-8 rounded-2xl border border-[#232336] shadow-xl">
                    <h2 class="font-serif text-xl sm:text-2xl text-white font-bold mb-6 tracking-tight">2. Metode Pembayaran</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <label class="flex flex-col items-center p-5 border border-[#232336] rounded-xl cursor-pointer hover:bg-[#161622] transition-colors has-[:checked]:border-blue-500 has-[:checked]:bg-blue-950/40 bg-[#161622]/50">
                            <input type="radio" name="payment_method" value="transfer_bank" class="hidden" checked required>
                            <span class="font-bold text-white mb-1">Transfer Bank</span>
                            <span class="text-xs text-slate-400 text-center">BCA, Mandiri, BNI, BRI</span>
                        </label>
                        <label class="flex flex-col items-center p-5 border border-[#232336] rounded-xl cursor-pointer hover:bg-[#161622] transition-colors has-[:checked]:border-blue-500 has-[:checked]:bg-blue-950/40 bg-[#161622]/50">
                            <input type="radio" name="payment_method" value="gopay" class="hidden">
                            <span class="font-bold text-white mb-1">GoPay / QRIS</span>
                            <span class="text-xs text-slate-400 text-center">Bayar instan</span>
                        </label>
                        <label class="flex flex-col items-center p-5 border border-[#232336] rounded-xl cursor-pointer hover:bg-[#161622] transition-colors has-[:checked]:border-blue-500 has-[:checked]:bg-blue-950/40 bg-[#161622]/50">
                            <input type="radio" name="payment_method" value="credit_card" class="hidden">
                            <span class="font-bold text-white mb-1">Kartu Kredit</span>
                            <span class="text-xs text-slate-400 text-center">Visa / Mastercard</span>
                        </label>
                    </div>
                </div>

                <!-- Catatan -->
                <div class="bg-[#121218] p-6 sm:p-8 rounded-2xl border border-[#232336] shadow-xl">
                    <h2 class="font-serif text-xl sm:text-2xl text-white font-bold mb-6 tracking-tight">3. Catatan Pesanan</h2>
                    <textarea name="notes" rows="3" class="w-full rounded-xl bg-[#161622] border border-[#232336] text-white placeholder-slate-500 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/25 text-sm" placeholder="Contoh: Tolong titip di pos satpam ya..."></textarea>
                </div>
            </div>

            <!-- Summary Sidebar -->
            <div class="w-full lg:w-1/3">
                <div class="bg-[#121218] p-6 rounded-2xl border border-[#232336] shadow-xl sticky top-24">
                    <h2 class="font-serif text-2xl text-white font-bold mb-6 tracking-tight">Ringkasan Pesanan</h2>
                    
                    <div class="space-y-3 mb-6">
                        @foreach($cartItems as $item)
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-300 line-clamp-1 flex-grow pr-4">{{ $item->quantity }}x {{ $item->productVariant->product->name }}</span>
                                <span class="font-semibold text-white whitespace-nowrap">{{ $item->formattedSubtotal() }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-t border-[#232336] pt-4 space-y-3 mb-6 text-sm">
                        <div class="flex justify-between text-slate-400">
                            <span>Subtotal</span>
                            <span class="font-medium text-slate-200">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-slate-400">
                            <span>Ongkos Kirim</span>
                            <span class="font-medium text-slate-200">Rp {{ number_format($shippingCost, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    
                    <div class="border-t border-[#232336] pt-4 mb-8">
                        <div class="flex justify-between items-center">
                            <span class="font-medium text-slate-200">Total Pembayaran</span>
                            <span class="font-bold text-2xl text-blue-400">Rp {{ number_format($subtotal + $shippingCost, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    
                    <button type="submit" class="w-full flex items-center justify-center px-6 py-4 bg-blue-600 hover:bg-blue-700 text-white text-base font-semibold rounded-xl shadow-lg shadow-blue-600/30 hover:shadow-blue-600/50 transition-all duration-200 cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed" {{ $addresses->isEmpty() ? 'disabled' : '' }}>
                        Buat Pesanan
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
