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
    $navItems = [
        ['header' => 'Utama'],
        ['id' => 'dashboard', 'label' => 'Dashboard', 'icon' => '📊', 'route' => 'admin.dashboard', 'href' => route('admin.dashboard')],
        ['header' => 'Manajemen'],
        ['id' => 'users', 'label' => 'Users', 'icon' => '👥', 'route' => 'admin.users', 'href' => '#'],
        ['id' => 'products', 'label' => 'Products', 'icon' => '📦', 'route' => 'admin.products', 'href' => '#'],
        ['id' => 'orders', 'label' => 'Orders', 'icon' => '🛒', 'route' => 'admin.orders', 'href' => '#'],
        ['header' => 'Lainnya'],
        ['id' => 'analytics', 'label' => 'Analytics', 'icon' => '📈', 'children' => [
            ['id' => 'reports', 'label' => 'Reports', 'icon' => '📄', 'route' => 'admin.analytics.reports', 'href' => '#'],
            ['id' => 'realtime', 'label' => 'Real-time', 'icon' => '⏱️', 'route' => 'admin.analytics.realtime', 'href' => '#'],
        ]],
        ['id' => 'settings', 'label' => 'Settings', 'icon' => '⚙️', 'route' => 'admin.settings', 'href' => '#'],
    ];

    // Auto-detect item aktif dari nama route saat ini
    $currentRoute = request()->route() ? request()->route()->getName() : null;
    $active = 'dashboard';
    foreach ($navItems as $item) {
        if (($item['route'] ?? null) === $currentRoute) $active = $item['id'];
        foreach ($item['children'] ?? [] as $child) {
            if (($child['route'] ?? null) === $currentRoute) $active = $child['id'];
        }
    }

    // Item untuk menu mobile (tanpa section header)
    $mobileItems = array_values(array_filter($navItems, fn($item) => !isset($item['header'])));
@endphp

<div class="flex min-h-screen" @keydown.ctrl.b.window.prevent="$store.sidebar.collapsed = !$store.sidebar.collapsed" @keydown.cmd.b.window.prevent="$store.sidebar.collapsed = !$store.sidebar.collapsed">
    {{-- Sidebar (desktop) --}}
    <aside
        class="hidden lg:flex flex-col bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 transition-all duration-300 sticky top-0 h-screen"
        :class="$store.sidebar.collapsed ? 'w-20' : 'w-64'"
    >
        {{-- Brand --}}
        <div class="h-16 flex items-center gap-3 px-4 border-b border-gray-200 dark:border-gray-700 flex-shrink-0">
            <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-bold flex-shrink-0">B</div>
            <span x-show="!$store.sidebar.collapsed" class="font-bold text-gray-900 dark:text-white truncate">BacaDev Admin</span>
        </div>

        {{-- Nav --}}
        <nav class="flex-1 p-3 space-y-1 overflow-y-auto">
            @foreach($navItems as $item)
                @if(isset($item['header']))
                    <p x-show="!$store.sidebar.collapsed" class="px-3 pt-4 pb-1.5 text-[10px] font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500">{{ $item['header'] }}</p>
                    <div x-show="$store.sidebar.collapsed" class="mx-4 my-2 border-t border-gray-200 dark:border-gray-700"></div>
                @else
                    @php
                        $hasChildren = isset($item['children']) && count($item['children']) > 0;
                        $itemId = $item['id'];
                        $isActive = $active === $itemId;
                    @endphp

                    @if($hasChildren)
                    <div x-data="{ subOpen: {{ $isActive ? 'true' : 'false' }} }">
                        <button @click="subOpen = !subOpen"
                            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-colors text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700"
                            :class="$store.sidebar.collapsed ? 'justify-center' : ''">
                            <span class="text-lg flex-shrink-0">{{ $item['icon'] }}</span>
                            <span x-show="!$store.sidebar.collapsed" class="flex-1 text-left truncate">{{ $item['label'] }}</span>
                            <svg x-show="!$store.sidebar.collapsed" class="w-3.5 h-3.5 text-gray-400 transition-transform" :class="subOpen ? 'rotate-90' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </button>
                        <div x-show="subOpen && !$store.sidebar.collapsed" x-collapse class="ml-4 pl-3 border-l border-gray-200 dark:border-gray-700 space-y-0.5 mt-0.5">
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
                        :class="$store.sidebar.collapsed ? 'justify-center' : ''">
                        <span class="text-lg flex-shrink-0">{{ $item['icon'] }}</span>
                        <span x-show="!$store.sidebar.collapsed" class="truncate">{{ $item['label'] }}</span>
                    </a>
                @endif
                @endif
            @endforeach
        </nav>

        {{-- User footer --}}
        <div class="p-3 border-t border-gray-200 dark:border-gray-700 flex items-center gap-3 flex-shrink-0">
            <div class="w-9 h-9 rounded-full bg-blue-500 text-white flex items-center justify-center text-sm font-bold flex-shrink-0">AD</div>
            <div x-show="!$store.sidebar.collapsed" class="min-w-0">
                <p class="text-sm font-medium text-gray-900 dark:text-white truncate">Admin</p>
                <p class="text-xs text-gray-500 dark:text-gray-400 truncate">admin@bacadev.test</p>
            </div>
        </div>
    </aside>

    {{-- Main --}}
    <div class="flex-1 min-w-0 flex flex-col">
        {{-- Topbar --}}
        <header class="h-16 flex items-center gap-3 px-4 lg:px-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 sticky top-0 z-30">
            <button @click="$store.sidebar.collapsed = !$store.sidebar.collapsed" title="Ctrl+B" class="hidden lg:inline-flex p-2 rounded-lg text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors" aria-label="Toggle sidebar">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
            <h1 class="text-lg font-bold text-gray-900 dark:text-white truncate">@yield('title', 'Dashboard')</h1>

            {{-- Topbar search (Cmd+K) --}}
            <div class="hidden md:block relative max-w-xs flex-1 ml-4">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" placeholder="Cari..." aria-label="Cari" class="w-full pl-9 pr-12 py-1.5 text-sm rounded-lg border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                <kbd class="absolute right-2.5 top-1/2 -translate-y-1/2 px-1.5 py-0.5 text-[10px] font-medium text-gray-400 dark:text-gray-500 bg-gray-100 dark:bg-gray-700 rounded font-mono">⌘K</kbd>
            </div>

            <div class="ml-auto flex items-center gap-2">
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" @click.outside="open = false" class="relative p-2 rounded-lg text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors" aria-label="Notifications" :aria-expanded="open">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>
                    <div x-show="open" x-cloak x-transition class="absolute right-0 mt-2 w-80 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 z-50">
                        <div class="flex items-center justify-between px-4 py-3 border-b border-gray-100 dark:border-gray-700">
                            <p class="text-sm font-semibold text-gray-900 dark:text-white">Notifikasi</p>
                            <button class="text-xs font-medium text-blue-500 hover:text-blue-600">Tandai dibaca</button>
                        </div>
                        <div class="max-h-80 overflow-y-auto divide-y divide-gray-100 dark:divide-gray-700">
                            <a href="#" class="flex gap-3 px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                                <span class="w-8 h-8 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center text-sm flex-shrink-0">✅</span>
                                <div class="min-w-0">
                                    <p class="text-sm text-gray-900 dark:text-white font-medium">Order #123 selesai</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Pesanan telah dibayar lunas</p>
                                    <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">5 menit lalu</p>
                                </div>
                            </a>
                            <a href="#" class="flex gap-3 px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                                <span class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-sm flex-shrink-0">👤</span>
                                <div class="min-w-0">
                                    <p class="text-sm text-gray-900 dark:text-white font-medium">User baru terdaftar</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">john.doe@gmail.com</p>
                                    <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">1 jam lalu</p>
                                </div>
                            </a>
                            <a href="#" class="flex gap-3 px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                                <span class="w-8 h-8 rounded-full bg-yellow-100 dark:bg-yellow-900/30 flex items-center justify-center text-sm flex-shrink-0">⚠️</span>
                                <div class="min-w-0">
                                    <p class="text-sm text-gray-900 dark:text-white font-medium">Storage hampir penuh</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Tersisa 8% kapasitas</p>
                                    <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">3 jam lalu</p>
                                </div>
                            </a>
                        </div>
                        <a href="#" class="block text-center text-xs font-medium text-blue-500 hover:text-blue-600 py-2.5 border-t border-gray-100 dark:border-gray-700">Lihat semua notifikasi</a>
                    </div>
                </div>
                <button @click="toggle()" class="p-2 rounded-lg text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors" aria-label="Toggle dark mode">
                    <svg x-show="!isDark" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                    <svg x-show="isDark" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707.707M6.343 6.343l-.707.707m12.728 0l-.707-.707M6.343 17.657l-.707-.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </button>
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" @click.outside="open = false" class="w-9 h-9 rounded-full bg-blue-500 text-white flex items-center justify-center text-sm font-bold hover:ring-2 hover:ring-blue-300 transition" aria-haspopup="menu" :aria-expanded="open">AD</button>
                    <div x-show="open" x-cloak x-transition class="absolute right-0 mt-2 w-52 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 py-1.5 z-50">
                        <p class="px-4 py-2 text-xs text-gray-500 dark:text-gray-400 border-b border-gray-100 dark:border-gray-700">admin@bacadev.test</p>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">👤 Profile</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">⚙️ Settings</a>
                        <div class="my-1 border-t border-gray-100 dark:border-gray-700"></div>
                        <a href="#" class="block px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/30">🚪 Logout</a>
                    </div>
                </div>
            </div>
        </header>

        {{-- Content --}}
        <main class="flex-1 p-4 lg:p-6">
            @yield('breadcrumb')
            @yield('content')
        </main>
    </div>

    {{-- Mobile menu (FAB) --}}
    <x-navigation.mobile-menu :items="$mobileItems" :activeItem="$active" userName="Admin" />

    {{-- Command palette (Cmd+K / Ctrl+K) --}}
    <x-ui.command-palette
        placeholder="Cari halaman..."
        emptyText="Tidak ada hasil."
        :items="[
            ['id' => 'dashboard', 'label' => 'Dashboard', 'icon' => '📊', 'description' => 'Ke halaman dashboard', 'href' => '/admin', 'color' => 'blue', 'shortcut' => 'D'],
            ['id' => 'users', 'label' => 'Users', 'icon' => '👥', 'description' => 'Kelola pengguna', 'href' => '#', 'color' => 'green', 'shortcut' => 'U'],
            ['id' => 'products', 'label' => 'Products', 'icon' => '📦', 'description' => 'Kelola produk', 'href' => '#', 'color' => 'purple', 'shortcut' => 'P'],
            ['id' => 'orders', 'label' => 'Orders', 'icon' => '🛒', 'description' => 'Kelola pesanan', 'href' => '#', 'color' => 'orange', 'shortcut' => 'O'],
            ['id' => 'settings', 'label' => 'Settings', 'icon' => '⚙️', 'description' => 'Pengaturan aplikasi', 'href' => '#', 'color' => 'gray', 'shortcut' => 'S'],
        ]"
    />
</div>
</body>
</html>