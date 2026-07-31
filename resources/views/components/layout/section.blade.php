{{-- Level 6: Section Layout (Named Slots) --}}
@props(['title' => null, 'subtitle' => null, 'centered' => false])

<section class="py-12 lg:py-20 px-4 sm:px-6 lg:px-8">
  <div class="max-w-7xl mx-auto">

    <!-- Header -->
    @if($title || $subtitle)
      <div class="{{ $centered ? 'text-center mb-12' : 'mb-12' }}">
        @if($title)
          <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-4">
            {{ $title }}
          </h2>
        @endif
        @if($subtitle)
          <p class="text-lg text-gray-600 dark:text-gray-400 {{ $centered ? 'max-w-2xl mx-auto' : '' }}">
            {{ $subtitle }}
          </p>
        @endif
      </div>
    @endif

    <!-- Main Content -->
    <div>
      {{ $slot }}
    </div>

    <!-- Footer (Optional) -->
    @isset($footer)
      <div class="mt-12 pt-8 border-t border-gray-200 dark:border-gray-700">
        {{ $footer }}
      </div>
    @endisset
  </div>
</section>
