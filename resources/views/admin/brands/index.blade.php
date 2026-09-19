<x-admin-layout>
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8 pb-4 border-b border-[#232336]">
        <div>
            <h1 class="font-serif font-bold text-2xl sm:text-3xl text-white tracking-tight">Daftar Brand</h1>
            <p class="text-xs sm:text-sm text-slate-400 mt-1">Kelola brand dan produsen pakaian mitra Jcloths</p>
        </div>
        <a href="{{ route('admin.brands.create') }}" class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl shadow-lg shadow-blue-600/30 hover:shadow-blue-600/50 transition-all text-sm">
            + Tambah Brand
        </a>
    </div>

    <div class="bg-[#121218] rounded-2xl border border-[#232336] shadow-xl overflow-hidden mb-8">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-[#0D0D12] text-slate-400 border-b border-[#232336]">
                    <tr>
                        <th class="px-6 py-3.5 font-medium">Logo</th>
                        <th class="px-6 py-3.5 font-medium">Nama Brand</th>
                        <th class="px-6 py-3.5 font-medium">Jumlah Produk</th>
                        <th class="px-6 py-3.5 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#232336]">
                    @forelse ($brands as $brand)
                        <tr class="hover:bg-[#161622]/60 transition-colors">
                            <td class="px-6 py-4">
                                <div class="w-12 h-12 rounded-xl bg-[#161622] flex items-center justify-center overflow-hidden border border-[#232336]">
                                    @if($brand->logo)
                                        <img src="{{ asset('storage/' . $brand->logo) }}" alt="{{ $brand->name }}" class="w-full h-full object-contain p-1">
                                    @else
                                        <span class="text-slate-500 text-[10px] font-medium">No Logo</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 font-semibold text-white">{{ $brand->name }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#161622] text-blue-400 border border-[#232336]">
                                    {{ $brand->products_count ?? 0 }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end space-x-3">
                                    <a href="{{ route('admin.brands.edit', $brand) }}" class="text-blue-400 hover:text-blue-300 font-medium text-xs sm:text-sm transition-colors">Edit</a>
                                    <form action="{{ route('admin.brands.destroy', $brand) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus brand ini?');" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-300 font-medium text-xs sm:text-sm transition-colors cursor-pointer">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-slate-500">Tidak ada brand ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
