<x-guest-layout>
    <div class="space-y-6">
        <div class="text-center animate-fade-slide-up">
            <h2 class="text-2xl font-bold text-gray-900">Selamat Datang</h2>
            <p class="mt-1 text-sm text-gray-500">Silakan masuk ke akun Anda</p>
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <div class="animate-fade-slide-up-delay-1">
                <x-input-label for="email" :value="__('Email')" class="text-sm font-medium text-gray-700" />
                <div class="relative mt-1 group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none input-icon">
                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <x-text-input id="email"
                        class="block mt-1 w-full pl-10 pr-3 py-2.5 border-gray-300 rounded-xl input-glow transition-all duration-300"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="contoh@gmail.com" />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2 animate-slide-down" />
            </div>

            <div class="animate-fade-slide-up-delay-2">
                <x-input-label for="password" :value="__('Password')" class="text-sm font-medium text-gray-700" />
                <div class="relative mt-1 group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none input-icon">
                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <x-text-input id="password"
                        class="block mt-1 w-full pl-10 pr-10 py-2.5 border-gray-300 rounded-xl input-glow transition-all duration-300"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="Masukkan password" />
                    <button type="button" onclick="togglePasswordVisibility()"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 transition-colors duration-200">
                        <svg id="eye-icon" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
                @if ($errors->has('password'))
                    <div class="mt-2 flex items-center gap-2 text-sm text-red-600 animate-slide-down">
                        <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                        <span>{{ $errors->first('password') }}</span>
                    </div>
                @endif
            </div>

            <div class="flex items-center justify-between animate-fade-slide-up-delay-3">
                <label for="remember_me" class="flex items-center gap-2 cursor-pointer group">
                    <input id="remember_me" type="checkbox"
                        class="rounded-lg border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 cursor-pointer transition-all duration-200"
                        name="remember">
                    <span class="text-sm text-gray-600 group-hover:text-gray-800 transition-colors duration-200">Ingat saya</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-indigo-600 hover:text-indigo-800 hover:underline transition-colors duration-200"
                        href="{{ route('password.request') }}">
                        Lupa password?
                    </a>
                @endif
            </div>

            <div class="animate-fade-slide-up-delay-3">
                <button type="submit" class="btn-gradient w-full py-3 px-4 rounded-xl text-white font-semibold text-sm uppercase tracking-wider focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-300">
                    <span class="flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        Masuk
                    </span>
                </button>
            </div>

            <div class="text-center animate-fade-slide-up-delay-3">
                <p class="text-sm text-gray-500">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-800 font-medium hover:underline transition-colors duration-200">
                        Daftar sekarang
                    </a>
                </p>
            </div>
        </form>
    </div>

    <script>
        function togglePasswordVisibility() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eye-icon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                `;
            } else {
                input.type = 'password';
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                `;
            }
        }
    </script>
</x-guest-layout>
