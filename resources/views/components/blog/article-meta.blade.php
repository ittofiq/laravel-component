{{-- Komponen Article Meta — baris info penulis/tanggal/waktu baca untuk header artikel --}}
@props([
    'author' => null,
    'authorAvatar' => null,
    'date' => null,
    'readTime' => null,
    'views' => null,
    'category' => null,
    'categoryColor' => 'blue',
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

<div class="flex flex-wrap items-center gap-x-4 gap-y-2 text-sm text-gray-500 dark:text-gray-400">
    @if($category)
        <span class="inline-block px-2.5 py-0.5 text-xs font-semibold rounded-full {{ $categoryColorClass }}">{{ $category }}</span>
    @endif

    @if($author)
        <div class="flex items-center gap-2">
            @if($authorAvatar)
                <img src="{{ $authorAvatar }}" alt="{{ $author }}" class="w-8 h-8 rounded-full object-cover" />
            @else
                <div class="w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center text-xs font-bold">{{ strtoupper(substr($author, 0, 2)) }}</div>
            @endif
            <span class="font-medium text-gray-700 dark:text-gray-300">{{ $author }}</span>
        </div>
    @endif

    @if($date)
        <span class="flex items-center gap-1">📅 {{ $date }}</span>
    @endif

    @if($readTime)
        <span class="flex items-center gap-1">⏱️ {{ $readTime }} menit baca</span>
    @endif

    @if($views)
        <span class="flex items-center gap-1">👁️ {{ $views }} kali dibaca</span>
    @endif
</div>