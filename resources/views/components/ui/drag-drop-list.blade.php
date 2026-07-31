{{-- Komponen Drag & Drop List - Reorderable items --}}
@props([
    'items' => [],
    'sortable' => true,
])

@php
    $itemsJson = json_encode($items);
    if (empty($items)) return;
@endphp

<div x-data='dragDropList({!! $itemsJson !!})' class="space-y-1">
    <template x-for="(item, index) in items" :key="item.id">
        <div
            draggable="{{ $sortable ? 'true' : 'false' }}"
            @dragstart="dragStart($event, index)"
            @dragover.prevent="dragOver($event, index)"
            @dragenter.prevent="dragEnter($event, index)"
            @dragleave="dragLeave($event, index)"
            @drop="drop($event, index)"
            @dragend="dragEnd"
            class="flex items-center gap-3 px-4 py-3 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm cursor-grab active:cursor-grabbing transition-all select-none"
            :class="{
                'opacity-50': draggingIndex === index,
                'border-blue-400 dark:border-blue-500 bg-blue-50 dark:bg-blue-900/20 scale-[1.02]': dragOverIndex === index,
            }"
        >
            {{-- Drag Handle --}}
            <div class="flex-shrink-0 text-gray-400 dark:text-gray-500 cursor-grab">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M7 2a2 2 0 1 0 0 4 2 2 0 0 0 0-4zM13 2a2 2 0 1 0 0 4 2 2 0 0 0 0-4zM7 8a2 2 0 1 0 0 4 2 2 0 0 0 0-4zM13 8a2 2 0 1 0 0 4 2 2 0 0 0 0-4zM7 14a2 2 0 1 0 0 4 2 2 0 0 0 0-4zM13 14a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/>
                </svg>
            </div>

            {{-- Item Content --}}
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-gray-900 dark:text-white truncate" x-text="item.label"></p>
                <p x-show="item.description" class="text-xs text-gray-500 dark:text-gray-400 truncate" x-text="item.description"></p>
            </div>

            {{-- Index Badge --}}
            <span class="flex-shrink-0 text-xs text-gray-400 dark:text-gray-500 font-mono" x-text="'#' + (index + 1)"></span>
        </div>
    </template>

    {{-- Empty state --}}
    <div x-show="items.length === 0" class="px-4 py-8 text-center text-sm text-gray-400 dark:text-gray-500">
        No items to display
    </div>
</div>