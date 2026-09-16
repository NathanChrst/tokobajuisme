<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-serif font-semibold text-2xl text-navy leading-tight">
            Konfirmasi Pembayaran
        </h2>
    </x-slot>

    <div class="mb-6 flex space-x-2">
        <a href="{{ route('admin.payments.index') }}" class="px-4 py-2 rounded-xl text-sm font-medium {{ !request('status') ? 'bg-navy text-white' : 'bg-white border border-gray-200 text-gray-700 hover:bg-gray-50' }}">Semua</a>
        <a href="{{ route('admin.payments.index', ['status' => 'pending']) }}" class="px-4 py-2 rounded-xl text-sm font-medium {{ request('status') == 'pending' ? 'bg-navy text-white' : 'bg-white border border-gray-200 text-gray-700 hover:bg-gray-50' }}">Menunggu Konfirmasi</a>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200/60 shadow-sm overflow-hidden mb-8">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50 text-gray-500">
                    <tr>
                        <th class="px-6 py-3 font-medium">No. Pesanan</th>
                        <th class="px-6 py-3 font-medium">Customer</th>
                        <th class="px-6 py-3 font-medium">Metode</th>
                        <th class="px-6 py-3 font-medium">Nominal</th>
                        <th class="px-6 py-3 font-medium">Bukti Transfer</th>
                        <th class="px-6 py-3 font-medium">Status</th>
                        <th class="px-6 py-3 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200/60">
                    @forelse ($payments as $payment)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4 font-bold text-navy">
                                <a href="{{ route('admin.orders.show', $payment->order) }}" class="hover:text-terracotta">{{ $payment->order->order_number }}</a>
                            </td>
                            <td class="px-6 py-4">{{ $payment->order->user->name ?? 'Guest' }}</td>
                            <td class="px-6 py-4">{{ $payment->methodLabel() }}</td>
                            <td class="px-6 py-4 font-bold text-terracotta">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                @if($payment->proof_image_path)
                                    <a href="{{ $payment->proof_url }}" target="_blank" class="text-blue-600 hover:underline flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        Lihat
                                    </a>
                                @else
                                    <span class="text-gray-400 text-xs italic">Tidak ada</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-{{ $payment->statusColor() }}-100 text-{{ $payment->statusColor() }}-700">
                                    {{ $payment->statusLabel() }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                @if($payment->isPending())
                                    <div class="flex justify-end space-x-2">
                                        <form action="{{ route('admin.payments.approve', $payment) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="inline-flex items-center px-3 py-1 bg-emerald-500 text-white text-xs font-medium rounded-lg hover:bg-emerald-600 transition-colors" onclick="return confirm('Konfirmasi pembayaran ini?');">Terima</button>
                                        </form>
                                        <form action="{{ route('admin.payments.reject', $payment) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-500 text-white text-xs font-medium rounded-lg hover:bg-red-600 transition-colors" onclick="return confirm('Tolak pembayaran ini?');">Tolak</button>
                                        </form>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-gray-500">Tidak ada pembayaran ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-200/60 bg-gray-50/50">
            {{ $payments->links() }}
        </div>
    </div>
</x-admin-layout>
