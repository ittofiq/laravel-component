{{-- Komponen Timeline Vertikal dengan Icons --}}
@props([
    'items' => [],
])

@php $colors = ['blue', 'green', 'purple', 'orange', 'red', 'teal', 'pink', 'indigo']; @endphp

<div class="relative pl-8">
    {{-- Single Vertical Line --}}
    <div class="absolute left-[11px] top-2 bottom-2 w-0.5 bg-gray-200 dark:bg-gray-700"></div>

    @foreach($items as $index => $item)
        @php
            $colorKey = $item['color'] ?? $colors[$index % count($colors)];
            $bgMap = ['blue'=>'bg-blue-500','green'=>'bg-green-500','purple'=>'bg-purple-500','orange'=>'bg-orange-500','red'=>'bg-red-500','teal'=>'bg-teal-500','pink'=>'bg-pink-500','indigo'=>'bg-indigo-500'];
            $bgClass = $bgMap[$colorKey] ?? 'bg-blue-500';
        @endphp

        <div class="relative {{ $index < count($items) - 1 ? 'pb-8' : '' }}">
            {{-- Icon Circle on the line --}}
            <div class="absolute -left-8 top-0 z-10 w-[22px] h-[22px] rounded-full {{ $bgClass }} flex items-center justify-center text-white shadow ring-4 ring-white dark:ring-gray-900">
                @if(isset($item['icon']))
                    <span class="text-xs">{{ $item['icon'] }}</span>
                @else
                    <span class="text-[10px] font-bold">{{ $index + 1 }}</span>
                @endif
            </div>

            {{-- Content Card --}}
            <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4 shadow-sm hover:shadow-md transition-shadow">
                @if(isset($item['date']))
                    <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-medium {{ $bgClass }} text-white mb-2">
                        {{ $item['date'] }}
                    </span>
                @endif
                <h3 class="font-semibold text-gray-900 dark:text-white">{{ $item['title'] }}</h3>
                @if(isset($item['content']))
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1.5">{{ $item['content'] }}</p>
                @endif
            </div>
        </div>
    @endforeach
</div>