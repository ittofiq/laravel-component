{{-- Komponen Image Lightbox dengan Alpine.js --}}
@props([
    'images' => [],
])

@php $imagesJson = json_encode($images); @endphp

<div x-data="imageLightbox({{ $imagesJson }})" class="grid grid-cols-3 gap-4">
    @foreach($images as $index => $image)
        <img
            src="{{ $image }}"
            @click="open({{ $index }})"
            class="w-full h-32 object-cover rounded-lg cursor-pointer hover:opacity-75 transition"
            alt="Image {{ $index + 1 }}"
        />
    @endforeach

    {{-- Lightbox Modal --}}
    <div
        x-show="show"
        @keydown.escape="show = false"
        x-transition:enter="transition-opacity duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        class="fixed inset-0 bg-black/90 z-50 flex items-center justify-center"
        style="display: none;"
    >
        <button @click="show = false" class="absolute top-4 right-4 text-white text-3xl hover:text-gray-300 transition z-10">&times;</button>
        <button @click="prev" class="absolute left-4 top-1/2 -translate-y-1/2 text-white text-4xl hover:text-gray-300 transition z-10">&lsaquo;</button>
        <img :src="currentImage" class="max-w-4xl max-h-[90vh] object-contain" />
        <button @click="next" class="absolute right-4 top-1/2 -translate-y-1/2 text-white text-4xl hover:text-gray-300 transition z-10">&rsaquo;</button>
        <p class="absolute bottom-4 text-white text-sm" x-text="(current + 1) + ' / ' + images.length"></p>
    </div>
</div>

<script>
function imageLightbox(images) {
    return {
        images: images,
        current: 0,
        show: false,

        get currentImage() {
            return this.images[this.current] || '';
        },

        open(index) {
            this.current = index;
            this.show = true;
        },

        next() {
            this.current = this.current === this.images.length - 1 ? 0 : this.current + 1;
        },

        prev() {
            this.current = this.current === 0 ? this.images.length - 1 : this.current - 1;
        }
    };
}
</script>