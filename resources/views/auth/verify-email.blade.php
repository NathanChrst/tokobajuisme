<x-guest-layout>
    <div class="mb-6 text-xs sm:text-sm text-slate-300 leading-relaxed">
        {{ __('Terima kasih telah mendaftar di Jcloths! Sebelum memulai, bisakah Anda memverifikasi alamat email Anda dengan mengklik tautan yang baru saja kami kirimkan ke email Anda? Jika Anda tidak menerima email tersebut, kami akan dengan senang hati mengirimkan yang lain.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-xs sm:text-sm text-emerald-400 bg-emerald-950/40 border border-emerald-800/40 p-3 rounded-xl">
            {{ __('Tautan verifikasi baru telah dikirimkan ke alamat email yang Anda berikan saat pendaftaran.') }}
        </div>
    @endif

    <div class="mt-4 flex flex-col sm:flex-row items-center justify-between gap-4">
        <form method="POST" action="{{ route('verification.send') }}" class="w-full sm:w-auto">
            @csrf
            <div>
                <x-primary-button class="w-full sm:w-auto justify-center">
                    {{ __('Kirim Ulang Email Verifikasi') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="underline text-xs text-slate-400 hover:text-white rounded-md focus:outline-none cursor-pointer">
                {{ __('Keluar') }}
            </button>
        </form>
    </div>
</x-guest-layout>
