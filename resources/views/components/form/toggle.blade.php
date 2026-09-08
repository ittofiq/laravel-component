{{-- Komponen Toggle/Switch dengan Alpine.js --}}
@props([
    'name' => null,
    'label' => null,
    'checked' => false,
    'disabled' => false,
    'color' => 'blue',
    'size' => 'md',
])

@php
    $uniqueId = 'toggle-' . uniqid();

    $colors = [
        'blue' => ['bg' => 'bg-blue-500', 'ring' => 'focus:ring-blue-400'],
        'green' => ['bg' => 'bg-green-500', 'ring' => 'focus:ring-green-400'],
        'red' => ['bg' => 'bg-red-500', 'ring' => 'focus:ring-red-400'],
        'purple' => ['bg' => 'bg-purple-500', 'ring' => 'focus:ring-purple-400'],
    ];

    $sizes = [
        'xs' => ['w' => 'w-6', 'h' => 'h-3.5', 'dot' => 'w-2.5 h-2.5', 'translate' => 'translate-x-2.5'],
        'sm' => ['w' => 'w-8', 'h' => 'h-4', 'dot' => 'w-3 h-3', 'translate' => 'translate-x-4'],
        'md' => ['w' => 'w-11', 'h' => 'h-6', 'dot' => 'w-5 h-5', 'translate' => 'translate-x-5'],
        'lg' => ['w' => 'w-14', 'h' => 'h-7', 'dot' => 'w-6 h-6', 'translate' => 'translate-x-7'],
        'xl' => ['w' => 'w-16', 'h' => 'h-8', 'dot' => 'w-7 h-7', 'translate' => 'translate-x-8'],
    ];

    $color = $colors[$color] ?? $colors['blue'];
    $size = $sizes[$size] ?? $sizes['md'];
@endphp

<div class="flex items-center gap-3" x-data="{ on: {{ $checked ? 'true' : 'false' }} }">
    <button
        type="button"
        @click="on = !on"
        :aria-checked="on"
        role="switch"
        class="relative inline-flex items-center rounded-full transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 {{ $color['ring'] }} {{ $size['w'] }} {{ $size['h'] }} {{ $disabled ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer' }}"
        :class="on ? '{{ $color['bg'] }}' : 'bg-gray-300 dark:bg-gray-600'"
        {{ $disabled ? 'disabled' : '' }}
    >
        <span
            class="inline-block rounded-full bg-white shadow transform transition-transform duration-200 {{ $size['dot'] }}"
            :class="on ? '{{ $size['translate'] }}' : 'translate-x-0.5'"
        ></span>
    </button>

    @if($label)
        <label for="{{ $uniqueId }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 {{ $disabled ? 'opacity-60' : 'cursor-pointer' }}" @click="on = !on">
            {{ $label }}
        </label>
    @endif

    {{-- Hidden input for form submission --}}
    <input type="hidden" id="{{ $uniqueId }}" name="{{ $name }}" x-model="on" :value="on ? '1' : '0'">
</div>