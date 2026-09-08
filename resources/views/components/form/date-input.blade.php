{{-- Komponen Date Input dengan Tailwind CSS --}}
@props([
    'name' => null,
    'label' => null,
    'value' => null,
    'error' => null,
    'required' => false,
    'size' => 'md',
])

@php
    $sizeClass = match($size) {
        'xs' => 'px-2 py-1 text-xs',
        'sm' => 'px-2.5 py-1.5 text-sm',
        'md' => 'px-4 py-2 text-base',
        'lg' => 'px-4 py-2.5 text-lg',
        'xl' => 'px-5 py-3 text-xl',
        default => 'px-4 py-2 text-base',
    };
    $baseClasses = "w-full {$sizeClass} rounded-lg border transition-colors duration-200 focus:outline-none focus:ring-2";
    $borderClasses = $error
        ? 'border-red-500 focus:ring-red-500 focus:border-red-500'
        : 'border-gray-300 dark:border-gray-600 focus:ring-blue-500 focus:border-blue-500';
    $bgClasses = 'bg-white dark:bg-gray-700 text-gray-900 dark:text-white';
    $classes = "{$baseClasses} {$borderClasses} {$bgClasses}";
@endphp

<div class="flex flex-col gap-2">
    @if($label)
        <label for="{{ $name }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 flex items-center gap-1">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    <input
        type="date"
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ $value }}"
        {{ $attributes->merge(['class' => $classes]) }}
        @if($required) required @endif
    />

    @if($error)
        <p class="text-sm text-red-500 flex items-center gap-1">
            <span>⚠️</span>
            {{ $error }}
        </p>
    @endif
</div>
