@props(['data', 'height' => 'h-44'])

@php
    $max = max(1, (int) collect($data)->max('value'));
@endphp

<div>
    <div {{ $attributes->merge(['class' => $height.' flex items-end gap-2 sm:gap-3']) }}>
        @foreach ($data as $item)
            <div class="group flex h-full min-w-0 flex-1 flex-col items-center justify-end gap-1.5">
                <span class="text-[10px] font-medium tabular-nums text-muted opacity-0 transition-opacity duration-200 group-hover:opacity-100">{{ $item['display'] }}</span>
                <div title="{{ $item['display'] }}" class="w-full rounded-t-md bg-gradient-to-t from-primary/30 to-primary transition-opacity duration-200 group-hover:opacity-90" style="height: {{ max(4, round($item['value'] / $max * 100)) }}%"></div>
            </div>
        @endforeach
    </div>
    <div class="mt-2 flex gap-2 sm:gap-3">
        @foreach ($data as $item)
            <span class="min-w-0 flex-1 truncate text-center text-[11px] text-muted">{{ $item['label'] }}</span>
        @endforeach
    </div>
</div>