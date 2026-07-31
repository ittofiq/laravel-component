{{-- Komponen Video Modal dengan Tailwind CSS --}}
@props([
    'videoId' => null, // YouTube video ID
    'title' => 'Watch Video',
])

<div x-data="{ open: false }">
    <button @click="open = true" class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition font-bold">
        ▶ {{ $title }}
    </button>

    <!-- Video Modal -->
    <div
        x-show="open"
        @click.outside="open = false"
        @keydown.escape="open = false"
        class="fixed inset-0 bg-black/50 flex items-center justify-center z-50"
        style="display: none;"
    >
        <div class="w-full max-w-2xl relative">
            <button @click="open = false" class="absolute -top-8 right-0 text-white text-3xl">×</button>
            <div class="aspect-video bg-black rounded-lg overflow-hidden">
                <iframe
                    class="w-full h-full"
                    src="https://www.youtube.com/embed/{{ $videoId }}"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                ></iframe>
            </div>
        </div>
    </div>
</div>
