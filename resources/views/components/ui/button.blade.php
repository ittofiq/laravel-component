{{-- Komponen Tombol dengan Tailwind CSS --}}
@props(['type' => 'button', 'variant' => 'primary', 'size' => 'md', 'disabled' => false])

@php
  $baseClasses = 'font-semibold rounded-lg transition-colors duration-200 cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2';

  $variants = [
    'primary' => 'bg-blue-500 text-white hover:bg-blue-600 active:bg-blue-700 focus:ring-blue-400',
    'secondary' => 'bg-gray-200 text-gray-900 hover:bg-gray-300 active:bg-gray-400 focus:ring-gray-300',
    'danger' => 'bg-red-500 text-white hover:bg-red-600 active:bg-red-700 focus:ring-red-400',
    'success' => 'bg-green-500 text-white hover:bg-green-600 active:bg-green-700 focus:ring-green-400',
  ];

  $sizes = [
    'sm' => 'px-3 py-1.5 text-sm',
    'md' => 'px-4 py-2 text-base',
    'lg' => 'px-6 py-3 text-lg',
  ];

  $classes = "{$baseClasses} {$variants[$variant]} {$sizes[$size]}";
  $classes .= $disabled ? ' opacity-50 cursor-not-allowed' : '';
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }} @if($disabled) disabled @endif>
  {{ $slot }}
</button>


