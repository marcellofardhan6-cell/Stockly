<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Stockly: platform penjualan & manajemen stok modern. Kelola stok, catat penjualan, dan pantau bisnis dalam satu ruang kerja yang sinematik.">
    <title>Stockly — Kelola Stok. Sekelas Profesional.</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/landing.css', 'resources/js/landing.js'])
    <script src="https://cdn.jsdelivr.net/npm/hls.js@1.6.15/dist/hls.min.js"></script>
    <style>html, body { overflow-x: clip; }</style>
</head>
<body class="landing-base bg-black font-sans text-white antialiased">

    {{-- ===== Navbar (fixed, transparent) ===== --}}
    <header class="fixed inset-x-0 top-0 z-50 bg-transparent px-6 py-4">
        <nav class="mx-auto flex max-w-7xl items-center justify-between">
            {{-- Left: sunburst logo --}}
            <a href="/" class="anim-fade flex items-center gap-2" style="animation-delay:0.1s">
                <svg class="h-6 w-6 text-white" viewBox="0 0 256 256" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M 4.688 136 C 68.373 136 120 187.627 120 251.312 C 120 252.883 119.967 254.445 119.905 256 L 0 256 L 0 136.096 C 1.555 136.034 3.117 136 4.688 136 Z M 251.312 136 C 252.883 136 254.445 136.034 256 136.096 L 256 256 L 136.095 256 C 136.032 254.438 136.001 252.875 136 251.312 C 136 187.627 187.627 136 251.312 136 Z M 119.905 0 C 119.967 1.555 120 3.117 120 4.688 C 120 68.373 68.373 120 4.687 120 C 3.117 120 1.555 119.967 0 119.905 L 0 0 Z M 256 119.905 C 254.445 119.967 252.883 120 251.312 120 C 187.627 120 136 68.373 136 4.687 C 136 3.117 136.033 1.555 136.095 0 L 256 0 Z" /></svg>
                <span class="text-base font-semibold tracking-tight">Stockly</span>
            </a>

            {{-- Center: nav links --}}
            <div class="anim-fade hidden items-center gap-8 md:flex" style="animation-delay:0.25s">
                <a href="#fitur" class="flex items-center gap-1 text-sm font-medium text-white/80 transition-colors hover:text-white">
                    Produk
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                </a>
                <a href="#modul" class="text-sm font-medium text-white/80 transition-colors hover:text-white">Modul</a>
                <a href="#pratinjau" class="text-sm font-medium text-white/80 transition-colors hover:text-white">Pratinjau</a>
            </div>

            {{-- Right: demo + get started --}}
            <div class="anim-fade flex items-center gap-5" style="animation-delay:0.25s">
                <a href="{{ route('login') }}" class="hidden text-sm font-medium text-white/80 transition-colors hover:text-white sm:block">Masuk</a>
                <a href="{{ route('login') }}" class="magnetic cta-glow rounded-full bg-white px-5 py-2.5 text-sm font-semibold text-black">
                    Mulai Gratis
                </a>
            </div>
        </nav>
    </header>

    {{-- ===== Hero ===== --}}
    <section class="relative min-h-screen w-full overflow-hidden bg-black text-white">
        {{-- HLS video background (fades in over black once playing) --}}
        <video id="hero-video" muted loop playsinline
            class="absolute inset-0 h-full w-full object-cover opacity-0 transition-opacity duration-1000">
        </video>

        {{-- Overlay --}}
        <div class="absolute inset-0 bg-black/60 backdrop-blur-[2px]"></div>

        {{-- Decorative gradients --}}
        <div class="pointer-events-none absolute left-[20%] top-[-20%] h-[600px] w-[600px] rounded-full bg-blue-900/20 blur-[120px] mix-blend-screen"></div>
        <div class="pointer-events-none absolute bottom-[-10%] right-[20%] h-[500px] w-[500px] rounded-full bg-indigo-900/20 blur-[120px] mix-blend-screen"></div>

        {{-- Content --}}
        <div class="relative z-10 mx-auto mt-20 flex max-w-5xl flex-col items-center space-y-12 px-6 text-center">
            <div class="flex min-h-screen flex-col items-center justify-center space-y-12 pb-24 pt-16">

                {{-- Pre-headline (Instrument Serif) --}}
                <p class="anim-rise font-serif text-3xl leading-[1.1] text-white sm:text-5xl lg:text-[48px]" style="animation-delay:0.1s">
                    Kelola stok secepat pikiran.
                </p>

                {{-- Main headline (gradient) --}}
                <h1 class="anim-pop bg-gradient-to-b from-white via-white to-[#b4c0ff] bg-clip-text pb-3 text-6xl font-semibold leading-[0.9] tracking-tighter text-transparent sm:text-8xl lg:text-[136px]" style="animation-delay:0.25s">
                    Build Faster
                </h1>

                {{-- Subheadline --}}
                <p class="anim-fade max-w-xl text-lg leading-[1.65] text-white/70 sm:text-[20px]" style="animation-delay:0.45s">
                    Stockly menyatukan inventaris, penjualan, dan supplier dalam satu platform yang cepat dan indah — siap dalam hitungan detik.
                </p>

                {{-- CTA buttons --}}
                <div class="anim-rise flex flex-col items-center gap-6 sm:flex-row" style="animation-delay:0.65s">
                    {{-- Primary: white pill + blue arrow --}}
                    <a href="{{ route('login') }}" class="magnetic group inline-flex items-center rounded-full bg-white py-2 pl-6 pr-2 shadow-none transition-shadow hover:shadow-[0_0_20px_rgba(255,255,255,0.3)]">
                        <span class="mr-3 text-lg font-medium text-[#0a0400]">Mulai Gratis</span>
                        <span class="flex h-10 w-10 items-center justify-center rounded-full bg-[#3054ff] transition-colors group-hover:bg-[#2040e0]">
                            <svg class="h-5 w-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </span>
                    </a>

                    {{-- Secondary: text link --}}
                    <a href="#pratinjau" class="group inline-flex items-center gap-2 rounded-lg px-4 py-2 text-white/70 backdrop-blur-sm transition-colors hover:bg-white/5 hover:text-white">
                        Lihat Contoh
                        <svg class="h-4 w-4 transition-transform group-hover:translate-x-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </a>
                </div>

            </div>
        </div>
    </section>

    {{-- ===== Pratinjau (dashboard mockup) ===== --}}
    <section id="pratinjau" class="relative mx-auto max-w-6xl scroll-mt-24 px-6 py-24">
        <div class="landing-reveal mx-auto mb-12 max-w-2xl text-center">
            <p class="font-serif text-2xl italic text-[#b4c0ff] sm:text-3xl">Pratinjau</p>
            <h2 class="mt-4 bg-gradient-to-b from-white to-[#b4c0ff] bg-clip-text pb-2 text-3xl font-semibold tracking-tight text-transparent md:text-5xl">Ruang kerja yang terasa hidup.</h2>
        </div>

        <div class="landing-reveal scale-in relative" style="--rd:150ms" data-parallax="0.05">
            <div class="pointer-events-none absolute -inset-8 rounded-[2rem] bg-gradient-to-b from-[#3054ff]/15 to-transparent blur-2xl"></div>
            <div class="relative overflow-hidden rounded-2xl border border-white/10 bg-[#0b0e14]/90 shadow-2xl backdrop-blur-2xl">
                <div class="flex h-11 items-center gap-3 border-b border-white/10 px-4">
                    <span class="h-3 w-3 rounded-full" style="background:#ff5f57"></span>
                    <span class="h-3 w-3 rounded-full" style="background:#febc2e"></span>
                    <span class="h-3 w-3 rounded-full" style="background:#28c840"></span>
                    <span class="ml-2 text-xs text-white/50">Stockly — Inventaris</span>
                </div>

                <div class="grid h-[520px] grid-cols-12">
                    {{-- Sidebar --}}
                    <div class="col-span-3 border-r border-white/10 bg-black/30 p-4">
                        <button class="mb-4 flex items-center gap-2 rounded-lg bg-white px-3 py-2 text-xs font-semibold text-black">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 3v18M3 12h18"/></svg>
                            Tambah Produk
                        </button>
                        <div class="space-y-1 text-sm">
                            @foreach([
                                ['Dasbor', 0, true], ['Produk', 284, false], ['Kategori', 8, false],
                                ['Supplier', 12, false], ['Penjualan', 0, false], ['Laporan', 0, false],
                            ] as [$label, $count, $active])
                                <div class="{{ $active ? 'bg-white/10 text-white' : 'text-white/60 hover:bg-white/5' }} flex items-center justify-between rounded-md px-3 py-2">
                                    <span class="{{ $active ? 'font-medium' : '' }}">{{ $label }}</span>
                                    @if ($count > 0)<span class="text-xs text-white/50">{{ $count }}</span>@endif
                                </div>
                            @endforeach
                        </div>
                        <p class="mt-6 text-[10px] font-medium uppercase tracking-wider text-white/40">Kategori</p>
                        <div class="mt-3 space-y-2 text-xs">
                            @foreach(['Kopi' => '#34d399', 'Peralatan Minum' => '#3054ff', 'Peralatan' => '#b4c0ff', 'Aksesori' => '#fbbf24'] as $label => $color)
                                <div class="flex items-center gap-2 text-white/60">
                                    <span class="h-2 w-2 rounded-full" style="background:{{ $color }}"></span>{{ $label }}
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- List --}}
                    <div class="col-span-4 border-r border-white/10">
                        <div class="flex items-center gap-2 border-b border-white/10 px-4 py-3 text-white/50">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                            <span class="text-xs">Cari produk</span>
                        </div>
                        @foreach([
                            ['KOP-0001', 'Kopi Arabica Biji 1kg', 'Stok 128 · Tersedia', '09:41', true, true],
                            ['PRM-0001', 'Mug Keramik Putih Matte', 'Stok 42 · Tersedia', '08:12', true, false],
                            ['PRL-0001', 'Teko Pour Over 1,2L', 'Stok 8 · Menipis', 'Kemarin', false, false],
                            ['PRM-0002', 'Botol Cold Brew 750ml', 'Stok 0 · Habis', 'Kemarin', false, false],
                            ['AKS-0001', 'Filter Paper V60', 'Stok 300 · Tersedia', 'Sen', false, false],
                            ['PRL-0003', 'Timbangan Digital 0,1g', 'Stok 64 · Tersedia', 'Sen', false, false],
                        ] as [$sku, $nama, $ket, $waktu, $unread, $active])
                            <div class="{{ $active ? 'bg-white/10' : 'hover:bg-white/5' }} cursor-pointer border-b border-white/[0.06] px-4 py-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-white">{{ $nama }}</span>
                                    <span class="text-[10px] text-white/40">{{ $waktu }}</span>
                                </div>
                                <p class="mt-0.5 text-[11px] text-white/30">{{ $sku }}</p>
                                <p class="mt-0.5 truncate text-[11px] {{ $unread ? 'text-white/70' : 'text-white/40' }}">{{ $ket }}</p>
                            </div>
                        @endforeach
                    </div>

                    {{-- Detail produk --}}
                    <div class="col-span-5">
                        <div class="flex items-center justify-between border-b border-white/10 px-4 py-2">
                            <div class="flex gap-1">
                                @foreach(['M12 20h9', 'M3 6h18M8 6V4h8v2M19 6l-1 14H6L5 6', 'M12 3v12m0 0 4-4m-4 4-4-4M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-2'] as $d)
                                    <span class="flex h-7 w-7 items-center justify-center rounded-md text-white/70 hover:bg-white/5">
                                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $d }}"/></svg>
                                    </span>
                                @endforeach
                            </div>
                            <svg class="h-4 w-4 text-white/70" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/><circle cx="5" cy="12" r="1"/></svg>
                        </div>
                        <div class="px-6 py-6">
                            <p class="text-lg font-semibold">Kopi Arabica Biji 1kg</p>
                            <div class="mt-4 flex items-center gap-2">
                                <span class="flex h-7 w-7 items-center justify-center rounded-full bg-gradient-to-br from-[#3054ff] to-[#152a86] text-xs font-semibold text-white">K</span>
                                <div>
                                    <p class="text-xs font-medium text-white">Kategori: Kopi</p>
                                    <p class="text-[11px] text-white/40">SKU KOP-0001 · diperbarui 09:41</p>
                                </div>
                                <span class="ml-auto rounded-full px-2 py-0.5 text-[10px]" style="background:#34d39933;color:#34d399">Tersedia</span>
                            </div>
                            <div class="mt-5 flex gap-3 rounded-xl border border-white/10 bg-white/[0.03] p-4">
                                <svg class="h-4 w-4 shrink-0" style="color:#b4c0ff" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a5 5 0 0 0-5 5v2H6a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8a2 2 0 0 0-2-2h-1V7a5 5 0 0 0-5-5z"/></svg>
                                <div class="text-xs leading-relaxed text-white/70"><span class="font-medium text-white">Ringkasan oleh Stockly.</span> Stok aman untuk 3 bulan. 23 terjual minggu ini, restock disarankan sebelum stok mencapai 20 unit.</div>
                            </div>
                            @foreach(['Stok saat ini', 'Harga beli', 'Harga jual', 'Terjual bulan ini'] as $i2 => $p)
                                <div class="mt-3 flex items-center justify-between border-b border-white/[0.06] pb-2 text-xs">
                                    <span class="text-white/50">{{ $p }}</span>
                                    <span class="{{ $i2 === 3 ? 'font-medium text-[#34d399]' : 'text-white/80' }}">{{ ['128 unit', 'Rp 85.000', 'Rp 120.000', '92 unit'][$i2] }}</span>
                                </div>
                            @endforeach
                            <div class="mt-5 inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/[0.03] px-3 py-1.5 text-xs text-white/80">
                                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 3v12m0 0 4-4m-4 4-4-4M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-2"/></svg>
                                Laporan stok · Mei 2026
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== Modul (fitur) ===== --}}
    <section id="modul" class="relative mx-auto max-w-6xl px-6 py-24">
        <div class="landing-reveal mx-auto max-w-2xl text-center">
            <p class="font-serif text-2xl italic text-[#b4c0ff] sm:text-3xl">Semua yang Anda butuhkan</p>
            <h2 class="mt-4 bg-gradient-to-b from-white to-[#b4c0ff] bg-clip-text pb-2 text-3xl font-semibold tracking-tight text-transparent md:text-5xl">Satu platform, semua terhubung.</h2>
        </div>

        <div class="stagger-grid mt-14 grid gap-5 sm:grid-cols-2 lg:grid-cols-3" style="--si:0">
            @foreach([
                ['box', 'Produk', 'CRUD lengkap dengan SKU otomatis, pencarian & filter status stok.'],
                ['tag', 'Kategori', 'Kelompokkan produk dengan kode unik sebagai prefiks SKU.'],
                ['truck', 'Supplier', 'Kelola data pemasok barang Anda dengan rapi.'],
                ['import', 'Barang Masuk', 'Catat restock dari supplier, stok bertambah otomatis.'],
                ['cart', 'Penjualan', 'POS kasir cepat dengan proteksi overselling.'],
                ['chart', 'Laporan', 'Rekap penjualan, produk terlaris & kesehatan stok.'],
            ] as $i => [$icon, $title, $desc])
                <div class="glow-hover liquid-glass group relative rounded-2xl p-6 transition-all duration-300 hover:-translate-y-1.5" style="--si:{{ $i + 1 }}">
                    <span class="card-glow"></span>
                    <span class="pointer-events-none absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-[#3054ff]/60 to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100"></span>
                    <div class="flex items-start justify-between">
                        <span class="inline-flex h-12 w-12 items-center justify-center rounded-xl border border-white/10 bg-gradient-to-br from-[#3054ff]/20 to-transparent text-[#b4c0ff] transition-all duration-300 group-hover:border-[#3054ff]/40 group-hover:text-white">
                            <x-icon :name="$icon" class="h-6 w-6"/>
                        </span>
                        <span class="text-xs font-bold tabular-nums text-white/20 transition-colors duration-300 group-hover:text-[#3054ff]/70">0{{ $i + 1 }}</span>
                    </div>
                    <h3 class="mt-5 text-base font-semibold tracking-tight text-white">{{ $title }}</h3>
                    <p class="mt-2 text-sm leading-relaxed text-white/50">{{ $desc }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- ===== Final CTA ===== --}}
    <section id="fitur" class="px-6 py-24">
        <div class="landing-reveal scale-in liquid-glass relative mx-auto max-w-5xl overflow-hidden rounded-3xl px-8 py-16 text-center md:py-24">
            <div class="pointer-events-none absolute left-[20%] top-[-30%] h-[400px] w-[400px] rounded-full bg-blue-900/20 blur-[100px] mix-blend-screen"></div>
            <div class="relative">
                <p class="font-serif text-2xl italic text-[#b4c0ff] sm:text-3xl">Siap merapikan bisnis Anda?</p>
                <h2 class="mt-4 bg-gradient-to-b from-white to-[#b4c0ff] bg-clip-text pb-2 text-4xl font-semibold leading-[1.02] tracking-tight text-transparent md:text-6xl">
                    Mulai hari ini.
                </h2>
                <div class="mt-9 flex flex-wrap items-center justify-center gap-4">
                    <a href="{{ route('login') }}" class="magnetic group inline-flex items-center rounded-full bg-white py-2 pl-6 pr-2 transition-shadow hover:shadow-[0_0_20px_rgba(255,255,255,0.3)]">
                        <span class="mr-3 text-lg font-medium text-[#0a0400]">Mulai Gratis</span>
                        <span class="flex h-10 w-10 items-center justify-center rounded-full bg-[#3054ff] transition-colors group-hover:bg-[#2040e0]">
                            <svg class="h-5 w-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== Footer (liquid glass) ===== --}}
    <footer class="px-6 pb-10">
        <div class="landing-reveal liquid-glass mx-auto w-full max-w-6xl rounded-3xl p-6 text-white/70 md:p-10">
            <div class="mb-10 grid grid-cols-1 gap-10 md:grid-cols-12 md:gap-12">
                <div class="md:col-span-5">
                    <div class="flex items-center gap-2 text-white">
                        <svg class="h-6 w-6" viewBox="0 0 256 256" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M 4.688 136 C 68.373 136 120 187.627 120 251.312 C 120 252.883 119.967 254.445 119.905 256 L 0 256 L 0 136.096 C 1.555 136.034 3.117 136 4.688 136 Z M 251.312 136 C 252.883 136 254.445 136.034 256 136.096 L 256 256 L 136.095 256 C 136.032 254.438 136.001 252.875 136 251.312 C 136 187.627 187.627 136 251.312 136 Z M 119.905 0 C 119.967 1.555 120 3.117 120 4.688 C 120 68.373 68.373 120 4.687 120 C 3.117 120 1.555 119.967 0 119.905 L 0 0 Z M 256 119.905 C 254.445 119.967 252.883 120 251.312 120 C 187.627 120 136 68.373 136 4.687 C 136 3.117 136.033 1.555 136.095 0 L 256 0 Z" /></svg>
                        <span class="text-xl font-medium tracking-wide">STOCKLY</span>
                    </div>
                    <p class="mt-4 max-w-sm text-sm leading-relaxed">Stockly menyatukan inventaris, penjualan, dan supplier dalam satu ruang kerja yang cepat dan indah — gratis untuk memulai.</p>
                </div>
                <div class="md:col-span-7">
                    <div class="grid grid-cols-2 gap-8 sm:grid-cols-3">
                        <div>
                            <p class="mb-4 text-sm font-medium uppercase tracking-wider text-white">Jelajahi</p>
                            <ul class="space-y-2 text-xs">
                                <li><a href="{{ route('login') }}" class="transition-colors hover:text-white">Dashboard Admin</a></li>
                                <li><a href="{{ route('login') }}" class="transition-colors hover:text-white">Kasir / POS</a></li>
                                <li><a href="{{ route('login') }}" class="transition-colors hover:text-white">Laporan</a></li>
                            </ul>
                        </div>
                        <div>
                            <p class="mb-4 text-sm font-medium uppercase tracking-wider text-white">Modul</p>
                            <ul class="space-y-2 text-xs">
                                <li><a href="{{ route('login') }}" class="transition-colors hover:text-white">Produk</a></li>
                                <li><a href="{{ route('login') }}" class="transition-colors hover:text-white">Kategori</a></li>
                                <li><a href="{{ route('login') }}" class="transition-colors hover:text-white">Supplier</a></li>
                            </ul>
                        </div>
                        <div>
                            <p class="mb-4 text-sm font-medium uppercase tracking-wider text-white">Akun</p>
                            <ul class="space-y-2 text-xs">
                                <li><a href="{{ route('login') }}" class="transition-colors hover:text-white">Masuk</a></li>
                                <li><a href="{{ route('login') }}" class="transition-colors hover:text-white">Mulai Sekarang</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col items-center justify-between gap-6 border-t border-white/10 pt-6 md:flex-row md:gap-4">
                <p class="text-[10px] uppercase tracking-widest opacity-50">&copy; {{ date('Y') }} Stockly — Dibuat dengan Laravel</p>
                <div class="flex items-center gap-4">
                    <span class="text-[10px] uppercase tracking-widest opacity-50">Ikuti Kami:</span>
                    <div class="flex items-center gap-3">
                        @foreach(['M9 18V6l10-2v11M9 18a3 3 0 1 1-6 0 3 3 0 0 1 6 0zm10-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0z', 'M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z', 'M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z'] as $d)
                            <a href="#" class="opacity-70 transition-colors hover:text-white hover:opacity-100">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $d }}"/></svg>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </footer>

    {{-- HLS video init --}}
    <script>
        (function () {
            const video = document.getElementById('hero-video');
            if (!video) return;
            const src = "https://stream.mux.com/T6oQJQ02cQ6N01TR6iHwZkKFkbepS34dkkIc9iukgy400g.m3u8";

            // Fade video in once it actually starts playing
            const fadeIn = function () {
                video.classList.remove('opacity-0');
                video.classList.add('opacity-60');
            };
            video.addEventListener('playing', fadeIn, { once: true });
            // Fallback: if already playing (cached), fade in immediately
            if (!video.paused && video.readyState >= 3) fadeIn();

            if (window.Hls && window.Hls.isSupported()) {
                const hls = new window.Hls({ maxBufferLength: 10 });
                hls.loadSource(src);
                hls.attachMedia(video);
                hls.on(window.Hls.Events.MANIFEST_PARSED, function () {
                    video.play().catch(function () {});
                });
            } else if (video.canPlayType('application/vnd.apple.mpegurl')) {
                video.src = src;
                video.addEventListener('loadedmetadata', function () {
                    video.play().catch(function () {});
                });
            }
        })();
    </script>

</body>
</html>