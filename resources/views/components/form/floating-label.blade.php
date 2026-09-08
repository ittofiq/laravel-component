{{-- Komponen Floating Label dengan Alpine.js --}}
@props([
    'name' => null,
    'label' => 'Label',
    'type' => 'text',
    'placeholder' => ' ',
    'value' => null,
    'error' => null,
    'required' => false,
    'disabled' => false,
    'size' => 'md',
])

@php
    $sizeClass = match($size) {
        'xs' => 'pb-1 text-xs',
        'sm' => 'pb-1.5 text-sm',
        'md' => 'pb-2 text-base',
        'lg' => 'pb-2.5 text-lg',
        'xl' => 'pb-3 text-xl',
        default => 'pb-2 text-base',
    };
    $uniqueId = 'fl-' . uniqid();
@endphp

<div class="relative" x-data="{ focused: false, hasValue: {{ $value ? 'true' : 'false' }} }">
    <input
        type="{{ $type }}"
        id="{{ $uniqueId }}"
        name="{{ $name }}"
        value="{{ $value }}"
        placeholder="{{ $placeholder }}"
        @focus="focused = true"
        @blur="focused = false; hasValue = $el.value.length > 0"
        @input="hasValue = $el.value.length > 0"
        class="peer w-full px-4 pt-5 {{ $sizeClass }} bg-white dark:bg-gray-700 border rounded-lg text-gray-900 dark:text-white placeholder-transparent focus:outline-none focus:ring-2 transition-colors duration-200 {{ $error ? 'border-red-500 focus:ring-red-500 focus:border-red-500' : 'border-gray-300 dark:border-gray-600 focus:ring-blue-500 focus:border-blue-500' }} {{ $disabled ? 'opacity-60 cursor-not-allowed' : '' }}"
        {{ $required ? 'required' : '' }}
        {{ $disabled ? 'disabled' : '' }}
    />

    <label
        for="{{ $uniqueId }}"
        class="absolute left-4 transition-all duration-200 pointer-events-none text-gray-500 dark:text-gray-400"
        :class="(focused || hasValue)
            ? 'top-1.5 text-xs text-blue-500 dark:text-blue-400'
            : 'top-3 text-sm'"
    >
        {{ $label }}
        @if($required)<span class="text-red-500">*</span>@endif
    </label>

    @if($error)
        <p class="text-sm text-red-500 mt-1">{{ $error }}</p>
    @endif
</div>