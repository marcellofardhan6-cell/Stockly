@props(['label', 'value', 'note' => null, 'noteClass' => 'text-muted'])

<div {{ $attributes->merge(['class' => 'glow-hover liquid-glass group relative rounded-xl p-5 transition-transform duration-300 hover:-translate-y-0.5']) }}>
    <span class="card-glow"></span>
    <span class="pointer-events-none absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-primary/70 to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100"></span>
    <p class="text-[11px] font-medium uppercase tracking-wide text-subtle">{{ $label }}</p>
    <p class="mt-1.5 bg-gradient-to-br from-white to-[#cdd6ff] bg-clip-text text-2xl font-bold tabular-nums tracking-tight text-transparent">{{ $value }}</p>
    @if ($note)
        <p class="mt-1 text-xs {{ $noteClass }}">{{ $note }}</p>
    @endif
</div>