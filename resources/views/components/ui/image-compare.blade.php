{{-- Komponen Image Compare - Before/After slider comparison --}}
@props([
    'before' => '',
    'after' => '',
    'label' => null,
    'ratio' => '16/9',
    'initial' => 50,
])

@php
    $ratioMap = [
        '1/1' => '100%',
        '4/3' => '75%',
        '16/9' => '56.25%',
        '21/9' => '42.86%',
        '3/2' => '66.67%',
    ];
    $paddingBottom = $ratioMap[$ratio] ?? '56.25%';
@endphp

<div
    x-data="{
        position: {{ $initial }},
        dragging: false,
        containerWidth: 0,

        startDrag(e) {
            this.dragging = true;
            this.containerWidth = this.$refs.container.offsetWidth;
            e.preventDefault();
        },

        onDrag(e) {
            if (!this.dragging) return;
            const rect = this.$refs.container.getBoundingClientRect();
            const clientX = e.touches ? e.touches[0].clientX : e.clientX;
            const x = clientX - rect.left;
            this.position = Math.max(0, Math.min(100, (x / this.containerWidth) * 100));
        },

        stopDrag() {
            this.dragging = false;
        }
    }"
    x-init="
        $watch('dragging', val => {
            if (val) {
                window.addEventListener('mousemove', e => onDrag(e));
                window.addEventListener('touchmove', e => onDrag(e), {passive: false});
                window.addEventListener('mouseup', () => stopDrag(), {once: true});
                window.addEventListener('touchend', () => stopDrag(), {once: true});
            }
        });
    "
    class="rounded-xl overflow-hidden border border-gray-200 dark:border-gray-700 shadow-lg"
>
    {{-- Header --}}
    @if($label)
    <div class="flex items-center px-4 py-2.5 bg-[#21252b] border-b border-gray-700/50">
        <div class="flex items-center gap-3">
            <div class="flex gap-1.5">
                <span class="w-3 h-3 rounded-full bg-red-500"></span>
                <span class="w-3 h-3 rounded-full bg-yellow-500"></span>
                <span class="w-3 h-3 rounded-full bg-green-500"></span>
            </div>
            <span class="text-xs text-gray-400 font-medium">{{ $label }}</span>
        </div>
    </div>
    @endif

    {{-- Compare Container --}}
    <div
        x-ref="container"
        @mousedown="startDrag($event)"
        @touchstart.prevent="startDrag($event)"
        class="relative w-full overflow-hidden select-none cursor-col-resize bg-gray-900"
        style="padding-bottom: {{ $paddingBottom }}"
    >
        {{-- After Image (full width, behind) --}}
        <div class="absolute inset-0">
            <img src="{{ $after }}" alt="After" class="w-full h-full object-cover" draggable="false" />
        </div>

        {{-- Before Image (clipped by position) --}}
        <div class="absolute inset-0 overflow-hidden" :style="'width: ' + position + '%'">
            <img src="{{ $before }}" alt="Before" class="absolute inset-0 w-full h-full object-cover" style="width: calc(100vw)" draggable="false" />
        </div>

        {{-- Divider Line --}}
        <div class="absolute inset-y-0 bg-white shadow-lg" :style="'left: ' + position + '%'; width: '3px'" style="transform: translateX(-50%)"></div>

        {{-- Drag Handle --}}
        <div
            class="absolute top-1/2 w-10 h-10 bg-white rounded-full shadow-xl border-2 border-gray-300 flex items-center justify-center"
            :style="'left: ' + position + '%'"
            style="transform: translate(-50%, -50%)"
        >
            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 11l-4 4 4 4M16 19l4-4-4-4"/>
            </svg>
        </div>

        {{-- Labels --}}
        <div class="absolute bottom-3 left-3 px-2 py-1 bg-black/60 text-white text-xs font-medium rounded" x-show="position > 20">Before</div>
        <div class="absolute bottom-3 right-3 px-2 py-1 bg-black/60 text-white text-xs font-medium rounded" x-show="position < 80">After</div>
    </div>
</div>