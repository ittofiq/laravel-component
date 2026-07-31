{{-- Komponen Toast Notification dengan Alpine.js --}}
@props([
    'type' => 'info',
    'message' => null,
    'position' => 'top-right',
    'duration' => 5000,
    'show' => true,
    'dismissible' => true,
])

@php
    $typeConfig = [
        'success' => [
            'bg' => 'bg-green-50 dark:bg-green-900/30',
            'border' => 'border-green-300 dark:border-green-700',
            'text' => 'text-green-800 dark:text-green-200',
            'icon' => '✅',
            'progressBar' => 'bg-green-500',
        ],
        'error' => [
            'bg' => 'bg-red-50 dark:bg-red-900/30',
            'border' => 'border-red-300 dark:border-red-700',
            'text' => 'text-red-800 dark:text-red-200',
            'icon' => '❌',
            'progressBar' => 'bg-red-500',
        ],
        'warning' => [
            'bg' => 'bg-yellow-50 dark:bg-yellow-900/30',
            'border' => 'border-yellow-300 dark:border-yellow-700',
            'text' => 'text-yellow-800 dark:text-yellow-200',
            'icon' => '⚠️',
            'progressBar' => 'bg-yellow-500',
        ],
        'info' => [
            'bg' => 'bg-blue-50 dark:bg-blue-900/30',
            'border' => 'border-blue-300 dark:border-blue-700',
            'text' => 'text-blue-800 dark:text-blue-200',
            'icon' => 'ℹ️',
            'progressBar' => 'bg-blue-500',
        ],
    ];

    $config = $typeConfig[$type] ?? $typeConfig['info'];

    $positionClasses = [
        'top-right' => 'top-4 right-4',
        'top-left' => 'top-4 left-4',
        'bottom-right' => 'bottom-4 right-4',
        'bottom-left' => 'bottom-4 left-4',
        'top-center' => 'top-4 left-1/2 -translate-x-1/2',
        'bottom-center' => 'bottom-4 left-1/2 -translate-x-1/2',
    ];

    $posClass = $positionClasses[$position] ?? $positionClasses['top-right'];

    $enterTransition = [
        'top-right' => 'translate-x-full',
        'top-left' => '-translate-x-full',
        'bottom-right' => 'translate-x-full',
        'bottom-left' => '-translate-x-full',
        'top-center' => '-translate-y-full',
        'bottom-center' => 'translate-y-full',
    ];

    $enterFrom = $enterTransition[$position] ?? 'translate-x-full';
@endphp

<div
    x-data="toastComponent({{ $show ? 'true' : 'false' }}, {{ $duration }})"
    @@show-toast-{{ $attributes->get('id') }}.window="show()"
    @@hide-toast-{{ $attributes->get('id') }}.window="dismiss()"
    x-show="visible"
    x-transition:enter="transition-all duration-500 ease-out"
    x-transition:enter-start="opacity-0 {{ $enterFrom }}"
    x-transition:enter-end="opacity-100 translate-x-0 translate-y-0"
    x-transition:leave="transition-all duration-500 ease-in"
    x-transition:leave-start="opacity-100 translate-x-0 translate-y-0"
    x-transition:leave-end="opacity-0 {{ $enterFrom }}"
    x-cloak
    class="fixed {{ $posClass }} z-[9999] max-w-sm w-full"
>
    <div class="flex items-start gap-3 p-4 rounded-lg border shadow-lg {{ $config['bg'] }} {{ $config['border'] }} {{ $config['text'] }}" role="alert">
        {{-- Icon --}}
        <span class="text-lg flex-shrink-0 leading-none mt-0.5">{{ $config['icon'] }}</span>

        {{-- Content --}}
        <div class="flex-1 min-w-0">
            @if($message)
                <p class="text-sm font-medium">{{ $message }}</p>
            @endif
            @if($slot->isNotEmpty())
                <div class="text-sm">{{ $slot }}</div>
            @endif
        </div>

        {{-- Close Button --}}
        @if($dismissible)
            <button
                @click="dismiss"
                type="button"
                class="flex-shrink-0 opacity-60 hover:opacity-100 transition-opacity focus:outline-none"
                aria-label="Tutup notifikasi"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        @endif

        {{-- Progress Bar untuk Auto-Dismiss --}}
        <div class="absolute bottom-0 left-0 right-0 h-1 rounded-b overflow-hidden">
            <div
                class="h-full {{ $config['progressBar'] }} transition-all ease-linear"
                :style="'width: ' + progressPercent + '%'"
            ></div>
        </div>
    </div>
</div>

