{{-- Komponen Image Gallery dengan Tailwind CSS --}}
@props([
    'images' => [],
    'columns' => 3,
])

<div class="grid grid-cols-{{ $columns }} md:grid-cols-{{ $columns }} lg:grid-cols-{{ $columns }} gap-4 cursor-pointer">
    @foreach($images as $index => $image)
        <div class="relative group overflow-hidden rounded-lg shadow hover:shadow-lg transition">
            <img src="{{ $image }}" alt="Gallery image {{ $index + 1 }}" class="w-full h-48 object-cover group-hover:scale-110 transition duration-300" />
            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition flex items-center justify-center">
                <svg class="w-8 h-8 text-white opacity-0 group-hover:opacity-100 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM13 13H7"></path>
                </svg>
            </div>
        </div>
    @endforeach
</div>
