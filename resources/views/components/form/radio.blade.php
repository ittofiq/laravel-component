{{-- Komponen Radio dengan Tailwind CSS --}}
@props([
    'name' => null,
    'label' => null,
    'value' => null,
    'checked' => false,
    'disabled' => false,
])

<div class="flex items-center gap-2">
    <input
        type="radio"
        id="{{ $name }}_{{ $value }}"
        name="{{ $name }}"
        value="{{ $value }}"
        {{ $attributes->merge(['class' => 'w-4 h-4 text-blue-600 focus:ring-2 focus:ring-blue-500']) }}
        @if($checked) checked @endif
        @if($disabled) disabled @endif
    />

    @if($label)
        <label for="{{ $name }}_{{ $value }}" class="text-sm text-gray-700 dark:text-gray-300 cursor-pointer">
            {{ $label }}
        </label>
    @endif
</div>
