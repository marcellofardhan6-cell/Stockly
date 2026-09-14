<x-app-shell title="Barang Masuk" page="Barang Masuk" 
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
    active="barang-masuk">

    <div class="space-y-6">
        <div data-anim style="--anim-delay: 0ms" class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="eyebrow text-sm">Stok masuk</p>
                <h1 class="page-title text-2xl font-semibold tracking-tight lg:text-3xl">Barang Masuk</h1>
                <p class="mt-1 text-sm text-muted">Catat penerimaan stok dari supplier.</p>
            </div>
            <a href="{{ route('admin.barang-masuk.create') }}" class="btn-primary btn-pop">
                <x-icon name="plus" class="h-4 w-4"/>
                Catat Barang Masuk
            </a>
        </div>

        @if (session('success'))
            <div data-anim class="rounded-md border border-success-soft border-l-4 border-l-success bg-success-soft px-4 py-3 text-sm text-success">
                {{ session('success') }}
            </div>
        @endif

        <div data-anim class="rounded-lg border border-line bg-surface shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[720px] text-left text-sm">
                    <thead>
                        <tr class="border-b border-line text-[11px] uppercase tracking-wide text-subtle">
                            <th class="px-5 py-2.5 font-medium">Tanggal</th>
                            <th class="px-4 py-2.5 font-medium">Produk</th>
                            <th class="px-4 py-2.5 font-medium">Supplier</th>
                            <th class="px-4 py-2.5 text-right font-medium">Qty</th>
                            <th class="px-4 py-2.5 text-right font-medium">Harga Beli</th>
                            <th class="px-4 py-2.5 text-right font-medium">Total</th>
                            <th class="px-5 py-2.5 text-right font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-line-soft">
                        @forelse ($barangMasuk as $item)
                            <tr class="transition-colors duration-150 hover:bg-surface-hover">
                                <td class="whitespace-nowrap px-5 py-3 text-muted">{{ $item->tanggal->translatedFormat('d M Y') }}</td>
                                <td class="max-w-[220px] px-4 py-3">
                                    <p class="truncate font-medium text-content">{{ $item->produk?->nama ?? '— produk dihapus —' }}</p>
                                    @if ($item->produk)
                                        <p class="text-xs text-subtle">{{ $item->produk->sku }}</p>
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-4 py-3 text-muted">{{ $item->supplier?->nama ?? '—' }}</td>
                                <td class="whitespace-nowrap px-4 py-3 text-right tabular-nums text-content">{{ $item->qty }}</td>
                                <td class="whitespace-nowrap px-4 py-3 text-right tabular-nums text-muted">Rp{{ number_format($item->harga_beli, 0, ',', '.') }}</td>
                                <td class="whitespace-nowrap px-4 py-3 text-right tabular-nums font-medium text-content">Rp{{ number_format($item->getTotal(), 0, ',', '.') }}</td>
                                <td class="px-5 py-3">
                                    <div class="flex items-center justify-end">
                                        <form method="POST" action="{{ route('admin.barang-masuk.destroy', $item) }}" onsubmit="return confirm('Hapus catatan ini? Stok produk akan dikurangi kembali.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-pop rounded-md px-2.5 py-1.5 text-xs font-medium text-danger transition-colors hover:bg-danger-soft">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-5 py-12 text-center text-muted">
                                    Belum ada barang masuk. Catat penerimaan stok pertama Anda.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($barangMasuk->hasPages())
                <div class="border-t border-line px-5 py-3">
                    {{ $barangMasuk->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-shell>