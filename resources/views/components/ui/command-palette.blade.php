{{-- Komponen Command Palette - Cmd+K Modal Search --}}
@props([
    'items' => [],
    'placeholder' => 'Search commands...',
    'emptyText' => 'No results found.',
])

@php
    $itemsJson = json_encode($items);
@endphp

<div
    x-data='commandPalette({!! $itemsJson !!})'
    @keydown.cmd.k.window.prevent="open = true"
    @keydown.ctrl.k.window.prevent="open = true"
    @keydown.escape.window="open = false"
>
    {{-- Overlay --}}
    <div
        x-show="open"
        @click="open = false"
        aria-hidden="true"
        x-transition:enter="transition-opacity duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        class="fixed inset-0 bg-black/50 z-[9999]"
        style="display: none;"
    ></div>

    {{-- Palette --}}
    <div
        x-show="open"
        @click.outside="open = false"
        role="dialog"
        aria-modal="true"
        aria-label="Command palette"
        x-transition:enter="transition-all duration-200 ease-out"
        x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        class="fixed top-[20%] left-1/2 -translate-x-1/2 w-full max-w-lg z-[10000]"
        style="display: none;"
    >
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl border border-gray-200 dark:border-gray-700 overflow-hidden">
            {{-- Search Input --}}
            <div class="flex items-center gap-3 px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input
                    type="text"
                    x-model="query"
                    @input="filter"
                    x-ref="searchInput"
                    role="combobox"
                    aria-expanded="true"
                    aria-autocomplete="list"
                    aria-controls="command-palette-list"
                    aria-activedescendant="cp-item-0"
                    x-init="$watch('open', val => { if (val) { query = ''; filter(); $nextTick(() => $refs.searchInput.focus()); } })"
                    placeholder="{{ $placeholder }}"
                    class="flex-1 bg-transparent border-none outline-none text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 text-sm"
                />
                <kbd class="hidden sm:inline-flex items-center px-1.5 py-0.5 rounded text-xs text-gray-400 dark:text-gray-500 bg-gray-100 dark:bg-gray-700 font-mono" x-text="isMac ? '⌘K' : 'Ctrl+K'"></kbd>
            </div>

            {{-- Results --}}
            <div class="max-h-80 overflow-y-auto" role="listbox" id="command-palette-list">
                <template x-for="(item, index) in filteredItems" :key="item.id">
                    <div
                        @click="select(item); open = false"
                        @mouseenter="highlighted = index"
                        role="option"
                        :aria-selected="highlighted === index ? 'true' : 'false'"
                        :id="'cp-item-' + index"
                        class="flex items-center gap-3 px-4 py-3 cursor-pointer transition-colors text-sm"
                        :class="{
                            'bg-blue-50 dark:bg-blue-900/30': highlighted === index,
                            '': highlighted !== index
                        }"
                    >
                        {{-- Icon --}}
                        <span class="flex-shrink-0 w-8 h-8 rounded-lg flex items-center justify-center text-base"
                            :class="item.color === 'blue' ? 'bg-blue-100 dark:bg-blue-900/30' : (item.color === 'green' ? 'bg-green-100 dark:bg-green-900/30' : (item.color === 'red' ? 'bg-red-100 dark:bg-red-900/30' : (item.color === 'purple' ? 'bg-purple-100 dark:bg-purple-900/30' : 'bg-gray-100 dark:bg-gray-700')))"
                            x-text="item.icon || '➤'"
                        ></span>

                        {{-- Content --}}
                        <div class="flex-1 min-w-0">
                            <p class="font-medium text-gray-900 dark:text-white truncate" x-text="item.label"></p>
                            <p x-show="item.description" class="text-xs text-gray-500 dark:text-gray-400 truncate" x-text="item.description"></p>
                        </div>

                        {{-- Shortcut --}}
                        <span x-show="item.shortcut" class="text-xs text-gray-400 dark:text-gray-500 font-mono" x-text="item.shortcut"></span>
                    </div>
                </template>

                {{-- Empty --}}
                <div x-show="filteredItems.length === 0" class="px-4 py-8 text-center text-sm text-gray-400 dark:text-gray-500">
                    <p>{{ $emptyText }}</p>
                </div>
            </div>

            {{-- Footer --}}
            <div class="flex items-center gap-4 px-4 py-2.5 border-t border-gray-200 dark:border-gray-700 text-xs text-gray-400 dark:text-gray-500">
                <span class="flex items-center gap-1">
                    <kbd class="px-1.5 py-0.5 rounded bg-gray-100 dark:bg-gray-700 font-mono">↑↓</kbd> Navigate
                </span>
                <span class="flex items-center gap-1">
                    <kbd class="px-1.5 py-0.5 rounded bg-gray-100 dark:bg-gray-700 font-mono">↵</kbd> Select
                </span>
                <span class="flex items-center gap-1">
                    <kbd class="px-1.5 py-0.5 rounded bg-gray-100 dark:bg-gray-700 font-mono">Esc</kbd> Close
                </span>
                <span class="flex items-center gap-1 ml-auto">
                    <kbd class="px-1.5 py-0.5 rounded bg-gray-100 dark:bg-gray-700 font-mono" x-text="isMac ? '⌘K' : 'Ctrl+K'"></kbd> Open
                </span>
            </div>
        </div>
    </div>
</div>