{{-- Komponen Badge dengan Tailwind CSS --}}
@props(['variant' => 'primary', 'size' => 'md'])

@php
  $variants = [
    'primary' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300',
    'secondary' => 'bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-gray-300',
    'success' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300',
    'warning' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300',
    'danger' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300',
  ];

  $sizes = [
    'xs' => 'px-1.5 py-0.5 text-[10px]',
    'sm' => 'px-2 py-1 text-xs',
    'md' => 'px-3 py-1.5 text-sm',
    'lg' => 'px-4 py-2 text-base',
    'xl' => 'px-5 py-2.5 text-lg',
  ];

  $classes = "inline-block rounded-full font-semibold {$variants[$variant]} {$sizes[$size]}";
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
  {{ $slot }}
</span>
