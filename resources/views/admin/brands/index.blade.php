<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-serif font-semibold text-2xl text-navy leading-tight">
                Daftar Brand
            </h2>
            <a href="{{ route('admin.brands.create') }}" class="inline-flex items-center justify-center px-6 py-2 bg-terracotta text-white font-semibold rounded-xl shadow-sm hover:bg-[#C96B50] hover:shadow-md transition-all duration-300">
                Tambah Brand
            </a>
        </div>
    </x-slot>

    <div class="bg-white rounded-2xl border border-gray-200/60 shadow-sm overflow-hidden mb-8">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50 text-gray-500">
                    <tr>
                        <th class="px-6 py-3 font-medium">Logo</th>
                        <th class="px-6 py-3 font-medium">Nama Brand</th>
                        <th class="px-6 py-3 font-medium">Jumlah Produk</th>
                        <th class="px-6 py-3 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200/60">
                    @forelse ($brands as $brand)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="w-12 h-12 rounded bg-gray-50 flex items-center justify-center overflow-hidden border border-gray-200">
                                    @if($brand->logo)
                                        <img src="{{ asset('storage/' . $brand->logo) }}" alt="{{ $brand->name }}" class="w-full h-full object-contain">
                                    @else
                                        <span class="text-gray-400 text-xs">No Logo</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 font-bold text-navy">{{ $brand->name }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    {{ $brand->products_count ?? 0 }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end space-x-3">
                                    <a href="{{ route('admin.brands.edit', $brand) }}" class="text-blue-600 hover:text-blue-800 transition-colors">Edit</a>
                                    <form action="{{ route('admin.brands.destroy', $brand) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus brand ini?');" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 transition-colors">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-500">Tidak ada brand ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
