{{-- Komponen Bottom Sheet dengan Alpine.js --}}
@props([
    'title' => null,
    'id' => 'bottomSheet',
])

<div x-data="bottomSheet()" x-init="init()">
    {{-- Overlay --}}
    <div
        x-show="isOpen"
        @click="close"
        x-transition:enter="transition-opacity duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        class="fixed inset-0 bg-black/50 z-40"
        style="display: none;"
    ></div>

    {{-- Sheet --}}
    <div
        x-show="isOpen"
        @keydown.escape="close"
        x-transition:enter="transition-transform duration-300 ease-out"
        x-transition:enter-start="translate-y-full"
        x-transition:enter-end="translate-y-0"
        x-transition:leave="transition-transform duration-200 ease-in"
        x-transition:leave-start="translate-y-0"
        x-transition:leave-end="translate-y-full"
        class="fixed bottom-0 left-0 right-0 bg-white dark:bg-gray-800 rounded-t-2xl shadow-2xl z-50 max-h-[85vh] overflow-y-auto"
        style="display: none;"
    >
        {{-- Handle --}}
        <div class="sticky top-0 bg-white dark:bg-gray-800 pt-3 pb-2 px-6 rounded-t-2xl">
            <div class="w-10 h-1 bg-gray-300 dark:bg-gray-600 rounded-full mx-auto mb-3"></div>
            @if($title)
                <h2 class="text-lg font-bold text-gray-900 dark:text-white">{{ $title }}</h2>
            @endif
        </div>
        <div class="px-6 pb-6">
            {{ $slot }}
        </div>
    </div>
</div>

<script>
function bottomSheet() {
    return {
        isOpen: false,
        init() {
            const el = this.$el;
            const sheetId = el.closest('[id]')?.id || 'sheet';
            window['openSheet_' + sheetId] = () => this.open();
            window['closeSheet_' + sheetId] = () => this.close();
        },
        open() { this.isOpen = true; },
        close() { this.isOpen = false; },
        toggle() { this.isOpen = !this.isOpen; }
    };
}
</script>