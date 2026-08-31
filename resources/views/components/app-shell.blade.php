@props([
    'title' => 'Stockly',
    'page' => '',
    'menu' => [],
    'active' => '',
    'user' => [],
    'search' => false,
])

@php
    $nameParts = preg_split('/\s+/', trim($user['name'] ?? ''));
    $initials = strtoupper(substr($nameParts[0] ?? 'S', 0, 1).(isset($nameParts[1]) ? substr($nameParts[1], 0, 1) : ''));
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }} â€” Stockly</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>document.documentElement.classList.add('anim');</script>
</head>
<body class="bg-slate-50 font-sans text-gray-900 antialiased">
    <div class="flex min-h-screen">
        <input id="sidebar-drawer" type="checkbox" class="peer sr-only" tabindex="-1" aria-hidden="true">

        <label for="sidebar-drawer" class="fixed inset-0 z-30 hidden bg-gray-900/50 peer-checked:block lg:hidden"></label>

        <aside class="fixed inset-y-0 left-0 z-40 w-64 -translate-x-full border-r border-gray-200 bg-white transition-transform duration-200 ease-out peer-checked:translate-x-0 lg:static lg:translate-x-0 lg:sticky lg:top-0 lg:h-screen lg:w-64 lg:shrink-0 lg:border-r lg:border-gray-200">
            <div class="flex h-full flex-col">
                <div class="flex h-16 shrink-0 items-center gap-2 border-b border-gray-200 px-5">
                    <span class="flex h-7 w-7 items-center justify-center rounded-md bg-emerald-700">
                        <x-icon name="box" class="h-4 w-4 text-white"/>
                    </span>
                    <span class="text-base font-semibold tracking-tight">Stockly</span>
                </div>

                <nav class="flex-1 space-y-1 overflow-y-auto p-3">
                    @foreach ($menu as $item)
                        <a href="{{ $item['href'] }}" @class([
                            'group flex items-center gap-3 rounded-md px-3 py-2 text-sm transition-colors duration-200',
                            'bg-emerald-50 font-medium text-emerald-700' => $item['key'] === $active,
                            'text-gray-600 hover:bg-gray-100 hover:text-gray-900' => $item['key'] !== $active,
                        ])>
                            <x-icon :name="$item['icon']" class="h-4.5 w-4.5 shrink-0"/>
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </nav>

                <div class="shrink-0 border-t border-gray-100 p-3">
                    <div class="flex items-center gap-3 rounded-md px-2 py-2">
                        <span class="grid h-9 w-9 shrink-0 place-items-center rounded-full bg-emerald-700 text-xs font-semibold text-white">{{ $initials }}</span>
                        <div class="min-w-0 flex-1">
                            <p class="truncate text-sm font-medium leading-tight">{{ $user['name'] }}</p>
                            <p class="mt-0.5 text-xs leading-tight text-gray-400">{{ ucfirst($user['role']) }}</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="mt-1 flex w-full items-center gap-3 rounded-md px-3 py-2 text-sm text-gray-500 transition-colors duration-200 hover:bg-red-50 hover:text-red-600">
                            <x-icon name="logout" class="h-4.5 w-4.5 shrink-0"/>
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <div class="min-w-0 flex-1">
            <header class="sticky top-0 z-20 flex h-16 items-center gap-3 border-b border-gray-200 bg-white px-4 sm:gap-4 sm:px-6">
                <label for="sidebar-drawer" class="btn-pop grid h-9 w-9 cursor-pointer place-items-center rounded-md border border-gray-200 text-gray-600 hover:bg-gray-50 lg:hidden">
                    <x-icon name="menu" class="h-5 w-5"/>
                </label>

                <p class="truncate text-sm font-semibold">{{ $page }}</p>

                <div class="ml-auto flex items-center gap-2 sm:gap-3">
                    @if ($search)
                        <label class="relative hidden md:block">
                            <x-icon name="search" class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400"/>
                            <input type="search" placeholder="Cari produk..." class="w-56 rounded-md border border-gray-300 bg-white py-2 pl-9 pr-3 text-sm transition duration-200 placeholder:text-gray-400 focus:border-emerald-700 focus:outline-none focus:ring-4 focus:ring-emerald-700/10 lg:w-64">
                        </label>
                    @endif

                    <button type="button" class="btn-pop relative grid h-9 w-9 place-items-center rounded-md text-gray-500 transition-colors hover:bg-gray-100 hover:text-gray-900">
                        <x-icon name="bell" class="h-5 w-5"/>
                        <span class="absolute right-2 top-2 h-1.5 w-1.5 rounded-full bg-red-500"></span>
                    </button>

                    <div class="hidden h-6 w-px bg-gray-200 sm:block"></div>

                    <div class="flex items-center gap-2.5">
                        <span class="grid h-8 w-8 place-items-center rounded-full bg-emerald-700 text-xs font-semibold text-white">{{ $initials }}</span>
                        <div class="hidden leading-tight md:block">
                            <p class="text-xs font-medium">{{ $user['name'] }}</p>
                            <p class="mt-0.5 text-[11px] text-gray-400">{{ ucfirst($user['role']) }}</p>
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
