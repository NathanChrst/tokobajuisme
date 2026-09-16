<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-serif font-semibold text-2xl text-navy leading-tight">
                Edit Produk: {{ $product->name }}
            </h2>
            <a href="{{ route('admin.products.index') }}" class="text-gray-500 hover:text-navy transition-colors">Kembali</a>
        </div>
    </x-slot>

    <div class="bg-white rounded-2xl border border-gray-200/60 shadow-sm p-6 mb-8">
        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Info -->
                <div class="lg:col-span-2 space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Produk</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required class="w-full rounded-xl border-gray-300 focus:border-terracotta focus:ring-terracotta shadow-sm">
                        @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                            <select name="category_id" id="category_id" required class="w-full rounded-xl border-gray-300 focus:border-terracotta focus:ring-terracotta shadow-sm">
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
                            <label for="brand_id" class="block text-sm font-medium text-gray-700 mb-1">Brand</label>
                            <select name="brand_id" id="brand_id" class="w-full rounded-xl border-gray-300 focus:border-terracotta focus:ring-terracotta shadow-sm">
                                <option value="">Pilih Brand (Opsional)</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="description" id="description" rows="5" class="w-full rounded-xl border-gray-300 focus:border-terracotta focus:ring-terracotta shadow-sm">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div>
                        <label for="base_price" class="block text-sm font-medium text-gray-700 mb-1">Harga Dasar (Rp)</label>
                        <input type="number" name="base_price" id="base_price" value="{{ old('base_price', $product->base_price) }}" required class="w-full rounded-xl border-gray-300 focus:border-terracotta focus:ring-terracotta shadow-sm">
                    </div>
                </div>

                <!-- Sidebar Info -->
                <div class="space-y-6">
                    <div class="bg-gray-50/50 p-4 rounded-xl border border-gray-200/60">
                        <h3 class="font-medium text-navy mb-4">Pengaturan Status</h3>
                        <div class="space-y-4">
                            <label class="flex items-center space-x-3">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }} class="rounded border-gray-300 text-terracotta focus:ring-terracotta">
                                <span class="text-sm text-gray-700">Aktif (Tampilkan di toko)</span>
                            </label>
                            <label class="flex items-center space-x-3">
                                <input type="hidden" name="is_featured" value="0">
                                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }} class="rounded border-gray-300 text-terracotta focus:ring-terracotta">
                                <span class="text-sm text-gray-700">Produk Unggulan</span>
                            </label>
                        </div>
                    </div>

                    <div class="bg-gray-50/50 p-4 rounded-xl border border-gray-200/60">
                        <h3 class="font-medium text-navy mb-4">Gambar Produk</h3>
                        
                        @if($product->images->count() > 0)
                            <div class="grid grid-cols-2 gap-2 mb-4">
                                @foreach($product->images as $image)
                                    <div class="relative group rounded-lg overflow-hidden border border-gray-200">
                                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="Product Image" class="w-full h-24 object-cover">
                                        <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity">
                                            <label class="text-white text-xs cursor-pointer flex items-center space-x-1">
                                                <input type="checkbox" name="delete_images[]" value="{{ $image->id }}" class="rounded text-red-500 focus:ring-red-500">
                                                <span>Hapus</span>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <label class="block text-sm font-medium text-gray-700 mb-1">Tambah Gambar Baru</label>
                        <input type="file" name="images[]" multiple accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-terracotta/10 file:text-terracotta hover:file:bg-terracotta/20">
                    </div>
                </div>
            </div>

            <hr class="my-8 border-gray-200/60">

            <div x-data="{ variants: {{ json_encode(old('variants', $product->variants->map(function($v) { return ['id' => $v->id, 'color' => $v->color, 'size' => $v->size, 'stock' => $v->stock, 'sku' => $v->sku]; })->toArray())) }} }">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-serif font-semibold text-xl text-navy">Varian Produk</h3>
                    <button type="button" @click="variants.push({ id: '', color: '', size: '', stock: 0, sku: '' })" class="inline-flex items-center px-4 py-2 bg-navy text-white text-sm font-medium rounded-xl hover:bg-opacity-90 transition-colors">
                        + Tambah Varian
                    </button>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="text-sm text-gray-500 border-b border-gray-200">
                            <tr>
                                <th class="pb-3 font-medium">Warna</th>
                                <th class="pb-3 font-medium">Ukuran</th>
                                <th class="pb-3 font-medium">Stok</th>
                                <th class="pb-3 font-medium">SKU (Opsional)</th>
                                <th class="pb-3 font-medium w-20">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="(variant, index) in variants" :key="index">
                                <tr class="border-b border-gray-100">
                                    <input type="hidden" :name="`variants[${index}][id]`" x-model="variant.id">
                                    <td class="py-3 pr-4">
                                        <input type="text" :name="`variants[${index}][color]`" x-model="variant.color" class="w-full rounded-lg border-gray-300 text-sm focus:border-terracotta focus:ring-terracotta">
                                    </td>
                                    <td class="py-3 pr-4">
                                        <input type="text" :name="`variants[${index}][size]`" x-model="variant.size" class="w-full rounded-lg border-gray-300 text-sm focus:border-terracotta focus:ring-terracotta">
                                    </td>
                                    <td class="py-3 pr-4">
                                        <input type="number" :name="`variants[${index}][stock]`" x-model="variant.stock" min="0" required class="w-full rounded-lg border-gray-300 text-sm focus:border-terracotta focus:ring-terracotta">
                                    </td>
                                    <td class="py-3 pr-4">
                                        <input type="text" :name="`variants[${index}][sku]`" x-model="variant.sku" class="w-full rounded-lg border-gray-300 text-sm focus:border-terracotta focus:ring-terracotta">
                                    </td>
                                    <td class="py-3 text-right">
                                        <button type="button" @click="variants.splice(index, 1)" class="text-red-500 hover:text-red-700">
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
                <button type="submit" class="inline-flex items-center justify-center px-8 py-3 bg-terracotta text-white font-semibold rounded-xl shadow-sm hover:bg-[#C96B50] hover:shadow-md transition-all duration-300">
                    Update Produk
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
