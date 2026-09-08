{{-- Komponen Password Input dengan Show/Hide Toggle --}}
@props([
    'name' => 'password',
    'label' => null,
    'placeholder' => 'Masukkan password',
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
@endphp

<div class="flex flex-col gap-1.5" x-data="{ show: false }">
    @if($label)
        <label class="text-sm font-medium text-gray-700 dark:text-gray-300 flex items-center gap-1">
            {{ $label }}
            @if($required)<span class="text-red-500">*</span>@endif
        </label>
    @endif

    <div class="relative">
        <input
            :type="show ? 'text' : 'password'"
            name="{{ $name }}"
            value="{{ $value }}"
            placeholder="{{ $placeholder }}"
            class="w-full {{ $sizeClass }} pr-11 rounded-lg border transition-colors duration-200 focus:outline-none focus:ring-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 {{ $error ? 'border-red-500 focus:ring-red-500 focus:border-red-500' : 'border-gray-300 dark:border-gray-600 focus:ring-blue-500 focus:border-blue-500' }} {{ $disabled ? 'opacity-60 cursor-not-allowed' : '' }}"
            {{ $required ? 'required' : '' }}
            {{ $disabled ? 'disabled' : '' }}
        />

        <button
            type="button"
            @click="show = !show"
            class="absolute right-2 top-1/2 -translate-y-1/2 p-1.5 rounded-md text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors focus:outline-none"
            :aria-label="show ? 'Hide password' : 'Show password'"
        >
            {{-- Eye icon (hidden) --}}
            <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
            </svg>
            {{-- Eye-off icon (shown) --}}
            <svg x-show="show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
            </svg>
        </button>
    </div>

    @if($error)
        <p class="text-sm text-red-500">{{ $error }}</p>
    @endif
</div>