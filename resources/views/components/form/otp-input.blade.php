{{-- Komponen OTP Input - 6-digit verification code --}}
@props([
    'name' => 'otp',
    'label' => null,
    'length' => 6,
    'error' => null,
    'disabled' => false,
    'size' => 'md',
])

@php
    $uniqueId = 'otp-' . uniqid();
    $sizeClass = match($size) {
        'xs' => 'w-8 h-10 text-base',
        'sm' => 'w-9 h-12 text-lg',
        'md' => 'w-11 h-14 text-xl',
        'lg' => 'w-12 h-16 text-2xl',
        'xl' => 'w-14 h-20 text-3xl',
        default => 'w-11 h-14 text-xl',
    };
@endphp

<div class="flex flex-col gap-2" x-data="otpInput({{ $length }}, '{{ $name }}')">
    @if($label)
        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $label }}</label>
    @endif

    <div class="flex gap-2 justify-center sm:justify-start">
        @for($i = 0; $i < $length; $i++)
            <input
                type="text"
                inputmode="numeric"
                maxlength="1"
                @input="handleInput($event, {{ $i }})"
                @keydown.backspace="handleBackspace($event, {{ $i }})"
                @paste="handlePaste($event)"
                @focus="$event.target.select()"
                class="{{ $sizeClass }} text-center font-bold rounded-lg border transition-colors duration-200 focus:outline-none focus:ring-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white {{ $error ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 dark:border-gray-600 focus:ring-blue-500 focus:border-blue-500' }} {{ $disabled ? 'opacity-60 cursor-not-allowed' : '' }}"
                {{ $disabled ? 'disabled' : '' }}
                {{ $i === 0 ? 'autofocus' : '' }}
                aria-label="Digit {{ $i + 1 }}"
            />
        @endfor

        <input type="hidden" name="{{ $name }}" x-model="code">
    </div>

    @if($error)
        <p class="text-sm text-red-500">{{ $error }}</p>
    @endif
</div>

<script>
function otpInput(length, fieldName) {
    return {
        code: '',

        init() {
            this.code = '';
        },

        handleInput(event, index) {
            const input = event.target;
            const value = input.value.replace(/[^0-9]/g, '');
            input.value = value;

            if (value && index < length - 1) {
                input.nextElementSibling?.focus();
            }

            this.updateCode();
        },

        handleBackspace(event, index) {
            if (!event.target.value && index > 0) {
                event.target.previousElementSibling?.focus();
            }
        },

        handlePaste(event) {
            event.preventDefault();
            const paste = (event.clipboardData || window.clipboardData).getData('text');
            const digits = paste.replace(/[^0-9]/g, '').slice(0, length);

            const inputs = event.target.parentElement.querySelectorAll('input[type="text"]');
            digits.split('').forEach((digit, i) => {
                if (inputs[i]) {
                    inputs[i].value = digit;
                }
            });

            if (digits.length < length) {
                inputs[digits.length]?.focus();
            } else {
                inputs[length - 1]?.focus();
            }

            this.updateCode();
        },

        updateCode() {
            const inputs = this.$el.querySelectorAll('input[type="text"]');
            this.code = Array.from(inputs).map(i => i.value).join('');
        }
    };
}
</script>