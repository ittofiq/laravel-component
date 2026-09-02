{{-- Komponen Page Header — judul + deskripsi + aksi, konsisten untuk tiap halaman admin --}}
@props([
    'title' => '',
    'description' => null,
])

<div class="flex flex-wrap items-center justify-between gap-4">
    <div class="min-w-0">
        <h2 class="text-xl lg:text-2xl font-bold text-gray-900 dark:text-white">{{ $title }}</h2>
        @if($description)
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ $description }}</p>
        @endif
    </div>
    <div class="flex items-center gap-2 flex-shrink-0">
        {{ $slot }}
    </div>
</div>