{{-- Komponen Popover dengan Tailwind CSS --}}
@props([
    'title' => null,
    'text' => '',
    'position' => 'top',
])

<div class="relative group inline-block">
    {{-- Trigger --}}
    <span class="cursor-pointer underline decoration-dotted underline-offset-4 text-blue-500 dark:text-blue-400">
        {{ $slot }}
    </span>

    {{-- Popover Content --}}
    <div class="absolute hidden group-hover:block z-10 w-64
        {{ $position === 'top' ? 'bottom-full mb-3' : ($position === 'bottom' ? 'top-full mt-3' : 'left-full ml-3') }}
        left-1/2 -translate-x-1/2">
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg p-4">
            @if($title)
                <h4 class="font-semibold text-gray-900 dark:text-white mb-1">{{ $title }}</h4>
            @endif
            @if($text)
                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $text }}</p>
            @endif
            @if(!$title && !$text && $slot->isNotEmpty())
                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $slot }}</p>
            @endif
        </div>
        {{-- Arrow --}}
        @if($position === 'top')
            <div class="absolute top-full left-1/2 -translate-x-1/2 -mt-px border-8 border-transparent border-t-white dark:border-t-gray-800"></div>
        @endif
    </div>
</div>