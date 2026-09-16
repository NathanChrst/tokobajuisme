<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-serif font-semibold text-2xl text-navy leading-tight">
            Kelola Pengguna
        </h2>
    </x-slot>

    <div class="mb-6 flex justify-between items-center bg-white p-4 rounded-2xl shadow-sm border border-gray-200/60">
        <form action="{{ route('admin.users.index') }}" method="GET" class="w-full md:w-1/2 relative">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau email..." class="w-full pl-10 pr-4 py-2 rounded-xl border-gray-200 focus:border-terracotta focus:ring-terracotta shadow-sm">
            <svg class="w-5 h-5 absolute left-3 top-2.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </form>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200/60 shadow-sm overflow-hidden mb-8">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50 text-gray-500">
                    <tr>
                        <th class="px-6 py-3 font-medium">Nama</th>
                        <th class="px-6 py-3 font-medium">Email</th>
                        <th class="px-6 py-3 font-medium">No. HP</th>
                        <th class="px-6 py-3 font-medium">Total Pesanan</th>
                        <th class="px-6 py-3 font-medium">Status</th>
                        <th class="px-6 py-3 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200/60">
                    @forelse ($users as $user)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4 font-medium text-navy">{{ $user->name }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $user->email }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $user->phone ?? '-' }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-gray-100 text-xs font-bold text-gray-700">
                                    {{ $user->orders_count ?? 0 }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if($user->is_blocked)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">Diblokir</span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">Aktif</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <form action="{{ route('admin.users.toggleBlock', $user) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    @if($user->is_blocked)
                                        <button type="submit" class="text-emerald-600 hover:text-emerald-800 text-sm font-medium transition-colors" onclick="return confirm('Buka blokir pengguna ini?');">Buka Blokir</button>
                                    @else
                                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium transition-colors" onclick="return confirm('Blokir pengguna ini?');">Blokir</button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">Tidak ada pengguna ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-200/60 bg-gray-50/50">
            {{ $users->links() }}
        </div>
    </div>
</x-admin-layout>
