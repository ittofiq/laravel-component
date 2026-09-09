{{-- Komponen Checkbox dengan Tailwind CSS --}}
@props([
    'name' => null,
    'label' => null,
    'value' => '1',
    'checked' => false,
    'disabled' => false,
    'size' => 'md',
])

@php
    $sizeClass = match($size) {
        'xs' => 'w-3 h-3',
        'sm' => 'w-3.5 h-3.5',
        'md' => 'w-4 h-4',
        'lg' => 'w-5 h-5',
        'xl' => 'w-6 h-6',
        default => 'w-4 h-4',
    };
    $textClass = match($size) {
        'xs' => 'text-xs',
        'sm' => 'text-sm',
        'md' => 'text-base',
        'lg' => 'text-lg',
        'xl' => 'text-xl',
        default => 'text-base',
    };
@endphp

<div class="flex items-center gap-2">
    <input
        type="checkbox"
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ $value }}"
        {{ $attributes->merge(['class' => $sizeClass . ' text-blue-600 rounded focus:ring-2 focus:ring-blue-500']) }}
        @if($checked) checked @endif
        @if($disabled) disabled @endif
    />

    @if($label)
        <label for="{{ $name }}" class="{{ $textClass }} text-gray-700 dark:text-gray-300 cursor-pointer">
            {{ $label }}
        </label>
    @endif
</div>
