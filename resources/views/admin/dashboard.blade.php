<x-admin-layout>
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8 pb-4 border-b border-[#232336]">
        <div>
            <h1 class="font-serif font-bold text-2xl sm:text-3xl text-white tracking-tight">Dashboard Admin</h1>
            <p class="text-xs sm:text-sm text-slate-400 mt-1">Ringkasan performa penjualan dan operasional Jcloths</p>
        </div>
    </div>

    <div class="mb-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-[#121218] p-6 rounded-2xl shadow-xl border border-[#232336] flex items-center space-x-4">
            <div class="p-3 bg-blue-600/20 text-blue-400 border border-blue-500/30 rounded-2xl">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            </div>
            <div>
                <p class="text-xs text-slate-400 font-medium uppercase tracking-wider">Total Produk</p>
                <p class="text-2xl font-bold text-white mt-0.5">{{ $stats['total_products'] }}</p>
            </div>
        </div>
        <div class="bg-[#121218] p-6 rounded-2xl shadow-xl border border-[#232336] flex items-center space-x-4">
            <div class="p-3 bg-blue-600/20 text-blue-400 border border-blue-500/30 rounded-2xl">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
            </div>
            <div>
                <p class="text-xs text-slate-400 font-medium uppercase tracking-wider">Total Pesanan</p>
                <p class="text-2xl font-bold text-white mt-0.5">{{ $stats['total_orders'] }}</p>
            </div>
        </div>
        <div class="bg-[#121218] p-6 rounded-2xl shadow-xl border border-[#232336] flex items-center space-x-4">
            <div class="p-3 bg-amber-950/60 text-amber-400 border border-amber-800/60 rounded-2xl">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-xs text-slate-400 font-medium uppercase tracking-wider">Pesanan Pending</p>
                <p class="text-2xl font-bold text-amber-400 mt-0.5">{{ $stats['pending_orders'] }}</p>
            </div>
        </div>
        <div class="bg-[#121218] p-6 rounded-2xl shadow-xl border border-[#232336] flex items-center space-x-4">
            <div class="p-3 bg-emerald-950/60 text-emerald-400 border border-emerald-800/60 rounded-2xl">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-xs text-slate-400 font-medium uppercase tracking-wider">Total Pendapatan</p>
                <p class="text-2xl font-bold text-emerald-400 mt-0.5">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</p>
            </div>
        </div>
        <div class="bg-[#121218] p-6 rounded-2xl shadow-xl border border-[#232336] flex items-center space-x-4">
            <div class="p-3 bg-blue-600/20 text-blue-400 border border-blue-500/30 rounded-2xl">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <div>
                <p class="text-xs text-slate-400 font-medium uppercase tracking-wider">Total Customer</p>
                <p class="text-2xl font-bold text-white mt-0.5">{{ $stats['total_customers'] }}</p>
            </div>
        </div>
        <div class="bg-[#121218] p-6 rounded-2xl shadow-xl border border-[#232336] flex items-center space-x-4">
            <div class="p-3 bg-amber-950/60 text-amber-400 border border-amber-800/60 rounded-2xl">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
            </div>
            <div>
                <p class="text-xs text-slate-400 font-medium uppercase tracking-wider">Pembayaran Pending</p>
                <p class="text-2xl font-bold text-amber-400 mt-0.5">{{ $stats['pending_payments'] }}</p>
            </div>
        </div>
    </div>

    <div class="bg-[#121218] rounded-2xl border border-[#232336] shadow-xl overflow-hidden">
        <div class="px-6 py-4 border-b border-[#232336] bg-[#161622]">
            <h3 class="font-serif font-semibold text-lg text-white">Pesanan Terbaru</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-[#0D0D12] text-slate-400 border-b border-[#232336]">
                    <tr>
                        <th class="px-6 py-3.5 font-medium">No. Pesanan</th>
                        <th class="px-6 py-3.5 font-medium">Customer</th>
                        <th class="px-6 py-3.5 font-medium">Status</th>
                        <th class="px-6 py-3.5 font-medium">Total</th>
                        <th class="px-6 py-3.5 font-medium">Tanggal</th>
                        <th class="px-6 py-3.5 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#232336]">
                    @forelse ($recentOrders as $order)
                        <tr class="hover:bg-[#161622]/60 transition-colors">
                            <td class="px-6 py-4 font-semibold text-white">{{ $order->order_number }}</td>
                            <td class="px-6 py-4 text-slate-300">{{ $order->user->name ?? 'Guest' }}</td>
                            <td class="px-6 py-4">
                                <x-status-badge :status="$order->statusLabel()" :color="$order->statusColor()" />
                            </td>
                            <td class="px-6 py-4 font-bold text-blue-400">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-slate-400 text-xs">{{ $order->created_at->format('d M Y, H:i') }}</td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.orders.show', $order) }}" class="text-blue-400 hover:text-blue-300 text-xs sm:text-sm font-semibold transition-colors">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-500">Belum ada pesanan terbaru.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
