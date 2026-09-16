<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h1 class="font-serif text-4xl text-[#3D405B] font-bold mb-10">Checkout</h1>

        <form action="{{ route('checkout.store') }}" method="POST" class="flex flex-col lg:flex-row gap-10">
            @csrf
            
            <div class="w-full lg:w-2/3 space-y-8">
                <!-- Alamat Pengiriman -->
                <div class="bg-white p-8 rounded-2xl border border-gray-200/60 shadow-sm">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="font-serif text-2xl text-[#3D405B] font-bold">1. Alamat Pengiriman</h2>
                        <a href="{{ route('addresses.create') }}" class="text-sm font-medium text-[#E07A5F] hover:underline">Tambah Alamat</a>
                    </div>
                    
                    @if($addresses->isEmpty())
                        <div class="p-4 bg-yellow-50 text-yellow-700 rounded-xl text-sm mb-4">
                            Kamu belum memiliki alamat pengiriman. Silakan tambah alamat terlebih dahulu.
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach($addresses as $address)
                                <label class="flex p-4 border border-gray-200 rounded-xl cursor-pointer hover:bg-gray-50 transition-colors {{ $address->is_default ? 'border-[#E07A5F] bg-orange-50/30' : '' }}">
                                    <div class="flex-shrink-0 mt-1 mr-4">
                                        <input type="radio" name="address_id" value="{{ $address->id }}" class="text-[#E07A5F] focus:ring-[#E07A5F]" {{ $address->is_default ? 'checked' : '' }} required>
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-2 mb-1">
                                            <span class="font-bold text-gray-900">{{ $address->label }}</span>
                                            @if($address->is_default)
                                                <span class="px-2 py-0.5 text-[10px] font-bold bg-[#E07A5F] text-white rounded-full">Utama</span>
                                            @endif
                                        </div>
                                        <p class="text-sm text-gray-600 leading-relaxed">{{ $address->fullAddress() }}</p>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Metode Pembayaran -->
                <div class="bg-white p-8 rounded-2xl border border-gray-200/60 shadow-sm">
                    <h2 class="font-serif text-2xl text-[#3D405B] font-bold mb-6">2. Metode Pembayaran</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <label class="flex flex-col items-center p-4 border border-gray-200 rounded-xl cursor-pointer hover:bg-gray-50 transition-colors has-[:checked]:border-[#E07A5F] has-[:checked]:bg-orange-50/30">
                            <input type="radio" name="payment_method" value="transfer_bank" class="hidden" checked required>
                            <span class="font-bold text-gray-900 mb-1">Transfer Bank</span>
                            <span class="text-xs text-gray-500 text-center">BCA, Mandiri, BNI, BRI</span>
                        </label>
                        <label class="flex flex-col items-center p-4 border border-gray-200 rounded-xl cursor-pointer hover:bg-gray-50 transition-colors has-[:checked]:border-[#E07A5F] has-[:checked]:bg-orange-50/30">
                            <input type="radio" name="payment_method" value="gopay" class="hidden">
                            <span class="font-bold text-gray-900 mb-1">GoPay</span>
                            <span class="text-xs text-gray-500 text-center">Bayar instan</span>
                        </label>
                        <label class="flex flex-col items-center p-4 border border-gray-200 rounded-xl cursor-pointer hover:bg-gray-50 transition-colors has-[:checked]:border-[#E07A5F] has-[:checked]:bg-orange-50/30">
                            <input type="radio" name="payment_method" value="credit_card" class="hidden">
                            <span class="font-bold text-gray-900 mb-1">Kartu Kredit</span>
                            <span class="text-xs text-gray-500 text-center">Visa / Mastercard</span>
                        </label>
                    </div>
                </div>

                <!-- Catatan -->
                <div class="bg-white p-8 rounded-2xl border border-gray-200/60 shadow-sm">
                    <h2 class="font-serif text-2xl text-[#3D405B] font-bold mb-6">3. Catatan Pesanan</h2>
                    <textarea name="notes" rows="3" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-[#E07A5F] focus:ring-[#E07A5F] text-sm" placeholder="Contoh: Tolong titip di pos satpam ya..."></textarea>
                </div>
            </div>

            <!-- Summary Sidebar -->
            <div class="w-full lg:w-1/3">
                <div class="bg-white p-6 rounded-2xl border border-gray-200/60 shadow-sm sticky top-8">
                    <h2 class="font-serif text-2xl text-[#3D405B] font-bold mb-6">Ringkasan Pesanan</h2>
                    
                    <div class="space-y-4 mb-6">
                        @foreach($cartItems as $item)
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600 line-clamp-1 flex-grow pr-4">{{ $item->quantity }}x {{ $item->productVariant->product->name }}</span>
                                <span class="font-medium text-gray-900 whitespace-nowrap">{{ $item->formattedSubtotal() }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-t border-gray-200 pt-4 space-y-3 mb-6">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal</span>
                            <span class="font-medium text-gray-900">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Ongkos Kirim</span>
                            <span class="font-medium text-gray-900">Rp {{ number_format($shippingCost, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    
                    <div class="border-t border-gray-200 pt-4 mb-8">
                        <div class="flex justify-between items-center">
                            <span class="font-medium text-gray-900">Total Pembayaran</span>
                            <span class="font-bold text-2xl text-[#E07A5F]">Rp {{ number_format($subtotal + $shippingCost, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    
                    <button type="submit" class="w-full flex items-center justify-center px-6 py-4 bg-[#E07A5F] text-white text-lg font-semibold rounded-xl shadow-sm hover:bg-[#C96B50] hover:shadow-md transition-all duration-300" {{ $addresses->isEmpty() ? 'disabled' : '' }}>
                        Buat Pesanan
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
