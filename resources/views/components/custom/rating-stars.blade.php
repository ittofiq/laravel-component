{{-- Level 4: Rating Stars (Conditional + Interaktif) --}}
@props(['rating' => 0, 'maxStars' => 5, 'interactive' => false, 'size' => 'md'])

@php
  $sizes = [
    'xs' => 'w-3 h-3',
    'sm' => 'w-4 h-4',
    'md' => 'w-6 h-6',
    'lg' => 'w-8 h-8',
    'xl' => 'w-10 h-10',
  ];
  $sizeClass = $sizes[$size];
@endphp

<div
  {{ $attributes->merge(['class' => 'flex gap-1 items-center']) }}
  @if($interactive)
    x-data="{ hoverRating: 0, rating: {{ $rating }} }"
  @endif
>

  @for($i = 1; $i <= $maxStars; $i++)
    <button
      @if($interactive)
        @click="rating = {{ $i }}"
        @mouseenter="hoverRating = {{ $i }}"
        @mouseleave="hoverRating = 0"
        :class="hoverRating > 0 ? (hoverRating >= {{ $i }} ? 'text-yellow-400' : 'text-gray-300') : (rating >= {{ $i }} ? 'text-yellow-400' : 'text-gray-300')"
      @endif
      class="transition-colors {{ $sizeClass }} focus:outline-none hover:scale-110 transform {{ $interactive ? '' : ($rating >= $i ? 'text-yellow-400' : 'text-gray-300') }}"
      type="button"
    >
      <svg fill="currentColor" viewBox="0 0 20 20">
        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.381-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
      </svg>
    </button>
  @endfor

</div>
