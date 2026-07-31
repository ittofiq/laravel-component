{{-- Komponen Shopping Cart dengan Tailwind CSS --}}
@props([
    'items' => [],
])

<div class="space-y-6">
    <div class="space-y-4">
        @foreach($items as $item)
            <div class="flex gap-4 bg-white dark:bg-gray-800 rounded-lg p-4">
                <div class="w-20 h-20 bg-gray-200 dark:bg-gray-700 rounded">
                    @if(isset($item['image']))
                        <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover rounded" />
                    @endif
                </div>
                <div class="flex-1">
                    <h3 class="font-bold text-gray-900 dark:text-white">{{ $item['name'] }}</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">${{ $item['price'] }}</p>
                    <div class="flex gap-2 mt-2">
                        <button class="px-2 py-1 bg-gray-200 dark:bg-gray-700 rounded">-</button>
                        <input type="number" value="{{ $item['quantity'] }}" class="w-12 text-center bg-gray-100 dark:bg-gray-700 rounded" />
                        <button class="px-2 py-1 bg-gray-200 dark:bg-gray-700 rounded">+</button>
                    </div>
                </div>
                <div class="text-right">
                    <p class="font-bold text-gray-900 dark:text-white">${{ $item['price'] * $item['quantity'] }}</p>
                    <button class="text-red-500 text-sm hover:text-red-700 mt-2">Remove</button>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Summary -->
    <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-4 space-y-2">
        <div class="flex justify-between">
            <span>Subtotal:</span>
            <span class="font-bold">${{ collect($items)->sum(fn($i) => $i['price'] * $i['quantity']) }}</span>
        </div>
        <div class="flex justify-between">
            <span>Shipping:</span>
            <span class="font-bold">$5.00</span>
        </div>
        <div class="border-t border-gray-300 dark:border-gray-600 pt-2 flex justify-between">
            <span class="font-bold">Total:</span>
            <span class="font-bold text-lg">${{ collect($items)->sum(fn($i) => $i['price'] * $i['quantity']) + 5 }}</span>
        </div>
    </div>

    <button class="w-full px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 font-bold transition">
        Checkout
    </button>
</div>
