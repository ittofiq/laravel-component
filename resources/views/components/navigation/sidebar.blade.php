{{-- Komponen Sidebar dengan Multi-level, Collapsible, Tooltip --}}
@props([
    'items' => [],
    'activeItem' => null,
    'collapsed' => false,
])

<div x-data="{ collapsed: {{ $collapsed ? 'true' : 'false' }} }" class="flex">
    <aside
        class="bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 min-h-screen transition-all duration-300 flex flex-col"
        :class="collapsed ? 'w-16' : 'w-64'"
    >
        {{-- Header --}}
        <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
            <h2 x-show="!collapsed" class="text-lg font-bold text-gray-900 dark:text-white truncate">Menu</h2>
            <button @click="collapsed = !collapsed"
                class="p-1.5 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-500 dark:text-gray-400 transition-colors flex-shrink-0"
                aria-label="Toggle sidebar">
                <svg class="w-5 h-5 transition-transform" :class="{ 'rotate-180': collapsed }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path>
                </svg>
            </button>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 p-2 space-y-0.5 overflow-y-auto">
            @foreach($items as $item)
                @php
                    $hasChildren = isset($item['children']) && count($item['children']) > 0;
                    $itemId = $item['id'] ?? uniqid();
                    $isActive = $activeItem === $itemId;
                @endphp

                @if($hasChildren)
                    {{-- Parent with children --}}
                    <div x-data="{ subOpen: {{ $isActive ? 'true' : 'false' }} }">
                        <button
                            @click="subOpen = !subOpen"
                            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700"
                            :class="collapsed ? 'justify-center' : ''"
                        >
                            @if(isset($item['icon']))
                                <span class="text-lg flex-shrink-0">{{ $item['icon'] }}</span>
                            @endif
                            <span x-show="!collapsed" class="flex-1 text-left truncate">{{ $item['label'] }}</span>
                            <svg x-show="!collapsed" class="w-3.5 h-3.5 text-gray-400 transition-transform" :class="subOpen ? 'rotate-90' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>

                        {{-- Children --}}
                        <div x-show="subOpen && !collapsed" x-collapse class="ml-4 pl-3 border-l border-gray-200 dark:border-gray-700 space-y-0.5 mt-0.5">
                            @foreach($item['children'] as $child)
                                @php $childId = $child['id'] ?? uniqid(); @endphp
                                @if(isset($child['children']) && count($child['children']) > 0)
                                    {{-- Level 2 with children --}}
                                    <div x-data="{ sub2Open: {{ $activeItem === $childId ? 'true' : 'false' }} }">
                                        <button @click="sub2Open = !sub2Open" class="w-full flex items-center gap-2 px-3 py-2 rounded-lg text-sm text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                            @if(isset($child['icon']))<span class="text-sm">{{ $child['icon'] }}</span>@endif
                                            <span class="flex-1 text-left truncate">{{ $child['label'] }}</span>
                                            <svg class="w-3 h-3 text-gray-400 transition-transform" :class="sub2Open ? 'rotate-90' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                        </button>
                                        <div x-show="sub2Open" x-collapse class="ml-3 pl-2 border-l border-gray-200 dark:border-gray-700 space-y-0.5">
                                            @foreach($child['children'] as $grandchild)
                                                <a href="{{ $grandchild['href'] ?? '#' }}" class="flex items-center gap-2 px-3 py-1.5 rounded-lg text-sm transition-colors {{ ($activeItem === ($grandchild['id'] ?? null)) ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 font-medium' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                                                    @if(isset($grandchild['icon']))<span class="text-xs">{{ $grandchild['icon'] }}</span>@endif
                                                    <span class="truncate">{{ $grandchild['label'] }}</span>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <a href="{{ $child['href'] ?? '#' }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm transition-colors {{ ($activeItem === $childId) ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 font-medium' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                                        @if(isset($child['icon']))<span class="text-sm">{{ $child['icon'] }}</span>@endif
                                        <span class="truncate">{{ $child['label'] }}</span>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @else
                    {{-- Single item --}}
                    <a href="{{ $item['href'] ?? '#' }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors text-sm group relative
                            {{ $isActive ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 font-medium' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }}"
                        :class="collapsed ? 'justify-center' : ''"
                    >
                        @if(isset($item['icon']))
                            <span class="text-lg flex-shrink-0">{{ $item['icon'] }}</span>
                        @endif
                        <span x-show="!collapsed" class="truncate">{{ $item['label'] }}</span>
                        <span x-show="collapsed" class="absolute left-full ml-2 px-2 py-1 bg-gray-900 dark:bg-gray-700 text-white text-xs rounded whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity z-50 pointer-events-none" x-text="'{{ $item['label'] }}'"></span>
                    </a>
                @endif
            @endforeach
        </nav>

        {{-- Footer --}}
        <div class="p-3 border-t border-gray-200 dark:border-gray-700">
            <p x-show="!collapsed" class="text-xs text-gray-400 dark:text-gray-500 text-center truncate">{{ count($items) }} menu items</p>
        </div>
    </aside>
</div>