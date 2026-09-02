{{-- Shared Sidebar for Component Pages --}}
@php
    $categories = [
        'ui' => ['icon' => '🎨', 'label' => 'UI Components', 'count' => 24],
        'form' => ['icon' => '📝', 'label' => 'Form Components', 'count' => 27],
        'data' => ['icon' => '📊', 'label' => 'Data Components', 'count' => 9],
        'navigation' => ['icon' => '🧭', 'label' => 'Navigation', 'count' => 9],
        'overlay' => ['icon' => '🪟', 'label' => 'Overlay', 'count' => 8],
        'feedback' => ['icon' => '🔔', 'label' => 'Feedback', 'count' => 6],
        'layout' => ['icon' => '🏗️', 'label' => 'Layout', 'count' => 11],
        'custom' => ['icon' => '🎁', 'label' => 'Custom', 'count' => 8],
    ];
    $current = $currentCategory ?? null;
@endphp

<aside class="hidden lg:block w-56 flex-shrink-0">
    <div class="sticky top-0 pt-8 pb-4 pr-4 max-h-screen overflow-y-auto">
        <a href="{{ route('explorer') }}" class="block text-sm font-semibold mb-2 px-3 py-2 rounded-lg text-gray-900 dark:text-white bg-indigo-50 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300 hover:bg-indigo-100 dark:hover:bg-indigo-900/50 transition-colors">
            🧪 Component Explorer
        </a>
        <a href="{{ route('components') }}" class="block text-sm font-semibold text-gray-900 dark:text-white mb-4 uppercase tracking-wider hover:text-blue-500 transition-colors">
            ← Semua Kategori
        </a>
        <nav class="space-y-0.5">
            @foreach($categories as $key => $cat)
                <a href="{{ route('components.category', $key) }}"
                    class="flex items-center justify-between px-3 py-2 text-sm rounded-lg transition-colors
                        {{ $current === $key
                            ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 font-medium'
                            : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                    <span>{{ $cat['icon'] }} {{ $cat['label'] }}</span>
                    <span class="text-xs {{ $current === $key ? 'text-blue-500' : 'text-gray-400' }}">{{ $cat['count'] }}</span>
                </a>
            @endforeach
        </nav>
    </div>
</aside>