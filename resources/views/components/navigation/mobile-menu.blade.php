{{-- Komponen Mobile Menu dengan Multi-level, FAB, User Info --}}
@props([
    'items' => [],
    'activeItem' => null,
    'userName' => null,
    'userAvatar' => null,
    'position' => 'bottom-right', // bottom-right, bottom-left
])

@php
    $fabPositions = [
        'bottom-right' => 'bottom-6 right-6',
        'bottom-left' => 'bottom-6 left-6',
    ];
    $panelPositions = [
        'bottom-right' => 'bottom-24 right-6',
        'bottom-left' => 'bottom-24 left-6',
    ];
    $fabPos = $fabPositions[$position] ?? 'bottom-6 right-6';
    $panelPos = $panelPositions[$position] ?? 'bottom-24 right-6';
@endphp

<div x-data="{ open: false, subOpen: null }" class="md:hidden">
    {{-- FAB Toggle Button --}}
    <button
        @click="open = !open"
        class="fixed {{ $fabPos }} w-14 h-14 rounded-full bg-blue-500 text-white shadow-lg flex items-center justify-center z-50 hover:bg-blue-600 transition-all hover:scale-110"
        aria-label="Toggle menu"
    >
        <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
        <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>

    {{-- Overlay --}}
    <div x-show="open" @click="open = false" class="fixed inset-0 bg-black/50 z-40"
        x-transition:enter="transition-opacity duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
    ></div>

    {{-- Menu Panel --}}
    <nav x-show="open" @click.outside="open = false"
        class="fixed {{ $panelPos }} w-72 max-h-[70vh] bg-white dark:bg-gray-800 rounded-xl shadow-2xl border border-gray-200 dark:border-gray-700 overflow-hidden z-50 flex flex-col"
        x-transition:enter="transition-all duration-300 ease-out" x-transition:enter-start="opacity-0 translate-y-4 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition-all duration-200 ease-in" x-transition:leave-start="opacity-100 translate-y-0 scale-100" x-transition:leave-end="opacity-0 translate-y-4 scale-95"
    >
        {{-- User Info Header --}}
        @if($userName)
            <div class="px-5 py-4 border-b border-gray-100 dark:border-gray-700 flex items-center gap-3">
                @if($userAvatar)
                    <img src="{{ $userAvatar }}" alt="{{ $userName }}" class="w-10 h-10 rounded-full object-cover" />
                @else
                    <div class="w-10 h-10 rounded-full bg-blue-500 text-white flex items-center justify-center text-sm font-bold">{{ strtoupper(substr($userName, 0, 2)) }}</div>
                @endif
                <div>
                    <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $userName }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">View Profile</p>
                </div>
            </div>
        @endif

        {{-- Menu Items --}}
        <div class="p-2 space-y-0.5 overflow-y-auto">
            @foreach($items as $item)
                @php
                    $hasChildren = isset($item['children']) && count($item['children']) > 0;
                    $itemId = $item['id'] ?? uniqid();
                    $isActive = $activeItem === $itemId;
                @endphp

                @if($hasChildren)
                    <div>
                        <button @click="subOpen = subOpen === '{{ $itemId }}' ? null : '{{ $itemId }}'"
                            class="w-full flex items-center gap-3 px-4 py-3 rounded-lg transition-colors text-sm {{ $isActive ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 font-medium' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                            @if(isset($item['icon'])) <span class="text-lg flex-shrink-0">{{ $item['icon'] }}</span> @endif
                            <span class="flex-1 text-left">{{ $item['label'] }}</span>
                            <svg class="w-4 h-4 text-gray-400 transition-transform" :class="subOpen === '{{ $itemId }}' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="subOpen === '{{ $itemId }}'" x-collapse class="ml-4 pl-3 border-l border-gray-200 dark:border-gray-700 space-y-0.5">
                            @foreach($item['children'] as $child)
                                @php $childId = $child['id'] ?? uniqid(); @endphp
                                <a href="{{ $child['href'] ?? '#' }}" @click="open = false" class="flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm transition-colors {{ ($activeItem === $childId) ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 font-medium' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                                    @if(isset($child['icon'])) <span class="text-sm">{{ $child['icon'] }}</span> @endif
                                    <span>{{ $child['label'] }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @else
                    <a href="{{ $item['href'] ?? '#' }}" @click="open = false"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors text-sm {{ $isActive ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 font-medium' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                        @if(isset($item['icon'])) <span class="text-lg flex-shrink-0">{{ $item['icon'] }}</span> @endif
                        <span>{{ $item['label'] }}</span>
                    </a>
                @endif
            @endforeach
        </div>

        {{-- Footer --}}
        <div class="px-4 py-3 border-t border-gray-100 dark:border-gray-700">
            <p class="text-xs text-gray-400 dark:text-gray-500 text-center">v5.1 • {{ count($items) }} menu</p>
        </div>
    </nav>
</div>