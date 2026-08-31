<x-app-shell title="Dashboard" page="Dashboard" :user="$user" search
    :menu="[
        ['key' => 'dashboard', 'label' => 'Dashboard', 'icon' => 'dashboard', 'href' => route('admin.dashboard')],
        ['key' => 'produk', 'label' => 'Produk', 'icon' => 'box', 'href' => '#'],
        ['key' => 'kategori', 'label' => 'Kategori', 'icon' => 'tag', 'href' => '#'],
        ['key' => 'supplier', 'label' => 'Supplier', 'icon' => 'truck', 'href' => '#'],
        ['key' => 'barang-masuk', 'label' => 'Barang Masuk', 'icon' => 'import', 'href' => '#'],
        ['key' => 'penjualan', 'label' => 'Penjualan', 'icon' => 'cart', 'href' => '#'],
        ['key' => 'laporan', 'label' => 'Laporan', 'icon' => 'chart', 'href' => '#'],
        ['key' => 'user', 'label' => 'User', 'icon' => 'users', 'href' => '#'],
        ['key' => 'pengaturan', 'label' => 'Pengaturan', 'icon' => 'settings', 'href' => '#'],
    ]"
    active="dashboard">

    <div class="space-y-6">
        <div data-anim style="--anim-delay: 0ms">
            <h1 class="text-xl font-semibold tracking-tight lg:text-2xl">Dashboard</h1>
            <p class="mt-1 text-sm text-gray-500">Ringkasan aktivitas bisnis hari ini.</p>
        </div>

        <div class="grid grid-cols-2 gap-4 xl:grid-cols-4">
            <div data-anim style="--anim-delay: 60ms">
                <x-stat-card label="Total Produk" value="1.284" note="+32 minggu ini" noteClass="text-emerald-700"/>
            </div>
            <div data-anim style="--anim-delay: 140ms">
                <x-stat-card label="Total Stok" value="8.420"/>
            </div>
            <div data-anim style="--anim-delay: 220ms">
                <x-stat-card label="Penjualan Hari Ini" value="Rp12.480.000" note="+4,2% dari kemarin" noteClass="text-emerald-700"/>
            </div>
            <div data-anim style="--anim-delay: 300ms">
                <x-stat-card label="Stok Menipis" value="23" note="perlu restock" noteClass="text-amber-600"/>
            </div>
        </div>

        <div class="grid gap-4 xl:grid-cols-3">
            <section data-anim style="--anim-delay: 380ms" class="rounded-lg border border-gray-200 bg-white xl:col-span-2">
                <header class="flex items-center justify-between border-b border-gray-200 px-5 py-4">
                    <h2 class="text-sm font-semibold">Grafik Penjualan</h2>
                    <span class="text-xs text-gray-400">7 hari terakhir</span>
                </header>
                <div class="p-5">
                    <x-chart-bars :data="[
                        ['label' => 'Sen', 'value' => 4100000, 'display' => 'Rp4,1jt'],
                        ['label' => 'Sel', 'value' => 5300000, 'display' => 'Rp5,3jt'],
                        ['label' => 'Rab', 'value' => 3800000, 'display' => 'Rp3,8jt'],
                        ['label' => 'Kam', 'value' => 6200000, 'display' => 'Rp6,2jt'],
                        ['label' => 'Jum', 'value' => 7400000, 'display' => 'Rp7,4jt'],
                        ['label' => 'Sab', 'value' => 9800000, 'display' => 'Rp9,8jt'],
                        ['label' => 'Min', 'value' => 12480000, 'display' => 'Rp12,4jt'],
                    ]"/>
                </div>
            </section>

            <section data-anim style="--anim-delay: 460ms" class="rounded-lg border border-gray-200 bg-white">
                <header class="flex items-center justify-between border-b border-gray-200 px-5 py-4">
                    <h2 class="text-sm font-semibold">Produk Stok Menipis</h2>
                    <a href="#" class="text-xs font-medium text-emerald-700 transition-colors hover:text-emerald-800">Lihat semua</a>
                </header>
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[420px] text-left text-sm">
                        <thead>
                            <tr class="border-b border-gray-100 text-[11px] uppercase tracking-wide text-gray-400">
                                <th class="px-5 py-2.5 font-medium">Produk</th>
                                <th class="px-4 py-2.5 font-medium">SKU</th>
                                <th class="px-4 py-2.5 text-right font-medium">Stok</th>
                                <th class="px-5 py-2.5 font-medium">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach ([
                                ['name' => 'Teko Pour Over 1,2L', 'sku' => 'SKU-1123', 'stock' => 8, 'status' => 'Menipis'],
                                ['name' => 'Botol Cold Brew 750ml', 'sku' => 'SKU-1198', 'stock' => 0, 'status' => 'Habis'],
                                ['name' => 'French Press 600ml', 'sku' => 'SKU-1156', 'stock' => 5, 'status' => 'Menipis'],
                                ['name' => 'Filter Paper V60', 'sku' => 'SKU-1211', 'stock' => 12, 'status' => 'Menipis'],
                            ] as $item)
                                <tr class="transition-colors duration-150 hover:bg-gray-50">
                                    <td class="max-w-[180px] px-5 py-3">
                                        <p class="truncate font-medium">{{ $item['name'] }}</p>
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-3 text-xs text-gray-500">{{ $item['sku'] }}</td>
                                    <td class="px-4 py-3 text-right tabular-nums">{{ $item['stock'] }}</td>
                                    <td class="px-5 py-3"><x-status-badge :status="$item['status']"/></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </div>

        <section data-anim style="--anim-delay: 540ms" class="rounded-lg border border-gray-200 bg-white">
            <header class="flex items-center justify-between border-b border-gray-200 px-5 py-4">
                <h2 class="text-sm font-semibold">Transaksi Terbaru</h2>
                <a href="#" class="text-xs font-medium text-emerald-700 transition-colors hover:text-emerald-800">Lihat semua</a>
            </header>
            <div class="overflow-x-auto">
                <table class="w-full min-w-[560px] text-left text-sm">
                    <thead>
                        <tr class="border-b border-gray-100 text-[11px] uppercase tracking-wide text-gray-400">
                            <th class="px-5 py-2.5 font-medium">Invoice</th>
                            <th class="px-4 py-2.5 font-medium">Kasir</th>
                            <th class="px-4 py-2.5 font-medium">Tanggal</th>
                            <th class="px-4 py-2.5 text-right font-medium">Total</th>
                            <th class="px-5 py-2.5 font-medium">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach ([
                            ['invoice' => 'INV-240823-001', 'cashier' => 'Rina Amelia', 'date' => '23 Agu 2026 Â· 14:32', 'total' => 'Rp1.250.000', 'status' => 'Lunas'],
                            ['invoice' => 'INV-240823-002', 'cashier' => 'Dewi Lestari', 'date' => '23 Agu 2026 Â· 13:05', 'total' => 'Rp860.000', 'status' => 'Lunas'],
                            ['invoice' => 'INV-240822-014', 'cashier' => 'Rina Amelia', 'date' => '22 Agu 2026 Â· 16:48', 'total' => 'Rp2.340.000', 'status' => 'Lunas'],
                            ['invoice' => 'INV-240822-013', 'cashier' => 'Andi Pratama', 'date' => '22 Agu 2026 Â· 11:20', 'total' => 'Rp450.000', 'status' => 'Pending'],
                            ['invoice' => 'INV-240821-009', 'cashier' => 'Dewi Lestari', 'date' => '21 Agu 2026 Â· 15:12', 'total' => 'Rp1.780.000', 'status' => 'Lunas'],
                        ] as $trx)
                            <tr class="transition-colors duration-150 hover:bg-gray-50">
                                <td class="whitespace-nowrap px-5 py-3 font-medium">{{ $trx['invoice'] }}</td>
                                <td class="whitespace-nowrap px-4 py-3 text-gray-600">{{ $trx['cashier'] }}</td>
                                <td class="whitespace-nowrap px-4 py-3 text-gray-500">{{ $trx['date'] }}</td>
                                <td class="whitespace-nowrap px-4 py-3 text-right tabular-nums font-medium">{{ $trx['total'] }}</td>
                                <td class="px-5 py-3"><x-status-badge :status="$trx['status']"/></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</x-app-shell>
