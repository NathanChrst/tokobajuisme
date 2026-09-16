<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="flex justify-between items-center mb-10">
            <h1 class="font-serif text-4xl text-[#3D405B] font-bold">Daftar Alamat</h1>
            <a href="{{ route('addresses.create') }}" class="inline-flex items-center justify-center px-6 py-3 bg-[#E07A5F] text-white font-semibold rounded-xl shadow-sm hover:bg-[#C96B50] hover:shadow-md transition-all duration-300">
                + Tambah Alamat
            </a>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($addresses as $address)
                <div class="bg-white rounded-2xl border border-gray-200/60 shadow-sm p-6 hover:shadow-md transition-all relative {{ $address->is_default ? 'ring-2 ring-[#E07A5F]' : '' }}">
                    @if($address->is_default)
                        <span class="absolute top-0 right-0 bg-[#E07A5F] text-white text-[10px] font-bold px-3 py-1 rounded-bl-xl rounded-tr-2xl uppercase tracking-wider">Utama</span>
                    @endif

                    <div class="mb-4">
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700 mb-2">{{ $address->label }}</span>
                    </div>
                    
                    <p class="text-sm text-gray-600 leading-relaxed mb-6 h-20 overflow-hidden">
                        {{ $address->fullAddress() }}
                    </p>

                    <div class="flex items-center gap-3 border-t border-gray-100 pt-4">
                        <a href="{{ route('addresses.edit', $address) }}" class="text-sm font-medium text-[#3D405B] hover:text-[#E07A5F] transition-colors flex-1 text-center py-2 bg-gray-50 rounded-lg hover:bg-orange-50">
                            Edit
                        </a>
                        <form action="{{ route('addresses.destroy', $address) }}" method="POST" class="flex-1" onsubmit="return confirm('Hapus alamat ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full text-sm font-medium text-red-500 hover:text-red-700 transition-colors text-center py-2 bg-red-50 rounded-lg hover:bg-red-100">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
