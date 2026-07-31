{{-- Dropdown Item --}}
@props([
    'href' => '#',
    'icon' => null,
    'type' => 'link',      // link, divider, header, submenu
    'disabled' => false,
    'shortcut' => null,
    'danger' => false,
])

@if($type === 'divider')
    <div class="my-1 border-t border-gray-200 dark:border-gray-700"></div>
@elseif($type === 'header')
    <p class="px-4 py-1.5 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
        {{ $slot }}
    </p>
@elseif($type === 'submenu')
    {{-- Submenu Item --}}
    <div
        class="relative"
        x-data="{ subOpen: false }"
        @mouseenter="subOpen = true"
        @mouseleave="subOpen = false"
    >
        <button
            @click="subOpen = !subOpen"
            class="w-full flex items-center gap-3 px-4 py-2.5 text-sm transition-colors text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer"
        >
            @if($icon) <span class="text-base flex-shrink-0 w-4 text-center">{{ $icon }}</span> @endif
            <span class="flex-1 text-left">{{ $slot }}</span>
            <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </button>

        {{-- Submenu Panel --}}
        <div
            x-show="subOpen"
            x-transition:enter="transition-all duration-200 ease-out"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition-all duration-150 ease-in"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="absolute left-full top-0 ml-1 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 z-50 py-1.5"
            x-cloak
        >
            {{ $submenu ?? '' }}
        </div>
    </div>
@else
    <a
        href="{{ $disabled ? '#' : $href }}"
        class="flex items-center gap-3 px-4 py-2.5 text-sm transition-colors
            {{ $disabled
                ? 'text-gray-400 dark:text-gray-500 cursor-not-allowed'
                : ($danger ? 'text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/30' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700')
            }} cursor-pointer"
        {{ $disabled ? 'onclick="return false"' : '' }}
    >
        @if($icon) <span class="text-base flex-shrink-0 w-4 text-center">{{ $icon }}</span> @endif
        <span class="flex-1">{{ $slot }}</span>
        @if($shortcut)
            <kbd class="text-[10px] text-gray-400 dark:text-gray-500 font-mono ml-4">{{ $shortcut }}</kbd>
        @endif
    </a>
@endif