<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-serif font-semibold text-2xl text-navy leading-tight">
                Daftar Kategori
            </h2>
            <a href="{{ route('admin.categories.create') }}" class="inline-flex items-center justify-center px-6 py-2 bg-terracotta text-white font-semibold rounded-xl shadow-sm hover:bg-[#C96B50] hover:shadow-md transition-all duration-300">
                Tambah Kategori
            </a>
        </div>
    </x-slot>

    <div class="bg-white rounded-2xl border border-gray-200/60 shadow-sm overflow-hidden mb-8">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50 text-gray-500">
                    <tr>
                        <th class="px-6 py-3 font-medium">Nama Kategori</th>
                        <th class="px-6 py-3 font-medium">Kategori Induk</th>
                        <th class="px-6 py-3 font-medium">Jumlah Produk</th>
                        <th class="px-6 py-3 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200/60">
                    @forelse ($categories as $category)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4 font-bold text-navy">{{ $category->name }}</td>
                            <td class="px-6 py-4 text-gray-500">-</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    {{ $category->products_count ?? 0 }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end space-x-3">
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="text-blue-600 hover:text-blue-800 transition-colors">Edit</a>
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini?');" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 transition-colors">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @foreach($category->children as $child)
                        <tr class="hover:bg-gray-50/50 transition-colors bg-gray-50/30">
                            <td class="px-6 py-4 pl-10 text-navy flex items-center">
                                <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                {{ $child->name }}
                            </td>
                            <td class="px-6 py-4 text-gray-500">{{ $category->name }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    {{ $child->products_count ?? 0 }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end space-x-3">
                                    <a href="{{ route('admin.categories.edit', $child) }}" class="text-blue-600 hover:text-blue-800 transition-colors">Edit</a>
                                    <form action="{{ route('admin.categories.destroy', $child) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini?');" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 transition-colors">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-500">Tidak ada kategori ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
