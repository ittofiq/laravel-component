{{-- Komponen Range Slider dengan Alpine.js --}}
@props([
    'name' => null,
    'label' => null,
    'min' => 0,
    'max' => 100,
    'step' => 1,
    'value' => null,
    'values' => null, // [min, max] untuk dual handle
    'showValue' => true,
    'showMinMax' => false,
    'color' => 'blue',
    'disabled' => false,
])

@php
    $uniqueId = 'range-' . uniqid();
    $initialValue = $value ?? $min;
    $isDual = $values !== null;
    $initialMin = $isDual ? ($values[0] ?? $min) : $min;
    $initialMax = $isDual ? ($values[1] ?? $max) : $max;

    $colorClasses = [
        'blue' => ['track' => 'bg-blue-500', 'thumb' => 'accent-blue-500'],
        'green' => ['track' => 'bg-green-500', 'thumb' => 'accent-green-500'],
        'red' => ['track' => 'bg-red-500', 'thumb' => 'accent-red-500'],
        'purple' => ['track' => 'bg-purple-500', 'thumb' => 'accent-purple-500'],
    ];
    $selectedColor = $colorClasses[$color] ?? $colorClasses['blue'];
@endphp

<div class="flex flex-col gap-2" x-data="rangeSlider({{ $initialValue }}, {{ $min }}, {{ $max }}, {{ $step }}, {{ $isDual ? 'true' : 'false' }}, {{ $initialMin }}, {{ $initialMax }})">
    @if($label)
        <div class="flex justify-between items-center">
            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $label }}</label>
            @if($showValue)
                <span class="text-sm font-bold text-{{ $color === 'blue' ? 'blue' : $color }}-600 dark:text-{{ $color === 'blue' ? 'blue' : $color }}-400">
                    <span x-text="{{ $isDual ? 'minVal' : 'value' }}"></span>
                    @if($isDual)
                        <span> - </span>
                        <span x-text="maxVal"></span>
                    @endif
                </span>
            @endif
        </div>
    @endif

    <div class="relative">
        @if($isDual)
            {{-- Dual Handle --}}
            <div class="relative h-7 flex items-center">
                {{-- Background track --}}
                <div class="absolute w-full h-2 bg-gray-200 dark:bg-gray-600 rounded-full"></div>
                {{-- Active track --}}
                <div class="absolute h-2 rounded-full {{ $selectedColor['track'] }}" :style="'left: ' + ((minVal - {{ $min }}) / ({{ $max }} - {{ $min }}) * 100) + '%; right: ' + (100 - ((maxVal - {{ $min }}) / ({{ $max }} - {{ $min }}) * 100)) + '%'"></div>
                {{-- Min handle --}}
                <input type="range" x-ref="minHandle" @input="setMinVal($event)" min="{{ $min }}" max="{{ $max }}" step="{{ $step }}" class="absolute w-full h-2 appearance-none bg-transparent pointer-events-none z-[1] [&::-webkit-slider-thumb]:pointer-events-auto [&::-webkit-slider-thumb]:appearance-none [&::-webkit-slider-thumb]:w-6 [&::-webkit-slider-thumb]:h-6 [&::-webkit-slider-thumb]:rounded-full [&::-webkit-slider-thumb]:bg-blue-500 [&::-webkit-slider-thumb]:border-2 [&::-webkit-slider-thumb]:border-white [&::-webkit-slider-thumb]:shadow-md [&::-webkit-slider-thumb]:cursor-grab [&::-webkit-slider-thumb]:active:cursor-grabbing [&::-webkit-slider-thumb]:hover:scale-125 [&::-webkit-slider-thumb]:transition-transform [&::-moz-range-thumb]:pointer-events-auto [&::-moz-range-thumb]:appearance-none [&::-moz-range-thumb]:w-6 [&::-moz-range-thumb]:h-6 [&::-moz-range-thumb]:rounded-full [&::-moz-range-thumb]:bg-blue-500 [&::-moz-range-thumb]:border-2 [&::-moz-range-thumb]:border-white [&::-moz-range-thumb]:shadow-md [&::-moz-range-thumb]:cursor-grab" {{ $disabled ? 'disabled' : '' }}>
                {{-- Max handle --}}
                <input type="range" x-ref="maxHandle" @input="setMaxVal($event)" min="{{ $min }}" max="{{ $max }}" step="{{ $step }}" class="absolute w-full h-2 appearance-none bg-transparent pointer-events-none z-[2] [&::-webkit-slider-thumb]:pointer-events-auto [&::-webkit-slider-thumb]:appearance-none [&::-webkit-slider-thumb]:w-6 [&::-webkit-slider-thumb]:h-6 [&::-webkit-slider-thumb]:rounded-full [&::-webkit-slider-thumb]:bg-blue-500 [&::-webkit-slider-thumb]:border-2 [&::-webkit-slider-thumb]:border-white [&::-webkit-slider-thumb]:shadow-md [&::-webkit-slider-thumb]:cursor-grab [&::-webkit-slider-thumb]:active:cursor-grabbing [&::-webkit-slider-thumb]:hover:scale-125 [&::-webkit-slider-thumb]:transition-transform [&::-moz-range-thumb]:pointer-events-auto [&::-moz-range-thumb]:appearance-none [&::-moz-range-thumb]:w-6 [&::-moz-range-thumb]:h-6 [&::-moz-range-thumb]:rounded-full [&::-moz-range-thumb]:bg-blue-500 [&::-moz-range-thumb]:border-2 [&::-moz-range-thumb]:border-white [&::-moz-range-thumb]:shadow-md [&::-moz-range-thumb]:cursor-grab" {{ $disabled ? 'disabled' : '' }}>
            </div>
            <input type="hidden" name="{{ $name }}_min" :value="minVal">
            <input type="hidden" name="{{ $name }}_max" :value="maxVal">
        @else
            {{-- Single Handle --}}
            <div class="relative">
                <input
                    type="range"
                    x-model="value"
                    min="{{ $min }}"
                    max="{{ $max }}"
                    step="{{ $step }}"
                    name="{{ $name }}"
                    class="w-full h-2 bg-gray-200 dark:bg-gray-600 rounded-full appearance-none cursor-pointer accent-blue-500 [&::-webkit-slider-thumb]:w-5 [&::-webkit-slider-thumb]:h-5 [&::-webkit-slider-thumb]:rounded-full [&::-webkit-slider-thumb]:bg-white [&::-webkit-slider-thumb]:border-2 [&::-webkit-slider-thumb]:border-blue-500 [&::-webkit-slider-thumb]:shadow [&::-webkit-slider-thumb]:cursor-pointer"
                    {{ $disabled ? 'disabled' : '' }}
                />
                {{-- Tick marks --}}
                @if($showMinMax)
                    <div class="flex justify-between text-xs text-gray-400 dark:text-gray-500 mt-1">
                        <span>{{ $min }}</span>
                        <span>{{ $max }}</span>
                    </div>
                @endif
            </div>
        @endif
    </div>
</div>

