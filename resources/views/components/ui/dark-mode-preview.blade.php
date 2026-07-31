{{-- Komponen Dark Mode Preview - Side-by-side comparison --}}
@props([
    'label' => 'Component Preview',
])

<div class="rounded-xl overflow-hidden border border-gray-200 dark:border-gray-700 shadow-sm">
    <div class="bg-gray-100 dark:bg-gray-800 px-4 py-2 border-b border-gray-200 dark:border-gray-700 flex items-center gap-2">
        <span class="w-2.5 h-2.5 rounded-full bg-red-400"></span>
        <span class="w-2.5 h-2.5 rounded-full bg-yellow-400"></span>
        <span class="w-2.5 h-2.5 rounded-full bg-green-400"></span>
        <span class="text-xs text-gray-500 dark:text-gray-400 ml-2 font-medium">{{ $label }}</span>
    </div>
    <div class="grid grid-cols-2 divide-x divide-gray-200 dark:divide-gray-700">
        {{-- Light Mode --}}
        <div class="bg-white p-6">
            <p class="text-xs font-semibold text-gray-400 mb-3 uppercase tracking-wider flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"/></svg>
                Light
            </p>
            <div class="mt-2">
                {!! $slot !!}
            </div>
        </div>
        {{-- Dark Mode --}}
        <div class="bg-gray-900 p-6">
            <p class="text-xs font-semibold text-gray-500 mb-3 uppercase tracking-wider flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/></svg>
                Dark
            </p>
            <div class="mt-2">
                {!! $slot !!}
            </div>
        </div>
    </div>
</div>