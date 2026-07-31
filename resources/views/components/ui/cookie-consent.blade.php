{{-- Komponen Cookie Consent Banner --}}
@props([
    'message' => 'Kami menggunakan cookie untuk meningkatkan pengalaman Anda. Dengan menggunakan situs ini, Anda menyetujui penggunaan cookie.',
    'acceptText' => 'Terima',
    'declineText' => 'Tolak',
    'learnMoreText' => 'Pelajari lebih lanjut',
    'learnMoreUrl' => '#',
    'position' => 'bottom',
])

@php
    $posClasses = [
        'bottom' => 'bottom-0 left-0 right-0',
        'top' => 'top-0 left-0 right-0',
        'bottom-right' => 'bottom-4 right-4 max-w-sm',
        'bottom-left' => 'bottom-4 left-4 max-w-sm',
    ];
    $posClass = $posClasses[$position] ?? $posClasses['bottom'];
@endphp

<div
    x-data="cookieConsent()"
    x-show="show"
    x-transition:enter="transition-all duration-500 ease-out"
    x-transition:enter-start="{{ $position === 'bottom' ? 'translate-y-full' : ($position === 'top' ? '-translate-y-full' : 'translate-y-4 opacity-0') }}"
    x-transition:enter-end="translate-y-0 opacity-100"
    x-transition:leave="transition-all duration-300 ease-in"
    x-transition:leave-start="translate-y-0 opacity-100"
    x-transition:leave-end="{{ $position === 'bottom' ? 'translate-y-full' : ($position === 'top' ? '-translate-y-full' : 'translate-y-4 opacity-0') }}"
    class="fixed {{ $posClass }} z-[9998] {{ in_array($position, ['bottom-right', 'bottom-left']) ? 'rounded-xl' : '' }}"
    style="display: none;"
>
    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-2xl {{ in_array($position, ['bottom', 'top']) ? 'px-6 py-4' : 'p-5 rounded-xl' }}">
        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 max-w-5xl mx-auto">
            {{-- Cookie Icon --}}
            <div class="hidden sm:block flex-shrink-0">
                <span class="text-2xl">🍪</span>
            </div>

            {{-- Message --}}
            <p class="text-sm text-gray-600 dark:text-gray-400 flex-1">
                {{ $message }}
                @if($learnMoreUrl !== '#')
                    <a href="{{ $learnMoreUrl }}" class="text-blue-500 dark:text-blue-400 hover:underline font-medium whitespace-nowrap">
                        {{ $learnMoreText }}
                    </a>
                @endif
            </p>

            {{-- Buttons --}}
            <div class="flex items-center gap-3 flex-shrink-0">
                <button
                    @click="decline"
                    class="px-4 py-2 text-sm font-medium rounded-lg border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors whitespace-nowrap"
                >
                    {{ $declineText }}
                </button>
                <button
                    @click="accept"
                    class="px-5 py-2 text-sm font-medium rounded-lg bg-blue-500 text-white hover:bg-blue-600 transition-colors whitespace-nowrap"
                >
                    {{ $acceptText }}
                </button>
            </div>
        </div>
    </div>
</div>