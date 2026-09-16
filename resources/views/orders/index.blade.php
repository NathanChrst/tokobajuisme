<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h1 class="font-serif text-4xl text-[#3D405B] font-bold mb-10">Daftar Pesanan</h1>

        @if($orders->isEmpty())
            <div class="bg-white rounded-2xl border border-gray-200/60 shadow-sm p-16 text-center">
                <div class="text-6xl mb-6">📦</div>
                <h3 class="font-serif text-2xl text-[#3D405B] mb-2 font-bold">Belum Ada Pesanan</h3>
                <p class="text-gray-500 mb-8">Kamu belum pernah melakukan pemesanan. Yuk mulai belanja!</p>
                <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center px-8 py-3 bg-[#E07A5F] text-white font-semibold rounded-xl shadow-sm hover:bg-[#C96B50] hover:shadow-md transition-all duration-300">
                    Mulai Belanja
                </a>
            </div>
        @else
            <div class="space-y-6">
                @foreach($orders as $order)
                    <div class="bg-white rounded-2xl border border-gray-200/60 shadow-sm overflow-hidden hover:shadow-md transition-all">
                        <!-- Order Header -->
                        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200/60 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <div class="flex items-center gap-4">
                                <span class="font-bold text-gray-900">{{ $order->order_number }}</span>
                                <span class="text-sm text-gray-500">{{ $order->created_at->format('d M Y, H:i') }}</span>
                            </div>
                            <div>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-{{ $order->statusColor() }}-50 text-{{ $order->statusColor() }}-700 border border-{{ $order->statusColor() }}-200">
                                    {{ $order->statusLabel() }}
                                </span>
                            </div>
                        </div>

                        <!-- Order Content -->
                        <div class="p-6 flex flex-col md:flex-row gap-6 justify-between items-start md:items-center">
                            <!-- Items Preview -->
                            <div class="flex-grow">
                                @php $firstItem = $order->items->first(); @endphp
                                <div class="flex items-start gap-4">
                                    <div class="w-16 h-20 rounded-lg overflow-hidden bg-gray-50 flex-shrink-0">
                                        <img src="{{ $firstItem->productVariant->product->primaryImageUrl() }}" alt="Product" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900 line-clamp-1">{{ $firstItem->productVariant->product->name }}</p>
                                        <p class="text-sm text-gray-500 mt-1">{{ $firstItem->quantity }} barang x {{ $firstItem->formattedPrice() }}</p>
                                        @if($order->items->count() > 1)
                                            <p class="text-xs text-gray-400 mt-2">+ {{ $order->items->count() - 1 }} barang lainnya</p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Total & Action -->
                            <div class="flex flex-col items-end min-w-[200px] border-t md:border-t-0 pt-4 md:pt-0 w-full md:w-auto">
                                <p class="text-sm text-gray-500 mb-1">Total Belanja</p>
                                <p class="font-bold text-xl text-[#3D405B] mb-4">{{ $order->formattedGrandTotal() }}</p>
                                
                                <a href="{{ route('orders.show', $order) }}" class="w-full md:w-auto inline-flex items-center justify-center px-6 py-2 bg-white border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 hover:text-[#E07A5F] hover:border-[#E07A5F] transition-all duration-300">
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
