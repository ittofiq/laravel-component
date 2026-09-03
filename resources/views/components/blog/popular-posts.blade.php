{{-- Komponen Popular Posts — daftar artikel populer/terbaru dengan thumbnail --}}
@props([
    'posts' => [],   // [['title' => '...', 'date' => '...', 'image' => null, 'href' => '#'], ...]
])

<div class="space-y-4">
    @forelse($posts as $post)
        <a href="{{ $post['href'] ?? '#' }}" class="flex items-center gap-3 group">
            @if(isset($post['image']) && $post['image'])
                <img src="{{ $post['image'] }}" alt="{{ $post['title'] }}" class="w-14 h-14 rounded-lg object-cover flex-shrink-0" />
            @else
                <div class="w-14 h-14 rounded-lg bg-gray-100 dark:bg-gray-700 flex items-center justify-center text-lg flex-shrink-0">📄</div>
            @endif
            <div class="min-w-0">
                <p class="text-sm font-medium text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors line-clamp-2 leading-snug">{{ $post['title'] }}</p>
                @if(isset($post['date']) && $post['date'])
                    <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">{{ $post['date'] }}</p>
                @endif
            </div>
        </a>
    @empty
        <p class="text-sm text-gray-400 dark:text-gray-500">Tidak ada artikel.</p>
    @endforelse
</div>