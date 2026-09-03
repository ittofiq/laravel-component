{{-- Komponen Related Posts — artikel terkait dalam grid article-card --}}
@props([
    'title' => 'Artikel Terkait',
    'posts' => [],   // array untuk x-blog.article-card
])

@if(!empty($posts))
    <div>
        @if($title)
            <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-4">{{ $title }}</h2>
        @endif
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($posts as $post)
                <x-blog.article-card
                    :title="$post['title'] ?? ''"
                    :excerpt="$post['excerpt'] ?? null"
                    :image="$post['image'] ?? null"
                    :category="$post['category'] ?? null"
                    :categoryColor="$post['categoryColor'] ?? 'blue'"
                    :author="$post['author'] ?? null"
                    :date="$post['date'] ?? null"
                    :readTime="$post['readTime'] ?? null"
                    :href="$post['href'] ?? '#'"
                />
            @endforeach
        </div>
    </div>
@endif