{{-- Komponen Input Group dengan Prefix/Suffix --}}
@props([
    'name' => null,
    'label' => null,
    'type' => 'text',
    'placeholder' => '',
    'prefix' => null,
    'suffix' => null,
    'prefixIcon' => null,
    'suffixIcon' => null,
    'error' => null,
    'required' => false,
    'disabled' => false,
    'value' => null,
    'size' => 'md',
])

@php
    $sizeClass = match($size) {
        'xs' => 'px-2 py-1 text-xs',
        'sm' => 'px-2.5 py-1.5 text-sm',
        'md' => 'px-4 py-2 text-sm',
        'lg' => 'px-4 py-2.5 text-base',
        'xl' => 'px-5 py-3 text-lg',
        default => 'px-4 py-2 text-sm',
    };
    $baseInput = "w-full {$sizeClass} bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 transition-colors duration-200 disabled:opacity-60 disabled:cursor-not-allowed";
    $borderClass = $error
        ? 'border border-red-500 focus:border-red-500 focus:ring-red-500'
        : 'border border-gray-300 dark:border-gray-600 focus:border-blue-500 focus:ring-blue-500';

    if ($prefix || $prefixIcon) $baseInput .= ' rounded-l-none';
    if ($suffix || $suffixIcon) $baseInput .= ' rounded-r-none';
    if (!$prefix && !$prefixIcon) $baseInput .= ' rounded-l-lg';
    if (!$suffix && !$suffixIcon) $baseInput .= ' rounded-r-lg';
@endphp

<div class="flex flex-col gap-1.5">
    @if($label)
        <label class="text-sm font-medium text-gray-700 dark:text-gray-300 flex items-center gap-1">
            {{ $label }}
            @if($required)<span class="text-red-500">*</span>@endif
        </label>
    @endif

    <div class="flex items-stretch">
        {{-- Prefix --}}
        @if($prefix || $prefixIcon)
            <span class="inline-flex items-center px-3.5 rounded-l-lg border border-r-0 border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-600 text-gray-600 dark:text-gray-400 text-sm font-medium">
                @if($prefixIcon)
                    <span class="text-base">{{ $prefixIcon }}</span>
                @endif
                @if($prefix && $prefixIcon)
                    <span class="ml-1.5">{{ $prefix }}</span>
                @elseif($prefix)
                    {{ $prefix }}
                @endif
            </span>
        @endif

        {{-- Input --}}
        <input
            type="{{ $type }}"
            name="{{ $name }}"
            value="{{ $value }}"
            placeholder="{{ $placeholder }}"
            class="{{ $baseInput }} {{ $borderClass }} flex-1"
            {{ $required ? 'required' : '' }}
            {{ $disabled ? 'disabled' : '' }}
        />

        {{-- Suffix --}}
        @if($suffix || $suffixIcon)
            <span class="inline-flex items-center px-3.5 rounded-r-lg border border-l-0 border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-600 text-gray-600 dark:text-gray-400 text-sm font-medium">
                @if($suffixIcon)
                    <span class="text-base">{{ $suffixIcon }}</span>
                @endif
                @if($suffix && $suffixIcon)
                    <span class="ml-1.5">{{ $suffix }}</span>
                @elseif($suffix)
                    {{ $suffix }}
                @endif
            </span>
        @endif
    </div>

    @if($error)
        <p class="text-sm text-red-500">{{ $error }}</p>
    @endif
</div>