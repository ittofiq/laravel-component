{{-- Komponen Newsletter — form berlangganan email --}}
@props([
    'title' => 'Newsletter',
    'description' => null,
    'placeholder' => 'Email Anda',
    'buttonText' => 'Langganan',
])

<div>
    @if($title)
        <h3 class="font-bold text-gray-900 dark:text-white mb-1.5">{{ $title }}</h3>
    @endif
    @if($description)
        <p class="text-xs text-gray-500 dark:text-gray-400 mb-3">{{ $description }}</p>
    @endif

    <form @submit.prevent class="flex gap-2">
        <input type="email" placeholder="{{ $placeholder }}" required class="flex-1 min-w-0 px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" />
        <button type="submit" class="px-3 py-2 text-sm font-medium bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition flex-shrink-0">{{ $buttonText }}</button>
    </form>
</div>