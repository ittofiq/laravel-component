{{-- Komponen Toast Container - Global Event-Driven Toast System --}}
@props([
    'position' => 'top-right',
    'maxToasts' => 5,
])

<div
    x-data="toastContainerComponent('{{ $position }}', {{ $maxToasts }})"
    x-on:add-toast.window="addToast($event.detail)"
    x-on:set-toast-position.window="currentPosition = $event.detail.position"
    x-bind:class="positionClasses[currentPosition]"
    x-cloak
    class="fixed z-[9999] flex flex-col gap-2 w-full max-w-sm pointer-events-none"
>
    <template x-for="(toast, index) in toasts" :key="toast.id">
        <div
            x-show="toast.visible"
            x-transition:enter="transition-all duration-500 ease-out"
            x-transition:enter-start="opacity-0 translate-x-full"
            x-transition:enter-end="opacity-100 translate-x-0 translate-y-0"
            x-transition:leave="transition-all duration-500 ease-in"
            x-transition:leave-start="opacity-100 translate-x-0 translate-y-0"
            x-transition:leave-end="opacity-0 translate-x-full"
            class="pointer-events-auto"
        >
            <div class="flex items-start gap-3 p-4 rounded-lg border shadow-lg relative overflow-hidden" :class="getTypeClasses(toast.type)" role="alert">
                {{-- Icon --}}
                <span class="text-lg flex-shrink-0 leading-none mt-0.5" x-text="getIcon(toast.type)"></span>

                {{-- Content --}}
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium" x-text="toast.title" x-show="toast.title"></p>
                    <p class="text-sm" x-text="toast.message"></p>
                </div>

                {{-- Close Button --}}
                <button
                    @click="removeToast(toast.id)"
                    type="button"
                    class="flex-shrink-0 opacity-60 hover:opacity-100 transition-opacity focus:outline-none"
                    aria-label="Tutup notifikasi"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>

                {{-- Progress Bar --}}
                <div class="absolute bottom-0 left-0 right-0 h-1 rounded-b overflow-hidden">
                    <div
                        class="h-full transition-all ease-linear"
                        :class="getProgressClass(toast.type)"
                        :style="'width: ' + toast.progress + '%'"
                    ></div>
                </div>
            </div>
        </div>
    </template>
</div>

