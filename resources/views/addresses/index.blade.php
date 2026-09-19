<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8 pb-4 border-b border-[#232336]">
            <h1 class="font-serif text-3xl sm:text-4xl text-white font-bold tracking-tight">Daftar Alamat</h1>
            <a href="{{ route('addresses.create') }}" class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl shadow-lg shadow-blue-600/30 hover:shadow-blue-600/50 transition-all text-sm">
                + Tambah Alamat
            </a>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($addresses as $address)
                <div class="bg-[#121218] rounded-2xl border shadow-xl p-6 transition-all relative flex flex-col justify-between {{ $address->is_default ? 'border-blue-500 ring-1 ring-blue-500/50' : 'border-[#232336]' }}">
                    @if($address->is_default)
                        <span class="absolute top-0 right-0 bg-blue-600 text-white text-[10px] font-bold px-3 py-1 rounded-bl-xl rounded-tr-2xl uppercase tracking-wider shadow-md shadow-blue-600/30">Utama</span>
                    @endif

                    <div>
                        <div class="mb-3">
                            <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-[#161622] text-blue-400 border border-[#232336]">{{ $address->label }}</span>
                        </div>
                        
                        <p class="text-sm text-slate-300 leading-relaxed mb-6">
                            {{ $address->fullAddress() }}
                        </p>
                    </div>

                    <div class="flex items-center gap-3 border-t border-[#232336] pt-4 mt-auto">
                        <a href="{{ route('addresses.edit', $address) }}" class="text-xs font-semibold text-slate-200 hover:text-white hover:border-blue-500/40 transition-colors flex-1 text-center py-2 bg-[#161622] border border-[#232336] rounded-xl">
                            Edit
                        </a>
                        <form action="{{ route('addresses.destroy', $address) }}" method="POST" class="flex-1" onsubmit="return confirm('Hapus alamat ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full text-xs font-semibold text-red-400 hover:text-red-300 transition-colors text-center py-2 bg-red-950/40 border border-red-800/40 rounded-xl cursor-pointer">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
