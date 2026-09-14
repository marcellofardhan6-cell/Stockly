<x-app-shell title="Detail Transaksi" page="Penjualan" :user="$user"
    :menu="[
        ['key' => 'dashboard', 'label' => 'Dashboard', 'icon' => 'dashboard', 'href' => route('kasir.dashboard')],
        ['key' => 'penjualan', 'label' => 'Penjualan', 'icon' => 'cart', 'href' => route('kasir.penjualan.index')],
    ]"
    active="penjualan">

    <div class="mx-auto max-w-2xl space-y-6">
        <div data-anim class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
            <div>
                <a href="{{ route('kasir.penjualan.index') }}" class="mb-2 inline-flex items-center gap-1 text-sm text-muted transition-colors hover:text-content">
                    <x-icon name="arrow-left" class="h-4 w-4"/> Kembali
                </a>
                <h1 class="page-title text-2xl font-semibold tracking-tight lg:text-3xl">{{ $penjualan->invoice }}</h1>
                <p class="mt-1 text-sm text-muted">{{ $penjualan->created_at->translatedFormat('d F Y · H:i') }} · Kasir {{ $penjualan->kasir }}</p>
            </div>
            <x-status-badge :status="$penjualan->status"/>
        </div>

        @if (session('success'))
            <div data-anim class="rounded-md border border-success-soft border-l-4 border-l-success bg-success-soft px-4 py-3 text-sm text-success">
                {{ session('success') }}
            </div>
        @endif

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
            <div class="space-y-2 border-t border-line bg-surface-hover/30 px-6 py-4 text-sm">
                <div class="flex items-center justify-between">
                    <span class="text-muted">Subtotal ({{ $penjualan->items->sum('qty') }} item)</span>
                    <span class="tabular-nums text-content">Rp{{ number_format($penjualan->subtotal, 0, ',', '.') }}</span>
                </div>
                @if ($penjualan->diskon > 0)
                    <div class="flex items-center justify-between">
                        <span class="text-muted">Diskon</span>
                        <span class="tabular-nums text-danger">−Rp{{ number_format($penjualan->diskon, 0, ',', '.') }}</span>
                    </div>
                @endif
                <div class="flex items-center justify-between border-t border-line-soft pt-2">
                    <span class="font-medium text-content">Total</span>
                    <span class="text-lg font-bold tabular-nums text-primary">Rp{{ number_format($penjualan->total, 0, ',', '.') }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-muted">Metode Bayar</span>
                    <span class="font-medium text-content">{{ ucfirst($penjualan->metode_bayar) }}</span>
                </div>
                @if ($penjualan->metode_bayar === 'tunai')
                    <div class="flex items-center justify-between">
                        <span class="text-muted">Uang Diterima</span>
                        <span class="tabular-nums text-content">Rp{{ number_format($penjualan->uang_diterima, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-muted">Kembalian</span>
                        <span class="font-semibold tabular-nums text-success">Rp{{ number_format($penjualan->kembalian, 0, ',', '.') }}</span>
                    </div>
                @endif
            </div>
        </div>

        <div data-anim class="flex justify-end">
            <a href="{{ route('kasir.penjualan.create') }}" class="btn-primary btn-pop">
                <x-icon name="plus" class="h-4 w-4"/>
                Transaksi Baru
            </a>
        </div>
    </div>
</x-app-shell>