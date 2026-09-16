<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-serif font-semibold text-2xl text-navy leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="mb-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200/60 flex items-center space-x-4">
            <div class="p-3 bg-terracotta/10 text-terracotta rounded-full">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium">Total Produk</p>
                <p class="text-2xl font-bold text-navy">{{ $stats['total_products'] }}</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200/60 flex items-center space-x-4">
            <div class="p-3 bg-terracotta/10 text-terracotta rounded-full">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium">Total Pesanan</p>
                <p class="text-2xl font-bold text-navy">{{ $stats['total_orders'] }}</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200/60 flex items-center space-x-4">
            <div class="p-3 bg-amber-100 text-amber-600 rounded-full">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium">Pesanan Pending</p>
                <p class="text-2xl font-bold text-navy">{{ $stats['pending_orders'] }}</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200/60 flex items-center space-x-4">
            <div class="p-3 bg-emerald-100 text-emerald-600 rounded-full">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium">Total Pendapatan</p>
                <p class="text-2xl font-bold text-navy">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200/60 flex items-center space-x-4">
            <div class="p-3 bg-blue-100 text-blue-600 rounded-full">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium">Total Customer</p>
                <p class="text-2xl font-bold text-navy">{{ $stats['total_customers'] }}</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200/60 flex items-center space-x-4">
            <div class="p-3 bg-amber-100 text-amber-600 rounded-full">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium">Pembayaran Pending</p>
                <p class="text-2xl font-bold text-navy">{{ $stats['pending_payments'] }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200/60 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200/60 bg-gray-50/50">
            <h3 class="font-serif font-semibold text-lg text-navy">Pesanan Terbaru</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50 text-gray-500">
                    <tr>
                        <th class="px-6 py-3 font-medium">No. Pesanan</th>
                        <th class="px-6 py-3 font-medium">Customer</th>
                        <th class="px-6 py-3 font-medium">Status</th>
                        <th class="px-6 py-3 font-medium">Total</th>
                        <th class="px-6 py-3 font-medium">Tanggal</th>
                        <th class="px-6 py-3 font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200/60">
                    @forelse ($recentOrders as $order)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4 font-medium text-navy">{{ $order->order_number }}</td>
                            <td class="px-6 py-4">{{ $order->user->name ?? 'Guest' }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-{{ $order->statusColor() }}-100 text-{{ $order->statusColor() }}-700">
                                    {{ $order->statusLabel() }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-bold text-terracotta">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-gray-500">{{ $order->created_at->format('d M Y, H:i') }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.orders.show', $order) }}" class="text-terracotta hover:text-navy text-sm font-medium transition-colors">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">Belum ada pesanan terbaru.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
