{{-- Komponen Post — wrapper artikel detail (gambar, judul, meta, isi, tags) --}}
@props([
    'title' => '',
    'image' => null,
    'category' => null,
    'categoryColor' => 'blue',
    'author' => null,
    'authorAvatar' => null,
    'date' => null,
    'readTime' => null,
    'views' => null,
    'tags' => [],
])

@php
    $categoryColors = [
        'blue' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300',
        'green' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300',
        'purple' => 'bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-300',
        'red' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300',
        'orange' => 'bg-orange-100 text-orange-700 dark:bg-orange-900/30 dark:text-orange-300',
    ];
    $categoryColorClass = $categoryColors[$categoryColor] ?? $categoryColors['blue'];
@endphp

<article class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
    {{-- Featured image --}}
    @if($image)
        <img src="{{ $image }}" alt="{{ $title }}" class="w-full aspect-[21/9] object-cover" />
    @endif

    <div class="p-6 lg:p-8">
        {{-- Category --}}
        @if($category)
            <span class="inline-block px-2.5 py-0.5 text-xs font-semibold rounded-full {{ $categoryColorClass }}">{{ $category }}</span>
        @endif

        {{-- Title --}}
        <h1 class="text-2xl lg:text-3xl font-bold text-gray-900 dark:text-white mt-3 leading-tight">{{ $title }}</h1>

        {{-- Meta --}}
        @if($author || $date || $readTime)
            <div class="mt-5 pb-5 border-b border-gray-100 dark:border-gray-700">
                <x-blog.article-meta
                    :author="$author"
                    :authorAvatar="$authorAvatar"
                    :date="$date"
                    :readTime="$readTime"
                    :views="$views"
                />
            </div>
        @endif

        {{-- Isi artikel --}}
        <div class="mt-6 space-y-4 text-gray-700 dark:text-gray-300 leading-relaxed">
            {{ $slot }}
        </div>

        {{-- Tags --}}
        @if(!empty($tags))
            <div class="mt-8 pt-5 border-t border-gray-100 dark:border-gray-700">
                <x-blog.tag-cloud :tags="$tags" />
            </div>
        @endif
    </div>
</article>