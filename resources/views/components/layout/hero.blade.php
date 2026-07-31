{{-- Level 2: Hero Section (Props Sederhana) --}}
@props(['title', 'subtitle' => null, 'image' => null])

<section class="relative w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-20 lg:py-32">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col lg:flex-row items-center gap-8">

    <!-- Text Content -->
    <div class="flex-1">
      <h1 class="text-4xl lg:text-5xl font-bold mb-4">
        {{ $title }}
      </h1>
      @if($subtitle)
        <p class="text-lg lg:text-xl text-blue-100 mb-8">
          {{ $subtitle }}
        </p>
      @endif
      <div>
        {{ $slot }}
      </div>
    </div>

    <!-- Image -->
    @if($image)
      <div class="flex-1 hidden lg:block">
        <img src="{{ $image }}" alt="{{ $title }}" class="w-full rounded-lg shadow-xl">
      </div>
    @endif
  </div>
</section>
