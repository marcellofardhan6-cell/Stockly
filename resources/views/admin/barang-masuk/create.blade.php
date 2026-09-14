<x-app-shell title="Catat Barang Masuk" page="Barang Masuk" 
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

    <div class="mx-auto max-w-2xl space-y-6">
        <div data-anim>
            <a href="{{ route('admin.barang-masuk.index') }}" class="mb-2 inline-flex items-center gap-1 text-sm text-muted transition-colors hover:text-content">
                <x-icon name="arrow-left" class="h-4 w-4"/> Kembali
            </a>
            <h1 class="page-title text-2xl font-semibold tracking-tight lg:text-3xl">Catat Barang Masuk</h1>
            <p class="mt-1 text-sm text-muted">Stok produk akan otomatis bertambah setelah disimpan.</p>
        </div>

        <form data-anim method="POST" action="{{ route('admin.barang-masuk.store') }}" class="panel p-6">
            @csrf

            <div class="grid gap-4">
                <div>
                    <label class="field-label" for="produk_id">Produk <span class="text-danger">*</span></label>
                    <select id="produk_id" class="field-input @error('produk_id') border-danger @enderror" name="produk_id">
                        <option value="">— Pilih produk —</option>
                        @foreach ($produk as $item)
                            <option value="{{ $item->id }}" data-harga="{{ $item->harga_beli }}" @selected((string) old('produk_id') === (string) $item->id)>
                                {{ $item->nama }} ({{ $item->sku }}) — stok {{ $item->stok }}
                            </option>
                        @endforeach
                    </select>
                    @error('produk_id') <p class="mt-1 text-xs text-danger">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="field-label" for="supplier_id">Supplier</label>
                    <select id="supplier_id" class="field-input @error('supplier_id') border-danger @enderror" name="supplier_id">
                        <option value="">— Tanpa supplier —</option>
                        @foreach ($supplier as $item)
                            <option value="{{ $item->id }}" @selected((string) old('supplier_id') === (string) $item->id)>{{ $item->nama }}</option>
                        @endforeach
                    </select>
                    @error('supplier_id') <p class="mt-1 text-xs text-danger">{{ $message }}</p> @enderror
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="field-label" for="qty">Jumlah (Qty) <span class="text-danger">*</span></label>
                        <input id="qty" class="field-input @error('qty') border-danger @enderror" type="number" name="qty" min="1" value="{{ old('qty', 1) }}">
                        @error('qty') <p class="mt-1 text-xs text-danger">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="field-label" for="harga_beli">Harga Beli / unit <span class="text-danger">*</span></label>
                        <input id="harga_beli" class="field-input @error('harga_beli') border-danger @enderror" type="number" name="harga_beli" min="0" step="1" value="{{ old('harga_beli') }}">
                        @error('harga_beli') <p class="mt-1 text-xs text-danger">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label class="field-label" for="tanggal">Tanggal <span class="text-danger">*</span></label>
                    <input id="tanggal" class="field-input @error('tanggal') border-danger @enderror" type="date" name="tanggal" value="{{ old('tanggal', now()->toDateString()) }}">
                    @error('tanggal') <p class="mt-1 text-xs text-danger">{{ $message }}</p> @enderror
                </div>

                <div class="rounded-md border border-line bg-surface-hover/40 px-4 py-3 text-sm">
                    <div class="flex items-center justify-between">
                        <span class="text-muted">Total nilai barang masuk</span>
                        <span id="total-preview" class="font-semibold tabular-nums text-primary">Rp0</span>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-3 border-t border-line pt-5">
                <a href="{{ route('admin.barang-masuk.index') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">Simpan</button>
            </div>
        </form>
    </div>

    <script>
        (function () {
            const produk = document.getElementById('produk_id');
            const qty = document.getElementById('qty');
            const harga = document.getElementById('harga_beli');
            const total = document.getElementById('total-preview');

            function formatRupiah(n) {
                return 'Rp' + new Intl.NumberFormat('id-ID').format(n);
            }

            function update() {
                const q = parseInt(qty.value, 10) || 0;
                const h = parseInt(harga.value, 10) || 0;
                total.textContent = formatRupiah(q * h);
            }

            produk.addEventListener('change', () => {
                const opt = produk.options[produk.selectedIndex];
                if (opt && opt.dataset.harga && !harga.value) {
                    harga.value = opt.dataset.harga;
                }
                update();
            });

            qty.addEventListener('input', update);
            harga.addEventListener('input', update);
            update();
        })();
    </script>
</x-app-shell>