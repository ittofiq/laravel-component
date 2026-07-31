{{-- Komponen Scroll to Top --}}
@props([
    'color' => 'blue',
    'position' => 'bottom-right',
    'showAt' => 300,
])

@php
    $colorClasses = [
        'blue' => 'bg-blue-500 hover:bg-blue-600',
        'gray' => 'bg-gray-600 hover:bg-gray-700',
        'green' => 'bg-green-500 hover:bg-green-600',
        'purple' => 'bg-purple-500 hover:bg-purple-600',
    ];

    $posClasses = [
        'bottom-right' => 'bottom-6 right-6',
        'bottom-left' => 'bottom-6 left-6',
    ];

    $colorClass = $colorClasses[$color] ?? $colorClasses['blue'];
    $posClass = $posClasses[$position] ?? $posClasses['bottom-right'];
@endphp

<button
    x-data="{ show: false }"
    x-init="window.addEventListener('scroll', () => { show = window.scrollY > {{ $showAt }} })"
    x-show="show"
    @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
    x-transition:enter="transition-all duration-300 ease-out"
    x-transition:enter-start="opacity-0 translate-y-4 scale-75"
    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
    x-transition:leave="transition-all duration-200 ease-in"
    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
    x-transition:leave-end="opacity-0 translate-y-4 scale-75"
    class="fixed {{ $posClass }} z-[9997] w-10 h-10 rounded-full {{ $colorClass }} text-white shadow-lg flex items-center justify-center transition-colors"
    aria-label="Scroll to top"
    title="Back to top"
    style="display: none;"
>
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 15l7-7 7 7"/>
    </svg>
</button>