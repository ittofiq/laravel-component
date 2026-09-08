{{-- Komponen Currency Input dengan Format Mata Uang --}}
@props([
    'name' => null,
    'label' => null,
    'placeholder' => '0',
    'value' => null,
    'currency' => 'IDR',
    'locale' => 'id-ID',
    'error' => null,
    'required' => false,
    'disabled' => false,
    'size' => 'md',
])

@php
    $sizeClass = match($size) {
        'xs' => 'py-1 text-xs',
        'sm' => 'py-1.5 text-sm',
        'md' => 'py-2 text-base',
        'lg' => 'py-2.5 text-lg',
        'xl' => 'py-3 text-xl',
        default => 'py-2 text-base',
    };
    $uniqueId = 'currency-' . uniqid();
    $currencies = [
        'IDR' => ['symbol' => 'Rp', 'code' => 'IDR', 'locale' => 'id-ID'],
        'USD' => ['symbol' => '$', 'code' => 'USD', 'locale' => 'en-US'],
        'EUR' => ['symbol' => '€', 'code' => 'EUR', 'locale' => 'de-DE'],
        'GBP' => ['symbol' => '£', 'code' => 'GBP', 'locale' => 'en-GB'],
        'JPY' => ['symbol' => '¥', 'code' => 'JPY', 'locale' => 'ja-JP'],
        'SGD' => ['symbol' => 'S$', 'code' => 'SGD', 'locale' => 'en-SG'],
        'AUD' => ['symbol' => 'A$', 'code' => 'AUD', 'locale' => 'en-AU'],
        'MYR' => ['symbol' => 'RM', 'code' => 'MYR', 'locale' => 'ms-MY'],
    ];
    $curr = $currencies[$currency] ?? $currencies['IDR'];
    $initialValue = $value ? number_format((float) $value, 0, ',', '.') : '';
@endphp

<div class="flex flex-col gap-1.5" x-data="currencyInput('{{ $initialValue }}', '{{ $curr['locale'] }}', '{{ $curr['symbol'] }}')">
    @if($label)
        <div class="flex justify-between items-center">
            <label for="{{ $uniqueId }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 flex items-center gap-1">
                {{ $label }}
                @if($required)<span class="text-red-500">*</span>@endif
            </label>
            <span class="text-xs text-gray-400 dark:text-gray-500 font-mono">{{ $curr['code'] }}</span>
        </div>
    @endif

    <div class="relative">
        {{-- Currency Symbol --}}
        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
            <span class="text-gray-500 dark:text-gray-400 font-medium text-sm">{{ $curr['symbol'] }}</span>
        </div>

        {{-- Input --}}
        <input
            type="text"
            id="{{ $uniqueId }}"
            inputmode="numeric"
            x-model="display"
            @keydown="allowOnlyNumbers($event)"
            @input="format"
            @focus="$event.target.select()"
            placeholder="{{ $placeholder }}"
            class="w-full pl-10 pr-12 {{ $sizeClass }} rounded-lg border transition-colors duration-200 focus:outline-none focus:ring-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 text-right font-mono {{ $error ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 dark:border-gray-600 focus:ring-blue-500' }} {{ $disabled ? 'opacity-60 cursor-not-allowed' : '' }}"
            {{ $required ? 'required' : '' }}
            {{ $disabled ? 'disabled' : '' }}
        />

        {{-- Clear button --}}
        <button
            type="button"
            x-show="rawValue > 0"
            @click="clear"
            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-300"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>

    {{-- Hidden input for form --}}
    <input type="hidden" name="{{ $name }}" :value="rawValue">

    @if($error)
        <p class="text-sm text-red-500">{{ $error }}</p>
    @endif
</div>