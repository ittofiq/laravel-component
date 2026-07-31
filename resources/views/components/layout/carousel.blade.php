{{-- Komponen Carousel Slider dengan Alpine.js --}}
@props([
    'items' => [],
    'autoplay' => false,
    'interval' => 5000,
    'showControls' => true,
    'showIndicators' => true,
])

@php
    $total = count($items);
    $uniqueId = 'carousel-' . uniqid();
@endphp

@if($total > 0)
<div
    x-data="carouselComponent({{ $total }}, {{ $autoplay ? 'true' : 'false' }}, {{ $interval }})"
    @keydown.left.window="prev"
    @keydown.right.window="next"
    class="relative w-full overflow-hidden rounded-lg bg-gray-200 dark:bg-gray-700"
    role="region"
    aria-roledescription="carousel"
    aria-label="Image carousel"
>
    {{-- Slides --}}
    <div class="relative h-64 sm:h-80 lg:h-96">
        @foreach($items as $index => $item)
            <div
                x-show="current === {{ $index }}"
                x-transition:enter="transition-all duration-700 ease-out"
                x-transition:enter-start="opacity-0 transform scale-105"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition-all duration-500 ease-in"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="absolute inset-0"
                role="group"
                aria-roledescription="slide"
                aria-label="Slide {{ $index + 1 }} of {{ $total }}"
            >
                @if(is_array($item))
                    <img
                        src="{{ $item['image'] ?? $item['src'] ?? '' }}"
                        alt="{{ $item['title'] ?? 'Slide ' . ($index + 1) }}"
                        class="w-full h-full object-cover"
                    />
                    @if(isset($item['title']))
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent flex items-end justify-start p-6 sm:p-10">
                            <div>
                                <h3 class="text-xl sm:text-2xl font-bold text-white">{{ $item['title'] }}</h3>
                                @if(isset($item['description']))
                                    <p class="text-sm text-gray-200 mt-1">{{ $item['description'] }}</p>
                                @endif
                            </div>
                        </div>
                    @endif
                @else
                    <img src="{{ $item }}" alt="Slide {{ $index + 1 }}" class="w-full h-full object-cover" />
                @endif
            </div>
        @endforeach
    </div>

    {{-- Previous Button --}}
    @if($showControls && $total > 1)
        <button
            @click="prev"
            class="absolute left-3 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-white/80 dark:bg-gray-800/80 hover:bg-white dark:hover:bg-gray-800 text-gray-800 dark:text-white shadow-lg flex items-center justify-center transition-all hover:scale-110 focus:outline-none focus:ring-2 focus:ring-blue-500"
            aria-label="Previous slide"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
            </svg>
        </button>

        {{-- Next Button --}}
        <button
            @click="next"
            class="absolute right-3 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-white/80 dark:bg-gray-800/80 hover:bg-white dark:hover:bg-gray-800 text-gray-800 dark:text-white shadow-lg flex items-center justify-center transition-all hover:scale-110 focus:outline-none focus:ring-2 focus:ring-blue-500"
            aria-label="Next slide"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
            </svg>
        </button>
    @endif

    {{-- Indicators --}}
    @if($showIndicators && $total > 1)
        <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2" role="tablist" aria-label="Slide indicators">
            @foreach($items as $index => $item)
                <button
                    @click="goTo({{ $index }})"
                    class="w-2.5 h-2.5 rounded-full transition-all duration-300 focus:outline-none"
                    :class="current === {{ $index }}
                        ? 'bg-white dark:bg-blue-400 w-8'
                        : 'bg-white/50 dark:bg-gray-400/50 hover:bg-white/75 dark:hover:bg-gray-400/75'"
                    role="tab"
                    aria-selected="false"
                    :aria-selected="current === {{ $index }} ? 'true' : 'false'"
                    aria-label="Go to slide {{ $index + 1 }}"
                ></button>
            @endforeach
        </div>
    @endif
</div>

<script>
function carouselComponent(totalSlides, autoplay, interval) {
    return {
        current: 0,
        total: totalSlides,
        autoplay: autoplay,
        interval: interval,
        timer: null,

        init() {
            if (this.autoplay && this.total > 1) {
                this.startAutoplay();
            }
        },

        next() {
            this.current = this.current === this.total - 1 ? 0 : this.current + 1;
            this.resetTimer();
        },

        prev() {
            this.current = this.current === 0 ? this.total - 1 : this.current - 1;
            this.resetTimer();
        },

        goTo(index) {
            this.current = index;
            this.resetTimer();
        },

        startAutoplay() {
            this.timer = setInterval(() => {
                this.next();
            }, this.interval);
        },

        stopAutoplay() {
            if (this.timer) {
                clearInterval(this.timer);
                this.timer = null;
            }
        },

        resetTimer() {
            if (this.autoplay) {
                this.stopAutoplay();
                this.startAutoplay();
            }
        }
    };
}
</script>
@else
    <div class="rounded-lg bg-gray-100 dark:bg-gray-800 p-8 text-center text-gray-500 dark:text-gray-400">
        <p class="text-sm">Tidak ada slide untuk ditampilkan</p>
    </div>
@endif