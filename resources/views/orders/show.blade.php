<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="flex items-center justify-between mb-8">
            <h1 class="font-serif text-3xl text-[#3D405B] font-bold">Detail Pesanan</h1>
            <a href="{{ route('orders.index') }}" class="text-sm font-medium text-gray-500 hover:text-[#E07A5F] transition-colors">
                &larr; Kembali ke Daftar Pesanan
            </a>
        </div>

        <!-- Info Card -->
        <div class="bg-white rounded-2xl border border-gray-200/60 shadow-sm mb-8 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-gray-50/50">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Nomor Pesanan</p>
                    <p class="font-bold text-lg text-gray-900">{{ $order->order_number }}</p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-500 mb-1">Tanggal Pembelian</p>
                    <p class="font-medium text-gray-900">{{ $order->created_at->format('d F Y, H:i') }}</p>
                </div>
            </div>

            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="font-bold text-gray-900">Status Pesanan</h3>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-{{ $order->statusColor() }}-50 text-{{ $order->statusColor() }}-700 border border-{{ $order->statusColor() }}-200">
                        {{ $order->statusLabel() }}
                    </span>
                </div>

                @if($order->isCancelable())
                    <form action="{{ route('orders.cancel', $order) }}" method="POST" class="mt-4 border-t border-gray-100 pt-4" onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?');">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="text-red-500 text-sm font-medium hover:underline">
                            Batalkan Pesanan
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <!-- Items -->
        <div class="bg-white rounded-2xl border border-gray-200/60 shadow-sm mb-8 p-6">
            <h2 class="font-serif text-xl text-[#3D405B] font-bold mb-6">Daftar Produk</h2>
            
            <div class="space-y-6">
                @foreach($order->items as $item)
                    <div class="flex gap-4 items-center">
                        <div class="w-20 h-24 rounded-xl overflow-hidden bg-gray-50 flex-shrink-0 border border-gray-100">
                            <img src="{{ $item->productVariant->product->primaryImageUrl() }}" alt="{{ $item->productVariant->product->name }}" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-grow">
                            <a href="{{ route('products.show', $item->productVariant->product->slug) }}" class="font-medium text-gray-900 hover:text-[#E07A5F] transition-colors">
                                {{ $item->productVariant->product->name }}
                            </a>
                            <p class="text-sm text-gray-500 mt-1">Varian: {{ $item->productVariant->color }}, Size {{ $item->productVariant->size }}</p>
                            <p class="text-sm text-gray-500">{{ $item->quantity }} x {{ $item->formattedPrice() }}</p>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-[#E07A5F]">{{ $item->formattedSubtotal() }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8 pt-6 border-t border-gray-100 space-y-3">
                <div class="flex justify-between text-gray-600">
                    <span>Total Harga ({{ $order->items->sum('quantity') }} barang)</span>
                    <span class="font-medium">{{ $order->formattedTotalAmount() }}</span>
                </div>
                <div class="flex justify-between text-gray-600">
                    <span>Ongkos Kirim</span>
                    <span class="font-medium">{{ $order->formattedShippingCost() }}</span>
                </div>
                <div class="flex justify-between items-center pt-3 mt-3 border-t border-gray-100">
                    <span class="font-bold text-gray-900">Total Belanja</span>
                    <span class="font-bold text-xl text-[#3D405B]">{{ $order->formattedGrandTotal() }}</span>
                </div>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-8">
            <!-- Address -->
            <div class="bg-white rounded-2xl border border-gray-200/60 shadow-sm p-6">
                <h2 class="font-serif text-xl text-[#3D405B] font-bold mb-4">Info Pengiriman</h2>
                <div class="text-sm text-gray-600 space-y-2">
                    <p><span class="font-medium text-gray-900">Label:</span> {{ $order->address->label }}</p>
                    <p class="leading-relaxed">{{ $order->address->fullAddress() }}</p>
                </div>
            </div>

            <!-- Payment -->
            <div class="bg-white rounded-2xl border border-gray-200/60 shadow-sm p-6">
                <h2 class="font-serif text-xl text-[#3D405B] font-bold mb-4">Pembayaran</h2>
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Metode</span>
                        <span class="font-medium text-gray-900">{{ $order->payment->methodLabel() }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Status</span>
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-{{ $order->payment->statusColor() }}-50 text-{{ $order->payment->statusColor() }}-700">
                            {{ $order->payment->statusLabel() }}
                        </span>
                    </div>

                    @if($order->payment->method === 'transfer_bank' && $order->payment->isPending())
                        <div class="pt-4 border-t border-gray-100 mt-4">
                            <p class="text-sm text-gray-600 mb-3">Silakan upload bukti transfer agar pesanan bisa diproses.</p>
                            <form action="{{ route('payments.upload', $order) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="proof" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-[#E07A5F] hover:file:bg-orange-100 mb-3" accept="image/*" required>
                                <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-[#E07A5F] text-white text-sm font-semibold rounded-xl hover:bg-[#C96B50] transition-colors">
                                    Upload Bukti
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
