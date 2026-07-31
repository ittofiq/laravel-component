{{-- Level 3: Pricing Card (Props + Logika) --}}
@props(['plan', 'price', 'features' => [], 'popular' => false, 'buttonText' => 'Choose Plan'])

<div class="relative">
  @if($popular)
    <div class="absolute -top-4 left-1/2 -translate-x-1/2 z-10">
      <span class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-4 py-1 rounded-full text-sm font-semibold">
        PALING POPULER
      </span>
    </div>
  @endif

  <div class="h-full rounded-xl border-2 {{ $popular ? 'border-blue-600 shadow-2xl scale-105' : 'border-gray-200 dark:border-gray-700' }} p-8 bg-white dark:bg-gray-800 transition-all hover:shadow-xl">

    <!-- Plan Name -->
    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">
      {{ $plan }}
    </h3>

    <!-- Price -->
    <div class="mb-6">
      <span class="text-5xl font-bold text-gray-900 dark:text-white">
        ${{ $price }}
      </span>
      <span class="text-gray-600 dark:text-gray-400 ml-2">/bulan</span>
    </div>

    <!-- Features List -->
    <ul class="space-y-4 mb-8">
      @forelse($features as $feature)
        <li class="flex items-center gap-3">
          <span class="text-green-500 font-bold text-lg">✓</span>
          <span class="text-gray-700 dark:text-gray-300">{{ $feature }}</span>
        </li>
      @empty
        <li class="text-gray-500 dark:text-gray-400">Tidak ada fitur</li>
      @endforelse
    </ul>

    <!-- Button -->
    <x-ui.button
      variant="{{ $popular ? 'primary' : 'secondary' }}"
      class="w-full"
    >
      {{ $buttonText }}
    </x-ui.button>
  </div>
</div>
