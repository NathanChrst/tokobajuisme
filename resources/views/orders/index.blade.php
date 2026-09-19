<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="font-serif text-3xl sm:text-4xl text-white font-bold mb-8 tracking-tight">Daftar Pesanan</h1>

        @if($orders->isEmpty())
            <div class="bg-[#121218] rounded-2xl border border-[#232336] shadow-xl p-16 text-center">
                <div class="text-6xl mb-6">📦</div>
                <h3 class="font-serif text-2xl text-white mb-2 font-bold">Belum Ada Pesanan</h3>
                <p class="text-slate-400 mb-8 text-sm">Kamu belum pernah melakukan pemesanan. Yuk mulai belanja!</p>
                <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center px-8 py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl shadow-lg shadow-blue-600/30 hover:shadow-blue-600/50 transition-all text-sm">
                    Mulai Belanja
                </a>
            </div>
        @else
            <div class="space-y-4">
                @foreach($orders as $order)
                    <div class="bg-[#121218] rounded-2xl border border-[#232336] shadow-xl overflow-hidden transition-all">
                        <!-- Order Header -->
                        <div class="bg-[#161622] px-6 py-4 border-b border-[#232336] flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                            <div class="flex items-center gap-4">
                                <span class="font-bold text-white text-sm sm:text-base">{{ $order->order_number }}</span>
                                <span class="text-xs sm:text-sm text-slate-400">{{ $order->created_at->format('d M Y, H:i') }}</span>
                            </div>
                            <div>
                                <x-status-badge :status="$order->statusLabel()" :color="$order->statusColor()" />
                            </div>
                        </div>

                        <!-- Order Content -->
                        <div class="p-6 flex flex-col md:flex-row gap-6 justify-between items-start md:items-center">
                            <!-- Items Preview -->
                            <div class="flex-grow">
                                @php $firstItem = $order->items->first(); @endphp
                                <div class="flex items-start gap-4">
                                    <div class="w-16 h-20 rounded-xl overflow-hidden bg-[#161622] border border-[#232336] flex-shrink-0">
                                        <img src="{{ $firstItem->productVariant->product->primaryImageUrl() }}" alt="Product" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <p class="font-semibold text-white line-clamp-1 text-sm sm:text-base">{{ $firstItem->productVariant->product->name }}</p>
                                        <p class="text-xs sm:text-sm text-slate-400 mt-1">{{ $firstItem->quantity }} barang x {{ $firstItem->formattedPrice() }}</p>
                                        @if($order->items->count() > 1)
                                            <p class="text-xs text-slate-500 mt-2">+ {{ $order->items->count() - 1 }} barang lainnya</p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Total & Action -->
                            <div class="flex flex-col items-end min-w-[200px] border-t border-[#232336] md:border-t-0 pt-4 md:pt-0 w-full md:w-auto">
                                <p class="text-xs text-slate-400 mb-1">Total Belanja</p>
                                <p class="font-bold text-xl text-blue-400 mb-4">{{ $order->formattedGrandTotal() }}</p>
                                
                                <a href="{{ route('orders.show', $order) }}" class="w-full md:w-auto inline-flex items-center justify-center px-6 py-2.5 bg-[#161622] border border-[#232336] text-slate-200 font-semibold rounded-xl hover:bg-[#1E1E2D] hover:text-white hover:border-blue-500/50 transition-all text-sm">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
