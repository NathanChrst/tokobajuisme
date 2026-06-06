<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pesanan Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="space-y-6">
                @forelse ($orders as $order)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <span class="text-sm text-gray-500">Pesanan #{{ $order->id }}</span>
                                    <span class="ml-4 text-sm text-gray-500">{{ $order->created_at->format('d M Y H:i') }}</span>
                                </div>
                                <span class="px-3 py-1 text-sm font-medium rounded-full
                                    @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($order->status === 'processing') bg-blue-100 text-blue-800
                                    @elseif($order->status === 'completed') bg-green-100 text-green-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                            @foreach ($order->items as $item)
                                <div class="flex items-center gap-4 py-2 border-b border-gray-50 last:border-0">
                                    <div class="w-12 h-12 bg-gray-100 rounded flex items-center justify-center shrink-0">
                                        @if ($item->product->image)
                                            <img src="{{ Storage::url($item->product->image) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover rounded">
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-900">{{ $item->product->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                    </div>
                                    <p class="text-sm font-semibold">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                                </div>
                            @endforeach
                            <div class="mt-4 text-right">
                                <span class="text-lg font-bold text-gray-900">Total: Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-12 text-center text-gray-500">
                            <p class="text-lg">Belum ada pesanan.</p>
                            <a href="{{ route('products.index') }}" class="text-indigo-600 hover:text-indigo-800 mt-2 inline-block">Jelajahi produk &rarr;</a>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
