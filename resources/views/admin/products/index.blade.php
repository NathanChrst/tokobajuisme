<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-serif font-semibold text-2xl text-navy leading-tight">
                Daftar Produk
            </h2>
            <a href="{{ route('admin.products.create') }}" class="inline-flex items-center justify-center px-6 py-2 bg-terracotta text-white font-semibold rounded-xl shadow-sm hover:bg-[#C96B50] hover:shadow-md transition-all duration-300">
                Tambah Produk
            </a>
        </div>
    </x-slot>

    <div class="mb-6 flex flex-col md:flex-row gap-4 justify-between items-center bg-white p-4 rounded-2xl shadow-sm border border-gray-200/60">
        <form action="{{ route('admin.products.index') }}" method="GET" class="w-full md:w-1/2 relative">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..." class="w-full pl-10 pr-4 py-2 rounded-xl border-gray-200 focus:border-terracotta focus:ring-terracotta shadow-sm">
            <svg class="w-5 h-5 absolute left-3 top-2.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </form>
        <form action="{{ route('admin.products.index') }}" method="GET" class="w-full md:w-auto">
            @if(request('search'))
                <input type="hidden" name="search" value="{{ request('search') }}">
            @endif
            <select name="status" onchange="this.form.submit()" class="w-full rounded-xl border-gray-200 focus:border-terracotta focus:ring-terracotta shadow-sm">
                <option value="">Semua Status</option>
                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Aktif</option>
                <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Nonaktif</option>
            </select>
        </form>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200/60 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50 text-gray-500">
                    <tr>
                        <th class="px-6 py-3 font-medium">Produk</th>
                        <th class="px-6 py-3 font-medium">Kategori & Brand</th>
                        <th class="px-6 py-3 font-medium">Harga</th>
                        <th class="px-6 py-3 font-medium">Stok Total</th>
                        <th class="px-6 py-3 font-medium">Status</th>
                        <th class="px-6 py-3 font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200/60">
                    @forelse ($products as $product)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4 flex items-center space-x-4">
                                <div class="w-12 h-12 rounded-lg bg-gray-100 overflow-hidden flex-shrink-0">
                                    @if($product->images->count() > 0)
                                        <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <p class="font-medium text-navy">{{ $product->name }}</p>
                                    @if($product->is_featured)
                                        <span class="inline-block mt-1 px-2 py-0.5 rounded text-[10px] font-bold bg-amber-100 text-amber-700">Unggulan</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-navy font-medium">{{ $product->category->name ?? '-' }}</p>
                                <p class="text-xs text-gray-500 mt-1">{{ $product->brand->name ?? '-' }}</p>
                            </td>
                            <td class="px-6 py-4 font-bold text-terracotta">
                                {{ $product->formattedPrice() }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $product->totalStock() }}
                            </td>
                            <td class="px-6 py-4">
                                @if($product->is_active)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700 border border-emerald-200">Aktif</span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700 border border-red-200">Nonaktif</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-3">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="text-blue-600 hover:text-blue-800 transition-colors">Edit</a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 transition-colors">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <p class="text-gray-500 mb-2">Tidak ada produk ditemukan.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-200/60 bg-gray-50/50">
            {{ $products->links() }}
        </div>
    </div>
</x-admin-layout>
