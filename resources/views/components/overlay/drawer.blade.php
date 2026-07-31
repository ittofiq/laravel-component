{{-- Komponen Drawer dengan Alpine.js --}}
@props([
    'title' => null,
    'position' => 'left',
    'id' => 'drawer',
])

<div x-data="drawerComponent('{{ $position }}', '{{ $id }}')" @open-drawer-{{ $id }}.window="open()">
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

    {{-- Drawer Panel --}}
    <div
        x-show="isOpen"
        @keydown.escape="close"
        x-transition:enter="transition-transform duration-300 ease-out"
        x-transition:enter-start="{{ $position === 'left' ? '-translate-x-full' : 'translate-x-full' }}"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition-transform duration-200 ease-in"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="{{ $position === 'left' ? '-translate-x-full' : 'translate-x-full' }}"
        class="fixed top-0 {{ $position === 'left' ? 'left-0' : 'right-0' }} bottom-0 w-80 max-w-[85vw] bg-white dark:bg-gray-800 shadow-2xl z-50 overflow-y-auto"
        style="display: none;"
    >
        <div class="p-6">
            <div class="flex items-center justify-between mb-4">
                @if($title)
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">{{ $title }}</h2>
                @endif
                <button @click="close" class="p-1 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-500 dark:text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            {{ $slot }}
        </div>
    </div>
</div>

<script>
function drawerComponent(position, drawerId) {
    return {
        isOpen: false,
        position: position,
        drawerId: drawerId,
        init() {
            window['openDrawer_' + this.drawerId] = () => this.open();
            window['closeDrawer_' + this.drawerId] = () => this.close();
        },
        open() { this.isOpen = true; },
        close() { this.isOpen = false; },
        toggle() { this.isOpen = !this.isOpen; }
    };
}
</script>