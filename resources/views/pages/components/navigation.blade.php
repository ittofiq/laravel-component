@extends('layouts.app')
@section('title', 'Navigation - BacaDev')
@section('content')
<div class="flex min-h-screen">
    @include('pages.components.sidebar', ['currentCategory' => 'navigation'])
    <div class="flex-1 min-w-0 px-4 py-8">
        <h1 class="text-3xl font-bold mb-2 text-gray-900 dark:text-white">🧭 Navigation</h1>
        <p class="text-gray-600 dark:text-gray-400 mb-8">9 komponen: Navbar, Breadcrumb, Pagination, Tabs, Stepper, Dropdown, Dropdown Item, Mobile Menu, Sidebar</p>
        <div class="grid grid-cols-1 gap-6">

            <x-ui.demo-card title="Navbar" component="navigation.navbar" :props="[
                ['name' => 'brand', 'type' => 'string', 'default' => '\'BacaDev\'', 'description' => 'Nama brand'],
                ['name' => 'links', 'type' => 'array', 'default' => '[]', 'description' => 'Menu: label, href, active, children'],
                ['name' => 'fixed', 'type' => 'bool', 'default' => 'true', 'description' => 'Fixed di atas'],
                ['name' => 'variant', 'type' => 'string', 'default' => '\'default\'', 'description' => 'default, transparent, colored'],
                ['name' => 'shadow', 'type' => 'bool', 'default' => 'true', 'description' => 'Tampilkan bayangan'],
                ['name' => 'searchable', 'type' => 'bool', 'default' => 'false', 'description' => 'Tampilkan kotak pencarian'],
                ['name' => 'notifications', 'type' => 'bool', 'default' => 'false', 'description' => 'Tampilkan lonceng notifikasi'],
                ['name' => 'userMenu', 'type' => 'bool', 'default' => 'false', 'description' => 'Tampilkan menu pengguna'],
                ['name' => 'userName', 'type' => 'string', 'default' => '\'User\'', 'description' => 'Nama pengguna'],
            ]">
                <div class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-visible">
                    <x-navigation.navbar
                        brand="BacaDev"
                        :links="[
                            ['label' => 'Home', 'href' => '/', 'active' => true],
                            ['label' => 'Products', 'href' => '#', 'children' => [
                                ['label' => 'Software', 'href' => '#', 'icon' => '💻'],
                                ['label' => 'Hardware', 'href' => '#', 'icon' => '🖥️'],
                                ['label' => 'Services', 'href' => '#', 'icon' => '🛠️'],
                            ]],
                            ['label' => 'Resources', 'href' => '#', 'children' => [
                                ['label' => 'Documentation', 'href' => '#', 'icon' => '📚'],
                                ['label' => 'Blog', 'href' => '#', 'icon' => '✍️'],
                            ]],
                        ]"
                        :fixed="false" :searchable="true" :notifications="true" :notificationCount="3"
                        :userMenu="true" userName="John Doe"
                    />
                </div>
            </x-ui.demo-card>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 mt-6">

            <x-ui.demo-card title="Breadcrumb" component="navigation.breadcrumb" :props="[
                ['name' => 'items', 'type' => 'array', 'default' => '[]', 'description' => 'Item: label, href, icon'],
                ['name' => 'separator', 'type' => 'string', 'default' => '\'/\'', 'description' => '/ , →, ›, chevron, slash, dot'],
                ['name' => 'homeIcon', 'type' => 'string', 'default' => '\'🏠\'', 'description' => 'Ikon item pertama'],
                ['name' => 'collapsible', 'type' => 'bool', 'default' => 'false', 'description' => 'Ringkas jika terlalu banyak'],
                ['name' => 'maxItems', 'type' => 'int', 'default' => '4', 'description' => 'Batas sebelum ringkas'],
            ]">
                <x-navigation.breadcrumb :items="[
                    ['label' => 'Home', 'href' => '#', 'icon' => '🏠'],
                    ['label' => 'Products', 'href' => '#', 'icon' => '📦'],
                    ['label' => 'Item Details'],
                ]" separator="chevron" class="mb-4" />
                <x-navigation.breadcrumb :items="[
                    ['label' => 'Home', 'href' => '#'],
                    ['label' => 'Blog', 'href' => '#'],
                    ['label' => 'Article Title'],
                ]" separator="slash" />
            </x-ui.demo-card>

            <x-ui.demo-card title="Stepper" component="navigation.stepper" :props="[
                ['name' => 'steps', 'type' => 'array', 'default' => '[]', 'description' => 'Daftar label langkah'],
                ['name' => 'current', 'type' => 'int', 'default' => '1', 'description' => 'Langkah aktif (1-based)'],
                ['name' => 'variant', 'type' => 'string', 'default' => '\'numbered\'', 'description' => 'numbered, icon, bullet'],
                ['name' => 'orientation', 'type' => 'string', 'default' => '\'horizontal\'', 'description' => 'horizontal, vertical'],
                ['name' => 'clickable', 'type' => 'bool', 'default' => 'false', 'description' => 'Langkah bisa diklik'],
            ]">
                <x-navigation.stepper :steps="['Account', 'Profile', 'Confirmation', 'Done']" :current="2" />
            </x-ui.demo-card>

            <x-ui.demo-card title="Pagination" component="navigation.pagination" :props="[
                ['name' => 'current', 'type' => 'int', 'default' => '1', 'description' => 'Halaman aktif'],
                ['name' => 'total', 'type' => 'int', 'default' => '10', 'description' => 'Total item'],
                ['name' => 'perPage', 'type' => 'int', 'default' => '10', 'description' => 'Item per halaman'],
                ['name' => 'showPerPage', 'type' => 'bool', 'default' => 'false', 'description' => 'Selector per halaman'],
                ['name' => 'showInfo', 'type' => 'bool', 'default' => 'true', 'description' => 'Info jumlah item'],
                ['name' => 'showFirstLast', 'type' => 'bool', 'default' => 'true', 'description' => 'Tombol first/last'],
            ]">
                <x-navigation.pagination :total="250" :perPage="10" :current="5" :showInfo="true" :showFirstLast="true" :showPerPage="true" />
                <x-navigation.pagination :total="50" :perPage="10" :current="3" :showInfo="false" :showFirstLast="false" class="mt-6" />
            </x-ui.demo-card>

            <x-ui.demo-card title="Tabs" component="navigation.tabs" :props="[
                ['name' => 'tabs', 'type' => 'array', 'default' => '[]', 'description' => 'Tab: label, content, icon, badge'],
                ['name' => 'activeTab', 'type' => 'int', 'default' => '0', 'description' => 'Tab aktif'],
                ['name' => 'variant', 'type' => 'string', 'default' => '\'underline\'', 'description' => 'underline, pills'],
                ['name' => 'direction', 'type' => 'string', 'default' => '\'horizontal\'', 'description' => 'horizontal, vertical'],
                ['name' => 'color', 'type' => 'string', 'default' => '\'blue\'', 'description' => 'Warna aksen'],
                ['name' => 'animation', 'type' => 'string', 'default' => '\'fade\'', 'description' => 'fade, slide, none'],
            ]">
                <x-navigation.tabs
                    :tabs="[
                        ['label' => 'All', 'icon' => '📋', 'badge' => 12, 'content' => '📋 Showing all items — 12 total records.'],
                        ['label' => 'Active', 'icon' => '✅', 'badge' => 8, 'content' => '✅ 8 active items in progress.'],
                        ['label' => 'Draft', 'icon' => '📝', 'badge' => 3, 'content' => '📝 3 draft items waiting.'],
                    ]"
                    color="blue" animation="fade"
                />
            </x-ui.demo-card>

            <x-ui.demo-card title="Dropdown" component="navigation.dropdown" :props="[
                ['name' => 'label', 'type' => 'string', 'default' => '\'Menu\'', 'description' => 'Label trigger'],
                ['name' => 'align', 'type' => 'string', 'default' => '\'left\'', 'description' => 'left, right'],
                ['name' => 'trigger', 'type' => 'string', 'default' => '\'click\'', 'description' => 'click, hover'],
                ['name' => 'icon', 'type' => 'string|null', 'default' => 'null', 'description' => 'Ikon trigger'],
                ['name' => 'autoFlip', 'type' => 'bool', 'default' => 'true', 'description' => 'Auto buka ke atas'],
            ]">
                <x-navigation.dropdown label="Click Menu" icon="👤" trigger="click">
                    <x-navigation.dropdown.item type="header">Account</x-navigation.dropdown.item>
                    <x-navigation.dropdown.item href="#" icon="👤">Profile</x-navigation.dropdown.item>
                    <x-navigation.dropdown.item href="#" icon="⚙️" shortcut="⌘S">Settings</x-navigation.dropdown.item>
                    <x-navigation.dropdown.item type="divider" />
                    <x-navigation.dropdown.item href="#" icon="🚪" :danger="true">Logout</x-navigation.dropdown.item>
                </x-navigation.dropdown>
            </x-ui.demo-card>

            <x-ui.demo-card title="Mobile Menu" component="navigation.mobile-menu" :props="[
                ['name' => 'items', 'type' => 'array', 'default' => '[]', 'description' => 'Menu: id, label, icon, href, children'],
                ['name' => 'activeItem', 'type' => 'string|null', 'default' => 'null', 'description' => 'Item aktif'],
                ['name' => 'userName', 'type' => 'string|null', 'default' => 'null', 'description' => 'Nama pengguna'],
                ['name' => 'position', 'type' => 'string', 'default' => '\'bottom-right\'', 'description' => 'bottom-right, bottom-left'],
            ]">
                <div class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden p-4">
                    <x-navigation.mobile-menu
                        :items="[
                            ['id' => 'home', 'label' => 'Dashboard', 'icon' => '📊', 'href' => '#'],
                            ['id' => 'users', 'label' => 'Users', 'icon' => '👥', 'children' => [
                                ['id' => 'all', 'label' => 'All Users', 'icon' => '👤', 'href' => '#'],
                                ['id' => 'roles', 'label' => 'Roles', 'icon' => '🔑', 'href' => '#'],
                            ]],
                            ['id' => 'settings', 'label' => 'Settings', 'icon' => '⚙️', 'href' => '#'],
                        ]"
                        activeItem="home" userName="John Doe"
                    />
                </div>
            </x-ui.demo-card>

            <x-ui.demo-card title="Sidebar" component="navigation.sidebar" :props="[
                ['name' => 'items', 'type' => 'array', 'default' => '[]', 'description' => 'Menu: id, label, icon, href, children'],
                ['name' => 'activeItem', 'type' => 'string|null', 'default' => 'null', 'description' => 'Item aktif'],
                ['name' => 'collapsed', 'type' => 'bool', 'default' => 'false', 'description' => 'Mode ringkas'],
            ]">
                <x-navigation.sidebar
                    :items="[
                        ['id' => 'home', 'label' => 'Dashboard', 'icon' => '📊', 'href' => '#'],
                        ['id' => 'users', 'label' => 'Users', 'icon' => '👥', 'children' => [
                            ['id' => 'all-users', 'label' => 'All Users', 'icon' => '👤', 'href' => '#'],
                            ['id' => 'roles', 'label' => 'Roles', 'icon' => '🔑', 'href' => '#'],
                        ]],
                        ['id' => 'settings', 'label' => 'Settings', 'icon' => '⚙️', 'href' => '#'],
                    ]"
                    activeItem="roles"
                />
            </x-ui.demo-card>

        </div>
    </div>
</div>
@endsection