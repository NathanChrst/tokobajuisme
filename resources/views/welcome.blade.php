<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TokoBaju — Tampil Stylish Setiap Hari</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        try {
            if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            }
        } catch(e) {}
    </script>
</head>
<body class="font-sans antialiased bg-black md:bg-background text-foreground" x-data>

<main class="min-h-screen w-full">
    {{-- HEADER --}}
    <div class="container mx-auto max-w-7xl pt-1 px-1 md:py-3">
        <header class="w-full z-40 shadow-elevation-light dark:shadow-elevation-dark bg-card max-w-sm mx-auto md:max-w-7xl p-1">
            <div class="container shadow-elevation-light dark:shadow-elevation-dark bg-card p-1">
                <div class="flex h-14 items-center justify-between pl-4">
                    <div class="flex items-center gap-6">
                        <a href="/" class="flex items-center gap-2" aria-label="TokoBaju Home">
                            <div class="h-8 w-8">
                                <div class="bg-gradient-to-br from-card via-card/95 to-muted/90 shadow-elevation-light dark:shadow-elevation-dark h-full w-full p-[2px] flex items-center justify-center transition-all duration-300 hover:scale-110">
                                    <div class="bg-card shadow-elevation-light dark:shadow-elevation-dark-three h-full w-full flex items-center justify-center">
                                        <span class="text-xs font-bold text-primary tracking-tighter">TB</span>
                                    </div>
                                </div>
                            </div>
                            <span class="font-medium text-sm text-foreground">TokoBaju</span>
                        </a>
                        <nav class="hidden md:flex items-center gap-6">
                            <a class="relative py-1 text-sm transition-colors text-muted-foreground hover:text-foreground" href="#kategori">Kategori</a>
                            <a class="relative py-1 text-sm transition-colors text-muted-foreground hover:text-foreground" href="#fitur">Fitur</a>
                            <a class="relative py-1 text-sm transition-colors text-muted-foreground hover:text-foreground" href="#koleksi">Koleksi</a>
                            <a class="relative py-1 text-sm transition-colors text-muted-foreground hover:text-foreground" href="#tentang">Tentang</a>
                        </nav>
                    </div>
                    <nav class="flex items-center gap-3">
                        <div class="hidden md:flex items-center gap-2">
                            @auth
                                <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-primary-foreground bg-primary shadow-elevation-light dark:shadow-elevation-dark transition-all duration-200 hover:bg-primary/90">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-3 py-2 text-xs font-medium border border-border text-foreground bg-background shadow-sm hover:bg-accent transition-colors gap-1.5">
                                    <span>Masuk</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" x2="3" y1="12" y2="12"/></svg>
                                </a>
                                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-primary-foreground bg-primary shadow-elevation-light dark:shadow-elevation-dark transition-all duration-200 hover:bg-primary/90">
                                    Daftar
                                </a>
                            @endauth
                            <button @click="$store.darkMode.toggle()" class="inline-flex items-center justify-center size-9 border border-input bg-background shadow-sm hover:bg-accent hover:text-accent-foreground transition-all">
                                <svg x-show="!$store.darkMode.on" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4"></circle><path d="M12 2v2"></path><path d="M12 20v2"></path><path d="m4.93 4.93 1.41 1.41"></path><path d="m17.66 17.66 1.41 1.41"></path><path d="M2 12h2"></path><path d="M20 12h2"></path><path d="m6.34 17.66-1.41 1.41"></path><path d="m19.07 4.93-1.41 1.41"></path></svg>
                                <svg x-show="$store.darkMode.on" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"></path></svg>
                            </button>
                        </div>
                    </nav>
                </div>
            </div>
        </header>
    </div>

    {{-- HERO + CONTENT --}}
    <div class="container mx-auto max-w-7xl pt-1 md:pt-1 px-1">
        <div class="space-y-1 md:space-y-4">

            {{-- HERO SECTION --}}
            <div class="relative w-full flex gap-1 md:gap-0 flex-col md:flex-row">
                <div class="relative p-1 text-left w-full bg-background shadow-elevation-light dark:shadow-elevation-dark-three">
                    <div class="space-y-6 md:space-y-10 h-full w-full shadow-elevation-light dark:shadow-elevation-dark-three px-4 py-12 md:px-8 p-1.5 bg-card/50">
                        <div class="md:px-2 pt-2 lg:pt-18">
                            {{-- Mobile typography --}}
                            <div class="xl:hidden space-y-2">
                                <h1>
                                    <span class="tracking-tight pb-3 bg-clip-text text-transparent bg-gradient-to-t from-primary to-primary/90 dark:from-primary dark:to-primary/95 text-[4.5rem] leading-[0.9] sm:text-6xl font-bold">Toko</span>
                                </h1>
                                <h1>
                                    <span class="tracking-tight pb-3 bg-clip-text text-transparent bg-gradient-to-t from-primary to-primary/90 dark:from-primary dark:to-primary/95 text-[4.5rem] leading-[0.9] sm:text-6xl font-bold">Baju</span>
                                </h1>
                            </div>
                            {{-- Desktop typography --}}
                            <div class="hidden xl:block xl:space-y-4">
                                <div class="relative inline-block md:py-4 md:leading-[6.5rem] text-[4rem] xl:leading-10 sm:text-6xl lg:text-[8rem] font-black tracking-tight">
                                    <span class="bg-clip-text text-transparent bg-gradient-to-t from-primary to-primary/90 dark:from-primary dark:to-primary/95">Toko</span>
                                </div>
                                <div class="relative inline-block md:py-4 md:leading-[6.5rem] text-[4rem] xl:leading-10 sm:text-6xl lg:text-[7rem] font-black tracking-tighter">
                                    <span class="bg-clip-text text-transparent bg-gradient-to-t from-primary to-primary/90 dark:from-primary dark:to-primary/95">Baju</span>
                                </div>
                            </div>
                        </div>

                        <p class="max-w-xl text-2xl md:text-3xl leading-snug tracking-tight text-foreground pb-12 md:pb-4">
                            Tampil stylish setiap hari dengan koleksi fashion terbaru 2026.
                        </p>

                        <div class="flex flex-col justify-start gap-5 px-2 sm:flex-row sm:gap-4 md:gap-8">
                            @auth
                                <a href="{{ route('products.index') }}" class="w-full relative z-10 sm:w-auto inline-flex items-center justify-center px-6 py-3.5 md:py-4.5 md:px-9 text-xl md:text-2xl tracking-tight text-primary shadow-elevation-light dark:shadow-elevation-dark bg-secondary dark:bg-background/80 transition-all duration-300 hover:bg-secondary/80 group dark:hover:bg-background/60">
                                    <span class="flex items-center gap-2">
                                        Jelajahi Koleksi
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-5 md:size-6"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                                    </span>
                                </a>
                            @else
                                <a href="{{ route('register') }}" class="w-full relative z-10 sm:w-auto inline-flex items-center justify-center px-6 py-3.5 md:py-4.5 md:px-9 text-xl md:text-2xl tracking-tight text-primary shadow-elevation-light dark:shadow-elevation-dark bg-secondary dark:bg-background/80 transition-all duration-300 hover:bg-secondary/80 group dark:hover:bg-background/60">
                                    <span class="flex items-center gap-2">
                                        Mulai Belanja
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-5 md:size-6"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                                    </span>
                                </a>
                            @endauth
                            <a href="#fitur" class="hidden w-full sm:w-auto xl:inline-flex items-center justify-center shadow-elevation-light dark:shadow-elevation-dark tracking-tight px-6 py-3.5 md:py-4.5 md:px-9 text-xl md:text-2xl text-secondary-foreground transition-all duration-300 bg-secondary/30 hover:bg-secondary/80">
                                <span>Pelajari Lebih</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- PRODUCT SHOWCASE --}}
            <section class="w-full" id="koleksi">
                <div class="w-full md:pl-4">
                    <div class="relative w-full max-w-[1800px] mx-auto overflow-hidden bg-gradient-to-br from-card via-card/95 to-muted/90 shadow-elevation-light dark:shadow-elevation-dark p-1 transition-all duration-300">
                        <div class="relative w-full overflow-hidden bg-card/20 p-1.5 shadow-elevation-light dark:shadow-elevation-dark-three">
                            <div class="group w-full">
                                <div class="w-full h-64 md:h-96 bg-gradient-to-br from-muted via-muted/80 to-card shadow-elevation-light dark:shadow-elevation-dark flex items-center justify-center">
                                    <div class="text-center">
                                        <p class="text-4xl md:text-6xl font-black tracking-tight text-foreground/20">Koleksi 2026</p>
                                        <p class="mt-2 text-sm text-muted-foreground">Fashion terbaru untuk gaya Anda</p>
                                    </div>
                                </div>
                                <div class="absolute bottom-0 left-0 px-5 py-4">
                                    <p class="text-xl lg:text-2xl font-bold text-foreground tracking-tight">Koleksi Terbaru</p>
                                    <span class="text-lg lg:text-xl font-medium text-muted-foreground tracking-tight">Atasan, Bawahan, Outerwear & Aksesoris</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- CATEGORY SECTION --}}
            <div id="kategori">
                <section class="md:space-y-4 md:grid md:grid-cols-3 md:gap-4">
                    <div class="col-span-1 hidden md:block md:col-span-2 h-full w-full">
                        <div class="w-full h-full">
                            <div class="bg-gradient-to-br from-card via-card/95 to-muted/90 shadow-elevation-light dark:shadow-elevation-dark p-1 relative text-left w-full h-full flex items-center justify-center">
                                <div class="shadow-elevation-light dark:shadow-elevation-dark-three sm:px-4 md:py-16 mx-auto flex flex-col justify-center items-center space-y-8 md:px-4 p-1.5 bg-card/50 w-full h-full">
                                    <div class="grid grid-cols-2 gap-4 w-full px-4 py-8">
                                        @foreach(['Atasan' => 'Kemeja, Kaos, Blouse', 'Bawahan' => 'Celana, Rok, Shorts', 'Outerwear' => 'Jaket, Hoodie, Blazer', 'Aksesoris' => 'Topi, Tas, Sepatu'] as $name => $desc)
                                            <div class="bg-gradient-to-br from-card via-card/95 to-muted/90 shadow-elevation-light dark:shadow-elevation-dark p-1 transition-all hover:scale-[1.02] cursor-pointer">
                                                <div class="bg-card shadow-elevation-light dark:shadow-elevation-dark-three p-6 text-center">
                                                    <div class="w-12 h-12 bg-muted shadow-elevation-light dark:shadow-elevation-dark-two mx-auto mb-4 flex items-center justify-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-muted-foreground"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                                                    </div>
                                                    <h3 class="font-semibold text-foreground">{{ $name }}</h3>
                                                    <p class="text-sm text-muted-foreground mt-1">{{ $desc }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="relative col-span-1 hidden md:block">
                        <div class="w-full h-full">
                            <div class="bg-gradient-to-br from-card via-card/95 to-muted/90 shadow-elevation-light dark:shadow-elevation-dark p-1 relative text-left w-full h-full flex items-center justify-center">
                                <div class="bg-card/20 shadow-elevation-light dark:shadow-elevation-dark-three sm:px-4 md:py-16 md:px-6 p-1.5 w-full">
                                    <div class="text-left w-full">
                                        <h3><span class="tracking-tight pb-3 bg-clip-text text-transparent bg-gradient-to-t from-primary to-primary/90 dark:from-primary dark:to-primary/95 text-4xl sm:text-5xl lg:text-6xl font-semibold">Kategori Favorit.</span></h3>
                                        <h3><span class="tracking-tight pb-3 bg-clip-text text-transparent bg-gradient-to-t from-muted-foreground to-muted-foreground/80 text-3xl sm:text-4xl lg:text-5xl font-semibold">Temukan gaya terbaik.</span></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Mobile category --}}
                    <div class="relative col-span-1 md:hidden">
                        <div class="w-full h-full">
                            <div class="bg-gradient-to-br from-card via-card/95 to-muted/90 shadow-elevation-light dark:shadow-elevation-dark p-1 relative text-left w-full h-full">
                                <div class="bg-card/20 shadow-elevation-light dark:shadow-elevation-dark-three p-4 space-y-4">
                                    <div class="pl-2 text-left w-full pt-4">
                                        <h3><span class="tracking-tight bg-clip-text text-transparent bg-gradient-to-t from-primary to-primary/90 text-5xl font-semibold">Kategori.</span></h3>
                                    </div>
                                    <div class="grid grid-cols-2 gap-3">
                                        @foreach(['Atasan', 'Bawahan', 'Outerwear', 'Aksesoris'] as $name)
                                            <div class="bg-gradient-to-br from-card via-card/95 to-muted/90 shadow-elevation-light dark:shadow-elevation-dark p-1 cursor-pointer">
                                                <div class="bg-card shadow-elevation-light dark:shadow-elevation-dark-three p-4 text-center">
                                                    <h3 class="font-semibold text-foreground text-sm">{{ $name }}</h3>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            {{-- FEATURES SECTION --}}
            <div id="fitur">
                <section>
                    <div class="w-full">
                        <div class="w-full h-full">
                            <div class="bg-gradient-to-br from-card via-card/95 to-muted/90 shadow-elevation-light dark:shadow-elevation-dark p-1 md:container mx-auto max-w-7xl">
                                <div class="bg-card/20 shadow-elevation-light dark:shadow-elevation-dark-three px-3 sm:px-4 md:px-6 py-12 md:py-16 pt-6 pb-2">
                                    <div class="grid gap-4 md:gap-16 lg:grid-cols-2 lg:gap-12 md:items-center">
                                        <div class="space-y-8 md:space-y-10 p-1 pt-2 sm:py-8 sm:p-4">
                                            <div class="space-y-4">
                                                <h3 class="leading-[1.5rem] md:leading-[1.5rem] lg:leading-[1.5rem]">
                                                    <span class="tracking-tight pb-3 bg-clip-text text-transparent bg-gradient-to-t from-primary to-primary/90 dark:from-primary dark:to-primary/95 text-5xl sm:text-6xl xl:text-[6rem] font-semibold">Kenapa Toko Baju?</span>
                                                </h3>
                                            </div>

                                            <div class="space-y-6">
                                                {{-- Feature 1 --}}
                                                <div class="group flex gap-4 md:gap-6 items-start">
                                                    <div class="relative w-10 h-10 md:w-18 md:h-18 flex-shrink-0 flex items-center justify-center">
                                                        <div class="absolute inset-0 bg-card/5 shadow-elevation-light dark:shadow-elevation-dark-two"></div>
                                                        <div class="relative text-primary z-10">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"/><path d="m9 12 2 2 4-4"/></svg>
                                                        </div>
                                                    </div>
                                                    <div class="space-y-1.5 md:space-y-1 min-w-0 flex-1">
                                                        <h3 class="text-lg md:text-base tracking-tight font-medium leading-snug text-foreground group-hover:text-primary transition-colors duration-300">Kualitas Premium</h3>
                                                        <p class="text-foreground/80 text-xs md:text-sm leading-relaxed">Semua produk dijamin kualitas terbaik dengan bahan pilihan dan jahitan rapi.</p>
                                                    </div>
                                                </div>
                                                {{-- Feature 2 --}}
                                                <div class="group flex gap-4 md:gap-6 items-start">
                                                    <div class="relative w-10 h-10 md:w-18 md:h-18 flex-shrink-0 flex items-center justify-center">
                                                        <div class="absolute inset-0 bg-card/5 shadow-elevation-light dark:shadow-elevation-dark-two"></div>
                                                        <div class="relative text-primary z-10">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                                        </div>
                                                    </div>
                                                    <div class="space-y-1.5 md:space-y-1 min-w-0 flex-1">
                                                        <h3 class="text-lg md:text-base tracking-tight font-medium leading-snug text-foreground group-hover:text-primary transition-colors duration-300">Pengiriman Cepat</h3>
                                                        <p class="text-foreground/80 text-xs md:text-sm leading-relaxed">Pesanan diproses dan dikirim dalam 1-2 hari kerja ke seluruh Indonesia.</p>
                                                    </div>
                                                </div>
                                                {{-- Feature 3 --}}
                                                <div class="group flex gap-4 md:gap-6 items-start">
                                                    <div class="relative w-10 h-10 md:w-18 md:h-18 flex-shrink-0 flex items-center justify-center">
                                                        <div class="absolute inset-0 bg-card/5 shadow-elevation-light dark:shadow-elevation-dark-two"></div>
                                                        <div class="relative text-primary z-10">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                                                        </div>
                                                    </div>
                                                    <div class="space-y-1.5 md:space-y-1 min-w-0 flex-1">
                                                        <h3 class="text-lg md:text-base tracking-tight font-medium leading-snug text-foreground group-hover:text-primary transition-colors duration-300">Style Terkini</h3>
                                                        <p class="text-foreground/80 text-xs md:text-sm leading-relaxed">Koleksi selalu update mengikuti tren fashion terbaru dari lokal hingga internasional.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Right side: Mock UI --}}
                                        <div class="relative mt-8 md:mt-0 pb-3 md:pb-0">
                                            <div class="relative w-full overflow-hidden bg-background p-3 shadow-elevation-light dark:shadow-elevation-dark">
                                                <div class="relative bg-card border border-border shadow-lg overflow-hidden">
                                                    <div class="p-4 border-b border-border flex items-center justify-between">
                                                        <div class="flex items-center gap-3">
                                                            <div class="w-8 h-8 bg-card flex items-center justify-center text-primary shadow-elevation-light dark:shadow-elevation-dark-two">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                                                            </div>
                                                            <span class="font-medium text-sm text-foreground">Katalog</span>
                                                        </div>
                                                    </div>
                                                    <div class="p-4 space-y-2">
                                                        @foreach(['Kemeja Premium' => 'Rp 299.000', 'Hoodie Urban' => 'Rp 449.000', 'Celana Chino' => 'Rp 349.000', 'Blazer Formal' => 'Rp 599.000'] as $item => $price)
                                                            <div class="border border-border p-2.5 hover:border-primary/30 transition-colors cursor-pointer">
                                                                <div class="flex justify-between items-center">
                                                                    <div class="flex items-center gap-2">
                                                                        <div class="w-1.5 h-1.5 bg-success rounded-full"></div>
                                                                        <span class="font-medium text-xs text-foreground">{{ $item }}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="text-[10px] text-muted-foreground mt-1.5 flex items-center gap-2">
                                                                    <span class="font-medium">{{ $price }}</span>
                                                                    <span>•</span>
                                                                    <span>Ready stock</span>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            {{-- CTA SECTION --}}
            <div id="tentang">
                <div class="w-full h-full">
                    <div class="bg-gradient-to-br from-card via-card/95 to-muted/90 shadow-elevation-light dark:shadow-elevation-dark p-1 md:container mx-auto max-w-7xl">
                        <div class="bg-card/20 shadow-elevation-light dark:shadow-elevation-dark-three px-3 sm:px-4 md:px-6 py-6 md:py-12 lg:py-36">
                            <div class="max-w-3xl mx-auto text-center">
                                <div class="w-full py-8 px-4">
                                    <p class="text-2xl md:text-4xl lg:text-5xl font-bold tracking-tight text-foreground leading-tight">
                                        Mulai belanja sekarang dan temukan gaya yang pas untuk Anda.
                                    </p>
                                    <p class="mt-6 text-muted-foreground text-lg">
                                        Bergabung dengan ribuan pelanggan yang sudah mempercayai TokoBaju.
                                    </p>
                                    <div class="mt-8">
                                        @auth
                                            <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center px-8 py-4 text-lg font-medium text-primary-foreground bg-primary shadow-elevation-light dark:shadow-elevation-dark transition-all duration-200 hover:bg-primary/90">
                                                Jelajahi Katalog
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-2"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                                            </a>
                                        @else
                                            <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 text-lg font-medium text-primary-foreground bg-primary shadow-elevation-light dark:shadow-elevation-dark transition-all duration-200 hover:bg-primary/90">
                                                Daftar Gratis
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-2"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                                            </a>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- FOOTER --}}
            <div>
                <div class="w-full h-full">
                    <div class="bg-gradient-to-br from-card via-card/95 to-muted/90 shadow-elevation-light dark:shadow-elevation-dark p-1">
                        <div class="bg-card/20 shadow-elevation-light dark:shadow-elevation-dark-three px-4 sm:px-6 md:px-8 py-12">
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 max-w-7xl mx-auto">
                                <div class="col-span-2 md:col-span-1">
                                    <div class="flex items-center gap-2 mb-3">
                                        <div class="h-6 w-6 bg-gradient-to-br from-card via-card/95 to-muted/90 shadow-elevation-light dark:shadow-elevation-dark p-[1px] flex items-center justify-center">
                                            <div class="bg-card shadow-elevation-light dark:shadow-elevation-dark-three h-full w-full flex items-center justify-center">
                                                <span class="text-[8px] font-bold text-primary tracking-tighter">TB</span>
                                            </div>
                                        </div>
                                        <span class="text-foreground text-sm font-semibold">TokoBaju</span>
                                    </div>
                                    <p class="text-sm text-muted-foreground">Toko pakaian online terpercaya sejak 2026.</p>
                                </div>
                                <div>
                                    <h4 class="text-foreground text-sm font-semibold mb-3">Belanja</h4>
                                    <ul class="space-y-2 text-sm text-muted-foreground">
                                        <li><a href="#" class="hover:text-foreground transition-colors">Atasan</a></li>
                                        <li><a href="#" class="hover:text-foreground transition-colors">Bawahan</a></li>
                                        <li><a href="#" class="hover:text-foreground transition-colors">Outerwear</a></li>
                                        <li><a href="#" class="hover:text-foreground transition-colors">Aksesoris</a></li>
                                    </ul>
                                </div>
                                <div>
                                    <h4 class="text-foreground text-sm font-semibold mb-3">Bantuan</h4>
                                    <ul class="space-y-2 text-sm text-muted-foreground">
                                        <li><a href="#" class="hover:text-foreground transition-colors">FAQ</a></li>
                                        <li><a href="#" class="hover:text-foreground transition-colors">Pengiriman</a></li>
                                        <li><a href="#" class="hover:text-foreground transition-colors">Pengembalian</a></li>
                                        <li><a href="#" class="hover:text-foreground transition-colors">Kontak</a></li>
                                    </ul>
                                </div>
                                <div>
                                    <h4 class="text-foreground text-sm font-semibold mb-3">Ikuti Kami</h4>
                                    <ul class="space-y-2 text-sm text-muted-foreground">
                                        <li><a href="#" class="hover:text-foreground transition-colors">Instagram</a></li>
                                        <li><a href="#" class="hover:text-foreground transition-colors">Twitter</a></li>
                                        <li><a href="#" class="hover:text-foreground transition-colors">Facebook</a></li>
                                        <li><a href="#" class="hover:text-foreground transition-colors">TikTok</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="border-t border-border mt-10 pt-6 text-sm text-center text-muted-foreground">
                                &copy; {{ date('Y') }} TokoBaju. All rights reserved.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>

</body>
</html>
