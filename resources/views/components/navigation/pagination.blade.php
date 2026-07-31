{{-- Komponen Pagination dengan Ellipsis, Page Numbers, Per-page Selector --}}
@props([
    'current' => 1,
    'total' => 10,
    'perPage' => 10,
    'perPageOptions' => [10, 25, 50, 100],
    'showPerPage' => false,
    'showInfo' => true,
    'showFirstLast' => true,
    'url' => null,
])

@php
    $totalPages = max(1, (int) ceil($total / $perPage));
    $current = max(1, min($current, $totalPages));

    $getUrl = function($page) use ($url) {
        if ($url) return str_replace('{page}', $page, $url);
        return '?page=' . $page;
    };

    $pages = [];
    if ($totalPages <= 7) {
        $pages = range(1, $totalPages);
    } else {
        $pages[] = 1;
        if ($current > 3) $pages[] = '...';
        for ($i = max(2, $current - 1); $i <= min($totalPages - 1, $current + 1); $i++) {
            $pages[] = $i;
        }
        if ($current < $totalPages - 2) $pages[] = '...';
        $pages[] = $totalPages;
    }

    $from = (($current - 1) * $perPage) + 1;
    $to = min($current * $perPage, $total);
@endphp

<div class="flex flex-col sm:flex-row items-center justify-between gap-4">
    {{-- Left: Info --}}
    <div class="flex items-center gap-4">
        @if($showInfo)
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Showing <span class="font-medium text-gray-700 dark:text-gray-300">{{ $from }}–{{ $to }}</span> of <span class="font-medium text-gray-700 dark:text-gray-300">{{ $total }}</span>
            </p>
        @endif
    </div>

    {{-- Center: Page Numbers --}}
    <nav class="flex items-center gap-1" aria-label="Pagination">
        {{-- First --}}
        @if($showFirstLast)
            <a href="{{ $current > 1 ? $getUrl(1) : '#' }}"
                class="px-2 py-2 rounded-lg border text-sm transition-colors
                    {{ $current > 1 ? 'border-gray-300 dark:border-gray-600 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700' : 'border-gray-200 dark:border-gray-700 text-gray-300 dark:text-gray-600 cursor-not-allowed' }}"
                {{ $current <= 1 ? 'onclick="return false" aria-disabled="true"' : '' }}
                title="First page"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/></svg>
            </a>
        @endif

        {{-- Previous --}}
        <a href="{{ $current > 1 ? $getUrl($current - 1) : '#' }}"
            class="px-3 py-2 rounded-lg border text-sm transition-colors
                {{ $current > 1 ? 'border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' : 'border-gray-200 dark:border-gray-700 text-gray-300 dark:text-gray-600 cursor-not-allowed' }}"
            {{ $current <= 1 ? 'onclick="return false" aria-disabled="true"' : '' }}
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>

        {{-- Page Numbers --}}
        @foreach($pages as $page)
            @if($page === '...')
                <span class="px-3 py-2 text-sm text-gray-400 dark:text-gray-500 select-none">…</span>
            @else
                <a href="{{ $page == $current ? '#' : $getUrl($page) }}"
                    class="min-w-[36px] text-center px-3 py-2 rounded-lg text-sm font-medium transition-colors
                        {{ $page == $current ? 'bg-blue-500 text-white' : 'border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }}"
                    {{ $page == $current ? 'aria-current="page"' : '' }}
                >{{ $page }}</a>
            @endif
        @endforeach

        {{-- Next --}}
        <a href="{{ $current < $totalPages ? $getUrl($current + 1) : '#' }}"
            class="px-3 py-2 rounded-lg border text-sm transition-colors
                {{ $current < $totalPages ? 'border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' : 'border-gray-200 dark:border-gray-700 text-gray-300 dark:text-gray-600 cursor-not-allowed' }}"
            {{ $current >= $totalPages ? 'onclick="return false" aria-disabled="true"' : '' }}
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>

        {{-- Last --}}
        @if($showFirstLast)
            <a href="{{ $current < $totalPages ? $getUrl($totalPages) : '#' }}"
                class="px-2 py-2 rounded-lg border text-sm transition-colors
                    {{ $current < $totalPages ? 'border-gray-300 dark:border-gray-600 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700' : 'border-gray-200 dark:border-gray-700 text-gray-300 dark:text-gray-600 cursor-not-allowed' }}"
                {{ $current >= $totalPages ? 'onclick="return false" aria-disabled="true"' : '' }}
                title="Last page"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"/></svg>
            </a>
        @endif
    </nav>

    {{-- Right: Per-page Selector --}}
    @if($showPerPage)
        <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
            <span>Rows per page:</span>
            <select onchange="window.location.href=this.value" class="px-2 py-1.5 text-sm rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 focus:ring-2 focus:ring-blue-500 outline-none">
                @foreach($perPageOptions as $option)
                    <option value="{{ $url ? str_replace(['{page}', '{perPage}'], [1, $option], $url) : '?page=1&perPage=' . $option }}" {{ $perPage == $option ? 'selected' : '' }}>{{ $option }}</option>
                @endforeach
            </select>
        </div>
    @endif
</div>