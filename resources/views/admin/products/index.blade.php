<x-admin-layout>
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8 pb-4 border-b border-[#232336]">
        <div>
            <h1 class="font-serif font-bold text-2xl sm:text-3xl text-white tracking-tight">Daftar Produk</h1>
            <p class="text-xs sm:text-sm text-slate-400 mt-1">Kelola seluruh item pakaian dan inventaris katalog Jcloths</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="inline-flex items-center justify-center gap-1.5 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl shadow-lg shadow-blue-600/30 hover:shadow-blue-600/50 transition-all text-sm">
            <span>+ Tambah Produk</span>
        </a>
    </div>

    <div class="mb-6 flex flex-col md:flex-row gap-4 justify-between items-center bg-[#121218] p-4 rounded-2xl shadow-xl border border-[#232336]">
        <form action="{{ route('admin.products.index') }}" method="GET" class="w-full md:w-1/2 relative">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..." class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-[#161622] border border-[#232336] text-slate-100 placeholder-slate-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/25 text-sm">
            <svg class="w-4 h-4 absolute left-3.5 top-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </form>
        <form action="{{ route('admin.products.index') }}" method="GET" class="w-full md:w-auto">
            @if(request('search'))
                <input type="hidden" name="search" value="{{ request('search') }}">
            @endif
            <select name="status" onchange="this.form.submit()" class="w-full md:w-44 py-2.5 px-3 rounded-xl bg-[#161622] border border-[#232336] text-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/25 text-sm cursor-pointer">
                <option value="">Semua Status</option>
                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Aktif</option>
                <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Nonaktif</option>
            </select>
        </form>
    </div>

    <div class="bg-[#121218] rounded-3xl border border-[#232336] shadow-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-[#0D0D12] text-slate-400 border-b border-[#232336]">
                    <tr>
                        <th class="px-6 py-3.5 font-medium">Produk</th>
                        <th class="px-6 py-3.5 font-medium">Kategori & Brand</th>
                        <th class="px-6 py-3.5 font-medium">Harga</th>
                        <th class="px-6 py-3.5 font-medium">Stok Total</th>
                        <th class="px-6 py-3.5 font-medium">Status</th>
                        <th class="px-6 py-3.5 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#232336]">
                    @forelse ($products as $product)
                        <tr class="hover:bg-[#161622]/60 transition-colors">
                            <td class="px-6 py-4 flex items-center space-x-4">
                                <div class="w-12 h-14 rounded-xl bg-[#161622] border border-[#232336] overflow-hidden flex-shrink-0">
                                    @if($product->images->count() > 0)
                                        <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-slate-600">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <p class="font-semibold text-white text-sm sm:text-base">{{ $product->name }}</p>
                                    @if($product->is_featured)
                                        <span class="inline-block mt-1 px-2 py-0.5 rounded-md text-[10px] font-bold bg-amber-950/60 text-amber-400 border border-amber-800/60">Unggulan</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-slate-200 font-medium">{{ $product->category->name ?? '-' }}</p>
                                <p class="text-xs text-slate-400 mt-0.5">{{ $product->brand->name ?? '-' }}</p>
                            </td>
                            <td class="px-6 py-4 font-bold text-blue-400">
                                {{ $product->formattedPrice() }}
                            </td>
                            <td class="px-6 py-4 text-slate-300">
                                {{ $product->totalStock() }}
                            </td>
                            <td class="px-6 py-4">
                                @if($product->is_active)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-950/60 text-emerald-400 border border-emerald-800/60">Aktif</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-950/60 text-red-400 border border-red-800/60">Nonaktif</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end space-x-3">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="text-blue-400 hover:text-blue-300 transition-colors font-medium text-xs sm:text-sm">Edit</a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-300 transition-colors font-medium text-xs sm:text-sm cursor-pointer">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                Tidak ada produk ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-[#232336] bg-[#0D0D12]">
            {{ $products->links() }}
        </div>
    </div>
</x-admin-layout>
