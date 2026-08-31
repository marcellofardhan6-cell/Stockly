@props(['label', 'value', 'note' => null, 'noteClass' => 'text-gray-500'])

<div {{ $attributes->merge(['class' => 'rounded-lg border border-gray-200 bg-white p-5']) }}>
    <p class="text-[11px] font-medium uppercase tracking-wide text-gray-400">{{ $label }}</p>
    <p class="mt-1.5 text-2xl font-semibold tabular-nums tracking-tight">{{ $value }}</p>
    @if ($note)
        <p class="mt-1 text-xs {{ $noteClass }}">{{ $note }}</p>
    @endif
</div>
