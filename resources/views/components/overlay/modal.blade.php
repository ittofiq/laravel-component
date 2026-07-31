{{-- Komponen Modal dengan Focus Trap, ESC Close, Sizes, Scroll Lock --}}
@props([
    'id' => 'modal',
    'title' => null,
    'size' => 'md',        // sm, md, lg, xl, full
    'closeable' => true,    // Show X button
    'closeOnOutside' => true,
    'closeOnEsc' => true,
    'scrollLock' => true,
])

@php
    $sizes = [
        'sm' => 'max-w-sm',       // 384px
        'md' => 'max-w-lg',       // 512px  (default)
        'lg' => 'max-w-2xl',      // 672px
        'xl' => 'max-w-4xl',      // 896px
        'full' => 'max-w-6xl',    // 1152px
    ];
    $sizeClass = $sizes[$size] ?? $sizes['md'];
@endphp

<div
    x-data="{ open: false }"
    x-show="open"
    x-cloak
    @keydown.escape.window="{{ $closeOnEsc ? 'open = false' : '' }}"
    x-init="
        window['modal_{{ $id }}'] = $data;
        $watch('open', val => {
            @if($scrollLock) document.body.style.overflow = val ? 'hidden' : ''; @endif
            if (val) {
                $nextTick(() => {
                    const f = $el.querySelectorAll('button, [href], input, select, textarea, [tabindex]');
                    if (f.length) f[0].focus();
                });
            }
        });
    "
    @keydown.tab="
        const f = $el.querySelectorAll('button, [href], input, select, textarea, [tabindex]');
        if (!f.length) return;
        const first = f[0], last = f[f.length - 1];
        if ($event.shiftKey && document.activeElement === first) { $event.preventDefault(); last.focus(); }
        else if (! $event.shiftKey && document.activeElement === last) { $event.preventDefault(); first.focus(); }
    "
    class="fixed inset-0 z-50 flex items-center justify-center p-4"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    role="dialog"
    aria-modal="true"
    aria-labelledby="{{ $id }}-title"
>
    {{-- Backdrop --}}
    <div
        class="absolute inset-0 bg-black/50 dark:bg-black/70"
        @if($closeOnOutside) @click="open = false" @endif
    ></div>

    {{-- Panel --}}
    <div
        class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl border border-gray-200 dark:border-gray-700 {{ $sizeClass }} w-full max-h-[90vh] flex flex-col"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 transform scale-95"
        x-transition:enter-end="opacity-100 transform scale-100"
    >
        {{-- Header --}}
        @if($title || $closeable)
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex-shrink-0">
                @if($title)
                    <h2 id="{{ $id }}-title" class="text-lg font-bold text-gray-900 dark:text-white">{{ $title }}</h2>
                @else
                    <div></div>
                @endif
                @if($closeable)
                    <button @click="open = false" class="p-1.5 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                @endif
            </div>
        @endif

        {{-- Body --}}
        <div class="px-6 py-5 text-gray-700 dark:text-gray-300 overflow-y-auto flex-1">
            {{ $slot }}
        </div>
    </div>
</div>

<script>
function openModal(id) { var m = window['modal_' + id]; if (m) m.open = true; }
function closeModal(id) { var m = window['modal_' + id]; if (m) m.open = false; }
</script>