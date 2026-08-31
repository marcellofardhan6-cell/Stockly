<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Stockly membantu bisnis mengelola stok barang, mencatat penjualan, dan memantau aktivitas bisnis dalam satu tempat.">
    <title>Stockly — Aplikasi Penjualan &amp; Manajemen Stok</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>document.documentElement.classList.add('anim');</script>
</head>
<body class="overflow-x-clip bg-background font-sans text-content antialiased">

    {{-- Loading splash --}}
    <div class="splash" aria-hidden="true">
        <div class="splash-logo">
            <span class="splash-mark flex h-12 w-12 items-center justify-center rounded-xl bg-primary">
                <svg class="h-6 w-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 8l-9-5-9 5v8l9 5 9-5V8z"/>
                    <path d="M3 8l9 5 9-5"/>
                    <path d="M12 13v8"/>
                </svg>
            </span>
            <span class="splash-spinner"></span>
            <span class="splash-copy">Stockly</span>
        </div>
    </div>

    {{-- ===== Navbar ===== --}}
    <header data-anim style="--anim-y: -8px; --anim-d: 400ms" class="border-b border-line bg-surface">
        <nav class="mx-auto flex h-16 max-w-6xl items-center justify-between px-6">
            <a href="/" class="flex items-center gap-2">
                <span class="flex h-7 w-7 items-center justify-center rounded-md bg-primary">
                    <svg class="h-4 w-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 8l-9-5-9 5v8l9 5 9-5V8z"/>
                        <path d="M3 8l9 5 9-5"/>
                        <path d="M12 13v8"/>
                    </svg>
                </span>
                <span class="text-base font-semibold tracking-tight">Stockly</span>
            </a>

            <div class="hidden items-center gap-7 text-sm md:flex">
                <a href="#fitur" class="nav-link text-muted transition-colors hover:text-content">Fitur</a>
                <a href="#tentang" class="nav-link text-muted transition-colors hover:text-content">Tentang</a>
                <a href="{{ route('login') }}" class="nav-link text-muted transition-colors hover:text-content">Masuk</a>
                <a href="{{ route('login') }}" class="btn-pop rounded-md bg-primary px-3.5 py-2 font-medium text-white transition-colors hover:bg-primary-hover">Mulai Sekarang</a>
            </div>

            <details class="relative md:hidden">
                <summary class="flex h-9 w-9 cursor-pointer list-none items-center justify-center rounded-md border border-line text-muted [&::-webkit-details-marker]:hidden">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
                        <path d="M4 7h16M4 12h16M4 17h16"/>
                    </svg>
                </summary>
                <div class="absolute right-0 top-full z-20 mt-2 w-44 rounded-lg border border-line bg-surface p-1.5 shadow-lg">
                    <a href="#fitur" class="block rounded-md px-3 py-2 text-sm text-content hover:bg-line-soft">Fitur</a>
                    <a href="#tentang" class="block rounded-md px-3 py-2 text-sm text-content hover:bg-line-soft">Tentang</a>
                    <a href="{{ route('login') }}" class="block rounded-md px-3 py-2 text-sm text-content hover:bg-line-soft">Masuk</a>
                    <a href="{{ route('login') }}" class="btn-pop mt-1 block rounded-md bg-primary px-3 py-2 text-sm font-medium text-white hover:bg-primary-hover">Mulai Sekarang</a>
                </div>
            </details>
        </nav>
    </header>

    <main>
        {{-- ===== Hero ===== --}}
        <section class="relative mx-auto max-w-6xl overflow-visible px-6 pb-16 pt-14 lg:pb-24 lg:pt-20">

            {{-- Dekorasi background --}}
            <div class="pointer-events-none absolute inset-0 z-0" aria-hidden="true">

                <svg class="absolute -left-20 top-4 h-72 w-72 text-muted lg:-left-28 lg:h-96 lg:w-96" viewBox="0 0 200 200" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" opacity="0.4">
                    <circle cx="100" cy="100" r="96" opacity="0.55"/>
                    <circle cx="100" cy="100" r="74" opacity="0.38"/>
                    <circle cx="100" cy="100" r="52" opacity="0.25"/>
                </svg>

                <svg class="decor-curve absolute -right-16 top-32 h-80 w-80 text-primary lg:-right-20 lg:h-96 lg:w-96" viewBox="0 0 200 200" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" opacity="0.13">
                    <path d="M10 120 C 70 30, 130 170, 190 80"/>
                    <circle cx="190" cy="80" r="4" fill="currentColor" stroke="none"/>
                    <circle cx="10" cy="120" r="4" fill="currentColor" stroke="none"/>
                    <path d="M40 170 v -16 M56 170 v -16 M40 186 v -16"/>
                </svg>

                <svg class="decor-package absolute right-28 top-10 hidden h-44 w-44 text-muted md:block" viewBox="0 0 176 176" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" opacity="0.3">
                    <rect x="8" y="8" width="160" height="160" rx="12"/>
                    <circle cx="45" cy="45" r="12"/>
                    <circle cx="45" cy="131" r="12"/>
                    <circle cx="131" cy="88" r="12"/>
                    <path d="M59 45 h 50 M131 45 v 34 M59 131 h 60 M131 102 v 40"/>
                    <path d="M45 59 v 58"/>
                </svg>

                <svg class="absolute left-1/2 top-0 hidden h-52 w-52 -translate-x-1/2 text-line lg:block" viewBox="0 0 208 208" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" opacity="0.7">
                    <path d="M0 52 L 208 52 M0 104 L 208 104 M0 156 L 208 156"/>
                    <path d="M52 0 v 208 M104 0 v 208 M156 0 v 208"/>
                </svg>

                <svg class="absolute -left-8 top-[55%] hidden h-44 w-44 text-primary lg:block" viewBox="0 0 160 160" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" opacity="0.12">
                    <path d="M40 120 L 80 40 L 120 120 Z"/>
                    <path d="M80 40 v 80"/>
                    <path d="M40 120 h 80"/>
                </svg>

                <svg class="absolute bottom-8 left-1/3 hidden h-36 w-36 text-muted xl:block" viewBox="0 0 144 144" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" opacity="0.22">
                    <path d="M28 28 L 116 44 M36 116 L 124 100 M72 12 L 72 132"/>
                    <circle cx="28" cy="28" r="5"/>
                    <circle cx="116" cy="44" r="5"/>
                    <circle cx="36" cy="116" r="5"/>
                    <circle cx="124" cy="100" r="5"/>
                    <circle cx="72" cy="12" r="5"/>
                    <circle cx="72" cy="132" r="5"/>
                </svg>

                <span class="decor-node absolute right-8 top-10 h-2.5 w-2.5 rounded-full bg-primary" style="--op: 0.25"></span>
                <span class="absolute right-24 top-16 h-2 w-2 rounded-full bg-muted opacity-30" style="animation-delay: 0.8s"></span>
                <span class="decor-node absolute left-1/4 bottom-16 h-2.5 w-2.5 rounded-full bg-primary" style="--op: 0.2; animation-delay: 1.2s"></span>
                <span class="absolute left-16 top-[30%] h-1.5 w-1.5 rounded-full bg-muted opacity-25" style="animation-delay: 0.4s"></span>
            </div>

            <div class="relative z-10 grid items-center gap-12 lg:grid-cols-2">
                <div>
                    <p data-anim style="--anim-delay: 60ms; --anim-y: 10px" class="text-sm font-medium uppercase tracking-wide text-primary">Aplikasi Penjualan &amp; Manajemen Stok</p>
                    <h1 data-anim style="--anim-delay: 140ms; --anim-y: 15px; --anim-d: 600ms" class="mt-3 text-4xl font-semibold leading-tight tracking-tight text-content lg:text-5xl">
                        Kelola Stok.<br>
                        Kelola Bisnis.
                    </h1>
                    <p data-anim style="--anim-delay: 250ms; --anim-y: 10px" class="mt-5 max-w-md text-base leading-relaxed text-muted lg:text-lg">
                        Stockly membantu bisnis mengelola stok barang, mencatat penjualan, dan memantau aktivitas bisnis dalam satu tempat.
                    </p>
                    <div data-anim style="--anim-delay: 340ms; --anim-y: 8px" class="mt-8 flex items-center gap-3">
                        <a href="{{ route('login') }}" class="btn-pop rounded-md bg-primary px-4 py-2.5 text-sm font-medium text-white transition-colors hover:bg-primary-hover">Mulai Sekarang</a>
                        <a href="{{ route('login') }}" class="btn-pop rounded-md border border-line bg-surface px-4 py-2.5 text-sm font-medium text-content transition-colors hover:bg-line-soft">Masuk</a>
                    </div>
                </div>

                <div data-anim style="--anim-delay: 400ms; --anim-y: 10px; --anim-s: 0.97; --anim-d: 600ms" class="card-lift rounded-lg border border-line bg-surface shadow-sm">
                    <div class="flex items-center gap-1.5 border-b border-line px-4 py-2.5">
                        <span class="h-2.5 w-2.5 rounded-full bg-line"></span>
                        <span class="h-2.5 w-2.5 rounded-full bg-line"></span>
                        <span class="h-2.5 w-2.5 rounded-full bg-line"></span>
                        <span class="ml-3 text-xs text-subtle">Stockly — Inventaris</span>
                    </div>

                    <div class="grid grid-cols-3 divide-x divide-line-soft border-b border-line">
                        <div data-anim style="--anim-delay: 520ms" class="p-4">
                            <p class="text-[11px] font-medium uppercase tracking-wide text-subtle">Produk</p>
                            <p class="mt-1 text-lg font-semibold tabular-nums" data-count-to="1284" data-count-delay="520">1.284</p>
                            <p class="mt-0.5 text-xs text-primary">+32 minggu ini</p>
                        </div>
                        <div data-anim style="--anim-delay: 600ms" class="p-4">
                            <p class="text-[11px] font-medium uppercase tracking-wide text-subtle">Stok menipis</p>
                            <p class="mt-1 text-lg font-semibold tabular-nums" data-count-to="23" data-count-delay="600">23</p>
                            <p class="mt-0.5 text-xs text-muted">perlu restock</p>
                        </div>
                        <div data-anim style="--anim-delay: 680ms" class="p-4">
                            <p class="text-[11px] font-medium uppercase tracking-wide text-subtle">Penjualan hari ini</p>
                            <p class="mt-1 text-lg font-semibold tabular-nums" data-count-to="2450000" data-count-prefix="Rp " data-count-delay="680">Rp 2.450.000</p>
                            <p class="mt-0.5 text-xs text-primary">+4,2%</p>
                        </div>
                    </div>

                    <div class="px-4 py-2 text-xs">
                        <div class="grid grid-cols-[1fr_auto_auto] items-center gap-4 border-b border-line-soft pb-2 font-medium uppercase tracking-wide text-subtle">
                            <span>Produk</span>
                            <span class="text-right">Stok</span>
                            <span>Status</span>
                        </div>
                        @foreach([
                            ['name' => 'Kopi Arabica Biji 1kg', 'sku' => 'SKU-1042', 'stock' => 128, 'status' => 'Tersedia', 'class' => 'bg-success-soft text-success'],
                            ['name' => 'Mug Keramik Putih Matte', 'sku' => 'SKU-1087', 'stock' => 42, 'status' => 'Tersedia', 'class' => 'bg-success-soft text-success'],
                            ['name' => 'Teko Pour Over 1,2L', 'sku' => 'SKU-1123', 'stock' => 8, 'status' => 'Stok menipis', 'class' => 'bg-warning-soft text-warning'],
                            ['name' => 'Botol Cold Brew 750ml', 'sku' => 'SKU-1198', 'stock' => 0, 'status' => 'Stok habis', 'class' => 'bg-danger-soft text-danger'],
                        ] as $item)
                            <div data-anim style="--anim-delay: {{ 740 + $loop->index * 80 }}ms" class="grid grid-cols-[1fr_auto_auto] items-center gap-4 border-b border-line-soft py-2.5 last:border-0">
                                <div class="min-w-0">
                                    <p class="truncate text-content">{{ $item['name'] }}</p>
                                    <p class="text-[11px] text-subtle">{{ $item['sku'] }}</p>
                                </div>
                                <span class="text-right tabular-nums text-muted">{{ $item['stock'] }}</span>
                                <span data-anim-fade style="--anim-delay: {{ 810 + $loop->index * 80 }}ms" class="inline-flex w-[92px] justify-center rounded-full px-2 py-0.5 text-[11px] font-medium {{ $item['class'] }}">{{ $item['status'] }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div data-anim style="--anim-delay: 1040ms" class="border-t border-line px-4 py-2.5 text-xs text-subtle">
                        Menampilkan 4 dari 1.284 produk
                    </div>
                </div>
            </div>
        </section>

        {{-- ===== Fitur ===== --}}
        <section id="fitur" class="border-t border-line bg-surface">
            <div class="mx-auto max-w-6xl px-6 py-20">
                <div data-reveal class="max-w-xl">
                    <h2 class="text-2xl font-semibold tracking-tight text-content lg:text-3xl">Semua yang dibutuhkan bisnis Anda</h2>
                    <p class="mt-3 text-base leading-relaxed text-muted">
                        Stockly mencakup pekerjaan harian bisnis yang menjual produk fisik.
                    </p>
                </div>

                <div class="mt-12 grid gap-px overflow-hidden rounded-lg border border-line bg-line sm:grid-cols-3">
                    <div data-reveal class="bg-surface p-6">
                        <div class="flex h-9 w-9 items-center justify-center rounded-md border border-line text-content">
                            <svg class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 8l-9-5-9 5v8l9 5 9-5V8z"/>
                                <path d="M3 8l9 5 9-5"/>
                                <path d="M12 13v8"/>
                            </svg>
                        </div>
                        <h3 class="mt-4 text-sm font-semibold text-content">Manajemen Stok</h3>
                        <p class="mt-1.5 text-sm leading-relaxed text-muted">Pantau jumlah dan kondisi stok barang dengan mudah.</p>
                    </div>
                    <div data-reveal class="bg-surface p-6">
                        <div class="flex h-9 w-9 items-center justify-center rounded-md border border-line text-content">
                            <svg class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="8" cy="21" r="1"/>
                                <circle cx="19" cy="21" r="1"/>
                                <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/>
                            </svg>
                        </div>
                        <h3 class="mt-4 text-sm font-semibold text-content">Penjualan</h3>
                        <p class="mt-1.5 text-sm leading-relaxed text-muted">Catat transaksi penjualan dan stok akan diperbarui secara otomatis.</p>
                    </div>
                    <div data-reveal class="bg-surface p-6">
                        <div class="flex h-9 w-9 items-center justify-center rounded-md border border-line text-content">
                            <svg class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 3v18h18"/>
                                <path d="M7 15l4-5 3 3 5-7"/>
                            </svg>
                        </div>
                        <h3 class="mt-4 text-sm font-semibold text-content">Laporan</h3>
                        <p class="mt-1.5 text-sm leading-relaxed text-muted">Lihat aktivitas dan perkembangan bisnis dengan laporan yang sederhana.</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- ===== Pratinjau aplikasi ===== --}}
        <section id="pratinjau" class="mx-auto max-w-6xl px-6 py-20">
            <div data-reveal class="max-w-xl">
                <h2 class="text-2xl font-semibold tracking-tight text-content lg:text-3xl">Ruang kerja yang berfokus pada stok Anda</h2>
                <p class="mt-3 text-base leading-relaxed text-muted">
                    Satu layar untuk memeriksa stok, mencatat penjualan, dan menemukan barang yang perlu di-restock.
                </p>
            </div>

            <div data-reveal style="--anim-delay: 100ms; --anim-y: 16px" class="mt-10 overflow-hidden rounded-lg border border-line bg-surface shadow-sm">
                <div class="flex">
                    <aside class="hidden w-48 shrink-0 border-r border-line p-3 sm:block">
                        <div class="flex items-center gap-2 px-2 py-1.5">
                            <span class="flex h-6 w-6 items-center justify-center rounded-md bg-primary">
                                <svg class="h-3.5 w-3.5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 8l-9-5-9 5v8l9 5 9-5V8z"/>
                                    <path d="M3 8l9 5 9-5"/>
                                    <path d="M12 13v8"/>
                                </svg>
                            </span>
                            <span class="text-sm font-semibold tracking-tight">Stockly</span>
                        </div>
                        <nav class="mt-4 space-y-0.5 text-sm">
                            <span class="block rounded-md px-2 py-1.5 text-muted">Dasbor</span>
                            <span class="block rounded-md bg-primary-soft px-2 py-1.5 font-medium text-primary">Inventaris</span>
                            <span class="block rounded-md px-2 py-1.5 text-muted">Penjualan</span>
                            <span class="block rounded-md px-2 py-1.5 text-muted">Laporan</span>
                        </nav>
                        <div class="mt-40 border-t border-line-soft pt-3">
                            <span class="block rounded-md px-2 py-1.5 text-sm text-muted">Pengaturan</span>
                        </div>
                    </aside>

                    <div class="min-w-0 flex-1">
                        <div class="flex items-center justify-between border-b border-line px-4 py-3">
                            <p class="text-sm font-semibold">Inventaris</p>
                            <span class="btn-pop rounded-md bg-primary px-2.5 py-1.5 text-xs font-medium text-white">Tambah produk</span>
                        </div>

                        <div class="grid grid-cols-3 gap-px border-b border-line bg-line">
                            <div class="bg-surface px-4 py-3">
                                <p class="text-[11px] font-medium uppercase tracking-wide text-subtle">Total produk</p>
                                <p class="mt-0.5 text-base font-semibold tabular-nums">1.284</p>
                            </div>
                            <div class="bg-surface px-4 py-3">
                                <p class="text-[11px] font-medium uppercase tracking-wide text-subtle">Stok menipis</p>
                                <p class="mt-0.5 text-base font-semibold tabular-nums">23</p>
                            </div>
                            <div class="bg-surface px-4 py-3">
                                <p class="text-[11px] font-medium uppercase tracking-wide text-subtle">Penjualan hari ini</p>
                                <p class="mt-0.5 text-base font-semibold tabular-nums">Rp 2.450.000</p>
                            </div>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-xs sm:text-sm">
                                <thead>
                                    <tr class="border-b border-line-soft text-[11px] uppercase tracking-wide text-subtle">
                                        <th class="px-4 py-2.5 font-medium">Produk</th>
                                        <th class="hidden px-4 py-2.5 font-medium md:table-cell">Kategori</th>
                                        <th class="px-4 py-2.5 text-right font-medium">Stok</th>
                                        <th class="px-4 py-2.5 font-medium">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-line-soft">
                                    @foreach([
                                        ['name' => 'Kopi Arabica Biji 1kg', 'sku' => 'SKU-1042', 'category' => 'Kopi', 'stock' => 128, 'status' => 'Tersedia', 'dot' => 'bg-success', 'class' => 'bg-success-soft text-success'],
                                        ['name' => 'Mug Keramik Putih Matte', 'sku' => 'SKU-1087', 'category' => 'Peralatan Minum', 'stock' => 42, 'status' => 'Tersedia', 'dot' => 'bg-success', 'class' => 'bg-success-soft text-success'],
                                        ['name' => 'Teko Pour Over 1,2L', 'sku' => 'SKU-1123', 'category' => 'Peralatan', 'stock' => 8, 'status' => 'Stok menipis', 'dot' => 'bg-warning', 'class' => 'bg-warning-soft text-warning'],
                                        ['name' => 'Botol Cold Brew 750ml', 'sku' => 'SKU-1198', 'category' => 'Peralatan Minum', 'stock' => 0, 'status' => 'Stok habis', 'dot' => 'bg-danger', 'class' => 'bg-danger-soft text-danger'],
                                        ['name' => 'Timbangan Digital 0,1g', 'sku' => 'SKU-1240', 'category' => 'Peralatan', 'stock' => 64, 'status' => 'Tersedia', 'dot' => 'bg-success', 'class' => 'bg-success-soft text-success'],
                                    ] as $item)
                                        <tr>
                                            <td class="max-w-[180px] px-4 py-2.5 sm:max-w-none">
                                                <p class="truncate font-medium text-content">{{ $item['name'] }}</p>
                                                <p class="text-[11px] text-subtle">{{ $item['sku'] }}</p>
                                            </td>
                                            <td class="hidden px-4 py-2.5 text-muted md:table-cell">{{ $item['category'] }}</td>
                                            <td class="px-4 py-2.5 text-right tabular-nums text-muted">{{ $item['stock'] }}</td>
                                            <td class="px-4 py-2.5">
                                                <span class="inline-flex items-center gap-1.5 whitespace-nowrap rounded-full px-2 py-0.5 text-[11px] font-medium {{ $item['class'] }}">
                                                    <span class="h-1.5 w-1.5 rounded-full {{ $item['dot'] }}"></span>{{ $item['status'] }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    {{-- ===== Footer ===== --}}
    <footer id="tentang" class="border-t border-line bg-surface">
        <div data-reveal class="mx-auto max-w-6xl px-6 py-12">
            <div class="flex flex-col justify-between gap-8 sm:flex-row">
                <div class="max-w-sm">
                    <div class="flex items-center gap-2">
                        <span class="flex h-6 w-6 items-center justify-center rounded-md bg-primary">
                            <svg class="h-3.5 w-3.5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 8l-9-5-9 5v8l9 5 9-5V8z"/>
                                <path d="M3 8l9 5 9-5"/>
                                <path d="M12 13v8"/>
                            </svg>
                        </span>
                        <span class="text-sm font-semibold tracking-tight">Stockly</span>
                    </div>
                    <p class="mt-3 text-sm leading-relaxed text-muted">Aplikasi Penjualan &amp; Manajemen Stok untuk bisnis Anda.</p>
                </div>
                <div class="flex gap-14 text-sm">
                    <div>
                        <p class="font-medium text-content">Produk</p>
                        <ul class="mt-3 space-y-2">
                            <li><a href="#fitur" class="text-muted hover:text-content">Fitur</a></li>
                            <li><a href="#pratinjau" class="text-muted hover:text-content">Pratinjau</a></li>
                        </ul>
                    </div>
                    <div>
                        <p class="font-medium text-content">Akun</p>
                        <ul class="mt-3 space-y-2">
                            <li><a href="{{ route('login') }}" class="text-muted hover:text-content">Masuk</a></li>
                            <li><a href="{{ route('login') }}" class="text-muted hover:text-content">Mulai Sekarang</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="mt-10 flex flex-col justify-between gap-2 border-t border-line-soft pt-6 text-xs text-muted sm:flex-row">
                <p>&copy; {{ date('Y') }} Stockly. Semua hak dilindungi.</p>
                <p>Dibuat dengan Laravel.</p>
            </div>
        </div>
    </footer>

</body>
</html>
