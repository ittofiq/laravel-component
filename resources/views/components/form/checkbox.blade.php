{{-- Komponen Checkbox dengan Tailwind CSS --}}
@props([
    'name' => null,
    'label' => null,
    'value' => '1',
    'checked' => false,
    'disabled' => false,
])

<div class="flex items-center gap-2">
    <input
        type="checkbox"
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ $value }}"
        {{ $attributes->merge(['class' => 'w-4 h-4 text-blue-600 rounded focus:ring-2 focus:ring-blue-500']) }}
        @if($checked) checked @endif
        @if($disabled) disabled @endif
    />

    @if($label)
        <label for="{{ $name }}" class="text-sm text-gray-700 dark:text-gray-300 cursor-pointer">
            {{ $label }}
        </label>
    @endif
</div>
