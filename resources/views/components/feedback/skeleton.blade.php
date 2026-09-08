{{-- Komponen Skeleton Loader dengan Tailwind CSS --}}
@props([
    'type' => 'text',
    'count' => 3,
    'width' => null,
    'height' => null,
    'size' => 'md',
])

@php
    // Base classes untuk semua skeleton
    $baseClass = 'animate-pulse bg-gray-200 dark:bg-gray-700 rounded';

    // Size presets
    $sizes = [
        'xs' => ['text_h' => 'h-2', 'text_w' => 'w-full', 'circle' => 'w-6 h-6', 'image_w' => 'w-full', 'image_h' => 'h-24'],
        'sm' => ['text_h' => 'h-3', 'text_w' => 'w-full', 'circle' => 'w-8 h-8', 'image_w' => 'w-full', 'image_h' => 'h-32'],
        'md' => ['text_h' => 'h-4', 'text_w' => 'w-full', 'circle' => 'w-12 h-12', 'image_w' => 'w-full', 'image_h' => 'h-48'],
        'lg' => ['text_h' => 'h-5', 'text_w' => 'w-full', 'circle' => 'w-16 h-16', 'image_w' => 'w-full', 'image_h' => 'h-64'],
        'xl' => ['text_h' => 'h-6', 'text_w' => 'w-full', 'circle' => 'w-20 h-20', 'image_w' => 'w-full', 'image_h' => 'h-80'],
    ];

    $sizeConfig = $sizes[$size] ?? $sizes['md'];
@endphp

@if($type === 'text')
    {{-- Text Skeleton: baris-baris teks --}}
    <div class="space-y-2 {{ $attributes->get('class') }}">
        @for($i = 0; $i < $count; $i++)
            <div class="{{ $baseClass }} {{ $width ? '' : $sizeConfig['text_w'] }} {{ $height ?: $sizeConfig['text_h'] }}"
                style="{{ $width ? 'width: ' . (is_numeric($width) ? $width . 'px' : $width) . ';' : '' }}{{ $height ? 'height: ' . (is_numeric($height) ? $height . 'px' : $height) . ';' : '' }}"
            ></div>
        @endfor
    </div>

@elseif($type === 'image')
    {{-- Image Skeleton: placeholder gambar --}}
    <div class="{{ $baseClass }} flex items-center justify-center {{ $width ? '' : $sizeConfig['image_w'] }} {{ $height ?: $sizeConfig['image_h'] }}"
        style="{{ $width ? 'width: ' . (is_numeric($width) ? $width . 'px' : $width) . ';' : '' }}{{ $height ? 'height: ' . (is_numeric($height) ? $height . 'px' : $height) . ';' : '' }}"
    >
        <svg class="w-12 h-12 text-gray-300 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
            <path d="M18 0H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm4.376 10.481A1 1 0 0 1 16 15H4a1 1 0 0 1-.895-1.447l3.5-7A1 1 0 0 1 7.468 6a.965.965 0 0 1 .9.5l2.775 4.757 1.546-1.887a1 1 0 0 1 1.618.1l2.541 4a1 1 0 0 1 .028 1.011Z"/>
        </svg>
    </div>

@elseif($type === 'card')
    {{-- Card Skeleton: gabungan image + text --}}
    <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 overflow-hidden {{ $attributes->get('class') }}">
        {{-- Card Image --}}
        <div class="{{ $baseClass }} rounded-none {{ $width ? '' : 'w-full' }} {{ $height ?: 'h-40' }}"
            style="{{ $width ? 'width: ' . (is_numeric($width) ? $width . 'px' : $width) . ';' : '' }}{{ $height ? 'height: ' . (is_numeric($height) ? $height . 'px' : $height) . ';' : '' }}"
        ></div>

        {{-- Card Content --}}
        <div class="p-4 space-y-3">
            {{-- Title --}}
            <div class="{{ $baseClass }} h-5 w-3/4"></div>
            {{-- Text lines --}}
            @for($i = 0; $i < ($count > 2 ? $count - 1 : 1); $i++)
                <div class="{{ $baseClass }} h-3 {{ $i === 0 ? 'w-full' : ($i === 1 ? 'w-5/6' : 'w-2/3') }}"></div>
            @endfor
            {{-- Button placeholder --}}
            <div class="flex gap-2 pt-2">
                <div class="{{ $baseClass }} h-8 w-20 rounded-md"></div>
                <div class="{{ $baseClass }} h-8 w-20 rounded-md"></div>
            </div>
        </div>
    </div>

@elseif($type === 'circle')
    {{-- Circle Skeleton: untuk avatar, icon --}}
    <div class="{{ $baseClass }} rounded-full {{ $width ? '' : $sizeConfig['circle'] }}"
        style="{{ $width ? 'width: ' . (is_numeric($width) ? $width . 'px' : $width) . '; height: ' . (is_numeric($width) ? $width . 'px' : $width) . ';' : '' }}"
    ></div>

@elseif($type === 'table-row')
    {{-- Table Row Skeleton: untuk loading table --}}
    <div class="space-y-2 {{ $attributes->get('class') }}">
        @for($r = 0; $r < $count; $r++)
            <div class="flex gap-4 p-3">
                <div class="{{ $baseClass }} h-4 w-1/4"></div>
                <div class="{{ $baseClass }} h-4 w-1/3"></div>
                <div class="{{ $baseClass }} h-4 w-1/6"></div>
                <div class="{{ $baseClass }} h-4 w-1/5"></div>
            </div>
        @endfor
    </div>

@elseif($type === 'profile')
    {{-- Profile Skeleton: circle + text --}}
    <div class="flex items-center gap-3 {{ $attributes->get('class') }}">
        {{-- Avatar --}}
        <div class="{{ $baseClass }} rounded-full {{ $sizeConfig['circle'] }}"></div>
        {{-- Info --}}
        <div class="flex-1 space-y-2">
            <div class="{{ $baseClass }} h-4 w-1/3"></div>
            <div class="{{ $baseClass }} h-3 w-2/3"></div>
        </div>
    </div>

@elseif($type === 'paragraph')
    {{-- Paragraph Skeleton: beberapa baris text dengan lebar bervariasi --}}
    <div class="space-y-2 {{ $attributes->get('class') }}">
        @for($i = 0; $i < $count; $i++)
            <div class="{{ $baseClass }} {{ $height ?: $sizeConfig['text_h'] }}"
                style="width: {{ $i === $count - 1 ? '60%' : ($i === 0 ? '100%' : ($i % 2 === 0 ? '95%' : '85%')) }}; {{ $height ? 'height: ' . (is_numeric($height) ? $height . 'px' : $height) . ';' : '' }}"
            ></div>
        @endfor
    </div>
@endif