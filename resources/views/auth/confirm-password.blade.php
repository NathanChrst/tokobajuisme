<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Ini adalah area aplikasi yang aman. Harap konfirmasi password Anda sebelum melanjutkan.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full rounded-xl border-gray-300 focus:border-[#E07A5F] focus:ring-[#E07A5F] shadow-sm" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button class="bg-[#E07A5F] hover:bg-[#C96B50] rounded-xl w-full justify-center py-3">
                {{ __('Konfirmasi') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
