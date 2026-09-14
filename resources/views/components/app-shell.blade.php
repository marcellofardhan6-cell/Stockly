@props([
    'title' => 'Stockly',
    'page' => '',
    'menu' => [],
    'active' => '',
    'user' => null,
    'search' => false,
])

@php
    $user = $user ?? session('auth_user', []);
    $nameParts = preg_split('/\s+/', trim($user['name'] ?? ''));
    $initials = strtoupper(substr($nameParts[0] ?? 'S', 0, 1).(isset($nameParts[1]) ? substr($nameParts[1], 0, 1) : ''));
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }} — Stockly</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>document.documentElement.classList.add('anim');</script>
</head>
<body class="bg-[#000000] font-sans text-content antialiased">
    {{-- Cinematic background glow (matching landing) --}}
    <div class="pointer-events-none fixed inset-0 z-0">
        <div class="absolute -top-48 left-1/2 h-[28rem] w-[48rem] -translate-x-1/2 rounded-full bg-[#3054ff]/[0.09] blur-[120px]"></div>
        <div class="absolute bottom-[-10%] right-[-5%] h-[24rem] w-[24rem] rounded-full bg-indigo-900/[0.16] blur-[120px]"></div>
        <div class="absolute left-[-8%] top-1/3 h-[20rem] w-[20rem] rounded-full bg-blue-900/[0.12] blur-[120px]"></div>
    </div>

    <div class="relative z-10 flex min-h-screen">
        <input id="sidebar-drawer" type="checkbox" class="peer sr-only" tabindex="-1" aria-hidden="true">

        <label for="sidebar-drawer" class="fixed inset-0 z-30 hidden bg-black/60 peer-checked:block lg:hidden"></label>

        <aside class="fixed inset-y-0 left-0 z-40 w-64 -translate-x-full border-r border-line bg-surface transition-transform duration-200 ease-out peer-checked:translate-x-0 lg:translate-x-0 lg:sticky lg:top-0 lg:h-screen lg:w-64 lg:shrink-0 lg:border-r lg:border-line">
            <div class="flex h-full flex-col">
                <div class="flex h-16 shrink-0 items-center gap-2 border-b border-line px-5">
                    <span class="flex h-7 w-7 items-center justify-center rounded-md bg-gradient-to-br from-primary to-[#152a86]">
                        <x-icon name="box" class="h-4 w-4 text-white"/>
                    </span>
                    <span class="text-base font-semibold tracking-tight text-content">Stockly</span>
                </div>

                <nav class="flex-1 space-y-1 overflow-y-auto p-3">
                    @foreach ($menu as $item)
                        <a href="{{ $item['href'] }}" @class([
                            'group flex items-center gap-3 rounded-md px-3 py-2 text-sm transition-colors duration-200',
                            'bg-primary-soft font-medium text-primary' => $item['key'] === $active,
                            'text-muted hover:bg-surface-hover hover:text-content' => $item['key'] !== $active,
                        ])>
                            <x-icon :name="$item['icon']" class="h-4.5 w-4.5 shrink-0"/>
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </nav>

                <div class="shrink-0 border-t border-line-soft p-3">
                    <div class="flex items-center gap-3 rounded-md px-2 py-2">
                        <span class="grid h-9 w-9 shrink-0 place-items-center rounded-full bg-gradient-to-br from-primary to-[#152a86] text-xs font-semibold text-white">{{ $initials }}</span>
                        <div class="min-w-0 flex-1">
                            <p class="truncate text-sm font-medium leading-tight text-content">{{ $user['name'] }}</p>
                            <p class="mt-0.5 text-xs leading-tight text-subtle">{{ ucfirst($user['role']) }}</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="mt-1 flex w-full items-center gap-3 rounded-md px-3 py-2 text-sm text-muted transition-colors duration-200 hover:bg-danger-soft hover:text-danger">
                            <x-icon name="logout" class="h-4.5 w-4.5 shrink-0"/>
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <div class="min-w-0 flex-1">
            <header class="sticky top-0 z-20 flex h-16 items-center gap-3 border-b border-line bg-[#000000]/70 px-4 backdrop-blur-xl sm:gap-4 sm:px-6">
                <label for="sidebar-drawer" class="btn-pop grid h-9 w-9 cursor-pointer place-items-center rounded-md border border-line text-muted hover:bg-surface-hover lg:hidden">
                    <x-icon name="menu" class="h-5 w-5"/>
                </label>

                <p class="truncate text-sm font-semibold text-content">{{ $page }}</p>

                <div class="ml-auto flex items-center gap-2 sm:gap-3">
                    @if ($search)
                        <label class="relative hidden md:block">
                            <x-icon name="search" class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-subtle"/>
                            <input type="search" placeholder="Cari produk..." class="w-56 rounded-md border border-line bg-surface py-2 pl-9 pr-3 text-sm text-content transition duration-200 placeholder:text-subtle focus:border-primary focus:outline-none focus:ring-4 focus:ring-primary/10 lg:w-64">
                        </label>
                    @endif

                    <div class="relative" id="notif-menu-container">
                        <button id="notif-btn" type="button" aria-expanded="false" aria-haspopup="true" title="Notifikasi" class="btn-pop relative grid h-9 w-9 place-items-center rounded-md text-muted transition-colors hover:bg-surface-hover hover:text-content focus:outline-none focus:ring-2 focus:ring-primary/20">
                            <x-icon name="bell" class="h-5 w-5"/>
                            <span id="notif-dot" class="absolute right-2 top-2 h-2 w-2 rounded-full bg-danger ring-2 ring-surface"></span>
                        </button>

                        <div id="notif-panel" class="hidden absolute right-0 mt-2 w-80 sm:w-96 rounded-xl border border-line bg-surface shadow-2xl z-50 origin-top-right transition-all">
                            <div class="flex items-center justify-between border-b border-line-soft px-4 py-3">
                                <div class="flex items-center gap-2">
                                    <span class="text-sm font-semibold text-content">Notifikasi</span>
                                    <span id="notif-badge" class="rounded-full bg-primary-soft px-2 py-0.5 text-xs font-medium text-primary">{{ $notifStok->count() }} baru</span>
                                </div>
                                <button id="notif-mark-read" type="button" class="text-xs font-medium text-primary transition hover:text-primary-hover">
                                    Tandai dibaca
                                </button>
                            </div>

                            <div id="notif-list" class="max-h-[360px] divide-y divide-line-soft overflow-y-auto">
                                @forelse ($notifStok as $item)
                                    @php
                                        $habis = $item->stok <= 0;
                                        $link = ($user['role'] ?? '') === 'admin'
                                            ? route('admin.produk.index', ['status' => $habis ? 'habis' : 'menipis'])
                                            : route('kasir.penjualan.index');
                                    @endphp
                                    <a href="{{ $link }}" class="notif-item group flex items-start gap-3 p-3.5 transition-colors hover:bg-surface-hover {{ $habis ? 'bg-danger-soft/40' : 'bg-amber-500/5' }}">
                                        <span class="mt-0.5 grid h-8 w-8 shrink-0 place-items-center rounded-lg {{ $habis ? 'bg-danger-soft text-danger' : 'bg-warning-soft text-warning' }}">
                                            <x-icon name="box" class="h-4 w-4"/>
                                        </span>
                                        <div class="min-w-0 flex-1">
                                            <p class="text-xs font-semibold text-content">{{ $habis ? 'Stok Habis' : 'Stok Menipis' }}</p>
                                            <p class="mt-0.5 text-xs text-muted line-clamp-2">
                                                {{ $item->nama }} {{ $habis ? 'telah habis dari inventaris.' : "tersisa {$item->stok} unit. Segera lakukan restock." }}
                                            </p>
                                            <span class="mt-1 block text-[11px] text-subtle">{{ $item->updated_at->diffForHumans() }}</span>
                                        </div>
                                        <span class="notif-unread-indicator mt-1 h-2 w-2 shrink-0 rounded-full {{ $habis ? 'bg-danger' : 'bg-warning' }}"></span>
                                    </a>
                                @empty
                                    <div class="flex flex-col items-center gap-2 px-4 py-10 text-center">
                                        <span class="grid h-10 w-10 place-items-center rounded-full bg-success-soft text-success">
                                            <x-icon name="box" class="h-5 w-5"/>
                                        </span>
                                        <p class="text-sm font-medium text-content">Semua stok aman</p>
                                        <p class="text-xs text-muted">Tidak ada produk yang perlu perhatian.</p>
                                    </div>
                                @endforelse
                            </div>

                            <div class="border-t border-line-soft p-2 text-center">
                                <a href="{{ ($user['role'] ?? '') === 'admin' ? route('admin.produk.index', ['status' => 'menipis']) : route('kasir.penjualan.index') }}" class="block w-full rounded-md py-1.5 text-xs font-medium text-primary transition hover:bg-primary-soft">
                                    Lihat Semua Notifikasi
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="hidden h-6 w-px bg-line sm:block"></div>

                    <div class="flex items-center gap-2.5">
                        <span class="grid h-8 w-8 place-items-center rounded-full bg-gradient-to-br from-primary to-[#152a86] text-xs font-semibold text-white">{{ $initials }}</span>
                        <div class="hidden leading-tight md:block">
                            <p class="text-xs font-medium text-content">{{ $user['name'] }}</p>
                            <p class="mt-0.5 text-[11px] text-subtle">{{ ucfirst($user['role']) }}</p>
                        </div>
                    </div>
                </div>
            </header>

            <main class="mx-auto max-w-6xl px-4 py-8 sm:px-6">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>