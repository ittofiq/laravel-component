{{-- Komponen Tag Cloud — kumpulan tag sebagai pill link --}}
@props([
    'tags' => [],   // [['label' => 'Laravel', 'href' => '#'], ...] atau ['Laravel', 'Tailwind', ...]
])

<div class="flex flex-wrap gap-2">
    @forelse($tags as $tag)
        @php
            $label = is_array($tag) ? ($tag['label'] ?? '') : $tag;
            $href = is_array($tag) ? ($tag['href'] ?? '#') : '#';
        @endphp
        @if($label !== '')
            <a href="{{ $href }}" class="px-3 py-1 text-xs font-medium bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 rounded-full hover:bg-blue-100 dark:hover:bg-blue-900/30 hover:text-blue-700 dark:hover:text-blue-300 transition-colors">{{ $label }}</a>
        @endif
    @empty
        <p class="text-sm text-gray-400 dark:text-gray-500">Tidak ada tag.</p>
    @endforelse
</div>