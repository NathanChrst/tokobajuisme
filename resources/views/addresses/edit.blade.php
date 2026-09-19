<x-app-layout>
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="mb-8 flex items-center">
            <a href="{{ route('addresses.index') }}" class="mr-4 text-slate-400 hover:text-blue-400 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h1 class="font-serif text-2xl sm:text-3xl text-white font-bold tracking-tight">Edit Alamat</h1>
        </div>

        <div class="bg-[#121218] p-6 sm:p-8 rounded-2xl border border-[#232336] shadow-xl">
            <form action="{{ route('addresses.update', $address) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')
                
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Label Alamat</label>
                    <input type="text" name="label" value="{{ old('label', $address->label) }}" placeholder="Contoh: Rumah, Kantor, Kosan" class="w-full rounded-xl bg-[#161622] border border-[#232336] text-white placeholder-slate-500 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/25 text-sm" required>
                    @error('label')<span class="text-xs text-red-400 mt-1 block">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Alamat Lengkap (Jalan, No, RT/RW)</label>
                    <textarea name="street" rows="3" class="w-full rounded-xl bg-[#161622] border border-[#232336] text-white placeholder-slate-500 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/25 text-sm" required>{{ old('street', $address->street) }}</textarea>
                    @error('street')<span class="text-xs text-red-400 mt-1 block">{{ $message }}</span>@enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Kota / Kabupaten</label>
                        <input type="text" name="city" value="{{ old('city', $address->city) }}" class="w-full rounded-xl bg-[#161622] border border-[#232336] text-white placeholder-slate-500 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/25 text-sm" required>
                        @error('city')<span class="text-xs text-red-400 mt-1 block">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Provinsi</label>
                        <input type="text" name="province" value="{{ old('province', $address->province) }}" class="w-full rounded-xl bg-[#161622] border border-[#232336] text-white placeholder-slate-500 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/25 text-sm" required>
                        @error('province')<span class="text-xs text-red-400 mt-1 block">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Kode Pos</label>
                    <input type="text" name="postal_code" value="{{ old('postal_code', $address->postal_code) }}" class="w-full md:w-1/2 rounded-xl bg-[#161622] border border-[#232336] text-white placeholder-slate-500 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/25 text-sm" required>
                    @error('postal_code')<span class="text-xs text-red-400 mt-1 block">{{ $message }}</span>@enderror
                </div>

                <div class="flex items-center pt-2">
                    <input type="checkbox" name="is_default" id="is_default" value="1" {{ $address->is_default ? 'checked' : '' }} class="rounded bg-[#161622] text-blue-600 focus:ring-blue-500 border-[#232336]">
                    <label for="is_default" class="ml-2 text-sm text-slate-300 cursor-pointer">Jadikan sebagai alamat utama</label>
                </div>

                <div class="pt-4 flex justify-end">
                    <button type="submit" class="inline-flex items-center justify-center px-8 py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl shadow-lg shadow-blue-600/30 hover:shadow-blue-600/50 transition-all text-sm">
                        Perbarui Alamat
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
