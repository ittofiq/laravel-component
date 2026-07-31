{{-- Komponen Product Card dengan Tailwind CSS --}}
@props([
    'image' => null,
    'title' => 'Product Name',
    'price' => '0.00',
    'rating' => 5,
    'reviews' => 0,
    'inStock' => true,
])

<div class="bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-lg transition overflow-hidden">
    @if($image)
        <div class="h-48 overflow-hidden bg-gray-200 dark:bg-gray-700">
            <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-full object-cover">
        </div>
    @endif

    <div class="p-4">
        <h3 class="font-bold text-gray-900 dark:text-white truncate">{{ $title }}</h3>

        <div class="flex items-center gap-2 my-2">
            <div class="flex text-yellow-400">
                @for($i = 0; $i < 5; $i++)
                    <span>{{ $i < $rating ? '★' : '☆' }}</span>
                @endfor
            </div>
            @if($reviews > 0)
                <span class="text-sm text-gray-600 dark:text-gray-400">({{ $reviews }})</span>
            @endif
        </div>

        <div class="flex items-center justify-between mb-4">
            <span class="text-2xl font-bold text-gray-900 dark:text-white">${{ number_format($price, 2) }}</span>
            @if($inStock)
                <span class="text-sm bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300 px-2 py-1 rounded">In Stock</span>
            @else
                <span class="text-sm bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300 px-2 py-1 rounded">Out of Stock</span>
            @endif
        </div>

        <button class="w-full px-4 py-2 rounded-lg bg-blue-500 text-white hover:bg-blue-600 transition {{ !$inStock ? 'opacity-50 cursor-not-allowed' : '' }}" {{ !$inStock ? 'disabled' : '' }}>
            Tambah ke Keranjang
        </button>
    </div>
</div>
