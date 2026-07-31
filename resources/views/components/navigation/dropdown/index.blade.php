{{-- Komponen Dropdown Menu dengan Auto-flip, Click Trigger, Submenu --}}
@props([
    'label' => 'Menu',
    'align' => 'left',         // left, right
    'icon' => null,
    'trigger' => 'click',       // click, hover
    'autoFlip' => true,
])

<div
    class="relative inline-block"
    x-data="{
        open: false,
        dropUp: false,
        subOpen: null,

        toggle() { this.open = !this.open; if (this.open) this.checkFlip(); },
        close() { this.open = false; this.subOpen = null; },
        closeSub() { this.subOpen = null; },

        checkFlip() {
            @if($autoFlip)
                $nextTick(() => {
                    const panel = this.$refs.panel;
                    if (!panel) return;
                    const rect = panel.getBoundingClientRect();
                    const spaceBelow = window.innerHeight - this.$el.getBoundingClientRect().bottom;
                    this.dropUp = spaceBelow < rect.height + 20;
                });
            @endif
        },

        toggleSub(idx) {
            this.subOpen = this.subOpen === idx ? null : idx;
        },

        openSub(idx) {
            @if($trigger === 'hover')
                this.subOpen = idx;
            @endif
        }
    }"
    @if($trigger === 'hover')
        @mouseenter="open = true; checkFlip()"
        @mouseleave="open = false; subOpen = null"
    @endif
    @keydown.escape.window="close()"
>
    {{-- Trigger Button --}}
    <button
        @click="{{ $trigger === 'click' ? 'toggle()' : 'open = !open' }}"
        class="px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors flex items-center gap-2 text-sm font-medium"
    >
        @if($icon) <span class="text-base">{{ $icon }}</span> @endif
        {{ $label }}
        <svg class="w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </button>

    {{-- Dropdown Panel --}}
    <div
        x-show="open"
        x-ref="panel"
        @if($trigger === 'click')
            @click.outside="close()"
        @endif
        x-transition:enter="transition-all duration-200 ease-out"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition-all duration-150 ease-in"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        :class="{
            '{{ $align === 'right' ? 'right-0' : 'left-0' }}': true,
            'bottom-full mb-1.5': dropUp,
            'top-full mt-1.5': !dropUp
        }"
        class="absolute w-56 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 z-50 py-1.5"
        x-cloak
    >
        {{ $slot }}
    </div>
</div>