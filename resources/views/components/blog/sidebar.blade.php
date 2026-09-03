{{-- Komponen Blog Sidebar — container sidebar untuk halaman artikel/berita --}}
@props([
    'sticky' => true,
])

<aside {{ $attributes->merge(['class' => 'space-y-6' . ($sticky ? ' lg:sticky lg:top-20' : '')]) }}>
    {{ $slot }}
</aside>