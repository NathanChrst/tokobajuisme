<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-100 leading-tight">
            Daftar Pesanan
        </h2>
    </x-slot>

    <div class="mb-6 flex flex-col md:flex-row gap-4 justify-between items-center bg-[#121218] p-4 rounded-2xl shadow-sm border border-[#232336]">
        <form action="{{ route('admin.orders.index') }}" method="GET" class="w-full md:w-1/2 relative">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nomor pesanan..." class="w-full pl-10 pr-4 py-2 rounded-xl bg-[#161622] border-[#232336] text-slate-200 placeholder-slate-500 focus:border-blue-500 focus:ring-blue-500 shadow-sm">
            <svg class="w-5 h-5 absolute left-3 top-2.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </form>
        <div class="w-full md:w-auto flex space-x-2 overflow-x-auto">
            <a href="{{ route('admin.orders.index') }}" class="px-4 py-2 rounded-xl text-sm font-medium transition-colors {{ !request('status') ? 'bg-blue-600 text-white' : 'bg-[#161622] text-slate-300 hover:bg-[#232336] border border-[#232336]' }}">Semua</a>
            <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="px-4 py-2 rounded-xl text-sm font-medium transition-colors {{ request('status') == 'pending' ? 'bg-blue-600 text-white' : 'bg-[#161622] text-slate-300 hover:bg-[#232336] border border-[#232336]' }}">Pending</a>
            <a href="{{ route('admin.orders.index', ['status' => 'processing']) }}" class="px-4 py-2 rounded-xl text-sm font-medium transition-colors {{ request('status') == 'processing' ? 'bg-blue-600 text-white' : 'bg-[#161622] text-slate-300 hover:bg-[#232336] border border-[#232336]' }}">Diproses</a>
            <a href="{{ route('admin.orders.index', ['status' => 'shipped']) }}" class="px-4 py-2 rounded-xl text-sm font-medium transition-colors {{ request('status') == 'shipped' ? 'bg-blue-600 text-white' : 'bg-[#161622] text-slate-300 hover:bg-[#232336] border border-[#232336]' }}">Dikirim</a>
            <a href="{{ route('admin.orders.index', ['status' => 'completed']) }}" class="px-4 py-2 rounded-xl text-sm font-medium transition-colors {{ request('status') == 'completed' ? 'bg-blue-600 text-white' : 'bg-[#161622] text-slate-300 hover:bg-[#232336] border border-[#232336]' }}">Selesai</a>
        </div>
    </div>

    <div class="bg-[#121218] rounded-2xl border border-[#232336] shadow-sm overflow-hidden mb-8">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-[#161622] text-slate-400 uppercase text-xs tracking-wider border-b border-[#232336]">
                    <tr>
                        <th class="px-6 py-3 font-semibold">No. Pesanan</th>
                        <th class="px-6 py-3 font-semibold">Customer</th>
                        <th class="px-6 py-3 font-semibold">Item</th>
                        <th class="px-6 py-3 font-semibold">Total</th>
                        <th class="px-6 py-3 font-semibold">Status Pesanan</th>
                        <th class="px-6 py-3 font-semibold">Status Bayar</th>
                        <th class="px-6 py-3 font-semibold">Tanggal</th>
                        <th class="px-6 py-3 font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#232336] text-slate-300">
                    @forelse ($orders as $order)
                        <tr class="hover:bg-[#161622]/50 transition-colors">
                            <td class="px-6 py-4 font-bold text-slate-100">{{ $order->order_number }}</td>
                            <td class="px-6 py-4 text-slate-200">{{ $order->user->name ?? 'Guest' }}</td>
                            <td class="px-6 py-4 text-slate-400">{{ $order->items_count ?? $order->items->count() }} item</td>
                            <td class="px-6 py-4 font-bold text-blue-400">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                <x-status-badge :status="$order->statusLabel()" :color="$order->statusColor()" />
                            </td>
                            <td class="px-6 py-4">
                                @if($order->payment)
                                    <x-status-badge :status="$order->payment->statusLabel()" :color="$order->payment->statusColor()" />
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border bg-[#161622] text-slate-400 border-[#232336]">Belum Bayar</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-slate-400">{{ $order->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.orders.show', $order) }}" class="text-blue-400 hover:text-blue-300 text-sm font-medium transition-colors">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center text-slate-500">Tidak ada pesanan ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-[#232336] bg-[#161622]/40">
            {{ $orders->links() }}
        </div>
    </div>
</x-admin-layout>
