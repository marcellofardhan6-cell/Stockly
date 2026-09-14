<x-app-shell title="Tambah Produk" page="Produk" 
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

    <div class="mx-auto max-w-2xl space-y-6">
        <div data-anim>
            <h1 class="text-xl font-semibold tracking-tight lg:text-2xl">Tambah Produk</h1>
            <p class="mt-1 text-sm text-muted">Lengkapi data produk baru.</p>
        </div>

        <form data-anim method="POST" action="{{ route('admin.produk.store') }}" class="panel p-6">
            @csrf
            @include('admin.produk._form', ['kategori' => $kategori, 'skuPreview' => $skuPreview, 'generateSku' => true])

            <div class="mt-6 flex items-center justify-end gap-3 border-t border-line pt-5">
                <a href="{{ route('admin.produk.index') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">Simpan Produk</button>
            </div>
        </form>
    </div>
</x-app-shell>
