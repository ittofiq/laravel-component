@extends('layouts.app')
@section('title', 'UI Components - BacaDev')
@section('content')
<div class="flex min-h-screen">
    @include('pages.components.sidebar', ['currentCategory' => 'ui'])
    <div class="flex-1 min-w-0 px-4 py-8">
        <h1 class="text-3xl font-bold mb-2 text-gray-900 dark:text-white">🎨 UI Components</h1>
        <p class="text-gray-600 dark:text-gray-400 mb-8">24 komponen: Button, Badge, Avatar, Avatar Group, Cookie Consent, Share Button, Drag & Drop List, Tree View, Command Palette, Context Menu, Scroll to Top, Lazy Image, Countdown, Dark Mode Preview, Notification Badge, Code Block, Card, Tag, Chip, Divider, Live Code Editor, Mobile Preview, Image Compare, Page Skeleton</p>

        <div class="mb-6">
            <x-ui.dark-mode-preview label="Button Component">
                <x-ui.button variant="primary">Primary Button</x-ui.button>
                <x-ui.button variant="secondary" class="ml-2">Secondary</x-ui.button>
                <div class="mt-3 space-y-2">
                    <x-ui.badge variant="success">Success</x-ui.badge>
                    <x-ui.badge variant="danger" class="ml-2">Danger</x-ui.badge>
                </div>
            </x-ui.dark-mode-preview>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
            {{-- Button --}}
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow component-card">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-bold text-gray-900 dark:text-white">Button</h3>
                    <button onclick="copyCode(this)" data-code='&lt;x-ui.button variant="primary"&gt;Primary&lt;/x-ui.button&gt;' class="px-2 py-1 text-xs bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 rounded hover:bg-gray-200 dark:hover:bg-gray-600 transition">📋 Copy</button>
                </div>
                <div class="space-y-3">
                    <div>
                        <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 mb-2">Variants</p>
                        <div class="flex flex-wrap gap-2">
                            <x-ui.button variant="primary">Primary</x-ui.button>
                            <x-ui.button variant="secondary">Secondary</x-ui.button>
                            <x-ui.button variant="danger">Danger</x-ui.button>
                            <x-ui.button variant="success">Success</x-ui.button>
                        </div>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 mb-2">Sizes</p>
                        <div class="flex flex-wrap gap-2 items-center">
                            <x-ui.button variant="primary" size="sm">Small</x-ui.button>
                            <x-ui.button variant="primary" size="md">Medium</x-ui.button>
                            <x-ui.button variant="primary" size="lg">Large</x-ui.button>
                        </div>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 mb-2">Disabled</p>
                        <div class="flex flex-wrap gap-2">
                            <x-ui.button variant="primary" disabled>Disabled</x-ui.button>
                            <x-ui.button variant="danger" disabled>Disabled</x-ui.button>
                        </div>
                    </div>
                    {{-- Playground --}}
                    <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                        <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 mb-3">🎮 Props Playground</p>
                        <div x-data="{ variant: 'primary', size: 'md', disabled: false }" class="space-y-3">
                            <div class="flex flex-wrap gap-4 items-center">
                                <select x-model="variant" class="px-2 py-1 text-sm rounded border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                                    <option value="primary">Primary</option><option value="secondary">Secondary</option>
                                    <option value="danger">Danger</option><option value="success">Success</option>
                                </select>
                                <select x-model="size" class="px-2 py-1 text-sm rounded border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                                    <option value="sm">Small</option><option value="md">Medium</option><option value="lg">Large</option>
                                </select>
                                <label class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300"><input type="checkbox" x-model="disabled"> Disabled</label>
                            </div>
                            <div class="p-4 bg-gray-50 dark:bg-gray-900 rounded-lg flex items-center justify-center">
                                <button type="button" class="font-semibold rounded-lg transition-colors duration-200 cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2" :class="{
                                    'bg-blue-500 text-white hover:bg-blue-600 focus:ring-blue-400': variant === 'primary',
                                    'bg-gray-200 text-gray-900 hover:bg-gray-300 focus:ring-gray-300': variant === 'secondary',
                                    'bg-red-500 text-white hover:bg-red-600 focus:ring-red-400': variant === 'danger',
                                    'bg-green-500 text-white hover:bg-green-600 focus:ring-green-400': variant === 'success',
                                    'px-3 py-1.5 text-sm': size === 'sm',
                                    'px-4 py-2 text-base': size === 'md',
                                    'px-6 py-3 text-lg': size === 'lg',
                                    'opacity-50 cursor-not-allowed': disabled
                                }" :disabled="disabled">Playground Button</button>
                            </div>
                            <p class="text-xs text-gray-400 dark:text-gray-500 font-mono" x-text="codeSnippet('ui.button', variant, size, disabled)"></p>
                        </div>
                    </div>
                </div>

            {{-- Props API --}}
            <div x-data="{ apiOpen: false }" class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                <button @click="apiOpen = !apiOpen" class="flex items-center gap-1.5 text-xs font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition">
                    <span>📋</span> <span x-text="apiOpen ? 'Hide API' : 'Props API'">Props API</span>
                    <svg class="w-3 h-3 transition-transform" :class="apiOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="apiOpen" x-collapse class="mt-3">
                    <x-ui.props-table :props="[
                        ['name' => 'variant', 'type' => 'string', 'default' => '\'primary\'', 'description' => 'Warna tombol: primary, secondary, danger, success'],
                        ['name' => 'size', 'type' => 'string', 'default' => '\'md\'', 'description' => 'Ukuran tombol: sm, md, lg'],
                        ['name' => 'type', 'type' => 'string', 'default' => '\'button\'', 'description' => 'HTML button type: button, submit, reset'],
                        ['name' => 'disabled', 'type' => 'bool', 'default' => 'false', 'description' => 'Nonaktifkan tombol jika true'],
                    ]" />
                </div>
            </div>
            </div>

            {{-- Badge --}}
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow component-card">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-bold text-gray-900 dark:text-white">Badge</h3>
                    <button onclick="copyCode(this)" data-code='&lt;x-ui.badge variant="primary"&gt;Badge&lt;/x-ui.badge&gt;' class="px-2 py-1 text-xs bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 rounded hover:bg-gray-200 dark:hover:bg-gray-600 transition">📋 Copy</button>
                </div>
                <div class="space-y-3">
                    <div>
                        <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 mb-2">Variants</p>
                        <div class="flex flex-wrap gap-2">
                            <x-ui.badge variant="primary">Primary</x-ui.badge>
                            <x-ui.badge variant="success">Success</x-ui.badge>
                            <x-ui.badge variant="warning">Warning</x-ui.badge>
                            <x-ui.badge variant="danger">Danger</x-ui.badge>
                        </div>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 mb-2">With icon & dot</p>
                        <div class="flex flex-wrap gap-2">
                            <x-ui.badge variant="primary">🆕 New</x-ui.badge>
                            <x-ui.badge variant="success">✅ Verified</x-ui.badge>
                            <x-ui.badge variant="warning">⚠️ Pending</x-ui.badge>
                            <x-ui.badge variant="danger">🔴 Live</x-ui.badge>
                        </div>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 mb-2">Sizes</p>
                        <div class="flex flex-wrap gap-2 items-center">
                            <x-ui.badge variant="primary" size="sm">Small</x-ui.badge>
                            <x-ui.badge variant="primary" size="md">Medium</x-ui.badge>
                            <x-ui.badge variant="primary" size="lg">Large</x-ui.badge>
                        </div>
                    </div>
                    {{-- Playground --}}
                    <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                        <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 mb-3">🎮 Props Playground</p>
                        <div x-data="{ variant: 'primary', size: 'md' }" class="space-y-3">
                            <div class="flex flex-wrap gap-4 items-center">
                                <select x-model="variant" class="px-2 py-1 text-sm rounded border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                                    <option value="primary">Primary</option><option value="secondary">Secondary</option>
                                    <option value="success">Success</option><option value="warning">Warning</option><option value="danger">Danger</option>
                                </select>
                                <select x-model="size" class="px-2 py-1 text-sm rounded border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                                    <option value="sm">Small</option><option value="md">Medium</option><option value="lg">Large</option>
                                </select>
                            </div>
                            <div class="p-4 bg-gray-50 dark:bg-gray-900 rounded-lg flex items-center justify-center">
                                <span class="inline-block rounded-full font-semibold" :class="{
                                    'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300': variant === 'primary',
                                    'bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-gray-300': variant === 'secondary',
                                    'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300': variant === 'success',
                                    'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300': variant === 'warning',
                                    'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300': variant === 'danger',
                                    'px-2 py-1 text-xs': size === 'sm',
                                    'px-3 py-1.5 text-sm': size === 'md',
                                    'px-4 py-2 text-base': size === 'lg'
                                }">Playground Badge</span>
                            </div>
                            <p class="text-xs text-gray-400 dark:text-gray-500 font-mono" x-text="codeSnippet('ui.badge', variant, size)"></p>
                        </div>
                    </div>
                </div>

            {{-- Props API --}}
            <div x-data="{ apiOpen: false }" class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                <button @click="apiOpen = !apiOpen" class="flex items-center gap-1.5 text-xs font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition">
                    <span>📋</span> <span x-text="apiOpen ? 'Hide API' : 'Props API'">Props API</span>
                    <svg class="w-3 h-3 transition-transform" :class="apiOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="apiOpen" x-collapse class="mt-3">
                    <x-ui.props-table :props="[
                        ['name' => 'variant', 'type' => 'string', 'default' => '\'primary\'', 'description' => 'Warna badge: primary, secondary, success, warning, danger'],
                        ['name' => 'size', 'type' => 'string', 'default' => '\'md\'', 'description' => 'Ukuran badge: sm, md, lg'],
                    ]" />
                </div>
            </div>
            </div>

            {{-- Avatar --}}
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow component-card">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-bold text-gray-900 dark:text-white">Avatar</h3>
                    <button onclick="copyCode(this)" data-code='&lt;x-ui.avatar initials="JD" size="md" color="blue" /&gt;' class="px-2 py-1 text-xs bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 rounded hover:bg-gray-200 dark:hover:bg-gray-600 transition">📋 Copy</button>
                </div>
                <div class="space-y-3">
                    <div>
                        <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 mb-2">Sizes</p>
                        <div class="flex gap-4 items-center">
                            <x-ui.avatar initials="JD" size="sm" />
                            <x-ui.avatar initials="AB" size="md" />
                            <x-ui.avatar initials="CD" size="lg" />
                        </div>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 mb-2">Colors</p>
                        <div class="flex gap-2">
                            <x-ui.avatar initials="JD" size="md" color="blue" />
                            <x-ui.avatar initials="AB" size="md" color="red" />
                            <x-ui.avatar initials="CD" size="md" color="green" />
                            <x-ui.avatar initials="EF" size="md" color="purple" />
                        </div>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 mb-2">Status Indicators</p>
                        <div class="flex gap-4 items-center">
                            <x-ui.avatar initials="JD" size="md" color="blue" status="online" />
                            <x-ui.avatar initials="AB" size="md" color="red" status="away" />
                            <x-ui.avatar initials="CD" size="md" color="green" status="busy" />
                            <x-ui.avatar initials="EF" size="md" color="gray" status="offline" />
                        </div>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 mb-2">Badge & Border</p>
                        <div class="flex gap-4 items-center">
                            <x-ui.avatar initials="JD" size="md" color="blue" :badge="3" />
                            <x-ui.avatar initials="AB" size="md" color="green" :badge="99" status="online" />
                            <x-ui.avatar initials="CD" size="lg" color="purple" :bordered="true" />
                            <x-ui.avatar initials="EF" size="md" color="gray" :square="true" />
                        </div>
                    </div>
                </div>

            {{-- Props API --}}
            <div x-data="{ apiOpen: false }" class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                <button @click="apiOpen = !apiOpen" class="flex items-center gap-1.5 text-xs font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition">
                    <span>📋</span> <span x-text="apiOpen ? 'Hide API' : 'Props API'">Props API</span>
                    <svg class="w-3 h-3 transition-transform" :class="apiOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="apiOpen" x-collapse class="mt-3">
                    <x-ui.props-table :props="[
                        ['name' => 'src', 'type' => 'string|null', 'default' => 'null', 'description' => 'URL gambar avatar (jika pakai foto)'],
                        ['name' => 'initials', 'type' => 'string|null', 'default' => 'null', 'description' => 'Inisial yang ditampilkan (fallback)'],
                        ['name' => 'name', 'type' => 'string|null', 'default' => 'null', 'description' => 'Nama user (untuk alt text)'],
                        ['name' => 'size', 'type' => 'string', 'default' => '\'md\'', 'description' => 'Ukuran avatar: sm, md, lg'],
                        ['name' => 'color', 'type' => 'string', 'default' => '\'blue\'', 'description' => 'Warna background inisial: blue, red, green, purple'],
                    ]" />
                </div>
            </div>
            </div>

            {{-- Card --}}
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow component-card">
                <h3 class="font-bold mb-4 text-gray-900 dark:text-white">Avatar Group</h3>
                <div class="space-y-3">
                    <x-ui.avatar-group :avatars="[
                        ['initials' => 'JD'], ['initials' => 'AB'], ['initials' => 'CD'],
                        ['initials' => 'EF'], ['initials' => 'GH'], ['initials' => 'IJ'], ['initials' => 'KL']
                    ]" :max="4" />
                    <p class="text-xs text-gray-500">7 avatars, max 4 shown (+3 overflow)</p>
                </div>

            {{-- Props API --}}
            <div x-data="{ apiOpen: false }" class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                <button @click="apiOpen = !apiOpen" class="flex items-center gap-1.5 text-xs font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition">
                    <span>📋</span> <span x-text="apiOpen ? 'Hide API' : 'Props API'">Props API</span>
                    <svg class="w-3 h-3 transition-transform" :class="apiOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="apiOpen" x-collapse class="mt-3">
                    <x-ui.props-table :props="[
                        ['name' => 'avatars', 'type' => 'array', 'default' => '[]', 'description' => 'Array avatar: [\'initials\' => \'JD\', \'src\' => ..., \'name\' => ...]'],
                        ['name' => 'max', 'type' => 'int', 'default' => '5', 'description' => 'Jumlah maksimal avatar yang ditampilkan'],
                        ['name' => 'size', 'type' => 'string', 'default' => '\'md\'', 'description' => 'Ukuran avatar: sm, md, lg, xl'],
                    ]" />
                </div>
            </div>
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow component-card">
                <h3 class="font-bold mb-4 text-gray-900 dark:text-white">Notification Badge</h3>
                <div class="flex gap-6 items-center">
                    <x-ui.notification-badge :count="3">
                        <svg class="w-6 h-6 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                    </x-ui.notification-badge>
                    <x-ui.notification-badge :count="99" color="blue">
                        <svg class="w-6 h-6 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </x-ui.notification-badge>
                    <x-ui.notification-badge :dot="true" color="green">
                        <span class="px-3 py-1.5 bg-gray-100 dark:bg-gray-700 rounded-full text-sm text-gray-600 dark:text-gray-400">Online</span>
                    </x-ui.notification-badge>
                </div>

            {{-- Props API --}}
            <div x-data="{ apiOpen: false }" class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                <button @click="apiOpen = !apiOpen" class="flex items-center gap-1.5 text-xs font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition">
                    <span>📋</span> <span x-text="apiOpen ? 'Hide API' : 'Props API'">Props API</span>
                    <svg class="w-3 h-3 transition-transform" :class="apiOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="apiOpen" x-collapse class="mt-3">
                    <x-ui.props-table :props="[
                        ['name' => 'count', 'type' => 'int|null', 'default' => 'null', 'description' => 'Jumlah notifikasi (99+ ditampilkan)'],
                        ['name' => 'dot', 'type' => 'bool', 'default' => 'false', 'description' => 'Tampilkan dot kecil tanpa angka'],
                        ['name' => 'color', 'type' => 'string', 'default' => '\'red\'', 'description' => 'Warna badge: red, blue, green, yellow, purple, gray'],
                        ['name' => 'size', 'type' => 'string', 'default' => '\'md\'', 'description' => 'Ukuran badge: sm, md, lg'],
                        ['name' => 'position', 'type' => 'string', 'default' => '\'top-right\'', 'description' => 'Posisi: top-right, top-left, bottom-right, bottom-left'],
                    ]" />
                </div>
            </div>
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow component-card">
                <h3 class="font-bold mb-4 text-gray-900 dark:text-white">Tree View</h3>
                <x-ui.tree-view :items="[
                    ['id' => '1', 'label' => 'src', 'children' => [
                        ['id' => '1.1', 'label' => 'components', 'children' => [
                            ['id' => '1.1.1', 'label' => 'ui', 'children' => [
                                ['id' => '1.1.1.1', 'label' => 'Button.jsx'],
                                ['id' => '1.1.1.2', 'label' => 'Modal.jsx'],
                            ]],
                            ['id' => '1.1.2', 'label' => 'form', 'children' => [
                                ['id' => '1.1.2.1', 'label' => 'Input.jsx'],
                            ]],
                        ]],
                        ['id' => '1.2', 'label' => 'utils', 'children' => [
                            ['id' => '1.2.1', 'label' => 'helpers.js'],
                            ['id' => '1.2.2', 'label' => 'api.js'],
                        ]],
                        ['id' => '1.3', 'label' => 'App.jsx'],
                    ]],
                    ['id' => '2', 'label' => 'public', 'children' => [
                        ['id' => '2.1', 'label' => 'index.html'],
                        ['id' => '2.2', 'label' => 'favicon.ico'],
                    ]],
                    ['id' => '3', 'label' => 'package.json'],
                ]" />

            {{-- Props API --}}
            <div x-data="{ apiOpen: false }" class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                <button @click="apiOpen = !apiOpen" class="flex items-center gap-1.5 text-xs font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition">
                    <span>📋</span> <span x-text="apiOpen ? 'Hide API' : 'Props API'">Props API</span>
                    <svg class="w-3 h-3 transition-transform" :class="apiOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="apiOpen" x-collapse class="mt-3">
                    <x-ui.props-table :props="[
                        ['name' => 'items', 'type' => 'array', 'default' => '[]', 'description' => 'Array node rekursif: id, label, children (opsional)'],
                        ['name' => 'icon', 'type' => 'string', 'default' => '\'📁\'', 'description' => 'Emoji untuk folder tertutup'],
                        ['name' => 'openIcon', 'type' => 'string', 'default' => '\'📂\'', 'description' => 'Emoji untuk folder terbuka'],
                        ['name' => 'fileIcon', 'type' => 'string', 'default' => '\'📄\'', 'description' => 'Emoji untuk file'],
                    ]" />
                </div>
            </div>
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow component-card">
                <h3 class="font-bold mb-4 text-gray-900 dark:text-white">Card</h3>
                <div class="space-y-4">
                    {{-- Card with image header --}}
                    <x-ui.card
                        title="Featured Article"
                        subtitle="Published 2 days ago"
                        headerImage="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='800' height='300'%3E%3Cdefs%3E%3ClinearGradient id='g' x1='0%25' y1='0%25' x2='100%25' y2='100%25'%3E%3Cstop offset='0%25' style='stop-color:%233B82F6'/%3E%3Cstop offset='100%25' style='stop-color:%238B5CF6'/%3E%3C/linearGradient%3E%3C/defs%3E%3Crect fill='url(%23g)' width='800' height='300'/%3E%3Ctext x='50%25' y='50%25' text-anchor='middle' fill='white' font-size='28' font-weight='bold'%3E🖼️ Card Header Image%3C/text%3E%3C/svg%3E"
                        hover="lift"
                    >
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Card dengan image header, hover lift effect, dan content area.</p>
                        <x-slot:actions>
                            <button class="px-3 py-1.5 text-xs font-medium bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">Save</button>
                        </x-slot:actions>
                        <x-slot:footer>
                            <div class="flex items-center gap-2">
                                <x-ui.avatar initials="JD" size="sm" color="blue" />
                                <span class="text-sm text-gray-500 dark:text-gray-400">John Doe</span>
                            </div>
                            <span class="text-xs text-gray-400 dark:text-gray-500">5 min read</span>
                        </x-slot:footer>
                    </x-ui.card>

                    {{-- Card with hover glow --}}
                    <x-ui.card title="Glow Effect" subtitle="hover: glow" hover="glow" variant="elevated">
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Card dengan elevated shadow dan glow hover effect.</p>
                        <x-slot:actions>
                            <button class="px-3 py-1.5 text-xs font-medium bg-green-500 text-white rounded-lg hover:bg-green-600 transition">Approve</button>
                            <button class="px-3 py-1.5 text-xs font-medium bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">Cancel</button>
                        </x-slot:actions>
                    </x-ui.card>

                    {{-- Card as form --}}
                    <x-ui.card
                        title="Edit Profile"
                        subtitle="Card as form with auto-footer"
                        :asForm="true"
                        action="#"
                        method="POST"
                        submitLabel="Save Changes"
                        cancelLabel="Back"
                        cancelUrl="#"
                        hover="none"
                    >
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Name</label>
                                <input type="text" value="John Doe" class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                                <input type="email" value="john@example.com" class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" />
                            </div>
                        </div>
                    </x-ui.card>

                    {{-- Stat card --}}
                    <x-ui.card variant="flat" hover="scale" padding="sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Total Revenue</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white">$12,430</p>
                                <p class="text-xs text-green-600 dark:text-green-400 mt-0.5">↑ 12.5%</p>
                            </div>
                            <div class="w-12 h-12 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-2xl">💰</div>
                        </div>
                    </x-ui.card>

                    {{-- Horizontal card --}}
                    <x-ui.card variant="bordered" hover="border" padding="sm">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center text-white text-2xl flex-shrink-0">JD</div>
                            <div class="flex-1 min-w-0">
                                <h4 class="font-bold text-gray-900 dark:text-white">John Doe</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Senior Developer</p>
                                <p class="text-xs text-blue-500 mt-0.5">View profile →</p>
                            </div>
                            <x-ui.badge variant="success" size="sm">Online</x-ui.badge>
                        </div>
                    </x-ui.card>
                </div>

            {{-- Props API --}}
            <div x-data="{ apiOpen: false }" class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                <button @click="apiOpen = !apiOpen" class="flex items-center gap-1.5 text-xs font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition">
                    <span>📋</span> <span x-text="apiOpen ? 'Hide API' : 'Props API'">Props API</span>
                    <svg class="w-3 h-3 transition-transform" :class="apiOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="apiOpen" x-collapse class="mt-3">
                    <x-ui.props-table :props="[
                        ['name' => 'title', 'type' => 'string|null', 'default' => 'null', 'description' => 'Judul card (opsional)'],
                        ['name' => 'subtitle', 'type' => 'string|null', 'default' => 'null', 'description' => 'Subjudul card (opsional)'],
                        ['name' => 'headerImage', 'type' => 'string|null', 'default' => 'null', 'description' => 'URL gambar header card'],
                        ['name' => 'headerImageAlt', 'type' => 'string', 'default' => '\'Card image\'', 'description' => 'Alt text untuk header image'],
                        ['name' => 'headerImageHeight', 'type' => 'string', 'default' => '\'h-48\'', 'description' => 'Tinggi header image (Tailwind class)'],
                        ['name' => 'variant', 'type' => 'string', 'default' => '\'default\'', 'description' => 'Gaya: default, bordered, elevated, flat'],
                        ['name' => 'hover', 'type' => 'string', 'default' => '\'lift\'', 'description' => 'Efek: lift, glow, scale, border, none'],
                        ['name' => 'padding', 'type' => 'string', 'default' => '\'md\'', 'description' => 'Padding: none, sm, md, lg'],
                        ['name' => 'footerDivider', 'type' => 'bool', 'default' => 'true', 'description' => 'Divider di atas footer'],
                        ['name' => 'asForm', 'type' => 'bool', 'default' => 'false', 'description' => 'Render card sebagai <form> element'],
                        ['name' => 'action', 'type' => 'string|null', 'default' => 'null', 'description' => 'URL form action (wajib jika asForm=true)'],
                        ['name' => 'method', 'type' => 'string', 'default' => '\'POST\'', 'description' => 'HTTP method: POST, GET, PUT, PATCH, DELETE'],
                        ['name' => 'csrf', 'type' => 'bool', 'default' => 'true', 'description' => 'Auto-include @csrf token'],
                        ['name' => 'submitLabel', 'type' => 'string', 'default' => '\'Save\'', 'description' => 'Label tombol submit di auto-footer'],
                        ['name' => 'cancelLabel', 'type' => 'string', 'default' => '\'Cancel\'', 'description' => 'Label tombol cancel di auto-footer'],
                        ['name' => 'cancelUrl', 'type' => 'string|null', 'default' => 'null', 'description' => 'URL untuk tombol cancel'],
                    ]" />
                </div>
            </div>
            </div>

            {{-- Tag --}}
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow component-card">
                <h3 class="font-bold mb-4 text-gray-900 dark:text-white">Tag</h3>
                <div class="flex flex-wrap gap-2">
                    <x-ui.tag variant="primary">Tag 1</x-ui.tag>
                    <x-ui.tag variant="secondary">Tag 2</x-ui.tag>
                    <x-ui.tag variant="success">Tag 3</x-ui.tag>
                </div>
                <div class="mt-3">
                    <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 mb-2">With icons</p>
                    <div class="flex flex-wrap gap-2">
                        <x-ui.tag variant="primary">🏷️ Design</x-ui.tag>
                        <x-ui.tag variant="warning">⭐ Featured</x-ui.tag>
                        <x-ui.tag variant="danger">🔥 Trending</x-ui.tag>
                        <x-ui.tag variant="secondary">📦 Archived</x-ui.tag>
                    </div>
                </div>

            {{-- Props API --}}
            <div x-data="{ apiOpen: false }" class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                <button @click="apiOpen = !apiOpen" class="flex items-center gap-1.5 text-xs font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition">
                    <span>📋</span> <span x-text="apiOpen ? 'Hide API' : 'Props API'">Props API</span>
                    <svg class="w-3 h-3 transition-transform" :class="apiOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="apiOpen" x-collapse class="mt-3">
                    <x-ui.props-table :props="[
                        ['name' => 'variant', 'type' => 'string', 'default' => '\'primary\'', 'description' => 'Warna tag: primary, secondary, success, warning, danger'],
                        ['name' => 'size', 'type' => 'string', 'default' => '\'md\'', 'description' => 'Ukuran tag: sm, md, lg'],
                    ]" />
                </div>
            </div>
            </div>

            {{-- Share Button --}}
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow component-card">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-bold text-gray-900 dark:text-white">Share Button</h3>
                    <button onclick="copyCode(this)" data-code='&lt;x-ui.share-button url="https://bacadev.test" title="BacaDev" /&gt;' class="px-2 py-1 text-xs bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 rounded hover:bg-gray-200 dark:hover:bg-gray-600 transition">📋 Copy</button>
                </div>
                <div class="space-y-4">
                    <div>
                        <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 mb-2">Inline (default)</p>
                        <x-ui.share-button url="https://bacadev.test" title="BacaDev - UI Components" />
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 mb-2">Dropdown</p>
                        <x-ui.share-button variant="dropdown" label="Bagikan" url="https://bacadev.test" title="BacaDev" />
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 mb-2">Minimal</p>
                        <x-ui.share-button variant="minimal" size="sm" url="https://bacadev.test" title="BacaDev" />
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 mb-2">Custom Platforms</p>
                        <x-ui.share-button :platforms="['linkedin', 'facebook', 'twitter']" variant="minimal" url="https://bacadev.test" title="BacaDev" />
                    </div>
                    {{-- Playground --}}
                    <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                        <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 mb-3">🎮 Props Playground</p>
                        <div x-data="{ variant: 'inline', size: 'md', label: 'Share' }" class="space-y-3">
                            <div class="flex flex-wrap gap-4 items-center">
                                <select x-model="variant" class="px-2 py-1 text-sm rounded border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                                    <option value="inline">Inline</option><option value="dropdown">Dropdown</option><option value="minimal">Minimal</option>
                                </select>
                                <select x-model="size" class="px-2 py-1 text-sm rounded border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                                    <option value="sm">Small</option><option value="md">Medium</option><option value="lg">Large</option>
                                </select>
                                <input type="text" x-model="label" placeholder="Label" class="px-2 py-1 text-sm rounded border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white w-20">
                            </div>
                            <div class="p-4 bg-gray-50 dark:bg-gray-900 rounded-lg flex items-center justify-center">
                                <template x-if="variant === 'dropdown'">
                                    <div class="relative inline-block" x-data="{ open: false }">
                                        <button @click="open = !open" class="px-4 py-2 rounded-lg text-white font-medium text-sm transition flex items-center gap-2" :class="size === 'sm' ? 'text-xs px-3 py-1.5' : size === 'lg' ? 'text-base px-6 py-3' : ''" style="background-color: #1877F2">
                                            <span>🔗</span> <span x-text="label"></span>
                                        </button>
                                    </div>
                                </template>
                                <template x-if="variant !== 'dropdown'">
                                    <div class="flex items-center gap-2">
                                        <template x-if="variant === 'inline'">
                                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300 mr-1" x-text="label + ':'"></span>
                                        </template>
                                        <span class="flex items-center justify-center text-white rounded-lg hover:opacity-90 transition" :class="size === 'sm' ? 'w-8 h-8 text-sm' : size === 'lg' ? 'w-12 h-12 text-lg' : 'w-10 h-10 text-base'" style="background-color: #1877F2">📘</span>
                                        <span class="flex items-center justify-center text-white rounded-lg hover:opacity-90 transition" :class="size === 'sm' ? 'w-8 h-8 text-sm' : size === 'lg' ? 'w-12 h-12 text-lg' : 'w-10 h-10 text-base'" style="background-color: #1DA1F2">🐦</span>
                                        <span class="flex items-center justify-center text-white rounded-lg hover:opacity-90 transition" :class="size === 'sm' ? 'w-8 h-8 text-sm' : size === 'lg' ? 'w-12 h-12 text-lg' : 'w-10 h-10 text-base'" style="background-color: #25D366">💬</span>
                                    </div>
                                </template>
                            </div>
                            <p class="text-xs text-gray-400 dark:text-gray-500 font-mono" x-text="'&lt;x-ui.share-button variant=&quot;' + variant + '&quot; size=&quot;' + size + '&quot; label=&quot;' + label + '&quot; /&gt;'"></p>
                        </div>
                    </div>
                </div>

            {{-- Props API --}}
            <div x-data="{ apiOpen: false }" class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                <button @click="apiOpen = !apiOpen" class="flex items-center gap-1.5 text-xs font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition">
                    <span>📋</span> <span x-text="apiOpen ? 'Hide API' : 'Props API'">Props API</span>
                    <svg class="w-3 h-3 transition-transform" :class="apiOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="apiOpen" x-collapse class="mt-3">
                    <x-ui.props-table :props="[
                        ['name' => 'url', 'type' => 'string|null', 'default' => 'null', 'description' => 'URL yang dibagikan (default: current URL)'],
                        ['name' => 'title', 'type' => 'string|null', 'default' => 'null', 'description' => 'Judul/share text (default: \'Check this out!\')'],
                        ['name' => 'platforms', 'type' => 'array', 'default' => '[...]', 'description' => 'Platform: facebook, twitter, whatsapp, telegram, email, copy, linkedin'],
                        ['name' => 'variant', 'type' => 'string', 'default' => '\'inline\'', 'description' => 'Tampilan: inline, dropdown, minimal'],
                        ['name' => 'label', 'type' => 'string', 'default' => '\'Share\'', 'description' => 'Teks label tombol share'],
                        ['name' => 'size', 'type' => 'string', 'default' => '\'md\'', 'description' => 'Ukuran tombol: sm, md, lg'],
                    ]" />
                </div>
            </div>
            </div>

            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow component-card">
                <h3 class="font-bold mb-4 text-gray-900 dark:text-white">Cookie Consent</h3>
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-3">Banner muncul di bottom. Klik Terima/Tolak untuk menyimpan preferensi.</p>
                <x-ui.cookie-consent position="bottom" />

            {{-- Props API --}}
            <div x-data="{ apiOpen: false }" class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                <button @click="apiOpen = !apiOpen" class="flex items-center gap-1.5 text-xs font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition">
                    <span>📋</span> <span x-text="apiOpen ? 'Hide API' : 'Props API'">Props API</span>
                    <svg class="w-3 h-3 transition-transform" :class="apiOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="apiOpen" x-collapse class="mt-3">
                    <x-ui.props-table :props="[
                        ['name' => 'message', 'type' => 'string', 'default' => '\'Kami menggunakan...\'', 'description' => 'Teks pesan cookie consent'],
                        ['name' => 'acceptText', 'type' => 'string', 'default' => '\'Terima\'', 'description' => 'Teks tombol terima'],
                        ['name' => 'declineText', 'type' => 'string', 'default' => '\'Tolak\'', 'description' => 'Teks tombol tolak'],
                        ['name' => 'learnMoreText', 'type' => 'string', 'default' => '\'Pelajari lebih...\'', 'description' => 'Teks link info selengkapnya'],
                        ['name' => 'learnMoreUrl', 'type' => 'string', 'default' => '\'#\'', 'description' => 'URL link info selengkapnya'],
                        ['name' => 'position', 'type' => 'string', 'default' => '\'bottom\'', 'description' => 'Posisi: bottom, top, bottom-right, bottom-left'],
                    ]" />
                </div>
            </div>
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow component-card">
                <h3 class="font-bold mb-4 text-gray-900 dark:text-white">Drag & Drop List</h3>
                <x-ui.drag-drop-list :items="[
                    ['id' => '1', 'label' => 'First item', 'description' => 'Drag to reorder'],
                    ['id' => '2', 'label' => 'Second item', 'description' => 'Drop anywhere'],
                    ['id' => '3', 'label' => 'Third item', 'description' => 'Grab the handle'],
                    ['id' => '4', 'label' => 'Fourth item', 'description' => 'Try it out'],
                ]" />

            {{-- Props API --}}
            <div x-data="{ apiOpen: false }" class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                <button @click="apiOpen = !apiOpen" class="flex items-center gap-1.5 text-xs font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition">
                    <span>📋</span> <span x-text="apiOpen ? 'Hide API' : 'Props API'">Props API</span>
                    <svg class="w-3 h-3 transition-transform" :class="apiOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="apiOpen" x-collapse class="mt-3">
                    <x-ui.props-table :props="[
                        ['name' => 'items', 'type' => 'array', 'default' => '[]', 'description' => 'Array item: id, label, description (opsional)'],
                        ['name' => 'sortable', 'type' => 'bool', 'default' => 'true', 'description' => 'Aktifkan drag & drop reorder'],
                    ]" />
                </div>
            </div>
            </div>
            {{-- Chip --}}
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow component-card">
                <h3 class="font-bold mb-4 text-gray-900 dark:text-white">Chip</h3>
                <div class="flex flex-wrap gap-2">
                    <x-ui.chip removable>Removable</x-ui.chip>
                    <x-ui.chip removable>Another</x-ui.chip>
                </div>
                <div class="mt-3">
                    <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 mb-2">With icons</p>
                    <div class="flex flex-wrap gap-2">
                        <x-ui.chip>🔵 Blue Chip</x-ui.chip>
                        <x-ui.chip>🟢 Green Chip</x-ui.chip>
                        <x-ui.chip removable>📎 Attachment</x-ui.chip>
                    </div>
                </div>

            {{-- Props API --}}
            <div x-data="{ apiOpen: false }" class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                <button @click="apiOpen = !apiOpen" class="flex items-center gap-1.5 text-xs font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition">
                    <span>📋</span> <span x-text="apiOpen ? 'Hide API' : 'Props API'">Props API</span>
                    <svg class="w-3 h-3 transition-transform" :class="apiOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="apiOpen" x-collapse class="mt-3">
                    <x-ui.props-table :props="[
                        ['name' => 'removable', 'type' => 'bool', 'default' => 'false', 'description' => 'Tampilkan tombol X untuk menghapus chip'],
                        ['name' => 'icon', 'type' => 'string|null', 'default' => 'null', 'description' => 'HTML/emoji icon di depan chip'],
                        ['name' => 'color', 'type' => 'string', 'default' => '\'gray\'', 'description' => 'Warna chip: gray, blue, green, red, yellow'],
                    ]" />
                </div>
            </div>
            </div>

            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow component-card">
                <h3 class="font-bold mb-4 text-gray-900 dark:text-white">Context Menu</h3>
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-3">Right-click untuk membuka menu</p>
                <x-ui.context-menu :items="[
                    ['label' => 'Edit', 'icon' => '✏️', 'shortcut' => '⌘E'],
                    ['label' => 'Duplicate', 'icon' => '📋', 'shortcut' => '⌘D'],
                    ['label' => 'Copy Link', 'icon' => '🔗', 'shortcut' => '⌘L'],
                    ['divider' => true],
                    ['label' => 'Delete', 'icon' => '🗑️', 'shortcut' => '⌘⌫', 'danger' => true],
                ]">
                    <div class="p-8 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg text-center text-sm text-gray-500 dark:text-gray-400">
                        Klik kanan di area ini
                    </div>
                </x-ui.context-menu>

            {{-- Props API --}}
            <div x-data="{ apiOpen: false }" class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                <button @click="apiOpen = !apiOpen" class="flex items-center gap-1.5 text-xs font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition">
                    <span>📋</span> <span x-text="apiOpen ? 'Hide API' : 'Props API'">Props API</span>
                    <svg class="w-3 h-3 transition-transform" :class="apiOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="apiOpen" x-collapse class="mt-3">
                    <x-ui.props-table :props="[
                        ['name' => 'items', 'type' => 'array', 'default' => '[]', 'description' => 'Array menu: label, icon, shortcut, danger, divider'],
                    ]" />
                </div>
            </div>
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow component-card">
                <h3 class="font-bold mb-4 text-gray-900 dark:text-white">Command Palette</h3>
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-3">Tekan <kbd class="px-1.5 py-0.5 rounded bg-gray-100 dark:bg-gray-700 text-xs font-mono">Cmd+K (Mac) / Ctrl+K (Windows)</kbd> untuk membuka</p>
                <x-ui.command-palette :items="[
                    ['id' => '1', 'label' => 'Dashboard', 'icon' => '📊', 'description' => 'Go to dashboard', 'shortcut' => 'G D', 'color' => 'blue'],
                    ['id' => '2', 'label' => 'Profile Settings', 'icon' => '👤', 'description' => 'Edit your profile', 'shortcut' => 'G P', 'color' => 'green'],
                    ['id' => '3', 'label' => 'Components Library', 'icon' => '🧩', 'description' => 'Browse all components', 'shortcut' => 'G C', 'color' => 'purple'],
                    ['id' => '4', 'label' => 'Documentation', 'icon' => '📚', 'description' => 'View documentation', 'shortcut' => 'G H', 'color' => 'blue'],
                    ['id' => '5', 'label' => 'Logout', 'icon' => '🚪', 'description' => 'Sign out from account', 'color' => 'red'],
                ]" />

            {{-- Props API --}}
            <div x-data="{ apiOpen: false }" class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                <button @click="apiOpen = !apiOpen" class="flex items-center gap-1.5 text-xs font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition">
                    <span>📋</span> <span x-text="apiOpen ? 'Hide API' : 'Props API'">Props API</span>
                    <svg class="w-3 h-3 transition-transform" :class="apiOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="apiOpen" x-collapse class="mt-3">
                    <x-ui.props-table :props="[
                        ['name' => 'items', 'type' => 'array', 'default' => '[]', 'description' => 'Array command: id, label, icon, description, shortcut, color, action'],
                        ['name' => 'placeholder', 'type' => 'string', 'default' => '\'Search commands...\'', 'description' => 'Teks placeholder input search'],
                        ['name' => 'emptyText', 'type' => 'string', 'default' => '\'No results found.\'', 'description' => 'Teks saat tidak ada hasil'],
                    ]" />
                </div>
            </div>
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow component-card">
                <h3 class="font-bold mb-4 text-gray-900 dark:text-white">Code Block</h3>
                <x-ui.code-block code="&lt;x-ui.button variant=&quot;primary&quot; size=&quot;md&quot;&gt;Click Me&lt;/x-ui.button&gt;" filename="button.blade.php" />

            {{-- Props API --}}
            <div x-data="{ apiOpen: false }" class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                <button @click="apiOpen = !apiOpen" class="flex items-center gap-1.5 text-xs font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition">
                    <span>📋</span> <span x-text="apiOpen ? 'Hide API' : 'Props API'">Props API</span>
                    <svg class="w-3 h-3 transition-transform" :class="apiOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="apiOpen" x-collapse class="mt-3">
                    <x-ui.props-table :props="[
                        ['name' => 'code', 'type' => 'string', 'default' => '\'\'', 'description' => 'Kode yang akan ditampilkan'],
                        ['name' => 'language', 'type' => 'string', 'default' => '\'blade\'', 'description' => 'Bahasa untuk syntax highlighting'],
                        ['name' => 'showLineNumbers', 'type' => 'bool', 'default' => 'false', 'description' => 'Tampilkan nomor baris'],
                        ['name' => 'showCopy', 'type' => 'bool', 'default' => 'true', 'description' => 'Tampilkan tombol copy'],
                        ['name' => 'filename', 'type' => 'string|null', 'default' => 'null', 'description' => 'Nama file di header'],
                    ]" />
                </div>
            </div>
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow component-card">
                <h3 class="font-bold mb-4 text-gray-900 dark:text-white">Scroll to Top</h3>
                <div class="flex items-center justify-center py-4">
                    <x-ui.scroll-to-top color="blue" />
                    <span class="text-sm text-gray-500 dark:text-gray-400 ml-4">Scroll ke bawah untuk melihat</span>
                </div>

            {{-- Props API --}}
            <div x-data="{ apiOpen: false }" class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                <button @click="apiOpen = !apiOpen" class="flex items-center gap-1.5 text-xs font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition">
                    <span>📋</span> <span x-text="apiOpen ? 'Hide API' : 'Props API'">Props API</span>
                    <svg class="w-3 h-3 transition-transform" :class="apiOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="apiOpen" x-collapse class="mt-3">
                    <x-ui.props-table :props="[
                        ['name' => 'color', 'type' => 'string', 'default' => '\'blue\'', 'description' => 'Warna tombol: blue, gray, green, purple'],
                        ['name' => 'position', 'type' => 'string', 'default' => '\'bottom-right\'', 'description' => 'Posisi: bottom-right, bottom-left'],
                        ['name' => 'showAt', 'type' => 'int', 'default' => '300', 'description' => 'Scroll threshold (px) sebelum tombol muncul'],
                    ]" />
                </div>
            </div>
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow component-card">
                <h3 class="font-bold mb-4 text-gray-900 dark:text-white">Countdown</h3>
                <x-ui.countdown target="{{ now()->addDays(3)->addHours(5)->addMinutes(23)->format('Y-m-d H:i:s') }}" label="Launching in" size="md" />

            {{-- Props API --}}
            <div x-data="{ apiOpen: false }" class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                <button @click="apiOpen = !apiOpen" class="flex items-center gap-1.5 text-xs font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition">
                    <span>📋</span> <span x-text="apiOpen ? 'Hide API' : 'Props API'">Props API</span>
                    <svg class="w-3 h-3 transition-transform" :class="apiOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="apiOpen" x-collapse class="mt-3">
                    <x-ui.props-table :props="[
                        ['name' => 'target', 'type' => 'string|null', 'default' => 'null', 'description' => 'Tanggal target (ISO format: YYYY-MM-DD HH:MM:SS)'],
                        ['name' => 'label', 'type' => 'string|null', 'default' => 'null', 'description' => 'Label teks di atas timer'],
                        ['name' => 'showDays', 'type' => 'bool', 'default' => 'true', 'description' => 'Tampilkan hari'],
                        ['name' => 'showHours', 'type' => 'bool', 'default' => 'true', 'description' => 'Tampilkan jam'],
                        ['name' => 'showMinutes', 'type' => 'bool', 'default' => 'true', 'description' => 'Tampilkan menit'],
                        ['name' => 'showSeconds', 'type' => 'bool', 'default' => 'true', 'description' => 'Tampilkan detik'],
                        ['name' => 'size', 'type' => 'string', 'default' => '\'md\'', 'description' => 'Ukuran: sm, md, lg'],
                        ['name' => 'variant', 'type' => 'string', 'default' => '\'default\'', 'description' => 'Gaya tampilan: default, minimal, boxes'],
                    ]" />
                </div>
            </div>
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow component-card">
                <h3 class="font-bold mb-4 text-gray-900 dark:text-white">Lazy Image</h3>
                <div class="grid grid-cols-2 gap-4">
                    <x-ui.lazy-image src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='400' height='300'%3E%3Crect fill='%233B82F6' width='400' height='300'/%3E%3Ctext x='50%25' y='50%25' text-anchor='middle' dy='.3em' fill='white' font-size='24'%3EImage 1%3C/text%3E%3C/svg%3E" alt="Example" ratio="4/3" />
                    <x-ui.lazy-image src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='400' height='400'%3E%3Crect fill='%2310B981' width='400' height='400'/%3E%3Ctext x='50%25' y='50%25' text-anchor='middle' dy='.3em' fill='white' font-size='24'%3EImage 2%3C/text%3E%3C/svg%3E" alt="Square" ratio="1/1" />
                </div>

            {{-- Props API --}}
            <div x-data="{ apiOpen: false }" class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                <button @click="apiOpen = !apiOpen" class="flex items-center gap-1.5 text-xs font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition">
                    <span>📋</span> <span x-text="apiOpen ? 'Hide API' : 'Props API'">Props API</span>
                    <svg class="w-3 h-3 transition-transform" :class="apiOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="apiOpen" x-collapse class="mt-3">
                    <x-ui.props-table :props="[
                        ['name' => 'src', 'type' => 'string', 'default' => '\'\'', 'description' => 'URL gambar'],
                        ['name' => 'alt', 'type' => 'string', 'default' => '\'\'', 'description' => 'Alt text untuk aksesibilitas'],
                        ['name' => 'class', 'type' => 'string', 'default' => '\'\'', 'description' => 'Class CSS tambahan'],
                        ['name' => 'ratio', 'type' => 'string', 'default' => '\'16/9\'', 'description' => 'Aspect ratio: 1/1, 4/3, 16/9, 21/9'],
                        ['name' => 'rounded', 'type' => 'string', 'default' => '\'rounded-lg\'', 'description' => 'Tailwind border-radius class'],
                    ]" />
                </div>
            </div>
            </div>
            {{-- Divider --}}
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow component-card">
                <h3 class="font-bold mb-4 text-gray-900 dark:text-white">Divider</h3>
                <x-ui.divider />
                <x-ui.divider text="OR" />
                <x-ui.divider text="★" />
                <x-ui.divider text="Section" />

            {{-- Props API --}}
            <div x-data="{ apiOpen: false }" class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                <button @click="apiOpen = !apiOpen" class="flex items-center gap-1.5 text-xs font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition">
                    <span>📋</span> <span x-text="apiOpen ? 'Hide API' : 'Props API'">Props API</span>
                    <svg class="w-3 h-3 transition-transform" :class="apiOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="apiOpen" x-collapse class="mt-3">
                    <x-ui.props-table :props="[
                        ['name' => 'direction', 'type' => 'string', 'default' => '\'horizontal\'', 'description' => 'Orientasi: horizontal, vertical'],
                        ['name' => 'text', 'type' => 'string|null', 'default' => 'null', 'description' => 'Teks di tengah divider (opsional)'],
                    ]" />
                </div>
            </div>
            </div>

            @php
            $liveEditorDefaultCode = "<!-- Edit HTML di sini, preview update real-time! -->\n"
                . "<button class='bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-600 transition'>\n"
                . "  Click Me\n"
                . "</button>\n\n"
                . "<span class='inline-block bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full'>\n"
                . "  New\n"
                . "</span>\n\n"
                . "<div class='flex gap-2 mt-3'>\n"
                . "  <span class='bg-blue-100 text-blue-800 text-xs px-3 py-1 rounded-full'>Tag 1</span>\n"
                . "  <span class='bg-gray-100 text-gray-800 text-xs px-3 py-1 rounded-full'>Tag 2</span>\n"
                . "</div>";
            @endphp
            {{-- Live Code Editor --}}
            <div class="lg:col-span-2">
                <x-ui.live-code-editor label="Live Code Editor" :defaultCode="$liveEditorDefaultCode" height="380px" />
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-2 text-center">✏️ Edit kode di editor kiri — preview di kanan update real-time. Coba ganti variant, size, atau tambah komponen baru!</p>

            {{-- Props API --}}
            <div x-data="{ apiOpen: false }" class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                <button @click="apiOpen = !apiOpen" class="flex items-center gap-1.5 text-xs font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition">
                    <span>📋</span> <span x-text="apiOpen ? 'Hide API' : 'Props API'">Props API</span>
                    <svg class="w-3 h-3 transition-transform" :class="apiOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="apiOpen" x-collapse class="mt-3">
                    <x-ui.props-table :props="[
                        ['name' => 'label', 'type' => 'string', 'default' => '\'Live Code Editor\'', 'description' => 'Judul di header editor'],
                        ['name' => 'defaultCode', 'type' => 'string', 'default' => '\'\'', 'description' => 'Kode HTML awal yang ditampilkan'],
                        ['name' => 'height', 'type' => 'string', 'default' => '\'320px\'', 'description' => 'Tinggi editor (CSS value)'],
                    ]" />
                </div>
            </div>
            </div>

            {{-- Mobile Preview --}}
            <div class="lg:col-span-2">
                <x-ui.mobile-preview label="Mobile Preview" device="iPhone 15 Pro" width="375px">
                    <div class="space-y-3">
                        <div class="flex gap-2">
                            <x-ui.button variant="primary" size="sm">Primary</x-ui.button>
                            <x-ui.button variant="secondary" size="sm">Secondary</x-ui.button>
                        </div>
                        <div class="flex gap-2">
                            <x-ui.badge variant="success">Success</x-ui.badge>
                            <x-ui.badge variant="danger">Danger</x-ui.badge>
                        </div>
                        <div class="flex gap-2">
                            <x-ui.tag variant="primary">Tag 1</x-ui.tag>
                            <x-ui.tag variant="secondary">Tag 2</x-ui.tag>
                        </div>
                        <x-ui.chip removable>Chip with X</x-ui.chip>
                        <x-ui.divider text="OR" />
                        <x-ui.avatar initials="JD" size="md" color="blue" />
                        <x-ui.notification-badge :count="3">
                            <svg class="w-5 h-5 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                        </x-ui.notification-badge>
                    </div>
                </x-ui.mobile-preview>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-2 text-center">📱 Preview komponen di ukuran mobile (375px). Scroll konten di dalam frame.</p>

            {{-- Props API --}}
            <div x-data="{ apiOpen: false }" class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                <button @click="apiOpen = !apiOpen" class="flex items-center gap-1.5 text-xs font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition">
                    <span>📋</span> <span x-text="apiOpen ? 'Hide API' : 'Props API'">Props API</span>
                    <svg class="w-3 h-3 transition-transform" :class="apiOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="apiOpen" x-collapse class="mt-3">
                    <x-ui.props-table :props="[
                        ['name' => 'label', 'type' => 'string', 'default' => '\'Mobile Preview\'', 'description' => 'Judul di header'],
                        ['name' => 'device', 'type' => 'string', 'default' => '\'iPhone 15 Pro\'', 'description' => 'Nama device yang ditampilkan'],
                        ['name' => 'width', 'type' => 'string', 'default' => '\'375px\'', 'description' => 'Lebar viewport mobile (CSS value)'],
                    ]" />
                </div>
            </div>
            </div>

            {{-- Image Compare --}}
            <div class="lg:col-span-2">
                <x-ui.image-compare
                    label="Image Compare"
                    before="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='800' height='450'%3E%3Crect fill='%233B82F6' width='800' height='450'/%3E%3Ctext x='50%25' y='45%25' text-anchor='middle' fill='white' font-size='48' font-weight='bold'%3EBEFORE%3C/text%3E%3Ctext x='50%25' y='60%25' text-anchor='middle' fill='white' font-size='18' opacity='0.8'%3EOriginal Photo%3C/text%3E%3C/svg%3E"
                    after="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='800' height='450'%3E%3Crect fill='%2310B981' width='800' height='450'/%3E%3Ctext x='50%25' y='45%25' text-anchor='middle' fill='white' font-size='48' font-weight='bold'%3EAFTER%3C/text%3E%3Ctext x='50%25' y='60%25' text-anchor='middle' fill='white' font-size='18' opacity='0.8'%3EEdited / Enhanced%3C/text%3E%3C/svg%3E"
                    ratio="16/9"
                    :initial="50"
                />
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-2 text-center">🖼️ Drag slider ke kiri/kanan untuk membandingkan gambar Before & After</p>

            {{-- Props API --}}
            <div x-data="{ apiOpen: false }" class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                <button @click="apiOpen = !apiOpen" class="flex items-center gap-1.5 text-xs font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition">
                    <span>📋</span> <span x-text="apiOpen ? 'Hide API' : 'Props API'">Props API</span>
                    <svg class="w-3 h-3 transition-transform" :class="apiOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="apiOpen" x-collapse class="mt-3">
                    <x-ui.props-table :props="[
                        ['name' => 'before', 'type' => 'string', 'default' => '\'\'', 'description' => 'URL gambar Before (kiri)'],
                        ['name' => 'after', 'type' => 'string', 'default' => '\'\'', 'description' => 'URL gambar After (kanan)'],
                        ['name' => 'label', 'type' => 'string|null', 'default' => 'null', 'description' => 'Label di header (opsional)'],
                        ['name' => 'ratio', 'type' => 'string', 'default' => '\'16/9\'', 'description' => 'Aspect ratio: 1/1, 4/3, 16/9, 21/9, 3/2'],
                        ['name' => 'initial', 'type' => 'int', 'default' => '50', 'description' => 'Posisi awal slider (%)'],
                    ]" />
                </div>
            </div>
            </div>

            {{-- Page Skeleton --}}
            <div class="lg:col-span-2">
                <x-ui.page-skeleton :loading="true" layout="dashboard">
                    <div class="min-h-screen flex items-center justify-center bg-gray-50 dark:bg-gray-900">
                        <div class="text-center">
                            <p class="text-4xl mb-4">✅</p>
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Content Loaded!</h2>
                            <p class="text-gray-500 dark:text-gray-400">Ini adalah konten asli setelah skeleton loading selesai.</p>
                        </div>
                    </div>
                </x-ui.page-skeleton>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-2 text-center">🦴 Klik <strong>Show Content</strong> / <strong>Show Skeleton</strong> untuk toggle antara skeleton loading dan konten asli</p>

            {{-- Props API --}}
            <div x-data="{ apiOpen: false }" class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                <button @click="apiOpen = !apiOpen" class="flex items-center gap-1.5 text-xs font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition">
                    <span>📋</span> <span x-text="apiOpen ? 'Hide API' : 'Props API'">Props API</span>
                    <svg class="w-3 h-3 transition-transform" :class="apiOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="apiOpen" x-collapse class="mt-3">
                    <x-ui.props-table :props="[
                        ['name' => 'loading', 'type' => 'bool', 'default' => 'true', 'description' => 'Tampilkan skeleton (true) atau konten (false)'],
                        ['name' => 'layout', 'type' => 'string', 'default' => '\'dashboard\'', 'description' => 'Layout skeleton: dashboard, blog, list'],
                    ]" />
                </div>
            </div>
            </div>
        </div>
    </div>
</div>

<script>
window.copyShareLink = function(e) {
    e.preventDefault();
    var url = e.currentTarget.getAttribute('data-url');
    navigator.clipboard.writeText(url).then(function() {
        var btn = e.currentTarget;
        var original = btn.innerHTML;
        btn.innerHTML = '✅';
        setTimeout(function() { btn.innerHTML = original; }, 1500);
    });
};
window.codeSnippet = function(component, variant, size, disabled) {
    let attrs = `variant="${variant}" size="${size}"`;
    if (disabled) attrs += ' disabled';
    return `<x-${component} ${attrs}>Click Me</x-${component}>`;
};
window.copyCode = function(btn) {
    const code = btn.getAttribute('data-code');
    navigator.clipboard.writeText(code).then(() => {
        const original = btn.innerHTML;
        btn.innerHTML = '✅ Copied!';
        btn.classList.add('bg-green-500', 'text-white');
        setTimeout(() => { btn.innerHTML = original; btn.classList.remove('bg-green-500', 'text-white'); }, 1500);
    });
};
</script>
@endsection
