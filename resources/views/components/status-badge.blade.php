@props(['status'])

@php
    $map = [
        'lunas' => ['bg-emerald-50', 'text-emerald-700', 'bg-emerald-500'],
        'tersedia' => ['bg-emerald-50', 'text-emerald-700', 'bg-emerald-500'],
        'pending' => ['bg-amber-50', 'text-amber-600', 'bg-amber-500'],
        'menipis' => ['bg-amber-50', 'text-amber-600', 'bg-amber-500'],
        'habis' => ['bg-red-50', 'text-red-600', 'bg-red-500'],
        'batal' => ['bg-red-50', 'text-red-600', 'bg-red-500'],
    ];
    $colors = $map[strtolower($status)] ?? ['bg-gray-100', 'text-gray-600', 'bg-gray-400'];
@endphp

<span class="inline-flex items-center gap-1.5 whitespace-nowrap rounded-full px-2 py-0.5 text-[11px] font-medium {{ $colors[0] }} {{ $colors[1] }}">
    <span class="h-1.5 w-1.5 rounded-full {{ $colors[2] }}"></span>{{ ucfirst($status) }}
</span>
