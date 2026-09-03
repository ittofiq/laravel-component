{{-- Komponen Author Card — bio penulis artikel --}}
@props([
    'name' => '',
    'avatar' => null,
    'bio' => null,
    'socialLinks' => [],   // [['label' => 'GitHub', 'icon' => '🐙', 'href' => '#'], ...]
])

<div class="flex items-start gap-4 p-5 bg-gray-50 dark:bg-gray-800/50 rounded-xl border border-gray-200 dark:border-gray-700">
    {{-- Avatar --}}
    @if($avatar)
        <img src="{{ $avatar }}" alt="{{ $name }}" class="w-14 h-14 rounded-full object-cover flex-shrink-0" />
    @else
        <div class="w-14 h-14 rounded-full bg-blue-500 text-white flex items-center justify-center text-lg font-bold flex-shrink-0">{{ strtoupper(substr($name, 0, 2)) }}</div>
    @endif

    <div class="flex-1 min-w-0">
        <div class="flex items-center gap-2 flex-wrap">
            <p class="font-bold text-gray-900 dark:text-white">{{ $name }}</p>
            <span class="text-xs text-gray-400 dark:text-gray-500">Penulis</span>
        </div>
        @if($bio)
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $bio }}</p>
        @endif

        @if(!empty($socialLinks))
            <div class="flex gap-2 mt-2">
                @foreach($socialLinks as $link)
                    <a href="{{ $link['href'] ?? '#' }}" class="w-8 h-8 rounded-full bg-white dark:bg-gray-700 flex items-center justify-center text-sm hover:shadow transition" title="{{ $link['label'] ?? '' }}">{{ $link['icon'] ?? '🔗' }}</a>
                @endforeach
            </div>
        @endif
    </div>
</div>