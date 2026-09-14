<x-app-shell title="Tambah Supplier" page="Supplier" 
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
    active="supplier">

    <div class="mx-auto max-w-xl space-y-6">
        <div data-anim>
            <h1 class="text-xl font-semibold tracking-tight lg:text-2xl">Tambah Supplier</h1>
            <p class="mt-1 text-sm text-muted">Tambahkan pemasok barang baru.</p>
        </div>

        <form data-anim method="POST" action="{{ route('admin.supplier.store') }}" class="panel p-6">
            @csrf
            @include('admin.supplier._form')

            <div class="mt-6 flex items-center justify-end gap-3 border-t border-line pt-5">
                <a href="{{ route('admin.supplier.index') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">Simpan Supplier</button>
            </div>
        </form>
    </div>
</x-app-shell>
