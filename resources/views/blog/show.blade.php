@extends('layouts.app')

@section('title', Str::title(str_replace('-', ' ', $slug)) . ' — Blog NexaDev')

@php
    $related = [
        ['title' => 'Optimasi Query Eloquent', 'category' => 'Laravel', 'author' => 'Andi', 'date' => '5 Agustus 2026'],
        ['title' => 'Tailwind CSS untuk Pemula', 'category' => 'CSS', 'author' => 'Sinta', 'date' => '1 Agustus 2026'],
        ['title' => 'Deployment Laravel di VPS', 'category' => 'Deployment', 'author' => 'Budi', 'date' => '28 Juli 2026'],
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

<div class="max-w-6xl mx-auto px-4 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- Artikel --}}
        <div class="lg:col-span-2 space-y-6">
            <x-blog.post
                :title="Str::title(str_replace('-', ' ', $slug))"
                category="Laravel"
                author="Andi Wijaya"
                date="12 Agustus 2026"
                readTime="6"
                :views="'1.2K'"
                :tags="['Laravel', 'PHP', 'Web Development']"
            >
                <p>Laravel adalah framework PHP yang powerful dan ekspresif. Dengan ekosistem yang matang, Laravel memudahkan pengembangan aplikasi web modern — mulai dari routing, ORM, sampai queue.</p>
                <p>Berikut langkah awal memulai proyek Laravel:</p>
                <pre class="bg-gray-900 text-green-400 rounded-lg p-4 text-sm font-mono overflow-x-auto">composer create-project laravel/laravel blog
cd blog
php artisan serve</pre>
                <p>Setelah itu, Anda bisa mulai membangun fitur menggunakan Blade component, Eloquent model, dan migration.</p>
            </x-blog.post>

            {{-- Author --}}
            <x-blog.author-card
                name="Andi Wijaya"
                bio="Senior Laravel developer, menulis tentang PHP, Laravel, dan praktik web development modern."
                :socialLinks="[
                    ['label' => 'GitHub', 'icon' => '🐙', 'href' => '#'],
                    ['label' => 'Twitter', 'icon' => '🐦', 'href' => '#'],
                ]"
            />

            {{-- Komentar --}}
            <x-blog.widget title="Komentar (3)" icon="💬">
                <div class="space-y-4">
                    <x-blog.comment name="Budi" time="2 jam lalu" text="Artikel yang sangat membantu, terima kasih!" />
                    <div class="ml-8">
                        <x-blog.comment name="Andi Wijaya" time="1 jam lalu" text="Sama-sama, semoga bermanfaat!" :author="true" />
                    </div>
                    <x-blog.comment name="Sinta" time="30 menit lalu" text="Mantap, mau coba praktekan 🙂" />
                </div>
            </x-blog.widget>

            {{-- Artikel terkait --}}
            <x-blog.related-posts :posts="$related" />
        </div>

        {{-- Sidebar --}}
        <aside>
            <x-blog.sidebar>
                <x-blog.widget title="Kategori" icon="📂">
                    <x-blog.category-list :categories="[
                        ['name' => 'Laravel', 'count' => 12],
                        ['name' => 'CSS', 'count' => 8],
                        ['name' => 'Vue', 'count' => 5],
                    ]" />
                </x-blog.widget>

                <x-blog.widget title="Tag" icon="🏷️">
                    <x-blog.tag-cloud :tags="['Laravel', 'PHP', 'Tailwind', 'Alpine.js']" />
                </x-blog.widget>

                <x-blog.newsletter description="Ikuti artikel terbaru kami." />
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