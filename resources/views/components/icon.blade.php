@props(['name'])

<svg {{ $attributes->merge(['class' => 'h-4 w-4']) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
    @switch($name)
        @case('dashboard')
            <rect x="3" y="3" width="7" height="7" rx="1"/>
            <rect x="14" y="3" width="7" height="7" rx="1"/>
            <rect x="14" y="14" width="7" height="7" rx="1"/>
            <rect x="3" y="14" width="7" height="7" rx="1"/>
        @break
        @case('box')
            <path d="M21 8l-9-5-9 5v8l9 5 9-5V8z"/>
            <path d="M3 8l9 5 9-5"/>
            <path d="M12 13v8"/>
        @break
        @case('tag')
            <path d="M12 2H2v10l9.29 9.29a1 1 0 0 0 1.42 0l8.58-8.58a1 1 0 0 0 0-1.42L12 2z"/>
            <circle cx="7" cy="7" r="1"/>
        @break
        @case('truck')
            <path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"/>
            <path d="M15 18H9"/>
            <path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.62l-3.48-4.35A1 1 0 0 0 17.52 8H14"/>
            <circle cx="17" cy="18" r="2"/>
            <circle cx="7" cy="18" r="2"/>
        @break
        @case('import')
            <path d="M12 17V3"/>
            <path d="m6 11 6 6 6-6"/>
            <path d="M19 21H5"/>
        @break
        @case('cart')
            <circle cx="8" cy="21" r="1"/>
            <circle cx="19" cy="21" r="1"/>
            <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/>
        @break
        @case('history')
            <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/>
            <path d="M3 3v5h5"/>
            <path d="M12 7v5l4 2"/>
        @break
        @case('chart')
            <path d="M3 3v18h18"/>
            <path d="M7 15l4-5 3 3 5-7"/>
        @break
        @case('users')
            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
            <circle cx="9" cy="7" r="4"/>
            <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
        @break
        @case('settings')
            <path d="M21 4h-7"/>
            <path d="M10 4H3"/>
            <path d="M21 12h-9"/>
            <path d="M8 12H3"/>
            <path d="M21 20h-5"/>
            <path d="M12 20H3"/>
            <circle cx="14" cy="4" r="2"/>
            <circle cx="8" cy="12" r="2"/>
            <circle cx="16" cy="20" r="2"/>
        @break
        @case('plus')
            <path d="M12 5v14"/>
            <path d="M5 12h14"/>
        @break
        @case('bell')
            <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/>
            <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/>
        @break
        @case('search')
            <circle cx="11" cy="11" r="8"/>
            <path d="m21 21-4.3-4.3"/>
        @break
        @case('logout')
            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
            <path d="m16 17 5-5-5-5"/>
            <path d="M21 12H9"/>
        @break
        @case('menu')
            <path d="M4 6h16"/>
            <path d="M4 12h16"/>
            <path d="M4 18h16"/>
        @break
        @case('chevron-down')
            <path d="m6 9 6 6 6-6"/>
        @break
        @case('arrow-left')
            <path d="M19 12H5"/>
            <path d="m12 19-7-7 7-7"/>
        @break
    @endswitch
</svg>
