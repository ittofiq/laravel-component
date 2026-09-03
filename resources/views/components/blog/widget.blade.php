{{-- Komponen Blog Widget — kartu widget generik (judul + isi) --}}
@props([
    'title' => null,
    'icon' => null,
])

<div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-5">
    @if($title)
        <h3 class="flex items-center gap-2 font-bold text-gray-900 dark:text-white mb-4">
            @if($icon)
                <span>{{ $icon }}</span>
            @endif
            {{ $title }}
        </h3>
    @endif
    {{ $slot }}
</div>