<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-serif font-semibold text-2xl text-navy leading-tight">
                Detail Pesanan: #{{ $order->order_number }}
            </h2>
            <a href="{{ route('admin.orders.index') }}" class="text-gray-500 hover:text-navy transition-colors">Kembali</a>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
        <!-- Main Content: Items and Order Info -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl border border-gray-200/60 shadow-sm p-6">
                <h3 class="font-serif font-semibold text-lg text-navy mb-4 border-b border-gray-100 pb-3">Produk yang Dipesan</h3>
                
                <div class="space-y-4">
                    @foreach($order->items as $item)
                        <div class="flex items-center py-2 border-b border-gray-50 last:border-0">
                            <div class="w-16 h-16 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                                @if($item->product && $item->product->images->count() > 0)
                                    <img src="{{ asset('storage/' . $item->product->images->first()->image_path) }}" alt="{{ $item->product_name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                            </div>
                            <div class="ml-4 flex-1">
                                <h4 class="text-sm font-bold text-navy">{{ $item->product_name }}</h4>
                                <p class="text-xs text-gray-500 mt-1">
                                    @if($item->variant_color) Warna: {{ $item->variant_color }} @endif
                                    @if($item->variant_size) | Ukuran: {{ $item->variant_size }} @endif
                                </p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-medium text-gray-900">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                <p class="text-sm font-bold text-terracotta mt-1">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6 pt-4 border-t border-gray-200/60 text-right space-y-2">
                    <div class="flex justify-between text-sm text-gray-600">
                        <span>Subtotal Produk</span>
                        <span>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-sm text-gray-600">
                        <span>Ongkos Kirim</span>
                        <span>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-lg font-bold text-navy pt-2 border-t border-gray-100">
                        <span>Total Keseluruhan</span>
                        <span class="text-terracotta">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Customer & Shipping Info -->
            <div class="bg-white rounded-2xl border border-gray-200/60 shadow-sm p-6">
                <h3 class="font-serif font-semibold text-lg text-navy mb-4 border-b border-gray-100 pb-3">Informasi Pengiriman</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Customer</p>
                        <p class="font-medium text-navy">{{ $order->user->name ?? 'Guest' }}</p>
                        <p class="text-sm text-gray-600">{{ $order->user->email ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Alamat Pengiriman</p>
                        <p class="text-sm text-gray-800 leading-relaxed">{{ $order->shipping_address }}</p>
                        <p class="text-sm font-medium text-gray-800 mt-2">No. Resi: <span class="text-terracotta">{{ $order->tracking_number ?? 'Belum ada resi' }}</span></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar: Status & Action -->
        <div class="space-y-6">
            <div class="bg-white rounded-2xl border border-gray-200/60 shadow-sm p-6">
                <h3 class="font-serif font-semibold text-lg text-navy mb-4 border-b border-gray-100 pb-3">Update Status Pesanan</h3>
                
                <div class="mb-6">
                    <p class="text-xs text-gray-500 uppercase tracking-wider mb-2">Status Saat Ini</p>
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-{{ $order->statusColor() }}-100 text-{{ $order->statusColor() }}-700">
                        {{ $order->statusLabel() }}
                    </span>
                </div>

                @if($order->status == 'cancelled')
                    <div class="bg-red-50 p-4 rounded-xl border border-red-100 text-center">
                        <p class="text-red-700 font-medium">Pesanan Dibatalkan</p>
                    </div>
                @else
                    <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="space-y-4">
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Ubah Status Menjadi:</label>
                                <select name="status" id="status" class="w-full rounded-xl border-gray-300 focus:border-terracotta focus:ring-terracotta shadow-sm">
                                    @if($order->status == 'pending')
                                        <option value="processing">Diproses</option>
                                        <option value="cancelled">Batalkan</option>
                                    @elseif($order->status == 'processing')
                                        <option value="shipped">Dikirim</option>
                                    @elseif($order->status == 'shipped')
                                        <option value="completed">Selesai</option>
                                    @endif
                                    <option value="{{ $order->status }}" selected disabled>-- Pilih Status --</option>
                                </select>
                            </div>
                            
                            <!-- Only show resi input if shipping -->
                            <div id="tracking-input-group" style="display: {{ $order->status == 'processing' ? 'block' : 'none' }}">
                                <label for="tracking_number" class="block text-sm font-medium text-gray-700 mb-1">Nomor Resi (Opsional)</label>
                                <input type="text" name="tracking_number" id="tracking_number" value="{{ $order->tracking_number }}" class="w-full rounded-xl border-gray-300 focus:border-terracotta focus:ring-terracotta shadow-sm" placeholder="Masukkan nomor resi...">
                            </div>

                            <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-navy text-white font-semibold rounded-xl shadow-sm hover:bg-opacity-90 transition-all duration-300">
                                Update Status
                            </button>
                        </div>
                    </form>
                @endif
            </div>

            <div class="bg-white rounded-2xl border border-gray-200/60 shadow-sm p-6">
                <h3 class="font-serif font-semibold text-lg text-navy mb-4 border-b border-gray-100 pb-3">Informasi Pembayaran</h3>
                @if($order->payment)
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-500">Metode</span>
                            <span class="text-sm font-medium">{{ $order->payment->methodLabel() }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-500">Status</span>
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-semibold bg-{{ $order->payment->statusColor() }}-100 text-{{ $order->payment->statusColor() }}-700">
                                {{ $order->payment->statusLabel() }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-500">Tanggal</span>
                            <span class="text-sm font-medium">{{ $order->payment->created_at->format('d M Y, H:i') }}</span>
                        </div>
                        @if($order->payment->proof_image_path)
                            <div class="pt-3 mt-3 border-t border-gray-100">
                                <a href="{{ $order->payment->proof_url }}" target="_blank" class="block text-center text-sm text-terracotta hover:text-navy font-medium">Lihat Bukti Transfer</a>
                            </div>
                        @endif
                        <div class="pt-3 mt-3 border-t border-gray-100 text-center">
                            <a href="{{ route('admin.payments.index') }}" class="text-xs text-blue-600 hover:underline">Kelola di menu Pembayaran &rarr;</a>
                        </div>
                    </div>
                @else
                    <p class="text-sm text-gray-500 italic text-center py-4">Belum ada data pembayaran untuk pesanan ini.</p>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.getElementById('status')?.addEventListener('change', function() {
            var trackingGroup = document.getElementById('tracking-input-group');
            if(this.value === 'shipped') {
                trackingGroup.style.display = 'block';
            } else {
                trackingGroup.style.display = 'none';
            }
        });
    </script>
</x-admin-layout>
