<nav x-data="{ open: false }" class="w-full">
    <div class="bg-gradient-to-br from-card via-card/95 to-muted/90 shadow-elevation-light dark:shadow-elevation-dark p-1">
        <div class="bg-card/50 shadow-elevation-light dark:shadow-elevation-dark-three">
            <div class="flex h-14 items-center justify-between pl-4 pr-4">
                <div class="flex items-center gap-6">
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('dashboard') ?? '/' }}" class="flex items-center gap-2">
                            <x-application-logo />
                            <span class="text-sm font-medium tracking-tight">TokoBaju</span>
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden md:flex gap-4">
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            Dashboard
                        </x-nav-link>
                        <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')">
                            Katalog
                        </x-nav-link>
                        <x-nav-link :href="route('cart.index')" :active="request()->routeIs('cart.*')">
                            Keranjang
                        </x-nav-link>
                        <x-nav-link :href="route('wishlist.index')" :active="request()->routeIs('wishlist.*')">
                            Wishlist
                        </x-nav-link>
                        <x-nav-link :href="route('orders.index')" :active="request()->routeIs('orders.*')">
                            Pesanan
                        </x-nav-link>
                    </div>
                </div>

                <div class="hidden md:flex items-center gap-4">
                    <button @click="$store.darkMode.toggle()" class="inline-flex items-center justify-center size-9 border border-input bg-background shadow-sm hover:bg-accent hover:text-accent-foreground transition-all">
                        <svg x-show="!$store.darkMode.on" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4"></circle><path d="M12 2v2"></path><path d="M12 20v2"></path><path d="m4.93 4.93 1.41 1.41"></path><path d="m17.66 17.66 1.41 1.41"></path><path d="M2 12h2"></path><path d="M20 12h2"></path><path d="m6.34 17.66-1.41 1.41"></path><path d="m19.07 4.93-1.41 1.41"></path></svg>
                        <svg x-show="$store.darkMode.on" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"></path></svg>
                    </button>

                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium text-foreground bg-background hover:bg-accent hover:text-accent-foreground focus:outline-none transition ease-in-out duration-150 shadow-sm border-border">
                                <div>{{ Auth::user()->name ?? 'Guest' }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            @auth
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                            @else
                            <x-dropdown-link :href="route('login')">
                                {{ __('Log in') }}
                            </x-dropdown-link>
                            @endauth
                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- Hamburger -->
                <div class="-me-2 flex items-center md:hidden">
                    <button @click="$store.darkMode.toggle()" class="inline-flex items-center justify-center size-9 border border-input bg-background shadow-sm hover:bg-accent hover:text-accent-foreground transition-all mr-2">
                        <svg x-show="!$store.darkMode.on" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4"></circle><path d="M12 2v2"></path><path d="M12 20v2"></path><path d="m4.93 4.93 1.41 1.41"></path><path d="m17.66 17.66 1.41 1.41"></path><path d="M2 12h2"></path><path d="M20 12h2"></path><path d="m6.34 17.66-1.41 1.41"></path><path d="m19.07 4.93-1.41 1.41"></path></svg>
                        <svg x-show="$store.darkMode.on" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"></path></svg>
                    </button>

                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 text-muted-foreground hover:bg-accent hover:text-accent-foreground focus:outline-none focus:bg-accent focus:text-accent-foreground transition duration-150 ease-in-out border border-input bg-background shadow-sm size-9 mr-2">
                        <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden mt-1 border border-border shadow-elevation-light dark:shadow-elevation-dark bg-card">
        <div class="pt-2 pb-3 space-y-1">
            @if (Route::has('dashboard'))
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                Dashboard
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')">
                Katalog
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('cart.index')" :active="request()->routeIs('cart.*')">
                Keranjang
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('wishlist.index')" :active="request()->routeIs('wishlist.*')">
                Wishlist
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('orders.index')" :active="request()->routeIs('orders.*')">
                Pesanan
            </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-border">
            <div class="px-4">
                <div class="font-medium text-base text-foreground">{{ Auth::user()->name ?? 'Guest' }}</div>
                <div class="font-medium text-sm text-muted-foreground">{{ Auth::user()->email ?? '' }}</div>
            </div>

            <div class="mt-3 space-y-1">
                @auth
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
                @endauth
            </div>
        </div>
    </div>
</nav>
