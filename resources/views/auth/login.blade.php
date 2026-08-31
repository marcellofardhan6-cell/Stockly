<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk â€” Stockly</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>document.documentElement.classList.add('anim');</script>
</head>
<body class="grid min-h-screen place-items-center bg-slate-50 px-4 font-sans text-gray-900 antialiased">
    <div class="w-full max-w-md">
        <a href="{{ route('home') }}" class="mb-8 flex items-center justify-center gap-2" data-anim style="--anim-delay: 0ms">
            <span class="flex h-8 w-8 items-center justify-center rounded-md bg-emerald-700">
                <svg class="h-4.5 w-4.5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 8l-9-5-9 5v8l9 5 9-5V8z"/>
                    <path d="M3 8l9 5 9-5"/>
                    <path d="M12 13v8"/>
                </svg>
            </span>
            <span class="text-lg font-semibold tracking-tight">Stockly</span>
        </a>

        <h1 data-anim style="--anim-delay: 80ms" class="text-center text-xl font-semibold tracking-tight">Masuk ke Stockly</h1>
        <p data-anim style="--anim-delay: 140ms" class="mt-1.5 text-center text-sm text-gray-500">
            Aplikasi internal untuk mengelola stok dan penjualan bisnis Anda.
        </p>

        <form data-anim style="--anim-delay: 200ms" method="POST" action="{{ route('login.store') }}" class="mt-8 rounded-lg border border-gray-200 bg-white p-6 shadow-sm sm:p-8">
            @csrf

            @error('email')
                <div class="mb-4 rounded-md border border-red-100 bg-red-50 px-3 py-2.5 text-sm text-red-600">{{ $message }}</div>
            @enderror

            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autocomplete="email"
                placeholder="nama@perusahaan.id"
                class="mt-1.5 w-full rounded-md border border-gray-300 bg-white px-3 py-2.5 text-sm transition duration-200 placeholder:text-gray-400 focus:border-emerald-700 focus:outline-none focus:ring-4 focus:ring-emerald-700/10"
            >

            <label for="password" class="mt-4 block text-sm font-medium text-gray-700">Password</label>
            <input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                placeholder="â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢"
                class="mt-1.5 w-full rounded-md border border-gray-300 bg-white px-3 py-2.5 text-sm transition duration-200 placeholder:text-gray-400 focus:border-emerald-700 focus:outline-none focus:ring-4 focus:ring-emerald-700/10"
            >

            <label class="mt-4 flex items-center gap-2 text-sm text-gray-600" for="remember">
                <input id="remember" type="checkbox" name="remember" class="h-4 w-4 rounded accent-emerald-700">
                Ingat saya
            </label>

            <button type="submit" class="btn-pop mt-6 w-full rounded-md bg-emerald-700 px-4 py-2.5 text-sm font-semibold text-white transition-colors duration-200 hover:bg-emerald-800">
                Masuk
            </button>
        </form>

        <p data-anim style="--anim-delay: 260ms" class="mt-6 border-t border-gray-200 pt-4 text-center text-xs leading-relaxed text-gray-400">
            Akun demo â€” Admin: admin@stockly.id Â· Kasir: kasir@stockly.id<br>Password: password123
        </p>

        <a data-anim style="--anim-delay: 320ms" href="{{ route('home') }}" class="mt-6 flex items-center justify-center gap-1.5 text-sm text-gray-500 transition-colors hover:text-gray-900">
            <x-icon name="arrow-left" class="h-4 w-4"/>
            Kembali ke halaman utama
        </a>
    </div>
</body>
</html>
