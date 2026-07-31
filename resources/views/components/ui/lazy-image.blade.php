{{-- Komponen Lazy Image dengan Skeleton Placeholder + Fade In --}}
@props([
    'src' => '',
    'alt' => '',
    'class' => '',
    'ratio' => '16/9',
    'rounded' => 'rounded-lg',
])

@php
    $ratioClass = match ($ratio) {
        '1/1' => 'aspect-square',
        '4/3' => 'aspect-[4/3]',
        '16/9' => 'aspect-video',
        '21/9' => 'aspect-[21/9]',
        default => 'aspect-video',
    };
@endphp

<div
    x-data="{ loaded: false, error: false }"
    class="relative overflow-hidden {{ $rounded }} bg-gray-200 dark:bg-gray-700 {{ $ratioClass }}"
>
    {{-- Skeleton Placeholder (pulse) --}}
    <div x-show="!loaded && !error" class="absolute inset-0 animate-pulse flex items-center justify-center">
        <svg class="w-12 h-12 text-gray-300 dark:text-gray-600" fill="currentColor" viewBox="0 0 20 18">
            <path d="M18 0H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm4.376 10.481A1 1 0 0 1 16 15H4a1 1 0 0 1-.895-1.447l3.5-7A1 1 0 0 1 7.468 6a.965.965 0 0 1 .9.5l2.775 4.757 1.546-1.887a1 1 0 0 1 1.618.1l2.541 4a1 1 0 0 1 .028 1.011Z"/>
        </svg>
    </div>

    {{-- Error State --}}
    <div x-show="error" class="absolute inset-0 flex items-center justify-center bg-gray-100 dark:bg-gray-800">
        <div class="text-center">
            <svg class="w-10 h-10 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            <p class="text-xs text-gray-400">Failed to load</p>
        </div>
    </div>

    {{-- Image --}}
    <img
        src="{{ $src }}"
        alt="{{ $alt }}"
        loading="lazy"
        @load="loaded = true"
        @@error="error = true"
        x-show="loaded"
        x-transition:enter="transition-opacity duration-500"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        class="w-full h-full object-cover {{ $rounded }}"
        style="display: none;"
    />
</div>