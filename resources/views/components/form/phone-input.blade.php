{{-- Komponen Phone Input dengan Kode Negara --}}
@props([
    'name' => null,
    'label' => null,
    'placeholder' => '81234567890',
    'value' => null,
    'error' => null,
    'required' => false,
    'disabled' => false,
    'defaultCountry' => 'id',
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
    $uniqueId = 'phone-' . uniqid();
    $countries = [
        'id' => ['code' => '+62', 'flag' => '🇮🇩', 'name' => 'Indonesia'],
        'us' => ['code' => '+1', 'flag' => '🇺🇸', 'name' => 'United States'],
        'my' => ['code' => '+60', 'flag' => '🇲🇾', 'name' => 'Malaysia'],
        'sg' => ['code' => '+65', 'flag' => '🇸🇬', 'name' => 'Singapore'],
        'au' => ['code' => '+61', 'flag' => '🇦🇺', 'name' => 'Australia'],
        'gb' => ['code' => '+44', 'flag' => '🇬🇧', 'name' => 'United Kingdom'],
        'jp' => ['code' => '+81', 'flag' => '🇯🇵', 'name' => 'Japan'],
        'kr' => ['code' => '+82', 'flag' => '🇰🇷', 'name' => 'South Korea'],
        'in' => ['code' => '+91', 'flag' => '🇮🇳', 'name' => 'India'],
        'de' => ['code' => '+49', 'flag' => '🇩🇪', 'name' => 'Germany'],
        'fr' => ['code' => '+33', 'flag' => '🇫🇷', 'name' => 'France'],
        'cn' => ['code' => '+86', 'flag' => '🇨🇳', 'name' => 'China'],
    ];
    $default = $countries[$defaultCountry] ?? $countries['id'];
    $countriesJson = json_encode($countries);
    $defaultCode = $default['code'];
@endphp

<div class="flex flex-col gap-1.5" x-data="phoneInput('{{ $uniqueId }}', {{ $countriesJson }}, '{{ $defaultCountry }}')" @click.outside="open = false">
    @if($label)
        <label for="{{ $uniqueId }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 flex items-center gap-1">
            {{ $label }}
            @if($required)<span class="text-red-500">*</span>@endif
        </label>
    @endif

    <div class="flex gap-2">
        {{-- Country Selector --}}
        <div class="relative flex-shrink-0">
            <button
                type="button"
                @click="open = !open"
                class="h-full px-3 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white flex items-center gap-1.5 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors text-sm"
                {{ $disabled ? 'disabled' : '' }}
            >
                <span x-text="selectedCountry.flag"></span>
                <span x-text="selectedCountry.code"></span>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </button>

            {{-- Dropdown --}}
            <div
                x-show="open"
                x-transition:enter="transition-all duration-200 ease-out"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                class="absolute top-full left-0 mt-1 w-56 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg shadow-lg z-20 max-h-60 overflow-y-auto"
                style="display: none;"
            >
                <div class="p-1">
                    <template x-for="(country, key) in countries" :key="key">
                        <button
                            type="button"
                            @click="selectCountry(key); open = false"
                            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-colors hover:bg-gray-100 dark:hover:bg-gray-600"
                            :class="{ 'bg-blue-50 dark:bg-blue-900/30': selectedKey === key }"
                        >
                            <span x-text="country.flag" class="text-lg"></span>
                            <span class="text-gray-700 dark:text-gray-300" x-text="country.name"></span>
                            <span class="ml-auto text-gray-400 dark:text-gray-500 text-xs" x-text="country.code"></span>
                        </button>
                    </template>
                </div>
            </div>
        </div>

        {{-- Phone Number Input --}}
        <input
            type="tel"
            id="{{ $uniqueId }}"
            name="{{ $name }}"
            value="{{ $value }}"
            placeholder="{{ $placeholder }}"
            x-model="phoneNumber"
            @keydown="allowOnlyNumbers($event)"
            class="flex-1 {{ $sizeClass }} rounded-lg border transition-colors duration-200 focus:outline-none focus:ring-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 {{ $error ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 dark:border-gray-600 focus:ring-blue-500' }} {{ $disabled ? 'opacity-60 cursor-not-allowed' : '' }}"
            {{ $required ? 'required' : '' }}
            {{ $disabled ? 'disabled' : '' }}
        />

        {{-- Full phone number (hidden) --}}
        <input type="hidden" name="{{ $name }}_full" :value="selectedCountry.code + phoneNumber">
    </div>

    @if($error)
        <p class="text-sm text-red-500">{{ $error }}</p>
    @endif
</div>