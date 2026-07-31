{{-- Komponen Alert dengan Dismissible, Icon, Actions, Link --}}
@props([
    'type' => 'info',        // info, success, warning, danger
    'title' => null,
    'dismissible' => false,
    'icon' => null,           // Custom icon (override default)
    'link' => null,           // Link URL
    'linkText' => 'Learn more',
])

@php
    $types = [
        'info' => [
            'bg' => 'bg-blue-50 dark:bg-blue-900/20',
            'border' => 'border-blue-200 dark:border-blue-700',
            'icon' => '💙',
            'text' => 'text-blue-800 dark:text-blue-300',
            'btn' => 'bg-blue-500 hover:bg-blue-600',
            'link' => 'text-blue-700 dark:text-blue-300 hover:underline',
        ],
        'success' => [
            'bg' => 'bg-green-50 dark:bg-green-900/20',
            'border' => 'border-green-200 dark:border-green-700',
            'icon' => '✅',
            'text' => 'text-green-800 dark:text-green-300',
            'btn' => 'bg-green-500 hover:bg-green-600',
            'link' => 'text-green-700 dark:text-green-300 hover:underline',
        ],
        'warning' => [
            'bg' => 'bg-yellow-50 dark:bg-yellow-900/20',
            'border' => 'border-yellow-200 dark:border-yellow-700',
            'icon' => '⚠️',
            'text' => 'text-yellow-800 dark:text-yellow-300',
            'btn' => 'bg-yellow-500 hover:bg-yellow-600',
            'link' => 'text-yellow-700 dark:text-yellow-300 hover:underline',
        ],
        'danger' => [
            'bg' => 'bg-red-50 dark:bg-red-900/20',
            'border' => 'border-red-200 dark:border-red-700',
            'icon' => '❌',
            'text' => 'text-red-800 dark:text-red-300',
            'btn' => 'bg-red-500 hover:bg-red-600',
            'link' => 'text-red-700 dark:text-red-300 hover:underline',
        ],
    ];
    $style = $types[$type] ?? $types['info'];
    $displayIcon = $icon ?? $style['icon'];
    $hasActions = isset($actions) && !$actions->isEmpty();
@endphp

<div
    x-data="{ dismissed: false }"
    x-show="!dismissed"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="flex items-start gap-3 p-4 rounded-lg border {{ $style['bg'] }} {{ $style['border'] }} {{ $style['text'] }}"
    role="alert"
>
    {{-- Icon --}}
    <span class="text-lg flex-shrink-0 mt-0.5">{{ $displayIcon }}</span>

    {{-- Content --}}
    <div class="flex-1 min-w-0">
        @if($title)
            <h4 class="font-semibold text-sm mb-1">{{ $title }}</h4>
        @endif
        <div class="text-sm">{{ $slot }}</div>

        {{-- Actions + Link --}}
        @if($hasActions || $link)
            <div class="flex items-center gap-3 mt-3">
                @if($hasActions)
                    <div class="flex items-center gap-2">
                        {{ $actions }}
                    </div>
                @endif
                @if($link)
                    <a href="{{ $link }}" class="text-sm font-medium {{ $style['link'] }}">{{ $linkText }} →</a>
                @endif
            </div>
        @endif
    </div>

    {{-- Dismiss --}}
    @if($dismissible)
        <button @click="dismissed = true" class="flex-shrink-0 p-1 rounded-lg opacity-60 hover:opacity-100 hover:bg-black/5 dark:hover:bg-white/5 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    @endif
</div>