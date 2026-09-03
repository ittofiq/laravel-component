{{-- Komponen Article Card — kartu artikel untuk blog/berita --}}
@props([
    'title' => '',
    'excerpt' => null,
    'image' => null,
    'category' => null,
    'categoryColor' => 'blue',   // blue, green, purple, red, orange
    'author' => null,
    'authorAvatar' => null,
    'date' => null,
    'readTime' => null,
    'views' => null,
    'href' => '#',
])

@php
    $categoryColors = [
        'blue' => 'text-blue-600 dark:text-blue-400',
        'green' => 'text-green-600 dark:text-green-400',
        'purple' => 'text-purple-600 dark:text-purple-400',
        'red' => 'text-red-600 dark:text-red-400',
        'orange' => 'text-orange-600 dark:text-orange-400',
    ];
    $categoryColorClass = $categoryColors[$categoryColor] ?? $categoryColors['blue'];
@endphp

<article class="group flex flex-col bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-lg transition-shadow h-full">
    {{-- Image --}}
    @if($image)
        <a href="{{ $href }}" class="block aspect-[16/9] overflow-hidden bg-gray-100 dark:bg-gray-700">
            <img src="{{ $image }}" alt="{{ $title }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
        </a>
    @endif

    <div class="flex flex-col flex-1 p-5">
        {{-- Category + Read time --}}
        @if($category || $readTime)
            <div class="flex items-center gap-2 text-xs mb-2">
                @if($category)
                    <span class="font-semibold {{ $categoryColorClass }}">{{ $category }}</span>
                @endif
                @if($readTime)
                    <span class="text-gray-400 dark:text-gray-500">· {{ $readTime }} menit baca</span>
                @endif
            </div>
        @endif

        {{-- Title --}}
        <a href="{{ $href }}">
            <h3 class="font-bold text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors leading-snug">
                {{ $title }}
            </h3>
        </a>

        {{-- Excerpt --}}
        @if($excerpt)
            <p class="mt-1.5 text-sm text-gray-500 dark:text-gray-400 line-clamp-2">{{ $excerpt }}</p>
        @endif

        {{-- Author + Date --}}
        @if($author || $date)
            <div class="flex items-center gap-2.5 mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                @if($authorAvatar)
                    <img src="{{ $authorAvatar }}" alt="{{ $author }}" class="w-7 h-7 rounded-full object-cover flex-shrink-0" />
                @elseif($author)
                    <div class="w-7 h-7 rounded-full bg-blue-500 text-white flex items-center justify-center text-xs font-bold flex-shrink-0">{{ strtoupper(substr($author, 0, 2)) }}</div>
                @endif
                <div class="text-xs min-w-0 truncate">
                    @if($author)
                        <span class="text-gray-700 dark:text-gray-300 font-medium">{{ $author }}</span>
                    @endif
                    @if($date)
                        <span class="text-gray-400 dark:text-gray-500">· {{ $date }}</span>
                    @endif
                    @if($views)
                        <span class="text-gray-400 dark:text-gray-500">· 👁️ {{ $views }}</span>
                    @endif
                </div>
            </div>
        @endif
    </div>
</article>