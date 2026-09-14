<x-app-shell title="Dashboard Kasir" page="Dashboard" :user="$user"
    :menu="[
        ['key' => 'dashboard', 'label' => 'Dashboard', 'icon' => 'dashboard', 'href' => route('kasir.dashboard')],
        ['key' => 'penjualan', 'label' => 'Penjualan', 'icon' => 'cart', 'href' => route('kasir.penjualan.index')],
    ]"
    active="dashboard">

    <div class="space-y-6">
        <div data-anim style="--anim-delay: 0ms" class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="eyebrow text-sm">Ringkasan kasir</p>
                <h1 class="page-title text-2xl font-semibold tracking-tight lg:text-3xl">Dashboard Kasir</h1>
                <p class="mt-1 text-sm text-muted">Kelola transaksi penjualan hari ini.</p>
            </div>
            <a href="{{ route('kasir.penjualan.create') }}" class="btn-primary btn-pop">
                <x-icon name="plus" class="h-4 w-4"/>
                Transaksi Baru
            </a>
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
            <div data-anim style="--anim-delay: 80ms">
                <x-stat-card label="Penjualan Hari Ini" value="Rp{{ number_format($penjualanHariIni, 0, ',', '.') }}"
                    :note="$persenHarian !== null ? ($persenHarian >= 0 ? '+' : '').$persenHarian.'% dari kemarin' : null"
                    noteClass="{{ $persenHarian !== null && $persenHarian >= 0 ? 'text-success' : 'text-danger' }}"/>
            </div>
            <div data-anim style="--anim-delay: 160ms">
                <x-stat-card label="Total Transaksi" value="{{ $totalTransaksi }}" note="hari ini" noteClass="text-muted"/>
            </div>
            <div data-anim style="--anim-delay: 240ms">
                <x-stat-card label="Produk Terjual" value="{{ $produkTerjual }}" note="unit hari ini" noteClass="text-muted"/>
            </div>
        </div>

        <div class="grid gap-4 xl:grid-cols-2">
            <section data-anim style="--anim-delay: 320ms" class="glow-hover liquid-glass relative rounded-xl"><span class="card-glow"></span>
                <header class="border-b border-line px-5 py-4">
                    <h2 class="text-sm font-semibold text-content">Transaksi Terbaru</h2>
                </header>
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[420px] text-left text-sm">
                        <thead>
                            <tr class="border-b border-line-soft text-[11px] uppercase tracking-wide text-subtle">
                                <th class="px-5 py-2.5 font-medium">Invoice</th>
                                <th class="px-4 py-2.5 font-medium">Waktu</th>
                                <th class="px-4 py-2.5 text-right font-medium">Total</th>
                                <th class="px-5 py-2.5 font-medium">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-line-soft">
                            @forelse ($transaksiTerbaru as $trx)
                                <tr class="transition-colors duration-150 hover:bg-surface-hover">
                                    <td class="whitespace-nowrap px-5 py-3 font-medium text-content">{{ $trx->invoice }}</td>
                                    <td class="whitespace-nowrap px-4 py-3 tabular-nums text-muted">{{ $trx->created_at->format('H:i') }}</td>
                                    <td class="whitespace-nowrap px-4 py-3 text-right tabular-nums font-medium text-content">Rp{{ number_format($trx->total, 0, ',', '.') }}</td>
                                    <td class="px-5 py-3"><x-status-badge :status="$trx->status"/></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-5 py-8 text-center text-sm text-muted">Belum ada transaksi hari ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>

            <section data-anim style="--anim-delay: 400ms" class="glow-hover liquid-glass relative rounded-xl"><span class="card-glow"></span>
                <header class="flex items-center justify-between border-b border-line px-5 py-4">
                    <h2 class="text-sm font-semibold text-content">Ringkasan Penjualan Hari Ini</h2>
                    <span class="text-xs text-subtle">per jam</span>
                </header>
                <div class="p-5">
                    <x-chart-bars height="h-36" :data="$perJam"/>
                    <div class="mt-4 flex items-center justify-between border-t border-line-soft pt-4 text-sm">
                        <span class="text-muted">Total hari ini</span>
                        <span class="font-semibold tabular-nums text-content">Rp{{ number_format($penjualanHariIni, 0, ',', '.') }}</span>
                    </div>
                </div>
            </section>
        </div>
    </div>
</x-app-shell>