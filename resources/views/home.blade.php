@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-16">
    {{-- Hero --}}
    <div class="text-center mb-16">
        <h1 class="text-6xl font-bold text-gray-900 dark:text-white mb-4">🎨 BacaDev</h1>
        <p class="text-2xl text-gray-600 dark:text-gray-400 mb-2">Tailwind CSS Component Library untuk Laravel</p>
        <p class="text-lg text-gray-500 dark:text-gray-400">101 Komponen • 8 Kategori • Dark Mode • Responsive</p>
    </div>

    {{-- CTA --}}
    <div class="max-w-3xl mx-auto mb-20">
        <a href="{{ route('components') }}" class="block w-full py-5 px-8 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-xl font-bold text-center hover:shadow-2xl transition text-xl">
            📦 Jelajahi 101 Komponen
        </a>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-20 max-w-3xl mx-auto">
        <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow text-center">
            <p class="text-3xl font-bold text-blue-500">101</p>
            <p class="text-sm text-gray-500 dark:text-gray-400">Komponen</p>
        </div>
        <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow text-center">
            <p class="text-3xl font-bold text-green-500">8</p>
            <p class="text-sm text-gray-500 dark:text-gray-400">Kategori</p>
        </div>
        <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow text-center">
            <p class="text-3xl font-bold text-purple-500">100%</p>
            <p class="text-sm text-gray-500 dark:text-gray-400">Dark Mode</p>
        </div>
        <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow text-center">
            <p class="text-3xl font-bold text-orange-500">0</p>
            <p class="text-sm text-gray-500 dark:text-gray-400">Dependencies</p>
        </div>
    </div>

    {{-- Categories --}}
    <div class="mb-20">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-10 text-center">📂 Kategori Komponen</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            @php
                $categories = [
                    ['route' => 'components.category', 'param' => 'ui', 'icon' => '🎨', 'label' => 'UI', 'count' => 23, 'desc' => 'Button, Badge, Avatar, Card, Tag, Chip, Divider, Cookie Consent, Share Button, Drag & Drop, Tree View, Command Palette, Context Menu, Scroll to Top, Lazy Image, Countdown, Dark Mode Preview, Notification Badge, Code Block, Live Code Editor, Mobile Preview, Image Compare, Page Skeleton', 'color' => 'blue'],
                    ['route' => 'components.category', 'param' => 'form', 'icon' => '📝', 'label' => 'Form', 'count' => 27, 'desc' => 'Input, Password, OTP, Chip Input, Range Slider, Input Group, Floating Label, Select, Toggle, Rating, Date Picker, Rich Text, Color Picker', 'color' => 'green'],
                    ['route' => 'components.category', 'param' => 'data', 'icon' => '📊', 'label' => 'Data', 'count' => 9, 'desc' => 'Table, Advanced Table, Timeline, Kanban, Calendar, Charts, Progress Bar, Stat Card, Card Grid', 'color' => 'purple'],
                    ['route' => 'components.category', 'param' => 'navigation', 'icon' => '🧭', 'label' => 'Navigation', 'count' => 9, 'desc' => 'Navbar, Breadcrumb, Pagination, Tabs, Stepper, Dropdown, Mobile Menu, Sidebar', 'color' => 'orange'],
                    ['route' => 'components.category', 'param' => 'overlay', 'icon' => '🪟', 'label' => 'Overlay', 'count' => 8, 'desc' => 'Modal, Drawer, Tooltip, Popover, Confirm Dialog, Bottom Sheet, Lightbox, Video Modal', 'color' => 'pink'],
                    ['route' => 'components.category', 'param' => 'feedback', 'icon' => '🔔', 'label' => 'Feedback', 'count' => 6, 'desc' => 'Alert, Toast, Toast Container, Spinner, Skeleton, Empty State', 'color' => 'red'],
                    ['route' => 'components.category', 'param' => 'layout', 'icon' => '🏗️', 'label' => 'Layout', 'count' => 11, 'desc' => 'Hero, Section, Container, Grid, Footer, FAQ, Gallery, Accordion, Carousel, Masonry Grid, Waterfall Layout', 'color' => 'indigo'],
                    ['route' => 'components.category', 'param' => 'custom', 'icon' => '🎁', 'label' => 'Custom', 'count' => 8, 'desc' => 'Loader, Rating Stars, Shopping Cart, User Profile, Permission System, Pricing Card, Protected Button, 2FA Auth', 'color' => 'yellow'],
                ];

                $colorClasses = [
                    'blue' => ['border' => 'hover:border-blue-400 dark:hover:border-blue-500', 'text' => 'group-hover:text-blue-600 dark:group-hover:text-blue-400', 'badge' => 'bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300'],
                    'green' => ['border' => 'hover:border-green-400 dark:hover:border-green-500', 'text' => 'group-hover:text-green-600 dark:group-hover:text-green-400', 'badge' => 'bg-green-50 dark:bg-green-900/30 text-green-700 dark:text-green-300'],
                    'purple' => ['border' => 'hover:border-purple-400 dark:hover:border-purple-500', 'text' => 'group-hover:text-purple-600 dark:group-hover:text-purple-400', 'badge' => 'bg-purple-50 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300'],
                    'orange' => ['border' => 'hover:border-orange-400 dark:hover:border-orange-500', 'text' => 'group-hover:text-orange-600 dark:group-hover:text-orange-400', 'badge' => 'bg-orange-50 dark:bg-orange-900/30 text-orange-700 dark:text-orange-300'],
                    'pink' => ['border' => 'hover:border-pink-400 dark:hover:border-pink-500', 'text' => 'group-hover:text-pink-600 dark:group-hover:text-pink-400', 'badge' => 'bg-pink-50 dark:bg-pink-900/30 text-pink-700 dark:text-pink-300'],
                    'red' => ['border' => 'hover:border-red-400 dark:hover:border-red-500', 'text' => 'group-hover:text-red-600 dark:group-hover:text-red-400', 'badge' => 'bg-red-50 dark:bg-red-900/30 text-red-700 dark:text-red-300'],
                    'indigo' => ['border' => 'hover:border-indigo-400 dark:hover:border-indigo-500', 'text' => 'group-hover:text-indigo-600 dark:group-hover:text-indigo-400', 'badge' => 'bg-indigo-50 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300'],
                    'yellow' => ['border' => 'hover:border-yellow-400 dark:hover:border-yellow-500', 'text' => 'group-hover:text-yellow-600 dark:group-hover:text-yellow-400', 'badge' => 'bg-yellow-50 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-300'],
                ];
            @endphp

            @foreach($categories as $cat)
                @php $cls = $colorClasses[$cat['color']]; @endphp
                <a href="{{ route($cat['route'], $cat['param']) }}"
                    class="block p-5 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 {{ $cls['border'] }} hover:shadow-lg transition group">
                    <p class="text-3xl mb-2">{{ $cat['icon'] }}</p>
                    <h3 class="font-bold text-gray-900 dark:text-white {{ $cls['text'] }} transition-colors">{{ $cat['label'] }} Components</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $cat['desc'] }}</p>
                    <span class="inline-block mt-2 text-xs font-medium px-2 py-0.5 rounded-full {{ $cls['badge'] }}">{{ $cat['count'] }} komponen</span>
                </a>
            @endforeach
        </div>
    </div>

    {{-- Features --}}
    <div class="mb-20">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-10 text-center">✨ Fitur</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl mx-auto">
            <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow text-center">
                <p class="text-3xl mb-2">🌙</p>
                <h3 class="font-bold text-gray-900 dark:text-white">Dark Mode</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Full support di semua komponen</p>
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow text-center">
                <p class="text-3xl mb-2">📱</p>
                <h3 class="font-bold text-gray-900 dark:text-white">Responsive</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Mobile-first di semua ukuran layar</p>
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow text-center">
                <p class="text-3xl mb-2">⚡</p>
                <h3 class="font-bold text-gray-900 dark:text-white">Zero Dependencies</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Hanya Tailwind CSS + Alpine.js</p>
            </div>
        </div>
    </div>

    {{-- Quick Start --}}
    <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl p-12 text-white text-center mb-16 max-w-3xl mx-auto">
        <h2 class="text-3xl font-bold mb-4">🚀 Quick Start</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 max-w-xl mx-auto text-left">
            <div class="bg-black/20 rounded-lg p-4">
                <p class="font-bold mb-1">Terminal 1</p>
                <code class="text-sm">php artisan serve</code>
            </div>
            <div class="bg-black/20 rounded-lg p-4">
                <p class="font-bold mb-1">Terminal 2</p>
                <code class="text-sm">npm run dev</code>
            </div>
        </div>
        <p class="text-sm mt-5 opacity-80">Buka <a href="{{ route('components') }}" class="underline">/components</a> untuk melihat library</p>
    </div>

    {{-- Footer --}}
    <div class="text-center text-gray-500 dark:text-gray-400 text-sm">
        <p class="mb-1">BacaDev Component Library v5.2 • 101 Komponen</p>
        <p>Tailwind CSS + Laravel + Alpine.js</p>
    </div>
</div>
@endsection