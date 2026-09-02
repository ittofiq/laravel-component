<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Terapkan tema sebelum CSS load, mencegah flash tema --}}
    <script>
        (function () {
            var t = localStorage.getItem('theme');
            if (t === 'dark' || (!t && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>
    <title>@yield('title', 'Admin') - BacaDev Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.ts'])
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100" x-data="darkMode()">

@php
    $active = $active ?? 'dashboard';
    $navItems = [
        ['id' => 'dashboard', 'label' => 'Dashboard', 'icon' => '📊', 'href' => '/admin'],
        ['id' => 'users', 'label' => 'Users', 'icon' => '👥', 'href' => '#'],
        ['id' => 'products', 'label' => 'Products', 'icon' => '📦', 'href' => '#'],
        ['id' => 'orders', 'label' => 'Orders', 'icon' => '🛒', 'href' => '#'],
        ['id' => 'analytics', 'label' => 'Analytics', 'icon' => '📈', 'children' => [
            ['id' => 'reports', 'label' => 'Reports', 'icon' => '📄', 'href' => '#'],
            ['id' => 'realtime', 'label' => 'Real-time', 'icon' => '⏱️', 'href' => '#'],
        ]],
        ['id' => 'settings', 'label' => 'Settings', 'icon' => '⚙️', 'href' => '#'],
    ];
@endphp

<div class="flex min-h-screen">
    {{-- Sidebar (desktop) --}}
    <aside
        class="hidden lg:flex flex-col bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 transition-all duration-300 sticky top-0 h-screen"
        :class="$store.collapsed ? 'w-20' : 'w-64'"
    >
        {{-- Brand --}}
        <div class="h-16 flex items-center gap-3 px-4 border-b border-gray-200 dark:border-gray-700 flex-shrink-0">
            <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-bold flex-shrink-0">B</div>
            <span x-show="!$store.collapsed" class="font-bold text-gray-900 dark:text-white truncate">BacaDev Admin</span>
        </div>

        {{-- Nav --}}
        <nav class="flex-1 p-3 space-y-1 overflow-y-auto">
            @foreach($navItems as $item)
                @php
                    $hasChildren = isset($item['children']) && count($item['children']) > 0;
                    $itemId = $item['id'];
                    $isActive = $active === $itemId;
                @endphp

                @if($hasChildren)
                    <div x-data="{ subOpen: {{ $isActive ? 'true' : 'false' }} }">
                        <button @click="subOpen = !subOpen"
                            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-colors text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700"
                            :class="$store.collapsed ? 'justify-center' : ''">
                            <span class="text-lg flex-shrink-0">{{ $item['icon'] }}</span>
                            <span x-show="!$store.collapsed" class="flex-1 text-left truncate">{{ $item['label'] }}</span>
                            <svg x-show="!$store.collapsed" class="w-3.5 h-3.5 text-gray-400 transition-transform" :class="subOpen ? 'rotate-90' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </button>
                        <div x-show="subOpen && !$store.collapsed" x-collapse class="ml-4 pl-3 border-l border-gray-200 dark:border-gray-700 space-y-0.5 mt-0.5">
                            @foreach($item['children'] as $child)
                                <a href="{{ $child['href'] ?? '#' }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm transition-colors {{ $active === ($child['id'] ?? null) ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 font-medium' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                                    <span class="text-sm">{{ $child['icon'] ?? '' }}</span>
                                    <span class="truncate">{{ $child['label'] }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @else
                    <a href="{{ $item['href'] ?? '#' }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-colors {{ $isActive ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 font-medium' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }}"
                        :class="$store.collapsed ? 'justify-center' : ''">
                        <span class="text-lg flex-shrink-0">{{ $item['icon'] }}</span>
                        <span x-show="!$store.collapsed" class="truncate">{{ $item['label'] }}</span>
                    </a>
                @endif
            @endforeach
        </nav>

        {{-- User footer --}}
        <div class="p-3 border-t border-gray-200 dark:border-gray-700 flex items-center gap-3 flex-shrink-0">
            <div class="w-9 h-9 rounded-full bg-blue-500 text-white flex items-center justify-center text-sm font-bold flex-shrink-0">AD</div>
            <div x-show="!$store.collapsed" class="min-w-0">
                <p class="text-sm font-medium text-gray-900 dark:text-white truncate">Admin</p>
                <p class="text-xs text-gray-500 dark:text-gray-400 truncate">admin@bacadev.test</p>
            </div>
        </div>
    </aside>

    {{-- Main --}}
    <div class="flex-1 min-w-0 flex flex-col">
        {{-- Topbar --}}
        <header class="h-16 flex items-center gap-3 px-4 lg:px-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 sticky top-0 z-30">
            <button @click="$store.collapsed = !$store.collapsed" class="hidden lg:inline-flex p-2 rounded-lg text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors" aria-label="Toggle sidebar">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
            <h1 class="text-lg font-bold text-gray-900 dark:text-white truncate">@yield('title', 'Dashboard')</h1>

            <div class="ml-auto flex items-center gap-2">
                <button class="relative p-2 rounded-lg text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors" aria-label="Notifications">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                    <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                </button>
                <button @click="toggle()" class="p-2 rounded-lg text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors" aria-label="Toggle dark mode">
                    <svg x-show="!isDark" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                    <svg x-show="isDark" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707.707M6.343 6.343l-.707.707m12.728 0l-.707-.707M6.343 17.657l-.707-.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </button>
                <div class="w-9 h-9 rounded-full bg-blue-500 text-white flex items-center justify-center text-sm font-bold">AD</div>
            </div>
        </header>

        {{-- Content --}}
        <main class="flex-1 p-4 lg:p-6">
            @yield('content')
        </main>
    </div>

    {{-- Mobile menu (FAB) --}}
    <x-navigation.mobile-menu :items="$navItems" :activeItem="$active" userName="Admin" />
</div>
</body>
</html>