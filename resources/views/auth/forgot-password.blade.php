<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Lupa password Anda? Tidak masalah. Beri tahu kami alamat email Anda dan kami akan mengirimi Anda tautan setel ulang password yang memungkinkan Anda memilih yang baru.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full rounded-xl border-gray-300 focus:border-[#E07A5F] focus:ring-[#E07A5F] shadow-sm" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="bg-[#E07A5F] hover:bg-[#C96B50] rounded-xl w-full justify-center py-3">
                {{ __('Kirim Tautan Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
