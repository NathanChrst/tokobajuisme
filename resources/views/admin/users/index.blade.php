<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-100 leading-tight">
            Kelola Pengguna
        </h2>
    </x-slot>

    <div class="mb-6 flex justify-between items-center bg-[#121218] p-4 rounded-2xl shadow-sm border border-[#232336]">
        <form action="{{ route('admin.users.index') }}" method="GET" class="w-full md:w-1/2 relative">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau email..." class="w-full pl-10 pr-4 py-2 rounded-xl bg-[#161622] border-[#232336] text-slate-200 placeholder-slate-500 focus:border-blue-500 focus:ring-blue-500 shadow-sm">
            <svg class="w-5 h-5 absolute left-3 top-2.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </form>
    </div>

    <div class="bg-[#121218] rounded-2xl border border-[#232336] shadow-sm overflow-hidden mb-8">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-[#161622] text-slate-400 uppercase text-xs tracking-wider border-b border-[#232336]">
                    <tr>
                        <th class="px-6 py-3 font-semibold">Nama</th>
                        <th class="px-6 py-3 font-semibold">Email</th>
                        <th class="px-6 py-3 font-semibold">No. HP</th>
                        <th class="px-6 py-3 font-semibold">Total Pesanan</th>
                        <th class="px-6 py-3 font-semibold">Status</th>
                        <th class="px-6 py-3 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#232336] text-slate-300">
                    @forelse ($users as $user)
                        <tr class="hover:bg-[#161622]/50 transition-colors">
                            <td class="px-6 py-4 font-medium text-slate-100">{{ $user->name }}</td>
                            <td class="px-6 py-4 text-slate-300">{{ $user->email }}</td>
                            <td class="px-6 py-4 text-slate-400">{{ $user->phone ?? '-' }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-[#161622] text-xs font-bold text-slate-300 border border-[#232336]">
                                    {{ $user->orders_count ?? 0 }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if($user->is_blocked)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-950/60 text-red-400 border border-red-800/60">Diblokir</span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-950/60 text-emerald-400 border border-emerald-800/60">Aktif</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <form action="{{ route('admin.users.toggleBlock', $user) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    @if($user->is_blocked)
                                        <button type="submit" class="text-emerald-400 hover:text-emerald-300 text-sm font-medium transition-colors" onclick="return confirm('Buka blokir pengguna ini?');">Buka Blokir</button>
                                    @else
                                        <button type="submit" class="text-red-400 hover:text-red-300 text-sm font-medium transition-colors" onclick="return confirm('Blokir pengguna ini?');">Blokir</button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-500">Tidak ada pengguna ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-[#232336] bg-[#161622]/40">
            {{ $users->links() }}
        </div>
    </div>
</x-admin-layout>
