{{-- Komponen Waterfall Layout dengan Tailwind CSS --}}
@props([
    'items' => [],
])

<div class="flex flex-col gap-4">
    @foreach($items as $item)
        <div class="flex {{ $loop->iteration % 2 === 0 ? 'flex-row-reverse' : '' }} gap-6 items-center">
            <div class="flex-1">
                @if(isset($item['image']))
                    <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="w-full rounded-lg" />
                @endif
            </div>
            <div class="flex-1">
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $item['title'] }}</h3>
                <p class="text-gray-600 dark:text-gray-400 mt-2">{{ $item['description'] ?? '' }}</p>
                @if(isset($item['button']))
                    <button class="mt-4 px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                        {{ $item['button'] }}
                    </button>
                @endif
            </div>
        </div>
    @endforeach
</div>
