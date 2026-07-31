{{-- Komponen Tree View - Unlimited recursive levels --}}
@props([
    'items' => [],
    'icon' => '📁',
    'openIcon' => '📂',
    'fileIcon' => '📄',
])

@php
    $treeJson = json_encode($items);
    if (empty($items)) return;
@endphp

<div x-data='treeView({!! $treeJson !!})' class="space-y-0">
    <template x-for="node in flatNodes" :key="node.id">
        <div>
            <div
                @click="toggle(node)"
                class="flex items-center gap-2 px-3 py-2 rounded-lg cursor-pointer select-none transition-colors hover:bg-gray-100 dark:hover:bg-gray-700 text-sm"
                :style="'padding-left: ' + (node.depth * 24 + 12) + 'px'"
            >
                {{-- Arrow --}}
                <svg
                    x-show="node.children && node.children.length > 0"
                    class="w-4 h-4 text-gray-400 transition-transform duration-200 flex-shrink-0"
                    :class="{ 'rotate-90': node.expanded }"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span x-show="!node.children || node.children.length === 0" class="w-4 flex-shrink-0"></span>

                {{-- Icon --}}
                <span class="flex-shrink-0 text-base" x-text="node.children && node.children.length > 0 ? (node.expanded ? '{{ $openIcon }}' : '{{ $icon }}') : '{{ $fileIcon }}'"></span>

                {{-- Label --}}
                <span class="flex-1 truncate" x-text="node.label" :class="node.depth === 0 ? 'text-gray-700 dark:text-gray-300 font-medium' : (node.children && node.children.length > 0 ? 'text-gray-600 dark:text-gray-400' : 'text-gray-500 dark:text-gray-500')"></span>

                {{-- Badge --}}
                <span x-show="node.children && node.children.length > 0" class="text-xs text-gray-400 dark:text-gray-500" x-text="node.children ? node.children.length : 0"></span>
            </div>
        </div>
    </template>
</div>