{{-- Komponen Rating Input - Interactive Star Rating dengan Alpine.js --}}
@props([
    'name' => null,
    'label' => null,
    'value' => 0,
    'max' => 5,
    'size' => 'md',
    'color' => 'yellow',
    'disabled' => false,
])

@php
    $uniqueId = 'rating-' . uniqid();

    $sizeClasses = [
        'sm' => 'w-5 h-5',
        'md' => 'w-7 h-7',
        'lg' => 'w-9 h-9',
        'xl' => 'w-11 h-11',
    ];

    $colorClasses = [
        'yellow' => 'text-yellow-400',
        'amber' => 'text-amber-500',
        'orange' => 'text-orange-500',
        'red' => 'text-red-500',
        'blue' => 'text-blue-500',
        'purple' => 'text-purple-500',
        'green' => 'text-green-500',
    ];

    $sizeClass = $sizeClasses[$size] ?? $sizeClasses['md'];
    $colorClass = $colorClasses[$color] ?? $colorClasses['yellow'];
@endphp

<div class="flex flex-col gap-1.5" x-data="ratingInput({{ $value }}, {{ $max }}, {{ $disabled ? 'true' : 'false' }})">
    @if($label)
        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $label }}</label>
    @endif

    <div class="flex items-center gap-1">
        {{-- Stars --}}
        <div class="flex gap-0.5" role="radiogroup" aria-label="Rating">
            @for($i = 1; $i <= $max; $i++)
                <button
                    type="button"
                    @click="setRating({{ $i }})"
                    @mouseenter="hoverRating = {{ $i }}"
                    @mouseleave="hoverRating = 0"
                    class="transition-transform {{ $disabled ? 'cursor-default' : 'cursor-pointer hover:scale-110' }}"
                    aria-label="{{ $i }} star{{ $i > 1 ? 's' : '' }}"
                    {{ $disabled ? 'disabled' : '' }}
                >
                    <svg class="{{ $sizeClass }} transition-colors duration-150"
                        :class="(hoverRating || rating) >= {{ $i }} ? '{{ $colorClass }} fill-current' : 'text-gray-300 dark:text-gray-600'"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.381-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                </button>
            @endfor
        </div>

        {{-- Value Display --}}
        <span class="ml-2 text-sm font-semibold {{ $colorClass }}" x-text="rating > 0 ? rating + ' / {{ $max }}' : 'Pilih rating'"></span>
    </div>

    {{-- Hidden input --}}
    <input type="hidden" name="{{ $name }}" x-model="rating">
</div>

