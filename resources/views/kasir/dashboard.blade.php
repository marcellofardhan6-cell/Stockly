<x-app-shell title="Dashboard Kasir" page="Dashboard" :user="$user"
    :menu="[
        ['key' => 'dashboard', 'label' => 'Dashboard', 'icon' => 'dashboard', 'href' => route('kasir.dashboard')],
        ['key' => 'penjualan', 'label' => 'Penjualan', 'icon' => 'cart', 'href' => '#'],
        ['key' => 'riwayat-penjualan', 'label' => 'Riwayat Penjualan', 'icon' => 'history', 'href' => '#'],
    ]"
    active="dashboard">

    <div class="space-y-6">
        <div data-anim style="--anim-delay: 0ms" class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h1 class="text-xl font-semibold tracking-tight lg:text-2xl">Dashboard Kasir</h1>
                <p class="mt-1 text-sm text-gray-500">Kelola transaksi penjualan hari ini.</p>
            </div>
            <a href="#" class="btn-pop inline-flex items-center justify-center gap-2 rounded-md bg-emerald-700 px-4 py-2.5 text-sm font-semibold text-white transition-colors duration-200 hover:bg-emerald-800">
                <x-icon name="plus" class="h-4 w-4"/>
                Transaksi Baru
            </a>
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
            <div data-anim style="--anim-delay: 80ms">
                <x-stat-card label="Penjualan Hari Ini" value="Rp4.850.000" note="+8,4% dari kemarin" noteClass="text-emerald-700"/>
            </div>
            <div data-anim style="--anim-delay: 160ms">
                <x-stat-card label="Total Transaksi" value="24"/>
            </div>
            <div data-anim style="--anim-delay: 240ms">
                <x-stat-card label="Produk Terjual" value="132"/>
            </div>
        </div>

        <div class="grid gap-4 xl:grid-cols-2">
            <section data-anim style="--anim-delay: 320ms" class="rounded-lg border border-gray-200 bg-white">
                <header class="border-b border-gray-200 px-5 py-4">
                    <h2 class="text-sm font-semibold">Transaksi Terbaru</h2>
                </header>
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[420px] text-left text-sm">
                        <thead>
                            <tr class="border-b border-gray-100 text-[11px] uppercase tracking-wide text-gray-400">
                                <th class="px-5 py-2.5 font-medium">Invoice</th>
                                <th class="px-4 py-2.5 font-medium">Waktu</th>
                                <th class="px-4 py-2.5 text-right font-medium">Total</th>
                                <th class="px-5 py-2.5 font-medium">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach ([
                                ['invoice' => 'INV-240823-001', 'time' => '14:32', 'total' => 'Rp1.250.000', 'status' => 'Lunas'],
                                ['invoice' => 'INV-240823-002', 'time' => '13:05', 'total' => 'Rp860.000', 'status' => 'Lunas'],
                                ['invoice' => 'INV-240823-003', 'time' => '11:47', 'total' => 'Rp320.000', 'status' => 'Lunas'],
                                ['invoice' => 'INV-240823-004', 'time' => '10:15', 'total' => 'Rp540.000', 'status' => 'Pending'],
                                ['invoice' => 'INV-240823-005', 'time' => '09:30', 'total' => 'Rp980.000', 'status' => 'Lunas'],
                            ] as $trx)
                                <tr class="transition-colors duration-150 hover:bg-gray-50">
                                    <td class="whitespace-nowrap px-5 py-3 font-medium">{{ $trx['invoice'] }}</td>
                                    <td class="whitespace-nowrap px-4 py-3 tabular-nums text-gray-500">{{ $trx['time'] }}</td>
                                    <td class="whitespace-nowrap px-4 py-3 text-right tabular-nums font-medium">{{ $trx['total'] }}</td>
                                    <td class="px-5 py-3"><x-status-badge :status="$trx['status']"/></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>

            <section data-anim style="--anim-delay: 400ms" class="rounded-lg border border-gray-200 bg-white">
                <header class="flex items-center justify-between border-b border-gray-200 px-5 py-4">
                    <h2 class="text-sm font-semibold">Ringkasan Penjualan Hari Ini</h2>
                    <span class="text-xs text-gray-400">per jam</span>
                </header>
                <div class="p-5">
                    <x-chart-bars height="h-36" :data="[
                        ['label' => '08:00', 'value' => 300000, 'display' => 'Rp300rb'],
                        ['label' => '09:00', 'value' => 500000, 'display' => 'Rp500rb'],
                        ['label' => '10:00', 'value' => 900000, 'display' => 'Rp900rb'],
                        ['label' => '11:00', 'value' => 700000, 'display' => 'Rp700rb'],
                        ['label' => '12:00', 'value' => 1100000, 'display' => 'Rp1,1jt'],
                        ['label' => '13:00', 'value' => 600000, 'display' => 'Rp600rb'],
                        ['label' => '14:00', 'value' => 450000, 'display' => 'Rp450rb'],
                    ]"/>
                    <div class="mt-4 flex items-center justify-between border-t border-gray-100 pt-4 text-sm">
                        <span class="text-gray-500">Total sampai 14:00</span>
                        <span class="font-semibold tabular-nums">Rp4.850.000</span>
                    </div>
                </div>
            </section>
        </div>
    </div>
</x-app-shell>
