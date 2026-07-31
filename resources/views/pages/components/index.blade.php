@extends('layouts.app')

@section('title', 'BacaDev - Component Library')

@section('content')
<div class="flex min-h-screen">
    @include('pages.components.sidebar', ['currentCategory' => null])

    <div class="flex-1 min-w-0 px-4 py-8">
        <h1 class="text-4xl font-bold mb-2 text-gray-900 dark:text-white">BacaDev Component Library</h1>
        <p class="text-gray-600 dark:text-gray-400 mb-8">101 Komponen dalam 8 Kategori • Dark Mode • Responsive</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
            @php
                $categories = [
                    'ui' => ['icon' => '🎨', 'label' => 'UI Components', 'count' => 23, 'desc' => 'Button, Badge, Avatar, Avatar Group, Card, Tag, Chip, Divider, Cookie Consent, Share Button, Drag & Drop, Tree View, Command Palette, Context Menu, Scroll to Top, Lazy Image, Countdown, Dark Mode Preview, Notification Badge, Code Block, Live Code Editor, Mobile Preview, Image Compare, Page Skeleton', 'color' => 'blue'],
                    'form' => ['icon' => '📝', 'label' => 'Form Components', 'count' => 27, 'desc' => 'Input, Password, OTP, Chip Input, Range Slider, Input Group, Floating Label, Select, Toggle, Rating, File Upload, Date Picker, Rich Text, Color Picker', 'color' => 'green'],
                    'data' => ['icon' => '📊', 'label' => 'Data Components', 'count' => 9, 'desc' => 'Table, Advanced Table, Timeline, Kanban, Calendar, Charts, Progress Bar, Stat Card, Card Grid', 'color' => 'purple'],
                    'navigation' => ['icon' => '🧭', 'label' => 'Navigation', 'count' => 9, 'desc' => 'Navbar, Breadcrumb, Pagination, Tabs, Stepper, Dropdown, Mobile Menu, Sidebar', 'color' => 'orange'],
                    'overlay' => ['icon' => '🪟', 'label' => 'Overlay', 'count' => 8, 'desc' => 'Modal, Drawer, Tooltip, Popover, Confirm Dialog, Bottom Sheet, Lightbox, Video Modal', 'color' => 'pink'],
                    'feedback' => ['icon' => '🔔', 'label' => 'Feedback', 'count' => 6, 'desc' => 'Alert, Toast, Toast Container, Spinner, Skeleton, Empty State', 'color' => 'red'],
                    'layout' => ['icon' => '🏗️', 'label' => 'Layout', 'count' => 11, 'desc' => 'Hero, Section, Container, Grid, Footer, FAQ, Gallery, Accordion, Carousel, Masonry Grid, Waterfall Layout', 'color' => 'indigo'],
                    'custom' => ['icon' => '🎁', 'label' => 'Custom', 'count' => 8, 'desc' => 'Loader, Rating Stars, Shopping Cart, User Profile, Permission System, Pricing Card, Protected Button, 2FA Auth', 'color' => 'yellow'],
                ];

                $colorClasses = [
                    'blue' => [
                        'border' => 'hover:border-blue-400 dark:hover:border-blue-500',
                        'text' => 'group-hover:text-blue-600 dark:group-hover:text-blue-400',
                        'badge' => 'bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300',
                        'chevron' => 'group-hover:text-blue-400',
                    ],
                    'green' => [
                        'border' => 'hover:border-green-400 dark:hover:border-green-500',
                        'text' => 'group-hover:text-green-600 dark:group-hover:text-green-400',
                        'badge' => 'bg-green-50 dark:bg-green-900/30 text-green-700 dark:text-green-300',
                        'chevron' => 'group-hover:text-green-400',
                    ],
                    'purple' => [
                        'border' => 'hover:border-purple-400 dark:hover:border-purple-500',
                        'text' => 'group-hover:text-purple-600 dark:group-hover:text-purple-400',
                        'badge' => 'bg-purple-50 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300',
                        'chevron' => 'group-hover:text-purple-400',
                    ],
                    'orange' => [
                        'border' => 'hover:border-orange-400 dark:hover:border-orange-500',
                        'text' => 'group-hover:text-orange-600 dark:group-hover:text-orange-400',
                        'badge' => 'bg-orange-50 dark:bg-orange-900/30 text-orange-700 dark:text-orange-300',
                        'chevron' => 'group-hover:text-orange-400',
                    ],
                    'pink' => [
                        'border' => 'hover:border-pink-400 dark:hover:border-pink-500',
                        'text' => 'group-hover:text-pink-600 dark:group-hover:text-pink-400',
                        'badge' => 'bg-pink-50 dark:bg-pink-900/30 text-pink-700 dark:text-pink-300',
                        'chevron' => 'group-hover:text-pink-400',
                    ],
                    'red' => [
                        'border' => 'hover:border-red-400 dark:hover:border-red-500',
                        'text' => 'group-hover:text-red-600 dark:group-hover:text-red-400',
                        'badge' => 'bg-red-50 dark:bg-red-900/30 text-red-700 dark:text-red-300',
                        'chevron' => 'group-hover:text-red-400',
                    ],
                    'indigo' => [
                        'border' => 'hover:border-indigo-400 dark:hover:border-indigo-500',
                        'text' => 'group-hover:text-indigo-600 dark:group-hover:text-indigo-400',
                        'badge' => 'bg-indigo-50 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300',
                        'chevron' => 'group-hover:text-indigo-400',
                    ],
                    'yellow' => [
                        'border' => 'hover:border-yellow-400 dark:hover:border-yellow-500',
                        'text' => 'group-hover:text-yellow-600 dark:group-hover:text-yellow-400',
                        'badge' => 'bg-yellow-50 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-300',
                        'chevron' => 'group-hover:text-yellow-400',
                    ],
                ];
            @endphp

            @foreach($categories as $key => $cat)
                @php $cls = $colorClasses[$cat['color']]; @endphp
                <a href="{{ route('components.category', $key) }}"
                    class="block p-6 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 {{ $cls['border'] }} hover:shadow-lg transition-all group">
                    <div class="flex items-start gap-4">
                        <span class="text-3xl">{{ $cat['icon'] }}</span>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-bold text-lg text-gray-900 dark:text-white {{ $cls['text'] }} transition-colors">
                                {{ $cat['label'] }}
                            </h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $cat['desc'] }}</p>
                            <span class="inline-block mt-2 text-xs font-medium px-2 py-0.5 rounded-full {{ $cls['badge'] }}">
                                {{ $cat['count'] }} komponen
                            </span>
                        </div>
                        <svg class="w-5 h-5 text-gray-300 dark:text-gray-600 {{ $cls['chevron'] }} transition-colors mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
@endsection
