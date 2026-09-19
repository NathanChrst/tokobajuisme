<x-guest-layout>
    <div class="mb-6 text-xs sm:text-sm text-slate-300 leading-relaxed">
        {{ __('Lupa password akun Jcloths Anda? Masukkan alamat email Anda dan kami akan mengirimi tautan setel ulang password.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full text-sm" type="email" name="email" :value="old('email')" required autofocus placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full justify-center">
                {{ __('Kirim Tautan Reset Password') }}
            </x-primary-button>
        </div>

        <div class="text-center pt-4 border-t border-[#232336] mt-4">
            <a href="{{ route('login') }}" class="text-xs text-blue-400 hover:text-blue-300 transition-colors">
                &larr; Kembali ke halaman Masuk
            </a>
        </div>
    </form>
</x-guest-layout>
