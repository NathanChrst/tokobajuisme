<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-serif font-semibold text-2xl text-navy leading-tight">
                Edit Brand: {{ $brand->name }}
            </h2>
            <a href="{{ route('admin.brands.index') }}" class="text-gray-500 hover:text-navy transition-colors">Kembali</a>
        </div>
    </x-slot>

    <div class="bg-white rounded-2xl border border-gray-200/60 shadow-sm p-6 mb-8 max-w-2xl mx-auto">
        <form action="{{ route('admin.brands.update', $brand) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="space-y-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Brand</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $brand->name) }}" required class="w-full rounded-xl border-gray-300 focus:border-terracotta focus:ring-terracotta shadow-sm">
                    @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="logo" class="block text-sm font-medium text-gray-700 mb-2">Logo Brand (Opsional)</label>
                    @if($brand->logo)
                        <div class="mb-4 p-2 bg-gray-50 border border-gray-200 rounded-lg inline-block">
                            <img src="{{ asset('storage/' . $brand->logo) }}" alt="{{ $brand->name }}" class="h-20 object-contain">
                        </div>
                    @endif
                    <input type="file" name="logo" id="logo" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-terracotta/10 file:text-terracotta hover:file:bg-terracotta/20">
                    <p class="text-xs text-gray-500 mt-2">Upload baru untuk mengganti logo. Maksimal 2MB (JPG, PNG)</p>
                    @error('logo') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit" class="inline-flex items-center justify-center px-6 py-3 bg-terracotta text-white font-semibold rounded-xl shadow-sm hover:bg-[#C96B50] hover:shadow-md transition-all duration-300">
                        Update Brand
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-admin-layout>
