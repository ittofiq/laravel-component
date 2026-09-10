@extends('layouts.app')

@section('title', 'Blog — NexaDev')

@php
    $articles = [
        ['title' => 'Belajar Laravel untuk Pemula', 'excerpt' => 'Panduan langkah demi langkah memulai Laravel, dari instalasi sampai deployment.', 'category' => 'Laravel', 'categoryColor' => 'blue', 'author' => 'Andi Wijaya', 'date' => '12 Agustus 2026', 'readTime' => '6', 'image' => 'https://picsum.photos/seed/laravel/400/225'],
        ['title' => 'Tailwind CSS: Utility-First yang Efisien', 'excerpt' => 'Mengapa Tailwind mempercepat development dan cara memulainya.', 'category' => 'CSS', 'categoryColor' => 'green', 'author' => 'Sinta', 'date' => '8 Agustus 2026', 'readTime' => '4', 'image' => 'https://picsum.photos/seed/tailwind/400/225'],
        ['title' => 'Membangun Admin Panel dengan Blade Component', 'excerpt' => 'Rakit admin panel modular pakai Blade component & Alpine.js.', 'category' => 'Laravel', 'categoryColor' => 'purple', 'author' => 'Andi Wijaya', 'date' => '2 Agustus 2026', 'readTime' => '8', 'image' => 'https://picsum.photos/seed/admin/400/225'],
    ];

    $categories = [
        ['name' => 'Laravel', 'count' => 12],
        ['name' => 'CSS', 'count' => 8],
        ['name' => 'Vue', 'count' => 5],
        ['name' => 'Deployment', 'count' => 3],
    ];

    $popular = [
        ['title' => 'Belajar Laravel untuk Pemula', 'date' => '12 Agustus 2026'],
        ['title' => 'Optimasi Query Eloquent', 'date' => '5 Agustus 2026'],
        ['title' => 'Tailwind CSS untuk Pemula', 'date' => '1 Agustus 2026'],
    ];
@endphp

@section('content')
{{-- Navbar --}}
<x-navigation.navbar
    brand="NexaDev"
    :links="[
        ['label' => 'Beranda', 'href' => '/software-house'],
        ['label' => 'Blog', 'href' => '/blog', 'active' => true],
        ['label' => 'Kontak', 'href' => '#kontak'],
    ]"
    :fixed="false"
    variant="colored"
    :shadow="false"
/>

{{-- Hero --}}
<x-layout.hero title="Blog & Artikel" subtitle="Tulisan terbaru seputar web development, Laravel, dan dunia software." />

{{-- Content --}}
<div class="max-w-6xl mx-auto px-4 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:items-start">

        {{-- Artikel --}}
        <div class="lg:col-span-2 space-y-6 max-w-2xl">
            @foreach($articles as $article)
                <x-blog.article-card
                    :title="$article['title']"
                    :excerpt="$article['excerpt']"
                    :category="$article['category']"
                    :category-color="$article['categoryColor']"
                    :author="$article['author']"
                    :date="$article['date']"
                    :read-time="$article['readTime']"
                    :image="$article['image']"
                    href="/blog/{{ Str::slug($article['title']) }}"
                    :horizontal="true"
                />
            @endforeach
        </div>

        {{-- Sidebar --}}
        <aside>
            <x-blog.sidebar>
                <x-blog.widget title="Kategori" icon="📂">
                    <x-blog.category-list :categories="$categories" />
                </x-blog.widget>

                <x-blog.widget title="Terpopuler" icon="🔥">
                    <x-blog.popular-posts :posts="$popular" />
                </x-blog.widget>

                <x-blog.widget title="Tag" icon="🏷️">
                    <x-blog.tag-cloud :tags="['Laravel', 'Tailwind', 'Vue', 'Alpine.js', 'Deployment', 'PHP']" />
                </x-blog.widget>

                <x-blog.newsletter description="Dapatkan artikel terbaru langsung ke inbox Anda." />
            </x-blog.sidebar>
        </aside>
    </div>
</div>

{{-- Footer --}}
<x-layout.footer
    brand="NexaDev"
    description="Software house yang membantu bisnis tumbuh lewat produk digital."
    :links="[
        ['title' => 'Produk', 'items' => [['label' => 'Beranda', 'href' => '/software-house'], ['label' => 'Blog', 'href' => '/blog']]],
        ['title' => 'Perusahaan', 'items' => [['label' => 'Tentang', 'href' => '/software-house'], ['label' => 'Kontak', 'href' => '/software-house#kontak']]],
    ]"
    :socialLinks="[
        ['label' => 'GitHub', 'icon' => '🐙', 'href' => '#'],
        ['label' => 'Twitter', 'icon' => '🐦', 'href' => '#'],
        ['label' => 'LinkedIn', 'icon' => '💼', 'href' => '#'],
    ]"
    copyright="© 2026 NexaDev. All rights reserved."
/>
@endsection