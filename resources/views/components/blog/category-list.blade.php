{{-- Komponen Category List — daftar kategori + jumlah artikel --}}
@props([
    'categories' => [],   // [['name' => 'Web Development', 'count' => 12, 'href' => '#'], ...]
])

<ul class="space-y-2.5">
    @forelse($categories as $cat)
        <li>
            <a href="{{ $cat['href'] ?? '#' }}" class="flex items-center justify-between group text-sm text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                <span class="truncate">{{ $cat['name'] }}</span>
                <span class="text-xs bg-gray-100 dark:bg-gray-700 text-gray-500 dark:text-gray-400 px-2 py-0.5 rounded-full flex-shrink-0">{{ $cat['count'] ?? 0 }}</span>
            </a>
        </li>
    @empty
        <p class="text-sm text-gray-400 dark:text-gray-500">Tidak ada kategori.</p>
    @endforelse
</ul>