<x-app-shell title="Dashboard" page="Dashboard" :user="$user" search
    :menu="[
        ['key' => 'dashboard', 'label' => 'Dashboard', 'icon' => 'dashboard', 'href' => route('admin.dashboard')],
        ['key' => 'produk', 'label' => 'Produk', 'icon' => 'box', 'href' => route('admin.produk.index')],
        ['key' => 'kategori', 'label' => 'Kategori', 'icon' => 'tag', 'href' => route('admin.kategori.index')],
        ['key' => 'supplier', 'label' => 'Supplier', 'icon' => 'truck', 'href' => route('admin.supplier.index')],
        ['key' => 'barang-masuk', 'label' => 'Barang Masuk', 'icon' => 'import', 'href' => route('admin.barang-masuk.index')],
        ['key' => 'laporan', 'label' => 'Laporan', 'icon' => 'chart', 'href' => route('admin.laporan.index')],
        ['key' => 'user', 'label' => 'User', 'icon' => 'users', 'href' => route('admin.user.index')],
        ['key' => 'pengaturan', 'label' => 'Pengaturan', 'icon' => 'settings', 'href' => route('admin.pengaturan.index')],
    ]"
    active="dashboard">

    <div class="space-y-6">
        <div data-anim style="--anim-delay: 0ms">
            <p class="eyebrow text-sm">Ringkasan bisnis</p>
            <h1 class="page-title mt-1 text-2xl font-semibold tracking-tight lg:text-3xl">Dashboard</h1>
            <p class="mt-1.5 text-sm text-muted">Ringkasan aktivitas bisnis hari ini.</p>
        </div>

        <div class="grid grid-cols-2 gap-4 xl:grid-cols-4">
            <div data-anim style="--anim-delay: 60ms">
                <x-stat-card label="Total Produk" value="{{ number_format($totalProduk, 0, ',', '.') }}"/>
            </div>
            <div data-anim style="--anim-delay: 140ms">
                <x-stat-card label="Total Stok" value="{{ number_format($totalStok, 0, ',', '.') }}" note="unit" noteClass="text-muted"/>
            </div>
            <div data-anim style="--anim-delay: 220ms">
                <x-stat-card label="Penjualan Hari Ini" value="Rp{{ number_format($penjualanHariIni, 0, ',', '.') }}"
                    :note="$persenHarian !== null ? ($persenHarian >= 0 ? '+' : '').$persenHarian.'% dari kemarin' : null"
                    noteClass="{{ $persenHarian !== null && $persenHarian >= 0 ? 'text-success' : 'text-danger' }}"/>
            </div>
            <div data-anim style="--anim-delay: 300ms">
                <x-stat-card label="Stok Menipis" value="{{ $stokMenipis }}" note="perlu restock" noteClass="text-warning"/>
            </div>
        </div>

        <div class="grid gap-4 xl:grid-cols-3">
            <section data-anim style="--anim-delay: 380ms" class="glow-hover liquid-glass relative rounded-xl xl:col-span-2"><span class="card-glow"></span>
                <header class="flex items-center justify-between border-b border-line px-5 py-4">
                    <h2 class="text-sm font-semibold text-content">Grafik Penjualan</h2>
                    <span class="text-xs text-subtle">7 hari terakhir</span>
                </header>
                <div class="p-5">
                    <x-chart-bars :data="$grafik"/>
                </div>
            </section>

            <section data-anim style="--anim-delay: 460ms" class="glow-hover liquid-glass relative rounded-xl"><span class="card-glow"></span>
                <header class="flex items-center justify-between border-b border-line px-5 py-4">
                    <h2 class="text-sm font-semibold text-content">Produk Stok Menipis</h2>
                    <a href="{{ route('admin.produk.index', ['status' => 'menipis']) }}" class="text-xs font-medium text-primary transition-colors hover:text-primary-hover">Lihat semua</a>
                </header>
                <div class="divide-y divide-line-soft">
                    @forelse ($produkMenipis as $item)
                        <div class="flex items-center justify-between gap-3 px-5 py-3.5 transition-colors duration-150 hover:bg-surface-hover">
                            <div class="min-w-0">
                                <p class="truncate text-sm font-medium text-content">{{ $item->nama }}</p>
                                <p class="mt-0.5 text-xs text-subtle">{{ $item->sku }} · stok {{ $item->stok }}</p>
                            </div>
                            <x-status-badge :status="$item->getStatus()"/>
                        </div>
                    @empty
                        <p class="px-5 py-8 text-center text-sm text-muted">Semua stok dalam kondisi aman.</p>
                    @endforelse
                </div>
            </section>
        </div>

        <section data-anim style="--anim-delay: 540ms" class="glow-hover liquid-glass relative rounded-xl"><span class="card-glow"></span>
            <header class="flex items-center justify-between border-b border-line px-5 py-4">
                <h2 class="text-sm font-semibold text-content">Transaksi Terbaru</h2>
                <a href="{{ route('admin.laporan.index') }}" class="text-xs font-medium text-primary transition-colors hover:text-primary-hover">Lihat semua</a>
            </header>
            <div class="overflow-x-auto">
                <table class="w-full min-w-[560px] text-left text-sm">
                    <thead>
                        <tr class="border-b border-line-soft text-[11px] uppercase tracking-wide text-subtle">
                            <th class="px-5 py-2.5 font-medium">Invoice</th>
                            <th class="px-4 py-2.5 font-medium">Kasir</th>
                            <th class="px-4 py-2.5 font-medium">Tanggal</th>
                            <th class="px-4 py-2.5 text-right font-medium">Total</th>
                            <th class="px-5 py-2.5 font-medium">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-line-soft">
                        @forelse ($transaksiTerbaru as $trx)
                            <tr class="transition-colors duration-150 hover:bg-surface-hover">
                                <td class="whitespace-nowrap px-5 py-3 font-medium text-content">{{ $trx->invoice }}</td>
                                <td class="whitespace-nowrap px-4 py-3 text-muted">{{ $trx->kasir }}</td>
                                <td class="whitespace-nowrap px-4 py-3 text-muted">{{ $trx->created_at->translatedFormat('d M Y · H:i') }}</td>
                                <td class="whitespace-nowrap px-4 py-3 text-right tabular-nums font-medium text-content">Rp{{ number_format($trx->total, 0, ',', '.') }}</td>
                                <td class="px-5 py-3"><x-status-badge :status="$trx->status"/></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-5 py-8 text-center text-sm text-muted">Belum ada transaksi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</x-app-shell>