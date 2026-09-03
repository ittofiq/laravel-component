@extends('layouts.app')

@section('title', 'Blog Components - BacaDev')

@section('content')
@php
    $img = 'data:image/svg+xml,'.rawurlencode('<svg xmlns="http://www.w3.org/2000/svg" width="800" height="450"><rect fill="#3B82F6" width="800" height="450"/><text x="50%" y="50%" text-anchor="middle" fill="white" font-size="28" font-weight="bold">Artikel</text></svg>');
@endphp

<div class="flex min-h-screen">
    @include('pages.components.sidebar', ['currentCategory' => 'blog'])

    <div class="flex-1 min-w-0 px-4 py-8">
        <h1 class="text-3xl font-bold mb-2 text-gray-900 dark:text-white">📰 Blog Components</h1>
        <p class="text-gray-600 dark:text-gray-400 mb-8">12 komponen: Article Card, Article Meta, Comment, Post, Author Card, Related Posts, Sidebar, Widget, Category List, Popular Posts, Tag Cloud, Newsletter</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">

            <x-ui.demo-card title="Article Card" component="blog.article-card" :props="[
                ['name' => 'title', 'type' => 'string', 'default' => '\'\'', 'description' => 'Judul artikel'],
                ['name' => 'excerpt', 'type' => 'string|null', 'default' => 'null', 'description' => 'Ringkasan singkat'],
                ['name' => 'image', 'type' => 'string|null', 'default' => 'null', 'description' => 'URL gambar utama'],
                ['name' => 'category', 'type' => 'string|null', 'default' => 'null', 'description' => 'Label kategori'],
                ['name' => 'categoryColor', 'type' => 'string', 'default' => '\'blue\'', 'description' => 'Warna kategori'],
                ['name' => 'author', 'type' => 'string|null', 'default' => 'null', 'description' => 'Nama penulis'],
                ['name' => 'date', 'type' => 'string|null', 'default' => 'null', 'description' => 'Tanggal terbit'],
                ['name' => 'readTime', 'type' => 'int|null', 'default' => 'null', 'description' => 'Durasi baca (menit)'],
                ['name' => 'views', 'type' => 'string|null', 'default' => 'null', 'description' => 'Jumlah dibaca/view'],
                ['name' => 'href', 'type' => 'string', 'default' => '\'#\'', 'description' => 'Link tujuan'],
            ]">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <x-blog.article-card
                        title="Membangun Website Software House"
                        excerpt="Panduan lengkap memulai website software house dari nol."
                        category="Web Development" categoryColor="blue"
                        author="Andi Wijaya" date="12 Agustus 2026" readTime="6" views="1.2K"
                        :image="$img"
                    />
                    <x-blog.article-card
                        title="Tips Optimasi Performa"
                        excerpt="Evaluasi ringkas untuk mempercepat aplikasi."
                        category="Tips & Trik" categoryColor="purple"
                        author="Citra Lestari" date="8 Agustus 2026" readTime="3"
                    />
                </div>
            </x-ui.demo-card>

            <x-ui.demo-card title="Article Meta" component="blog.article-meta" :props="[
                ['name' => 'author', 'type' => 'string|null', 'default' => 'null', 'description' => 'Nama penulis'],
                ['name' => 'authorAvatar', 'type' => 'string|null', 'default' => 'null', 'description' => 'URL avatar penulis'],
                ['name' => 'date', 'type' => 'string|null', 'default' => 'null', 'description' => 'Tanggal'],
                ['name' => 'readTime', 'type' => 'int|null', 'default' => 'null', 'description' => 'Durasi baca'],
                ['name' => 'views', 'type' => 'string|null', 'default' => 'null', 'description' => 'Jumlah dibaca'],
                ['name' => 'category', 'type' => 'string|null', 'default' => 'null', 'description' => 'Label kategori'],
                ['name' => 'categoryColor', 'type' => 'string', 'default' => '\'blue\'', 'description' => 'Warna badge kategori'],
            ]">
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-5">
                    <x-blog.article-meta author="Andi Wijaya" date="12 Agustus 2026" readTime="6" views="1.234" category="Web Development" categoryColor="blue" />
                </div>
            </x-ui.demo-card>

            <x-ui.demo-card title="Comment" component="blog.comment" :props="[
                ['name' => 'name', 'type' => 'string', 'default' => '\'\'', 'description' => 'Nama komentator'],
                ['name' => 'avatar', 'type' => 'string|null', 'default' => 'null', 'description' => 'URL avatar'],
                ['name' => 'time', 'type' => 'string|null', 'default' => 'null', 'description' => 'Waktu komentar'],
                ['name' => 'text', 'type' => 'string', 'default' => '\'\'', 'description' => 'Isi komentar'],
                ['name' => 'author', 'type' => 'bool', 'default' => 'false', 'description' => 'Tandai sebagai penulis artikel'],
                ['name' => 'replyable', 'type' => 'bool', 'default' => 'true', 'description' => 'Tampilkan tombol + form balas'],
            ]">
                <div class="space-y-5 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                    <x-blog.comment name="Budi Santoso" time="2 jam lalu" text="Artikel yang sangat membantu, terima kasih!">
                        <x-slot:replies>
                            <x-blog.comment name="Andi Wijaya" time="1 jam lalu" text="Sama-sama! Senang bisa membantu." :author="true" />
                            <x-blog.comment name="Citra Lestari" time="30 menit lalu" text="Ikutan berterima kasih 🙌" />
                        </x-slot:replies>
                    </x-blog.comment>
                </div>
            </x-ui.demo-card>

            <x-ui.demo-card title="Sidebar" component="blog.sidebar" :props="[
                ['name' => 'sticky', 'type' => 'bool', 'default' => 'true', 'description' => 'Sidebar menempel saat scroll (lg)'],
            ]">
                <div class="max-w-xs">
                    <x-blog.sidebar>
                        <x-blog.widget title="Kategori" icon="📂">
                            <x-blog.category-list :categories="[['name' => 'Web Development', 'count' => 12], ['name' => 'UI/UX Design', 'count' => 8], ['name' => 'Tips & Trik', 'count' => 15]]" />
                        </x-blog.widget>
                        <x-blog.newsletter description="Dapatkan artikel terbaru ke email Anda." />
                    </x-blog.sidebar>
                </div>
            </x-ui.demo-card>

            <x-ui.demo-card title="Widget" component="blog.widget" :props="[
                ['name' => 'title', 'type' => 'string|null', 'default' => 'null', 'description' => 'Judul widget'],
                ['name' => 'icon', 'type' => 'string|null', 'default' => 'null', 'description' => 'Ikon/emoji judul'],
            ]">
                <div class="max-w-xs">
                    <x-blog.widget title="Tags Populer" icon="🏷️">
                        <x-blog.tag-cloud :tags="['Laravel', 'Tailwind', 'Alpine.js', 'Vue', 'PHP']" />
                    </x-blog.widget>
                </div>
            </x-ui.demo-card>

            <x-ui.demo-card title="Category List" component="blog.category-list" :props="[
                ['name' => 'categories', 'type' => 'array', 'default' => '[]', 'description' => 'Item: name, count, href'],
            ]">
                <x-blog.widget title="Kategori" icon="📂">
                    <x-blog.category-list :categories="[['name' => 'Web Development', 'count' => 12], ['name' => 'UI/UX Design', 'count' => 8], ['name' => 'DevOps', 'count' => 5]]" />
                </x-blog.widget>
            </x-ui.demo-card>

            <x-ui.demo-card title="Popular Posts" component="blog.popular-posts" :props="[
                ['name' => 'posts', 'type' => 'array', 'default' => '[]', 'description' => 'Item: title, date, image, href'],
            ]">
                <x-blog.widget title="Artikel Terpopuler" icon="🔥">
                    <x-blog.popular-posts :posts="[
                        ['title' => 'Membangun Website Software House', 'date' => '12 Agustus 2026'],
                        ['title' => '5 Tren Desain UI 2026', 'date' => '10 Agustus 2026'],
                        ['title' => 'Optimasi Performa Laravel', 'date' => '8 Agustus 2026'],
                    ]" />
                </x-blog.widget>
            </x-ui.demo-card>

            <x-ui.demo-card title="Tag Cloud" component="blog.tag-cloud" :props="[
                ['name' => 'tags', 'type' => 'array', 'default' => '[]', 'description' => 'String atau [label, href]'],
            ]">
                <x-blog.widget title="Tags" icon="🏷️">
                    <x-blog.tag-cloud :tags="['Laravel', 'Tailwind', 'Alpine.js', 'Vue', 'React', 'PHP', 'CSS', 'JavaScript']" />
                </x-blog.widget>
            </x-ui.demo-card>

            <x-ui.demo-card title="Newsletter" component="blog.newsletter" :props="[
                ['name' => 'title', 'type' => 'string', 'default' => '\'Newsletter\''],
                ['name' => 'description', 'type' => 'string|null', 'default' => 'null'],
                ['name' => 'placeholder', 'type' => 'string', 'default' => '\'Email Anda\''],
                ['name' => 'buttonText', 'type' => 'string', 'default' => '\'Langganan\''],
            ]">
                <div class="max-w-xs">
                    <x-blog.widget>
                        <x-blog.newsletter title="Berlangganan" description="Dapatkan artikel terbaru ke email Anda." placeholder="email@contoh.com" buttonText="Langganan" />
                    </x-blog.widget>
                </div>
            </x-ui.demo-card>

            <x-ui.demo-card title="Post" component="blog.post" :props="[
                ['name' => 'title', 'type' => 'string', 'default' => '\'\'', 'description' => 'Judul artikel'],
                ['name' => 'image', 'type' => 'string|null', 'default' => 'null', 'description' => 'Gambar utama'],
                ['name' => 'category', 'type' => 'string|null', 'default' => 'null', 'description' => 'Kategori'],
                ['name' => 'author', 'type' => 'string|null', 'default' => 'null', 'description' => 'Penulis'],
                ['name' => 'date', 'type' => 'string|null', 'default' => 'null', 'description' => 'Tanggal'],
                ['name' => 'readTime', 'type' => 'int|null', 'default' => 'null', 'description' => 'Durasi baca'],
                ['name' => 'views', 'type' => 'string|null', 'default' => 'null', 'description' => 'Jumlah dibaca'],
                ['name' => 'tags', 'type' => 'array', 'default' => '[]', 'description' => 'Tag di footer artikel'],
            ]">
                <x-blog.post
                    title="Membangun Website Software House dengan Laravel"
                    :image="$img"
                    category="Web Development" categoryColor="blue"
                    author="Andi Wijaya" date="12 Agustus 2026" readTime="6" views="1.234"
                    :tags="['Laravel', 'Tailwind CSS', 'Alpine.js']"
                >
                    <p>Laravel adalah framework PHP yang powerful untuk membangun website software house. Dengan ekosistem yang matang, Anda bisa fokus pada fitur bisnis, bukan boilerplate.</p>
                    <p>Dipadukan dengan komponen BacaDev, halaman demi halaman bisa dirakit dalam hitungan menit — termasuk blog, landing page, dan dashboard admin.</p>
                </x-blog.post>
            </x-ui.demo-card>

            <x-ui.demo-card title="Author Card" component="blog.author-card" :props="[
                ['name' => 'name', 'type' => 'string', 'default' => '\'\'', 'description' => 'Nama penulis'],
                ['name' => 'avatar', 'type' => 'string|null', 'default' => 'null', 'description' => 'URL avatar'],
                ['name' => 'bio', 'type' => 'string|null', 'default' => 'null', 'description' => 'Bio singkat'],
                ['name' => 'socialLinks', 'type' => 'array', 'default' => '[]', 'description' => 'label + icon + href'],
            ]">
                <x-blog.author-card
                    name="Andi Wijaya"
                    bio="Full-stack developer yang berfokus pada Laravel, Tailwind CSS, dan membangun developer tools."
                    :socialLinks="[
                        ['label' => 'GitHub', 'icon' => '🐙', 'href' => '#'],
                        ['label' => 'Twitter', 'icon' => '🐦', 'href' => '#'],
                        ['label' => 'LinkedIn', 'icon' => '💼', 'href' => '#'],
                    ]"
                />
            </x-ui.demo-card>

            <x-ui.demo-card title="Related Posts" component="blog.related-posts" :props="[
                ['name' => 'title', 'type' => 'string', 'default' => '\'Artikel Terkait\''],
                ['name' => 'posts', 'type' => 'array', 'default' => '[]', 'description' => 'Array untuk article-card'],
            ]">
                <x-blog.related-posts :posts="[
                    ['title' => '5 Tren Desain UI 2026', 'excerpt' => 'Dari glassmorphism sampai dark mode.', 'category' => 'UI/UX', 'categoryColor' => 'green', 'author' => 'Budi Santoso', 'date' => '10 Agustus 2026', 'readTime' => 4],
                    ['title' => 'Optimasi Performa Laravel', 'excerpt' => 'Evaluasi ringkas untuk loading lebih cepat.', 'category' => 'Tips & Trik', 'categoryColor' => 'purple', 'author' => 'Citra Lestari', 'date' => '8 Agustus 2026', 'readTime' => 3],
                ]" />
            </x-ui.demo-card>

        </div>
    </div>
</div>
@endsection