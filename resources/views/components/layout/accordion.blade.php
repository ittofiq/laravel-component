{{-- Komponen Accordion dengan Tailwind CSS --}}
@props([
    'items' => [],
])

<div class="space-y-2">
    @foreach($items as $index => $item)
        <div x-data="{ open: false }" class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden">
            <button
                @click="open = !open"
                :aria-expanded="open.toString()"
                aria-controls="accordion-panel-{{ $index }}"
                id="accordion-header-{{ $index }}"
                class="w-full px-6 py-4 flex items-center justify-between bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors"
            >
                <span class="font-semibold text-gray-900 dark:text-white">{{ $item['title'] }}</span>
                <svg class="w-5 h-5 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
            </button>
            <div
                x-show="open"
                role="region"
                aria-labelledby="accordion-header-{{ $index }}"
                id="accordion-panel-{{ $index }}"
                :aria-hidden="(!open).toString()"
                x-transition:enter="transition-all duration-300 ease-out"
                x-transition:enter-start="opacity-0 max-h-0 py-0"
                x-transition:enter-end="opacity-100 max-h-96 py-4"
                x-transition:leave="transition-all duration-200 ease-in"
                x-transition:leave-start="opacity-100 max-h-96 py-4"
                x-transition:leave-end="opacity-0 max-h-0 py-0"
                class="overflow-hidden px-6 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300"
            >
                {{ $item['content'] }}
            </div>
        </div>
    @endforeach
</div>
