<x-app-shell title="Edit User" page="User" 
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
    active="user">

    <div class="mx-auto max-w-2xl space-y-6">
        <div data-anim>
            <a href="{{ route('admin.user.index') }}" class="mb-2 inline-flex items-center gap-1 text-sm text-muted transition-colors hover:text-content">
                <x-icon name="arrow-left" class="h-4 w-4"/> Kembali
            </a>
            <p class="eyebrow text-sm">Tim &amp; akses</p>
            <h1 class="page-title mt-1 text-2xl font-semibold tracking-tight lg:text-3xl">Edit User</h1>
            <p class="mt-1 text-sm text-muted">Perbarui data user <span class="font-medium text-content">"{{ $user->name }}"</span></p>
        </div>

        <form data-anim method="POST" action="{{ route('admin.user.update', $user) }}" class="panel p-6">
            @csrf
            @method('PUT')
            @include('admin.user._form', ['user' => $user])

            <div class="mt-6 flex items-center justify-end gap-3 border-t border-line pt-5">
                <a href="{{ route('admin.user.index') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</x-app-shell>