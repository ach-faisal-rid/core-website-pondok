@php
    $icon = $icon ?? 'heart';
@endphp

@if ($icon === 'leaf')
    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M5 19c8 0 12-6 12-14-6 0-12 4-12 14Z" />
        <path stroke-linecap="round" stroke-linejoin="round" d="M5 19c2-4 6-7 12-8" />
    </svg>
@elseif ($icon === 'hand')
    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M8 11V7a1.5 1.5 0 0 1 3 0v4M11 11V6a1.5 1.5 0 0 1 3 0v5M14 11V7.5a1.5 1.5 0 0 1 3 0V14a5 5 0 0 1-5 5H10a4 4 0 0 1-4-4v-2.5A1.5 1.5 0 0 1 8 11Z" />
    </svg>
@elseif ($icon === 'users')
    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M16 19v-1a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v1" />
        <circle cx="9.5" cy="8" r="3" />
        <path stroke-linecap="round" stroke-linejoin="round" d="M20 19v-1a3.5 3.5 0 0 0-2.5-3.35M15.5 5.2a3 3 0 0 1 0 5.6" />
    </svg>
@elseif ($icon === 'wind')
    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8h10a3 3 0 1 0-3-3M3 12h14a3 3 0 1 1-3 3M3 16h8a3 3 0 1 1-3 3" />
    </svg>
@else
    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 20s-7-4.5-7-10a4 4 0 0 1 7-2.5A4 4 0 0 1 19 10c0 5.5-7 10-7 10Z" />
    </svg>
@endif
