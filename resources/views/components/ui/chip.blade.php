{{-- Komponen Chip dengan Tailwind CSS --}}
@props([
    'closable' => false,
    'icon' => null,
    'color' => 'gray',
])

@php
    $colorClasses = [
        'gray' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200',
        'blue' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300',
        'green' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300',
    ];
@endphp

<div {{ $attributes->merge(['class' => "inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-sm {$colorClasses[$color]}"]) }}>
    @if($icon)
        <span>{{ $icon }}</span>
    @endif

    {{ $slot }}

    @if($closable)
        <button class="ml-1 hover:opacity-70 transition">
            ✕
        </button>
    @endif
</div>
