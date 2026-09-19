@props(['product'])

<div class="group bg-[#121218] rounded-2xl border border-[#232336] shadow-xl hover:shadow-2xl hover:shadow-black/60 hover:border-blue-500/50 transition-all duration-300 hover:scale-[1.02] overflow-hidden flex flex-col h-full">
    <div class="aspect-[3/4] overflow-hidden relative bg-[#161622]">
        @if($product->images && $product->images->count() > 0)
            <img src="{{ Storage::url($product->images->first()->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
        @else
            <div class="w-full h-full bg-[#161622] flex items-center justify-center text-slate-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
        @endif
        
        <!-- Badges -->
        <div class="absolute top-3 left-3 flex flex-col gap-2">
            @if($product->created_at && $product->created_at->diffInDays(now()) <= 30)
                <span class="bg-blue-600 text-white text-[10px] font-bold px-2.5 py-1 rounded-full shadow-md shadow-blue-600/40 uppercase tracking-wider">Baru</span>
            @endif
        </div>

        <!-- Wishlist heart -->
        @auth
            <form action="{{ route('wishlist.store') }}" method="POST" class="absolute top-3 right-3">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit" class="w-8 h-8 bg-[#121218]/80 backdrop-blur rounded-full flex items-center justify-center hover:bg-[#161622] border border-[#232336] shadow-sm transition-colors group/btn cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400 group-hover/btn:text-blue-400 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" class="absolute top-3 right-3 w-8 h-8 bg-[#121218]/80 backdrop-blur rounded-full flex items-center justify-center hover:bg-[#161622] border border-[#232336] shadow-sm transition-colors group/btn cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400 group-hover/btn:text-blue-400 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
            </a>
        @endauth
    </div>
    
    <div class="p-4 flex-1 flex flex-col">
        <a href="{{ route('products.show', $product->slug ?? $product->id) }}" class="block mb-auto">
            <p class="text-xs text-slate-500 uppercase tracking-wider mb-1 font-medium">{{ $product->brand->name ?? 'Jcloths' }}</p>
            <h3 class="font-medium text-slate-100 line-clamp-2 hover:text-blue-400 transition-colors">{{ $product->name }}</h3>
        </a>
        <div class="mt-3 flex items-end justify-between">
            <p class="text-base sm:text-lg font-bold text-blue-400">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
        </div>
    </div>
</div>
