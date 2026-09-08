@extends('layouts.app')
@section('title', 'Custom Components - BacaDev')
@section('content')
<div class="flex min-h-screen">
    @include('pages.components.sidebar', ['currentCategory' => 'custom'])
    <div class="flex-1 min-w-0 px-4 py-8">
        <h1 class="text-3xl font-bold mb-2 text-gray-900 dark:text-white">🎁 Custom Components</h1>
        <p class="text-gray-600 dark:text-gray-400 mb-8">8 komponen: Loader, Rating Stars, Shopping Cart, User Profile, Permission System, Pricing Card, Protected Button, 2FA Auth</p>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">

            <x-ui.demo-card title="Loader" component="custom.loader" :props="[
                ['name' => 'size', 'type' => 'string', 'default' => '\'md\'', 'description' => 'Ukuran: xs, sm, md, lg, xl'],
                ['name' => 'text', 'type' => 'string|null', 'default' => 'null', 'description' => 'Teks keterangan yang tampil di samping spinner'],
            ]">
                <x-custom.loader size="md" text="Loading..." />
                <div class="flex gap-3 mt-3">
                    <x-custom.loader size="xs" />
                    <x-custom.loader size="sm" />
                    <x-custom.loader size="md" />
                    <x-custom.loader size="lg" />
                    <x-custom.loader size="xl" />
                </div>
            </x-ui.demo-card>

            <x-ui.demo-card title="Rating Stars" component="custom.rating-stars" :props="[
                ['name' => 'rating', 'type' => 'int', 'default' => '0', 'description' => 'Jumlah bintang terisi'],
                ['name' => 'maxStars', 'type' => 'int', 'default' => '5', 'description' => 'Total bintang'],
                ['name' => 'interactive', 'type' => 'bool', 'default' => 'false', 'description' => 'Bila true, bintang bisa diklik'],
                ['name' => 'size', 'type' => 'string', 'default' => '\'md\'', 'description' => 'Ukuran: xs, sm, md, lg, xl'],
            ]">
                <x-custom.rating-stars :rating="4" :max-stars="5" />
                <x-custom.rating-stars :rating="3.5" :max-stars="5" class="mt-2" />
                <x-custom.rating-stars :rating="5" :max-stars="5" class="mt-2" />
                <p class="text-xs text-gray-400 dark:text-gray-500 mt-4 font-medium">Interactive — klik bintang untuk memilih:</p>
                <x-custom.rating-stars interactive class="mt-2" />
                <div class="mt-4">
                    <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 mb-2">Sizes</p>
                    <div class="space-y-2">
                        <x-custom.rating-stars :rating="4" size="xs" />
                        <x-custom.rating-stars :rating="4" size="sm" />
                        <x-custom.rating-stars :rating="4" size="md" />
                        <x-custom.rating-stars :rating="4" size="lg" />
                        <x-custom.rating-stars :rating="4" size="xl" />
                    </div>
                </div>
            </x-ui.demo-card>

            <x-ui.demo-card title="Shopping Cart" component="custom.shopping-cart" :props="[
                ['name' => 'items', 'type' => 'array', 'default' => '[]', 'description' => 'Daftar item: name, price, quantity'],
            ]">
                <x-custom.shopping-cart :items="[
                    ['name' => 'Product A', 'price' => 99.99, 'quantity' => 2],
                    ['name' => 'Product B', 'price' => 49.99, 'quantity' => 1],
                    ['name' => 'Product C', 'price' => 149.99, 'quantity' => 1],
                ]" />
            </x-ui.demo-card>

            <x-ui.demo-card title="User Profile" component="custom.user-profile" :props="[
                ['name' => 'name', 'type' => 'string', 'default' => '\'User\'', 'description' => 'Nama pengguna'],
                ['name' => 'email', 'type' => 'string|null', 'default' => 'null', 'description' => 'Alamat email'],
                ['name' => 'role', 'type' => 'string|null', 'default' => 'null', 'description' => 'Jabatan/role'],
                ['name' => 'bio', 'type' => 'string|null', 'default' => 'null', 'description' => 'Bio singkat'],
                ['name' => 'stats', 'type' => 'array', 'default' => '[]', 'description' => 'Statistik: label, value'],
                ['name' => 'socialLinks', 'type' => 'array', 'default' => '[]', 'description' => 'Link sosial: icon, href, label'],
            ]">
                <x-custom.user-profile
                    name="John Doe"
                    email="john@example.com"
                    role="Senior Developer"
                    location="Jakarta, Indonesia"
                    bio="Full-stack developer passionate about Laravel, Tailwind CSS, and building great developer tools."
                    :stats="[
                        ['label' => 'Posts', 'value' => 142],
                        ['label' => 'Followers', 'value' => '3.2K'],
                        ['label' => 'Following', 'value' => 89],
                    ]"
                    :socialLinks="[
                        ['icon' => '🐙', 'href' => '#', 'label' => 'GitHub'],
                        ['icon' => '🐦', 'href' => '#', 'label' => 'Twitter'],
                        ['icon' => '💼', 'href' => '#', 'label' => 'LinkedIn'],
                        ['icon' => '🌐', 'href' => '#', 'label' => 'Website'],
                    ]"
                />
            </x-ui.demo-card>

            <x-ui.demo-card title="Pricing Card" component="custom.pricing-card" :props="[
                ['name' => 'plan', 'type' => 'string', 'default' => '—', 'description' => 'Nama paket'],
                ['name' => 'price', 'type' => 'string', 'default' => '—', 'description' => 'Harga paket'],
                ['name' => 'features', 'type' => 'array', 'default' => '[]', 'description' => 'Daftar fitur'],
                ['name' => 'popular', 'type' => 'bool', 'default' => 'false', 'description' => 'Tandai sebagai paket populer'],
                ['name' => 'buttonText', 'type' => 'string', 'default' => '\'Choose Plan\'', 'description' => 'Teks tombol'],
            ]">
                <div class="grid grid-cols-3 gap-3">
                    <x-custom.pricing-card plan="Basic" price="$9" :features="['5 Projects', '10GB Storage', 'Email Support']" />
                    <x-custom.pricing-card plan="Pro" price="$29" :features="['20 Projects', '100GB Storage', 'Priority Support']" :popular="true" />
                    <x-custom.pricing-card plan="Enterprise" price="$99" :features="['Unlimited', '1TB Storage', '24/7 Support']" />
                </div>
            </x-ui.demo-card>

            <x-ui.demo-card title="Permission System" component="custom.permission-system" :props="[
                ['name' => 'roles', 'type' => 'array', 'default' => '[]', 'description' => 'Daftar role + permissions'],
            ]">
                <x-custom.permission-system :roles="[
                    ['name' => 'Admin', 'permissions' => [['name' => 'Create', 'granted' => true], ['name' => 'Edit', 'granted' => true], ['name' => 'Delete', 'granted' => true], ['name' => 'Manage', 'granted' => true]]],
                    ['name' => 'Editor', 'permissions' => [['name' => 'Create', 'granted' => true], ['name' => 'Edit', 'granted' => true], ['name' => 'Delete', 'granted' => false], ['name' => 'Manage', 'granted' => false]]],
                ]" />
            </x-ui.demo-card>

            <x-ui.demo-card title="Protected Button" component="custom.protected-button" :props="[
                ['name' => 'permission', 'type' => 'string|null', 'default' => 'null', 'description' => 'Permission yang dicek dengan @can'],
                ['name' => 'disabled', 'type' => 'bool', 'default' => 'false', 'description' => 'Paksa nonaktifkan tombol'],
            ]">
                <x-custom.protected-button permission="edit-post">Edit Post</x-custom.protected-button>
            </x-ui.demo-card>

            <x-ui.demo-card title="2FA Authentication" component="custom.two-fa-auth" :props="[
                ['name' => 'step', 'type' => 'int', 'default' => '1', 'description' => 'Langkah: 1 (phone), 2 (kode), 3 (sukses)'],
            ]">
                <x-custom.two-fa-auth :step="1" />
                <x-custom.two-fa-auth :step="2" class="mt-4" />
            </x-ui.demo-card>

        </div>
    </div>
</div>
@endsection