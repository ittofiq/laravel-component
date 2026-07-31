{{-- Komponen Grid Layout dengan Tailwind CSS --}}
@props([
    'cols' => 3,
    'gap' => 6,
    'responsive' => true,
])

@php
    // Responsive column classes
    $colClasses = match ((int) $cols) {
        1 => 'grid-cols-1',
        2 => 'grid-cols-1 sm:grid-cols-2',
        3 => 'grid-cols-1 sm:grid-cols-2 lg:grid-cols-3',
        4 => 'grid-cols-1 sm:grid-cols-2 lg:grid-cols-4',
        5 => 'grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5',
        6 => 'grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6',
        default => 'grid-cols-1 sm:grid-cols-2 lg:grid-cols-' . min((int) $cols, 12),
    };

    // Gap classes
    $gapClasses = match ((int) $gap) {
        0 => 'gap-0',
        1 => 'gap-1',
        2 => 'gap-2',
        3 => 'gap-3',
        4 => 'gap-4',
        5 => 'gap-5',
        6 => 'gap-6',
        8 => 'gap-8',
        10 => 'gap-10',
        12 => 'gap-12',
        default => 'gap-6',
    };
@endphp

<div {{ $attributes->merge(['class' => "grid {$colClasses} {$gapClasses}"]) }}>
    {{ $slot }}
</div>