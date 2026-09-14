<x-app-shell title="Transaksi Baru" page="Penjualan" :user="$user"
    :menu="[
        ['key' => 'dashboard', 'label' => 'Dashboard', 'icon' => 'dashboard', 'href' => route('kasir.dashboard')],
        ['key' => 'penjualan', 'label' => 'Penjualan', 'icon' => 'cart', 'href' => route('kasir.penjualan.index')],
    ]"
    active="penjualan">

    <div class="space-y-6">
        <div data-anim style="--anim-delay: 0ms" class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <a href="{{ route('kasir.penjualan.index') }}" class="mb-2 inline-flex items-center gap-1 text-sm text-muted transition-colors hover:text-content">
                    <x-icon name="arrow-left" class="h-4 w-4"/> Kembali
                </a>
                <h1 class="page-title text-2xl font-semibold tracking-tight lg:text-3xl">Transaksi Baru</h1>
                <p class="mt-1 text-sm text-muted">Pilih produk dan tentukan jumlah untuk membuat penjualan.</p>
            </div>
        </div>

        @if (session('error'))
            <div data-anim class="rounded-md border border-danger-soft border-l-4 border-l-danger bg-danger-soft px-4 py-3 text-sm text-danger">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('kasir.penjualan.store') }}" id="pos-form" class="grid gap-6 lg:grid-cols-3">
            @csrf

            {{-- Daftar produk --}}
            <div data-anim style="--anim-delay: 80ms" class="lg:col-span-2">
                <div class="rounded-lg border border-line bg-surface">
                    <div class="border-b border-line px-5 py-4">
                        <h2 class="text-sm font-semibold text-content">Pilih Produk</h2>
                        <p class="mt-0.5 text-xs text-subtle">Klik produk untuk menambahkan ke keranjang.</p>
                    </div>
                    <div class="max-h-[560px] overflow-y-auto p-4">
                        <div class="grid gap-3 sm:grid-cols-2 xl:grid-cols-3">
                            @forelse ($produk as $item)
                                <button type="button"
                                    class="pos-product group rounded-lg border border-line bg-surface-hover/40 p-3 text-left transition-all hover:border-primary/50 hover:bg-primary-soft/30"
                                    data-id="{{ $item->id }}"
                                    data-nama="{{ $item->nama }}"
                                    data-harga="{{ $item->harga_jual }}"
                                    data-stok="{{ $item->stok }}"
                                    data-sku="{{ $item->sku }}">
                                    <p class="truncate text-sm font-medium text-content">{{ $item->nama }}</p>
                                    <p class="mt-0.5 text-[11px] text-subtle">{{ $item->sku }}</p>
                                    <div class="mt-2 flex items-center justify-between">
                                        <span class="text-sm font-semibold text-primary">Rp{{ number_format($item->harga_jual, 0, ',', '.') }}</span>
                                        <span class="text-[11px] {{ $item->stok <= $item->stok_minimal ? 'text-warning' : 'text-muted' }}">Stok {{ $item->stok }}</span>
                                    </div>
                                </button>
                            @empty
                                <p class="col-span-full px-2 py-8 text-center text-sm text-muted">Tidak ada produk dengan stok tersedia.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            {{-- Keranjang --}}
            <div data-anim style="--anim-delay: 160ms">
                <div class="rounded-lg border border-line bg-surface lg:sticky lg:top-24">
                    <div class="border-b border-line px-5 py-4">
                        <h2 class="text-sm font-semibold text-content">Keranjang</h2>
                    </div>
                    <div id="cart-items" class="max-h-[320px] divide-y divide-line-soft overflow-y-auto px-5">
                        <p id="cart-empty" class="py-8 text-center text-sm text-muted">Keranjang masih kosong.</p>
                    </div>
                    <div class="border-t border-line px-5 py-4">
                        <div class="space-y-2 text-sm">
                            <div class="flex items-center justify-between">
                                <span class="text-muted">Subtotal</span>
                                <span id="cart-subtotal" class="tabular-nums text-content">Rp0</span>
                            </div>
                            <div class="flex items-center justify-between gap-3">
                                <span class="text-muted">Diskon (Rp)</span>
                                <input id="diskon" name="diskon" type="number" min="0" value="0"
                                    class="w-28 rounded-md border border-line bg-surface px-2 py-1 text-right text-sm tabular-nums text-content focus:border-primary focus:outline-none">
                            </div>
                            <div class="flex items-center justify-between border-t border-line-soft pt-2">
                                <span class="font-medium text-content">Total</span>
                                <span id="cart-total" class="text-lg font-bold tabular-nums text-primary">Rp0</span>
                            </div>
                        </div>

                        <div class="mt-4 space-y-3 border-t border-line-soft pt-4">
                            <div>
                                <label class="mb-1.5 block text-xs font-medium text-muted">Metode Bayar</label>
                                <div class="grid grid-cols-3 gap-2">
                                    @foreach(['tunai' => 'Tunai', 'transfer' => 'Transfer', 'qris' => 'QRIS'] as $val => $label)
                                        <label class="pay-method cursor-pointer rounded-md border border-line px-2 py-2 text-center text-xs font-medium text-muted transition-colors has-[:checked]:border-primary has-[:checked]:bg-primary-soft has-[:checked]:text-primary">
                                            <input type="radio" name="metode_bayar" value="{{ $val }}" class="sr-only" @checked($loop->first)>
                                            {{ $label }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                            <div id="uang-diterima-wrap">
                                <label class="mb-1.5 block text-xs font-medium text-muted" for="uang_diterima">Uang Diterima (Rp)</label>
                                <input id="uang_diterima" name="uang_diterima" type="number" min="0" value="0"
                                    class="w-full rounded-md border border-line bg-surface px-3 py-2 text-sm tabular-nums text-content focus:border-primary focus:outline-none">
                            </div>
                            <div class="flex items-center justify-between rounded-md bg-surface-hover/50 px-3 py-2 text-sm">
                                <span class="text-muted">Kembalian</span>
                                <span id="kembalian" class="font-semibold tabular-nums text-success">Rp0</span>
                            </div>
                        </div>

                        <button type="submit" id="cart-submit" disabled
                            class="btn-primary btn-pop mt-4 w-full disabled:cursor-not-allowed disabled:opacity-40">
                            <x-icon name="cart" class="h-4 w-4"/>
                            Simpan Transaksi
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        (function () {
            const cart = new Map();
            const cartItemsEl = document.getElementById('cart-items');
            const cartEmptyEl = document.getElementById('cart-empty');
            const cartTotalEl = document.getElementById('cart-total');
            const cartSubtotalEl = document.getElementById('cart-subtotal');
            const diskonEl = document.getElementById('diskon');
            const uangDiterimaEl = document.getElementById('uang_diterima');
            const kembalianEl = document.getElementById('kembalian');
            const uangWrap = document.getElementById('uang-diterima-wrap');
            const submitBtn = document.getElementById('cart-submit');
            const form = document.getElementById('pos-form');

            let cartSubtotal = 0;

            function formatRupiah(n) {
                return 'Rp' + new Intl.NumberFormat('id-ID').format(n);
            }

            function metodeBayar() {
                const r = form.querySelector('input[name="metode_bayar"]:checked');
                return r ? r.value : 'tunai';
            }

            function hitungPembayaran() {
                const diskon = Math.max(0, parseInt(diskonEl.value, 10) || 0);
                const total = Math.max(0, cartSubtotal - diskon);
                const metode = metodeBayar();

                cartSubtotalEl.textContent = formatRupiah(cartSubtotal);
                cartTotalEl.textContent = formatRupiah(total);

                // Tunai tampilkan uang diterima & kembalian; non-tunai sembunyikan
                uangWrap.style.display = metode === 'tunai' ? '' : 'none';

                if (metode === 'tunai') {
                    const diterima = Math.max(0, parseInt(uangDiterimaEl.value, 10) || 0);
                    const kembali = diterima - total;
                    kembalianEl.textContent = formatRupiah(Math.max(0, kembali));
                    kembalianEl.className = 'font-semibold tabular-nums ' + (kembali < 0 ? 'text-danger' : 'text-success');
                } else {
                    kembalianEl.textContent = formatRupiah(0);
                    kembalianEl.className = 'font-semibold tabular-nums text-success';
                }

                // Validasi submit
                let valid = cart.size > 0;
                if (valid && metode === 'tunai') {
                    const diterima = Math.max(0, parseInt(uangDiterimaEl.value, 10) || 0);
                    valid = diterima >= total;
                }
                submitBtn.disabled = !valid;
            }

            function render() {
                // Hapus semua item kecuali placeholder kosong
                cartItemsEl.querySelectorAll('[data-cart-row]').forEach(el => el.remove());
                form.querySelectorAll('input[data-cart-input]').forEach(el => el.remove());

                let total = 0;
                let idx = 0;

                cart.forEach((item, id) => {
                    total += item.harga * item.qty;

                    const row = document.createElement('div');
                    row.setAttribute('data-cart-row', '');
                    row.className = 'flex items-center gap-3 py-3';
                    row.innerHTML = `
                        <div class="min-w-0 flex-1">
                            <p class="truncate text-sm font-medium text-content">${item.nama}</p>
                            <p class="text-[11px] text-subtle">${formatRupiah(item.harga)} · stok ${item.stok}</p>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <button type="button" data-act="dec" class="grid h-6 w-6 place-items-center rounded border border-line text-muted hover:bg-surface-hover hover:text-content">−</button>
                            <span class="w-7 text-center text-sm font-medium tabular-nums text-content">${item.qty}</span>
                            <button type="button" data-act="inc" class="grid h-6 w-6 place-items-center rounded border border-line text-muted hover:bg-surface-hover hover:text-content">+</button>
                        </div>
                        <span class="w-20 text-right text-sm font-semibold tabular-nums text-content">${formatRupiah(item.harga * item.qty)}</span>
                        <button type="button" data-act="del" class="grid h-6 w-6 place-items-center rounded text-danger hover:bg-danger-soft">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
                        </button>
                    `;

                    row.querySelector('[data-act="inc"]').addEventListener('click', () => {
                        if (item.qty < item.stok) { item.qty++; render(); }
                    });
                    row.querySelector('[data-act="dec"]').addEventListener('click', () => {
                        if (item.qty > 1) { item.qty--; render(); }
                    });
                    row.querySelector('[data-act="del"]').addEventListener('click', () => {
                        cart.delete(id); render();
                    });

                    cartItemsEl.appendChild(row);

                    // Hidden inputs untuk submit
                    const inId = document.createElement('input');
                    inId.type = 'hidden'; inId.name = `items[${idx}][produk_id]`; inId.value = id;
                    inId.setAttribute('data-cart-input', '');
                    const inQty = document.createElement('input');
                    inQty.type = 'hidden'; inQty.name = `items[${idx}][qty]`; inQty.value = item.qty;
                    inQty.setAttribute('data-cart-input', '');
                    form.appendChild(inId); form.appendChild(inQty);

                    idx++;
                });

                cartEmptyEl.style.display = cart.size === 0 ? '' : 'none';
                cartSubtotal = total;
                hitungPembayaran();
            }

            // Event pembayaran
            diskonEl.addEventListener('input', hitungPembayaran);
            uangDiterimaEl.addEventListener('input', hitungPembayaran);
            form.querySelectorAll('input[name="metode_bayar"]').forEach(r => {
                r.addEventListener('change', hitungPembayaran);
            });

            document.querySelectorAll('.pos-product').forEach(btn => {
                btn.addEventListener('click', () => {
                    const id = btn.dataset.id;
                    const stok = parseInt(btn.dataset.stok, 10);
                    if (cart.has(id)) {
                        const item = cart.get(id);
                        if (item.qty < stok) item.qty++;
                    } else {
                        cart.set(id, {
                            nama: btn.dataset.nama,
                            harga: parseInt(btn.dataset.harga, 10),
                            stok: stok,
                            qty: 1,
                        });
                    }
                    render();
                });
            });

            render();
        })();
    </script>
</x-app-shell>