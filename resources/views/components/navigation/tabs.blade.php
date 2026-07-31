{{-- Komponen Tabs Advanced dengan Animation, Icon, Badge, Vertical --}}
@props([
    'tabs' => [],           // [['label' => 'Tab 1', 'content' => '...', 'icon' => '🏠', 'badge' => 3], ...]
    'activeTab' => 0,
    'variant' => 'underline', // underline, pills
    'direction' => 'horizontal', // horizontal, vertical
    'color' => 'blue',       // blue, green, purple, red, orange
    'fullWidth' => false,
    'animation' => 'fade',   // fade, slide, none
    'contentPadding' => true,
])

@php
    $colors = [
        'blue' => ['active' => 'border-blue-500 text-blue-600 dark:text-blue-400', 'bg' => 'bg-blue-500', 'badge' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300', 'pill' => 'bg-blue-500 text-white'],
        'green' => ['active' => 'border-green-500 text-green-600 dark:text-green-400', 'bg' => 'bg-green-500', 'badge' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300', 'pill' => 'bg-green-500 text-white'],
        'purple' => ['active' => 'border-purple-500 text-purple-600 dark:text-purple-400', 'bg' => 'bg-purple-500', 'badge' => 'bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-300', 'pill' => 'bg-purple-500 text-white'],
        'red' => ['active' => 'border-red-500 text-red-600 dark:text-red-400', 'bg' => 'bg-red-500', 'badge' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300', 'pill' => 'bg-red-500 text-white'],
        'orange' => ['active' => 'border-orange-500 text-orange-600 dark:text-orange-400', 'bg' => 'bg-orange-500', 'badge' => 'bg-orange-100 text-orange-700 dark:bg-orange-900/30 dark:text-orange-300', 'pill' => 'bg-orange-500 text-white'],
    ];
    $c = $colors[$color] ?? $colors['blue'];
    $isVertical = $direction === 'vertical';
    $isPills = $variant === 'pills';
    $animations = ['fade' => 'x-transition:enter', 'slide' => 'x-transition:enter-start', 'none' => ''];
@endphp

<div x-data="{ active: {{ $activeTab }} }"
    role="tablist"
    aria-orientation="{{ $isVertical ? 'vertical' : 'horizontal' }}"
    class="{{ $isVertical ? 'flex gap-6' : 'space-y-4' }}">

    {{-- Tab Navigation --}}
    <div class="{{ $isVertical
        ? 'flex flex-col w-48 flex-shrink-0 border-r border-gray-200 dark:border-gray-700 pr-4 space-y-1'
        : 'flex border-b border-gray-200 dark:border-gray-700 gap-1 overflow-x-auto'
    }}">
        @foreach($tabs as $index => $tab)
            @php
                $hasBadge = isset($tab['badge']) && $tab['badge'] !== null;
                $badge = $tab['badge'] ?? 0;
            @endphp
            <button
                @click="active = {{ $index }}"
                role="tab"
                :aria-selected="active === {{ $index }} ? 'true' : 'false'"
                aria-controls="tab-panel-{{ $index }}"
                id="tab-{{ $index }}"
                class="group relative whitespace-nowrap transition-all duration-200 flex items-center gap-2
                    {{ $isPills
                        ? 'px-4 py-2 rounded-lg text-sm font-medium ' . ($index == $activeTab ? $c['pill'] : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700')
                        : 'pb-3 px-4 font-medium text-sm ' . ($index == $activeTab ? $c['active'] . ' border-b-2' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-300 border-b-2 border-transparent')
                    }}
                    {{ $fullWidth && !$isVertical ? 'flex-1 justify-center' : '' }}"
                :class="{
                    @if($isPills)
                        '{{ $c['pill'] }}': active === {{ $index }},
                        'text-gray-600 dark:text-gray-400': active !== {{ $index }}
                    @else
                        '{{ $c['active'] }} border-b-2': active === {{ $index }},
                        'text-gray-600 dark:text-gray-400 border-b-2 border-transparent': active !== {{ $index }}
                    @endif
                }"
            >
                {{-- Icon --}}
                @if(isset($tab['icon']))
                    <span class="text-base">{{ $tab['icon'] }}</span>
                @endif

                {{-- Label --}}
                <span>{{ $tab['label'] }}</span>

                {{-- Badge --}}
                @if($hasBadge)
                    <span class="inline-flex items-center justify-center min-w-[20px] h-5 px-1.5 text-[10px] font-bold rounded-full transition-colors
                        {{ $index == $activeTab ? $c['badge'] : 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400' }}"
                        :class="{
                            '{{ $c['badge'] }}': active === {{ $index }},
                            'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400': active !== {{ $index }}
                        }"
                    >
                        {{ $badge > 99 ? '99+' : $badge }}
                    </span>
                @endif
            </button>
        @endforeach
    </div>

    {{-- Tab Content --}}
    <div class="{{ $isVertical ? 'flex-1 min-w-0' : '' }} {{ $contentPadding ? 'pt-2' : '' }}">
        @foreach($tabs as $index => $tab)
            <div
                x-show="active === {{ $index }}"
                role="tabpanel"
                aria-labelledby="tab-{{ $index }}"
                id="tab-panel-{{ $index }}"
                @if($animation === 'fade')
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform translate-y-2"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform translate-y-2"
                @elseif($animation === 'slide')
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform -translate-x-4"
                    x-transition:enter-end="opacity-100 transform translate-x-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 transform translate-x-0"
                    x-transition:leave-end="opacity-0 transform translate-x-4"
                @endif
                class="text-gray-700 dark:text-gray-300"
            >
                {!! $tab['content'] ?? '' !!}
            </div>
        @endforeach
    </div>
</div>