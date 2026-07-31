{{-- Komponen Breadcrumb dengan Icon, Separator, Collapsible --}}
@props([
    'items' => [],
    'separator' => '/',       // /, →, ›, •, |, custom
    'homeIcon' => '🏠',
    'collapsible' => false,   // Collapse items when > 4
    'maxItems' => 4,           // Max items before collapsing
])

@php
    $separators = [
        '/' => '/',
        '→' => '→',
        '›' => '›',
        '•' => '•',
        '|' => '|',
        'chevron' => '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>',
        'slash' => '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7l10 10"/></svg>',
        'dot' => '<svg class="w-1.5 h-1.5" fill="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="12"/></svg>',
    ];
    $sep = $separators[$separator] ?? $separator;
    $total = count($items);
    $shouldCollapse = $collapsible && $total > $maxItems;
@endphp

<nav aria-label="Breadcrumb" class="flex items-center flex-wrap gap-1 text-sm">
    @if($shouldCollapse)
        {{-- First item --}}
        @php $first = $items[0]; @endphp
        <a href="{{ $first['href'] ?? '#' }}" class="flex items-center gap-1.5 text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
            @if(isset($first['icon'])) <span>{{ $first['icon'] }}</span> @else <span>{{ $homeIcon }}</span> @endif
            {{ $first['label'] }}
        </a>

        {{-- Separator --}}
        <span class="text-gray-400 dark:text-gray-500 select-none">{!! $sep !!}</span>

        {{-- Collapsed ellipsis --}}
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" class="px-1.5 py-0.5 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"/></svg>
            </button>
            <div x-show="open" x-cloak @click.outside="open = false" class="absolute top-full left-0 mt-1 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 py-1.5 z-50 min-w-[140px]">
                @foreach(array_slice($items, 1, $total - 2) as $item)
                    <a href="{{ $item['href'] ?? '#' }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                        @if(isset($item['icon'])) <span class="mr-1.5">{{ $item['icon'] }}</span> @endif
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </div>
        </div>

        {{-- Separator --}}
        <span class="text-gray-400 dark:text-gray-500 select-none">{!! $sep !!}</span>

        {{-- Last item --}}
        @php $last = $items[$total - 1]; @endphp
        <span class="flex items-center gap-1.5 text-gray-900 dark:text-white font-medium">
            @if(isset($last['icon'])) <span>{{ $last['icon'] }}</span> @endif
            {{ $last['label'] }}
        </span>
    @else
        {{-- Normal: Show all items --}}
        @foreach($items as $index => $item)
            @if($index > 0)
                <span class="text-gray-400 dark:text-gray-500 select-none">{!! $sep !!}</span>
            @endif

            @if(isset($item['href']) && $index < $total - 1)
                <a href="{{ $item['href'] }}" class="flex items-center gap-1.5 text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                    @if(isset($item['icon']))
                        <span>{{ $item['icon'] }}</span>
                    @elseif($index === 0)
                        <span>{{ $homeIcon }}</span>
                    @endif
                    {{ $item['label'] }}
                </a>
            @else
                <span class="flex items-center gap-1.5 {{ $index === $total - 1 ? 'text-gray-900 dark:text-white font-medium' : 'text-gray-500 dark:text-gray-400' }}">
                    @if(isset($item['icon']))
                        <span>{{ $item['icon'] }}</span>
                    @elseif($index === 0)
                        <span>{{ $homeIcon }}</span>
                    @endif
                    {{ $item['label'] }}
                </span>
            @endif
        @endforeach
    @endif
</nav>