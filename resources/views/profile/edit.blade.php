<x-app-layout>
    <div class="py-12 bg-[#0A0A0F] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <div class="mb-6 pb-4 border-b border-[#232336]">
                <h1 class="font-serif text-3xl sm:text-4xl text-white font-bold tracking-tight">
                    {{ __('Pengaturan Profil') }}
                </h1>
                <p class="text-xs sm:text-sm text-slate-400 mt-1">Kelola data profil, email, dan keamanan akun Anda</p>
            </div>

            <div class="p-6 sm:p-8 bg-[#121218] shadow-xl rounded-2xl border border-[#232336]">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-6 sm:p-8 bg-[#121218] shadow-xl rounded-2xl border border-[#232336]">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-6 sm:p-8 bg-[#121218] shadow-xl rounded-2xl border border-[#232336]">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
