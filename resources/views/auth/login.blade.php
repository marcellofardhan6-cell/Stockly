<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk — Stockly</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/landing.css', 'resources/js/landing.js'])
    <style>html, body { overflow-x: clip; }</style>
</head>
<body class="landing-base bg-black font-sans text-white antialiased">

    <main class="relative flex min-h-screen w-full flex-col items-center justify-center overflow-x-hidden px-4 selection:bg-white/20 selection:text-white">

        {{-- Decorative gradients --}}
        <div class="pointer-events-none absolute left-[15%] top-[-15%] h-[500px] w-[500px] rounded-full bg-blue-900/20 blur-[120px] mix-blend-screen"></div>
        <div class="pointer-events-none absolute bottom-[-15%] right-[15%] h-[450px] w-[450px] rounded-full bg-indigo-900/20 blur-[120px] mix-blend-screen"></div>

        {{-- Back button (top-left) --}}
        <a href="{{ route('home') }}" class="anim-fade fixed left-6 top-6 z-20 flex h-12 w-12 items-center justify-center rounded-full bg-white/5 text-white backdrop-blur-md transition-colors hover:bg-white/10 md:left-8 md:top-8" style="animation-delay:0.2s" aria-label="Kembali">
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><path d="m12 19-7-7 7-7"/></svg>
        </a>

        {{-- Login card --}}
        <div class="relative z-10 w-full max-w-md">

            <div class="anim-rise mb-8 flex flex-col items-center" style="animation-delay:0.25s; animation-duration:1.1s;">
                <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white shadow-lg shadow-white/20">
                    <svg class="h-7 w-7 text-black" viewBox="0 0 256 256" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M 4.688 136 C 68.373 136 120 187.627 120 251.312 C 120 252.883 119.967 254.445 119.905 256 L 0 256 L 0 136.096 C 1.555 136.034 3.117 136 4.688 136 Z M 251.312 136 C 252.883 136 254.445 136.034 256 136.096 L 256 256 L 136.095 256 C 136.032 254.438 136.001 252.875 136 251.312 C 136 187.627 187.627 136 251.312 136 Z M 119.905 0 C 119.967 1.555 120 3.117 120 4.688 C 120 68.373 68.373 120 4.687 120 C 3.117 120 1.555 119.967 0 119.905 L 0 0 Z M 256 119.905 C 254.445 119.967 252.883 120 251.312 120 C 187.627 120 136 68.373 136 4.687 C 136 3.117 136.033 1.555 136.095 0 L 256 0 Z" /></svg>
                </span>
                <h1 class="mt-5 bg-gradient-to-b from-white to-[#b4c0ff] bg-clip-text pb-1 text-center text-2xl font-semibold tracking-tight text-transparent md:text-3xl">Masuk ke Stockly</h1>
                <p class="mt-2 text-center text-sm text-white/60">Aplikasi internal untuk mengelola stok dan penjualan bisnis Anda.</p>
            </div>

            <form method="POST" action="{{ route('login.store') }}" class="anim-pop liquid-glass rounded-3xl p-6 md:p-8" style="animation-delay:0.5s; animation-duration:1.1s;">
                @csrf

                @error('email')
                    <div class="mb-4 rounded-xl border border-red-400/30 bg-red-500/10 px-3 py-2.5 text-sm text-red-300">{{ $message }}</div>
                @enderror

                <label for="email" class="block text-sm font-medium text-white/85">Email</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autocomplete="email"
                    placeholder="nama@perusahaan.id"
                    class="mt-2 w-full rounded-xl border border-white/10 bg-white/[0.05] px-4 py-3 text-sm text-white transition duration-200 placeholder:text-white/40 focus:border-[#3054ff]/60 focus:outline-none focus:ring-4 focus:ring-[#3054ff]/15"
                >

                <label for="password" class="mt-5 block text-sm font-medium text-white/85">Password</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="••••••••"
                    class="mt-2 w-full rounded-xl border border-white/10 bg-white/[0.05] px-4 py-3 text-sm text-white transition duration-200 placeholder:text-white/40 focus:border-[#3054ff]/60 focus:outline-none focus:ring-4 focus:ring-[#3054ff]/15"
                >

                <label class="mt-4 flex items-center gap-2 text-sm text-white/65" for="remember">
                    <input id="remember" type="checkbox" name="remember" class="h-4 w-4 rounded accent-[#3054ff]">
                    Ingat saya
                </label>

                <button type="submit" class="magnetic cta-glow mt-6 w-full rounded-full bg-white px-4 py-3.5 text-sm font-semibold text-black">
                    Masuk
                </button>
            </form>

            <p class="anim-fade mt-6 text-center text-xs leading-relaxed text-white/45" style="animation-delay:0.7s">
                Akun demo — Admin: admin@stockly.id · Kasir: kasir@stockly.id<br>Password: password123
            </p>
        </div>

    </main>

</body>
</html>