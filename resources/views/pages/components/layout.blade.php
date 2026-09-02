@extends('layouts.app')
@section('title', 'Layout - BacaDev')
@section('content')
<div class="flex min-h-screen">
    @include('pages.components.sidebar', ['currentCategory' => 'layout'])
    <div class="flex-1 min-w-0 px-4 py-8">
        <h1 class="text-3xl font-bold mb-2 text-gray-900 dark:text-white">🏗️ Layout</h1>
        <p class="text-gray-600 dark:text-gray-400 mb-8">11 komponen: Hero, Section, Container, Grid, Footer, FAQ, Image Gallery, Accordion, Carousel, Masonry Grid, Waterfall Layout</p>
        <div class="grid grid-cols-1 gap-6">

            <x-ui.demo-card title="Hero" component="layout.hero" :props="[
                ['name' => 'title', 'type' => 'string', 'default' => '—', 'description' => 'Judul utama'],
                ['name' => 'subtitle', 'type' => 'string|null', 'default' => 'null', 'description' => 'Sub judul'],
                ['name' => 'image', 'type' => 'string|null', 'default' => 'null', 'description' => 'URL gambar'],
            ]">
                <x-layout.hero title="Welcome to BacaDev" subtitle="100+ component library built with Tailwind CSS" />
            </x-ui.demo-card>

            <x-ui.demo-card title="Section" component="layout.section" :props="[
                ['name' => 'title', 'type' => 'string|null', 'default' => 'null'],
                ['name' => 'subtitle', 'type' => 'string|null', 'default' => 'null'],
                ['name' => 'centered', 'type' => 'bool', 'default' => 'false', 'description' => 'Konten rata tengah'],
            ]">
                <x-layout.section title="Section Title" subtitle="With a subtitle"><p class="text-gray-600 dark:text-gray-400">Section content</p></x-layout.section>
            </x-ui.demo-card>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                <x-ui.demo-card title="Container" component="layout.container" :props="[]">
                    <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-4 text-center text-sm text-gray-600 dark:text-gray-400">Container max-width (tanpa props)</div>
                </x-ui.demo-card>

                <x-ui.demo-card title="Grid" component="layout.grid" :props="[
                    ['name' => 'cols', 'type' => 'int', 'default' => '3', 'description' => 'Jumlah kolom'],
                    ['name' => 'gap', 'type' => 'int', 'default' => '6', 'description' => 'Jarak antar kolom'],
                    ['name' => 'responsive', 'type' => 'bool', 'default' => 'true', 'description' => 'Responsive breakpoint'],
                ]">
                    <x-layout.grid :cols="3" :gap="4">
                        <div class="p-4 bg-blue-50 dark:bg-blue-900/30 rounded text-center text-sm">1</div>
                        <div class="p-4 bg-green-50 dark:bg-green-900/30 rounded text-center text-sm">2</div>
                        <div class="p-4 bg-purple-50 dark:bg-purple-900/30 rounded text-center text-sm">3</div>
                    </x-layout.grid>
                </x-ui.demo-card>
            </div>

            <x-ui.demo-card title="FAQ" component="layout.faq" :props="[
                ['name' => 'faqs', 'type' => 'array', 'default' => '[]', 'description' => 'Pertanyaan: question, answer'],
                ['name' => 'expanded', 'type' => 'int|null', 'default' => 'null', 'description' => 'Indeks FAQ terbuka default'],
            ]">
                <x-layout.faq :faqs="[
                    ['question' => 'Apa itu BacaDev?', 'answer' => 'Component library Tailwind CSS untuk Laravel.'],
                    ['question' => 'Apakah support dark mode?', 'answer' => 'Ya, semua komponen mendukung dark mode.'],
                ]" />
            </x-ui.demo-card>

            <x-ui.demo-card title="Accordion" component="layout.accordion" :props="[
                ['name' => 'items', 'type' => 'array', 'default' => '[]', 'description' => 'Item: title, content'],
            ]">
                <x-layout.accordion :items="[
                    ['title' => 'What is BacaDev?', 'content' => 'A Tailwind CSS component library for Laravel.'],
                    ['title' => 'Is it free?', 'content' => 'Yes, open-source and free.'],
                ]" />
            </x-ui.demo-card>

            <x-ui.demo-card title="Carousel" component="layout.carousel" :props="[
                ['name' => 'items', 'type' => 'array', 'default' => '[]', 'description' => 'URL gambar slide'],
                ['name' => 'autoplay', 'type' => 'bool', 'default' => 'false', 'description' => 'Putar otomatis'],
                ['name' => 'interval', 'type' => 'int', 'default' => '5000', 'description' => 'Interval autoplay (ms)'],
                ['name' => 'showControls', 'type' => 'bool', 'default' => 'true', 'description' => 'Tombol prev/next'],
                ['name' => 'showIndicators', 'type' => 'bool', 'default' => 'true', 'description' => 'Titik indikator'],
            ]">
                <x-layout.carousel :items="[
                    'data:image/svg+xml,'.rawurlencode('<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'800\' height=\'400\'><rect fill=\'#dbeafe\' width=\'800\' height=\'400\'/><text x=\'50%\' y=\'50%\' text-anchor=\'middle\' dy=\'.3em\' fill=\'#1d4ed8\' font-size=\'24\'>Slide 1</text></svg>'),
                    'data:image/svg+xml,'.rawurlencode('<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'800\' height=\'400\'><rect fill=\'#d1fae5\' width=\'800\' height=\'400\'/><text x=\'50%\' y=\'50%\' text-anchor=\'middle\' dy=\'.3em\' fill=\'#065f46\' font-size=\'24\'>Slide 2</text></svg>'),
                ]" :autoplay="true" />
            </x-ui.demo-card>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                <x-ui.demo-card title="Image Gallery" component="layout.image-gallery" :props="[
                    ['name' => 'images', 'type' => 'array', 'default' => '[]'],
                    ['name' => 'columns', 'type' => 'int', 'default' => '3', 'description' => 'Jumlah kolom'],
                ]">
                    <x-layout.image-gallery :images="[
                        'data:image/svg+xml,'.rawurlencode('<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'300\' height=\'200\'><rect fill=\'#dbeafe\' width=\'300\' height=\'200\'/><text x=\'50%\' y=\'50%\' text-anchor=\'middle\' dy=\'.3em\' fill=\'#1d4ed8\' font-size=\'14\'>Img 1</text></svg>'),
                        'data:image/svg+xml,'.rawurlencode('<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'300\' height=\'200\'><rect fill=\'#d1fae5\' width=\'300\' height=\'200\'/><text x=\'50%\' y=\'50%\' text-anchor=\'middle\' dy=\'.3em\' fill=\'#065f46\' font-size=\'14\'>Img 2</text></svg>'),
                    ]" :columns="2" />
                </x-ui.demo-card>

                <x-ui.demo-card title="Masonry Grid" component="layout.masonry-grid" :props="[
                    ['name' => 'items', 'type' => 'array', 'default' => '[]', 'description' => 'Item: title, description, image'],
                ]">
                    <x-layout.masonry-grid :items="[
                        ['title' => 'Getting Started', 'description' => 'Quick setup guide.'],
                        ['title' => 'Components', 'description' => 'Explore all components.'],
                        ['title' => 'Dark Mode', 'description' => 'Full dark mode support.'],
                    ]" />
                </x-ui.demo-card>
            </div>

            <x-ui.demo-card title="Footer" component="layout.footer" :props="[
                ['name' => 'brand', 'type' => 'string', 'default' => '\'BacaDev\''],
                ['name' => 'description', 'type' => 'string|null', 'default' => 'null'],
                ['name' => 'links', 'type' => 'array', 'default' => '[]', 'description' => 'Kolom: title + items'],
                ['name' => 'socialLinks', 'type' => 'array', 'default' => '[]', 'description' => 'label, icon, href'],
                ['name' => 'copyright', 'type' => 'string|null', 'default' => 'null'],
            ]">
                <x-layout.footer brand="BacaDev" description="Component Library Tailwind CSS untuk Laravel." :links="[
                    ['title' => 'Components', 'items' => [['label' => 'UI', 'href' => '/components/ui'], ['label' => 'Form', 'href' => '/components/form']]],
                ]" :socialLinks="[['label' => 'GitHub', 'icon' => '🐙', 'href' => '#']]" />
            </x-ui.demo-card>

            <x-ui.demo-card title="Waterfall Layout" component="layout.waterfall-layout" :props="[
                ['name' => 'items', 'type' => 'array', 'default' => '[]', 'description' => 'Item: image, title, description'],
            ]">
                <x-layout.waterfall-layout :items="[
                    ['title' => 'Getting Started', 'description' => 'Quick setup guide.'],
                    ['title' => 'Components', 'description' => 'Explore all components.'],
                    ['title' => 'Dark Mode', 'description' => 'Full dark mode support.'],
                ]" />
            </x-ui.demo-card>

        </div>
    </div>
</div>
@endsection