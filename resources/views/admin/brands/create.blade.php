<x-admin-layout>
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8 pb-4 border-b border-[#232336] max-w-2xl mx-auto">
        <div>
            <h1 class="font-serif font-bold text-2xl sm:text-3xl text-white tracking-tight">Tambah Brand Baru</h1>
            <p class="text-xs sm:text-sm text-slate-400 mt-1">Daftarkan merk produk baru</p>
        </div>
        <a href="{{ route('admin.brands.index') }}" class="text-sm font-medium text-slate-400 hover:text-white transition-colors">&larr; Kembali</a>
    </div>

    <div class="bg-[#121218] rounded-2xl border border-[#232336] shadow-xl p-6 sm:p-8 mb-8 max-w-2xl mx-auto">
        <form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="space-y-5">
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-300 mb-2">Nama Brand</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required class="w-full rounded-xl bg-[#161622] border border-[#232336] text-white placeholder-slate-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/25 shadow-sm text-sm" placeholder="Contoh: UNIQLO">
                    @error('name') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="logo" class="block text-sm font-medium text-slate-300 mb-2">Logo Brand (Opsional)</label>
                    <input type="file" name="logo" id="logo" accept="image/*" class="w-full text-xs text-slate-400 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-600/20 file:text-blue-400 hover:file:bg-blue-600/30 cursor-pointer">
                    <p class="text-xs text-slate-500 mt-2">Maksimal 2MB (JPG, PNG)</p>
                    @error('logo') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit" class="inline-flex items-center justify-center px-8 py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl shadow-lg shadow-blue-600/30 hover:shadow-blue-600/50 transition-all text-sm cursor-pointer">
                        Simpan Brand
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-admin-layout>
