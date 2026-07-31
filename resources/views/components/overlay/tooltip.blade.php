{{-- Komponen Tooltip dengan Positioning, Arrow, Delay --}}
@props([
    'text' => '',
    'position' => 'top',   // top, bottom, left, right
    'delay' => 300,         // Delay in ms before showing
    'hideDelay' => 100,     // Delay in ms before hiding
    'arrow' => true,
])

@php
    $positions = [
        'top' => [
            'panel' => 'bottom-full left-1/2 -translate-x-1/2 mb-2',
            'arrow' => 'top-full left-1/2 -translate-x-1/2 border-4 border-transparent border-t-gray-900 dark:border-t-gray-100',
        ],
        'bottom' => [
            'panel' => 'top-full left-1/2 -translate-x-1/2 mt-2',
            'arrow' => 'bottom-full left-1/2 -translate-x-1/2 border-4 border-transparent border-b-gray-900 dark:border-b-gray-100',
        ],
        'left' => [
            'panel' => 'right-full top-1/2 -translate-y-1/2 mr-2',
            'arrow' => 'left-full top-1/2 -translate-y-1/2 border-4 border-transparent border-l-gray-900 dark:border-l-gray-100',
        ],
        'right' => [
            'panel' => 'left-full top-1/2 -translate-y-1/2 ml-2',
            'arrow' => 'right-full top-1/2 -translate-y-1/2 border-4 border-transparent border-r-gray-900 dark:border-r-gray-100',
        ],
    ];
    $pos = $positions[$position] ?? $positions['top'];
@endphp

<div
    class="relative inline-block"
    x-data="{
        show: false,
        showTimer: null,
        hideTimer: null,

        onEnter() {
            clearTimeout(this.hideTimer);
            this.showTimer = setTimeout(() => { this.show = true; }, {{ $delay }});
        },
        onLeave() {
            clearTimeout(this.showTimer);
            this.hideTimer = setTimeout(() => { this.show = false; }, {{ $hideDelay }});
        }
    }"
    @mouseenter="onEnter()"
    @mouseleave="onLeave()"
    @focusin="onEnter()"
    @focusout="onLeave()"
>
    {{ $slot }}

    {{-- Tooltip Panel --}}
    <div
        x-show="show"
        x-cloak
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="absolute z-50 {{ $pos['panel'] }}"
    >
        <div class="bg-gray-900 dark:bg-gray-100 text-white dark:text-gray-900 text-xs font-medium rounded-lg px-3 py-1.5 whitespace-nowrap shadow-lg">
            {{ $text }}
        </div>
        @if($arrow)
            <div class="absolute {{ $pos['arrow'] }}"></div>
        @endif
    </div>
</div>