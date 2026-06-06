<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @foreach ($cartItems as $item)
                        <div class="flex items-center justify-between py-3 border-b border-gray-100">
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center shrink-0">
                                    @if ($item->product->image)
                                        <img src="{{ Storage::url($item->product->image) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover rounded-lg">
                                    @else
                                        <span class="text-gray-400 text-xs">No Image</span>
                                    @endif
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">{{ $item->product->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $item->quantity }} x Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            <p class="font-semibold text-gray-900">Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</p>
                        </div>
                    @endforeach

                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="flex items-center justify-between">
                            <span class="text-xl font-bold text-gray-900">Total</span>
                            <span class="text-2xl font-bold text-indigo-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end gap-4">
                        <a href="{{ route('cart.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-gray-700 hover:bg-gray-50 transition-colors">
                            {{ __('Kembali') }}
                        </a>
                        <form action="{{ route('orders.store') }}" method="POST">
                            @csrf
                            <x-primary-button class="px-6 py-3 text-base">{{ __('Buat Pesanan') }}</x-primary-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
