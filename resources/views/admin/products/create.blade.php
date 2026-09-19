<x-admin-layout>
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8 pb-4 border-b border-[#232336]">
        <div>
            <h1 class="font-serif font-bold text-2xl sm:text-3xl text-white tracking-tight">Tambah Produk Baru</h1>
            <p class="text-xs sm:text-sm text-slate-400 mt-1">Tambahkan item pakaian atau aksesori baru ke katalog Jcloths</p>
        </div>
        <a href="{{ route('admin.products.index') }}" class="text-sm font-medium text-slate-400 hover:text-white transition-colors">&larr; Kembali</a>
    </div>

    <div class="bg-[#121218] rounded-2xl border border-[#232336] shadow-xl p-6 sm:p-8 mb-8">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Info -->
                <div class="lg:col-span-2 space-y-5">
                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-300 mb-2">Nama Produk</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required class="w-full rounded-xl bg-[#161622] border border-[#232336] text-white placeholder-slate-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/25 shadow-sm text-sm">
                        @error('name') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                        <div>
                            <label for="category_id" class="block text-sm font-medium text-slate-300 mb-2">Kategori</label>
                            <select name="category_id" id="category_id" required class="w-full rounded-xl bg-[#161622] border border-[#232336] text-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/25 shadow-sm text-sm cursor-pointer">
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @foreach($category->children as $child)
                                        <option value="{{ $child->id }}" {{ old('category_id') == $child->id ? 'selected' : '' }}>-- {{ $child->name }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                            @error('category_id') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="brand_id" class="block text-sm font-medium text-slate-300 mb-2">Brand</label>
                            <select name="brand_id" id="brand_id" class="w-full rounded-xl bg-[#161622] border border-[#232336] text-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/25 shadow-sm text-sm cursor-pointer">
                                <option value="">Pilih Brand (Opsional)</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                @endforeach
                            </select>
                            @error('brand_id') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-slate-300 mb-2">Deskripsi</label>
                        <textarea name="description" id="description" rows="5" class="w-full rounded-xl bg-[#161622] border border-[#232336] text-white placeholder-slate-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/25 shadow-sm text-sm">{{ old('description') }}</textarea>
                        @error('description') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="base_price" class="block text-sm font-medium text-slate-300 mb-2">Harga Dasar (Rp)</label>
                        <input type="number" name="base_price" id="base_price" value="{{ old('base_price') }}" required class="w-full rounded-xl bg-[#161622] border border-[#232336] text-white placeholder-slate-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/25 shadow-sm text-sm">
                        @error('base_price') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Sidebar Info -->
                <div class="space-y-6">
                    <div class="bg-[#161622] p-5 rounded-2xl border border-[#232336]">
                        <h3 class="font-semibold text-white mb-4 text-sm">Pengaturan Status</h3>
                        <div class="space-y-3">
                            <label class="flex items-center space-x-3 cursor-pointer">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="rounded bg-[#121218] border-[#232336] text-blue-600 focus:ring-blue-500">
                                <span class="text-sm text-slate-300">Aktif (Tampilkan di toko)</span>
                            </label>
                            <label class="flex items-center space-x-3 cursor-pointer">
                                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} class="rounded bg-[#121218] border-[#232336] text-blue-600 focus:ring-blue-500">
                                <span class="text-sm text-slate-300">Produk Unggulan</span>
                            </label>
                        </div>
                    </div>

                    <div class="bg-[#161622] p-5 rounded-2xl border border-[#232336]">
                        <h3 class="font-semibold text-white mb-4 text-sm">Gambar Produk</h3>
                        <input type="file" name="images[]" multiple accept="image/*" class="w-full text-xs text-slate-400 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-600/20 file:text-blue-400 hover:file:bg-blue-600/30 cursor-pointer">
                        <p class="text-xs text-slate-500 mt-2">Pilih beberapa file sekaligus. Format JPG/PNG max 2MB.</p>
                        @error('images.*') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <hr class="my-8 border-[#232336]">

            <div x-data="{ variants: [{ color: '', size: '', stock: 0, sku: '' }] }">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-serif font-bold text-xl text-white">Varian Produk</h3>
                    <button type="button" @click="variants.push({ color: '', size: '', stock: 0, sku: '' })" class="inline-flex items-center px-4 py-2 bg-[#161622] border border-[#232336] text-blue-400 text-xs sm:text-sm font-semibold rounded-xl hover:bg-[#1E1E2D] hover:text-white transition-colors cursor-pointer">
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
                                    <td class="py-3 pr-4">
                                        <input type="text" :name="`variants[${index}][color]`" x-model="variant.color" placeholder="Misal: Hitam" class="w-full rounded-xl bg-[#161622] border border-[#232336] text-white text-xs sm:text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                                    </td>
                                    <td class="py-3 pr-4">
                                        <input type="text" :name="`variants[${index}][size]`" x-model="variant.size" placeholder="Misal: XL" class="w-full rounded-xl bg-[#161622] border border-[#232336] text-white text-xs sm:text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                                    </td>
                                    <td class="py-3 pr-4">
                                        <input type="number" :name="`variants[${index}][stock]`" x-model="variant.stock" min="0" required class="w-full rounded-xl bg-[#161622] border border-[#232336] text-white text-xs sm:text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                                    </td>
                                    <td class="py-3 pr-4">
                                        <input type="text" :name="`variants[${index}][sku]`" x-model="variant.sku" placeholder="Kode SKU" class="w-full rounded-xl bg-[#161622] border border-[#232336] text-white text-xs sm:text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                                    </td>
                                    <td class="py-3 text-right">
                                        <button type="button" @click="variants.splice(index, 1)" class="text-red-400 hover:text-red-300 p-1 cursor-pointer" x-show="variants.length > 1">
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
                    Simpan Produk
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
