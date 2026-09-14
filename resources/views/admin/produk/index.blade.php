<x-app-shell title="Produk" page="Produk"  search
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

    <div class="space-y-6">
        <div data-anim style="--anim-delay: 0ms" class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="eyebrow text-sm">Inventaris</p>
                <h1 class="page-title text-2xl font-semibold tracking-tight lg:text-3xl">Produk</h1>
                <p class="mt-1 text-sm text-muted">Kelola daftar produk dan informasi stok.</p>
            </div>
            <a href="{{ route('admin.produk.create') }}" class="btn-primary btn-pop">
                <x-icon name="plus" class="h-4 w-4"/>
                Tambah Produk
            </a>
        </div>

        @if (session('success'))
            <div data-anim class="rounded-md border border-success-soft border-l-4 border-l-success bg-success-soft px-4 py-3 text-sm text-success">
                {{ session('success') }}
            </div>
        @endif

        <div data-anim class="rounded-lg border border-line bg-surface shadow-sm">
            <div class="flex flex-col gap-3 border-b border-line px-5 py-3 sm:flex-row sm:items-center sm:justify-between">
                <p class="text-sm text-muted">
                    Menampilkan <span class="font-medium text-content">{{ $produk->firstItem() ?? 0 }}</span>
                    – <span class="font-medium text-content">{{ $produk->lastItem() ?? 0 }}</span>
                    dari <span class="font-medium text-content">{{ $produk->total() }}</span> produk
                </p>
                <div class="flex flex-col gap-2 sm:flex-row sm:items-center">
                    <form method="GET" action="{{ route('admin.produk.index') }}" class="flex items-center gap-2">
                        @if (request('status'))
                            <input type="hidden" name="status" value="{{ request('status') }}">
                        @endif
                        <div class="relative sm:w-64">
                            <x-icon name="search" class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-subtle"/>
                            <input type="search" name="q" value="{{ request('q') }}" placeholder="Cari nama / SKU..."
                                class="w-full rounded-md border border-line bg-surface py-2 pl-9 pr-3 text-sm text-content transition duration-200 placeholder:text-subtle focus:border-primary focus:outline-none focus:ring-4 focus:ring-primary/10">
                        </div>
                    </form>

                    <form method="GET" action="{{ route('admin.produk.index') }}">
                        @if (request('q'))
                            <input type="hidden" name="q" value="{{ request('q') }}">
                        @endif
                        <select name="status" onchange="this.form.submit()"
                            class="w-full rounded-md border border-line bg-surface py-2 pl-3 pr-8 text-sm text-content transition duration-200 focus:border-primary focus:outline-none focus:ring-4 focus:ring-primary/10 sm:w-44">
                            <option value="">Semua status</option>
                            <option value="tersedia" @selected(request('status') === 'tersedia')>Tersedia</option>
                            <option value="menipis" @selected(request('status') === 'menipis')>Stok Menipis</option>
                            <option value="habis" @selected(request('status') === 'habis')>Stok Habis</option>
                        </select>
                    </form>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full min-w-[900px] text-left text-sm">
                    <thead>
                        <tr class="border-b border-line text-[11px] uppercase tracking-wide text-subtle">
                            <th class="px-5 py-2.5 font-medium">Produk</th>
                            <th class="px-4 py-2.5 font-medium">Kategori</th>
                            <th class="px-4 py-2.5 font-medium">SKU</th>
                            <th class="px-4 py-2.5 text-right font-medium">Harga Beli</th>
                            <th class="px-4 py-2.5 text-right font-medium">Harga Jual</th>
                            <th class="px-4 py-2.5 text-right font-medium">Stok</th>
                            <th class="px-4 py-2.5 font-medium">Status</th>
                            <th class="px-5 py-2.5 text-right font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-line-soft">
                        @forelse ($produk as $item)
                            <tr class="transition-colors duration-150 hover:bg-surface-hover">
                                <td class="max-w-[240px] px-5 py-3">
                                    <a href="{{ route('admin.produk.show', $item) }}" class="block">
                                        <p class="truncate font-medium text-content hover:text-primary">{{ $item->nama }}</p>
                                    </a>
                                </td>
                                <td class="whitespace-nowrap px-4 py-3 text-muted">{{ $item->kategori?->nama ?? '—' }}</td>
                                <td class="whitespace-nowrap px-4 py-3 text-xs text-subtle">{{ $item->sku }}</td>
                                <td class="whitespace-nowrap px-4 py-3 text-right tabular-nums text-muted">Rp{{ number_format($item->harga_beli, 0, ',', '.') }}</td>
                                <td class="whitespace-nowrap px-4 py-3 text-right tabular-nums text-content">Rp{{ number_format($item->harga_jual, 0, ',', '.') }}</td>
                                <td class="px-4 py-3 text-right tabular-nums">
                                    <span @class([
                                        'font-semibold',
                                        'text-danger' => $item->stok <= 0,
                                        'text-warning' => $item->stok > 0 && $item->stok <= $item->stok_minimal,
                                        'text-muted' => $item->stok > $item->stok_minimal,
                                    ])>{{ $item->stok }}</span>
                                </td>
                                <td class="px-4 py-3">
                                    <x-status-badge :status="$item->getStatus()"/>
                                </td>
                                <td class="px-5 py-3">
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ route('admin.produk.show', $item) }}" class="btn-pop rounded-md px-2.5 py-1.5 text-xs font-medium text-muted transition-colors hover:bg-surface-hover hover:text-content">Lihat</a>
                                        <a href="{{ route('admin.produk.edit', $item) }}" class="btn-pop rounded-md px-2.5 py-1.5 text-xs font-medium text-muted transition-colors hover:bg-surface-hover hover:text-content">Edit</a>
                                        <form method="POST" action="{{ route('admin.produk.destroy', $item) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-pop rounded-md px-2.5 py-1.5 text-xs font-medium text-danger transition-colors hover:bg-danger-soft">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-5 py-12 text-center text-muted">
                                    {{ request('q') ? 'Tidak ada produk yang cocok dengan pencarian.' : 'Belum ada produk. Tambahkan produk pertama Anda.' }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($produk->hasPages())
                <div class="border-t border-line px-5 py-3">
                    {{ $produk->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-shell>