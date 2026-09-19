<x-admin-layout>
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8 pb-4 border-b border-[#232336]">
        <div>
            <h1 class="font-serif font-bold text-2xl sm:text-3xl text-white tracking-tight">Edit Produk</h1>
            <p class="text-xs sm:text-sm text-slate-400 mt-1">{{ $product->name }}</p>
        </div>
        <a href="{{ route('admin.products.index') }}" class="text-sm font-medium text-slate-400 hover:text-white transition-colors">&larr; Kembali</a>
    </div>

    <div class="bg-[#121218] rounded-2xl border border-[#232336] shadow-xl p-6 sm:p-8 mb-8">
        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Info -->
                <div class="lg:col-span-2 space-y-5">
                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-300 mb-2">Nama Produk</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required class="w-full rounded-xl bg-[#161622] border border-[#232336] text-white placeholder-slate-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/25 shadow-sm text-sm">
                        @error('name') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                        <div>
                            <label for="category_id" class="block text-sm font-medium text-slate-300 mb-2">Kategori</label>
                            <select name="category_id" id="category_id" required class="w-full rounded-xl bg-[#161622] border border-[#232336] text-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/25 shadow-sm text-sm cursor-pointer">
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @foreach($category->children as $child)
                                        <option value="{{ $child->id }}" {{ old('category_id', $product->category_id) == $child->id ? 'selected' : '' }}>-- {{ $child->name }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="brand_id" class="block text-sm font-medium text-slate-300 mb-2">Brand</label>
                            <select name="brand_id" id="brand_id" class="w-full rounded-xl bg-[#161622] border border-[#232336] text-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/25 shadow-sm text-sm cursor-pointer">
                                <option value="">Pilih Brand (Opsional)</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-slate-300 mb-2">Deskripsi</label>
                        <textarea name="description" id="description" rows="5" class="w-full rounded-xl bg-[#161622] border border-[#232336] text-white placeholder-slate-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/25 shadow-sm text-sm">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div>
                        <label for="base_price" class="block text-sm font-medium text-slate-300 mb-2">Harga Dasar (Rp)</label>
                        <input type="number" name="base_price" id="base_price" value="{{ old('base_price', $product->base_price) }}" required class="w-full rounded-xl bg-[#161622] border border-[#232336] text-white placeholder-slate-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/25 shadow-sm text-sm">
                    </div>
                </div>

                <!-- Sidebar Info -->
                <div class="space-y-6">
                    <div class="bg-[#161622] p-5 rounded-2xl border border-[#232336]">
                        <h3 class="font-semibold text-white mb-4 text-sm">Pengaturan Status</h3>
                        <div class="space-y-3">
                            <label class="flex items-center space-x-3 cursor-pointer">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }} class="rounded bg-[#121218] border-[#232336] text-blue-600 focus:ring-blue-500">
                                <span class="text-sm text-slate-300">Aktif (Tampilkan di toko)</span>
                            </label>
                            <label class="flex items-center space-x-3 cursor-pointer">
                                <input type="hidden" name="is_featured" value="0">
                                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }} class="rounded bg-[#121218] border-[#232336] text-blue-600 focus:ring-blue-500">
                                <span class="text-sm text-slate-300">Produk Unggulan</span>
                            </label>
                        </div>
                    </div>

                    <div class="bg-[#161622] p-5 rounded-2xl border border-[#232336]">
                        <h3 class="font-semibold text-white mb-4 text-sm">Gambar Produk</h3>
                        
                        @if($product->images->count() > 0)
                            <div class="grid grid-cols-2 gap-3 mb-4">
                                @foreach($product->images as $image)
                                    <div class="relative group rounded-xl overflow-hidden border border-[#232336] bg-[#121218]">
                                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="Product Image" class="w-full h-24 object-cover">
                                        <div class="absolute inset-0 bg-black/70 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity">
                                            <label class="text-white text-xs cursor-pointer flex items-center space-x-1.5 bg-red-600/80 px-2 py-1 rounded-lg">
                                                <input type="checkbox" name="delete_images[]" value="{{ $image->id }}" class="rounded text-red-500 focus:ring-red-500">
                                                <span>Hapus</span>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <label class="block text-xs font-medium text-slate-300 mb-1.5">Tambah Gambar Baru</label>
                        <input type="file" name="images[]" multiple accept="image/*" class="w-full text-xs text-slate-400 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-600/20 file:text-blue-400 hover:file:bg-blue-600/30 cursor-pointer">
                    </div>
                </div>
            </div>

            <hr class="my-8 border-[#232336]">

            <div x-data="{ variants: {{ json_encode(old('variants', $product->variants->map(function($v) { return ['id' => $v->id, 'color' => $v->color, 'size' => $v->size, 'stock' => $v->stock, 'sku' => $v->sku]; })->toArray())) }} }">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-serif font-bold text-xl text-white">Varian Produk</h3>
                    <button type="button" @click="variants.push({ id: '', color: '', size: '', stock: 0, sku: '' })" class="inline-flex items-center px-4 py-2 bg-[#161622] border border-[#232336] text-blue-400 text-xs sm:text-sm font-semibold rounded-xl hover:bg-[#1E1E2D] hover:text-white transition-colors cursor-pointer">
                        + Tambah Varian
                    </button>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="text-xs text-slate-400 border-b border-[#232336]">
                            <tr>
                                <th class="pb-3 font-medium">Warna</th>
                                <th class="pb-3 font-medium">Ukuran</th>
                                <th class="pb-3 font-medium">Stok</th>
                                <th class="pb-3 font-medium">SKU (Opsional)</th>
                                <th class="pb-3 font-medium w-20 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#232336]">
                            <template x-for="(variant, index) in variants" :key="index">
                                <tr>
                                    <input type="hidden" :name="`variants[${index}][id]`" x-model="variant.id">
                                    <td class="py-3 pr-4">
                                        <input type="text" :name="`variants[${index}][color]`" x-model="variant.color" class="w-full rounded-xl bg-[#161622] border border-[#232336] text-white text-xs sm:text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                                    </td>
                                    <td class="py-3 pr-4">
                                        <input type="text" :name="`variants[${index}][size]`" x-model="variant.size" class="w-full rounded-xl bg-[#161622] border border-[#232336] text-white text-xs sm:text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                                    </td>
                                    <td class="py-3 pr-4">
                                        <input type="number" :name="`variants[${index}][stock]`" x-model="variant.stock" min="0" required class="w-full rounded-xl bg-[#161622] border border-[#232336] text-white text-xs sm:text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                                    </td>
                                    <td class="py-3 pr-4">
                                        <input type="text" :name="`variants[${index}][sku]`" x-model="variant.sku" class="w-full rounded-xl bg-[#161622] border border-[#232336] text-white text-xs sm:text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                                    </td>
                                    <td class="py-3 text-right">
                                        <button type="button" @click="variants.splice(index, 1)" class="text-red-400 hover:text-red-300 p-1 cursor-pointer">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-8 flex justify-end">
                <button type="submit" class="inline-flex items-center justify-center px-8 py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl shadow-lg shadow-blue-600/30 hover:shadow-blue-600/50 transition-all text-sm cursor-pointer">
                    Update Produk
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
