{{-- Komponen Avatar Group - Stacked avatars dengan overflow count --}}
@props([
    'avatars' => [],
    'max' => 5,
    'size' => 'md',
])

@php
    $total = count($avatars);
    if ($total === 0) return;

    $visible = array_slice($avatars, 0, $max);
    $overflow = $total - $max;

    $sizeClasses = [
        'xs' => 'w-6 h-6 text-[10px]',
        'sm' => 'w-7 h-7 text-xs',
        'md' => 'w-9 h-9 text-sm',
        'lg' => 'w-11 h-11 text-base',
        'xl' => 'w-14 h-14 text-lg',
    ];

    $overlapClasses = [
        'xs' => '-ml-1.5',
        'sm' => '-ml-2',
        'md' => '-ml-3',
        'lg' => '-ml-4',
        'xl' => '-ml-5',
    ];

    $sizeClass = $sizeClasses[$size] ?? $sizeClasses['md'];
    $overlapClass = $overlapClasses[$size] ?? $overlapClasses['md'];
@endphp

<div class="flex items-center">
    @foreach($visible as $index => $avatar)
        <div class="relative {{ $index > 0 ? $overlapClass : '' }} ring-2 ring-white dark:ring-gray-900 rounded-full {{ $sizeClass }} flex-shrink-0 transition-transform hover:scale-110 hover:z-10"
            style="z-index: {{ $max - $index }}"
        >
            @if(isset($avatar['src']) && $avatar['src'])
                <img src="{{ $avatar['src'] }}" alt="{{ $avatar['name'] ?? 'Avatar' }}" class="w-full h-full rounded-full object-cover" />
            @elseif(isset($avatar['initials']))
                <div class="w-full h-full rounded-full flex items-center justify-center font-bold text-white bg-blue-500">
                    {{ strtoupper($avatar['initials']) }}
                </div>
            @else
                <div class="w-full h-full rounded-full flex items-center justify-center font-bold text-white bg-gray-400 dark:bg-gray-600">
                    <svg class="w-1/2 h-1/2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
                </div>
            @endif
        </div>
    @endforeach

    @if($overflow > 0)
        <div class="relative {{ $overlapClass }} ring-2 ring-white dark:ring-gray-900 rounded-full {{ $sizeClass }} flex-shrink-0 bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-xs font-medium text-gray-600 dark:text-gray-400 transition-transform hover:scale-110 hover:z-10"
            style="z-index: 0;"
            title="{{ $overflow }} more">
            +{{ $overflow }}
        </div>
    @endif
</div>