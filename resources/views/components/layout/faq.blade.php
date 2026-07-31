{{-- Komponen FAQ Accordion dengan Alpine.js --}}
@props([
    'faqs' => [],
    'expanded' => null,
])

@php
    $total = count($faqs);
    if ($total === 0) return;
@endphp

<div class="max-w-3xl mx-auto" x-data="{ active: {{ $expanded ?? 'null' }} }">
    <div class="divide-y divide-gray-200 dark:divide-gray-700 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
        @foreach($faqs as $index => $faq)
            <div class="bg-white dark:bg-gray-800">
                <button
                    @click="active = active === {{ $index }} ? null : {{ $index }}"
                    class="w-full flex items-center justify-between px-6 py-5 text-left hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors"
                >
                    <span class="text-base font-semibold text-gray-900 dark:text-white pr-4">
                        {{ is_array($faq) ? $faq['question'] : $faq }}
                    </span>
                    <svg
                        class="w-5 h-5 flex-shrink-0 text-gray-400 transition-transform duration-300"
                        :class="active === {{ $index }} ? 'rotate-180 text-blue-500' : ''"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div
                    x-show="active === {{ $index }}"
                    x-transition:enter="transition-all duration-300 ease-out"
                    x-transition:enter-start="opacity-0 max-h-0"
                    x-transition:enter-end="opacity-100 max-h-96"
                    x-transition:leave="transition-all duration-200 ease-in"
                    x-transition:leave-start="opacity-100 max-h-96"
                    x-transition:leave-end="opacity-0 max-h-0"
                    class="overflow-hidden"
                >
                    <div class="px-6 pb-5 text-gray-600 dark:text-gray-400 text-sm leading-relaxed">
                        {{ is_array($faq) ? ($faq['answer'] ?? '') : '' }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>