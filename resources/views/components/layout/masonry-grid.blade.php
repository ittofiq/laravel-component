{{-- Komponen Masonry Grid dengan Tailwind CSS --}}
@props([
    'items' => [],
])

<div class="columns-1 md:columns-2 lg:columns-3 gap-6 space-y-6">
    @foreach($items as $item)
        <div class="break-inside-avoid bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow hover:shadow-lg transition">
            @if(isset($item['image']))
                <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="w-full h-auto" />
            @endif
            <div class="p-4">
                <h3 class="font-bold text-gray-900 dark:text-white">{{ $item['title'] }}</h3>
                @if(isset($item['description']))
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">{{ $item['description'] }}</p>
                @endif
            </div>
        </div>
    @endforeach
</div>
