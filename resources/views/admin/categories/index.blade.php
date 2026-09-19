<x-admin-layout>
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8 pb-4 border-b border-[#232336]">
        <div>
            <h1 class="font-serif font-bold text-2xl sm:text-3xl text-white tracking-tight">Daftar Kategori</h1>
            <p class="text-xs sm:text-sm text-slate-400 mt-1">Kelola hierarki dan klasifikasi produk toko Jcloths</p>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl shadow-lg shadow-blue-600/30 hover:shadow-blue-600/50 transition-all text-sm">
            + Tambah Kategori
        </a>
    </div>

    <div class="bg-[#121218] rounded-2xl border border-[#232336] shadow-xl overflow-hidden mb-8">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-[#0D0D12] text-slate-400 border-b border-[#232336]">
                    <tr>
                        <th class="px-6 py-3.5 font-medium">Nama Kategori</th>
                        <th class="px-6 py-3.5 font-medium">Kategori Induk</th>
                        <th class="px-6 py-3.5 font-medium">Jumlah Produk</th>
                        <th class="px-6 py-3.5 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#232336]">
                    @forelse ($categories as $category)
                        <tr class="hover:bg-[#161622]/60 transition-colors">
                            <td class="px-6 py-4 font-bold text-white">{{ $category->name }}</td>
                            <td class="px-6 py-4 text-slate-500">-</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#161622] text-blue-400 border border-[#232336]">
                                    {{ $category->products_count ?? 0 }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end space-x-3">
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="text-blue-400 hover:text-blue-300 font-medium text-xs sm:text-sm transition-colors">Edit</a>
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini?');" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-300 font-medium text-xs sm:text-sm transition-colors cursor-pointer">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @foreach($category->children as $child)
                        <tr class="hover:bg-[#161622]/60 transition-colors bg-[#0D0D12]/40">
                            <td class="px-6 py-4 pl-10 text-slate-200 flex items-center">
                                <svg class="w-4 h-4 text-slate-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                {{ $child->name }}
                            </td>
                            <td class="px-6 py-4 text-slate-400 text-xs">{{ $category->name }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#161622] text-slate-300 border border-[#232336]">
                                    {{ $child->products_count ?? 0 }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end space-x-3">
                                    <a href="{{ route('admin.categories.edit', $child) }}" class="text-blue-400 hover:text-blue-300 font-medium text-xs sm:text-sm transition-colors">Edit</a>
                                    <form action="{{ route('admin.categories.destroy', $child) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini?');" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-300 font-medium text-xs sm:text-sm transition-colors cursor-pointer">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-slate-500">Tidak ada kategori ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
