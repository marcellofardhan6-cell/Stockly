<x-app-shell title="Laporan" page="Laporan" 
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
    active="laporan">

    <div class="space-y-6">
        <div data-anim style="--anim-delay: 0ms">
            <p class="eyebrow text-sm">Analitik bisnis</p>
                <h1 class="page-title text-2xl font-semibold tracking-tight lg:text-3xl">Laporan</h1>
            <p class="mt-1 text-sm text-muted">Ringkasan penjualan dan performa stok.</p>
        </div>

        <div class="grid grid-cols-2 gap-4 xl:grid-cols-3">
            <div data-anim style="--anim-delay: 60ms">
                <x-stat-card label="Total Penjualan" value="Rp{{ number_format($totalPenjualan, 0, ',', '.') }}"/>
            </div>
            <div data-anim style="--anim-delay: 120ms">
                <x-stat-card label="Total Transaksi" value="{{ number_format($totalTransaksi, 0, ',', '.') }}"/>
            </div>
            <div data-anim style="--anim-delay: 180ms">
                <x-stat-card label="Produk Terjual" value="{{ number_format($produkTerjual, 0, ',', '.') }}" note="unit" noteClass="text-muted"/>
            </div>
        </div>

        <div class="grid gap-4 xl:grid-cols-2">
            {{-- Produk terlaris --}}
            <section data-anim style="--anim-delay: 240ms" class="rounded-lg border border-line bg-surface">
                <header class="border-b border-line px-5 py-4">
                    <h2 class="text-sm font-semibold text-content">Produk Terlaris</h2>
                    <p class="mt-0.5 text-xs text-subtle">Berdasarkan jumlah unit terjual.</p>
                </header>
                <div class="divide-y divide-line-soft">
                    @forelse ($produkTerlaris as $i => $item)
                        <div class="flex items-center gap-4 px-5 py-3.5">
                            <span class="grid h-7 w-7 shrink-0 place-items-center rounded-md bg-primary-soft text-xs font-bold text-primary">{{ $i + 1 }}</span>
                            <div class="min-w-0 flex-1">
                                <p class="truncate text-sm font-medium text-content">{{ $item->nama_produk }}</p>
                                <p class="text-xs text-subtle">{{ $item->total_qty }} unit terjual</p>
                            </div>
                            <span class="text-sm font-semibold tabular-nums text-content">Rp{{ number_format($item->total_nilai, 0, ',', '.') }}</span>
                        </div>
                    @empty
                        <p class="px-5 py-8 text-center text-sm text-muted">Belum ada data penjualan.</p>
                    @endforelse
                </div>
            </section>

            {{-- Stok menipis --}}
            <section data-anim style="--anim-delay: 300ms" class="rounded-lg border border-line bg-surface">
                <header class="border-b border-line px-5 py-4">
                    <h2 class="text-sm font-semibold text-content">Stok Perlu Perhatian</h2>
                    <p class="mt-0.5 text-xs text-subtle">Produk dengan stok di bawah atau sama dengan batas minimal.</p>
                </header>
                <div class="divide-y divide-line-soft">
                    @forelse ($stokMenipis as $item)
                        <div class="flex items-center justify-between gap-4 px-5 py-3.5">
                            <div class="min-w-0">
                                <p class="truncate text-sm font-medium text-content">{{ $item->nama }}</p>
                                <p class="text-xs text-subtle">{{ $item->sku }} · min {{ $item->stok_minimal }}</p>
                            </div>
                            <x-status-badge :status="$item->getStatus()"/>
                        </div>
                    @empty
                        <p class="px-5 py-8 text-center text-sm text-muted">Semua stok dalam kondisi aman.</p>
                    @endforelse
                </div>
            </section>
        </div>

        {{-- Riwayat transaksi --}}
        <section data-anim style="--anim-delay: 360ms" class="rounded-lg border border-line bg-surface">
            <header class="border-b border-line px-5 py-4">
                <h2 class="text-sm font-semibold text-content">Riwayat Transaksi</h2>
            </header>
            <div class="overflow-x-auto">
                <table class="w-full min-w-[640px] text-left text-sm">
                    <thead>
                        <tr class="border-b border-line text-[11px] uppercase tracking-wide text-subtle">
                            <th class="px-5 py-2.5 font-medium">Invoice</th>
                            <th class="px-4 py-2.5 font-medium">Kasir</th>
                            <th class="px-4 py-2.5 font-medium">Waktu</th>
                            <th class="px-4 py-2.5 text-right font-medium">Total</th>
                            <th class="px-4 py-2.5 font-medium">Status</th>
                            <th class="px-5 py-2.5 text-right font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-line-soft">
                        @forelse ($penjualan as $trx)
                            <tr class="transition-colors duration-150 hover:bg-surface-hover">
                                <td class="whitespace-nowrap px-5 py-3 font-medium text-content">{{ $trx->invoice }}</td>
                                <td class="whitespace-nowrap px-4 py-3 text-muted">{{ $trx->kasir }}</td>
                                <td class="whitespace-nowrap px-4 py-3 text-muted">{{ $trx->created_at->translatedFormat('d M Y · H:i') }}</td>
                                <td class="whitespace-nowrap px-4 py-3 text-right tabular-nums font-medium text-content">Rp{{ number_format($trx->total, 0, ',', '.') }}</td>
                                <td class="px-4 py-3"><x-status-badge :status="$trx->status"/></td>
                                <td class="px-5 py-3">
                                    <div class="flex items-center justify-end">
                                        <a href="{{ route('admin.laporan.show', $trx) }}" class="btn-pop rounded-md px-2.5 py-1.5 text-xs font-medium text-muted transition-colors hover:bg-surface-hover hover:text-content">Lihat</a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-5 py-12 text-center text-muted">Belum ada transaksi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($penjualan->hasPages())
                <div class="border-t border-line px-5 py-3">
                    {{ $penjualan->links() }}
                </div>
            @endif
        </section>
    </div>
</x-app-shell>