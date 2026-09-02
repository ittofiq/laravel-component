@extends('layouts.app')
@section('title', 'Custom Components - BacaDev')
@section('content')
<div class="flex min-h-screen">
    @include('pages.components.sidebar', ['currentCategory' => 'custom'])
    <div class="flex-1 min-w-0 px-4 py-8">
        <h1 class="text-3xl font-bold mb-2 text-gray-900 dark:text-white">🎁 Custom Components</h1>
        <p class="text-gray-600 dark:text-gray-400 mb-8">8 komponen: Loader, Rating Stars, Shopping Cart, User Profile, Permission System, Pricing Card, Protected Button, 2FA Auth</p>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Loader</h3>
                <x-custom.loader size="md" text="Loading..." />
                <div class="flex gap-3 mt-3">
                    <x-custom.loader size="sm" />
                    <x-custom.loader size="md" />
                    <x-custom.loader size="lg" />
                </div>
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Rating Stars</h3>
                <x-custom.rating-stars :rating="4" :max-stars="5" />
                <x-custom.rating-stars :rating="3.5" :max-stars="5" class="mt-2" />
                <x-custom.rating-stars :rating="5" :max-stars="5" class="mt-2" />
                <p class="text-xs text-gray-400 dark:text-gray-500 mt-4 font-medium">Interactive — klik bintang untuk memilih:</p>
                <x-custom.rating-stars interactive class="mt-2" />
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Shopping Cart</h3>
                <x-custom.shopping-cart :items="[
                    ['name' => 'Product A', 'price' => 99.99, 'quantity' => 2],
                    ['name' => 'Product B', 'price' => 49.99, 'quantity' => 1],
                    ['name' => 'Product C', 'price' => 149.99, 'quantity' => 1],
                ]" />
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">User Profile</h3>
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
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Pricing Card</h3>
                <div class="grid grid-cols-3 gap-3">
                    <x-custom.pricing-card plan="Basic" price="$9" :features="['5 Projects', '10GB Storage', 'Email Support']" />
                    <x-custom.pricing-card plan="Pro" price="$29" :features="['20 Projects', '100GB Storage', 'Priority Support']" :popular="true" />
                    <x-custom.pricing-card plan="Enterprise" price="$99" :features="['Unlimited', '1TB Storage', '24/7 Support']" />
                </div>
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Permission System</h3>
                <x-custom.permission-system :roles="[
                    ['name' => 'Admin', 'permissions' => [['name' => 'Create', 'granted' => true], ['name' => 'Edit', 'granted' => true], ['name' => 'Delete', 'granted' => true], ['name' => 'Manage', 'granted' => true]]],
                    ['name' => 'Editor', 'permissions' => [['name' => 'Create', 'granted' => true], ['name' => 'Edit', 'granted' => true], ['name' => 'Delete', 'granted' => false], ['name' => 'Manage', 'granted' => false]]],
                ]" />
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Protected Button</h3>
                <x-custom.protected-button permission="edit-post">Edit Post</x-custom.protected-button>
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">2FA Authentication</h3>
                <x-custom.two-fa-auth :step="1" />
                <x-custom.two-fa-auth :step="2" class="mt-4" />
            </div>
        </div>
    </div>
</div>
@endsection