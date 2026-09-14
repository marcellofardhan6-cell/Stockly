<x-app-shell title="Kategori" page="Kategori" 
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
    active="kategori">

    <div class="space-y-6">
        <div data-anim style="--anim-delay: 0ms" class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="eyebrow text-sm">Pengelompokan</p>
                <h1 class="page-title text-2xl font-semibold tracking-tight lg:text-3xl">Kategori</h1>
                <p class="mt-1 text-sm text-muted">Kelola kategori untuk mengelompokkan produk.</p>
            </div>
            <a href="{{ route('admin.kategori.create') }}" class="btn-primary btn-pop">
                <x-icon name="plus" class="h-4 w-4"/>
                Tambah Kategori
            </a>
        </div>

        @if (session('success'))
            <div data-anim class="rounded-md border border-success-soft border-l-4 border-l-success bg-success-soft px-4 py-3 text-sm text-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div data-anim class="rounded-md border border-danger-soft border-l-4 border-l-danger bg-danger-soft px-4 py-3 text-sm text-danger">
                {{ session('error') }}
            </div>
        @endif

        <div data-anim class="rounded-lg border border-line bg-surface shadow-sm">
            <div class="flex flex-col gap-3 border-b border-line px-5 py-3 sm:flex-row sm:items-center sm:justify-between">
                <p class="text-sm text-muted">
                    Menampilkan <span class="font-medium text-content">{{ $kategori->firstItem() ?? 0 }}</span>
                    – <span class="font-medium text-content">{{ $kategori->lastItem() ?? 0 }}</span>
                    dari <span class="font-medium text-content">{{ $kategori->total() }}</span> kategori
                </p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full min-w-[640px] text-left text-sm">
                    <thead>
                        <tr class="border-b border-line text-[11px] uppercase tracking-wide text-subtle">
                            <th class="px-5 py-2.5 font-medium">Nama Kategori</th>
                            <th class="px-4 py-2.5 font-medium">Kode</th>
                            <th class="px-4 py-2.5 font-medium">Jumlah Produk</th>
                            <th class="px-4 py-2.5 font-medium">Tanggal Dibuat</th>
                            <th class="px-5 py-2.5 text-right font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-line-soft">
                        @forelse ($kategori as $item)
                            <tr class="transition-colors duration-150 hover:bg-surface-hover">
                                <td class="px-5 py-3">
                                    <p class="font-medium text-content">{{ $item->nama }}</p>
                                    @if ($item->deskripsi)
                                        <p class="max-w-[300px] truncate text-xs text-subtle">{{ $item->deskripsi }}</p>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <span class="rounded border border-line bg-surface-hover px-2 py-0.5 text-xs font-semibold tracking-wide text-primary">{{ $item->category_code }}</span>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="text-muted">{{ $item->produk_count }} produk</span>
                                </td>
                                <td class="px-4 py-3 text-muted">{{ $item->created_at?->translatedFormat('d M Y') }}</td>
                                <td class="px-5 py-3">
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ route('admin.kategori.edit', $item) }}" class="btn-pop rounded-md px-2.5 py-1.5 text-xs font-medium text-muted transition-colors hover:bg-surface-hover hover:text-content">Edit</a>
                                        <form method="POST" action="{{ route('admin.kategori.destroy', $item) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-pop rounded-md px-2.5 py-1.5 text-xs font-medium text-danger transition-colors hover:bg-danger-soft">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-5 py-12 text-center text-muted">
                                    Belum ada kategori. Tambahkan kategori pertama Anda.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($kategori->hasPages())
                <div class="border-t border-line px-5 py-3">
                    {{ $kategori->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-shell>