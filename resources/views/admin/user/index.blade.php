<x-app-shell title="User" page="User" 
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

    <div class="space-y-6">
        <div data-anim style="--anim-delay: 0ms" class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="eyebrow text-sm">Tim &amp; akses</p>
                <h1 class="page-title text-2xl font-semibold tracking-tight lg:text-3xl">User</h1>
                <p class="mt-1 text-sm text-muted">Kelola akun admin dan kasir.</p>
            </div>
            <a href="{{ route('admin.user.create') }}" class="btn-primary btn-pop">
                <x-icon name="plus" class="h-4 w-4"/>
                Tambah User
            </a>
        </div>

        @if (session('success'))
            <div data-anim class="rounded-md border border-success-soft border-l-4 border-l-success bg-success-soft px-4 py-3 text-sm text-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div data-anim class="rounded-md border border-danger-soft border-l-4 border-l-danger bg-danger-soft px-4 py-3 text-sm text-danger">
                {{ session('error') }}
            </div>
        @endif

        <div data-anim class="rounded-lg border border-line bg-surface shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[640px] text-left text-sm">
                    <thead>
                        <tr class="border-b border-line text-[11px] uppercase tracking-wide text-subtle">
                            <th class="px-5 py-2.5 font-medium">Nama</th>
                            <th class="px-4 py-2.5 font-medium">Email</th>
                            <th class="px-4 py-2.5 font-medium">Role</th>
                            <th class="px-4 py-2.5 font-medium">Bergabung</th>
                            <th class="px-5 py-2.5 text-right font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-line-soft">
                        @forelse ($users as $user)
                            <tr class="transition-colors duration-150 hover:bg-surface-hover">
                                <td class="px-5 py-3">
                                    <div class="flex items-center gap-3">
                                        <span class="grid h-8 w-8 shrink-0 place-items-center rounded-full bg-gradient-to-br from-primary to-[#152a86] text-xs font-semibold text-white">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                        <p class="font-medium text-content">{{ $user->name }}</p>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-4 py-3 text-muted">{{ $user->email }}</td>
                                <td class="px-4 py-3">
                                    <span class="rounded-full px-2 py-0.5 text-[11px] font-medium {{ $user->role === 'admin' ? 'bg-primary-soft text-primary' : 'bg-surface-hover text-muted' }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td class="whitespace-nowrap px-4 py-3 text-muted">{{ $user->created_at?->translatedFormat('d M Y') }}</td>
                                <td class="px-5 py-3">
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ route('admin.user.edit', $user) }}" class="btn-pop rounded-md px-2.5 py-1.5 text-xs font-medium text-muted transition-colors hover:bg-surface-hover hover:text-content">Edit</a>
                                        <form method="POST" action="{{ route('admin.user.destroy', $user) }}" onsubmit="return confirm('Hapus user ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-pop rounded-md px-2.5 py-1.5 text-xs font-medium text-danger transition-colors hover:bg-danger-soft">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-5 py-12 text-center text-muted">Belum ada user.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($users->hasPages())
                <div class="border-t border-line px-5 py-3">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-shell>