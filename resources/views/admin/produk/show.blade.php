<x-app-shell title="Detail Produk" page="Produk" 
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
    active="produk">

    <div class="mx-auto max-w-3xl space-y-6">
        <div data-anim class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
            <div>
                <a href="{{ route('admin.produk.index') }}" class="mb-2 inline-flex items-center gap-1 text-sm text-muted transition-colors hover:text-content">
                    <x-icon name="arrow-left" class="h-4 w-4"/> Kembali
                </a>
                <h1 class="page-title text-2xl font-semibold tracking-tight lg:text-3xl">{{ $produk->nama }}</h1>
                <p class="mt-1 text-sm text-muted">{{ $produk->sku }} · {{ $produk->kategori?->nama ?? 'Tanpa kategori' }}</p>
            </div>
            <div class="flex shrink-0 items-center gap-2">
                <x-status-badge :status="$produk->getStatus()"/>
            </div>
        </div>

        <div data-anim class="panel p-6">
            <h2 class="text-sm font-semibold">Informasi Produk</h2>
            <dl class="mt-4 grid gap-x-6 gap-y-4 sm:grid-cols-2">
                <div>
                    <dt class="text-xs uppercase tracking-wide text-subtle">Stok</dt>
                    <dd class="mt-1 text-lg font-semibold tabular-nums">
                        <span @class([
                            'text-danger' => $produk->stok <= 0,
                            'text-warning' => $produk->stok > 0 && $produk->stok <= $produk->stok_minimal,
                        ])>{{ $produk->stok }}</span>
                        <span class="ml-1 text-sm font-normal text-muted">/ min {{ $produk->stok_minimal }}</span>
                    </dd>
                </div>
                <div>
                    <dt class="text-xs uppercase tracking-wide text-subtle">Harga Jual</dt>
                    <dd class="mt-1 text-lg font-semibold tabular-nums">Rp{{ number_format($produk->harga_jual, 0, ',', '.') }}</dd>
                </div>
                <div>
                    <dt class="text-xs uppercase tracking-wide text-subtle">Harga Beli</dt>
                    <dd class="mt-1 text-lg font-semibold tabular-nums">Rp{{ number_format($produk->harga_beli, 0, ',', '.') }}</dd>
                </div>
                <div>
                    <dt class="text-xs uppercase tracking-wide text-subtle">Margin</dt>
                    <dd class="mt-1 text-lg font-semibold text-success tabular-nums">
                        Rp{{ number_format(max(0, $produk->harga_jual - $produk->harga_beli), 0, ',', '.') }}
                    </dd>
                </div>
            </dl>

            @if ($produk->deskripsi)
                <div class="mt-6 border-t border-line pt-4">
                    <dt class="text-xs uppercase tracking-wide text-subtle">Deskripsi</dt>
                    <dd class="mt-1 text-sm leading-relaxed text-muted">{{ $produk->deskripsi }}</dd>
                </div>
            @endif
        </div>

        <div data-anim class="flex items-center justify-between border-t border-line pt-5">
            <form method="POST" action="{{ route('admin.produk.destroy', $produk) }}"
                onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-pop btn-danger-ghost rounded-md inline-flex items-center gap-2 px-4 py-2.5 text-sm font-medium">
                    Hapus Produk
                </button>
            </form>
            <a href="{{ route('admin.produk.edit', $produk) }}" class="btn-primary">Edit Produk</a>
        </div>
    </div>
</x-app-shell>
