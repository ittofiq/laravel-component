{{-- Komponen Search Input dengan Tailwind CSS --}}
@props([
    'name' => 'search',
    'placeholder' => 'Cari...',
    'suggestions' => [],
])

<div
    x-data="{ open: false, search: '', results: [] }"
    @click.outside="open = false"
    class="relative"
>
    <div class="relative">
        <input
            type="text"
            x-model="search"
            @focus="open = true"
            @input="open = true"
            name="{{ $name }}"
            placeholder="{{ $placeholder }}"
            {{ $attributes->merge(['class' => 'w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500']) }}
        />
        <svg class="absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
    </div>

    @if(count($suggestions) > 0)
        <div
            x-show="open && search.length > 0"
            x-transition
            class="absolute top-full left-0 right-0 mt-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg shadow-lg z-10"
        >
            @foreach($suggestions as $suggestion)
                <button
                    type="button"
                    @click="search = '{{ $suggestion }}'; open = false"
                    class="w-full text-left px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-600 text-gray-900 dark:text-white transition-colors border-b border-gray-200 dark:border-gray-600 last:border-b-0"
                >
                    {{ $suggestion }}
                </button>
            @endforeach
        </div>
    @endif
</div>
