<x-guest-layout>
    <div class="space-y-6">
        <div class="text-center animate-fade-slide-up">
            <h2 class="text-2xl font-bold text-gray-900">Buat Akun Baru</h2>
            <p class="mt-1 text-sm text-gray-500">Daftar untuk mulai berbelanja</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <div class="animate-fade-slide-up-delay-1">
                <x-input-label for="name" :value="__('Nama')" class="text-sm font-medium text-gray-700" />
                <div class="relative mt-1 group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none input-icon">
                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <x-text-input id="name"
                        class="block mt-1 w-full pl-10 pr-3 py-2.5 border-gray-300 rounded-xl input-glow transition-all duration-300"
                        type="text"
                        name="name"
                        :value="old('name')"
                        required
                        autofocus
                        autocomplete="name"
                        placeholder="Nama lengkap" />
                </div>
                <x-input-error :messages="$errors->get('name')" class="mt-2 animate-slide-down" />
            </div>

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
                        autocomplete="username"
                        placeholder="contoh@gmail.com"
                        oninput="validateEmail(this)" />
                </div>
                <div id="email-hint" class="mt-1 text-xs text-gray-400 hidden animate-slide-down">
                    Gunakan <span class="font-medium text-indigo-500">@gmail.com</span> untuk mendaftar
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
                        autocomplete="new-password"
                        placeholder="Buat password"
                        oninput="checkPasswordCriteria(this.value)" />
                    <button type="button" onclick="togglePassVisibility('password', 'eye-icon-1')"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 transition-colors duration-200">
                        <svg id="eye-icon-1" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
                <div id="password-criteria" class="mt-3 space-y-2 hidden animate-slide-down">
                    <p class="text-xs font-medium text-gray-500">Password harus memenuhi:</p>
                    <div class="space-y-1.5">
                        <div class="password-check invalid flex items-center gap-2 text-sm" data-criteria="length">
                            <svg class="check-icon w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Minimal 8 karakter</span>
                        </div>
                        <div class="password-check invalid flex items-center gap-2 text-sm" data-criteria="uppercase">
                            <svg class="check-icon w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Huruf besar (A-Z)</span>
                        </div>
                        <div class="password-check invalid flex items-center gap-2 text-sm" data-criteria="lowercase">
                            <svg class="check-icon w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Huruf kecil (a-z)</span>
                        </div>
                        <div class="password-check invalid flex items-center gap-2 text-sm" data-criteria="number">
                            <svg class="check-icon w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Angka (0-9)</span>
                        </div>
                    </div>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2 animate-slide-down" />
            </div>

            <div class="animate-fade-slide-up-delay-2">
                <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="text-sm font-medium text-gray-700" />
                <div class="relative mt-1 group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none input-icon">
                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <x-text-input id="password_confirmation"
                        class="block mt-1 w-full pl-10 pr-10 py-2.5 border-gray-300 rounded-xl input-glow transition-all duration-300"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                        placeholder="Ulangi password"
                        oninput="checkPasswordMatch(this.value)" />
                    <button type="button" onclick="togglePassVisibility('password_confirmation', 'eye-icon-2')"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 transition-colors duration-200">
                        <svg id="eye-icon-2" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
                <div id="match-indicator" class="mt-1 text-xs hidden"></div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 animate-slide-down" />
            </div>

            <div class="animate-fade-slide-up-delay-3">
                <button type="submit" class="btn-gradient w-full py-3 px-4 rounded-xl text-white font-semibold text-sm uppercase tracking-wider focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-300">
                    <span class="flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        Daftar
                    </span>
                </button>
            </div>

            <div class="text-center animate-fade-slide-up-delay-3">
                <p class="text-sm text-gray-500">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-800 font-medium hover:underline transition-colors duration-200">
                        Masuk di sini
                    </a>
                </p>
            </div>
        </form>
    </div>

    <script>
        function togglePassVisibility(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
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

        function validateEmail(input) {
            const hint = document.getElementById('email-hint');
            const value = input.value;
            if (value && !value.includes('@')) {
                hint.classList.remove('hidden');
            } else if (value.includes('@') && !value.endsWith('@gmail.com')) {
                hint.classList.remove('hidden');
            } else {
                hint.classList.add('hidden');
            }
        }

        function checkPasswordCriteria(password) {
            const criteriaBox = document.getElementById('password-criteria');

            if (password.length === 0) {
                criteriaBox.classList.add('hidden');
                return;
            }

            criteriaBox.classList.remove('hidden');

            const checks = {
                length: password.length >= 8,
                uppercase: /[A-Z]/.test(password),
                lowercase: /[a-z]/.test(password),
                number: /[0-9]/.test(password),
            };

            Object.entries(checks).forEach(([key, valid]) => {
                const el = criteriaBox.querySelector(`[data-criteria="${key}"]`);
                if (valid) {
                    el.classList.remove('invalid');
                    el.classList.add('valid');
                    el.querySelector('.check-icon').innerHTML = `
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    `;
                } else {
                    el.classList.remove('valid');
                    el.classList.add('invalid');
                    el.querySelector('.check-icon').innerHTML = `
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    `;
                }
            });
        }

        function checkPasswordMatch(value) {
            const password = document.getElementById('password').value;
            const indicator = document.getElementById('match-indicator');

            if (value.length === 0) {
                indicator.classList.add('hidden');
                return;
            }

            indicator.classList.remove('hidden');

            if (value === password) {
                indicator.className = 'mt-1 text-xs text-green-600 font-medium animate-fade-in';
                indicator.textContent = '✓ Password cocok';
            } else {
                indicator.className = 'mt-1 text-xs text-red-500 font-medium animate-fade-in';
                indicator.textContent = '✗ Password tidak cocok';
            }
        }
    </script>
</x-guest-layout>
