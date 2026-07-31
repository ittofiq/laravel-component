{{-- Komponen Context Menu - Right-click custom menu --}}
@props([
    'items' => [],
])

@php
    $itemsJson = json_encode($items);
    if (empty($items)) return;
@endphp

<div
    x-data='contextMenu({!! $itemsJson !!})'
    @contextmenu.prevent="openMenu($event)"
    @click.outside="show = false"
    @keydown.escape="show = false"
    class="relative inline-block"
>
    {{ $slot }}

    {{-- Context Menu --}}
    <div
        x-show="show"
        role="menu"
        aria-label="Context menu"
        aria-orientation="vertical"
        x-transition:enter="transition-all duration-150 ease-out"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition-all duration-100 ease-in"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="fixed z-[9999] w-56 bg-white dark:bg-gray-800 rounded-lg shadow-xl border border-gray-200 dark:border-gray-700 py-1.5"
        :style="'top: ' + y + 'px; left: ' + x + 'px'"
        style="display: none;"
    >
        <template x-for="(item, index) in items" :key="index">
            <div>
                {{-- Divider --}}
                <div x-show="item.divider" role="separator" class="my-1.5 border-t border-gray-200 dark:border-gray-700"></div>

                {{-- Item --}}
                <button
                    x-show="!item.divider"
                    role="menuitem"
                    @click="handleClick(item); show = false"
                    class="w-full flex items-center gap-3 px-4 py-2.5 text-sm transition-colors text-left"
                    :class="{
                        'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700': !item.danger,
                        'text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20': item.danger
                    }"
                >
                    <span x-show="item.icon" class="flex-shrink-0 w-5 text-center text-base" x-text="item.icon"></span>
                    <span class="flex-1" x-text="item.label"></span>
                    <span x-show="item.shortcut" class="text-xs text-gray-400 dark:text-gray-500 font-mono flex-shrink-0" x-text="item.shortcut"></span>
                </button>
            </div>
        </template>
    </div>
</div>