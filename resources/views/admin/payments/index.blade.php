<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-100 leading-tight">
            Konfirmasi Pembayaran
        </h2>
    </x-slot>

    <div class="mb-6 flex space-x-2">
        <a href="{{ route('admin.payments.index') }}" class="px-4 py-2 rounded-xl text-sm font-medium transition-colors {{ !request('status') ? 'bg-blue-600 text-white' : 'bg-[#161622] text-slate-300 hover:bg-[#232336] border border-[#232336]' }}">Semua</a>
        <a href="{{ route('admin.payments.index', ['status' => 'pending']) }}" class="px-4 py-2 rounded-xl text-sm font-medium transition-colors {{ request('status') == 'pending' ? 'bg-blue-600 text-white' : 'bg-[#161622] text-slate-300 hover:bg-[#232336] border border-[#232336]' }}">Menunggu Konfirmasi</a>
    </div>

    <div class="bg-[#121218] rounded-2xl border border-[#232336] shadow-sm overflow-hidden mb-8">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-[#161622] text-slate-400 uppercase text-xs tracking-wider border-b border-[#232336]">
                    <tr>
                        <th class="px-6 py-3 font-semibold">No. Pesanan</th>
                        <th class="px-6 py-3 font-semibold">Customer</th>
                        <th class="px-6 py-3 font-semibold">Metode</th>
                        <th class="px-6 py-3 font-semibold">Nominal</th>
                        <th class="px-6 py-3 font-semibold">Bukti Transfer</th>
                        <th class="px-6 py-3 font-semibold">Status</th>
                        <th class="px-6 py-3 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#232336] text-slate-300">
                    @forelse ($payments as $payment)
                        <tr class="hover:bg-[#161622]/50 transition-colors">
                            <td class="px-6 py-4 font-bold text-slate-100">
                                <a href="{{ route('admin.orders.show', $payment->order) }}" class="text-blue-400 hover:text-blue-300 transition-colors">{{ $payment->order->order_number }}</a>
                            </td>
                            <td class="px-6 py-4 text-slate-200">{{ $payment->order->user->name ?? 'Guest' }}</td>
                            <td class="px-6 py-4 text-slate-400">{{ $payment->methodLabel() }}</td>
                            <td class="px-6 py-4 font-bold text-blue-400">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                @if($payment->proof_image_path)
                                    <a href="{{ $payment->proof_url }}" target="_blank" class="text-blue-400 hover:text-blue-300 hover:underline flex items-center gap-1 font-medium">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        Lihat
                                    </a>
                                @else
                                    <span class="text-slate-500 text-xs italic">Tidak ada</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <x-status-badge :status="$payment->statusLabel()" :color="$payment->statusColor()" />
                            </td>
                            <td class="px-6 py-4 text-right">
                                @if($payment->isPending())
                                    <div class="flex justify-end space-x-2">
                                        <form action="{{ route('admin.payments.approve', $payment) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="inline-flex items-center px-3 py-1 bg-emerald-600 text-white text-xs font-semibold rounded-lg hover:bg-emerald-500 transition-colors shadow-sm" onclick="return confirm('Konfirmasi pembayaran ini?');">Terima</button>
                                        </form>
                                        <form action="{{ route('admin.payments.reject', $payment) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-600 text-white text-xs font-semibold rounded-lg hover:bg-red-500 transition-colors shadow-sm" onclick="return confirm('Tolak pembayaran ini?');">Tolak</button>
                                        </form>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-slate-500">Tidak ada pembayaran ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-[#232336] bg-[#161622]/40">
            {{ $payments->links() }}
        </div>
    </div>
</x-admin-layout>
