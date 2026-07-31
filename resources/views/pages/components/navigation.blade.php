@extends('layouts.app')
@section('title', 'Navigation - BacaDev')
@section('content')
<div class="flex min-h-screen">
    @include('pages.components.sidebar', ['currentCategory' => 'navigation'])
    <div class="flex-1 min-w-0 px-4 py-8">
        <h1 class="text-3xl font-bold mb-2 text-gray-900 dark:text-white">🧭 Navigation</h1>
        <p class="text-gray-600 dark:text-gray-400 mb-8">9 komponen: Navbar, Breadcrumb, Pagination, Tabs, Stepper, Dropdown, Dropdown Item, Mobile Menu, Sidebar</p>
        <div class="grid grid-cols-1 gap-6">
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Navbar</h3>
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-3">Default — with search, notifications, user menu, dropdowns</p>
                <div class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-visible mb-6">
                    <x-navigation.navbar
                        brand="BacaDev"
                        :links="[
                            ['label' => 'Home', 'href' => '/', 'active' => true],
                            ['label' => 'Products', 'href' => '#', 'children' => [
                                ['label' => 'Software', 'href' => '#', 'icon' => '💻', 'children' => [
                                    ['label' => 'Web Apps', 'href' => '#', 'icon' => '🌐'],
                                    ['label' => 'Mobile Apps', 'href' => '#', 'icon' => '📱'],
                                    ['label' => 'Desktop Apps', 'href' => '#', 'icon' => '🖥️'],
                                ]],
                                ['label' => 'Hardware', 'href' => '#', 'icon' => '🖥️'],
                                ['label' => 'Services', 'href' => '#', 'icon' => '🛠️'],
                            ]],
                            ['label' => 'Resources', 'href' => '#', 'children' => [
                                ['label' => 'Documentation', 'href' => '#', 'icon' => '📚'],
                                ['label' => 'Blog', 'href' => '#', 'icon' => '✍️'],
                                ['label' => 'Support', 'href' => '#', 'icon' => '🎧'],
                            ]],
                            ['label' => 'Company', 'href' => '#', 'children' => [
                                ['label' => 'About Us', 'href' => '#', 'icon' => '🏢'],
                                ['label' => 'Careers', 'href' => '#', 'icon' => '💼'],
                                ['label' => 'Contact', 'href' => '#', 'icon' => '✉️'],
                            ]],
                        ]"
                        :fixed="false"
                        :searchable="true"
                        :notifications="true"
                        :notificationCount="3"
                        :userMenu="true"
                        userName="John Doe"
                    />
                </div>

                <p class="text-xs text-gray-500 dark:text-gray-400 mt-6 mb-3">Colored — blue variant</p>
                <div class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-visible mb-6">
                    <x-navigation.navbar
                        brand="AdminPanel"
                        variant="colored"
                        :links="[
                            ['label' => 'Dashboard', 'href' => '#', 'active' => true],
                            ['label' => 'Users', 'href' => '#'],
                            ['label' => 'Reports', 'href' => '#'],
                            ['label' => 'Settings', 'href' => '#'],
                        ]"
                        :fixed="false"
                        :shadow="false"
                        :userMenu="true"
                        userName="Admin"
                    />
                </div>

                <p class="text-xs text-gray-500 dark:text-gray-400 mt-6 mb-3">Simple — minimal, no extras</p>
                <div class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-visible">
                    <x-navigation.navbar
                        brand="Minimal"
                        :links="[
                            ['label' => 'Home', 'href' => '#'],
                            ['label' => 'About', 'href' => '#'],
                            ['label' => 'Contact', 'href' => '#'],
                        ]"
                        :fixed="false"
                        :shadow="false"
                    />
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Breadcrumb</h3>
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-3">Chevron separator + icons</p>
                <x-navigation.breadcrumb :items="[
                    ['label' => 'Home', 'href' => '#', 'icon' => '🏠'],
                    ['label' => 'Products', 'href' => '#', 'icon' => '📦'],
                    ['label' => 'Category', 'icon' => '📁'],
                    ['label' => 'Item Details']
                ]" separator="chevron" class="mb-4" />

                <p class="text-xs text-gray-500 dark:text-gray-400 mb-3 mt-5">Slash separator</p>
                <x-navigation.breadcrumb :items="[
                    ['label' => 'Home', 'href' => '#'],
                    ['label' => 'Blog', 'href' => '#'],
                    ['label' => '2024', 'href' => '#'],
                    ['label' => 'Article Title']
                ]" separator="slash" class="mb-4" />

                <p class="text-xs text-gray-500 dark:text-gray-400 mb-3 mt-5">Dot separator</p>
                <x-navigation.breadcrumb :items="[
                    ['label' => 'Home', 'href' => '#'],
                    ['label' => 'Settings', 'href' => '#'],
                    ['label' => 'Profile']
                ]" separator="dot" class="mb-4" />

                <p class="text-xs text-gray-500 dark:text-gray-400 mb-3 mt-5">Arrow separator</p>
                <x-navigation.breadcrumb :items="[
                    ['label' => 'Home', 'href' => '#'],
                    ['label' => 'Shop', 'href' => '#'],
                    ['label' => 'Electronics', 'href' => '#'],
                    ['label' => 'Phones']
                ]" separator="→" class="mb-4" />

                <p class="text-xs text-gray-500 dark:text-gray-400 mb-3 mt-5">Collapsible (7 items → collapsed)</p>
                <x-navigation.breadcrumb :items="[
                    ['label' => 'Home', 'href' => '#', 'icon' => '🏠'],
                    ['label' => 'Docs', 'href' => '#', 'icon' => '📚'],
                    ['label' => 'Components', 'href' => '#', 'icon' => '🧩'],
                    ['label' => 'UI', 'href' => '#', 'icon' => '🎨'],
                    ['label' => 'Button', 'href' => '#'],
                    ['label' => 'Variants', 'href' => '#'],
                    ['label' => 'Primary']
                ]" separator="chevron" :collapsible="true" :maxItems="4" />
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Stepper</h3>
                <x-navigation.stepper :steps="['Account', 'Profile', 'Confirmation', 'Done']" :current="2" />
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Pagination</h3>
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-3">Default — with info, first/last, per-page selector</p>
                <x-navigation.pagination :total="250" :perPage="10" :current="5" :showInfo="true" :showFirstLast="true" :showPerPage="true" />

                <p class="text-xs text-gray-500 dark:text-gray-400 mb-3 mt-6">Simple — no info, no first/last</p>
                <x-navigation.pagination :total="50" :perPage="10" :current="3" :showInfo="false" :showFirstLast="false" />

                <p class="text-xs text-gray-500 dark:text-gray-400 mb-3 mt-6">Few pages — no ellipsis</p>
                <x-navigation.pagination :total="30" :perPage="10" :current="2" :showInfo="true" :showFirstLast="true" />

                <p class="text-xs text-gray-500 dark:text-gray-400 mb-3 mt-6">Many pages — long ellipsis</p>
                <x-navigation.pagination :total="500" :perPage="10" :current="25" :showInfo="true" :showFirstLast="true" />
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Tabs</h3>
                <x-navigation.tabs
                    :tabs="[
                        ['label' => 'All', 'icon' => '📋', 'badge' => 12, 'content' => '<p class=\'text-gray-600 dark:text-gray-400\'>📋 Showing all items — 12 total records across all categories.</p>'],
                        ['label' => 'Active', 'icon' => '✅', 'badge' => 8, 'content' => '<p class=\'text-gray-600 dark:text-gray-400\'>✅ 8 active items currently in progress or live.</p>'],
                        ['label' => 'Draft', 'icon' => '📝', 'badge' => 3, 'content' => '<p class=\'text-gray-600 dark:text-gray-400\'>📝 3 draft items waiting to be published.</p>'],
                        ['label' => 'Archived', 'icon' => '📦', 'badge' => 1, 'content' => '<p class=\'text-gray-600 dark:text-gray-400\'>📦 1 archived item stored for reference.</p>'],
                    ]"
                    color="blue"
                    animation="fade"
                />

                {{-- Pills variant --}}
                <x-navigation.tabs
                    :tabs="[
                        ['label' => 'Overview', 'icon' => '🏠', 'content' => '<p class=\'text-gray-600 dark:text-gray-400\'>Overview content — summary and key metrics.</p>'],
                        ['label' => 'Settings', 'icon' => '⚙️', 'content' => '<p class=\'text-gray-600 dark:text-gray-400\'>Settings content — configure your preferences.</p>'],
                        ['label' => 'Billing', 'icon' => '💳', 'badge' => 2, 'content' => '<p class=\'text-gray-600 dark:text-gray-400\'>Billing content — 2 pending invoices.</p>'],
                    ]"
                    variant="pills"
                    color="purple"
                    animation="slide"
                />

                {{-- Vertical variant with badges --}}
                <x-navigation.tabs
                    :tabs="[
                        ['label' => 'Profile', 'icon' => '👤', 'content' => '<p class=\'text-gray-600 dark:text-gray-400\'>Profile settings — manage your personal information.</p>'],
                        ['label' => 'Notifications', 'icon' => '🔔', 'badge' => 5, 'content' => '<p class=\'text-gray-600 dark:text-gray-400\'>5 unread notifications.</p>'],
                        ['label' => 'Security', 'icon' => '🔒', 'content' => '<p class=\'text-gray-600 dark:text-gray-400\'>Security settings — 2FA enabled, last login: today.</p>'],
                        ['label' => 'API Keys', 'icon' => '🔑', 'badge' => 3, 'content' => '<p class=\'text-gray-600 dark:text-gray-400\'>3 active API keys.</p>'],
                    ]"
                    direction="vertical"
                    color="green"
                    animation="slide"
                />
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Dropdown</h3>
                <div class="flex flex-wrap gap-2">
                    {{-- Click trigger --}}
                    <x-navigation.dropdown label="Click Menu" icon="👤" trigger="click">
                        <x-navigation.dropdown.item type="header">Account</x-navigation.dropdown.item>
                        <x-navigation.dropdown.item href="#" icon="👤">Profile</x-navigation.dropdown.item>
                        <x-navigation.dropdown.item href="#" icon="⚙️" shortcut="⌘S">Settings</x-navigation.dropdown.item>
                        <x-navigation.dropdown.item type="divider" />
                        <x-navigation.dropdown.item type="submenu" icon="🔗">Share
                            <x-slot:submenu>
                                <x-navigation.dropdown.item href="#" icon="📋">Copy Link</x-navigation.dropdown.item>
                                <x-navigation.dropdown.item href="#" icon="📧">Email</x-navigation.dropdown.item>
                                <x-navigation.dropdown.item href="#" icon="🐦">Twitter</x-navigation.dropdown.item>
                            </x-slot:submenu>
                        </x-navigation.dropdown.item>
                        <x-navigation.dropdown.item type="divider" />
                        <x-navigation.dropdown.item href="#" icon="🚪" :danger="true">Delete Account</x-navigation.dropdown.item>
                    </x-navigation.dropdown>

                    {{-- Hover trigger --}}
                    <x-navigation.dropdown label="Hover Menu" icon="📂" trigger="hover">
                        <x-navigation.dropdown.item type="header">Projects</x-navigation.dropdown.item>
                        <x-navigation.dropdown.item href="#" icon="📄">New Project</x-navigation.dropdown.item>
                        <x-navigation.dropdown.item type="submenu" icon="📁">Recent
                            <x-slot:submenu>
                                <x-navigation.dropdown.item href="#">Project Alpha</x-navigation.dropdown.item>
                                <x-navigation.dropdown.item href="#">Project Beta</x-navigation.dropdown.item>
                                <x-navigation.dropdown.item href="#">Project Gamma</x-navigation.dropdown.item>
                            </x-slot:submenu>
                        </x-navigation.dropdown.item>
                        <x-navigation.dropdown.item type="divider" />
                        <x-navigation.dropdown.item href="#" icon="📦" :disabled="true">Archive (soon)</x-navigation.dropdown.item>
                    </x-navigation.dropdown>
                </div>
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Mobile Menu</h3>
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-3">Resize browser ke &lt;768px atau lihat di mode mobile untuk melihat FAB button</p>
                <div class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden p-4">
                <x-navigation.mobile-menu
                    :items="[
                        ['id' => 'home', 'label' => 'Dashboard', 'icon' => '📊', 'href' => '#'],
                        ['id' => 'users', 'label' => 'Users', 'icon' => '👥', 'children' => [
                            ['id' => 'all', 'label' => 'All Users', 'icon' => '👤', 'href' => '#'],
                            ['id' => 'roles', 'label' => 'Roles', 'icon' => '🔑', 'href' => '#'],
                            ['id' => 'invite', 'label' => 'Invite', 'icon' => '✉️', 'href' => '#'],
                        ]],
                        ['id' => 'products', 'label' => 'Products', 'icon' => '📦', 'children' => [
                            ['id' => 'all-prod', 'label' => 'All Products', 'icon' => '📋', 'href' => '#'],
                            ['id' => 'categories', 'label' => 'Categories', 'icon' => '📁', 'href' => '#'],
                        ]],
                        ['id' => 'orders', 'label' => 'Orders', 'icon' => '🛒', 'href' => '#'],
                        ['id' => 'settings', 'label' => 'Settings', 'icon' => '⚙️', 'href' => '#'],
                        ['id' => 'logout', 'label' => 'Logout', 'icon' => '🚪', 'href' => '#'],
                    ]"
                    activeItem="home"
                    userName="John Doe"
                />
                </div>
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Sidebar</h3>
                <x-navigation.sidebar
                    :items="[
                        ['id' => 'home', 'label' => 'Dashboard', 'icon' => '📊', 'href' => '#'],
                        ['id' => 'users', 'label' => 'Users', 'icon' => '👥', 'children' => [
                            ['id' => 'all-users', 'label' => 'All Users', 'icon' => '👤', 'href' => '#'],
                            ['id' => 'roles', 'label' => 'Roles', 'icon' => '🔑', 'children' => [
                                ['id' => 'admin', 'label' => 'Admin', 'icon' => '👑', 'href' => '#'],
                                ['id' => 'editor', 'label' => 'Editor', 'icon' => '✏️', 'href' => '#'],
                                ['id' => 'viewer', 'label' => 'Viewer', 'icon' => '👁️', 'href' => '#'],
                            ]],
                            ['id' => 'invite', 'label' => 'Invite', 'icon' => '✉️', 'href' => '#'],
                        ]],
                        ['id' => 'products', 'label' => 'Products', 'icon' => '📦', 'children' => [
                            ['id' => 'all-products', 'label' => 'All Products', 'icon' => '📋', 'href' => '#'],
                            ['id' => 'categories', 'label' => 'Categories', 'icon' => '📁', 'href' => '#'],
                            ['id' => 'inventory', 'label' => 'Inventory', 'icon' => '📊', 'href' => '#'],
                        ]],
                        ['id' => 'orders', 'label' => 'Orders', 'icon' => '🛒', 'href' => '#'],
                        ['id' => 'analytics', 'label' => 'Analytics', 'icon' => '📈', 'children' => [
                            ['id' => 'reports', 'label' => 'Reports', 'icon' => '📄', 'href' => '#'],
                            ['id' => 'realtime', 'label' => 'Real-time', 'icon' => '⏱️', 'href' => '#'],
                        ]],
                        ['id' => 'settings', 'label' => 'Settings', 'icon' => '⚙️', 'href' => '#'],
                        ['id' => 'logout', 'label' => 'Logout', 'icon' => '🚪', 'href' => '#'],
                    ]"
                    activeItem="roles"
                />
            </div>
        </div>
    </div>
</div>
@endsection