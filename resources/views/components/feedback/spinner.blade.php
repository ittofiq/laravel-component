{{-- Komponen Spinner Loading dengan Variants --}}
@props([
    'size' => 'md',
    'color' => 'blue',
    'label' => null,
])

@php
    $sizeClasses = [
        'sm' => 'w-4 h-4 border-2',
        'md' => 'w-8 h-8 border-2',
        'lg' => 'w-12 h-12 border-3',
        'xl' => 'w-16 h-16 border-4',
    ];

    $colorClasses = [
        'blue' => 'border-blue-500',
        'gray' => 'border-gray-500',
        'white' => 'border-white',
        'green' => 'border-green-500',
        'red' => 'border-red-500',
        'purple' => 'border-purple-500',
    ];

    $sizeClass = $sizeClasses[$size] ?? $sizeClasses['md'];
    $colorClass = $colorClasses[$color] ?? $colorClasses['blue'];
@endphp

<div class="flex flex-col items-center justify-center gap-3">
    <div class="animate-spin rounded-full {{ $sizeClass }} {{ $colorClass }}" style="border-bottom-color: transparent;"></div>
    @if($label)
        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $label }}</span>
    @endif
</div>