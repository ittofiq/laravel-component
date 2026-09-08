{{-- Komponen Notification Badge --}}
@props([
    'count' => null,
    'dot' => false,
    'color' => 'red',
    'size' => 'md',
    'position' => 'top-right',
])

@php
    $showCount = !$dot && $count !== null && $count > 0;
    $showDot = $dot || ($count !== null && $count > 0 && !$showCount);

    $colorClasses = [
        'red' => 'bg-red-500 text-white',
        'blue' => 'bg-blue-500 text-white',
        'green' => 'bg-green-500 text-white',
        'yellow' => 'bg-yellow-500 text-white',
        'purple' => 'bg-purple-500 text-white',
        'gray' => 'bg-gray-500 text-white',
    ];

    $positionClasses = [
        'top-right' => '-top-1 -right-1',
        'top-left' => '-top-1 -left-1',
        'bottom-right' => '-bottom-1 -right-1',
        'bottom-left' => '-bottom-1 -left-1',
    ];

    $dotSizes = [
        'xs' => 'w-1.5 h-1.5',
        'sm' => 'w-2 h-2',
        'md' => 'w-2.5 h-2.5',
        'lg' => 'w-3 h-3',
        'xl' => 'w-3.5 h-3.5',
    ];

    $countSizes = [
        'xs' => 'w-3.5 h-3.5 text-[9px]',
        'sm' => 'w-4 h-4 text-[10px]',
        'md' => 'w-5 h-5 text-xs',
        'lg' => 'w-6 h-6 text-sm',
        'xl' => 'w-7 h-7 text-base',
    ];

    $colorClass = $colorClasses[$color] ?? $colorClasses['red'];
    $posClass = $positionClasses[$position] ?? $positionClasses['top-right'];
@endphp

<div class="relative inline-flex">
    {{ $slot }}

    @if($showDot && !$showCount)
        <span class="absolute {{ $posClass }} {{ $dotSizes[$size] ?? $dotSizes['md'] }} rounded-full {{ $colorClass }} ring-2 ring-white dark:ring-gray-900 animate-pulse"></span>
    @endif

    @if($showCount)
        <span class="absolute {{ $posClass }} {{ $countSizes[$size] ?? $countSizes['md'] }} rounded-full {{ $colorClass }} ring-2 ring-white dark:ring-gray-900 flex items-center justify-center font-bold">
            {{ $count > 99 ? '99+' : $count }}
        </span>
    @endif
</div>