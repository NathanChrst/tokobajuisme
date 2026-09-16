<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-serif font-semibold text-2xl text-navy leading-tight">
            Daftar Pesanan
        </h2>
    </x-slot>

    <div class="mb-6 flex flex-col md:flex-row gap-4 justify-between items-center bg-white p-4 rounded-2xl shadow-sm border border-gray-200/60">
        <form action="{{ route('admin.orders.index') }}" method="GET" class="w-full md:w-1/2 relative">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nomor pesanan..." class="w-full pl-10 pr-4 py-2 rounded-xl border-gray-200 focus:border-terracotta focus:ring-terracotta shadow-sm">
            <svg class="w-5 h-5 absolute left-3 top-2.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </form>
        <div class="w-full md:w-auto flex space-x-2 overflow-x-auto">
            <a href="{{ route('admin.orders.index') }}" class="px-4 py-2 rounded-xl text-sm font-medium {{ !request('status') ? 'bg-navy text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">Semua</a>
            <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="px-4 py-2 rounded-xl text-sm font-medium {{ request('status') == 'pending' ? 'bg-navy text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">Pending</a>
            <a href="{{ route('admin.orders.index', ['status' => 'processing']) }}" class="px-4 py-2 rounded-xl text-sm font-medium {{ request('status') == 'processing' ? 'bg-navy text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">Diproses</a>
            <a href="{{ route('admin.orders.index', ['status' => 'shipped']) }}" class="px-4 py-2 rounded-xl text-sm font-medium {{ request('status') == 'shipped' ? 'bg-navy text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">Dikirim</a>
            <a href="{{ route('admin.orders.index', ['status' => 'completed']) }}" class="px-4 py-2 rounded-xl text-sm font-medium {{ request('status') == 'completed' ? 'bg-navy text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">Selesai</a>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200/60 shadow-sm overflow-hidden mb-8">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50 text-gray-500">
                    <tr>
                        <th class="px-6 py-3 font-medium">No. Pesanan</th>
                        <th class="px-6 py-3 font-medium">Customer</th>
                        <th class="px-6 py-3 font-medium">Item</th>
                        <th class="px-6 py-3 font-medium">Total</th>
                        <th class="px-6 py-3 font-medium">Status Pesanan</th>
                        <th class="px-6 py-3 font-medium">Status Bayar</th>
                        <th class="px-6 py-3 font-medium">Tanggal</th>
                        <th class="px-6 py-3 font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200/60">
                    @forelse ($orders as $order)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4 font-bold text-navy">{{ $order->order_number }}</td>
                            <td class="px-6 py-4">{{ $order->user->name ?? 'Guest' }}</td>
                            <td class="px-6 py-4 text-gray-500">{{ $order->items_count ?? $order->items->count() }} item</td>
                            <td class="px-6 py-4 font-bold text-terracotta">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-{{ $order->statusColor() }}-100 text-{{ $order->statusColor() }}-700">
                                    {{ $order->statusLabel() }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if($order->payment)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-{{ $order->payment->statusColor() }}-100 text-{{ $order->payment->statusColor() }}-700">
                                        {{ $order->payment->statusLabel() }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700">Belum Bayar</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-gray-500">{{ $order->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.orders.show', $order) }}" class="text-terracotta hover:text-navy text-sm font-medium transition-colors">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center text-gray-500">Tidak ada pesanan ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-200/60 bg-gray-50/50">
            {{ $orders->links() }}
        </div>
    </div>
</x-admin-layout>
