<x-app-shell title="Pengaturan" page="Pengaturan" 
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
    active="pengaturan">

    <div class="mx-auto max-w-2xl space-y-6">
        <div data-anim style="--anim-delay: 0ms">
            <p class="eyebrow text-sm">Akun Anda</p>
            <h1 class="page-title mt-1 text-2xl font-semibold tracking-tight lg:text-3xl">Pengaturan</h1>
            <p class="mt-1 text-sm text-muted">Kelola profil dan keamanan akun Anda.</p>
        </div>

        @if (session('success'))
            <div data-anim class="rounded-md border border-success-soft border-l-4 border-l-success bg-success-soft px-4 py-3 text-sm text-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Profil --}}
        <form data-anim method="POST" action="{{ route('admin.pengaturan.profil') }}" class="panel p-6">
            @csrf
            @method('PUT')
            <h2 class="text-sm font-semibold text-content">Profil</h2>
            <p class="mt-0.5 text-xs text-subtle">Perbarui nama dan email Anda.</p>

            <div class="mt-5 grid gap-4">
                <div>
                    <label class="field-label" for="name">Nama Lengkap</label>
                    <input id="name" class="field-input @error('name') border-danger @enderror" type="text" name="name" value="{{ old('name', $user['name']) }}">
                    @error('name') <p class="mt-1 text-xs text-danger">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="field-label" for="email">Email</label>
                    <input id="email" class="field-input @error('email') border-danger @enderror" type="email" name="email" value="{{ old('email', $user['email']) }}">
                    @error('email') <p class="mt-1 text-xs text-danger">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="field-label">Role</label>
                    <input class="field-input bg-surface-hover" type="text" value="{{ ucfirst($user['role']) }}" readonly>
                    <p class="mt-1 text-xs text-subtle">Role hanya dapat diubah oleh admin lain.</p>
                </div>
            </div>

            <div class="mt-6 flex justify-end border-t border-line pt-5">
                <button type="submit" class="btn-primary">Simpan Profil</button>
            </div>
        </form>

        {{-- Password --}}
        <form data-anim method="POST" action="{{ route('admin.pengaturan.password') }}" class="panel p-6">
            @csrf
            @method('PUT')
            <h2 class="text-sm font-semibold text-content">Ganti Password</h2>
            <p class="mt-0.5 text-xs text-subtle">Gunakan password yang kuat dan mudah diingat.</p>

            <div class="mt-5 grid gap-4">
                <div>
                    <label class="field-label" for="password_lama">Password Lama</label>
                    <input id="password_lama" class="field-input @error('password_lama') border-danger @enderror" type="password" name="password_lama" autocomplete="current-password">
                    @error('password_lama') <p class="mt-1 text-xs text-danger">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="field-label" for="password">Password Baru</label>
                    <input id="password" class="field-input @error('password') border-danger @enderror" type="password" name="password" autocomplete="new-password" placeholder="Minimal 6 karakter">
                    @error('password') <p class="mt-1 text-xs text-danger">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="field-label" for="password_confirmation">Konfirmasi Password Baru</label>
                    <input id="password_confirmation" class="field-input" type="password" name="password_confirmation" autocomplete="new-password">
                </div>
            </div>

            <div class="mt-6 flex justify-end border-t border-line pt-5">
                <button type="submit" class="btn-primary">Ganti Password</button>
            </div>
        </form>
    </div>
</x-app-shell>