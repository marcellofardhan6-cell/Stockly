@props(['status'])

@php
    $map = [
        'lunas' => ['bg-success-soft', 'text-success', 'bg-success'],
        'tersedia' => ['bg-success-soft', 'text-success', 'bg-success'],
        'pending' => ['bg-warning-soft', 'text-warning', 'bg-warning'],
        'menipis' => ['bg-warning-soft', 'text-warning', 'bg-warning'],
        'habis' => ['bg-danger-soft', 'text-danger', 'bg-danger'],
        'batal' => ['bg-danger-soft', 'text-danger', 'bg-danger'],
    ];
    $colors = $map[strtolower($status)] ?? ['bg-surface-hover', 'text-muted', 'bg-subtle'];
@endphp

<span class="inline-flex items-center gap-1.5 whitespace-nowrap rounded-full px-2 py-0.5 text-[11px] font-medium {{ $colors[0] }} {{ $colors[1] }}">
    <span class="h-1.5 w-1.5 rounded-full {{ $colors[2] }}"></span>{{ ucfirst($status) }}
</span>