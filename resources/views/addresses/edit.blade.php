<x-app-layout>
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="mb-8 flex items-center">
            <a href="{{ route('addresses.index') }}" class="mr-4 text-gray-400 hover:text-[#E07A5F] transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h1 class="font-serif text-3xl text-[#3D405B] font-bold">Edit Alamat</h1>
        </div>

        <div class="bg-white p-8 rounded-2xl border border-gray-200/60 shadow-sm">
            <form action="{{ route('addresses.update', $address) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Label Alamat</label>
                    <input type="text" name="label" value="{{ old('label', $address->label) }}" placeholder="Contoh: Rumah, Kantor, Kosan" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-[#E07A5F] focus:ring-[#E07A5F]" required>
                    @error('label')<span class="text-sm text-red-500 mt-1">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap (Jalan, No, RT/RW)</label>
                    <textarea name="street" rows="3" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-[#E07A5F] focus:ring-[#E07A5F]" required>{{ old('street', $address->street) }}</textarea>
                    @error('street')<span class="text-sm text-red-500 mt-1">{{ $message }}</span>@enderror
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kota / Kabupaten</label>
                        <input type="text" name="city" value="{{ old('city', $address->city) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-[#E07A5F] focus:ring-[#E07A5F]" required>
                        @error('city')<span class="text-sm text-red-500 mt-1">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Provinsi</label>
                        <input type="text" name="province" value="{{ old('province', $address->province) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-[#E07A5F] focus:ring-[#E07A5F]" required>
                        @error('province')<span class="text-sm text-red-500 mt-1">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kode Pos</label>
                    <input type="text" name="postal_code" value="{{ old('postal_code', $address->postal_code) }}" class="w-full md:w-1/2 rounded-xl border-gray-300 shadow-sm focus:border-[#E07A5F] focus:ring-[#E07A5F]" required>
                    @error('postal_code')<span class="text-sm text-red-500 mt-1">{{ $message }}</span>@enderror
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="is_default" id="is_default" value="1" {{ $address->is_default ? 'checked' : '' }} class="rounded text-[#E07A5F] focus:ring-[#E07A5F] border-gray-300">
                    <label for="is_default" class="ml-2 text-sm text-gray-700 cursor-pointer">Jadikan sebagai alamat utama</label>
                </div>

                <div class="pt-4 flex justify-end">
                    <button type="submit" class="inline-flex items-center justify-center px-8 py-3 bg-[#E07A5F] text-white font-semibold rounded-xl shadow-sm hover:bg-[#C96B50] hover:shadow-md transition-all duration-300">
                        Perbarui Alamat
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
