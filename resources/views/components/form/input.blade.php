{{-- Komponen Input Sophisticated dengan validation, counter, dan masks --}}
@props([
    'type' => 'text',
    'name' => null,
    'label' => null,
    'error' => null,
    'required' => false,
    'maxLength' => null,
    'placeholder' => null,
    'size' => 'md',
    'showCounter' => false,
    'mask' => null, // phone, email, credit-card, zip-code
    'disabled' => false,
    'hint' => null,
    'icon' => null,
    'iconPosition' => 'left',
])

@php
    $uniqueId = 'input-' . uniqid();
    $maskClass = match($mask) {
        'phone' => 'input-phone',
        'credit-card' => 'input-credit-card',
        'zip-code' => 'input-zip',
        default => '',
    };
    $sizeClass = match($size) {
        'xs' => 'px-2 py-1 text-xs',
        'sm' => 'px-2.5 py-1.5 text-sm',
        'md' => 'px-4 py-2 text-sm',
        'lg' => 'px-4 py-2.5 text-base',
        'xl' => 'px-5 py-3 text-lg',
        default => 'px-4 py-2 text-sm',
    };
@endphp

<div x-data="{
    value: '',
    charCount: 0,
    isFocused: false,
    hasValue: false,
    updateCount() {
        this.charCount = this.value.length;
        this.hasValue = this.value.trim().length > 0;
    }
}" class="flex flex-col gap-2">
    @if($label)
        <label for="{{ $uniqueId }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 flex items-center gap-1">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    <!-- Input Container dengan Icon -->
    <div class="relative flex items-center">
        @if($icon && $iconPosition === 'left')
            <span class="absolute left-3 text-gray-400 dark:text-gray-500 text-lg">{{ $icon }}</span>
        @endif

        <input
            type="{{ $type }}"
            id="{{ $uniqueId }}"
            name="{{ $name }}"
            placeholder="{{ $placeholder }}"
            x-model="value"
            @input="updateCount()"
            @focus="isFocused = true"
            @blur="isFocused = false"
            {{ $maxLength ? "maxlength=$maxLength" : '' }}
            {{ $attributes->merge([
                'class' => 'w-full ' . $sizeClass . ' rounded-lg border transition-all duration-200 focus:outline-none focus:ring-2 ' .
                          ($icon && $iconPosition === 'left' ? 'pl-10' : '') .
                          ($icon && $iconPosition === 'right' ? 'pr-10' : '') .
                          ($error
                              ? 'border-red-500 focus:ring-red-500 focus:border-red-500 focus:ring-opacity-50'
                              : 'border-gray-300 dark:border-gray-600 focus:ring-blue-500 focus:border-blue-500 focus:ring-opacity-50'
                          ) .
                          ' dark:bg-gray-700 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 ' .
                          ($disabled ? 'opacity-60 cursor-not-allowed' : '')
            ]) }}
            @if($disabled) disabled @endif
        />

        @if($icon && $iconPosition === 'right')
            <span class="absolute right-3 text-gray-400 dark:text-gray-500 text-lg">{{ $icon }}</span>
        @endif

        <!-- Validation Indicator -->
        @if(!$error && $showCounter === false)
            <div class="absolute right-3" x-show="hasValue && !isFocused && !error" class="text-green-500">
                ✓
            </div>
        @endif
    </div>

    <!-- Helper Text & Character Counter -->
    <div class="flex items-center justify-between text-xs">
        @if($hint)
            <span class="text-gray-500 dark:text-gray-400">{{ $hint }}</span>
        @else
            <span class="text-transparent">.</span>
        @endif

        @if($showCounter && $maxLength)
            <span x-text="`${charCount}/${maxLength}`" class="text-gray-500 dark:text-gray-400"></span>
        @endif
    </div>

    <!-- Error Message -->
    @if($error)
        <div class="flex items-center gap-1">
            <span class="text-red-500 text-xs">⚠️</span>
            <p class="text-sm text-red-500">{{ $error }}</p>
        </div>
    @endif
</div>

<script>
// Simple input masking
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('{{ $uniqueId }}');

    @if($mask === 'phone')
        input.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if(value.length > 0) {
                if(value.length <= 3) {
                    value = value;
                } else if(value.length <= 6) {
                    value = value.slice(0, 3) + '-' + value.slice(3);
                } else {
                    value = value.slice(0, 3) + '-' + value.slice(3, 6) + '-' + value.slice(6, 10);
                }
            }
            e.target.value = value;
        });
    @endif

    @if($mask === 'credit-card')
        input.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\s/g, '');
            let result = '';
            for(let i = 0; i < value.length; i++) {
                if(i > 0 && i % 4 === 0) result += ' ';
                result += value[i];
            }
            e.target.value = result;
        });
    @endif

    @if($mask === 'zip-code')
        input.addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/[^0-9\-]/g, '').slice(0, 10);
        });
    @endif
});
</script>

