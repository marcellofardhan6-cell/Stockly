<x-app-shell title="Detail Transaksi" page="Laporan" 
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

    <div class="mx-auto max-w-2xl space-y-6">
        <div data-anim class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
            <div>
                <a href="{{ route('admin.laporan.index') }}" class="mb-2 inline-flex items-center gap-1 text-sm text-muted transition-colors hover:text-content">
                    <x-icon name="arrow-left" class="h-4 w-4"/> Kembali
                </a>
                <h1 class="page-title text-2xl font-semibold tracking-tight lg:text-3xl">{{ $penjualan->invoice }}</h1>
                <p class="mt-1 text-sm text-muted">{{ $penjualan->created_at->translatedFormat('d F Y · H:i') }} · Kasir {{ $penjualan->kasir }}</p>
            </div>
            <x-status-badge :status="$penjualan->status"/>
        </div>

        <div data-anim class="panel overflow-hidden">
            <div class="border-b border-line px-6 py-4">
                <h2 class="text-sm font-semibold text-content">Rincian Item</h2>
            </div>
            <div class="divide-y divide-line-soft">
                @foreach ($penjualan->items as $item)
                    <div class="flex items-center justify-between gap-4 px-6 py-3.5">
                        <div class="min-w-0">
                            <p class="truncate text-sm font-medium text-content">{{ $item->nama_produk }}</p>
                            <p class="mt-0.5 text-xs text-subtle">{{ $item->qty }} × Rp{{ number_format($item->harga, 0, ',', '.') }}</p>
                        </div>
                        <span class="text-sm font-semibold tabular-nums text-content">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</span>
                    </div>
                @endforeach
            </div>
            <div class="flex items-center justify-between border-t border-line bg-surface-hover/30 px-6 py-4">
                <div class="text-sm">
                    <p class="text-muted">Total ({{ $penjualan->items->sum('qty') }} item) · {{ ucfirst($penjualan->metode_bayar) }}</p>
                    @if ($penjualan->metode_bayar === 'tunai')
                        <p class="mt-0.5 text-xs text-subtle">Diterima Rp{{ number_format($penjualan->uang_diterima, 0, ',', '.') }} · Kembalian Rp{{ number_format($penjualan->kembalian, 0, ',', '.') }}</p>
                    @endif
                </div>
                <span class="text-lg font-bold tabular-nums text-primary">Rp{{ number_format($penjualan->total, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>
</x-app-shell>