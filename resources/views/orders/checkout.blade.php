<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <h1 class="text-3xl font-bold tracking-tight text-foreground">Checkout</h1>

            <div class="bg-gradient-to-br from-card via-card/95 to-muted/90 shadow-elevation-light dark:shadow-elevation-dark p-1">
                <div class="bg-card/50 shadow-elevation-light dark:shadow-elevation-dark-three p-4 sm:p-6 space-y-6">
                    <div class="space-y-4">
                        @php $total = 0; @endphp
                        @foreach($carts as $cart)
                            @php $lineTotal = $cart->quantity * $cart->product->price; $total += $lineTotal; @endphp
                            <div class="flex items-center space-x-4 border-b border-border pb-4 last:border-0 last:pb-0">
                                <img src="{{ $cart->product->image ? asset('storage/' . $cart->product->image) : 'https://placehold.co/100x100' }}" alt="{{ $cart->product->name }}" class="w-16 h-16 object-cover bg-muted">
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-base font-medium text-foreground truncate">{{ $cart->product->name }}</h3>
                                    <p class="text-sm text-muted-foreground">{{ $cart->quantity }} x Rp {{ number_format($cart->product->price, 0, ',', '.') }}</p>
                                </div>
                                <div class="text-base font-medium text-foreground">
                                    Rp {{ number_format($lineTotal, 0, ',', '.') }}
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-t border-border pt-4 flex justify-between items-center">
                        <span class="text-lg font-semibold text-foreground">Total Belanja</span>
                        <span class="text-2xl font-bold text-foreground">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <div class="flex flex-col sm:flex-row items-center justify-end space-y-3 sm:space-y-0 sm:space-x-4 pt-4">
                        <a href="{{ route('cart.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-secondary-foreground bg-secondary border border-input shadow-sm hover:bg-secondary/80 transition-all">
                            Kembali
                        </a>
                        <form method="POST" action="{{ route('orders.store') }}" class="w-full sm:w-auto">
                            @csrf
                            <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-primary-foreground bg-primary shadow-elevation-light dark:shadow-elevation-dark transition-all duration-300 hover:bg-primary/90">
                                Buat Pesanan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
