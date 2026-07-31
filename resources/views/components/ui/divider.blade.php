{{-- Komponen Divider dengan Tailwind CSS --}}
@props([
    'direction' => 'horizontal',
    'text' => null,
])

@if($direction === 'horizontal')
    <div class="flex items-center gap-4 my-6">
        <div class="flex-1 border-t border-gray-300 dark:border-gray-600"></div>
        @if($text)
            <span class="text-sm text-gray-600 dark:text-gray-400 px-2">{{ $text }}</span>
        @endif
        <div class="flex-1 border-t border-gray-300 dark:border-gray-600"></div>
    </div>
@else
    <div class="border-l border-gray-300 dark:border-gray-600 h-full"></div>
@endif
