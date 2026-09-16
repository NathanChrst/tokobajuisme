@props(['product'])

<div class="group bg-white rounded-2xl border border-gray-200/60 shadow-sm hover:shadow-md transition-all duration-300 hover:scale-[1.02] overflow-hidden flex flex-col h-full">
    <div class="aspect-[3/4] overflow-hidden relative">
        @if($product->images && $product->images->count() > 0)
            <img src="{{ Storage::url($product->images->first()->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
        @else
            <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
        @endif
        
        <!-- Badges -->
        <div class="absolute top-3 left-3 flex flex-col gap-2">
            @if($product->created_at && $product->created_at->diffInDays(now()) <= 30)
                <span class="bg-terracotta text-white text-xs font-bold px-3 py-1 rounded-full shadow-sm">Baru</span>
            @endif
        </div>

        <!-- Wishlist heart -->
        @auth
            <form action="{{ route('wishlist.store') }}" method="POST" class="absolute top-3 right-3">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit" class="w-8 h-8 bg-white/80 backdrop-blur rounded-full flex items-center justify-center hover:bg-white shadow-sm transition-colors group/btn">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover/btn:text-terracotta transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" class="absolute top-3 right-3 w-8 h-8 bg-white/80 backdrop-blur rounded-full flex items-center justify-center hover:bg-white shadow-sm transition-colors group/btn">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover/btn:text-terracotta transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
            </a>
        @endauth
    </div>
    
    <div class="p-4 flex-1 flex flex-col">
        <a href="{{ route('products.show', $product->slug ?? $product->id) }}" class="block mb-auto">
            <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">{{ $product->brand->name ?? 'TokoBaju' }}</p>
            <h3 class="font-medium text-gray-900 line-clamp-2 hover:text-terracotta transition-colors">{{ $product->name }}</h3>
        </a>
        <div class="mt-3 flex items-end justify-between">
            <p class="text-lg font-bold text-terracotta">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
        </div>
    </div>
</div>
