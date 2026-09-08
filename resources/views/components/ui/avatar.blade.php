{{-- Komponen Avatar dengan Status, Fallback, Badge --}}
@props([
    'src' => null,
    'initials' => null,
    'name' => null,
    'size' => 'md',          // sm, md, lg, xl
    'color' => 'blue',       // blue, red, green, purple, gray
    'status' => null,        // null, online, offline, away, busy
    'statusPosition' => 'bottom-right',
    'badge' => null,         // Notification count (null = no badge)
    'badgeColor' => 'red',
    'square' => false,       // Square avatar (for companies)
    'bordered' => false,     // White border ring
])

@php
    $sizes = [
        'xs' => 'w-6 h-6 text-[10px]',
        'sm' => 'w-8 h-8 text-xs',
        'md' => 'w-10 h-10 text-sm',
        'lg' => 'w-14 h-14 text-lg',
        'xl' => 'w-20 h-20 text-2xl',
    ];
    $statusSizes = [
        'xs' => 'w-2 h-2',
        'sm' => 'w-2.5 h-2.5',
        'md' => 'w-3 h-3',
        'lg' => 'w-3.5 h-3.5',
        'xl' => 'w-4 h-4',
    ];
    $statusPositions = [
        'bottom-right' => 'bottom-0 right-0',
        'bottom-left' => 'bottom-0 left-0',
        'top-right' => 'top-0 right-0',
        'top-left' => 'top-0 left-0',
    ];
    $statusColors = [
        'online' => 'bg-green-500 border-2 border-white dark:border-gray-800',
        'offline' => 'bg-gray-400 border-2 border-white dark:border-gray-800',
        'away' => 'bg-yellow-500 border-2 border-white dark:border-gray-800',
        'busy' => 'bg-red-500 border-2 border-white dark:border-gray-800',
    ];
    $colors = [
        'blue' => 'bg-blue-500', 'red' => 'bg-red-500', 'green' => 'bg-green-500',
        'purple' => 'bg-purple-500', 'gray' => 'bg-gray-500',
    ];
    $sizeClass = $sizes[$size] ?? $sizes['md'];
    $statusClass = $statusSizes[$size] ?? $statusSizes['md'];
    $posClass = $statusPositions[$statusPosition] ?? $statusPositions['bottom-right'];
    $colorClass = $colors[$color] ?? $colors['blue'];
    $badgeSizes = ['sm' => 'w-4 h-4 text-[8px]', 'md' => 'w-5 h-5 text-[10px]', 'lg' => 'w-6 h-6 text-xs', 'xl' => 'w-7 h-7 text-xs'];
    $badgeSize = $badgeSizes[$size] ?? $badgeSizes['md'];
    $radius = $square ? 'rounded-lg' : 'rounded-full';
    $ring = $bordered ? 'ring-2 ring-white dark:ring-gray-800' : '';
@endphp

<div class="relative inline-flex flex-shrink-0">
    {{-- Avatar --}}
    @if($src)
        <img
            src="{{ $src }}"
            alt="{{ $name ?? 'Avatar' }}"
            class="{{ $sizeClass }} {{ $radius }} {{ $ring }} object-cover"
            onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';"
        />
        {{-- Fallback initials (shown on error) --}}
        <div class="{{ $sizeClass }} {{ $radius }} {{ $ring }} {{ $colorClass }} text-white font-semibold items-center justify-center hidden">
            {{ $initials ?? substr($name ?? '?', 0, 2) }}
        </div>
    @else
        <div class="{{ $sizeClass }} {{ $radius }} {{ $ring }} {{ $colorClass }} text-white font-semibold flex items-center justify-center">
            {{ $initials ?? substr($name ?? '?', 0, 2) }}
        </div>
    @endif

    {{-- Status Indicator --}}
    @if($status)
        <span class="absolute {{ $posClass }} {{ $statusClass }} {{ $statusColors[$status] ?? $statusColors['offline'] }} rounded-full"></span>
    @endif

    {{-- Badge Count --}}
    @if($badge !== null && $badge > 0)
        <span class="absolute -top-1 -right-1 {{ $badgeSize }} bg-{{ $badgeColor }}-500 text-white rounded-full flex items-center justify-center font-bold shadow">
            {{ $badge > 99 ? '99+' : $badge }}
        </span>
    @endif
</div>