{{-- Komponen Countdown Timer dengan Alpine.js --}}
@props([
    'target' => null, // ISO date string e.g. '2026-12-31T23:59:59'
    'label' => null,
    'showDays' => true,
    'showHours' => true,
    'showMinutes' => true,
    'showSeconds' => true,
    'size' => 'md',
    'variant' => 'default', // default, minimal, boxes
])

@php
    $targetDate = $target ?? now()->addDays(7)->format('Y-m-d H:i:s');
    $targetTimestamp = strtotime($targetDate) * 1000;

    $sizeClasses = [
        'xs' => ['unit' => 'text-xl', 'label' => 'text-[10px]'],
        'sm' => ['unit' => 'text-2xl', 'label' => 'text-xs'],
        'md' => ['unit' => 'text-3xl', 'label' => 'text-sm'],
        'lg' => ['unit' => 'text-5xl', 'label' => 'text-base'],
        'xl' => ['unit' => 'text-6xl', 'label' => 'text-lg'],
    ];
    $size = $sizeClasses[$size] ?? $sizeClasses['md'];
@endphp

<div
    x-data="countdown({{ $targetTimestamp }})"
    x-init="start()"
    class="flex flex-col gap-3"
>
    @if($label)
        <p class="text-sm font-medium text-gray-600 dark:text-gray-400 text-center">{{ $label }}</p>
    @endif

    <div class="flex items-center justify-center gap-3 sm:gap-5">
        @if($showDays)
            <div class="flex flex-col items-center">
                <span class="{{ $size['unit'] }} font-bold text-gray-900 dark:text-white tabular-nums" x-text="days"></span>
                <span class="{{ $size['label'] }} text-gray-500 dark:text-gray-400 uppercase tracking-wider">Days</span>
            </div>
            @if($showHours || $showMinutes || $showSeconds)
                <span class="{{ $size['unit'] }} text-gray-300 dark:text-gray-600 font-light">:</span>
            @endif
        @endif

        @if($showHours)
            <div class="flex flex-col items-center">
                <span class="{{ $size['unit'] }} font-bold text-gray-900 dark:text-white tabular-nums" x-text="hours"></span>
                <span class="{{ $size['label'] }} text-gray-500 dark:text-gray-400 uppercase tracking-wider">Hrs</span>
            </div>
            @if($showMinutes || $showSeconds)
                <span class="{{ $size['unit'] }} text-gray-300 dark:text-gray-600 font-light">:</span>
            @endif
        @endif

        @if($showMinutes)
            <div class="flex flex-col items-center">
                <span class="{{ $size['unit'] }} font-bold text-gray-900 dark:text-white tabular-nums" x-text="minutes"></span>
                <span class="{{ $size['label'] }} text-gray-500 dark:text-gray-400 uppercase tracking-wider">Min</span>
            </div>
            @if($showSeconds)
                <span class="{{ $size['unit'] }} text-gray-300 dark:text-gray-600 font-light">:</span>
            @endif
        @endif

        @if($showSeconds)
            <div class="flex flex-col items-center">
                <span class="{{ $size['unit'] }} font-bold text-blue-500 dark:text-blue-400 tabular-nums" x-text="seconds"></span>
                <span class="{{ $size['label'] }} text-gray-500 dark:text-gray-400 uppercase tracking-wider">Sec</span>
            </div>
        @endif
    </div>

    {{-- Expired message --}}
    <div x-show="expired" class="text-center">
        <p class="text-lg font-bold text-green-500 dark:text-green-400">🎉 Time's up!</p>
    </div>
</div>

<script>
function countdown(targetTimestamp) {
    return {
        days: '00',
        hours: '00',
        minutes: '00',
        seconds: '00',
        expired: false,
        timer: null,

        start() {
            this.update();
            this.timer = setInterval(() => this.update(), 1000);
        },

        update() {
            const now = Date.now();
            const diff = targetTimestamp - now;

            if (diff <= 0) {
                this.days = '00';
                this.hours = '00';
                this.minutes = '00';
                this.seconds = '00';
                this.expired = true;
                this.stop();
                return;
            }

            this.days = String(Math.floor(diff / 86400000)).padStart(2, '0');
            this.hours = String(Math.floor((diff % 86400000) / 3600000)).padStart(2, '0');
            this.minutes = String(Math.floor((diff % 3600000) / 60000)).padStart(2, '0');
            this.seconds = String(Math.floor((diff % 60000) / 1000)).padStart(2, '0');
        },

        stop() {
            if (this.timer) {
                clearInterval(this.timer);
                this.timer = null;
            }
        }
    };
}
</script>