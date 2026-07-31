{{-- Komponen Empty State dengan Tailwind CSS --}}
@props([
    'icon' => '📭',
    'title' => 'Tidak ada data',
    'message' => 'Tidak ada item untuk ditampilkan',
])

<div class="flex flex-col items-center justify-center py-12 px-4">
    <div class="text-6xl mb-4">{{ $icon }}</div>
    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
        {{ $title }}
    </h3>
    <p class="text-sm text-gray-600 dark:text-gray-400 text-center max-w-md">
        {{ $message }}
    </p>
</div>
