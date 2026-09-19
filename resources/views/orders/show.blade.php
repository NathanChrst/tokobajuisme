<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex items-center justify-between mb-8 pb-4 border-b border-[#232336]">
            <h1 class="font-serif text-2xl sm:text-3xl text-white font-bold tracking-tight">Detail Pesanan</h1>
            <a href="{{ route('orders.index') }}" class="text-sm font-medium text-slate-400 hover:text-blue-400 transition-colors">
                &larr; Kembali ke Daftar Pesanan
            </a>
        </div>

        <!-- Info Card -->
        <div class="bg-[#121218] rounded-2xl border border-[#232336] shadow-xl mb-8 overflow-hidden">
            <div class="px-6 py-4 border-b border-[#232336] flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-[#161622]">
                <div>
                    <p class="text-xs text-slate-400 mb-1">Nomor Pesanan</p>
                    <p class="font-bold text-base sm:text-lg text-white">{{ $order->order_number }}</p>
                </div>
                <div class="sm:text-right">
                    <p class="text-xs text-slate-400 mb-1">Tanggal Pembelian</p>
                    <p class="font-medium text-sm sm:text-base text-slate-200">{{ $order->created_at->format('d F Y, H:i') }}</p>
                </div>
            </div>

            <div class="p-6">
                <div class="flex items-center justify-between">
                    <h3 class="font-semibold text-white">Status Pesanan</h3>
                    <x-status-badge :status="$order->statusLabel()" :color="$order->statusColor()" />
                </div>

                @if($order->isCancelable())
                    <form action="{{ route('orders.cancel', $order) }}" method="POST" class="mt-4 border-t border-[#232336] pt-4" onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?');">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="text-red-400 hover:text-red-300 text-sm font-medium transition-colors cursor-pointer">
                            Batalkan Pesanan
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <!-- Items -->
        <div class="bg-[#121218] rounded-2xl border border-[#232336] shadow-xl mb-8 p-6">
            <h2 class="font-serif text-xl text-white font-bold mb-6 tracking-tight">Daftar Produk</h2>
            
            <div class="space-y-4">
                @foreach($order->items as $item)
                    <div class="flex gap-4 items-center border-b border-[#232336] pb-4 last:border-0 last:pb-0">
                        <div class="w-16 sm:w-20 h-20 sm:h-24 rounded-xl overflow-hidden bg-[#161622] flex-shrink-0 border border-[#232336]">
                            <img src="{{ $item->productVariant->product->primaryImageUrl() }}" alt="{{ $item->productVariant->product->name }}" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-grow">
                            <a href="{{ route('products.show', $item->productVariant->product->slug) }}" class="font-semibold text-white hover:text-blue-400 transition-colors text-sm sm:text-base">
                                {{ $item->productVariant->product->name }}
                            </a>
                            <p class="text-xs text-slate-400 mt-1">Varian: {{ $item->productVariant->color }}, Size {{ $item->productVariant->size }}</p>
                            <p class="text-xs sm:text-sm text-slate-300 mt-1">{{ $item->quantity }} x {{ $item->formattedPrice() }}</p>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-blue-400 text-sm sm:text-base">{{ $item->formattedSubtotal() }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6 pt-6 border-t border-[#232336] space-y-2.5 text-sm">
                <div class="flex justify-between text-slate-400">
                    <span>Total Harga ({{ $order->items->sum('quantity') }} barang)</span>
                    <span class="font-medium text-slate-200">{{ $order->formattedTotalAmount() }}</span>
                </div>
                <div class="flex justify-between text-slate-400">
                    <span>Ongkos Kirim</span>
                    <span class="font-medium text-slate-200">{{ $order->formattedShippingCost() }}</span>
                </div>
                <div class="flex justify-between items-center pt-3 mt-3 border-t border-[#232336]">
                    <span class="font-semibold text-white">Total Belanja</span>
                    <span class="font-bold text-xl text-blue-400">{{ $order->formattedGrandTotal() }}</span>
                </div>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-8">
            <!-- Address -->
            <div class="bg-[#121218] rounded-2xl border border-[#232336] shadow-xl p-6">
                <h2 class="font-serif text-xl text-white font-bold mb-4 tracking-tight">Info Pengiriman</h2>
                <div class="text-sm text-slate-300 space-y-2">
                    <p><span class="font-medium text-slate-400">Label:</span> {{ $order->address->label }}</p>
                    <p class="leading-relaxed">{{ $order->address->fullAddress() }}</p>
                </div>
            </div>

            <!-- Payment -->
            <div class="bg-[#121218] rounded-2xl border border-[#232336] shadow-xl p-6">
                <h2 class="font-serif text-xl text-white font-bold mb-4 tracking-tight">Pembayaran</h2>
                <div class="space-y-4 text-sm">
                    <div class="flex justify-between items-center">
                        <span class="text-slate-400">Metode</span>
                        <span class="font-medium text-white">{{ $order->payment->methodLabel() }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-slate-400">Status</span>
                        <x-status-badge :status="$order->payment->statusLabel()" :color="$order->payment->statusColor()" />
                    </div>

                    @if($order->payment->method === 'transfer_bank' && $order->payment->isPending())
                        <div class="pt-4 border-t border-[#232336] mt-4">
                            <p class="text-xs sm:text-sm text-slate-300 mb-3">Silakan upload bukti transfer agar pesanan bisa diproses oleh admin.</p>
                            <form action="{{ route('payments.upload', $order) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="proof" class="w-full text-xs text-slate-400 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#161622] file:text-blue-400 hover:file:bg-[#1E1E2D] mb-3 cursor-pointer" accept="image/*" required>
                                <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl shadow-md shadow-blue-600/30 transition-all cursor-pointer">
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
