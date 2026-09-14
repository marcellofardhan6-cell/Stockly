<x-app-shell title="Penjualan" page="Penjualan" :user="$user"
    :menu="[
        ['key' => 'dashboard', 'label' => 'Dashboard', 'icon' => 'dashboard', 'href' => route('kasir.dashboard')],
        ['key' => 'penjualan', 'label' => 'Penjualan', 'icon' => 'cart', 'href' => route('kasir.penjualan.index')],
    ]"
    active="penjualan">

    <div class="space-y-6">
        <div data-anim style="--anim-delay: 0ms" class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="eyebrow text-sm">Transaksi</p>
                <h1 class="page-title text-2xl font-semibold tracking-tight lg:text-3xl">Penjualan</h1>
                <p class="mt-1 text-sm text-muted">Riwayat transaksi penjualan Anda.</p>
            </div>
            <a href="{{ route('kasir.penjualan.create') }}" class="btn-primary btn-pop">
                <x-icon name="plus" class="h-4 w-4"/>
                Transaksi Baru
            </a>
        </div>

        @if (session('success'))
            <div data-anim class="rounded-md border border-success-soft border-l-4 border-l-success bg-success-soft px-4 py-3 text-sm text-success">
                {{ session('success') }}
            </div>
        @endif

        <div data-anim class="rounded-lg border border-line bg-surface shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[640px] text-left text-sm">
                    <thead>
                        <tr class="border-b border-line text-[11px] uppercase tracking-wide text-subtle">
                            <th class="px-5 py-2.5 font-medium">Invoice</th>
                            <th class="px-4 py-2.5 font-medium">Waktu</th>
                            <th class="px-4 py-2.5 text-right font-medium">Item</th>
                            <th class="px-4 py-2.5 text-right font-medium">Total</th>
                            <th class="px-4 py-2.5 font-medium">Status</th>
                            <th class="px-5 py-2.5 text-right font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-line-soft">
                        @forelse ($penjualan as $trx)
                            <tr class="transition-colors duration-150 hover:bg-surface-hover">
                                <td class="whitespace-nowrap px-5 py-3 font-medium text-content">{{ $trx->invoice }}</td>
                                <td class="whitespace-nowrap px-4 py-3 text-muted">{{ $trx->created_at->translatedFormat('d M Y · H:i') }}</td>
                                <td class="whitespace-nowrap px-4 py-3 text-right tabular-nums text-muted">{{ $trx->items->sum('qty') }}</td>
                                <td class="whitespace-nowrap px-4 py-3 text-right tabular-nums font-medium text-content">Rp{{ number_format($trx->total, 0, ',', '.') }}</td>
                                <td class="px-4 py-3"><x-status-badge :status="$trx->status"/></td>
                                <td class="px-5 py-3">
                                    <div class="flex items-center justify-end">
                                        <a href="{{ route('kasir.penjualan.show', $trx) }}" class="btn-pop rounded-md px-2.5 py-1.5 text-xs font-medium text-muted transition-colors hover:bg-surface-hover hover:text-content">Lihat</a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-5 py-12 text-center text-muted">
                                    Belum ada transaksi. Buat transaksi pertama Anda.
                                </td>
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
        </div>
    </div>
</x-app-shell>