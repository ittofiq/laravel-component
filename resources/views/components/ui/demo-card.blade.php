{{-- Komponen Demo Card — pola seragam untuk tiap card di halaman demo: judul + copy + slot demo + Props API --}}
@props([
    'title' => '',
    'component' => null,   // nama komponen Blade, contoh: custom.loader (untuk snippet copy)
    'props' => [],         // [['name','type','default','description'], ...]
])

@php
    $snippet = $component ? '<x-' . $component . ' />' : null;
@endphp

<div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow component-card">
    <div class="flex items-center justify-between mb-4">
        <h3 class="font-bold text-gray-900 dark:text-white">{{ $title }}</h3>
        @if($snippet)
            <button
                type="button"
                onclick="copyCode(this)"
                data-code="{{ $snippet }}"
                class="px-2 py-1 text-xs bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 rounded hover:bg-gray-200 dark:hover:bg-gray-600 transition"
            >📋 Copy</button>
        @endif
    </div>

    <div class="space-y-3">
        {{ $slot }}
    </div>

    @if(!empty($props))
        <div x-data="{ apiOpen: false }" class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
            <button @click="apiOpen = !apiOpen" class="flex items-center gap-1.5 text-xs font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition">
                <span>📋</span>
                <span x-text="apiOpen ? 'Hide API' : 'Props API'">Props API</span>
                <svg class="w-3 h-3 transition-transform" :class="apiOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div x-show="apiOpen" x-collapse class="mt-3">
                <x-ui.props-table :props="$props" />
            </div>
        </div>
    @endif
</div>