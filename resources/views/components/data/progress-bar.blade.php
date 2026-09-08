{{-- Komponen Progress Bar dengan Tailwind CSS --}}
@props([
    'percent' => 0,
    'showLabel' => true,
    'color' => 'blue',
    'size' => 'md',
    'striped' => false,
    'animated' => false,
    'labelInside' => false,
])

@php
    $clampedPercent = max(0, min(100, (int) $percent));

    $sizeClasses = [
        'xs' => 'h-1',
        'sm' => 'h-1.5',
        'md' => 'h-2.5',
        'lg' => 'h-4',
        'xl' => 'h-6',
    ];

    $colorClasses = [
        'blue' => 'bg-blue-500',
        'green' => 'bg-green-500',
        'red' => 'bg-red-500',
        'yellow' => 'bg-yellow-500',
        'purple' => 'bg-purple-500',
        'indigo' => 'bg-indigo-500',
        'pink' => 'bg-pink-500',
    ];

    $sizeClass = $sizeClasses[$size] ?? $sizeClasses['md'];
    $colorClass = $colorClasses[$color] ?? $colorClasses['blue'];

    // Stripe pattern
    $stripeClass = ($striped || $animated)
        ? 'bg-[length:20px_20px] [background-image:linear-gradient(45deg,rgba(255,255,255,0.15)_25%,transparent_25%,transparent_50%,rgba(255,255,255,0.15)_50%,rgba(255,255,255,0.15)_75%,transparent_75%,transparent)]'
        : '';

    $animClass = $animated ? 'animate-[progress-stripes_1s_linear_infinite]' : '';
@endphp

<div class="w-full">
    @if($showLabel && !$labelInside)
        <div class="flex justify-between items-center mb-1.5">
            <span class="text-xs font-medium text-gray-600 dark:text-gray-400">{{ $clampedPercent }}%</span>
        </div>
    @endif

    <div class="w-full {{ $sizeClass }} bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden relative">
        <div class="h-full rounded-full transition-all duration-500 {{ $colorClass }} {{ $stripeClass }} {{ $animClass }}"
            style="width: {{ $clampedPercent }}%"
            role="progressbar"
            aria-valuenow="{{ $clampedPercent }}"
            aria-valuemin="0"
            aria-valuemax="100"
        >
            @if($showLabel && $labelInside && $size === 'lg')
                <span class="absolute inset-0 flex items-center justify-center text-xs font-bold text-white drop-shadow">{{ $clampedPercent }}%</span>
            @endif
        </div>
    </div>

    @if($showLabel && !$labelInside)
        <div class="flex justify-between items-center mt-1.5">
            <span class="text-xs text-gray-500 dark:text-gray-400">{{ $clampedPercent }}% complete</span>
        </div>
    @endif
</div>

<style>
@keyframes progress-stripes {
    from { background-position: 20px 0; }
    to { background-position: 0 0; }
}
</style>