<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-serif font-semibold text-2xl text-navy leading-tight">
                Tambah Kategori Baru
            </h2>
            <a href="{{ route('admin.categories.index') }}" class="text-gray-500 hover:text-navy transition-colors">Kembali</a>
        </div>
    </x-slot>

    <div class="bg-white rounded-2xl border border-gray-200/60 shadow-sm p-6 mb-8 max-w-2xl mx-auto">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            
            <div class="space-y-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required class="w-full rounded-xl border-gray-300 focus:border-terracotta focus:ring-terracotta shadow-sm">
                    @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="parent_id" class="block text-sm font-medium text-gray-700 mb-1">Kategori Induk</label>
                    <select name="parent_id" id="parent_id" class="w-full rounded-xl border-gray-300 focus:border-terracotta focus:ring-terracotta shadow-sm">
                        <option value="">Tidak ada (Jadikan kategori utama)</option>
                        @foreach(\App\Models\Category::whereNull('parent_id')->get() as $parent)
                            <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>{{ $parent->name }}</option>
                        @endforeach
                    </select>
                    @error('parent_id') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit" class="inline-flex items-center justify-center px-6 py-3 bg-terracotta text-white font-semibold rounded-xl shadow-sm hover:bg-[#C96B50] hover:shadow-md transition-all duration-300">
                        Simpan Kategori
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-admin-layout>
