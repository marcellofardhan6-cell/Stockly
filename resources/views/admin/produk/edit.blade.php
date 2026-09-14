<x-app-shell title="Edit Produk" page="Produk" 
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
            <h1 class="text-xl font-semibold tracking-tight lg:text-2xl">Edit Produk</h1>
            <p class="mt-1 text-sm text-muted">Perbarui data produk <span class="font-medium text-content">"{{ $produk->nama }}"</span></p>
        </div>

        <form data-anim method="POST" action="{{ route('admin.produk.update', $produk) }}" class="panel p-6">
            @csrf
            @method('PUT')
            @include('admin.produk._form', ['produk' => $produk, 'kategori' => $kategori, 'generateSku' => false])

            <div class="mt-6 flex items-center justify-end gap-3 border-t border-line pt-5">
                <a href="{{ route('admin.produk.show', $produk) }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</x-app-shell>
